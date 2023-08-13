<?php

namespace App\Models;

use App\Helpers\SiteHelper;
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
        'role_id'
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
        ->parentModul()
        ->orderBy('sort')
        ->get()
        ->map(function ($module) {
                $children = [];
                if($module->childModule){
                    $children = $module->childModule->map(function ($child) {
                        return [
                            'id' => $child->id,
                            'parrent_id' => $child->parrent_id,
                            'title' => $child->title,
                            'url' => $child->url,
                            'icon' => $child->icon,
                            'method' => $child->method,
                            'sort' => $child->sort,
                            'children_method' => explode(',', $child->child),
                        ];
                    })->toArray();
                }
                return [
                    'id' => $module->id,
                    'parrent_id' => $module->parrent_id,
                    'title' => $module->title,
                    'url' => $module->url,
                    'icon' => $module->icon,
                    'method' => $module->method,
                    'sort' => $module->sort,
                    'children_method' => explode(',', $module->child),
                    'children' => $children,
                ];
            })
            ->toArray();
        return SiteHelper::buildTree($parents);
        // return $parents;
    }
    public function canAccess($permission)
    {
        if (in_array($permission, $this->allPermissions)) {
            return true;
        }
        return false;
    }
}
