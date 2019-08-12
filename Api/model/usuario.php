<?php
class Usuario{

    private $conn;
    private $table_name = "usuario";



    private $id;
    private $tipo_documento;
    private $documento;
    private $nombre;
    private $apellido;
    private $email;
    private $password;


    public function __construct($db){
        $this->conn = $db;
    }



    




}


function read(){
 
    // select all query
    $query = "SELECT
                p.id, p.tipo_documento, p.documento, p.nombre, p.apellido, p.email,p.password
            FROM
                " . $this->table_name . "p";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO" . 
                $this->table_name . "
            SET
                tipo_documento=:tipo_documento,
                documento=:documento, nombre=:nombre,
                apellido=:apellido,
                email=:email,
                password=:password";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->tipo_documento=htmlspecialchars(strip_tags($this->tipo_documento));
    $this->documento=htmlspecialchars(strip_tags($this->documento));
    $this->nombre=htmlspecialchars(strip_tags($this->nombre));
    $this->apellido=htmlspecialchars(strip_tags($this->apellido));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));

 
    // bind values
    $stmt->bindParam(":tipo_documento", $this->tipo_documento);
    $stmt->bindParam(":documento", $this->documento);
    $stmt->bindParam(":nombre", $this->nombre);
    $stmt->bindParam(":apellido", $this->apellido);
    $stmt->bindParam(":email", $this->email);
    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}



function readOne(){
 
    // query to read single record
    $query = "SELECT
                p.id, p.tipo_documento, p.documento, p.nombre, p.apellido, p.email,p.password
               FROM
                " . $this->table_name . " p
            WHERE
                p.id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->tipo_documento = $row['tipo_documento'];
    $this->documento = $row['documento'];
    $this->nombre = $row['nombre'];
    $this->apellido = $row['apellido'];
    $this->email = $row['email'];
    $this->password = $row['password'];
}


function emailExists(){
 
    // query to check if email exists
    $query = "SELECT
                p.id, p.tipo_documento, p.documento, p.nombre, p.apellido, p.email,p.password
            FROM " . $this->table_name . "p
            WHERE p.email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->id = $row['id'];
        $this->tipo_documento = $row['tipo_documento'];
        $this->docuemnto = $row['docuemnto'];
        $this->nombre = $row['nombre'];
        $this->apellido = $row['apellido'];
        $this->email = $row['email'];
        $this->password = $row['password'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}


?>