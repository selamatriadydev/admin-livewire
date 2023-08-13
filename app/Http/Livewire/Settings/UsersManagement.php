<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\User; 
use Livewire\Component;
use Livewire\WithPagination;

class UsersManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use OffCanvasTrait;
    use SwalAlertTrait;

    public $user_now;
    public $actCreate= false, $actUpdate= false, $actDelete=false, $actDetail = false;
    public $name, $email, $password, $password_confirmation, $role_id, $data_id;
    protected $listeners = ['deleteData'];
    public $selectedItems = [];
    public $tableHead = ['Nama', 'Email'];
    public $tableBody = ['name', 'email'];

    public function mount(){
        $this->user_now = User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $this->OffcanvasForm = [
            ['title' => 'Name', 'type' => 'text', 'model' => 'name'],
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
            $rules['email'] .= ',' . $this->role_id;
        }

        return $rules;
    }
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.settings.users-management', compact('users'));
    }
}
