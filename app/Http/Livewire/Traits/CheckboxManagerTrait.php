<?php

namespace App\Http\Livewire\Traits;

trait CheckboxManagerTrait {
    public $checkAll = [];
    public $checkboxes = [], $selectedItems = [];

    public function updatedCheckAll()
    {
        if($this->checkAll){
            foreach ($this->checkboxes as $key) {
                // $this->checkboxes[$key] = $this->checkAll;
                $this->selectedItems[$key] = $this->checkAll;
            }
        }else{
            $this->selectedItems = [];
        }
    }

    public function toggleCheckbox($index)
    {
        if (in_array($index, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$index]);
        }
    }
}