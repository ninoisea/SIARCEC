<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'box_id'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
