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
        $this->sidebarItems = Module::parentModul()->where('is_sidebar', 1)->orderBy('sort', 'ASC')->get()->map(function($data){
            $childData = $data->childModule()->where('is_sidebar', 1)->get()->map(function($child){
                return [
                    'title' => $child->title,
                    'url' => $child->url,
                    'icon' => $child->icon,
                    'method' => $child->method,
                ];
            })->toArray();
            return [
                'title' => $data->title,
                'url' => $data->url,
                'icon' => $data->icon,
                'method' => $data->method,
                'is_child' => $childData ? true : false,
                'child_data' => $childData,
                'method_data' => $data->child ? explode(',', $data->child) : [],
            ];
        })->toArray();
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
