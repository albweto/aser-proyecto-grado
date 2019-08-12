<?php

include_once "../config/database.php";
include_once '../model/usuario.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);


$stmt = $product->read();
$num = $stmt->rowCount();


if($num  > 0 ){

    $usuario_arr = array();
    $usuario_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $usuario_item=array(
            "id" => $id,
            "tipo_documento" => $tipo_documento,
            "documento" => $documento,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email,
            "password"=> $password
        );
 
        array_push($usuario_arr["records"], $usuario_item);
        
    }

    http_response_code(200);
 
    // show products data in json format
    echo json_encode($usuario_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
   
    echo json_encode(
        array("message" => "No usuarios found.")
    );
}