<?php

abstract class Article {

    // const TYPE_TSHIRT = 1;
    // const TYPE_PANTS = 2;
    
    protected $id;
    protected $category_id;
    protected $name;
    protected $description;
    protected $price;
    protected $type;
    protected $IMG;
    protected $novedad;

    public function __construct($category_id, $name, $description, $price, $type, $IMG, $novedad) {
        $this->category_id = $category_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->type = $type;
        $this->IMG = $IMG;
        $this->novedad = $novedad;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price) {
        $this->price = $price;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of IMG
     */ 
    public function getIMG()
    {
        return $this->IMG;
    }

    /**
     * Set the value of IMG
     *
     * @return  self
     */ 
    public function setIMG($IMG)
    {
        $this->IMG = $IMG;

        return $this;
    }

    /**
     * Get the value of novedad
     */ 
    public function getNovedad()
    {
        return $this->novedad;
    }

    /**
     * Set the value of novedad
     *
     * @return  self
     */ 
    public function setNovedad($novedad)
    {
        $this->novedad = $novedad;

        return $this;
    }
}