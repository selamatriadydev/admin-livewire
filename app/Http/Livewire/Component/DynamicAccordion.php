<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class DynamicAccordion extends Component
{
    public $activeItem = null, $parentId;

    public function toggleItem($itemId)
    {
        if ($this->activeItem === $itemId) {
            $this->activeItem = null;
        } else {
            $this->activeItem = $itemId;
        }
    }

    public function render()
    {
        return view('livewire.component.dynamic-accordion');
    }
}
