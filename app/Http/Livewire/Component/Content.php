<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Content extends Component
{
    public $title = 'Title';
    public $create = false;
    public $update = false;
    public $delete = false;
    public $detail = false;
    public $tableHead = [];
    public $tableBody = [];
    public $tableData = [];
    // public $numberOfPaginatorsRendered;

    // public function mount(){
    //     if($this->tableData){
    //         $this->numberOfPaginatorsRendered = $this->tableData->links();
    //     }
    // }
    public function render()
    {
        return view('livewire.component.content');
    }
}
