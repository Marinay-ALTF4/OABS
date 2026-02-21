<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    /**
     * Autoload helpers used by the auth views.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url'];

    public function show(): ResponseInterface|string
    {
        if ($this->isAuthenticated()) {
            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    public function authenticate()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('email', $email)->first();

        $isValid = $user && password_verify($password, $user['password_hash']);

        if (! $isValid) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid credentials.');
        }

        session()->set('user', [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'role' => $user['role'],
        ]);

        return redirect()->to('/dashboard')->with('success', 'Welcome back!');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been signed out.');
    }

    private function isAuthenticated(): bool
    {
        return (bool) session('user');
    }
}
