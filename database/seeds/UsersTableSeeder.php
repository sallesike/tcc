<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    User::Create([
	    	'name' 		=> 'Admin',
	    	'email' 	=> 'admin@pinhao.pr.gov.br',
	    	'password' 	=> bcrypt('10302012'),
	    	'status'	=> 'Admin',
	    	'cpf'		=> '010.010.010-10',
	    	'birthday' 	=> '2000-01-01',
	    ]);
    }
}
