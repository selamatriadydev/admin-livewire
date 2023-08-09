<?php
namespace App\Http\Livewire\Component;

trait OffCanvasTrait
{
    public $showOffcanvasAction = ['store', 'update'];
    public $activeOffcanvasAction = 'store';
    public $OffcanvasForm = [];
    public $showOffcanvas = false;

    public function toggleOffcanvas()
    {
        $this->showOffcanvas = !$this->showOffcanvas;
    }
    public function opencOffcanvas()
    {
        $this->showOffcanvas = true;
    }
    public function modeCreate()
    {
        $this->activeOffcanvasAction='store';
        $this->showOffcanvas = true;
    }
    public function modeUpdate()
    {
        $this->activeOffcanvasAction='update';
        $this->showOffcanvas = true;
    }
    public function hideOffcanvas()
    {
        $this->activeOffcanvasAction='store';
        $this->showOffcanvas = false;
    }

}