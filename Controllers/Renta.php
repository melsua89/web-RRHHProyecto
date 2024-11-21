<?php 
class Renta extends Controller{

    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function mostrar(){
        $data = $this->model->getAllRentaByEstado(1);
        for ($i = 0; $i < count($data); $i++) { 
            $data[$i]["desde"] = $data[$i]["desde"] !== null ? '$ ' . number_format($data[$i]["desde"], 2, '.', ',') : "Sin retención";
            $data[$i]["hasta"] = $data[$i]["hasta"] !==  null ? '$ ' . number_format($data[$i]["hasta"], 2, '.', ',') : "En adelante";
            $data[$i]["aplicar"] = $data[$i]["aplicar"] != 0.00 ? $data[$i]["aplicar"] . ' %' : "Sin retención";
            $data[$i]["sobre_exceso"] = $data[$i]["sobre_exceso"] != 0 ? '$ ' . number_format($data[$i]["sobre_exceso"], 2, '.', ',') : "Sin retención";
            $data[$i]["cuota_fija"] = $data[$i]["cuota_fija"] != 0 ? '$ ' . number_format($data[$i]["cuota_fija"], 2, '.', ',') : "Sin retención";
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function agregar(){
        $datos = $this->validarCampos();
        if ($datos != false) {
            $result = empty($datos['key']) 
                ? $this->model->insertRenta($datos['value'])
                : $this->model->updateRenta($datos['value'], $datos['key']);
    
            $msg = $result == "ok" 
                ? $this->crearMensaje('Regla guardada', 'success')
                : $this->crearMensaje('Parece que ha ocurrido un problema', 'warning');

        } else {
            $msg = $this->crearMensaje('Error en los datos', 'warning');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($id){
        $data = $this->model->getRentaById($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->deleteRenta($id, 0);
        $msg = $data == "ok" 
            ? $msg = $this->crearMensaje('Regla eliminada','success')
            : $msg = $this->crearMensaje('Parece que ha ocurrido un problema','warning');
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validarCampos() {
        $id = $this->validarNumeros($_POST['id']);
        $nombre = $this->validarCadenas($_POST['nombre']);
        $desde = $this->validarNumeros($_POST['desde']);
        $hasta = $this->validarNumeros($_POST['hasta']);
        $aplicar =$this->validarNumeros($_POST['aplicar']);
        $exceso = $this->validarNumeros($_POST['sobre_exceso']);
        $cuota = $this->validarNumeros($_POST['cuota_fija']);
        
        $validarRango = $this->validarRango($desde, $hasta);
        if (!empty($validarRango)) {
            echo json_encode($validarRango, JSON_UNESCAPED_UNICODE);
            die();
        }
        return ["key" => $id, "value" => [$nombre, $desde, $hasta, $aplicar, $exceso, $cuota]];
    }
    
    private function validarRango($desde, $hasta) {
        if ($hasta !== null && ((double)$desde == (double)$hasta || (double)$desde >= (double)$hasta)) {
            if ((double)$desde == (double)$hasta) {
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


?>