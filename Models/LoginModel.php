<?php

class LoginModel extends Query{

    public function __construct(){
        parent::__construct();
    }

    public function getUsuario($usuario, $password){
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$password'";
        $data = $this->select($sql);
        return $data;
    }

}

?>