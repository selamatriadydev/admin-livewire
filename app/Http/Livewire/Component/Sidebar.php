<?php

namespace App\Http\Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Module;
use Livewire\Component;

class Sidebar extends Component
{
    public $sidebarItems;
    public $sidebarVisible = false;
    public $activeSidebar ='dashboard';
    protected $listeners = ['sidebarVisibleChanged' => 'updateSidebarVisibility'];
    public function mount(){
        if(Request::segment(1)){
            $this->activeSidebar = Request::segment(1);
        }
        $this->sidebarItems = auth()->user()->allMenus;
        // dd(auth()->user()->allPermissions);
    }
    public function updateSidebarVisibility($visible)
    {
        $this->sidebarVisible = $visible;
    }
    public function render()
    {
        return view('livewire.component.sidebar');
    }
}
