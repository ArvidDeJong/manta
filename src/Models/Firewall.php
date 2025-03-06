<?php

namespace Darvis\Manta\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/** @package Manta\Models */
class Firewall extends Model
{
    use SoftDeletes;

    /**
     * Model Events
     */
    protected static function booted()
    {
        static::creating(function ($firewall) {
            $firewall->created_by = auth('staff')->user()->name;
        });

        static::updating(function ($firewall) {
            $firewall->updated_by = auth('staff')->user()->name;
        });

        static::deleting(function ($firewall) {
            $firewall->deleted_by = auth('staff')->user()->name;
        });
    }

    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id',
        'host',
        'IP',
        'hostname',
        'email',
        'status',
        'comment',
        'data',        // Nieuwe kolom
    ];

    protected $casts = [
        'status' => 'boolean',
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
     * Relations
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Accessors and Mutators
     */
    public function getDisplayNameAttribute()
    {
        return $this->hostname ?: $this->host;
    }

    /**
     * @param mixed $domain 
     * @return string 
     */
    function checkDomainAndMx($domain)
    {
        if (gethostbyname($domain) && checkdnsrr($domain, 'MX')) {
            return null;
        } elseif (gethostbyname($domain)) {
            return "The domain $domain exists but has no MX records.";
        } else {
            return "The domain $domain does not exist.";
        }
    }
}
