<?php

namespace App\Imports;

use App\Models\product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{

    protected $existingProducts;

    public function __construct()
    {
        $this->existingProducts = DB::table('products')->pluck('name');
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
   
        $name = $row['name'];

        if ($this->existingProducts->contains($name)) {
            return null;
        }

        return new product([
            "name" => $name,
            "price" => $row['price'],
            "category" => $row['category'],
            "image" => $row['image']
        ]);
    }
}