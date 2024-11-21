<?php

class Aguinaldo extends Controller{

    public function __construct() {
        session_start();
        if(empty($_SESSION['activo'])){
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index(){
        $data['anio'] = date('Y M d');
        $this->views->getView($this, 'index', $data);
    }

    public function mostrar(){
        $data = $this->model->getEmpleadosByEstado(1);
        $data = $this->calcularDeducciones($data);
        for($i = 0; $i < count($data); $i++){
            $data[$i]['nombrecompleto'] = $data[$i]['primernombre'] . ' ' . $data[$i]['segundonombre'] . ' ' . $data[$i]['primerapellido'] . ' ' . $data[$i]['segundoapellido'];
            $data[$i]['fecha_actual'] = date('Y-m-d');
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // public function generarPlanilla(){
    //     $empleados = $this->model->getEmpleadosByEstado(1);
    //     $planilla = $this->model->getAguinaldosByEstado(1);
    //     $empleados = $this->calcularDeducciones($empleados);

    //     for($i = 0; $i < count($empleados); $i++){

    //         $planilla[$i]['sueldo_base'] = $planilla[$i]['sueldo_base'];
    //         $planilla[$i]['sueldo_calculo'] = $planilla[$i]['sueldo_calculo'];
    //         $planilla[$i]['anios_laborales'] = $planilla[$i]['anios_laborales'];
    //         $planilla[$i]['dias_base'] = $planilla[$i]['dias_base'];
    //         $planilla[$i]['aguinaldo'] = $planilla[$i]['aguinaldo'];
    //         $planilla[$i]['renta_aguinaldo'] = $planilla[$i]['renta_aguinaldo'];
    //         $planilla[$i]['liquido_pagar'] = $planilla[$i]['liquido_pagar'];
    //         $planilla[$i]['anio_planilla'] = $anio;
    //     }

    //     $msg = $this->crearMensaje('generada', 'success');
    //     echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    //     die();
    // }

    // public function guardarLista($data){
    //     for($i = 0; $i < count($data); $i++){
    //         $this->model->updateAguinaldo($data[$i], );
    //     }
    // }

    // public function buscar($fecha = null){
    //     $empleados = $this->model->getIncrementoByAnio($fecha);
    //     $empleados = $this->calcularDeducciones($empleados);
    //     for($i = 0; $i < count($empleados); $i++){
    //         $empleados[$i]['nombrecompleto'] = $empleados[$i]['primernombre'] . ' ' . $empleados[$i]['segundonombre'] . ' ' . $empleados[$i]['primerapellido'] . ' ' . $empleados[$i]['segundoapellido'];
    //         $empleados[$i]['fecha_actual'] = date('Y-m-d');
    //         $empleados[$i]['sueldo_base'] = $empleados[$i]['sueldo_antes'];
    //     }
    //     $data['empleados'] = $empleados;
    //     $data['anio'] = date('Y M d');
    //     $this->views->getView($this, 'index', $data);
    // }

    public function buscarCambios(){
        if (isset($_GET['date'])) {
            $valor = $_GET['date'];
            $data = $this->model->getAguinaldoFecha($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function calcularDeducciones($empleados){
        $empleadosCalculados = []; // Creamos un nuevo array para almacenar los resultados
    
        foreach ($empleados as $empleado) {
            $empleadoCalculado = $empleado; // Copiamos el empleado actual a un nuevo array
    
            if (isset($empleado['sueldo'])) {
                $empleadoCalculado['sueldo_base'] = $empleado['sueldo'];
                $empleadoCalculado['anios_laborales'] = $this->aniosLaborales($empleado['fechaingreso']);
                $empleadoCalculado['dias_base'] = $this->calculoDiasBase($empleadoCalculado['anios_laborales']);
                $empleadoCalculado['aguinaldo'] = $this->calculoAguinaldo($empleadoCalculado['sueldo_base'], $empleadoCalculado['anios_laborales'], $empleado['fechaingreso']);
                $empleadoCalculado['renta_aguinaldo'] = $this->calculoRentaAguinaldo($empleadoCalculado['aguinaldo']);
                $empleadoCalculado['liquido_pagar'] = $this->liquidoPagar($empleadoCalculado['aguinaldo'], $empleadoCalculado['renta_aguinaldo']);
            }
            $empleadosCalculados[] = $empleadoCalculado; // Agregamos el empleado calculado al nuevo array
        }
    
        return $empleadosCalculados;
    }
    

    private function aniosLaborales($fecha_ingreso){
        $fecha1 = new DateTime($fecha_ingreso);
        $fecha2 = new Datetime();
        return $fecha1->diff($fecha2)->y;
    }

    private function calculoDiasBase($anios){
        if ($anios < 1){
            return 15;
        }else if($anios >= 1 && $anios < 3){
            return 15;
        }else if($anios >= 3 && $anios < 10){
            return 19;
        }else{
            return 21;
        }
    }

    private function calculoAguinaldo($sueldo, $anios, $fecha_ingreso = null){
        if ($anios < 1){
            $fecha_ingreso = new DateTime($fecha_ingreso);
            $dias_trabajados = $fecha_ingreso->diff(new DateTime())->format('%a');
            $resultado = ((( $sueldo / 30 ) * 15) / 365 ) * $dias_trabajados;
            return round($resultado, 2);
        }else if($anios >= 1 && $anios < 3){
            return round(( $sueldo / 30 ) * 15, 2);
        }else if($anios >= 3 && $anios < 10){
            return round(( $sueldo / 30 ) * 19, 2);
        }else{
            return round(( $sueldo / 30 ) * 21, 2);
        }
    }

    private function calculoRentaAguinaldo($aguinaldo){
        if($aguinaldo > 1500){
            $renta = $this->model->getRentaByEstado(1);
            foreach ($renta as $regla) {
                if($aguinaldo >= $regla['desde'] && $aguinaldo <= $regla['hasta']){
                    $resultado = (($aguinaldo - $regla['sobre_exceso']) * ( $regla['aplicar'] / 100 ) ) + $regla['cuota_fija'];
                    return round($resultado, 2);
                }
            }
        }else{
            return 0;
        }
    }

    private function liquidoPagar($aguinaldo, $renta_apagar = 0){
        return round($aguinaldo - $renta_apagar, 2);
    }

    private function crearMensaje($mensaje, $icono) {
        return ['msg' => $mensaje, 'icono' => $icono];
    }
}

?>