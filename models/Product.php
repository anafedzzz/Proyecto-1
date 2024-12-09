<?php
include_once("models/Article.php");

class Product extends Article {
    private $allergies; // Lista de alergias asociadas

    public function __construct() {}

    public function getAllergies() {
        return $this->allergies;
    }

    public function setAllergies($allergies) {
        $this->allergies = $allergies;
    }
}