<?php

class Person{
    private $id;
    private $firstname;
    private $lastname;
    private $sex;
    private $birthdate;

    function __construct($id, $firstname, $lastname, $sex, $birthdate) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->sex = $sex;
        $this->birthdate = new DateTime($birthdate);
    }

    public function getId(){
        return $this->id;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function getSex(){
        return $this->sex;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }

    public function getAgeInDays(){
        return (new DateTime())->diff($this->birthdate)->days;
    }
}