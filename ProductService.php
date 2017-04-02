<?php
header('Content-Type: text/plain; charset=utf-8');
    require_once 'app/ProductController.php';
    $access_key = 12345;
    if(!isset($_GET['accesskey']) || $_GET['accesskey'] != $access_key) 
        die('accesskey required.');
    if(!isset($_GET["state"]))
        die('request state required.');
    $state = $_GET["state"];
    $model = "";
    $name = "";
    $description = "";
    $price = "";
    $currency = "";
    $user_id = 1;
    if(isset($_GET['model']) && isset($_GET['name']) && isset($_GET['description']) && isset($_GET['price']) && isset($_GET['currency']) && isset($_GET["ui"])){
        $model = $_GET['model'];
        $name = $_GET['name'];
        $description = $_GET['description'];
        $doublePrice = (double)$_GET['price'];
        $currency = $_GET['currency'];
        $user_id = $_GET["ui"];
    }
    $productObject = new ProductController();
    echo json_encode($productObject->getAll());
    //state == c -> Бараа нэмэх 
    if($state == "c" && !empty($model) && !empty($name) && !empty($description) && !empty($price) && !empty($currency))
        echo json_encode($productObject->create($name, $model, $description, $doublePrice, $currency, $user_id));
    if($state == "u" && !empty($model) && !empty($name) && !empty($description) && !empty($price) && !empty($currency)) //state == u -> update
        //TODO энд upate хийх үйлдэлүүд бичнэ
        echo json_encode(["result"=>"invalid request!!!"]);
    if($state == "r"){//state == r -> read
        if(isset($_GET['brand_id']))
            echo json_encode($productObject->getByBrandId($_GET['brand_id']));
        
        if(isset($_GET['product_id'])) 
            echo json_encode($productObject->getByProductId($_GET['product_id']));
        else
            echo json_encode($productObject->getAll());
    }else {
        echo json_encode(["result" => "invalid request!!!"]);
    }
?>