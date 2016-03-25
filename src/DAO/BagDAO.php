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
    public function find($id) {
        $sql = "select * from s_bag where bag_user=?";
        $result = $this->getDb()->fetchAll($sql, array($id));
        
        // Convert query result to an array of domain objects
        $bag = array();
        foreach ($bag as $row) {
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
        $bag->setUser($row['bag_user']);
        $prodID = $row['bag_prod'];
        $product = $this->productDAO->find($prodID);
        $product->setProd($product);
        return $bag;
    }
    
    public function delete($user,$prod) {
        // Delete the article
        $this->getDb()->delete('s_bag', array('user_id' => $user,'prod_id' => $prod));
    }
}