<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
//        'sender_user_id',
//        'receiver_user_id',
        'payment_type_id',
        'amount',
        'type',
        'withdraw_number'
    ];

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
