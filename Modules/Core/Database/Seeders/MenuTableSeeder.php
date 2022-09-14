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
            'id' => 12,
            'name' => 'main',
            'type' => 'page',
            'url' => '/p/home-page',
            'target' => '',
            'menu_title' => 'Home Page',
            'parent_id' => 0,
            'sort_order' => '0',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 02:48:03',
            'updated_at' => '2022-09-02 14:02:49',
        ]);

        Menu::create([
            'id' => 18,
            'name' => 'main',
            'type' => 'custom',
            'url' => '/produk',
            'target' => '',
            'menu_title' => 'Produk',
            'parent_id' => 0,
            'sort_order' => '1',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 03:48:10',
            'updated_at' => '2022-09-02 14:02:49',
        ]);

        Menu::create([
            'id' => 20,
            'name' => 'main',
            'type' => 'custom',
            'url' => '/produk/softlense',
            'target' => '',
            'menu_title' => 'Softlense',
            'parent_id' => 18,
            'sort_order' => '0',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 03:49:08',
            'updated_at' => '2022-09-02 14:02:49',
        ]);

        Menu::create([
            'id' => 19,
            'name' => 'main',
            'type' => 'custom',
            'url' => '/produk/kaca-mata',
            'target' => '',
            'menu_title' => 'Kacamata',
            'parent_id' => 18,
            'sort_order' => '1',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 03:48:40',
            'updated_at' => '2022-09-02 14:02:49',
        ]);

        Menu::create([
            'id' => 16,
            'name' => 'main',
            'type' => 'category',
            'url' => '/category/contoh-kategori',
            'target' => '',
            'menu_title' => 'Contoh Kategori',
            'parent_id' => 19,
            'sort_order' => '0',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 02:57:31',
            'updated_at' => '2022-09-02 14:02:53',
        ]);

        Menu::create([
            'id' => 13,
            'name' => 'main',
            'type' => 'custom',
            'url' => '/blog',
            'target' => '',
            'menu_title' => 'Blog',
            'parent_id' => 0,
            'sort_order' => '2',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 02:48:34',
            'updated_at' => '2022-09-02 14:02:53',
        ]);

        Menu::create([
            'id' => 17,
            'name' => 'main',
            'type' => 'page',
            'url' => '/p/kontak',
            'target' => '',
            'menu_title' => 'Kontak',
            'parent_id' => 0,
            'sort_order' => '3',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-02 02:59:08',
            'updated_at' => '2022-09-02 14:02:53',
        ]);

        Menu::create([
            'id' => 34,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/store/brands',
            'target' => '',
            'menu_title' => 'Brand',
            'parent_id' => 0,
            'sort_order' => '6',
            'custom_class' => '',
            'icon' => 'far fa-star',
            'view' => 't',
            'created_at' => '2022-09-05 01:04:21',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 38,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/store/categories',
            'target' => '',
            'menu_title' => 'Categories',
            'parent_id' => 0,
            'sort_order' => '7',
            'custom_class' => '',
            'icon' => 'far fa-list',
            'view' => 't',
            'created_at' => '2022-09-05 01:22:01',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 39,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/store/storefronts',
            'target' => '',
            'menu_title' => 'Store Fronts',
            'parent_id' => 0,
            'sort_order' => '8',
            'custom_class' => '',
            'icon' => 'far fa-cabinet-filing',
            'view' => 't',
            'created_at' => '2022-09-05 01:22:22',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 3,
            'name' => 'backend',
            'type' => 'separator',
            'url' => '#',
            'target' => '',
            'menu_title' => 'Blog',
            'parent_id' => 0,
            'sort_order' => '9',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-05 03:31:30',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 4,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/blog/pages',
            'target' => '',
            'menu_title' => 'Page',
            'parent_id' => 0,
            'sort_order' => '10',
            'custom_class' => '',
            'icon' => 'far fa-file',
            'view' => 't',
            'created_at' => '2022-09-05 03:32:14',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 31,
            'name' => 'backend',
            'type' => 'separator',
            'url' => '#',
            'target' => '',
            'menu_title' => 'Store',
            'parent_id' => 0,
            'sort_order' => '4',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-05 01:01:02',
            'updated_at' => '2022-09-05 08:19:00',
        ]);

        Menu::create([
            'id' => 32,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/store/products',
            'target' => '',
            'menu_title' => 'Products',
            'parent_id' => 0,
            'sort_order' => '5',
            'custom_class' => '',
            'icon' => 'far fa-store',
            'view' => 't',
            'created_at' => '2022-09-05 01:01:24',
            'updated_at' => '2022-09-05 08:19:00',
        ]);

        Menu::create([
            'id' => 5,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/blog/posts',
            'target' => '',
            'menu_title' => 'Posts',
            'parent_id' => 0,
            'sort_order' => '11',
            'custom_class' => '',
            'icon' => 'far fa-paper-plane',
            'view' => 't',
            'created_at' => '2022-09-05 03:32:40',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 7,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/blog/categories',
            'target' => '',
            'menu_title' => 'Categories',
            'parent_id' => 0,
            'sort_order' => '12',
            'custom_class' => '',
            'icon' => 'far fa-list',
            'view' => 't',
            'created_at' => '2022-09-05 03:33:19',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 8,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/blog/tags',
            'target' => '',
            'menu_title' => 'Tags',
            'parent_id' => 0,
            'sort_order' => '13',
            'custom_class' => '',
            'icon' => 'far fa-tags',
            'view' => 't',
            'created_at' => '2022-09-05 03:33:46',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 23,
            'name' => 'backend',
            'type' => 'separator',
            'url' => '#',
            'target' => '',
            'menu_title' => 'Admin',
            'parent_id' => 0,
            'sort_order' => '14',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-05 00:48:31',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 24,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/auth/users',
            'target' => '',
            'menu_title' => 'Users',
            'parent_id' => 0,
            'sort_order' => '15',
            'custom_class' => '',
            'icon' => 'far fa-user',
            'view' => 't',
            'created_at' => '2022-09-05 00:49:20',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 25,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/auth/roles',
            'target' => '',
            'menu_title' => 'Role',
            'parent_id' => 0,
            'sort_order' => '16',
            'custom_class' => '',
            'icon' => 'far fa-user-tag',
            'view' => 't',
            'created_at' => '2022-09-05 00:49:35',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 26,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/auth/permissions',
            'target' => '',
            'menu_title' => 'Permission',
            'parent_id' => 0,
            'sort_order' => '17',
            'custom_class' => '',
            'icon' => 'far fa-user-shield',
            'view' => 't',
            'created_at' => '2022-09-05 00:49:43',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 30,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/core/menu',
            'target' => '',
            'menu_title' => 'Menu',
            'parent_id' => 0,
            'sort_order' => '18',
            'custom_class' => '',
            'icon' => 'far fa-bars',
            'view' => 't',
            'created_at' => '2022-09-05 00:50:58',
            'updated_at' => '2022-09-12 16:19:07',
        ]);

        Menu::create([
            'id' => 11,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/chat',
            'target' => '',
            'menu_title' => 'Chat',
            'parent_id' => 0,
            'sort_order' => '2',
            'custom_class' => '',
            'icon' => 'fal fa-comments-alt',
            'view' => 't',
            'created_at' => '2022-09-05 08:18:46',
            'updated_at' => '2022-09-05 08:19:02',
        ]);

        Menu::create([
            'id' => 10,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/survey',
            'target' => '',
            'menu_title' => 'Survey',
            'parent_id' => 0,
            'sort_order' => '3',
            'custom_class' => '',
            'icon' => 'far fa-poll',
            'view' => 't',
            'created_at' => '2022-09-05 04:12:41',
            'updated_at' => '2022-09-05 08:19:02',
        ]);

        Menu::create([
            'id' => 21,
            'name' => 'backend',
            'type' => 'custom',
            'url' => '/dashboard',
            'target' => '',
            'menu_title' => 'Dashboard',
            'parent_id' => 0,
            'sort_order' => '1',
            'custom_class' => '',
            'icon' => 'far fa-analytics',
            'view' => 't',
            'created_at' => '2022-09-05 00:36:18',
            'updated_at' => '2022-09-05 03:59:05',
        ]);

        Menu::create([
            'id' => 9,
            'name' => 'backend',
            'type' => 'separator',
            'url' => '#',
            'target' => '',
            'menu_title' => 'Main',
            'parent_id' => 0,
            'sort_order' => '0',
            'custom_class' => '',
            'icon' => '',
            'view' => 't',
            'created_at' => '2022-09-05 03:59:01',
            'updated_at' => '2022-09-05 03:59:01',
        ]);
    }
}
