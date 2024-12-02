<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['username', 'password', 'role_id','validasiPassword'];

    public function peran()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }


    public function roless()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

    // Relasi dengan model Roles
    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    // Mutator untuk mengenkripsi password
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
