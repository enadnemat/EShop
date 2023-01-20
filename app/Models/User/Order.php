<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['user_id', 'total_price', 'status', 'created_at', 'updated_at'];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function user():BelongsTo
    {
       return $this->belongsTo(User::class);
    }

}
