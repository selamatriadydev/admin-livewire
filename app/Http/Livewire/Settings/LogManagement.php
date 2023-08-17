<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use Livewire\Component;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class LogManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use OffCanvasTrait;
    use SwalAlertTrait;
    public $actDetail= true;
    
    public function render()
    {
        $logs = Audit::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.settings.log-management', compact('logs'));
    }

    public function detail($id){
        $log = Audit::findOrFail($id);
        if(!$log){
            $this->alertNoData();
        }else{
            $this->modeDetail();
            $event = $log->event ." ".$log->keterangan;
            $user = $log->user->name ?? 'guest';
            $created = $log->created_at->format('d M Y');
            $ip = $log->ip_address;
            $old_value = json_encode($log->old_values);
            $new_value = json_encode($log->new_values);
            $this->OffcanvasDetail = [
                ['title' => 'Log', 'data' => $event],
                ['title' => 'User', 'data' => $user],
                ['title' => 'Create', 'data' => $created],
                ['title' => 'Ip', 'data' => $ip],
                ['title' => 'Old Value', 'data' => $old_value],
                ['title' => 'New Value', 'data' => $new_value],
                ['title' => 'URL', 'data' => $log->url],
                ['title' => 'User Agen', 'data' => $log->user_agent],
            ];
        }

    }
}
