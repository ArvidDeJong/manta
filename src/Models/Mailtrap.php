<?php

namespace Darvis\Manta\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailtrap extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'event',
        'timestamp',
        'sending_stream',
        'category',
        'message_id',
        'event_id',
        'custom_variables',
        'data',        // Nieuwe kolom
    ];

    protected $casts = [
        'data' => 'array',
        'custom_variables' => 'array', // Zorgt ervoor dat JSON automatisch wordt geconverteerd naar een array
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
