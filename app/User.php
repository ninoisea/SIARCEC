<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'last_name', 'num_id', 'role_id', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function fullName()
    {
        $name = explode(' ', $this->name);
        $last_name = explode(' ', $this->last_name);
        return ucfirst($name[0]) . ' ' . ucfirst($last_name[0]);
    }

    public function role()
    {
        return $this->belongsTo(Models\Role::class);
    }
}
