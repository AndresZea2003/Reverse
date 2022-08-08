<?php

namespace App\Imports;

use App\Models\Payment;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PaymentsImport implements ToModel
{
    public function model(array $row)
    {
        return new Payment([
            'card' => $row[0]
        ]);
    }

    public function rules(): array
    {
        return [
            'internal_reference' => 'required|min:3|max:15|alpha_num',
//           'status' => ['required', Rule::in(['pending', 'in_progress', 'complete'])],
        ];
    }
}
