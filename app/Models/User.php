<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guard = 'user';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'nik',
        'nik',
        'email',
        'password',
        'avatar',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    public function generatePassword($nik, $phone)
    {
        // Ambil 4 digit terakhir dari NIK
        $nikLastFour = substr($nik, -4);

        // Ambil 4 digit terakhir dari phone
        $phoneLastFour = substr($phone, -4);

        // Gabungkan keduanya
        return $nikLastFour . $phoneLastFour;
    }

    public function getIsDefaultPasswordAttribute()
    {
        $defaultPassword = $this->generatePassword($this->nik, $this->phone);
        
        return password_verify($defaultPassword, $this->password);
    }
}
