<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminUsers extends BaseController
{
    public function create(): ResponseInterface|string
    {
        if (! $this->isAdmin()) {
            return redirect()->to('/login')->with('error', 'Admin access required.');
        }

        return view('admin/add_user');
    }

    public function store()
    {
        if (! $this->isAdmin()) {
            return redirect()->to('/login')->with('error', 'Admin access required.');
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[admin,client]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = trim((string) $this->request->getPost('name'));
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $model = new UserModel();
        $model->insert([
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    private function isAdmin(): bool
    {
        $user = session('user');
        return $user && ($user['role'] ?? '') === 'admin';
    }
}
