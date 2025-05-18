<?php

namespace App\Imports;

use App\Models\MedicineListModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicineListImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $importModel = new MedicineListModel([

            "product_id" => $row['product_id'],
            "image" => $row['image'],
            "title" => $row['title'],
            "description" => $row['description'],
            "type" => $row['type'],
            "price" => $row['price'],
            "discount" => $row['discount'],
            "stock_status" => $row['stock_status'],
            "created_by" => $row['created_by']


         ]);

        return $importModel;
    }
}
