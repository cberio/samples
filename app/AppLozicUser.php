<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AppLozicUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'app_lozic_users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'device_type',
        'authentication_type',
        'registration_id',
        'push_notification_format',
        'contact_number',
        'unread_count_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'id'                       => 'string',
        'device_type'              => 'integer',
        'authentication_type'      => 'boolean',
        'push_notification_format' => 'boolean',
        'unread_count_type'        => 'boolean',
    ];
}
