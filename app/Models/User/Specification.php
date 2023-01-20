<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specification extends Model
{
    use HasFactory;

    protected $table = 'specifications';

    protected $fillable = ['ar_name', 'en_name','value', 'product_id', 'created_at', 'updated_at'];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
