<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\Permission;
use Livewire\Component;

class PermissionModul extends Component
{
    use OffCanvasTrait;
    use SwalAlertTrait;

    public $modulSlug, $name, $data_id, $permission;
    public $actCreate= true, $actUpdate= true, $actDelete=true, $actDetail = false;

    // protected $listeners = [
    //     'getCreatePermis' => 'showCreatePermis'
    // ];

    public function rules()
    {
        $rules = [
            'name' => 'required|unique:modules,title',
        ];
        if ($this->activeOffcanvasAction == 'update') {
            $rules['name'] .= ',' . $this->data_id;
        }
        return $rules;
    }
    public function mount(){
        $this->activeOffcanvasAction = 'storePermission';
        $this->permission =  Permission::get();
        $this->OffcanvasForm = [
            ['title' => 'Name', 'type' => 'text', 'model' => 'name'],
        ];
    }

    public function updated($propertyName)
    {
      $this->validateOnly($propertyName);
    }
    private function resetInputFields(){
        $this->modulSlug = '';
        $this->data_id = '';
        $this->name = '';
    }
    public function createPermis($slug_modul){
        $this->modulSlug = $slug_modul;
        $this->activeOffcanvasAction = 'storePermission';
        $this->opencOffcanvas();
    }

    public function storePermission()
    {
        $validatedData = $this->validate();
        $permission = Permission::create($validatedData);
        $this->resetInputFields();
        $this->emit('permissionStored', $permission);
    }
    
    public function render()
    {
        return view('livewire.settings.permission-modul');
    }

}
