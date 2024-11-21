<?php
class Views{

    public function getView($controlador, $vista, $data="")
    {
        
        $controlador = get_class($controlador);
        // if ($controlador == "Inicio") {
        //     $vista = "Views/".$vista.".php";
        // }else{
            $vista = "Views/".$controlador."/".$vista.".php";
        // }
        require $vista;
    }
}


?>
