<?php

namespace Darvis\Manta\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected static function booted()
    {
        static::creating(function ($item) {
            $item->created_by = auth('staff')->user()->name;
        });

        static::updating(function ($item) {
            $item->updated_by = auth('staff')->user()->name;
        });

        static::deleting(function ($item) {
            $item->deleted_by = auth('staff')->user()->name;
        });
    }

    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by',
        'host',
        'pid',
        'locale',
        'active',
        'administration',
        'identifier',
        'relation_nr',
        'debtor_nr',
        'user_nr',
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
        'data',        // Nieuwe kolom
    ];

    protected $casts = [
        'data' => 'array',
        'active' => 'boolean',
        'birthdate' => 'date',
    ];

    protected $attributes = [
        'country' => 'nl',
        'active' => 1,
    ];

    /**
     * @param mixed $value 
     * @return mixed 
     */
    public function getDataAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Scope for active companies.
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Get full name of the person.
     */
    public function getFullNameAttribute()
    {
        return trim("{$this->initials} {$this->nameInsertion} {$this->lastname}");
    }
}
