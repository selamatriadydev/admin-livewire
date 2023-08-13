<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles as spatieRole;

class Role extends Model
{
    use HasFactory;
    // use spatieRole;

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
            $model->guard_name = 'web';
        });
        static::deleting(function ($role) {
            $role->modules()->detach();
            $role->permissions()->detach();
        });
    }

    protected $fillable = ['name'];
    // protected $guard = ['guard_name'];
    protected $hidden = ['guard_name'];

    public function modules()
    {
    	return $this->belongsToMany(Module::class, 'role_has_module', 'role_id', 'module_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }
}
