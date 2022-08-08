<?php

namespace App\Imports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ReversesImport implements ToModel
{
    public function model(array $row)
    {
        return new Payment([
           'internal_reference' => $row[0],
            'authorization' => $row[1]
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
