<?php

namespace ShoesUs\DAO;

use ShoesUs\Domain\Product;

class ProductDAO extends DAO
{   
    /**
     * @var \ShoesUs\DAO\CategoryDAO
     */
    private $categoryDAO;
    
    public function setcategoryDAO(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }
    
        /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \ShoesUs\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from s_product where prod_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }

        /**
     * Return a list of all products for a category, sorted by date (most recent last).
     *
     * @param integer $categoryID The category id.
     *
     * @return array A list of all products for the category.
     */
    public function findAllByCategory($categoryID) {
        // The associated category is retrieved only once
        $category = $this->categoryDAO->find($categoryID);

        // cat_id is not selected by the SQL query
        // The catgeory won't be retrieved during domain objet construction
        $sql = "select prod_id, prod_name, prod_desc, prod_price, prod_cat, prod_image from s_product where prod_cat=? order by prod_id";
        $result = $this->getDb()->fetchAll($sql, array($categoryID));

        // Convert query result to an array of domain objects
        $products = array();
        foreach ($result as $row) {
            $productId = $row['prod_id'];
            $product = $this->buildDomainObject($row);
            // The associated article is defined for the constructed comment
            $product->setCategory($category);
            $products[$productId] = $product;
        }
        return $products;
    }
    
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
            $products[$productId] = $this->buildDomainObject($row);
        }
        return $products;
    }

    /**
     * Creates an product object based on a DB row.
     *
     * @param array $row The DB row containing product data.
     * @return \ShoesUs\Domain\product
     */
    protected function buildDomainObject($row) {
        $product = new Product();
        $product->setId($row['prod_id']);
        $product->setName($row['prod_name']);
        $product->setDesc($row['prod_desc']);
        $product->setPrice($row['prod_price']);
        $product->setImage($row['prod_image']);
        $categoryID = $row['prod_cat'];
        $category = $this->categoryDAO->find($categoryID);
        $product->setCategory($category);
        return $product;
    }
    
    
        /**
     * Saves an product into the database.
     *
     * @param \ShoesUs\Domain\Product $product The product to save
     */
    public function save(Product $product) {
        $productData = array(
            'prod_name' => $product->getName(),
            'prod_desc' => $product->getDesc(),
            'prod_price' => $product->getPrice(),
            'prod_image' => $product->getImage()
            
            );

        if ($product->getId()) {
            // The product has already been saved : update it
            $this->getDb()->update('s_product', $productData, array('prod_id' => $product->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('s_product', $productData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $product->setId($id);
        }
    }

    /**
     * Removes an product from the database.
     *
     * @param integer $id The product id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('s_product', array('prod_id' => $id));
    }
}