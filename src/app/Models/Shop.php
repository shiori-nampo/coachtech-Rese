<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'genre_id',
        'name',
        'shop_overview',
        'image',
        'price_name',
        'price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }


    public function is_favorited_by_auth_user()
    {
        $user_id = auth()->id();

        return $this->favorites()->where('user_id', $user_id)->exists();
    }

}
