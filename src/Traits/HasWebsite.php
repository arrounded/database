<?php
namespace Arrounded\Database\Traits;

trait HasWebsite
{
    ////////////////////////////////////////////////////////////////////
    //////////////////////////// ATTRIBUTES ////////////////////////////
    ////////////////////////////////////////////////////////////////////

    /**
     * Mutator for website.
     */
    public function getWebsiteAttribute()
    {
        return $this->sanitizeWebsite($this->attributes['website']);
    }

    /**
     * Mutator for website.
     *
     * @param array $value
     */
    public function setWebsiteAttribute($value)
    {
        $this->attributes['website'] = $this->sanitizeWebsite($value);
    }

    /**
     * Prefix with http if not present.
     *
     * @param string $url
     *
     * @return string
     */
    public function sanitizeWebsite($url)
    {
        // Don't sanitize what does not exists.
        if (!$url) {
            return '';
        }

        if (substr($url, 0, 7) !== 'http://' && substr($url, 0, 8) !== 'https://') {
            $url = 'http://'.$url;
        }

        return $url;
    }
}
