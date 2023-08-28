<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Component\SwalAlertTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OwenIt\Auditing\Models\Audit;

class Login extends Component
{
    use SwalAlertTrait;
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:5|max:20',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function login(){
        $this->validate();
        try {
            $credential = ['email' => $this->email, 'password'=> $this->password, 'status_active' => 1];
            if(Auth::attempt($credential)){
                    $data = [
                        'auditable_id' => auth()->user()->id,
                        'user_type' => "App\Models\User",
                        'auditable_type' => "App\Models\User",
                        'event'      => "Logged In",
                        'url'        => request()->fullUrl(),
                        'ip_address' => request()->getClientIp(),
                        'user_agent' => request()->userAgent(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'user_id'          => auth()->user()->id,
                    ]; 
                 Audit::create($data);
                $this->alertSwal('success', 'Login Successfully');
                return redirect()->route('home');
            }else{
                $this->alertSwal('warning', 'Login Failed, Email or password failed or user is non active');
            }
        } catch (\Exception $e){

            $this->alertSwal('error', $e->getMessage());
            // return session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        $title = "Login";
        return view('livewire.auth.login', compact('title'));
    }
}
