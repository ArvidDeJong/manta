<?php

namespace Darvis\Manta\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'remember_token',
        'current_team_id',
        'profile_photo_path',
        'must_change_password',
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id',
        'host',
        'pid',
        'locale',
        'active',
        'relation_nr',
        'debtor_nr',
        'creditor_nr',
        'user_nr',
        'address_nr',
        'number',
        'sex',
        'initials',
        'lastname',
        'firstnames',
        'nameInsertion',
        'company',
        'companyNr',
        'taxNr',
        'address',
        'housenumber',
        'addressSuffix',
        'zipcode',
        'city',
        'country',
        'state',
        'birthdate',
        'birthcity',
        'phone',
        'phone2',
        'bsn',
        'iban',
        'maritalStatus',
        'lastLogin',
        'code',
        'admin',
        'developer',
        'comment',
        'contactperson_id',
        'administration',
        'identifier',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    public function company_contact()
    {
        return   $this->belongsTo(Contactperson::class, 'contactperson_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class)->where(['user_id' => Auth::user()->id])->whereNull('cartdetail_id');
    }
}
