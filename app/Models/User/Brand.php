<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $table ='brands';

    protected $fillable = ['ar_name', 'en_name','created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
