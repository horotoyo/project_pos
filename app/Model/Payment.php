<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    	'name', 'created_at', 'updated_at',
    ];

    public function order()
    {
    	return $this->hasMany(Order::class);
    }
}
