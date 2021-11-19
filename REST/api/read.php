<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/basket.php';
    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    switch ($_GET['con']) {
        case 1:
            $product = new Product($db);
            $items = $product->getProducts();
            $itemCount = $items->rowCount();
        case 2:    
        default:    
            $basket = new Basket();
            $items = $basket->getCart();
            $itemCount = 1;
    }

    if($itemCount > 0){
        echo json_encode($items);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>