<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class CategorySeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('store_categories')->insert([
            [
                'name'=>'Alat Ukur Industri',
                'slug'=>'alat-ukur-industri',
                'description'=>NULL,
                'parent_id'=>1,
                'featured'=>0,
                'menu'=>1,
                'menu_level'=>2,
                'order_menu'=>0,
                'image'=>NULL,
                'status'=>1,
                'created_at'=>'2021-12-08 20:44:57',
                'updated_at'=>'2021-12-08 20:45:54'
            ]
        ]);
    }
}
