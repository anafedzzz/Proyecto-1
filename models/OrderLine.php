<?php

class OrderLine {
    private $lineNumber; // Se genera dinámicamente con el índice del carrito
    private $articleId; // ID del artículo en el pedido
    private $quantity; // Cantidad del artículo
    private $price; // Precio del artículo
    private $specialOfferId; // ID de oferta especial, si aplica
    private $total; // Precio total de la línea

    // Constructor
    public function __construct() {}

    // Getters y Setters

    public function getLineNumber() {
        return $this->lineNumber;
    }

    public function setLineNumber($lineNumber) {
        $this->lineNumber = $lineNumber;
    }

    public function getArticleId() {
        return $this->articleId;
    }

    public function setArticleId($articleId) {
        $this->articleId = $articleId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        $this->total = $quantity*$this->price;
    }

    public function getSpecialOfferId() {
        return $this->specialOfferId;
    }

    public function setSpecialOfferId($specialOfferId) {
        $this->specialOfferId = $specialOfferId;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal() {
        $this->total = $this->quantity*$this->price;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}

?>
