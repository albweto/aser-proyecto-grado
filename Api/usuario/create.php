<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
 

include_once '../model/usuario.php';


$database = new Database();
$db = $database->getConnection();

$usuario = new usuario($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->tipo_documento) &&
    !empty($data->docuemnto) &&
    !empty($data->nombre) &&
    !empty($data->apellido) &&
    !empty($data->email) &&
    !empty($data->password)
){
 
    // set product property values
    $usuario->tipo_documento = $data->tipo_documento;
    $usuario->docuemnto = $data->docuemnto;
    $usuario->nombre = $data->nombre;
    $usuario->apellido = $data->apellido;
    $usuario->email = $data->email;
    $usuario->password = $data->password;
 
    // create the product
    if($usuario->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "usuario was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create usuario."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create usuuario. Data is incomplete."));
}
?>