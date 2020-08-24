<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Orderable;
    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'title',
        'slug',
        'description',
        'feature_image',
    ];

    public function article() {
		return $this->hasMany(Articles::class);
	}
}
