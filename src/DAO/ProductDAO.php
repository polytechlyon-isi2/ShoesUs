<?php

namespace ShoesUs\DAO;

use ShoesUs\Domain\Product;

class ProductDAO extends DAO
{

    /**
     * Return a list of all products, sorted by date (most recent first).
     *
     * @return array A list of all products.
     */
    public function findAll() {
        $sql = "select * from s_product order by prod_id desc";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $Products = array();
        foreach ($result as $row) {
            $productId = $row['prod_id'];
            $products[$productId] = $this->buildProduct($row);
        }
        return $products;
    }

    /**
     * Creates an product object based on a DB row.
     *
     * @param array $row The DB row containing product data.
     * @return \ShoesUs\Domain\product
     */
    private function buildDomainObject(array $row) {
        $product = new Product();
        $product->setId($row['prod_id']);
        $product->setName($row['prod_name']);
        $product->setDesc($row['prod_desc']);
        $product->setPrice($row['prod_price']);
        $product->setCategory($row['prod_cat']);
        return $product;
    }
}