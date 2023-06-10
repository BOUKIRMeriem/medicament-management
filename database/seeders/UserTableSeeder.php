<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'telephone' => '0123456789',
            'role' => 'admin',
            'mot_de_passe' => bcrypt('mot_de_passe'),
        ]);
    }
}
