<?php

namespace App\Http\Livewire\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OwenIt\Auditing\Models\Audit;

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
                $data = [
                    'auditable_id' => auth()->user()->id,
                    'auditable_type' => "Logged In",
                    'event'      => "Logged In",
                    'url'        => request()->fullUrl(),
                    'ip_address' => request()->getClientIp(),
                    'user_agent' => request()->userAgent(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'user_id'          => auth()->user()->id,
                ];
                //create audit trail data
                $details = Audit::create($data);
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
