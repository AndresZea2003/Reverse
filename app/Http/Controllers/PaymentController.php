<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::paginate(10);
        $count = Payment::all()->where('id')->count();
        return view('welcome', compact('payments', 'count'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
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
                    "number" => $request->input('cardNumber'),
                    "expiration" => "12/20",
                    "cvv" => "123",
                    "installments" => 2
                ]
            ]
        ];

        $response = (new WebcheckoutService())->process($data);

        $payment->internal_reference = $response['internalReference'];
        $payment->status = $response['status']['status'];

        if ($response['refunded'] == true)
        {
            $payment->reverse = 'true';
        }else
        {
            $payment->reverse = 'false';
        }

        $payment->save();

        return redirect(route('payment.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $process)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $process)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $process)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect(route('payment.index'));
    }
}
