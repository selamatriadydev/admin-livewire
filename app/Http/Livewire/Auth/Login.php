<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];
    public function login(){
        $this->validate();
        try {
            $credential = ['email' => $this->email, 'password'=> $this->password];
            if(Auth::attempt($credential)){
                return redirect()->route('home');
            }else{
              return  session()->flash('error', 'Alamat Email atau Password Anda salah!.');
            }
        } catch (\Exception $e){
            return session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        $title = "Login";
        return view('livewire.auth.login', compact('title'));
    }
}
