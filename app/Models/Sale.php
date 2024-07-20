<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
     protected $table="sale";

     protected $fillable = [
        'product_id',
        'customer_id',
        'purchase_value',
        'purchased_amount'
     ];
}
