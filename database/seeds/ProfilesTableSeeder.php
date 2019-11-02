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
            'introduction' => 'はじめましてこんにちは'
        ];
        $profile2 = [
            'user_id' => 2,
            'department' => '電子情報学類',
            'grade' => '1年生',
            'introduction' => 'はじめましてこんばんは'
        ];
        $profile3 = [
            'user_id' => 3,
            'department' => '経済学類',
            'grade' => '2年生',
            'introduction' => 'はじめましておはよう'
        ];
        DB::table('profiles')->insert($profile);
        DB::table('profiles')->insert($profile2);
        DB::table('profiles')->insert($profile3);
    }
}
