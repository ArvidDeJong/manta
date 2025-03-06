<?php

namespace Darvis\Manta\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Darvis\Manta\Traits\HasUploadsTrait;

class Routeseo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUploadsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by',
        'pid',
        'locale',
        'title',
        'route',
        'seo_title',
        'seo_description',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * @param mixed $value 
     * @return mixed 
     */
    public function getDataAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
