<?php

namespace ShoesUs\DAO;

use ShoesUs\Domain\Category;

class CategoryDAO extends DAO
{
    /**
     * Returns an catgeory matching the supplied id.
     *
     * @param integer $id
     *
     * @return \ShoesUs\Domain\Category|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from s_category where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }
    /**
     * Return a list of all category, sorted by id.
     *
     * @return array A list of all catgories.
     */
    public function findAll() {
        $sql = "select * from s_category order by cat_id";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $category = array();
        foreach ($result as $row) {
            $categoryID = $row['cat_id'];
            $category[$categoryID] = $this->buildDomainObject($row);
        }
        return $category;
    }

    
    /**
     * Creates an category object based on a DB row.
     *
     * @param array $row The DB row containing category data.
     * @return \ShoesUs\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setId($row['cat_id']);
        $category->setName($row['cat_name']);
        return $category;
    }
}