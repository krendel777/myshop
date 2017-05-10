<?php

class Product
{
    const SHOW_BY_DEFAULT =10;
   
    
    //ВВОЗРАЩАЕТ МАССИВ ПРОДУКТОВ
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) 
    {
        $count= intval($count);
        
        $db = Db::getConnection();
        print_r($db);
        $productList = array();
        
        $result = $db->query('SELECT id,name, image, is_new FROM product '
                .'WHERE status = "1"'
                .'ORDER BY id DESC '
                .'LIMIT '.$count);
        
        
        $i = 0;
        while ($row = $result->fetch()){
            $productList[$i]['id']= $row['id'];
            $productList[$i]['name']=$row['name'];
            $productList[$i]['image']=$row['image'];
            $productList[$i]['price']=$row['price'];
            $productList[$i]['is_new']=$row['is_new'];
            $i++;
        }
        
        return $productList;
    }
    


}