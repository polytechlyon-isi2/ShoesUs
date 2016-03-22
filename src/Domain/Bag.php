<?php

namespace ShoesUs\Domain;

class Product 
{
    /**
     * User.
     *
     * @var integer
     */
    private $user;

    /**
     * Product.
     *
     * @var integer
     */
    private $prod;
    

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }




    public function getProd() {
        return $this->prod;
    }

 public function setProd(Product $prod) {
        $this->prod = $prod;
    }
}