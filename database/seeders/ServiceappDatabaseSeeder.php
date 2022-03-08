<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServiceappDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            ['app_name', 'Service-Apps'],
        ];

        for ($i=0;$i<count($setting);$i++)
        {
            DB::table('entity__settings')->insert(
                [
                    'setting_name' => $setting[$i][0],
                    'setting_value' => $setting[$i][1]
                ]
            );
        }

        DB::table('entity__users')->insert(
            [
                'user_name' => 'admin',
                'user_pass' => Hash::make('admin'),
                'user_fullname' => 'Muhammad Arif Muntaha',
                'user_address' => 'Jepara - Indonesia',
                'user_image' => '',
            ]
        );
    }
}
