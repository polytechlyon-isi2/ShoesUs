<?php

namespace ShoesUs\DAO;

use ShoesUs\Domain\Bag;

class BagDAO extends DAO
{

    /**
     * Return a list of all products, sorted by id.
     * 
     * @return array A list of all catgories.
     */
    public function find($id) {
        $sql = "select * from s_bag where user_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }
    
    public function findProduct($id){
        $row = this->find($id);
    
    



    /**
     * Creates an category object based on a DB row.
     *
     * @param array $row The DB row containing category data.
     * @return \ShoesUs\Domain\Category
     */
    protected function buildDomainObject($row) {
        $bag = new Bag();
        $bag->setUser($row['user_id']);
        $prodID = $row['prod_id'];
        $product = $this->productDAO->find($prodID);
        $product->setProd($product);
        return $bag;
    }
    
    public function delete($user,$prod) {
        // Delete the article
        $this->getDb()->delete('s_bag', array('user_id' => $user,'prod_id' => $prod));
    }
}