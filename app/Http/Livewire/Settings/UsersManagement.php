<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\Role;
use App\Models\User; 
use Livewire\Component;
use Livewire\WithPagination;

class UsersManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use OffCanvasTrait;
    use SwalAlertTrait;

    public $user_now, $roles;
    public $actCreate= true, $actUpdate= true, $actDelete=true, $actDetail = false;
    public $name, $email, $password, $password_confirmation, $role_id, $status_active, $data_id;
    protected $listeners = ['deleteData','deleteSelectedItems'];
    public $selectedItems = [];
    public $tableHead = ['Nama', 'Email', 'Role', 'Online'];
    public $tableBody = ['name', 'email', 'role_name', 'online'];

    public function mount(){
        $this->roles = Role::get()->map(function($data){
            return ['value' => $data->id, 'text' => $data->name];
        })->toArray();
        $this->user_now = User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $this->OffcanvasForm = [
            ['title' => 'Name', 'type' => 'text', 'model' => 'name'], 
            ['title' => 'Email', 'type' => 'email', 'model' => 'email'], 
            ['title' => 'Password', 'type' => 'password', 'model' => 'password'], 
            ['title' => 'Password Confirm', 'type' => 'password', 'model' => 'password_confirmation'], 
            ['title' => 'Role', 'type' => 'option', 'model' => 'role_id', 'data' => $this->roles], 
        ];
    }
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ];
        // Append the id condition when updating
        if ($this->activeOffcanvasAction === 'update') {
            $rules['email'] .= ',' . $this->data_id;
            $rules['password'] = 'nullable|confirmed';
        }

        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    private function resetInputFields(){
        $this->data_id = '';
        $this->role_id = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->status_active = '';
    }
    private function requestInputFields(){
        $data = [
            'role_id' => $this->role_id ?? null,
            'name' => $this->name,
            'email' => $this->email,
            'status_active' => $this->status_active ?? 1,
        ];
        if ($this->activeOffcanvasAction === 'update' && $this->password !="") {
            $data['password'] =  bcrypt($this->password);
        }else{
            $data['password'] =  bcrypt($this->password);
        }
        return $data;
    }
    public function store(){
        $this->validate();
        try {
            $data = $this->requestInputFields();
            User::create($data);
            $this->resetInputFields();
            $this->hideOffcanvas();
            $this->alertCreate();
        } catch (\Throwable $e) {
            // return $e->getMessage();
            $this->alertNoData();
            $this->resetInputFields();
            $this->hideOffcanvas();
        }
    }
    public function edit($id){
        $user = User::find($id);
        if(!$user){
            $this->alertNoData();
        }else{
            $this->modeUpdate();
            $this->data_id = $user->id;
            $this->role_id = $user->role_id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->status_active = $user->status_active;
        }
    }
    public function update(){
        $this->validate();
        try {
            $user = User::find($this->data_id);
            if($user){
                $data = $this->requestInputFields();
                $user->update($data);
                $this->alertUpdate();
            }else{
                $this->alertNoData();
            }
            $this->resetInputFields();
            $this->hideOffcanvas();
        } catch (\Throwable $e) {
            $this->alertNoData();
            $this->resetInputFields();
            $this->hideOffcanvas();
            // return session()->flash('error', $e->getMessage());
        }
    }
    public function deleteConfirm($id)
    {
        $user = User::find($id);
        if($user){
            $this->alertConfirm($user->id, $user->name, 'deleteData');
        }else{
            $this->alertNoData();
        }
    }
    public function deleteData($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            $this->alertRemove();
        }else{
            $this->alertNoData();
        }
    }
    public function toggleSelectedItem($itemId)
    {
        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$itemId]);
        } else {
            $this->selectedItems[] = $itemId;
        }
    }

    public function deleteSelectedItemsConfirm()
    {
        $this->alertConfirm($this->selectedItems, 'Data', 'deleteSelectedItems');
    }
    public function deleteSelectedItems()
    {
        foreach ($this->selectedItems as $itemId) {
            $item = User::find($itemId);
            if ($item) {
                $item->delete();
            }
        }
        $this->selectedItems = [];
        $this->alertRemove();
    }
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.settings.users-management', compact('users'));
    }
}
