<?php

class User {

    public function __construct(
        private $id,
        private $fullName,
        private $username,
        private $password
    ) { }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}


?>