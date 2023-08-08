<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role as ModelsRole;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $role_id;
    public $updateMode = false;
    public $showOffcanvasAction = 'store';
    public $showOffcanvas = false;
    protected $listeners = ['roleStore' => 'hideOffcanvas'];
    // public $roleData = [];
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
            $this->showOffcanvas = false;
            $this->resetInputFields();
            // $this->emit("roleStore");//// Close model to using to jquery
        } catch (\Throwable $e) {
             session()->flash('error', $e->getMessage());
        }
    }
    public function edit($id){
        $this->showOffcanvas = true;
        $this->showOffcanvasAction='update';
        // $this->updateMode = true;
        $role = ModelsRole::find($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update(){
        $this->validate();
        try {
            $role = ModelsRole::find($this->role_id);
            if($role){
                $role->update(['name' => $this->name]);
            }
            $this->showOffcanvas = false;
            $this->showOffcanvasAction='store';
            session()->flash('success', 'Users Updated Successfully.');
            $this->resetInputFields();
        } catch (\Throwable $e) {
            return session()->flash('error', $e->getMessage());
        }
    }

    public function delete($id){
        $role = ModelsRole::find($id);
        if($role){
            $role->delete();
            session()->flash('success', 'Users Deleted Successfully.');
        }else{
            session()->flash('error', 'data not found');
        }
    }
}
