<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'buyer_id',
        'seller_id',
        'status'
    ];

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id');
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function latestMessage(){
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
