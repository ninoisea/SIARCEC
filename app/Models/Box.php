<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'shelf_id'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function folder()
    {
        return $this->hasMany(Folder::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
