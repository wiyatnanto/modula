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
                'name'=>'Pressure Transmitter',
                'slug'=>'pressure-transmitter',
                'order_menu'=>3,
                'status'=>1
            ],
            [
                'name'=>'Calibrator',
                'slug'=>'calibrator',
                'order_menu'=>1,
                'status'=>1
            ],
            [
                'name'=>'Industrial Network Serial Converter',
                'slug'=>'industrial-network-serial-converter',
                'order_menu'=>5,
                'status'=>1
            ],
            [
                'name'=>'Power Meter KWH Meter',
                'slug'=>'power-meter-kwh-meter',
                'order_menu'=>2,
                'status'=>1
            ],
            [
                'name'=>'Industrial Digital Process Controller & Indicator',
                'slug'=>'industrial-digital-process-controller-indicator',
                'order_menu'=>4,
                'status'=>1
            ],
            [
                'name'=>'Temperature Sensor / Controller',
                'slug'=>'temperature-sensor-controller',
                'order_menu'=>6,
                'status'=>1
            ],
            [
                'name'=>'Timbangan Weighing Controller/ Indicator & Load cell Sensor',
                'slug'=>'timbangan-weighing-controller-indicator-load-cell-sensor',
                'order_menu'=>12,
                'status'=>1
            ],
            [
                'name'=>'Differential Pressure Transmitter',
                'slug'=>'differential-pressure-transmitter',
                'order_menu'=>7,
                'status'=>1
            ],
            [
                'name'=>'Temperature Transmitter',
                'slug'=>'temperature-transmitter',
                'order_menu'=>8,
                'status'=>1
            ],
            [
                'name'=>'Water Analyzer',
                'slug'=>'water-analyzer',
                'order_menu'=>9,
                'status'=>1
            ],
            [
                'name'=>'Flowmeter',
                'slug'=>'flowmeter',
                'order_menu'=>10,
                'status'=>1
            ],
            [
                'name'=>'Pressure Gauge',
                'slug'=>'pressure-gauge',
                'order_menu'=>11,
                'status'=>1
            ],
            [
                'name'=>'Testing',
                'slug'=>'testing',
                'order_menu'=>0,
                'status'=>1,
            ]
        ]);
        // $this->call("OthersTableSeeder");
    }
}
