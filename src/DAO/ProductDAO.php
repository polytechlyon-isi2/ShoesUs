<?php

namespace ShoesUs\DAO;

use Doctrine\DBAL\Connection;
use ShoesUs\Domain\Product;

class ProductDAO
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all products, sorted by date (most recent first).
     *
     * @return array A list of all products.
     */
    public function findAll() {
        $sql = "select * from s_product order by prod_id desc";
        $result = $this->db->fetchAll($sql);
        
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
    private function buildProduct(array $row) {
        $product = new Product();
        $product->setId($row['prod_id']);
        $product->setTitle($row['prod_title']);
        $product->setDesc($row['prod_desc']);
        $product->setPrice($row['prod_price']);
        return $product;
    }
}