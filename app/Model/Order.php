<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'table_number', 'total', 'payment_id', 'user_id', 'created_at', 'updated_at',
    ];

    public function payment()
    {
    	return $this->belongsTo(Payment::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
    	return $this->hasMany(OrderDetail::class);
    }
}
