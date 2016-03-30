<?php

namespace ShoesUs\DAO;

use ShoesUs\Domain\Bag;


class BagDAO extends DAO
{
    /**
     * @var \ShoesUs\DAO\ProductDAO
     */
    private $productDAO;
    
    /**
     * @var \ShoesUs\DAO\UserDAO
     */
    private $userDAO;
    
    
    public function setProductDAO(ProductDAO $productDAO) {
        $this->productDAO = $productDAO;
    }
    
    public function setUserDAO(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }
    
        /**
     * Return a list of all products, sorted by id.
     *
     * @return array A list of all products.
     */
    public function findAll($user) {
        $sql = "select * from s_bag where bag_user=?";
        $result = $this->getDb()->fetchAll($sql, array($user));
        
        // Convert query result to an array of domain objects
        $bag = array();
        foreach ($result as $row) {
            $bagID = $row['bag_id'];
            $bag[$bagID] = $this->buildDomainObject($row);
        }
        return $bag;
    }
    
    public function find($user, $id) {
        $sql = "select * from s_bag where bag_user=? and bag_prod=?";
        $row = $this->getDb()->fetchAssoc($sql, array($user, $id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No prod matching id " . $id);
    }



    /**
     *
     *
     * @param array $row The DB row containing bag data.
     * @return \ShoesUs\Domain\Bag
     */
    protected function buildDomainObject($row) {
        $bag = new Bag();
        $bag->setId($row['bag_id']);
        $userId = $row['bag_user'];
        $user = $this->userDAO->find($userId);
        $bag->setUser($user);
        $product = $this->productDAO->find($row['bag_prod']);
        $bag->setProd($product);
        $bag->setProdNumber($row['bag_prod_nbr']);
        return $bag;
    }
    
    public function delete($user,$prod) {
        $r=$this->find($user,$prod);
        if($r->getProdNumber()==1){
            // add the product
            $this->getDb()->delete('s_bag', array('bag_user' => $user,'bag_prod' => $prod));
        }
        else{
            $bagData = array(
                'bag_user' => $r->getUser()->getId(),
                'bag_prod' => $r->getProd()->getId(),
                'bag_prod_nbr' => $r->getProdNumber()-1
            );
            $this->getDb()->update('s_bag', $bagData, array('bag_user' => $r->getUser()->getId(), 'bag_prod' => $r->getProd()->getId()));
        }
    }
    
    public function add($user,$prod) {
        $sql = "select * from s_bag where bag_user=? and bag_prod=?";
        $row = $this->getDb()->fetchAssoc($sql, array($user, $prod));

        if ($row){
            $r=$this->buildDomainObject($row);
            $bagData = array(
                'bag_user' => $r->getUser()->getId(),
                'bag_prod' => $r->getProd()->getId(),
                'bag_prod_nbr' => $r->getProdNumber()+1
            );
            $this->getDb()->update('s_bag', $bagData, array('bag_user' => $r->getUser()->getId(), 'bag_prod' => $r->getProd()->getId()));
        }
        else{
            // add the product
            $this->getDb()->insert('s_bag', array('bag_user' => $user,'bag_prod' => $prod, 'bag_prod_nbr' => 1));
        }
    }
}