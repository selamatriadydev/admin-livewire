<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    use SwalAlertTrait;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|email',
        'email' => 'required|unique:users,email',
        'password' => 'required|confirmed',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function register(){
        $this->validate();
        try {
            $userExist = User::where('email', $this->email)->exists();
            if($userExist){
                $this->alertSwal('warning', 'Register Gagal, '.$this->email.' sudah terdaftar');
            }else{
                User::create([
                    'name'      => $this->name,
                    'email'     => $this->email,
                    'password'  => bcrypt($this->password)
                ]);
                $this->alertSwal('success', 'Register Berhasil');
                // return redirect()->route('auth.login');
                return redirect()->to('/');
            }
        } catch (\Throwable $e) {
            $this->alertSwal('error', $e->getMessage());
            // return session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        $title = "Register";
        return view('livewire.auth.register', compact('title'));
    }
}
