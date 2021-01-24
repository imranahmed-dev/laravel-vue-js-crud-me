<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User;
        $data->name = 'Imran';
        $data->email = 'admin@gmail.com';
        $data->password = bcrypt('admin123');
        $data->save();
    }
}
