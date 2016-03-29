<?php

namespace ShoesUs\DAO;

use ShoesUs\Domain\Bag;

class BagDAO extends DAO
{
    
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
    
    



    /**
     * Creates an category object based on a DB row.
     *
     * @param array $row The DB row containing category data.
     * @return \ShoesUs\Domain\Category
     */
    protected function buildDomainObject($row) {
        $bag = new Bag();
        $bag->setId($row['bag_id']);
        $userID = $row['bag_user'];
        $user = $this->userDAO->find($userID);
        $bag->setProd($user);
        $prodID = $row['bag_prod'];
        $product = $this->productDAO->find($prodID);
        $bag->setProd($product);
        $bag->setProdNumber($row['bag_prod_nbr']);
        return $bag;
    }
    
    public function delete($user,$prod) {
        // Delete the article
        $this->getDb()->delete('s_bag', array('user_id' => $user,'prod_id' => $prod));
    }
}