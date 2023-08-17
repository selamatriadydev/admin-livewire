<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required|confirmed',
    ];

    public function register(){
        $this->validate();
        try {
            $userExist = User::where('email', $this->email)->exists();
            if($userExist){
               return session()->flash('danger', 'Register Gagal, '.$this->email.' sudah terdaftar');
            }else{
                User::create([
                    'name'      => $this->name,
                    'email'     => $this->email,
                    'password'  => bcrypt($this->password)
                ]);
                session()->flash('success', 'Register Berhasil!.');
                // return redirect()->route('auth.login');
                return redirect()->to('/');
            }
        } catch (\Throwable $e) {
            return session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        $title = "Register";
        return view('livewire.auth.register', compact('title'));
    }
}
