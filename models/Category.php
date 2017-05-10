<?php

class Category
{

    /**
     * Returns an array of categories
     */
    public static function getCategoriesList()
    {

        $db = Db::getConnection();
        
        try {
        
            foreach($db->query('SELECT * from category') as $row) {
                print_r($row);
            }
            $db = null;
            } 
        catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
        }
        
        $categoryList = array();

        $result = $db->query('SELECT * from category');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }

}