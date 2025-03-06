<?php

namespace Darvis\Manta\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iplist extends Model
{
    use HasFactory;

    // Velden die ingevuld mogen worden
    protected $fillable = ['ip', 'times', 'description', 'white', 'data'];

    // Optioneel: casts voor booleans
    protected $casts = [
        'data' => 'array',
        'white' => 'boolean',
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
