<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'business_description',
        'business_type_id',
        'sub_district_id',
        'phone',
        'website',
        'no_pirt',
        'address',
        'avatar',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function businessType()
    {
        return $this->hasOne(BusinessType::class);
    }

    public function subDistrict()
    {
        return $this->hasOne(SubDistrict::class);
    }
}
