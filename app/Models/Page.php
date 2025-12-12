<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = [
        'slug',
        'title',
        'route',
        'data',
        'order'
    ];

    protected $casts = [
        'data'=>'json',
        'title'=>'json',
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getTitleAttribute()
    {
        return $this->getTranslation('title');
    }
    

    public function getTranslatedDataAttribute()
    {
        $locale = app()->getLocale();
        $fallback = config('app.fallback_locale', 'en');
        
        if (empty($this->data)) {
            return [];
        }
        
        $data = is_array($this->data) ? $this->data : json_decode($this->data, true);
        
        return $this->translateNestedArray($data, $locale, $fallback);
    }
    

    public function getTranslation($key, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $fallback = config('app.fallback_locale', 'en');
        
        $value = $this->attributes[$key] ?? $this->$key ?? null;
        
        if (is_array($value)) {
            return $value[$locale] ?? $value[$fallback] ?? reset($value) ?? null;
        }
        
        if ($this->isJson($value)) {
            $translations = json_decode($value, true);
            return $translations[$locale] 
                ?? $translations[$fallback] 
                ?? reset($translations)
                ?? null;
        }
        
        return $value;
    }
    
    public function getDataByLocale($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $fallback = config('app.fallback_locale', 'en');
        
        if (empty($this->data)) {
            return [];
        }
        
        $data = is_array($this->data) ? $this->data : json_decode($this->data, true);
        
        return $this->translateNestedArray($data, $locale, $fallback);
    }
    

    protected function translateNestedArray($array, $locale, $fallback)
    {
        $result = [];
        
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (isset($value[$locale]) || isset($value[$fallback]) || 
                    array_key_exists('en', $value) || 
                    array_key_exists('zh_hk', $value)) {
                    $result[$key] = $value[$locale] ?? $value[$fallback] ?? reset($value);
                } else {
                    $result[$key] = $this->translateNestedArray($value, $locale, $fallback);
                }
            } else {
                $result[$key] = $value;
            }
        }
        
        return $result;
    }
    
    protected function isJson($string)
    {
        if (!is_string($string)) {
            return false;
        }
        
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

}
