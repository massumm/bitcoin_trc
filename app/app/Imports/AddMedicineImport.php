<?php

namespace App\Imports;

use App\Models\AddMedicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AddMedicineImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $importModel = new AddMedicine([

            "title" => $row['title'],
            "image" => $row['image'],
            "status" => $row['status'],
            "category" => $row['category'],
            "brand" => $row['brand'],
            "description" => $row['description'],
            "created_by" => $row['created_by']


         ]);

        return $importModel;
    }
}
