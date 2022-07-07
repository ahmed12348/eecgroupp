<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $table = 'pharmacies';
    protected $guarded = [];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_pharmacy');
    }
}
