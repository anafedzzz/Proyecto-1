<?php

class Category {
    
    protected $id;
    protected $name;
    protected $description;
    protected $IMG;

    public function __construct() {}

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

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
}