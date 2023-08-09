<?php
namespace App\Http\Livewire\Component;

trait OffCanvasTrait
{
    public $showOffcanvasAction = ['store', 'update'];
    public $activeOffcanvasAction = 'store';
    public $showOffcanvas = false;

    public function toggleOffcanvas()
    {
        $this->showOffcanvas = !$this->showOffcanvas;
    }
    public function opencOffcanvas()
    {
        $this->showOffcanvas = true;
    }
    public function hideOffcanvas()
    {
        $this->showOffcanvasAction='store';
        $this->showOffcanvas = false;
    }

}