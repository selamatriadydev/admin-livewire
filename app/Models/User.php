<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles as spatieRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use spatieRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['allPermissions', 'allMenus']; 

    public function getAllpermissionsAttribute()
    {  
        $roles = Role::all(); // Fetching all Role models from the database
        $permissions = $roles->flatMap(function ($role) {
            return $role->permissions;
        })->pluck('name')->all();
        return $permissions;
    }
    public function getAllmenusAttribute()
    {
        $roleId = $this->role_id;
        $parents = Module::with(['childModule' => function ($q) use ($roleId) {
            $q->whereHas('roles', function ($q) use ($roleId) {
                $q->where('role_id', $roleId);
            });
        }])
        ->whereHas('roles', function ($q) use ($roleId) {
            $q->where('role_id', $roleId);
        })
        ->where('menu_parrent_id', '=', '0')
        ->orderBy('menu_order')
        ->get()
        ->map(function ($module) {
                $children = [];
                if($module->childMenu){
                    $children = $module->childMenu->map(function ($child) {
                        return [
                            'id' => $child->menu_id,
                            'parent_id' => $child->menu_parrent_id,
                            'module_name' => $child->menu_title,
                            'module_link' => $child->menu_uri,
                            'module_icon' => $child->menu_icon,
                            'module_method' => $child->menu_method,
                            'module_sort' => $child->menu_order,
                            'children_method' => explode(',', $child->menu_child),
                        ];
                    })->toArray();
                }
                return [
                    'id' => $module->menu_id,
                    'parent_id' => $module->menu_parrent_id,
                    'module_name' => $module->menu_title,
                    'module_link' => $module->menu_uri,
                    'module_icon' => $module->menu_icon,
                    'module_method' => $module->menu_method,
                    'module_sort' => $module->menu_order,
                    'children_method' => explode(',', $module->menu_child),
                    'children' => $children,
                ];
            })
            ->toArray();
        return buildTree($parents);
    }
    public function canAccess($permission)
    {
        if (in_array($permission, $this->allPermissions)) {
            return true;
        }
        return false;
    }
}
