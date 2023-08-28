<?php

namespace App\Http\Livewire\Settings\UserProfile;

use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\User;
use Livewire\Component;

class ProfileIndex extends Component
{
    use SwalAlertTrait;
    use OffCanvasTrait;

    public $users;
    public $listNav = [];
    public $listNavActive = 'Overview';
    public $name, $email, $password, $password_confirmation, $data_id;
    public function mount(){
        $this->OffcanvasForm = [
            ['title' => 'Name', 'type' => 'text', 'model' => 'name'], 
            ['title' => 'Email', 'type' => 'email', 'model' => 'email'], 
            ['title' => 'Password', 'type' => 'password', 'model' => 'password'], 
            ['title' => 'Password Confirm', 'type' => 'password', 'model' => 'password_confirmation'], 
        ];

        $this->users = auth()->user();
        $this->listNav = ['Overview', 'Project', 'Team', 'Activity'];
    }
    public function toogleNav($nav){
        $this->listNavActive = $nav;
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
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
    private function requestInputFields(){
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if ($this->activeOffcanvasAction === 'update') {
            if($this->password !=""){
                $data['password'] =  bcrypt($this->password);
            }
        }
        return $data;
    }
    public function editProfile(){
        $user = User::find(auth()->user()->id);
        if(!$user){
            $this->alertNoData();
        }else{
            $this->modeUpdate();
            $this->data_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = '';
            $this->password_confirmation = '';
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
    public function render()
    {
        return view('livewire.settings.user-profile.profile-index');
    }
}
