<?php

namespace App\Imports;

use App\Models\Payment;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PaymentsImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
        return new Payment([
            'card' => $row[0],
            'login' => $row[1],
            'secretKey' => $row[2],
            'url' => $row[3]
        ]);
    }

    public function rules(): array
    {
        return [
            '*.0' => 'required|min:6|max:15|alpha_num',
            '*.1' => 'nullable',
            '*.2' => 'nullable',
            '*.3' => 'nullable'
        ];
    }
}
