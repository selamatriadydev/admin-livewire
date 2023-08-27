<?php

namespace App\Models;

use App\Helpers\SiteHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status_active',
        'last_seen_at'
    ];
    protected $auditStrict = true;
    protected $auditInclude = [
        'name',
        'email',
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

    public function transformAudit(array $data): array
    {
        Arr::set($data, 'keterangan',  'User');

        return $data;
    }

    public function roles(){
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
    // scope 
    public function scopeBulanIni($query){
        return $query->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
    }
    public function scopeStatusActive($query){
        return $query->where('status_active', 1);
    }
    public function scopeStatusNonActive($query){
        return $query->where('status_active', 0);
    }

    public function getRoleNameAttribute(){
        return $this->roles->name ?? '';
    }
    public function getOnlineAttribute(){
        if($this->last_seen_at){
            if(Cache::has('is_online' . $this->id)){
                return 'Online '.Carbon::parse($this->last_seen_at)->diffForHumans();
            }
            return 'Offline '.Carbon::parse($this->last_seen_at)->diffForHumans();
        }
        return 'Offline';
    }
    public function getOnlineDateAttribute(){
        return Carbon::parse($this->last_seen_at)->diffForHumans();
    }
    public function getStatusAttribute(){
        return $this->status_active == 1 ? 'Active' : 'Non Active';
    }
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
