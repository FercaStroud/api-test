<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'hbkey', 'first_name', 'last_name', 'date_birth', 'address', 'role', 'password', 'mobile_phone', 'email'
    ];

    protected $hidden = [
        'password',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
