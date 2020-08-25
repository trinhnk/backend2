<?php

namespace App;

use App\Traits\Orderable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	use Orderable;
	use ElasticquentTrait;
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

	// Elasticsearch
	protected $mappingProperties = array(
        'title' => [
          'type' => 'text',
          "analyzer" => "standard",
		],
		'slug' => [
			'type' => 'text',
			"analyzer" => "standard",
		],
        'description' => [
          'type' => 'text',
          "analyzer" => "standard",
		],
		'content' => [
			'type' => 'text',
			"analyzer" => "standard",
		],
		'user_id' => [
			'type' => 'text',
			"analyzer" => "standard",
		],
		'category_id' => [
			'type' => 'text',
			"analyzer" => "standard",
		],
		'status' => [
			'type' => 'text',
			"analyzer" => "standard",
		],
    );
}
