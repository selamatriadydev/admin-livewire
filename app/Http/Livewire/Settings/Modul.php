<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\Module;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Modul extends Component
{
    use SwalAlertTrait;
    use OffCanvasTrait;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $parrent_id,$is_sidebar,$icon,$title, $url, $method, $slug, $child,$sort,$data_id;
    public $actCreate= true, $actUpdate= true, $actDelete=true, $actDetail = false;
    protected $listeners = ['deleteData', 'deleteSelectedItems'];
    public $selectedItems = [];
    public $tableHead = ['Sidebar', 'Icon', 'Title', 'child', 'Sort'];
    public $tableBody = ['sidebar_status', 'icon', 'title', 'child', 'sort'];
    public $tableData = [];
    
    public function rules()
    {
        $rules = [
            'title' => 'required|unique:modules,title',
            'url' => 'required|unique:modules,url',
            'method' => 'required|unique:modules,method',
        ];
        // Append the id condition when updating
        if ($this->activeOffcanvasAction == 'update') {
            $rules['title'] .= ',' . $this->data_id;
            $rules['url'] .= ',' . $this->data_id;
            $rules['method'] .= ',' . $this->data_id;
        }

        return $rules;
    }
    public function mount(){
        $this->formGenerate();
        $this->tableData = Module::where('parrent_id', 0)->orderBy('sort', 'ASC')->get();
        $this->parrent_id = '0';
        $this->is_sidebar = '0';
        // $this->OffcanvasForm = [
        //     ['title' => 'Is Sidebar', 'type' => 'option', 'model' => 'is_sidebar', 'data' => [['value' => 1, 'text' => 'YES'], ['value' => 0, 'text' => 'NO']]],
        //     ['title' => 'Icon', 'type' => 'text', 'model' => 'icon'],
        //     ['title' => 'Title', 'type' => 'text', 'model' => 'title'],
        //     ['title' => 'Url', 'type' => 'text', 'model' => 'url'],
        //     ['title' => 'Method', 'type' => 'text', 'model' => 'method'],
        //     ['title' => 'Slug', 'type' => 'text', 'model' => 'slug', 'readonly' => 'readonly'],
        //     ['title' => 'Child', 'type' => 'textarea', 'model' => 'child'],
        //     ['title' => 'Sort', 'type' => 'number', 'model' => 'sort'],
        // ];
    }
    public function formGenerate(){
        $formGenerate = [
            ['title' => 'Is Sidebar', 'type' => 'option', 'model' => 'is_sidebar', 'data' => [['value' => 1, 'text' => 'YES'], ['value' => 0, 'text' => 'NO']]],
            ['title' => 'Icon', 'type' => 'text', 'model' => 'icon'],
            ['title' => 'Title', 'type' => 'text', 'model' => 'title'],
            ['title' => 'Url', 'type' => 'text', 'model' => 'url'],
            ['title' => 'Method', 'type' => 'text', 'model' => 'method'],
            ['title' => 'Slug', 'type' => 'text', 'model' => 'slug'],
            ['title' => 'Child', 'type' => 'textarea', 'model' => 'child'],
            ['title' => 'Sort', 'type' => 'number', 'model' => 'sort'],
        ];
        if ($this->activeOffcanvasAction == 'store') {
            $this->OffcanvasForm = array_filter($formGenerate, function ($field) {
                return $field['model'] !== 'slug';
            });
        }else{
            $this->OffcanvasForm = $formGenerate;
        }
    }

    private function resetInputFields(){
        $this->parrent_id = '0';
        $this->data_id = '';
        $this->is_sidebar = '0';
        $this->icon = '';
        $this->title = '';
        $this->url = '';
        $this->method = '';
        $this->slug = '';
        $this->child = '';
        $this->sort = '0';
    }
    public function requestData(){
        $data = [];
        $data['parrent_id'] = $this->parrent_id ? $this->parrent_id : '0';
        $data['is_sidebar'] = $this->is_sidebar ? $this->is_sidebar : '0';
        $data['icon'] = $this->icon;
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['method'] = $this->method;
        if ($this->activeOffcanvasAction === 'update') {
            $data['slug'] = $this->slug;
        }else{
            $data['slug'] = Str::slug($this->title);
        }
        $data['child'] = $this->child ? $this->child : '';
        $data['sort'] = $this->sort ? $this->sort : '0';
        return $data;
    }

    public function store(){
        $this->validate();
        try {
            $data = $this->requestData();
            Module::create($data);
            $this->resetInputFields();
            $this->hideOffcanvas();
            $this->alertCreate();
            $this->tableData = Module::where('parrent_id', 0)->orderBy('sort', 'ASC')->get();
        } catch (\Exception $e) {
            $this->alertValidate();
            // return $this->requestData();
            // $this->resetInputFields();
            // return $e->getMessage();
        }
    }
    public function edit($id){
        $module = Module::find($id);
        if(!$module){
            $this->alertNoData();
        }else{
            $this->modeUpdate();
            $this->formGenerate();
            $this->data_id = $module->id;
            $this->parrent_id = $module->parrent_id;
            $this->title = $module->title;
            $this->url = $module->url;
            $this->icon = $module->icon;
            $this->method = $module->method;
            $this->slug = $module->slug;
            $this->child = $module->child;
            $this->sort = $module->sort;
        }
    }

    public function newSub($id){
        $module = Module::find($id);
        if(!$module){
            $this->alertNoData();
        }else{
            $this->modeCreate();
            $this->parrent_id = $module->id;
        }
    }
 
    public function update(){
        $this->validate();
        try {
            $role = Module::find($this->data_id);
            if($role){
                $dataUpdate = $this->requestData();
                $role->update($dataUpdate);
                $this->alertUpdate();
                $this->tableData = Module::where('parrent_id', 0)->orderBy('sort', 'ASC')->get();
            }else{
                $this->alertNoData();
            }
            $this->resetInputFields();
            $this->hideOffcanvas();
        } catch (\Exception $e) {
            $this->alertValidate();
            // return $e->getMessage();
        }
    }

    public function deleteConfirm($id)
    {
        $module = Module::find($id);
        if($module){
            $this->alertConfirm($module->id, $module->title, 'deleteData');
        }else{
            $this->alertNoData();
        }
    }
    public function deleteData($id){
        $module = Module::find($id);
        if($module){
            $module->delete();
            $this->tableData = Module::where('parrent_id', 0)->orderBy('sort', 'ASC')->get();
            $this->alertRemove();
        }else{
            $this->alertNoData();
        }
    }
    // public function toggleSelectedItem($itemId)
    // {
    //     if (in_array($itemId, $this->selectedItems)) {
    //         $this->selectedItems = array_diff($this->selectedItems, [$itemId]);
    //     } else {
    //         $this->selectedItems[] = $itemId;
    //     }
    // }

    // public function deleteSelectedItemsConfirm()
    // {
    //     $this->alertConfirm($this->selectedItems, 'Data', 'deleteSelectedItems');
    // }
    // public function deleteSelectedItems()
    // {
    //     foreach ($this->selectedItems as $itemId) {
    //         $item = Module::find($itemId);
    //         if ($item) {
    //             $item->delete();
    //         }
    //     }
    //     $this->selectedItems = [];
    //     $this->alertRemove();
    // }
    public function render()
    {
        // $tableData = Module::paginate(10);
        return view('livewire.settings.modul');
    }
}
