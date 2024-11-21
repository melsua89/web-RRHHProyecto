<?php

class VacacionesModel extends Query {

    public function __construct() {
        parent::__construct();
    }

    public function getEmpleadosByEstado($estado) {
        $query = "SELECT v.*, e.primernombre, e.segundonombre, e.primerapellido, e.segundoapellido, e.dui, e.sueldo, e.fechaingreso 
                  FROM vacaciones v 
                  INNER JOIN empleados e ON e.id = v.id_empleado 
                  WHERE v.estado = $estado";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getVacacionesByEstado($estado) {
        $query = "SELECT sueldo_base, dias_vacaciones, total_pagar, fecha_inicio, fecha_fin 
                  FROM vacaciones 
                  WHERE estado = $estado";
        $data = $this->selectAll($query);
        return $data;
    }

    public function updateVacaciones($datos, $id) {
        $query = "UPDATE vacaciones 
                  SET sueldo_base = ?, dias_vacaciones = ?, total_pagar = ?, fecha_inicio = ?, fecha_fin = ? 
                  WHERE id_empleado = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getVacacionesFecha($valor) {
        $query = "SELECT YEAR(fecha_inicio) AS id, YEAR(fecha_inicio) AS text 
                  FROM vacaciones 
                  WHERE YEAR(fecha_inicio) LIKE '%" . $valor . "%' 
                  GROUP BY YEAR(fecha_inicio)";
        $data = $this->selectAll($query);
        return $data;
    }
}

?>
