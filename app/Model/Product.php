<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_id', 'name', 'price', 'status', 'deleted_at', 'created_at', 'updated_at',
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
