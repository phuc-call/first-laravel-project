<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Chỉ định bảng đúng
    protected $table = 'user';  // Đảm bảo bảng là 'user', không phải 'users'

    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'address',
        'avatar',
        'roles',
        'created_by',
        'updated_by',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
