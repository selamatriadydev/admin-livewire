<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $name_user, $role_user;
    public $sidebarVisible = false;
    public function mount(){
        $this->name_user = auth()->user()->name;
        $this->role_user = auth()->user()->role_name;
    }

    public function toggledSidebar()
    {
        $this->sidebarVisible = !$this->sidebarVisible;
        $this->emit('sidebarVisibleChanged', $this->sidebarVisible);

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.component.header');
    }
}
