<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class PaymentImport implements ToModel
{
    public function model(array $row)
    {
        return [$row];
//        return new Product([
//            'photo' => 'images/products/defaultFile.jpeg',
//            'name' => $row['name'],
//            'description' => $row['description'],
//            'price' => $row['price'],
//            'available' => $row['available'],
//        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:25|alpha_num',
            'description' => 'required|min:3|max:225|alpha_num',
            'price' => 'required|alpha_num|integer',
            'available' => 'required|integer',
        ];
    }

    public function uniqueBy(): string
    {
        return 'name';
    }
}
