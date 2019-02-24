<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();

        $AdminRole = Role::create(['name'=>'Admin']);
        $UserRole = Role::create(['name'=>'User']);

        $Admin = new User;
        $Admin->name = 'Alexandre';
        $Admin->email = 'alexandre_franca@hotmail.com';
        $Admin->password = bcrypt('123456');
        $Admin->departamento_id = '1';
		$Admin->arquivo_id = NULL;
        $Admin->save();
        $Admin->assignRole($AdminRole);
    
        $Usuario1 = new User;
        $Usuario1->name = 'Andre';
        $Usuario1->email = 'andre@hotmail.com';
        $Usuario1->password = bcrypt('123456');
        $Usuario1->departamento_id = '2';
        $Admin->arquivo_id = NULL;
		$Usuario1->save();
        $Usuario1->assignRole($UserRole);

        $Usuario2 = new User;
        $Usuario2->name = 'Fabricio';
        $Usuario2->email = 'fabricio@hotmail.com';
        $Usuario2->password = bcrypt('123456');
        $Usuario2->departamento_id = '3';
        $Admin->arquivo_id = NULL;
		$Usuario2->save();
        $Usuario2->assignRole($AdminRole);
        
        $Usuario3 = new User;
        $Usuario3->name = 'Fabio';
        $Usuario3->email = 'fabio@hotmail.com';
        $Usuario3->password = bcrypt('123456');
        $Usuario3->departamento_id = '2';
        $Admin->arquivo_id = NULL;
		$Usuario3->save();
        $Usuario3->assignRole($UserRole);
        
        $Usuario4 = new User;
        $Usuario4->name = 'Cida';
        $Usuario4->email = 'cida@hotmail.com';
        $Usuario4->password = bcrypt('123456');
        $Usuario4->departamento_id = '2';
        $Admin->arquivo_id = NULL;
		$Usuario4->save();
        $Usuario4->assignRole($UserRole);
    
    }
}
