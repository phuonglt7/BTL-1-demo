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
        $this->call(UserSeeder::class);
        //$this->call(PermissionSeeder::class);
      //  $this->call(DepartmentSeeder::class);
     
    }
}
class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'username'=>'thanhvien',
            'password'=>bcrypt('thanhvien'), 
            'email'=>'thanhvien@gmail.com', //str_random(3).'@gmail.com'
            'fullname'=>'admin',
            'address'=>'hn',
            'gender'=>'1',
            //'birthday'=>'20',
            'department_id'=>'2',
            'permission_id'=>'2'

        ]
        );
    }
}

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('permissions')->insert([
        	['permission_name'=>'admin'],
        	['permission_name'=>'quan ly'],
        	['permission_name'=>'nhan vien']
        ]
        );
    }
}

class DepartmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('departments')->insert([
        	['department_name'=>'nhan su'],
        	['department_name'=>'thiet ke'],
        	['department_name'=>'kinh doanh']
        ]
        );
    }
}
