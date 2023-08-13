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
            $permisData = Permission::where('name', 'like', '%-'.$slug)->pluck('name', 'id')->toArray();
            foreach ($permisData as $key=>$value) {
                $data[$key] = str_replace("-".$slug, '', $value);
            }
            return $data;
        }
        return Permission::where('name', 'like', '%-'.$slug)->pluck('name', 'id')->toArray();
    }

    public static function moduleChedked(){
        return Module::with('childModule')->parentModul()->orderBy('sort', 'ASC')->get()->map(function($parrent){
            $childs = $parrent->childModule()->get()->map(function($child){
                return [
                    'checked' => false,
                    'id' => $child->id,
                    'title' => $child->title,
                    'permissions' => self::permissionModuleChedked($child->slug),
                ];
            })->toArray();
            return [
                'checked' => false,
                'id' => $parrent->id,
                'title' => $parrent->title,
                'is_parrent' => (count($parrent->childModule) > 0 || count(self::permissionModuleChedked($parrent->slug)) > 0),
                'permissions' => self::permissionModuleChedked($parrent->slug),
                'childs' => $childs,
            ];
        })->toArray();;
    }
    public static function permissionModuleChedked($slug){
        if(!$slug) return [];
        return Permission::where('name', 'like', '%-'.$slug)->get()->map(function($data){
            return [
                'checked' => false,
                'id' => $data->id,
                'name' => $data->name,
            ];
        })->toArray();
    }
    public static function buildTree(array $elements, $parentId = 0)
    {
        $branch = [];
    
        foreach ($elements as $element) {
            if ($element['parrent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
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