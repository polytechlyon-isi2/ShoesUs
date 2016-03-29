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
    private $name;

    /**
     * Product description.
     *
     * @var string
     */
    private $desc;

    /**
     * Product price.
     *
     * @var integer
     */
    private $price;
    
    /**
     * Product category.
     *
     * @var \ShoesUs\Domain\Category
     */
    private $category;
    
    /**
     * Product image.
     *
     * @var \ShoesUs\Domain\Category
     */
    private $image;
    
    

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

    public function getCategory() {
        return $this->category;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
    }
}