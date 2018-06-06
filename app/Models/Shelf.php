<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shelf extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
}