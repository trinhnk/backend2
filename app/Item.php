<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use ElasticquentTrait;

    public $fillable = ['title','description'];

    protected $mappingProperties = array(
        'title' => [
          'type' => 'text',
          "analyzer" => "standard",
        ],
        'description' => [
          'type' => 'text',
          "analyzer" => "standard",
        ],
    );
}
