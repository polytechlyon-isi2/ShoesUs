<?php

namespace ShoesUs\Domain;

class Bag 
{
    /**
     * id.
     *
     * @var integer
     */
    private $id;
    
    /**
     * User.
     *
     * @var User
     */
    private $user;

    /**
     * Product.
     *
     * @var Product
     */
    private $prod;
    
    /**
     * nomber of each product.
     *
     * @var integer
     */
    private $prodnumber;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }




    public function getProd() {
        return $this->prod;
    }

    public function setProd(Product $prod) {
        $this->prod = $prod;
    }
    
    
    public function getProdNumber() {
        return $this->prodnumber;
    }

 public function setProdNumber($prodnumber) {
        $this->prodnumber = $prodnumber;
    }
}