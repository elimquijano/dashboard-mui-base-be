<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder {
    public function run(): void {
        User::create(['first_name' => 'Elim', 'last_name' => 'Quijano', 'email' => 'elim@gmail.com', 'password' => Hash::make('123456')])->assignRole('Super Admin');
    }
}
