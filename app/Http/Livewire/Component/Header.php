<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Header extends Component
{
    public $name_user, $role_user;
    public $sidebarVisible = false;
    public $themeAppLight = true;
    public $themeAppIcon = 'sun';
    // public $themeAppText = 'light';
    public function mount(){
        $this->name_user = auth()->user()->name;
        $this->role_user = auth()->user()->role_name;
    }

    public function toggledSidebar()
    {
        $this->sidebarVisible = !$this->sidebarVisible;
        $this->emit('sidebarVisibleChanged', $this->sidebarVisible);
    }
    public function toggledThemeApp()
    {
        $this->themeAppLight = !$this->themeAppLight;
        if($this->themeAppLight){
            $this->themeAppIcon = 'sun';
        }else{
            $this->themeAppIcon = 'moon';
        }
        $this->emit('toggledThemeAppChange', $this->themeAppLight);
    }
    public function logout(){
        Cache::forget('is_online'.Auth::user()->id);
        Auth::logout();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.component.header');
    }
}
