<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use Orderable;
	  
    public function user() {
		return $this->belongsTo(User::class);
    }
    
    public function article() {
		return $this->belongsTo(Article::class);
	}
}
