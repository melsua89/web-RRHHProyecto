<?php

class EmpleadosModel extends Query{

    public function __construct(){
        parent::__construct();
    }

    public function getEmpleados(){
        $query = "SELECT * FROM empleados";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getEmpleadosByEstado($estado){
        $query = "SELECT * FROM empleados WHERE estado = '$estado'";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getEmpleadobyId($id){
        $query = "SELECT * FROM empleados WHERE id = '$id'";
        $data = $this->select($query);
        return $data;
    }

    public function deleteEmpleados($id, $estado){
        $query = "UPDATE empleados SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($query, $datos);
        if($data == 1){
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function insertEmpleado($datos){
        
        $query = "INSERT INTO empleados(primernombre, segundonombre, primerapellido, segundoapellido, dui, sexo, fechanacimiento, fechaingreso, cargo, sueldo, seguromedico, pension, numeroafiliado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $datos = $datos;
        $data = $this->insert($query, $datos);
        if ($data > 0) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function updateEmpleado($datos, $id){
        
        $query = "UPDATE empleados SET primernombre = ?, segundonombre = ?, primerapellido = ?, segundoapellido = ?, sexo = ?, fechanacimiento = ?, fechaingreso = ?, cargo = ?, seguromedico = ?, pension = ?, numeroafiliado = ? WHERE id = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getIncrementoByEmpleado($id){
        $query = "SELECT * FROM incremento_salarial WHERE id_empleado = $id";
        $data = $this->selectAll($query);
        return $data;
    }

    public function updateEmpleadoSueldo($sueldo, $id){
        $query = "UPDATE empleados SET sueldo = ? WHERE id = ?";
        $datos = array($sueldo, $id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function createIncremento($datos){

        $query = "INSERT INTO incremento_salarial(id_empleado, sueldo_antes, sueldo_incremento, a_partir_de, comentarios_incremento) VALUES (?,?,?,?,?)";
        $data = $this->insert($query, $datos);
        if ($data > 0) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getEmpleadoByDui($dui){
        $query = "SELECT * FROM empleados WHERE dui = $dui";
        $data = $this->select($query);
        return $data;
    }

    public function getAguinaldoByDui($dui){
        $query = "SELECT * FROM aguinaldo WHERE dui = $dui";
        $data = $this->select($query);
        return $data;
    }

    public function insertAguinaldo($datos){
        $query = "INSERT INTO aguinaldo(id_empleado) VALUES (?)";
        $data = $this->insert($query, $datos);
        if ($data > 0) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
}

?>