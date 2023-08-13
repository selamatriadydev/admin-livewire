<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model 
{
    use HasFactory;
    protected $fillable = ['parrent_id','is_sidebar', 'icon', 'title', 'url', 'method', 'slug', 'child', 'sort'];
    protected $appends = ['sidebar_status'];
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
        static::deleting(function ($model) {
            Permission::where('name', 'like', '%-'.$model->slug)->delete();
            $model->childModule()->delete();
        });
    }

    public function childModule() {
        return $this->hasMany(Module::class, 'parrent_id');
    }
    public function subModule() {
        return $this->hasMany(Module::class, 'parrent_id')->where('parrent_id', '!=', 0)->orderBy('sort', 'ASC');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_module', 'module_id', 'role_id');
    }
    
    public function scopeParentModul($query){
        return $query->where('parrent_id', '0');
    }
    public function scopeIsSidebar($query){
        return $query->where('is_sidebar', 1);
    }
    public function permisModule() {
        return Permission::where('name', 'like', '%-'.$this->slug)->get()->map(function($permis){
            $permisName = Str::replace('-'.$this->slug, '', $permis->name);
            return [
                'id' => $permis->id,
                'name' => $permisName
            ];
        });
    }
    public function getSidebarStatusAttribute(){
        if($this->is_sidebar == 1){
            return 'YES';
        }
        return 'NO';
    }
}
