<?php

namespace App\Http\Controllers;

use App\Imports\PaymentImport;
use App\Jobs\PaymentJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    //
    public function import(Request $request)
    {
        $yep = Excel::toCollection(new PaymentImport(), $request->file('payment'));
//        dd('Fila 1 :' . $yep[0][0],
//        'Fila 2 :'. $yep[0][1]);

        foreach ($yep[0] as $payment) {
            PaymentJob::dispatch($payment[0], $payment[1]);
        }

        dd('stop');
        return redirect(route('imports'))->with('succes', 'All good');
    }
}
