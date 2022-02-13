<?php

class User
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $firstname;
    /**
     * @var string
     */
    public string $lastname;
    /**
     * @var string
     */
    public string $email;

    /**
     * @param int $id
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     */
    public function __construct(int $id, string $firstname, string $lastname, string $email)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }
}
