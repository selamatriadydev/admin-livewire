<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role as ModelsRole;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name,$role_id, $actCreate= true, $actUpdate= true, $actDelete=true, $actDetail = false;
    public $updateMode = false;
    public $showOffcanvasAction = 'store';
    public $showOffcanvas = false;
    protected $listeners = ['roleStore' => 'hideOffcanvas', 'deleteData'];
    public $tableHead = ['Nama'];
    public $tableBody = ['name'];
    


    protected $rules = [
        'name' => 'required',
    ];

    private function resetInputFields(){
        $this->name = '';
    }
    public function toggleOffcanvas()
    {
        $this->showOffcanvas = !$this->showOffcanvas;
    }
    public function hideOffcanvas()
    {
        $this->showOffcanvas = false;
        $this->resetInputFields();
    }
    public function render()
    {
        $tableData = ModelsRole::paginate(10);
        return view('livewire.admin.role', compact('tableData'));
    }

    public function store(){
        $this->validate();
        try {
            ModelsRole::create(['name' => $this->name]);
            session()->flash('success', 'Users Created Successfully.');
            $this->hideOffcanvas();
            $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Role Created Successfully!', 
                'text' => 'It will list on users table soon.'
            ]);
        } catch (\Throwable $e) {
             session()->flash('error', $e->getMessage());
        }
    }
    public function edit($id){
        $this->showOffcanvas = true;
        $this->showOffcanvasAction='update';
        $role = ModelsRole::find($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
    }

    public function update(){
        $this->validate();
        try {
            $role = ModelsRole::find($this->role_id);
            if($role){
                $role->update(['name' => $this->name]);
            }
            $this->showOffcanvasAction='store';
            $this->hideOffcanvas();
            $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Role Updated Successfully!', 
                'text' => 'It will list on users table soon.'
            ]);
        } catch (\Throwable $e) {
            return session()->flash('error', $e->getMessage());
        }
    }

    public function deleteConfirm($id)
    {
        $role = ModelsRole::find($id);
        if($role){
            $this->dispatchBrowserEvent('swal:confirm', [
                    'id' => $role->id,
                    'type' => 'warning',  
                    'message' => 'Are you sure delete '.$role->name.' ?', 
                    'text' => 'If deleted, you will not be able to recover this imaginary file!'
                ]);
        }else{
            $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'danger',  
                'message' => 'Data is not foud!', 
                'text' => 'please check data.'
            ]);
        }
    }
    public function deleteData($id){
        $role = ModelsRole::find($id);
        if($role){
            $role->delete();
            $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Role Updated Successfully!', 
                'text' => 'It will list on users table soon.'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'danger',  
                'message' => 'Data is not foud!', 
                'text' => 'please check data.'
            ]);
        }
    }
}
