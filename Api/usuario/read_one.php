<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../model/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$usuario = new usuario($db);
 
// set ID property of record to read
$usuario->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$usuario->readOne();
 
if($usuario->nombre!=null){
    // create array
    $usuario_arr = array(
        "id" =>  $usuario->id,
        "tipo_documento" => $usuario->tipo_documento,
        "documento" => $usuario->documento,
        "nombre" => $usuario->nombre,
        "apellido" => $usuario->apellido,
        "email" => $usuario->email,
        "password" => $usuario->password
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($usuario_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "usuario does not exist."));
}
?>