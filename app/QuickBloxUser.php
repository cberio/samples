<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class QuickBloxUser extends Authenticatable
{
    use Notifiable;

    public $fillable = [
        'name',
        'full_name',
        'email',
        'password',
        'blob_id',
        'chat_id',
        'phone',
        'custom',
        'tags',
    ];

    protected $table = 'quick_blox_users';

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'custom' => 'json',
        'tags'   => 'array',
    ];
}
