<?php

class User {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $phone_number;
    private $address;
    private $role_id;

    // Constructor
    public function __construct() {}

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname() {
        return $this->surname;
    }
    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPhone_number() {
        return $this->phone_number;
    }
    public function setPhone_number($phone_number) {
        $this->phone_number = $phone_number;
    }

    public function getAddress() {
        return $this->address;
    }
    public function setAddress($address) {
        $this->address = $address;
    }

    public function getRole_id() {
        return $this->role_id;
    }
    public function setRole_id($role_id) {
        $this->role_id = $role_id;
    }

}

?>
