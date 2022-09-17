<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call("OthersTableSeeder");
        for ($i=1; $i < 2000; $i++) { 
            DB::table('store_products')->insert( [
                'brand_id'=>1,
                'sku'=>'-',
                'name'=>'Nama Produk '.($i+1),
                'slug'=>'nama-produk',
                'description'=>'-',
                'quantity'=>1,
                'weight'=>10,
                'min_order'=>1,
                'price'=>1500000.00,
                'sale_price'=>NULL,
                'status'=>'t',
                'featured'=>'f',
                'created_at'=>'2022-09-16 12:40:57',
                'updated_at'=>'2022-09-16 12:40:57',
                'deleted_at'=>NULL
            ]);
       }
    }
}
