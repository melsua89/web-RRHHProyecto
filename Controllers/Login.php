<?php

class Login extends Controller{

    public function __construct(){
        if (isset($_SESSION['usuario'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function index(){
        $this->views->getView($this, "index");
    }

/*     public function getUsuario($usuario, $password) {
        try {
      
    
            if (count($data) > 0) {
                return $data[0]; // Assuming you want to return the first result
            } else {
                throw new Exception("Credenciales inválidas.");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null; // Or handle the error differently, e.g., log it
        }
    } */




    public function acceder(){
        $usuario = strClean($_POST['usuario']);
        $password = strClean($_POST['password']);
    
        if (empty($usuario) || empty($password)) {
            $msg = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning', 'status' => 'error');
        } else {
            $data = $this->model->getUsuario($usuario, $password);
    
            if($data){
                session_start();
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['usuario'];
                $_SESSION['activo'] = true;
    
                $msg = array('msg' => 'Procesando', 'icono' => 'success', 'status' => 'success');
            } else {
                $msg = array('msg' => 'Credenciales inválidas', 'icono' => 'warning', 'status' => 'error');
            }
        }
    
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    

    public function salir()
    {
        // Destruir todas las variables de sesión.
        $_SESSION = array();
            
        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finalmente, destruir la sesión.
        session_destroy();
        header("location: ". base_url );
    }
}