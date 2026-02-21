<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
            ],
            [
                'name' => 'Client',
                'email' => 'client@example.com',
                'password_hash' => password_hash('client123', PASSWORD_DEFAULT),
                'role' => 'client',
            ],
        ];

        $model = new UserModel();
        $model->insertBatch($users);
    }
}
