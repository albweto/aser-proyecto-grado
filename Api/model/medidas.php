<?php
class Usuario{

    private $conn;
    private $table_name = "medidas";



    private $id;
    private $pc_pierna;
    private $pc_axilar;
    private $pc_pecho;
    private $pc_abdonimal;
    private $pc_muslo;
    private $pc_supralico;
    private $pc_subescapal;
    private $pc_tricipital;
    private $pc_bicital;


    public function __construct($db){
        $this->conn = $db;
    }




}



?>