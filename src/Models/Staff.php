<?php

namespace Darvis\Manta\Models;

use Manta\Notifications\StaffResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Darvis\Manta\Traits\HasUploadsTrait;

class Staff  extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    use HasUploadsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id',
        'host',
        'pid',
        'locale',
        'active',
        'sort',
        'name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'lastLogin',
        'code',
        'admin',
        'developer',
        'comments',
        'data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * @param mixed $value 
     * @return mixed 
     */
    public function getDataAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StaffResetPasswordNotification($token));
    }
}
