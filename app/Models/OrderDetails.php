<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "orderdetails";
    protected $primaryKey = 'OrderId';

    public function order()
    {
        return $this->belongsTo(Orders::class, 'OrderId', 'OrderId');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'ProductId', 'ProductId');
    }
}
