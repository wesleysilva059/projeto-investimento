<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'cpf' 			=> '05914918691',
			'name' 			=> 'Wesley Silva',
			'phone' 		=> '35999759812',
			'birth' 		=> '19821111',
			'gender' 		=> 'M',
			'email' 		=> 'wesley3@ataio.com.br',
			'password' 		=> env('PASSWORD_HASH') ? bcrypt('123456') : '123456'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
