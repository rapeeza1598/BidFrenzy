<?php
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../model/class.BidItem.php');
$serverReq = $_SERVER['REQUEST_METHOD'];
$bidItem = new BidItem();
switch($serverReq){
    case 'GET':
        if (isset($_GET["id"])) {
            $bidItemData = $bidItem->getBidItem($_GET["id"]);
            echo json_encode($bidItemData);
        }else {
            $bidItemData = $bidItem->getAllItem();
            echo json_encode($bidItemData);
        }
        break;
    case 'POST':
        $input = file_get_contents('php://input');
        $data = json_decode($input);
        $bidItemData = $bidItem->addProduct($data);
        // echo json_encode($bidItemData);
        if($bidItemData){
            echo json_encode(['success' => true]);
        }
        else {
            echo json_encode(['success' => false]);
        }
        break;
    case 'PUT':
        $input = file_get_contents('php://input');
        $data = json_decode($input,true);
        $bidItemData = $bidItem->addBid($data);
        if($bidItemData){
            echo json_encode(['success' => true]);
        }
        else {
            echo json_encode(['success' => false]);
        }
        // echo json_encode($bidItemData);
        break;
    case 'DELETE':
        $input = file_get_contents('php://input');
        $data = json_decode($input);
        $bidItemData = $bidItem->deleteProduct($data);
        echo json_encode($bidItemData);
        break;
    default:
        echo json_encode(['success' => false]);
        break;
}