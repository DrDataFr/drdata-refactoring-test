<?php

class Destination
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $countryName;
    /**
     * @var string
     */
    public string $conjunction;
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $computerName;

    /**
     * @param int $id
     * @param string $countryName
     * @param string $conjunction
     * @param string $computerName
     */
    public function __construct(int $id, string $countryName, string $conjunction, string $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }
}
