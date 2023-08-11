<?php
namespace App\Http\Livewire\Component;

trait SwalAlertTrait
{
    public function alertError($message = "Data is not found!", $text = "please check your data!")
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'error',  
                'message' => $message, 
                'text' => $text
            ]);
    }
    public function alertNoData()
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'error',  
                'message' => "Data is not found!", 
                'text' => "please check your data!"
            ]);
    }
    public function alertValidate()
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'error',  
                'message' => "data not valid!", 
                'text' => "please check your form!"
            ]);
    }
    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Data Saved Successfully!', 
                'text' => 'It will list on data table soon.'
            ]);
    }
    public function alertCreate()
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Data Created Successfully!', 
                'text' => 'It will list on data table soon.'
            ]);
    }

    public function alertUpdate()
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Data Updated Successfully!', 
                'text' => 'It will list on data table soon.'
            ]);
    }
    public function alertConfirm($dataId = 0, $textDelete = 'Data', $emitDeleteAction = '')
    {
        $emitDelete = 'deleteData';
        if($emitDeleteAction){
            $emitDelete = $emitDeleteAction;
        }
        $this->dispatchBrowserEvent('swal:confirm', [
                'id' => $dataId,
                'type' => 'warning',  
                'message' => 'Are you sure delete '.$textDelete.' ?',
                'text' => 'If deleted, you will not be able to recover this data!',
                'confirmButtonText' => "Yes, delete it!",
                'cancelButtonText' => "No, cancel plx!",
                'emitDelete' => $emitDelete
            ]);
    }
    public function alertRemove()
    {
        $this->dispatchBrowserEvent('swal:alert', [
                'type' => 'success',  
                'message' => 'Data Delete Successfully!', 
                'text' => 'It will not list on data table soon.'
            ]);
    }
}