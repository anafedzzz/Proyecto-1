<?php
include_once("models/Article.php");

class Complement extends Article {
    private $specialOffers; // Ofertas especiales asociadas al complemento

    public function __construct() {}

    public function getSpecialOffers() {
        return $this->specialOffers;
    }

    public function setSpecialOffers($specialOffers) {
        $this->specialOffers = $specialOffers;
    }
}
