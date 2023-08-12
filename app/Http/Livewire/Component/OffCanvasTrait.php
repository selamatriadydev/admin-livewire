<?php
namespace App\Http\Livewire\Component;

trait OffCanvasTrait
{
    public $showOffcanvasAction = ['store', 'update'];
    public $activeOffcanvasAction = 'store';
    public $titleOffcanvasAction = 'New Data';
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
    public function resetForm()
    {
        foreach($this->OffcanvasForm as $form){
            if(isset($form['model'])){
                $propertyName = $form['model'];
                $value = "";
                if($form['type'] == 'number'){
                    $value = "0";
                }elseif($form['type'] == 'option'){
                    $value = "0";
                }
                $this->$propertyName = $value;
            }
        }
    }
    public function modeCreate()
    {
        $this->titleOffcanvasAction = 'New Data';
        $this->activeOffcanvasAction='store';
        $this->showOffcanvas = true;
    }
    public function modeUpdate()
    {
        $this->titleOffcanvasAction = 'Update Data';
        $this->activeOffcanvasAction='update';
        $this->showOffcanvas = true;
    }
    public function hideOffcanvas()
    {
        $this->titleOffcanvasAction = 'New Data';
        $this->activeOffcanvasAction='store';
        $this->showOffcanvas = false;
        $this->resetForm();
    }

}