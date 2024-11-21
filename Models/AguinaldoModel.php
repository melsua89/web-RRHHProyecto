<?php

class AguinaldoModel extends Query{

    public function __construct(){
        parent::__construct();
    }

    public function getEmpleadosByEstado($estado){
        $query = "SELECT a.*, e.primernombre, e.segundonombre, e.primerapellido, e.segundoapellido, e.dui, e.sueldo, e.fechaingreso FROM aguinaldo a INNER JOIN empleados e ON e.id = a.id_empleado WHERE a.estado = $estado";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getAguinaldosByEstado($estado){
        $query = "SELECT sueldo_base, sueldo_calculo, anios_laborales, dias_base, aguinaldo, renta_aguinaldo, liquido_pagar, anio_planilla FROM aguinaldo WHERE a.estado = $estado";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getRentaByEstado($estado){
        $query = "SELECT * FROM renta WHERE estado = $estado";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getAguinaldoFecha($valor){
        $query = "SELECT YEAR(a_partir_de) AS id, YEAR(a_partir_de) AS text FROM incremento_salarial WHERE YEAR(a_partir_de) LIKE '%" . $valor . "%' GROUP BY YEAR(a_partir_de)";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getIncrementoByAnio($anio){
        $query = "SELECT e.primernombre, e.segundonombre, e.primerapellido, e.segundoapellido, e.dui, e.sueldo, e.fechaingreso, i.* FROM incremento_salarial i INNER JOIN empleados e ON i.id_empleado = e.id WHERE YEAR(i.a_partir_de) = $anio";
        $data = $this->selectAll($query);
        return $data;
    }

    public function updateAguinaldo($datos, $id){
        $query = "UPDATE aguinaldo SET sueldo_base = ?, sueldo_calculo = ?, anios_laborales = ?, dias_base = ?, aguinaldo = ?, renta_aguinaldo = ?, liquido_pagar = ?, anio_planilla = ?, WHERE id_empleado = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

}

?>