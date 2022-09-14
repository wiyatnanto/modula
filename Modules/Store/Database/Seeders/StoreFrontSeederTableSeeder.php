<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class StoreFrontSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('store_storefronts')->insert([
            [
                'name'=>'Pria',
                'slug'=>'pria',
                'order_menu'=>3,
                'status'=>1
            ],
            [
                'name'=>'Wanita',
                'slug'=>'wanita',
                'order_menu'=>1,
                'status'=>1
            ]
        ]);
        // $this->call("OthersTableSeeder");
    }
}
