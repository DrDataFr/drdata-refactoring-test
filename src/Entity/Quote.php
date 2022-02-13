<?php

class Quote
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var int
     */
    public int $siteId;
    /**
     * @var int
     */
    public int $destinationId;
    /**
     * @var DateTime
     */
    public DateTime $dateQuoted;

    /**
     * @param int $id
     * @param int $siteId
     * @param int $destinationId
     * @param DateTime $dateQuoted
     */
    public function __construct(int $id, int $siteId, int $destinationId, DateTime $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }
}