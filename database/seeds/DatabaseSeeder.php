<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'admin1@dammaynho.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('configs')->insert(array(
            [
                'key' => 'ALLOW_ALL',
                'value' => '1',
                'label' => 'Cho phép mọi người sử dụng',
                'type' => 'boolean'
            ],
            [
                'key' => 'BASE_URL',
                'label' => 'Đường dẫn máy chủ',
                'value'=> 'http://localhost:3000/',
                'type' => 'text'
            ]
        ));
    }
}
