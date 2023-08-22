<?php

namespace App\Http\Livewire\Settings\UserProfile;

use Livewire\Component;

class ProfileIndex extends Component
{
    public $users;
    public $listNav = [];
    public $listNavActive = 'Overview';
    public function mount(){
        $this->users = auth()->user();
        $this->listNav = ['Overview', 'Project', 'Team', 'Activity'];
    }
    public function toogleNav($nav){
        $this->listNavActive = $nav;
    }
    public function render()
    {
        return view('livewire.settings.user-profile.profile-index');
    }
}
