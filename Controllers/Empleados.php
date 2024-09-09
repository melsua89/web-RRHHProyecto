<?php

class Empleados extends Controller{

    public function __construct(){
        session_start();
        if(empty($_SESSION['activo'])){
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function mostrar(){
        $data = $this->model->getEmpleadosByEstado(1);
        for($i = 0; $i < count($data); $i++){
            $data[$i]['incrementos'] = $this->buscarIncrementos($data[$i]['id']);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscarIncrementos($id){
        $incremento = $this->model->getIncrementoByEmpleado($id);
        if (!empty($incremento)) {
            $lista = '<ul class="list-group">';
        
            foreach ($incremento as $dato) {
                $i = 1;
                $lista .= '<li class="list-group-item list-group-item-dark">
                    <span class="fw-bold me-2">N°: </span>' . $i . '
                    <span class="fw-bold ms-4 me-2">Salario Antes: </span>' . $dato['sueldo_antes'] . '
                    <span class="fw-bold ms-4 me-2">Incremento a: </span>' . $dato['sueldo_incremento'] . '
                    <span class="fw-bold ms-4 me-2">Fecha del incremento: </span>' . $dato['a_partir_de'] . '
                </li>';
                $i++;
            }
        
            $lista .= '</ul>';
            return $lista;
        } else {
            return '<span class="badge text-bg-success">No realizados</span>';
        }
    }
    
    public function agregar(){
        $result = "";
        $dui = $this->validarNumeros($_POST['txtDUI'] ?? null);
        $datos = $this->validarCampos();

        if ($datos != false) {
            if(empty($datos['key'])){
                $this->verificar_dui($dui);
                $result = $this->model->insertEmpleado($datos['value']);
                $result = $result == "ok" ?  $this->anexar_a_aguinaldo($dui): "error";
            } else {
                $result = $this->model->updateEmpleado($datos['value'], $datos['key']);
            }
        } else {
            $msg = $this->crearMensaje('Error en los datos', 'warning');
        }

        $msg = $result == "ok" 
        ? $this->crearMensaje('Empleado guardado', 'success')
        : $this->crearMensaje('Parece que ha ocurrido un problema', 'warning');

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    private function verificar_dui($dui){
        $empleado = $this->model->getEmpleadoByDui($dui);
        if(!empty($empleado)){
            $msg = $this->crearMensaje("Ya existe un empleado asociado al Documento Unico de Identidad: " . $dui , "warning");
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    private function anexar_a_aguinaldo($dui){
        $empleado = $this->model->getEmpleadoByDui($dui);
        $result = "";
        if(!empty($empleado)){
            $datos = array($empleado['id']);
            $result = $this->model->insertAguinaldo($datos);
        }else{
            $result = "error";
        }
        return $result;
    }

    public function editar($id){
        $data = $this->model->getEmpleadobyId($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->deleteEmpleados($id, 0);
        $msg = $data == "ok" 
            ? $msg = $this->crearMensaje('Empleado dado de baja','success')
            : $msg = $this->crearMensaje('Parece que ha ocurrido un problema','warning');

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function incremento($id){
        $data = $this->model->getEmpleadobyId($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar_incremento(){

        $datos = $this->validarCamposIncremento();

        if ($datos != false) {
            $result = !empty($datos['key']) 
                ? $this->model->createIncremento($datos['value'])
                : "error";
        } else {
            $msg = $this->crearMensaje('Error en los datos', 'warning');
        }
        
        if($result == "ok" ){
            $result = $this->actualizar_salario($datos['key'], $datos['value'][2]);

            $msg = $result == "ok" 
            ? $this->crearMensaje('Incremento registrado', 'success')
            : $this->crearMensaje('Parece que ha ocurrido un problema', 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    private function actualizar_salario($id, $sueldo_incremento){
        $datos = $this->model->updateEmpleadoSueldo($sueldo_incremento, $id);
        return $datos;        
    }

    public function validarCampos() {
        $id = $this->validarNumeros($_POST['txtid']);
        $pnombre = $this->validarCadenas($_POST['txtprimerNombre']);
        $snombre = $this->validarCadenas($_POST['txtsegundoNombre']);
        $papellido = $this->validarCadenas($_POST['txtprimerApellido']);
        $sapellido = $this->validarCadenas($_POST['txtsegundoApellido']);
        $dui = $this->validarNumeros($_POST['txtDUI'] ?? null);
        $sexo = $this->validarCadenas($_POST['sexo']);
        $fecha_nacimiento = $this->validarCadenas($_POST['txtFechaNacimiento']);
        $fecha_ingreso = $this->validarCadenas($_POST['txtFechaIngreso']);
        $cargo = $this->validarCadenas($_POST['txtCargo']);
        $sueldo = $this->validarNumeros($_POST['txtSueldo'] ?? null);
        $seguro = $this->validarCadenas($_POST['seguro']);
        $pension = $this->validarCadenas($_POST['pension']);
        $afiliado = $this->validarNumeros($_POST['txtNumeroAfiliado']);

        if($sueldo == null && $dui == null){
            return ["key" => $id, "value" => [$pnombre, $snombre, $papellido, $sapellido, $sexo, $fecha_nacimiento, $fecha_ingreso, $cargo, $seguro, $pension,  $afiliado, ]];   
        }else{
            return ["key" => $id, "value" => [$pnombre, $snombre, $papellido, $sapellido, $dui, $sexo, $fecha_nacimiento, $fecha_ingreso, $cargo, $sueldo, $seguro, $pension,  $afiliado, ]];
        }
    }

    public function validarCamposIncremento() {
        $id_empleado = $this->validarNumeros($_POST['id_empleado_incremento']);
        $empleado = $this->model->getEmpleadobyId($id_empleado);
        $sueldo_actual = $empleado['sueldo'];
        $suedo_incremento = $this->validarNumeros($_POST['sueldo_incremento']);
        $a_partir_de = $this->validarCadenas($_POST['a_partir_de']);
        $comentarios =$this->validarCadenas($_POST['comentarios_incremento']);
        
        $validarRango = $this->validarRango($sueldo_actual, $suedo_incremento);
        if (!empty($validarRango)) {
            echo json_encode($validarRango, JSON_UNESCAPED_UNICODE);
            die();
        }
        return ["key" => $id_empleado, "value" => [$id_empleado, $sueldo_actual, $suedo_incremento, $a_partir_de, $comentarios]];
    }

    private function validarRango($inicio, $fin) {
        if ($fin !== null && ((double)$inicio == (double)$fin || (double)$inicio >= (double)$fin)) {
            if ((double)$inicio == (double)$fin) {
                return $this->crearMensaje('El rango monetario no puede ser igual','warning');
            } else {
                return $this->crearMensaje('El final del rango monetario debe ser mayor','warning');
            }
        }
        return null; // La validación del rango pasó sin problemas
    }

    private function validarCadenas($valor){
        $valor = isset($valor) ? trim($valor) : null;
        $valor = $valor != null ? preg_replace('/[^a-zA-Z0-9\s.]/', '', $valor) : null;
        return $valor;
    }

    private function validarNumeros($valor){
        $valor = isset($valor) ? trim($valor) : null;
        return is_numeric($valor) ? floatval($valor) : null;
    }

    private function crearMensaje($mensaje, $icono) {
        return ['msg' => $mensaje, 'icono' => $icono];
    }

}