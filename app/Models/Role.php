<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;

class Role extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
    protected $auditStrict = true;
    protected $auditInclude = ['name'];

    public function transformAudit(array $data): array
    {
        Arr::set($data, 'keterangan',  'Role');
        return $data;
    }
    public function modules()
    {
    	return $this->belongsToMany(Module::class, 'role_has_module', 'role_id', 'module_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }
}
