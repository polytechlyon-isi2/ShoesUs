<?php

namespace ShoesUs\Domain;

class Category 
{
    /**
     * Product id.
     *
     * @var integer
     */
    private $id;

    /**
     * Product title.
     *
     * @var string
     */
    private $name;


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
}