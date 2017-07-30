<?php
    header('Content-Type: application/json; charset=utf-8');
 
	require_once 'app/CategoryController.php';
    require_once 'config/security.php';
    if(!isset($_GET['accesskey']) && (new DGLSecure())->generateAccessKey($_GET["accesskey"])) 
        die('accesskey required.');
   
   $categoryObject = new CategoryController();

   echo json_encode($categoryObject->getAll());
?>
