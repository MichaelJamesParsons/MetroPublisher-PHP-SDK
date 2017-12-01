<?php

namespace MetroPublisher\Api\Models;

/**
 * Class File
 * @package MetroPublisher\Api\Models
 */
class File
{
    /** @var  string */
    protected $sourceUrl;

    /** @var  string */
    protected $storedPath;

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }

    /**
     * @param string $sourceUrl
     *
     * @return $this
     */
    public function setSourceUrl($sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getStoredPath()
    {
        return $this->storedPath;
    }

    /**
     * @param string $storedPath
     *
     * @return $this
     */
    public function setStoredPath($storedPath)
    {
        $this->storedPath = $storedPath;

        return $this;
    }
}