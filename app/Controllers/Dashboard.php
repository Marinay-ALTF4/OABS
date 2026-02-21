<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $user = session('user');

        if (! $user) {
            return redirect()->to('/login')->with('error', 'Please sign in to continue.');
        }

        return view('dashboard', ['user' => $user]);
    }
}
