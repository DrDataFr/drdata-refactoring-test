<?php

class Template
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $subject;
    /**
     * @var string
     */
    public string $content;

    /**
     * @param int $id
     * @param string $subject
     * @param string $content
     */
    public function __construct(int $id, string $subject, string $content)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
    }
}