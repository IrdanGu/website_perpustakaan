<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }

    public function proses(){
        $credentials = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);
        
         if (Auth::attempt($credentials)) {
            
            session()->regenerate();
            
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function keluar(): RedirectResponse
    {
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}