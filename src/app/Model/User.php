<?php

namespace Model;

class User extends AbstractModel
{
    protected $firstname;
    protected $lastname;

    public function initialize()
    {
        // Tabla neve
        $this->setSource('user');
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
}
