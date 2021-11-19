<?php
class Basket{

    // Db connection
    public function __construct($db){
    }
    
    // GET
    public function getCart(){
        if(isset($_SESSION["shopping_cart"]))
        {
            echo json_encode($_SESSION["shopping_cart"]);
        }
    }
    
    // ADD
    public function addItem(){
        $product_data = json_decode(file_get_contents("php://input"));
        $product_id = $product_data->id;
        $product_name = $product_data->name;
        $product_price = $product_data->price;
        
        if(isset($_SESSION["shopping_cart"]))
        {
            $is_available = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $product_id)
                {
                    $is_available++;
                    $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + 1;
                }
            }
            if($is_available == 0)
            {
                $item_array = array(
                    'product_id'               =>     $product_id,
                    'product_name'             =>     $product_name,
                    'product_price'            =>     $product_price,
                    'product_quantity'         =>     1
                );
                $_SESSION["shopping_cart"][] = $item_array;
            }
        }
        else
        {
            $item_array = array(
                'product_id'               =>     $product_id,
                'product_name'             =>     $product_name,
                'product_price'            =>     $product_price,
                'product_quantity'         =>     1
            );
            $_SESSION["shopping_cart"][] = $item_array;
            
        }
    }
    
    
    
    // DELETE
    function deleteItem(){
        $product_data = json_decode(file_get_contents("php://input"));
        $product_id = $product_data;
        
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["product_id"] == $product_id)
            {
                unset($_SESSION["shopping_cart"][$keys]);
            }
        }
    }
    
}
?>