<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    session_start();
    include_once '../config/database.php';
    include_once '../class/basket.php';
    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    switch ($_GET['con']) {
        case 1:
            $product = new Product($db);
            $items = $product->getProducts();
            break;
        case 2:    
        default:    
            $basket = new Basket();
            $items = $basket->getCart();
            break;
    }

    if(!empty($items)){
        echo json_encode($items);
    }

?>