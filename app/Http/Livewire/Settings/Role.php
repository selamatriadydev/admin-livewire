<?php

namespace App\Http\Livewire\Settings;

use App\Helpers\SiteHelper;
use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Models\Module;
use App\Models\Role as ModelsRole;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use SwalAlertTrait;
    use OffCanvasTrait;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name,$role_id, $list_modules, $selectedModule, $actCreate= true, $actUpdate= true, $actDelete=true, $actDetail = false;
    public $updateMode = false;
    public $dataAction = 'store';
    protected $listeners = ['deleteData', 'deleteSelectedItems'];
    public $selectedItems = [];
    public $tableHead = ['Nama'];
    public $tableBody = ['name'];
    
    public function toggleSelection($nodeId)
    {
        if (in_array($nodeId, $this->selectedModule)) {
            $this->selectedModule = array_diff($this->selectedModule, [$nodeId]);
        } else {
            $this->selectedModule[] = $nodeId;
        }
    }
    public function rules()
    {
        $rules = [
            'name' => 'required|unique:roles,name',
        ];
        // Append the id condition when updating
        if ($this->activeOffcanvasAction === 'update') {
            $rules['name'] .= ',' . $this->role_id;
        }

        return $rules;
    }
    public function mount(){
        $this->list_modules = Module::with('childModule')->parentModul()->orderBy('sort', 'ASC')->get()->map(function($parrent){
            $childs = $parrent->childModule()->get()->map(function($child){
                return [
                    'id' => $child->id,
                    'method' => $child->method,
                    'slug' => $child->slug,
                    'title' => $child->title,
                    'permissions' => SiteHelper::permissionMenu($child->slug, true),
                ];
            })->toArray();
            return [
                'id' => $parrent->id,
                'method' => $parrent->method,
                'slug' => $parrent->slug,
                'title' => $parrent->title,
                'is_parrent' => (count($parrent->childModule) > 0 || count(SiteHelper::permissionMenu($parrent->slug)) > 0),
                'permissions' => SiteHelper::permissionMenu($parrent->slug, true),
                'childs' => $childs,
            ];
        })->toArray();
        $this->OffcanvasForm = [
            ['title' => 'Name', 'type' => 'text', 'model' => 'name'],
            ['title' => 'Module', 'type' => 'list_module', 'model' => 'selectedModule', 'data' => $this->list_modules],
        ];
    }

    private function resetInputFields(){
        $this->role_id = '';
        $this->name = '';
    }
    public function openOffcanvas()
    {
        if (in_array($this->dataAction, $this->showOffcanvasAction)) {
            $this->toggleOffcanvas();
        }
    }

    public function store(){
        $this->validate();
        try {
            ModelsRole::create(['name' => $this->name]);
            $this->resetInputFields();
            $this->hideOffcanvas();
            $this->alertCreate();
        } catch (\Throwable $e) {
            $this->alertNoData();
            $this->resetInputFields();
            $this->hideOffcanvas();
        }
    }
    public function edit($id){
        $role = ModelsRole::find($id);
        if(!$role){
            $this->alertNoData();
        }else{
            $this->modeUpdate();
            $this->role_id = $role->id;
            $this->name = $role->name;
        }
    }

    public function update(){
        $this->validate();
        try {
            $role = ModelsRole::find($this->role_id);
            if($role){
                $role->update(['name' => $this->name]);
                $this->resetInputFields();
                $this->hideOffcanvas();
                $this->alertUpdate();
            }else{
                $this->resetInputFields();
                $this->hideOffcanvas();
                $this->alertNoData();
            }
        } catch (\Throwable $e) {
            $this->alertNoData();
            $this->resetInputFields();
            $this->hideOffcanvas();
            // return session()->flash('error', $e->getMessage());
        }
    }

    public function deleteConfirm($id)
    {
        $role = ModelsRole::find($id);
        if($role){
            $this->alertConfirm($role->id, $role->name, 'deleteData');
        }else{
            $this->alertNoData();
        }
    }
    public function deleteData($id){
        $role = ModelsRole::find($id);
        if($role){
            $role->delete();
            $this->alertRemove();
        }else{
            $this->alertNoData();
        }
    }
    public function toggleSelectedItem($itemId)
    {
        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$itemId]);
        } else {
            $this->selectedItems[] = $itemId;
        }
    }

    public function deleteSelectedItemsConfirm()
    {
        $this->alertConfirm($this->selectedItems, 'Data', 'deleteSelectedItems');
    }
    public function deleteSelectedItems()
    {
        foreach ($this->selectedItems as $itemId) {
            $item = ModelsRole::find($itemId);
            if ($item) {
                $item->delete();
            }
        }
        $this->selectedItems = [];
        $this->alertRemove();
    }

    public function render()
    {
        $tableData = ModelsRole::paginate(10);
        return view('livewire.settings.role', compact('tableData'));
    }
}
