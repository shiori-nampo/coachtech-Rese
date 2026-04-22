<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'time',
        'number',
        'checked_in',
        'reminder_sent_at',
        'is_paid',
    ];


    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }


    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }


    public function getTotalPrice()
    {
        return $this->shop->price * $this->number;
    }

}
