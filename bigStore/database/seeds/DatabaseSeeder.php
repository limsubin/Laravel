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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}
/*이제 데이터베이스를 시드하라는 명령을 실행하면
 DatabaseSeeder클래스가 호출되고 클래스를 호출 하여 우리가
  실행하도록 설정 한 시드 클래스를 호출 run합니다*/