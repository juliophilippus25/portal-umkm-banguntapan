<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_id',
        'product_id',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
