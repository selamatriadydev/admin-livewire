<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $title = "Home";
        return view('livewire.admin.home', compact('title'));
    }
}
