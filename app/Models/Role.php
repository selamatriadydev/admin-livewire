<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

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
            // if ( ! $model->getKey()) {
            //     $model->{$model->getKeyName()} = (string) Str::uuid();
            // }
            $model->id = Str::uuid();
            $model->guard_name = 'web';
        });
    }

    protected $fillable = ['name'];
    // protected $guard = ['guard_name'];
    protected $hidden = ['guard_name'];

}
