<?php

class PrestacionesModel extends Query{

    public function __construct(){
        parent::__construct();
    }

    public function getAllPrestaciones(){
        $query = "SELECT * FROM prestaciones";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getPrestacionesByEstado($estado){
        $query = "SELECT * FROM prestaciones WHERE estado = '$estado'";
        $data = $this->selectAll($query);
        return $data;
    }
    
    public function getPrestacionById($id){
        $query = "SELECT * FROM prestaciones WHERE id = '$id'";
        $data = $this->select($query);
        return $data;
    }

    public function insertPrestacion($datos){
        
        $query = "INSERT INTO prestaciones(tipo, nombre, desde, hasta, patronal, laboral, techo) VALUES (?,?,?,?,?,?,?)";
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function updatePrestacion($datos, $id){
        
        $query = "UPDATE prestaciones SET tipo = ?, nombre = ?, desde = ?, hasta = ?, patronal = ?, laboral = ?, techo = ? WHERE id = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function deletePrestacion($id, $estado){
        $query = "UPDATE prestaciones SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }
}

?>