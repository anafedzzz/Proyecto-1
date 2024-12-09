<?php

class User {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $phoneNumber;
    private $address;
    private $roleId;

    // Constructor
    public function __construct($name, $surname, $email, $password, $phoneNumber = null, $address = null, $roleId = null) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->roleId = $roleId;
    }

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

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getAddress() {
        return $this->address;
    }
    public function setAddress($address) {
        $this->address = $address;
    }

    public function getRoleId() {
        return $this->roleId;
    }
    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

}

?>
