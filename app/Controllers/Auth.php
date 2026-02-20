<?php

namespace App\Controllers;

class Auth extends BaseController
{
    /**
     * Autoload helpers used by the auth views.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url'];

    public function show(): string
    {
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

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Replace this block with real credential lookup (database or API) when ready.
        $isDemoUser = $email === 'demo@oabs.local' && $password === 'demo123';

        if (! $isDemoUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid credentials. Use demo@oabs.local / demo123 to explore the app.');
        }

        session()->set('user', ['email' => $email]);

        return redirect()->to('/')->with('success', 'Welcome back! You are signed in.');
    }
}
