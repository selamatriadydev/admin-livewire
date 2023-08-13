<?php

namespace App\Http\Livewire\Traits;

trait TreeViewTrait {
    public  $listModule = [], $selectedModule = [], $requestDataModuleId = [], $requestDataPermisId = [];

    public function toggleSelection($parentId, $child, $childId)
    {
        if (!isset($this->selectedModule[$parentId][$child])) {
            // Parent module is not checked, check the parent and all its children
            $this->selectedModule[$parentId][$child] = $this->modules[$parentId]['childs'][$child];
        } else {
            if (in_array($childId, $this->selectedModule[$parentId][$child])) {
                // Child module is checked, uncheck it
                $this->selectedModule[$parentId][$child] = array_diff($this->selectedModule[$parentId][$child], [$childId]);
            } else {
                // Child module is unchecked, check it
                $this->selectedModule[$parentId][$child][] = $childId;
            }
        }
    }
    
    public function getModulData()
    {
        foreach ($this->selectedModule as $parentId => $parentData) {
            if ($parentData === true || is_array($parentData)) {
                $this->requestDataModuleId[] = $parentId;
            }
            if (isset($parentData['permis'])) {
                foreach ($parentData['permis'] as $permisKey => $permisValue) {
                    if ($permisValue === true) {
                        $this->requestDataPermisId[] = $permisKey;
                    }
                }
            }
            if (isset($parentData['sub'])) {
                foreach ($parentData['sub'] as $childId => $childData) {
                    if ($childData === true || is_array($childData)) {
                        $this->requestDataModuleId[] = $childId;
                    }
                    if (isset($childData['permis'])) {
                        foreach ($childData['permis'] as $permisKey => $permisValue) {
                            if ($permisValue === true) {
                                $this->requestDataPermisId[] = $permisKey;
                            }
                        }
                    }
                }
            }
        }
        $this->requestDataModuleId = array_unique($this->requestDataModuleId);
        $this->requestDataPermisId = array_unique($this->requestDataPermisId);
    }
    // public function setSelectedModule($moduleIdArray, $permisIdArray){
    //     foreach($this->listModule as $parrent){
    //         if(in_array($parrent->id, $moduleIdArray)){
    //             $checked = true;
    //             if($$parrent['childs']){
    //                 $checked['sub'] = collect($parrent['childs'])->map(function($child) use ($moduleIdArray, $permisIdArray){
    //                     $checkedSub = true;
    //                     if($child['permissions']){
    //                         $checkedSub['permis'] = collect($child['permissions'])->map(function($key,$child) use ($permisIdArray){
    //                             return in_array($key,$permisIdArray) ? [
    //                                 $key => true,
    //                             ] : [];
    //                         }); 
    //                     }
    //                     return in_array($child['id'],$moduleIdArray) ? [
    //                         $child['id'] => $checkedSub,
    //                     ] : [];
    //                 });
    //             }
    //             if($$parrent['permissions']){
    //                 $checked['permis'] = collect($parrent['permissions'])->map(function($key,$child) use ($permisIdArray){
    //                     return in_array($key,$permisIdArray) ? [
    //                         $key => true,
    //                     ] : [];
    //                 });
    //             }
    //             $this->selectedModule[$parrent->id] = $checked;
    //         }
    //     }
    // }
    public function setSelectedModule($moduleIdArray = [], $permisIdArray = [])
    {
        $this->selectedModule = [];
        foreach ($this->listModule as $parent) {
            $parentId = $parent['id'];
            if (in_array($parentId, $moduleIdArray)) {
                $checked = [];
                if (is_array($parent['childs'])) {
                    foreach ($parent['childs'] as $child) {
                        $checkedSub = [];
                        // $checkedSub = $child['permissions'];
                        if (is_array($child['permissions'])) {
                            foreach ($child['permissions'] as $keySub => $val) {
                                if (in_array($keySub, $permisIdArray)) {
                                    $checkedSub['permis'][$keySub] = true;
                                }
                            }
                        }
                        if (in_array($child['id'], $moduleIdArray)) {
                            $checked['sub'][$child['id']] = count($checkedSub) ? $checkedSub : true;
                        }
                    }
                }

                if (is_array($parent['permissions'])) {
                    foreach ($parent['permissions'] as $key => $val) {
                        if (in_array($key, $permisIdArray)) {
                            $checked['permis'][$key] = true;
                        }
                    }
                }
                
                $this->selectedModule[$parentId] = $checked;
            }
        }
    }






    


}