<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromQuery;

class PaymentsExport implements FromQuery
{
    public function __construct()
    {

    }

    public function query()
    {
        return Payment::query()/*->whereBetween('created_at', [
            $this->initialDate,
            $this->finalDate
        ])*/->where('status', false);
    }

    public function collection()
    {
        return Payment::all();
    }
}
