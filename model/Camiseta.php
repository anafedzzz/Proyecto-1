<?php 

class Camiseta extends Producto{

    public function __construct($nombre,$precio,$talla)
    {
        parent::__construct($nombre,$precio,$talla);
    }

}

?>