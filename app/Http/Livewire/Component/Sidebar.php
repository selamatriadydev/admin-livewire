<?php

namespace App\Http\Livewire\Component;

use App\Models\Module;
use Livewire\Component;

class Sidebar extends Component
{
    public $sidebarItems;
    public $isExpanded = false;
    public function mount(){
        $this->sidebarItems = Module::get(); 
    }

    public function toggleSidebar()
    {
        $this->isExpanded = !$this->isExpanded;
    }
    public function render()
    {
        return view('livewire.component.sidebar');
    }
}
