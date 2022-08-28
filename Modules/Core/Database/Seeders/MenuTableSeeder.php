<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::create([
            'name' => 'main',
            'type' => 'blade',
            'url' => '/',
            'target' => '',
            'menu_title' => 'Home',
            'parent_id' => 0,
            'custom_class' => '',
            'sort_order' => 0,
            'view' => 1
        ]);
    }
}
