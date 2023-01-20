<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingDetails extends Model
{
    use HasFactory;

    protected $table = 'shipping_details';

    protected $fillable = ['user_id', 'full_name', 'order_id', 'country', 'address1', 'address2', 'phone_number', 'email', 'town', 'postcode', 'created_at', 'updated_at'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
