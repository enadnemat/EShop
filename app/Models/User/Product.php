<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['ar_name', 'en_name', 'price', 'previous_price',
        'description', 'thumbnail', 'category_id', 'brand_id',
        'color_id', 'featured', 'inspired', 'created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

}
