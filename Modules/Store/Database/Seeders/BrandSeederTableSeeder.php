<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class BrandSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('store_brands')->insert([
            [
                'name'=>'Ray Ban',
                'slug'=>'ray-ban',
                'image'=>'nbRCvklliF4TekadjQO0SdYDXO8okt60wdAlNXuh.jpg',
                'status'=>1,
                'created_at'=>'2021-12-07 05:41:41',
                'updated_at'=>'2021-12-15 23:33:01'
            ]
        ]);
    }
}
