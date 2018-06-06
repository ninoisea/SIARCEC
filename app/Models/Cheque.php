<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model, SoftDeletes };

class Cheque extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'num', 'beneficiary', 'bank_id', 'dated_at', 'total', 'folder_id', 'state', 'num_box'
	];

	protected $hidden = [
		'deleted_at', 'created_at', 'updated_at'
	];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function image()
    {
        return $this->belongsToMany(Image::class);
    }
}
