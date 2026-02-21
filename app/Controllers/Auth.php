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

    public function showRegister(): ResponseInterface|string
    {
        if ($this->isAuthenticated()) {
            return redirect()->to('/dashboard');
        }

        return view('register');
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

    public function register()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = trim((string) $this->request->getPost('name'));
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        if (! $this->isValidName($name)) {
            return redirect()->back()->withInput()->with('error', 'Name can only contain letters, spaces, and ñ.');
        }

        if (! $this->emailWithinLimits($email)) {
            return redirect()->back()->withInput()->with('error', 'Email must have max 5 special characters and 8 digits.');
        }

        $model = new UserModel();
        $model->insert([
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'client',
        ]);

        return redirect()->to('/login')->with('success', 'Account created! Please sign in.');
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

    private function isValidName(string $name): bool
    {
        return (bool) preg_match('/^[A-Za-zñÑ\s]+$/', $name);
    }

    private function emailWithinLimits(string $email): bool
    {
        $specials = preg_match_all('/[^a-zA-Z0-9]/', $email);
        $digits = preg_match_all('/\d/', $email);
        return $specials <= 5 && $digits <= 8;
    }
}
