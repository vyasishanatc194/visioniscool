<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        $users = ['0' => [
                'name' => 'Will Grant',
                'first_name' => 'Will',
                'last_name' => 'Grant',
				'status'=>'active',
				'email'=>'getvision@willgrantvision.com',
				'password'=>'8932()*&^',
				'role'=>'AU',
				'utype'=>'admin',
				'verified'=>1,
            ]];
        foreach ($users as $value)
        {
			$user = User::whereEmail($value['email'])->first();
			if(!$user){ $user = new User(); }
            
			$user->email=$value['email'];
			$user->first_name=$value['first_name'];
			$user->last_name=$value['last_name'];
			$user->status=$value['status'];
			
			$user->password=bcrypt($value['password']);
			$user->save();
            $user->assignRole('superadmin');
			
        }

        
    }
}
