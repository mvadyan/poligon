<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@gmail.com1',
                'password' => bcrypt(Str::random(16)),
            ],
            [
                'name' => 'Автор1',
                'email' => 'author1@gmail.com1',
                'password' => bcrypt('123123'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
