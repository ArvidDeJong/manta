<?php

namespace Darvis\Manta\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'created_by',
        'updated_by',
        'deleted_by',
        'company_id',
        'host',
        'locale',
        'pid',
        'model',
        'key',
        'value',
        'data',        // Nieuwe kolom
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

    private static ?int $userId = null;

    public static function set(string $key, $value, ?string $model = null, string $locale): void
    {
        // Initialize user ID once per request
        if (self::$userId === null) {
            self::$userId = Auth::guard('staff')->id() ?? null;
            if (self::$userId === null) {
                return; // Early exit if no authenticated staff user
            }
        }

        self::updateOrCreate(
            ['key' => $key, 'model' => $model, 'locale' => $locale],
            ['updated_by' => self::$userId, 'value' => $value]
        );
    }

    public static function get(string $key, ?string $model = null, string $locale)
    {

        $defaults = [
            'DEFAULT_LATITUDE' => env('DEFAULT_LATITUDE'),
            'DEFAULT_LONGITUDE' => env('DEFAULT_LONGITUDE'),
            'GOOGLE_MAPS_ZOOM' => env('GOOGLE_MAPS_ZOOM'),
        ];
        if ($locale == null) {
            $locale = env('APP_LOCALE');
        }

        if ($locale != null) {
            $item = self::where(['key' => $key, 'model' => $model, 'locale' => $locale])->first();
        }
        // dd($key, $model);
        // Check if item is found and not empty, else set default if available
        if ($item) {
            return $item->value;
        }

        // Check if a default value exists in env variables
        $defaultValue = $defaults[$key] ?? null;

        if ($defaultValue == null) {

            self::set($key, $defaultValue, $model, $locale);
            return $defaultValue;
        }

        return null;
    }
}
