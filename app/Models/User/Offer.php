<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = ['offer_name', 'value','product_id','offer_image', 'starts_at', 'ends_at'];

    public $timestamps = false;

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
