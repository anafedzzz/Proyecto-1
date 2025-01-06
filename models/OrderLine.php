<?php

class OrderLine {
    private $line_number; // Se genera dinámicamente con el índice del carrito
    private $article_id; // ID del artículo en el pedido
    private $quantity; // Cantidad del artículo
    private $price; // Precio del artículo
    private $special_offer_id; // ID de oferta especial, si aplica
    private $total; // Precio total de la línea

    // Constructor
    public function __construct($article_id = null, $quantity = null, $price = null, $special_offer_id = null) {
        if ($article_id !== null && $quantity !== null && $price !== null) {
            $this->article_id = $article_id;
            $this->quantity = $quantity;
            $this->price = $price;
            $this->special_offer_id = $special_offer_id;
            $this->total = $quantity * $price;
        }
    }

    // Getters y Setters

    public function getLineNumber() {
        return $this->line_number;
    }

    public function setLineNumber($line_number) {
        $this->line_number = $line_number;
    }

    public function getArticleId() {
        return $this->article_id;
    }

    public function setArticleId($article_id) {
        $this->article_id = $article_id;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        $this->total = $quantity*$this->price;
    }

    public function getSpecialOfferId() {
        return $this->special_offer_id;
    }

    public function setSpecialOfferId($special_offer_id) {
        $this->special_offer_id = $special_offer_id;
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
