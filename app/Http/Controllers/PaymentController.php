<?php

namespace App\Http\Controllers;

use App\Imports\PaymentsImport;
use App\Imports\ReversesImport;
use App\Models\Payment;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    public function index(): View
    {
//        $payments = Payment::paginate(10);
        $payments = Payment::all();
        $count = Payment::all()->where('id')->count();
        return view('welcome', compact('payments', 'count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $i = 0;
        $card = '36545400000008';

        if ($request->input('countPayment') != null) {
            $count = $request->input('countPayment');
        } else {
            $count = 1;
        }

        if ($request->input('card') != null) {
            $card = $request->input('card');

        }

        while ($i < $count) {

            $payment = new Payment();

            $data = [
                'payment' => [
                    'reference' => 'TEST_1000',
                    'description' => 'Conexion con WebCheckout desde un test',
                    'amount' => [
                        'currency' => 'COP',
                        'total' => '50000',
                    ]
                ],
                "instrument" => [
                    "card" => [
                        "number" => $card,
                        "expiration" => "12/20",
                        "cvv" => "123",
                        "installments" => 2
                    ]
                ]
            ];
            $response = (new WebcheckoutService())->process($data);

            $payment->internal_reference = $response['internalReference'];
            $payment->status = $response['status']['status'];

            if ($response['refunded'] == true) {
                $payment->reverse = 'true';
            } else {
                $payment->reverse = 'false';
            }

            $payment->save();

            $i++;

        }

        return redirect(route('payment.index'));
    }

    public function show(Payment $process)
    {
        //
    }

    public function edit(Payment $process)
    {
        //
    }

    public function update(Request $request, Payment $payment)
    {
        $data = ['internalReference' => $payment->attributesToArray()['internal_reference']];

        $responseQuery = (new WebcheckoutService())->query($data);

        $internalReference = $payment->attributesToArray()['internal_reference'];
        $authorization = $responseQuery['authorization'];

        $response = (new WebcheckoutService())->transaction(
            [
                "internalReference" => $internalReference,
                "authorization" => $authorization,
                "action" => "reverse"
            ]);

        $data = ['internalReference' => $payment->attributesToArray()['internal_reference']];

        $responseQuery = (new WebcheckoutService())->query($data);

        if ($responseQuery['refunded'] == true) {
            $payment->reverse = 'true';
        } else {
            $payment->reverse = 'false';
        }

        $payment->save();

        return redirect(route('payment.index'));

    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect(route('payment.index'));
    }

    public function import(Request $request)
    {
        $payments = Excel::toCollection(new ReversesImport(), $request->file('payments'));

        foreach ($payments[0] as $payment) {
            $process = new Payment();

            $data = [
                'payment' => [
                    'reference' => 'TEST_1000',
                    'description' => 'Conexion con WebCheckout desde un test',
                    'amount' => [
                        'currency' => 'COP',
                        'total' => '50000',
                    ]
                ],
                "instrument" => [
                    "card" => [
                        "number" => $payment[0],
                        "expiration" => "12/20",
                        "cvv" => "123",
                        "installments" => 2
                    ]
                ]
            ];

            $response = (new WebcheckoutService())->process($data);

            $process->internal_reference = $response['internalReference'];
            $process->status = $response['status']['status'];

            if ($response['refunded'] == true) {
                $process->reverse = 'true';
            } else {
                $process->reverse = 'false';
            }
            $process->save();
        }

        return redirect(route('payment.index'))->with('succes', 'All good');
    }

    public function reverse(Request $request)
    {
        $payments = Excel::toCollection(new ReversesImport(), $request->file('payments'));

        foreach ($payments[0] as $payment) {

            $data = [
                "internalReference" => $payment[0],
                "authorization" => $payment[1],
                "action" => "reverse"
            ];

            $response = (new WebcheckoutService())->transaction($data);

            $data = ['internalReference' => $payment[0]];

            $responseQuery = (new WebcheckoutService())->query($data);

            if ($responseQuery['refunded'] == true) {
                $refunded = 'true';
            } else {
                $refunded = 'false';
            }

            Payment::where('internal_reference', $payment[0])->update([
                'status' => $responseQuery['status']['status'],
                'reverse' => $refunded
            ]);
        }
        return redirect()->route('payment.index')->with('info', 'Importación realizada con éxito');
    }
}
