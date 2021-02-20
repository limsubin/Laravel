<?php

use Illuminate\Database\Seeder;
use App\Myboard; //(두번째 방법) , 둘 중 하나 골라서 사용하기

class MyboardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Myboard::create([ //App\Myboard::create : 절대경로 (첫번째 방법)
            'Writer' => 'scpark',
            'Title' => '안녕',
            'Content' => '안녕 라라벨'
        ]);
    }
}
