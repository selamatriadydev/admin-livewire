<?php

namespace App\Http\Livewire\Settings\UserProfile;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class ProfileLog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $logsToday = [], $logsYesterday = [];
    public function mount(){
        $this->logsToday = Audit::where('user_id',auth()->user()->id)->whereDate('created_at', Carbon::now())->get();
        $this->logsYesterday = Audit::where('user_id',auth()->user()->id)->whereDate('created_at', Carbon::now()->subDay())->get();
    }
    public function render()
    {
        $logsAll = Audit::where('user_id',auth()->user()->id)->paginate(10);
        return view('livewire.settings.user-profile.profile-log', compact('logsAll'));
    }
}
