<?php

class Order {
    private $id;
    private $user_id;
    private $date;
    private $status;
    private $promo_code_id;
    private $total;

    // Constructor
    public function __construct() {}

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of promo_code_id
     */ 
    public function getPromo_code_id()
    {
        return $this->promo_code_id;
    }

    /**
     * Set the value of promo_code_id
     *
     * @return  self
     */ 
    public function setPromo_code_id($promo_code_id)
    {
        $this->promo_code_id = $promo_code_id;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }
}