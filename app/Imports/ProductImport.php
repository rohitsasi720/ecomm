<?php

namespace App\Imports;

use App\Models\product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue

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

        $handle = Str::slug($name);
        
        return new product([
            "name" => $name,
            "price" => $row['price'],
            "category" => $row['category'],
            "image" => $row['image'],
            "handle" => $handle
        ]);
    }

    // public function batchSize(): int
    // {
    //     return 10;
    // }

    public function chunkSize(): int
    {
        return 10;
    }

}