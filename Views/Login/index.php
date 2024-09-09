<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!-- boststrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="<?php echo base_url; ?>assets/JS/jquery-3.7.1.min.js" ></script>
    <script src="<?php echo base_url; ?>assets/JS/menu.js" ></script>

    <link rel="stylesheet" href="<?php echo base_url; ?>assets/CSS/style_login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
    </style>
</head>
<body>
    <div  class="login-container">
        <div class="image-container"></div>
        <div class="login-form">
            <img  src="<?php echo base_url; ?>assets/IMG/Login_icono.png" alt="">
            <h1>SISTEMA DE PLANILLAS LACTEOS EL SUR</h1>
            <form id="frmLogin" onsubmit="frmLogin(event);">
                <input type="text" name="usuario" placeholder="Usuario" id="usuario" required>
                <input type="password" name="password" placeholder="Contraseña" id="password" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div> 
    
    <!-- ... (código Modal) -->
    <!-- Modal para mostrar mensaje de error -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error de inicio de sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Las credenciales son incorrectas. Inténtalo de nuevo.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const base_url = '<?php echo base_url; ?>';
    </script>
    <script src="<?php echo base_url; ?>assets/JS/login.js"></script>
</body>
</html>