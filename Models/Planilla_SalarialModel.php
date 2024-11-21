<?php

class Planilla_SalarialModel extends Query{

    public function __construct(){
        parent::__construct();
    }

    public function getPlanillaSalarial(){
        $query = "SELECT  p.id AS id_planilla, p.anio, p.mes, p.salario AS salario_planilla,  e.* FROM planilla_salarial p INNER JOIN empleados e ON p.id_empleado = e.id";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getPlanillaSalarialByMesANDAnio($mes, $anio){
        $query = "SELECT  p.id AS id_planilla, p.anio, p.mes, p.salario AS salario_planilla, p.salario_bruto, p.salario_neto,  e.* FROM planilla_salarial p INNER JOIN empleados e ON p.id_empleado = e.id WHERE p.mes = $mes AND p.anio = $anio";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getPlanillaSalarialByMesANDAnio1($mes, $anio){
        $query = "SELECT * FROM planilla_salarial WHERE mes = $mes AND anio = $anio";
        $data = $this->select($query);
        return $data;
    }

    public function getPlanillaSalarialAnio($valor){
        $query = "SELECT anio AS id, anio AS text FROM planilla_salarial WHERE anio LIKE '%" . $valor . "%' GROUP BY anio LIMIT 10";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getPanillaSalarialMes($valor){
        $query = "SELECT mes AS id, mes AS text FROM planilla_salarial WHERE anio LIKE '%" . $valor . "%' GROUP BY mes LIMIT 10";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getEmpleadosByEstado($estado){
        $query = "SELECT * FROM empleados WHERE estado = $estado";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getEmpleadoById($id){
        $query = "SELECT * FROM empleados WHERE id = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getPlanillaSalarialById($id){
        $query = "SELECT * FROM planilla_salarial WHERE id = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getPlanillaEmpleadoById($id){
        $query = "SELECT p.id AS id_planilla, p.anio, p.mes, p.salario AS salario_planilla, p.salario_bruto, p.salario_neto, e.* FROM planilla_salarial p INNER JOIN empleados e ON p.id_empleado = e.id WHERE p.id = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getPlanillaSalarialHorasExtrasById($id){
        $query = "SELECT p.anio, p.mes, p.id_empleado, p.salario, h.* FROM planilla_salarial p INNER JOIN horas_extras h ON p.id = h.id_planilla WHERE p.id = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getHorasExtrasByIdPlanilla($id){
        $query = "SELECT * FROM horas_extras WHERE id_planilla = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getAllHorasExtrasByPlanilla($id){
        $query = "SELECT * FROM horas_extras WHERE id_planilla = $id";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getAllRemuneracionesPlanilla($id){
        $query = "SELECT * FROM remuneraciones WHERE id_planilla = $id";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getRemuneracionesById($id){
        $query = "SELECT p.anio, p.mes, p.id_empleado, p.salario, r.* FROM planilla_salarial p INNER JOIN remuneraciones r ON p.id = r.id_planilla WHERE p.id = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getRemuneracionesByIdPlanilla($id){
        $query = "SELECT * FROM remuneraciones WHERE id_planilla = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getAllDescuentosPlanilla($id){
        $query = "SELECT * FROM descuentos WHERE id_planilla = $id";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getDescuentosById($id){
        $query = "SELECT p.anio, p.mes, p.id_empleado, p.salario, d.* FROM planilla_salarial p INNER JOIN descuentos d ON p.id = d.id_planilla WHERE p.id = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getDescuentosByIdPlanilla($id){
        $query = "SELECT * FROM descuentos WHERE id_planilla = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getAllPrestacionesPlanilla($id){
        $query = "SELECT * FROM planilla_prestaciones WHERE id_planilla = $id";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getPrestacionesPlanilla($id){
        $query = "SELECT * FROM planilla_prestaciones WHERE id_planilla = $id";
        $data = $this->select($query);
        return $data;
    }

    public function getPrestacionesActivas(){
        $query = "SELECT * FROM prestaciones WHERE estado = 1";
        $data = $this->selectAll($query);
        return $data;
    }

    public function getRentaActivas(){
        $query = "SELECT * FROM renta WHERE estado = 1";
        $data = $this->selectAll($query);
        return $data;
    }

    public function insertPlanilla($anio, $mes, $salario, $empleado){
        $query = "INSERT INTO planilla_salarial(anio, mes, salario, id_empleado) VALUES (?,?,?,?)";
        $datos = array($anio, $mes, $salario, $empleado);
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function insertHorasExtras($datos, $id){
        $query = "INSERT INTO horas_extras(num_horas_extras, pago_horas_extras, num_horas_nocturnas, pagos_horas_nocturnas, total, id_planilla) VALUES (?,?,?,?,?,?)";
        $datos[] = $id;
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function insertRemuneraciones($datos, $id){
        $query = "INSERT INTO remuneraciones(feriado , reintegro, domingo, vacaciones, total, id_planilla) VALUES (?,?,?,?,?,?)";
        $datos[] = $id;
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function insertDescuentos($datos, $id){
        $query = "INSERT INTO descuentos(incapacidades , permisos, llegadas_tardias, dias_descontados, total, id_planilla) VALUES (?,?,?,?,?,?)";
        $datos[] = $id;
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function insertPrestaciones($datos, $id){
        $query = "INSERT INTO planilla_prestaciones(afps , isss, renta, salario_bruto, salario_neto, id_planilla) VALUES (?,?,?,?,?,?)";
        $datos[] = $id;
        $data = $this->insert($query, $datos);
        $res = $data > 0 ? "ok" : "error";
        return $res;
    }

    public function updatePlanillaSalarial($datos, $id){
        $query = "UPDATE planilla_salarial SET salario_bruto = ?, salario_neto = ? WHERE id = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function updateHorasExtras($datos, $id){
        $query = "UPDATE horas_extras SET num_horas_extras = ?, pago_horas_extras = ?, num_horas_nocturnas = ?, pagos_horas_nocturnas = ?, total = ? WHERE id_planilla = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function updateRemuneraciones($datos, $id){
        $query = "UPDATE remuneraciones SET feriado = ?, reintegro = ?, domingo = ?, vacaciones = ?, total = ? WHERE id_planilla = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function updateDescuentos($datos, $id){
        $query = "UPDATE descuentos SET incapacidades = ?, permisos = ?, llegadas_tardias = ?, dias_descontados = ?, total = ? WHERE id_planilla = ?";
        $datos[] = $id;
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function updatePrestaciones($datos, $id){
        $query = "UPDATE planilla_prestaciones SET afps = ?, isss = ?, renta = ?, salario_bruto = ?, salario_neto = ? WHERE id_planilla = ?";
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