<?php
include_once("models/Article.php");

class Complement extends Article {
    private $specialOffers; // Ofertas especiales asociadas al complemento

    public function __construct($category_id, $name, $description, $price, $type, $specialOffers = []) {
        parent::__construct($category_id, $name, $description, $price, $type);
        $this->specialOffers = $specialOffers;
    }

    public function getSpecialOffers() {
        return $this->specialOffers;
    }

    public function setSpecialOffers($specialOffers) {
        $this->specialOffers = $specialOffers;
    }
}
