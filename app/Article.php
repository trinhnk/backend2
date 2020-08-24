<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Orderable;
    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'user_id',
        'category_id',
        'status'
    ];

    public function user() {
		return $this->belongsTo(User::class);
    }
    
    public function category() {
		return $this->belongsTo(Category::class);
	}
}
