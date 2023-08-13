<?php

namespace App\Http\Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Module;
use Livewire\Component;

class Sidebar extends Component
{
    public $sidebarItems;
    public $isExpanded = false;
    public $activeSidebar ='dashboard';
    public function mount(){
        if(Request::segment(1)){
            $this->activeSidebar = Request::segment(1);
        }
        $this->sidebarItems = auth()->user()->allMenus;
        // dd(auth()->user()->allMenus);
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
