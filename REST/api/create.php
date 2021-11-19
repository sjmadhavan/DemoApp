<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    session_start();
    
    include_once '../config/database.php';
    include_once '../class/basket.php';
    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    switch ($_GET['con']) {
        case 1:
            $product = new Product($db);
            $data = json_decode(file_get_contents("php://input"));
            $item->name = $data->name;
            $item->image = $data->image;
            $item->price = $data->price;
            if($item->addProduct()){
                echo 'Product added successfully.';
            } else{
                echo 'Product could not be added.';
            }
            break;
        case 2:
        default:
            $product_data = json_decode(file_get_contents("php://input"));
            $basket = new Basket();
            $items = $basket->addItem($product_data);
            break;
    }
    



?>