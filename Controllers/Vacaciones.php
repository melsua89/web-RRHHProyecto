<?php

class Vacaciones extends Controller {

    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index() {
        $data['anio'] = date('Y M d');
        $this->views->getView($this, 'index', $data);
    }

    public function mostrar() {
        $data = $this->model->getEmpleadosByEstado(1);
        $data = $this->calcularVacaciones($data);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['nombrecompleto'] = $data[$i]['primernombre'] . ' ' . $data[$i]['segundonombre'] . ' ' . $data[$i]['primerapellido'] . ' ' . $data[$i]['segundoapellido'];
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function calcularVacaciones($empleados) {
        $empleadosCalculados = []; 

        foreach ($empleados as $empleado) {
            $empleadoCalculado = $empleado; 

            if (isset($empleado['sueldo'])) {
                $empleadoCalculado['sueldo_base'] = $empleado['sueldo'];
                $empleadoCalculado['dias_vacaciones'] = $this->calculoDiasVacaciones($empleado['fechaingreso']);
                $empleadoCalculado['total_pagar'] = $this->calculoTotalVacaciones($empleadoCalculado['sueldo_base'], $empleadoCalculado['dias_vacaciones']);
                $empleadoCalculado['fecha_inicio'] = $this->calculoFechaInicio();
                $empleadoCalculado['fecha_fin'] = $this->calculoFechaFin($empleadoCalculado['dias_vacaciones']);
            }
            $empleadosCalculados[] = $empleadoCalculado;
        }

        return $empleadosCalculados;
    }

    private function calculoDiasVacaciones($fecha_ingreso) {
        $aniosLaborales = $this->aniosLaborales($fecha_ingreso);

        if ($aniosLaborales < 1) {
            return 0; 
        } else if ($aniosLaborales >= 1 && $aniosLaborales < 10) {
            return 15;
        } else {
            return 20;
        }
    }

    private function calculoTotalVacaciones($sueldo, $dias) {
        return round(($sueldo / 30) * $dias, 2);
    }

    private function calculoFechaInicio() {
        return date('Y-m-d'); 
    }

    private function calculoFechaFin($dias) {
        $fechaInicio = new DateTime();
        $fechaFin = $fechaInicio->modify("+{$dias} days");
        return $fechaFin->format('Y-m-d');
    }

    private function aniosLaborales($fecha_ingreso) {
        $fecha1 = new DateTime($fecha_ingreso);
        $fecha2 = new DateTime();
        return $fecha1->diff($fecha2)->y;
    }

    private function crearMensaje($mensaje, $icono) {
        return ['msg' => $mensaje, 'icono' => $icono];
    }
}
