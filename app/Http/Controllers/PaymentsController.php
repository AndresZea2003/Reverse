<?php

namespace App\Http\Controllers;

use App\Exports\PaymentsExport;
use App\Http\Requests\Payments\StoreRequest;
use App\Imports\PaymentsImport;
use App\Imports\ReversesImport;
use App\Models\Payment;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PaymentsController extends Controller
{
    public function index(): View
    {
//        $payments = Payment::paginate(10);
        $payments = Payment::all();
        $count = Payment::all()->where('id')->count();
        return view('payments.index', compact('payments', 'count'));
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
            $payment->amount = $response['amount']['total'];
            $payment->currency = $response['amount']['currency'];

            if ($response['refunded'] == true) {
                $payment->reverse = 'true';
            } else {
                $payment->reverse = 'false';
            }

            $payment->save();

            $i++;

        }

        return redirect(route('payment.index'))->with('success', 'Se importaron ' . $i . ' pagos correctamente');;
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

        $count = 0;

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

            if ($payment[1] === null) {
                $response = (new WebcheckoutService())->process($data);
                $process->login = config('webcheckout.login');
                $process->secret_key = config('webcheckout.secretKey');
                $process->url = config('webcheckout.url');
            } else {
                $login = $payment[1];
                $secretKey = $payment[2];
                $url = $payment[3];
                $response = (new WebcheckoutService())->processAuth($data, $login, $secretKey, $url);

                $process->login = $payment[1];
                $process->secret_key = $payment[2];
                $process->url = $payment[3];
            }

            $process->internal_reference = $response['internalReference'];
            $process->status = $response['status']['status'];
            $process->amount = $response['amount']['total'];
            $process->currency = $response['amount']['currency'];

            if ($response['refunded'] == true) {
                $process->reverse = 'true';
            } else {
                $process->reverse = 'false';
            }
            $process->save();
            $count++;
        }

        return redirect(route('payment.index'))->with('success', 'Se importaron ' . $count . ' pagos correctamente');
    }

    public function reverse(Request $request)
    {
        $payments = Excel::toCollection(new ReversesImport(), $request->file('payments'));

        foreach ($payments[0] as $payment) {

            $data = [
                "internalReference" => $payment[1],
                "authorization" => '000000',
                "action" => "reverse"
            ];

            if ($payment[6] === null) {
                $response = (new WebcheckoutService())->transaction($data);
            } else {
                $login = $payment[6];
                $secretKey = $payment[7];
                $url = $payment[8];
                $response = (new WebcheckoutService())->transactionAuth($data, $login, $secretKey, $url);
            }

            if ($response['status']['status'] == 'APPROVED') {
                $refunded = 'true';
            } else {
                $refunded = 'false';
            }

            Payment::where('internal_reference', $payment[1])->update([
                'reverse' => $refunded
            ]);
        }
        return redirect()->route('payment.index')->with('success', 'Reverso realizado correctamente');
    }

    public function processAuth(Request $request)
    {
        $payments = Excel::toCollection(new ReversesImport(), $request->file('payments-auth'));

        foreach ($payments[0] as $payment) {

            $login = $payment[0];

            $secretKey = $payment[1];

            $url = $payment[2];

            $process = new Payment();

            $data = [
                'payment' => [
                    'reference' => 'TEST_1000',
                    'description' => 'Conexion con WebCheckout desde un test',
                    'amount' => [
                        'currency' => 'USD',
                        'total' => '50000',
                    ]
                ],
                "instrument" => [
                    "card" => [
                        "number" => '36545400000008',
                        "expiration" => "12/20",
                        "cvv" => "123",
                        "installments" => 2
                    ]
                ]
            ];

            $response = (new WebcheckoutService())->processAuth($data, $login, $secretKey, $url);

            $process->internal_reference = $response['internalReference'];
            $process->status = $response['status']['status'];
            $process->amount = $response['amount']['total'];
            $process->currency = $response['amount']['currency'];

            if ($response['refunded'] == true) {
                $process->reverse = 'true';
            } else {
                $process->reverse = 'false';
            }
            $process->save();
        }

        return redirect(route('payment.index'))->with('succes', 'All good');
    }

    public function export()
    {
        return Excel::download(new PaymentsExport(), 'payments.xlsx');
    }
}
