<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Header extends Component
{
    public $name_user, $role_user;

    public function mount(){
        $this->name_user = auth()->user()->name;
        $this->role_user = auth()->user()->role_name;
    }
    public function render()
    {
        return view('livewire.component.header');
    }
}
