<?php

namespace Darvis\Manta\Traits;

trait HasTranslations
{
    /**
     * Get all translations for this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(get_class($this), 'pid', 'id');
    }

    /**
     * Get a specific translation for this model
     *
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }

    /**
     * Check if a translation exists for a specific locale
     *
     * @param string $locale
     * @return bool
     */
    public function hasTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->exists();
    }
}
