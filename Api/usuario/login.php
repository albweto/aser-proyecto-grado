<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once '../config/database.php';
include_once '../model/usuario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$usuario = new Usuario($db);
 
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$usuario->email = $data->email;
$email_exists = $usuario->emailExists();


if($email_exists && password_verify($data->password, $usuario->password)){
    http_response_code(200);
    echo json_encode(array("message" => "usuario logueado."));
}else{
 
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>