<?php

class Site
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $url;

    /**
     * @param int $id
     * @param string $url
     */
    public function __construct(int $id, string $url)
    {
        $this->id = $id;
        $this->url = $url;
    }
}
