<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/basket.php';
include_once '../class/product.php';

$database = new Database();
$db = $database->getConnection();


switch ($_GET['con']) {
    case 1:
        $product = new Product($db);
        $data = json_decode(file_get_contents("php://input"));
        $item->id = $data->id;
        if($item->deleteProduct()){
            echo json_encode("Product deleted.");
        } else{
            echo json_encode("Product could not be deleted");
        }
    case 2:
    default:
        $basket = new Basket();
        $items = $basket->deleteItem();
        return;
}

?>