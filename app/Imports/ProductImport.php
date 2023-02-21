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
        $this->existingProducts = DB::table('products')->pluck('name', 'id');
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
            $id = $this->existingProducts->search($name);
            $name = $name . '-' . $id;
        }

        return new product([
            "name" => $name,
            "price" => $row['price'],
            "category" => $row['category'],
            "image" => $row['image']
        ]);
    }
}