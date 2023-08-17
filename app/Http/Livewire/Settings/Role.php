<?php

namespace App\Http\Livewire\Settings;

use App\Helpers\SiteHelper;
use App\Http\Livewire\Component\OffCanvasTrait;
use App\Http\Livewire\Component\SwalAlertTrait;
use App\Http\Livewire\Traits\TreeViewTrait;
use App\Models\Module;
use App\Models\Role as ModelsRole;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use SwalAlertTrait;
    use OffCanvasTrait;
    use TreeViewTrait;

    public $name,$role_id, $actCreate= true, $actUpdate= true, $actDelete=true, $actDetail = false;
    public $updateMode = false;
    public $dataAction = 'store';
    protected $listeners = ['deleteData', 'deleteSelectedItems'];
    public $selectedItems = [];
    public $tableHead = ['Nama'];
    public $tableBody = ['name'];
    
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
        $this->listModule = Module::with('childModule')->parentModul()->orderBy('sort', 'ASC')->get()->map(function($parrent){
            $childs = $parrent->childModule()->get()->map(function($child){
                return [
                    'id' => $child->id,
                    'title' => $child->title,
                    'permissions' => SiteHelper::permissionMenu($child->slug, true),
                ];
            })->toArray();
            return [
                'id' => $parrent->id,
                'title' => $parrent->title,
                'is_parrent' => (count($parrent->childModule) > 0 || count(SiteHelper::permissionMenu($parrent->slug)) > 0),
                'permissions' => SiteHelper::permissionMenu($parrent->slug, true),
                'childs' => $childs,
            ];
        })->toArray();
        $this->OffcanvasForm = [
            ['title' => 'Name', 'type' => 'text', 'model' => 'name'],
            ['title' => 'Module', 'type' => 'list_module', 'model' => 'selectedModule', 'data' => $this->listModule],
        ];
    }

    private function resetInputFields(){
        $this->role_id = '';
        $this->name = '';
        $this->selectedModule = [];
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
            $role = ModelsRole::create(['name' => $this->name]);
            $this->getModulData();
            if ($this->requestDataModuleId) {
                $role = ModelsRole::findOrFail($role->id);
                $role->modules()->sync($this->requestDataModuleId);
            }
            if ($this->requestDataPermisId) {
                $role = ModelsRole::findOrFail($role->id);
                $role->permissions()->sync($this->requestDataPermisId);
            }
            $this->resetInputFields();
            $this->hideOffcanvas();
            $this->alertCreate();
        } catch (\Exception $e) {
            $this->alertNoData();
            $this->resetInputFields();
            $this->hideOffcanvas();
            dd($e->getMessage());
        }
    }
    public function edit($id){
        $role = ModelsRole::find($id);
        if(!$role){
            $this->alertNoData();
        }else{
            $this->modeUpdate();
            $moduleArray = $role->modules()->get()->map(function($data){
                return $data['pivot']['module_id'];
            })->toArray();
            // dd($moduleArray);
            $permisArray = $role->permissions()->get()->map(function($data){
                return $data['pivot']['permission_id'];
            })->toArray();
            $this->setSelectedModule($moduleArray, $permisArray);
            // dd($this->selectedModule);
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
                $this->getModulData();
                // dd($this->requestDataPermisId);
                $role->modules()->sync($this->requestDataModuleId);
                $role->permissions()->sync($this->requestDataPermisId);
                // if ($this->requestDataModuleId) {
                //     $role->modules()->sync($this->requestDataModuleId);
                // }
                // if ($this->requestDataPermisId) {
                //     $role->permissions()->sync($this->requestDataPermisId);
                // }
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
