<?php

use Illuminate\Database\Seeder;
use App\Infrastructure\Eloquent\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Users::class, 10);
    }
}
