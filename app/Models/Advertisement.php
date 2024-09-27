<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'ad_start',
        'ad_end',
        'business_id',
        'image',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function advertisementProducts()
    {
        return $this->hasMany(AdvertisementProduct::class, 'advertisement_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'advertisement_products', 'advertisement_id', 'product_id');
    }

    public function getIsExpiredAttribute()
    {
        return Carbon::today()->greaterThan($this->ad_end);
    }
}
