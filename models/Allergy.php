<?php

class Allergy {
    private $id;
    private $name;
    private $description;

    // Constructor
    public function __construct($name = null, $description = null, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    // Getters y Setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    // Método para convertir la clase en un array
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    // Método para construir un objeto desde un array
    public static function fromArray($array) {
        return new Allergy(
            $array['name'] ?? null,
            $array['description'] ?? null,
            $array['id'] ?? null
        );
    }
}

?>
