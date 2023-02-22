<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) { 
            $table->string('handle')->nullable()->after('name');
        });
            $products = App\Models\Product::all();
            
            foreach ($products as $product) {
                $product->handle = str_replace(' ', '-', $product->name);
                $product->save();
            }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('handle');
        });
    }
};