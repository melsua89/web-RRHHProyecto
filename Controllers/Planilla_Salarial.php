<?php

class Planilla_Salarial extends Controller
{

    public function __construct()
    {
        if (isset($_SESSION['usuario'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index()
    {
        $planilla = $this->model->getPlanillaSalarialByMesANDAnio(date('m'), date('Y'));
        if (!empty($planilla)) {
            for ($i = 0; $i < count($planilla); $i++) {
                $planilla[$i]['n'] = $i + 1;
                $planilla[$i]['mes'] = $this->validarMes($planilla[$i]['mes']);
                $planilla[$i]['nombrecompleto'] = $planilla[$i]['primernombre'] . ' ' . $planilla[$i]['segundonombre'] . ' ' . $planilla[$i]['primerapellido'] . ' ' . $planilla[$i]['segundoapellido'];
                $planilla[$i]['horas_extras'] = '<button type="button" onclick="btnHorasExtras(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-success"><i class="fa-solid fa-clock-rotate-left fa-lg"></i></button>';
                $planilla[$i]['remuneraciones'] = '<button type="button" onclick="btnRemuneraciones(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-success"><i class="fa-solid fa-coins"></i></button>';
                $planilla[$i]['descuentos'] = '<button type="button" onclick="btnDescuentosSalarios(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-warning"><i class="fa-solid fa-hand-holding-dollar fa-lg"></i></button>';
                $planilla[$i]['p_de_ley'] = '<button type="button" onclick="btnPresLeySalarios(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-info"><i class="fa-solid fa-landmark fa-lg"></i></button>';
                $planilla[$i]['reporte'] = '<a class="btn btn-danger" target="_blank" href="' . base_url . 'Planilla_Salarial/boletaPago/' . $planilla[$i]['id_planilla'] . '"><i class="fa-solid fa-file-pdf"></i></a>';
            }
        }
        $data['planilla'] = $planilla;
        $this->views->getView($this, 'index', $data);
    }

    public function generarPlanilla()
    {
        $result = "";
        $mes = $this->validarNumeros($_POST['mes_planilla_salarios']);
        $anio = $this->validarNumeros($_POST['anio_planilla_salarios']);

        $buscar = $this->model->getPlanillaSalarialByMesANDAnio1($mes, $anio);
        if (!empty($buscar)) {
            $msg = $this->crearMensaje("Ya existe una planilla correspondiente al: " . $this->validarMes($mes) . " de " . $anio, "warnig");
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        if ($mes > 12 && $mes < 1) {
            $msg = $this->crearMensaje("El mes no corresponde al seleccionado", "warnig");
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        } else {
            $empleados = $this->model->getEmpleadosByEstado(1);
            foreach ($empleados as $empleado) {
                $result = $this->model->insertPlanilla($anio, $mes, $empleado['sueldo'], $empleado['id']);
            }
        }

        $msg = $result == "ok"
            ? $this->crearMensaje("Planilla generada: " . $mes . " de " . $anio, "success")
            : $this->crearMensaje("Parece que ha habido un problema", "warnig");

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscar_anio()
    {
        if (isset($_GET['anio'])) {
            $valor = $_GET['anio'];
            $data = $this->model->getPlanillaSalarialAnio($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function buscar_mes($mes)
    {
        $data = $this->model->getPanillaSalarialMes($mes);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['text'] = $this->validarMes($data[$i]['text']);
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscar()
    {
        $mes = $this->validarNumeros($_GET['mes']);
        $anio = $this->validarNumeros($_GET['anio']);
        $planilla = $this->model->getPlanillaSalarialByMesANDAnio($mes, $anio);
        if (!empty($planilla)) {
            for ($i = 0; $i < count($planilla); $i++) {
                $planilla[$i]['n'] = $i + 1;
                $planilla[$i]['mes'] = $this->validarMes($planilla[$i]['mes']);
                $planilla[$i]['nombrecompleto'] = $planilla[$i]['primernombre'] . ' ' . $planilla[$i]['segundonombre'] . ' ' . $planilla[$i]['primerapellido'] . ' ' . $planilla[$i]['segundoapellido'];
                $planilla[$i]['horas_extras'] = '<button type="button" onclick="btnHorasExtras(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-success"><i class="fa-solid fa-clock-rotate-left fa-lg"></i></button>';
                $planilla[$i]['remuneraciones'] = '<button type="button" onclick="btnRemuneraciones(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-success"><i class="fa-solid fa-coins"></i></button>';
                $planilla[$i]['descuentos'] = '<button type="button" onclick="btnDescuentosSalarios(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-warning"><i class="fa-solid fa-hand-holding-dollar fa-lg"></i></button>';
                $planilla[$i]['p_de_ley'] = '<button type="button" onclick="btnPresLeySalarios(' . $planilla[$i]['id_planilla'] . ')" class="btn btn-info"><i class="fa-solid fa-landmark fa-lg"></i></button>';
                $planilla[$i]['reporte'] = '<a class="btn btn-danger" target="_blank" href="' . base_url . 'Planilla_Salarial/boletaPago/' . $planilla[$i]['id_planilla'] . '"><i class="fa-solid fa-file-pdf"></i></a>';
            }
        }
        $data['planilla'] = $planilla;
        $this->views->getView($this, 'index', $data);
    }
    // public function descuentos($id){
    //     $data = $this->model->getEmpleadoById($id);
    //     echo json_encode($data, JSON_UNESCAPED_UNICODE);
    //     die();
    // }

    public function horas_extras($id)
    {
        $result = $this->model->getAllHorasExtrasByPlanilla($id);
        $data = empty($result)
            ?   $this->model->getPlanillaSalarialById($id)
            :   $this->model->getPlanillaSalarialHorasExtrasById($id);
        $data['salario_bruto'] = $this->sumaTotales(array($data['salario'], $data['total'] ?? null));
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar_horas_extras()
    {
        $id = $this->validarNumeros($_POST['id_nomina_horas_extras']);
        $h_extras = $this->validarNumeros($_POST['num_horas_extras']);
        $h_extras_noc = $this->validarNumeros($_POST['num_horas_nocturnas']);
        $planilla = $this->model->getPlanillaSalarialById($id);
        $calculo = $this->calcularHorasExtras($h_extras, $h_extras_noc, $planilla['salario']);

        $result = $this->model->getAllHorasExtrasByPlanilla($planilla['id']);
        $result = empty($result)
            ?   $this->model->insertHorasExtras($calculo, $planilla['id'])
            :   $this->model->updateHorasExtras($calculo, $planilla['id']);

        $result = $result == 'ok'
            ?   $this->calculoSalarioBruto($planilla)
            : 'error';

        $msg = $result == 'ok'
            ? $this->crearMensaje('Datos guardados en la planilla', 'success')
            : $this->crearMensaje('Parece que hubo un problema', 'warning');

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    private function calcularHorasExtras($h_extras, $h_extras_noc, $salario)
    {
        $sueldo_base = $salario;

        $sueldo_hora = (($sueldo_base / 30) / 8) * 2;
        $sueldo_hora_noc = ($sueldo_hora * 0.25) + $sueldo_hora;

        $tota_h_diarias = $sueldo_hora * $h_extras;
        $tota_h__noc = $sueldo_hora_noc * $h_extras_noc;

        $total = $tota_h_diarias + $tota_h__noc;

        return array(round($h_extras, 2), round($tota_h_diarias, 2), round($h_extras_noc, 2), round($tota_h__noc, 2), round($total, 2));
    }

    public function remuneraciones($id)
    {
        $result = $this->model->getAllRemuneracionesPlanilla($id);
        $data = empty($result)
            ?   $this->model->getPlanillaSalarialById($id)
            :   $this->model->getRemuneracionesById($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar_remuneraciones()
    {
        $id = $this->validarNumeros($_POST['id_remuneraciones']);
        $feriado = $this->validarNumeros($_POST['feriado']);
        $reintegro = $this->validarNumeros($_POST['reintegro']);
        $domingo = $this->validarNumeros($_POST['domingo']);
        $vacaciones = $this->validarNumeros($_POST['vacaciones']);

        $total = $this->sumaTotales([$feriado, $reintegro, $domingo, $vacaciones]);

        $datos = array($feriado, $reintegro, $domingo, $vacaciones, $total);
        $result = $this->model->getAllRemuneracionesPlanilla($id);

        $result = empty($result)
            ?   $this->model->insertRemuneraciones($datos, $id)
            :   $this->model->updateRemuneraciones($datos, $id);

        $planilla = $this->model->getPlanillaSalarialById($id);
        $result = $result == 'ok'
            ?   $this->calculoSalarioBruto($planilla)
            : 'error';

        $msg = $result == 'ok'
            ? $this->crearMensaje('Datos guardados en la planilla', 'success')
            : $this->crearMensaje('Parece que hubo un problema', 'warning');

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function descuentos($id)
    {
        $result = $this->model->getAllDescuentosPlanilla($id);
        $data = empty($result)
            ?   $this->model->getPlanillaSalarialById($id)
            :   $this->model->getDescuentosById($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar_descuentos($id)
    {
        $id = $this->validarNumeros($_POST['id_descuentos']);
        $incapacidades = $this->validarNumeros($_POST['incapacidades']);
        $permisos = $this->validarNumeros($_POST['permisos']);
        $llegadas_taridas = $this->validarNumeros($_POST['llegadas_tardias']);
        $dias_descontados = $this->validarNumeros($_POST['dias_descontados']);

        $total = $this->sumaTotales([$incapacidades, $permisos, $llegadas_taridas, $dias_descontados]);

        $datos = array($incapacidades, $permisos, $llegadas_taridas, $dias_descontados, $total);
        $result = $this->model->getAllDescuentosPlanilla($id);

        $result = empty($result)
            ?   $this->model->insertDescuentos($datos, $id)
            :   $this->model->updateDescuentos($datos, $id);

        $planilla = $this->model->getPlanillaSalarialById($id);
        $result = $result == 'ok'
            ?   $this->calculoSalarioBruto($planilla)
            : 'error';

        $msg = $result == 'ok'
            ? $this->crearMensaje('Datos guardados en la planilla', 'success')
            : $this->crearMensaje('Parece que hubo un problema', 'warning');

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function calculoSalarioBruto($planilla)
    {

        $salario_bruto = $planilla['salario'];
        $horas_extras = $this->model->getHorasExtrasByIdPlanilla($planilla['id']);
        $remuneraciones = $this->model->getRemuneracionesByIdPlanilla($planilla['id']);
        //Estos son restas (-)
        $descuentos = $this->model->getDescuentosByIdPlanilla($planilla['id']);

        $salario_bruto = !empty($horas_extras)
            ? $salario_bruto + $horas_extras['total']
            : $salario_bruto;

        $salario_bruto = !empty($remuneraciones)
            ? $salario_bruto + $remuneraciones['total']
            : $salario_bruto;

        $salario_bruto = !empty($descuentos)
            ? $salario_bruto - $descuentos['total']
            : $salario_bruto;

        $datos = $this->calcularPrestaciones($salario_bruto);
        $result = $this->model->getAllPrestacionesPlanilla($planilla['id']);

        $result = empty($result)
            ? $this->model->insertPrestaciones($datos, $planilla['id'])
            : $this->model->updatePrestaciones($datos, $planilla['id']);

        $result = $result == 'ok'
            ? $this->model->updatePlanillaSalarial(array($salario_bruto,  $datos[4]), $planilla['id'])
            : 'error';

        return $result;
    }

    private function calcularPrestaciones($salario_bruto)
    {
        $afpsLaboral = '';
        $isssLaboral = '';
        $rentaCal = '';
        $prestaciones = $this->model->getPrestacionesActivas();
        $renta = $this->model->getRentaActivas();

        foreach ($prestaciones as $value => $dato) {
            if ($dato['tipo'] == 'pensiones') {
                $afpsLaboral = $this->calculoSeguroSocial($salario_bruto, $dato['laboral'], $afpsLaboral, $dato['desde'], $dato['hasta'], $dato['techo']);
            } else if ($dato['tipo'] == 'seguro medico') {
                $isssLaboral = $this->calculoSeguroSocial($salario_bruto, $dato['laboral'], $isssLaboral, $dato['desde'], $dato['hasta'], $dato['techo']);
            }
        }
        $salario_renta = $salario_bruto - $afpsLaboral - $isssLaboral;
        foreach ($renta as $value => $dato) {
            $rentaCal = $this->calculoRenta($salario_renta, $dato['desde'], $dato['hasta'], $dato['aplicar'], $dato['sobre_exceso'], $dato['cuota_fija'], $rentaCal);
        }

        $salario_neto = $salario_bruto - $afpsLaboral - $isssLaboral - $rentaCal;
        return [$afpsLaboral, $isssLaboral, $rentaCal, $salario_bruto, $salario_neto];
    }

    private function calculoRenta($salario, $desde, $hasta, $aplicar, $sobre_exceso, $cuota_fija, $resultado)
    {
        if ($salario >= $desde && $salario <= $hasta) {
            $resultado = (($salario - $sobre_exceso) * ($aplicar / 100)) + $cuota_fija;
            return round($resultado, 2);
        } else {
            return $resultado;
        }
    }

    private function calculoSeguroSocial($salario, $porcentaje, $resultado, $desde, $hasta, $techo)
    {
        if ($salario > $techo) {
            $resultado = $this->calculoPorcentaje($techo, $salario);
        } else if ($hasta != null && ((float)$salario >= (float)$desde && (float)$salario <= (float)$hasta)) {
            $resultado = $this->calculoPorcentaje($porcentaje, $salario);
        } else if ((float)$salario >= (float)$desde) {
            $resultado = $this->calculoPorcentaje($porcentaje, $salario);
        } else {
            $resultado = $resultado;
        }
        return round($resultado, 2);
    }

    private function calculoPorcentaje($porcentaje, $salario_bruto)
    {
        $result = $this->validarNumeros($porcentaje);
        $result = $result != null
            ? $salario_bruto * ($porcentaje / 100)
            : 0;
        return $result;
    }



    public function prestaciones($id)
    {
        $id = $this->validarNumeros($id);
        $data = $this->model->getPrestacionesPlanilla($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    private function sumaTotales($datos)
    {
        $total = 0;
        foreach ($datos as $value) {
            $total = $value != null
                ? $total + $value
                : $total;
        }
        return $total;
    }

    public function validarCampos()
    {
        $id = $this->validarNumeros($_POST['id']);
        $nombre = $this->validarCadenas($_POST['nombre']);
        $desde = $this->validarNumeros($_POST['desde']);
        $hasta = $this->validarNumeros($_POST['hasta']);
        $aplicar = $this->validarNumeros($_POST['aplicar']);
        $exceso = $this->validarNumeros($_POST['sobre_exceso']);
        $cuota = $this->validarNumeros($_POST['cuota_fija']);

        $validarRango = $this->validarRango($desde, $hasta);
        if (!empty($validarRango)) {
            echo json_encode($validarRango, JSON_UNESCAPED_UNICODE);
            die();
        }
        return ["key" => $id, "value" => [$nombre, $desde, $hasta, $aplicar, $exceso, $cuota]];
    }

    private function validarRango($desde, $hasta)
    {
        if ($hasta !== null && ((float)$desde == (float)$hasta || (float)$desde >= (float)$hasta)) {
            if ((float)$desde == (float)$hasta) {
                return $this->crearMensaje('El rango monetario no puede ser igual', 'warning');
            } else {
                return $this->crearMensaje('El final del rango monetario debe ser mayor', 'warning');
            }
        }
        return null; // La validación del rango pasó sin problemas
    }

    private function validarMes($mes)
    {
        switch ($mes) {
            case 1:
                return "Enero";
                break;
            case 2:
                return "Febrero";
                break;
            case 3:
                return "Marzo";
                break;
            case 4:
                return "Abril";
                break;
            case 5:
                return "Mayo";
                break;
            case 6:
                return "Junio";
                break;
            case 7:
                return "Julio";
                break;
            case 8:
                return "Agosto";
                break;
            case 9:
                return "Septiembre";
                break;
            case 10:
                return "Octubre";
                break;
            case 11:
                return "Noviembre";
                break;
            case 12:
                return "Diciembre";
                break;
            default:
                return "error";
        }
    }

    private function validarCadenas($valor)
    {
        $valor = isset($valor) ? trim($valor) : null;
        $valor = $valor != null ? preg_replace('/[^a-zA-Z0-9\s.]/', '', $valor) : null;
        return $valor;
    }

    private function validarNumeros($valor)
    {
        $valor = isset($valor) ? trim($valor) : null;
        return is_numeric($valor) ? floatval($valor) : null;
    }

    private function crearMensaje($mensaje, $icono)
    {
        return ['msg' => $mensaje, 'icono' => $icono];
    }

    public function boletaPago($id)
    {
        require_once 'libs/fpdf/fpdf.php';

        $planilla = $this->model->getPlanillaEmpleadoById($id);
        if (empty($planilla)) {
            header('Location: ' . base_url . 'Inicio/index');
            exit();
        }

        $horas = $this->model->getHorasExtrasByIdPlanilla($id) ?? [];
        $remuneraciones = $this->model->getRemuneracionesByIdPlanilla($id) ?? [];
        $descuentos = $this->model->getDescuentosByIdPlanilla($id) ?? [];
        $prestaciones = $this->model->getPrestacionesPlanilla($id) ?? [];
        $totalDescuentos = ($prestaciones['afp'] ?? 0) + ($prestaciones['isss'] ?? 0) + ($prestaciones['renta'] ?? 0);
        $nombre_completo = $planilla['primernombre'] . ' ' . $planilla['segundonombre'] . ' ' . $planilla['primerapellido'] . ' ' . $planilla['segundoapellido'];
        $numDias = cal_days_in_month(CAL_GREGORIAN, $planilla['mes'], $planilla['anio']);

        $pdf = new FPDF('P', 'mm', array(150, 150));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, 'Lacteos El Sur', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(0, 4, 'RECIBO DE PAGO POR SERVICIOS PRESTADOS', 0, 1, 'L');
        $pdf->Cell(0, 4, 'PERIODO DE PLANILLA', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(70, 4, 'DESDE', 0, 0, 'C');
        $pdf->Cell(70, 4, 'HASTA', 0, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', $planilla['mes'] . '/' . '1' . '/' . $planilla['anio']), 0, 0, 'C');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', $planilla['mes'] . '/' . $numDias . '/' . $planilla['anio']), 0, 1, 'C');
        $pdf->Ln();
        $pdf->Cell(15, 4, iconv('UTF-8', 'ISO-8859-1', 'Código'), 1, 0, 'L');
        $pdf->Cell(125, 4, iconv('UTF-8', 'ISO-8859-1', 'Nombre'), 1, 1, 'L');
        $pdf->Cell(15, 4, iconv('UTF-8', 'ISO-8859-1', $planilla['id_planilla']), 1, 0, 'L');
        $pdf->Cell(125, 4, iconv('UTF-8', 'ISO-8859-1', $nombre_completo), 1, 1, 'L');
        $pdf->Ln();
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'SALARIO:'), 'TL', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $planilla['salario_planilla']), 'TR', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'DESCUENTOS:'), 'TL', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'TR', 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Total horas Extra Diurnas'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $horas['pago_horas_extras']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Descuentos AFP'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '-$       ' . $prestaciones['afps']), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Total horas extra nocturnas'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $horas['pagos_horas_nocturnas']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Descuentos ISSS'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '-$       ' . $prestaciones['isss']), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Feriado'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$      ' . $remuneraciones['feriado']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Descuento Renta'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '-$       ' . $prestaciones['renta']), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'Domingo'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$      ' . $remuneraciones['domingo']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', '30% Vacaciones'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$      ' . $remuneraciones['vacaciones']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', '(-) Incapacidades'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $descuentos['incapacidades']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', '(-) Permisos'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $descuentos['permisos']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', '(-) Llegadas tarde'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $descuentos['llegadas_tardias']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', '(-) Días descontados'), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $descuentos['dias_descontados']), 'R', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'L', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'R', 1, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'LR', 0, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'LR', 1, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'LR', 0, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', ''), 'LR', 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'TOTAL DESVENGADO'), 'LB', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $planilla['salario_bruto']), 'RB', 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', 'TOTAL DESCUENTOS'), 'LB', 0, 'L');
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', '-$      ' . $totalDescuentos), 'RB', 1, 'L');
        $pdf->Ln();
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', 'LIQUIDO EFECTIVO'), 0, 0, 'R');
        $pdf->Cell(34, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $planilla['salario_neto']), 0, 0, 'L');
        $pdf->Cell(34, 4, iconv('UTF-8', 'ISO-8859-1', ''), 0, 1, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', 'VIATICOS'), 0, 0, 'R');
        $pdf->Cell(34, 4, iconv('UTF-8', 'ISO-8859-1', '$'), 'B', 0, 'L');
        $pdf->Cell(34, 4, iconv('UTF-8', 'ISO-8859-1', ''), 0, 1, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', 'TOTAL A RECIBIR'), 0, 0, 'R');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', '$       ' . $planilla['salario_neto']), 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 4, iconv('UTF-8', 'ISO-8859-1', 'Fecha de entrega'), 0, 0, 'L');
        $pdf->Cell(45, 4, iconv('UTF-8', 'ISO-8859-1', date('Y-M-d')), 0, 0, 'L');
        $pdf->Cell(70, 4, iconv('UTF-8', 'ISO-8859-1', 'F.'), 'B', 0, 'L');
        ob_clean(); 
        $pdf->Output('Boleta_de_pago' . date("Y-m-d H:i:s") . '.pdf', 'I');
        exit(); 
    }
}
