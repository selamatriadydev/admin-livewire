<?php
namespace App\Helpers;

use App\Models\Module;
use App\Models\Permission;

class SiteHelper {
    public static function parrentModule(){
        return Module::with('childModule')->parentModul()->orderBy('sort', 'ASC')->get();
    }
    public static function permissionMenu($slug, $permis = false){
        if(!$slug) return [];
        if($permis){
            $data = [];
            $permisData = Permission::where('name', 'like', '%-'.$slug)->pluck('name')->toArray();
            foreach ($permisData as $value) {
                $data[$value] = str_replace("-".$slug, '', $value);
            }
            return $data;
        }
        return Permission::where('name', 'like', '%-'.$slug)->pluck('name', 'id')->toArray();
    }
    public static function buildTree(array $elements, $parentId = 0)
    {
        $branch = [];
    
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
    
        return $branch;
    }
    public static function check_permission($permission, $redirect = false)
    {
        if (!in_array($permission, auth()->user()->allPermissions)) {
            if($redirect){
                echo redirect()->route('dashboard'); 
            }
            return false;
        }
        return true;
    }
}