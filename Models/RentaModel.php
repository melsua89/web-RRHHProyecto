<?php

class RentaModel extends Query{

    public function __construct(){
        parent::__construct();
    }

    public function getAllRenta(){
        $query = "SELECT * FROM renta";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getAllRentaByEstado($estado){
        $query = "SELECT * FROM renta WHERE estado = '$estado'";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getRentaById($id){
        $query = "SELECT * FROM renta WHERE id = '$id'";
        $data = $this->select($query);
        return $data;
    }

    public function insertRenta($datos){
        
        $query = "INSERT INTO renta(nombre, desde, hasta, aplicar, sobre_exceso, cuota_fija) VALUES (?,?,?,?,?,?)";
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function updateRenta($datos, $id){
        
        $query = "UPDATE renta SET nombre = ?, desde = ?, hasta = ?, aplicar = ?, sobre_exceso = ?, cuota_fija = ? WHERE id = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function deleteRenta($id, $estado){
        $query = "UPDATE renta SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }
}

?>