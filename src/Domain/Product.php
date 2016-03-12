<?php

namespace ShoesUs\Domain;

class Product 
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
    private $title;

    /**
     * Product description.
     *
     * @var string
     */
    private $desc;

    /**
     * Product price.
     *
     * @var string
     */
    private $price;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}