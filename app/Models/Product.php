<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'business_id',
        'product_type_id',
        'image',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function advertisementProducts()
    {
        return $this->hasMany(AdvertisementProduct::class, 'product_id');
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_products', 'product_id', 'advertisement_id');
    }
}
