<?php

namespace App\Http\Livewire\Component;

trait AccordionTrait
{
    public $accordionActive = [], $accordionActiveParent = null, $accordionActiveSub = null, $parentKey;

    public function toggleAccordion($accordionActive, $parentKey)
    {
        if ($parentKey == $this->parentKey && in_array($accordionActive, $this->accordionActive)) {
            $this->parentKey = $parentKey;
            $this->accordionActive = array_diff($this->accordionActive, [$accordionActive]);
        } else {
            $this->accordionActive[] = $accordionActive;
        }
        // if ($this->accordionActive === $accordionActive) {
        //     $this->accordionActive = null;
        // } else {
        //     $this->accordionActive = $accordionActive;
        // }
    }
    public function toggleAccordionParent($accordionActive){
        if ($this->accordionActiveParent === $accordionActive) {
            $this->accordionActiveParent = null;
        } else {
            $this->accordionActiveParent = $accordionActive;
        }
    }
    public function toggleAccordionSub($accordionActive){
        if ($this->accordionActiveSub === $accordionActive) {
            $this->accordionActiveSub = null;
        } else {
            $this->accordionActiveSub = $accordionActive;
        }
    }
}
