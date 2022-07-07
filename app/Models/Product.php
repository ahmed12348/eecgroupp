<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    use HasFactory;
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'product_pharmacy');
    }
}
