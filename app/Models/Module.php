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
    }
    public function subModule() {
        return $this->hasMany(Module::class, 'parrent_id')->where('parrent_id', '!=', 0)->orderBy('sort', 'ASC');
    }
    public function permisModule() {
        return Permission::where('name', 'like', '%-'.$this->slug)->get();
    }
    public function getSidebarStatusAttribute(){
        if($this->is_sidebar == 1){
            return 'YES';
        }
        return 'NO';
    }
}
