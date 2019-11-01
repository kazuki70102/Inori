<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = [
            'user_id' => 1,
            'department' => '機械工学類',
            'grade' => '3年生',
        ];
        DB::table('profiles')->insert($profile);
    }
}
