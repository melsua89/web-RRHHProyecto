$(document).ready(function () {
    $('#Menu_empleados a').click(function (event) {
        event.preventDefault(); // Previene la recarga de la página por defecto al hacer clic en un enlace

        var url = $(this).attr('href'); // Obtiene la URL del enlace

        // Realiza una solicitud AJAX para cargar el contenido de la URL en el contenedor
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#contenedorSeleccion').html(data); // Coloca el contenido cargado en el contenedor
            },
            error: function () {
                $('#contenedorSeleccion').html('Error al cargar la página.'); // Maneja errores de carga
            }
        });
    });

    $('#Menu_planilla a').click(function (event) {
        event.preventDefault(); // Previene la recarga de la página por defecto al hacer clic en un enlace

        var url = $(this).attr('href'); // Obtiene la URL del enlace

        // Realiza una solicitud AJAX para cargar el contenido de la URL en el contenedor
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#contenedorSeleccion').html(data); // Coloca el contenido cargado en el contenedor
            },
            error: function () {
                $('#contenedorSeleccion').html('Error al cargar la página.'); // Maneja errores de carga
            }
        });
    });
// Sub-Menu
    $('#sub-menu-salario').click(function (event) {
        event.preventDefault(); // Previene la recarga de la página por defecto al hacer clic en un enlace

        var url = $(this).attr('href'); // Obtiene la URL del enlace

        // Realiza una solicitud AJAX para cargar el contenido de la URL en el contenedor
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#contenedorSeleccion').html(data); // Coloca el contenido cargado en el contenedor
            },
            error: function () {
                $('#contenedorSeleccion').html('Error al cargar la página.'); // Maneja errores de carga
            }
        });
    });

    $('#sub-menu-aguinaldo').click(function (event) {
        event.preventDefault(); // Previene la recarga de la página por defecto al hacer clic en un enlace

        var url = $(this).attr('href'); // Obtiene la URL del enlace

        // Realiza una solicitud AJAX para cargar el contenido de la URL en el contenedor
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#contenedorSeleccion').html(data); // Coloca el contenido cargado en el contenedor
            },
            error: function () {
                $('#contenedorSeleccion').html('Error al cargar la página.'); // Maneja errores de carga
            }
        });
    });

 // End-Sub-Menu

    $('#Menu_reporte a').click(function (event) {
        event.preventDefault(); // Previene la recarga de la página por defecto al hacer clic en un enlace

        var url = $(this).attr('href'); // Obtiene la URL del enlace

        // Realiza una solicitud AJAX para cargar el contenido de la URL en el contenedor
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#contenedorSeleccion').html(data); // Coloca el contenido cargado en el contenedor
            },
            error: function () {
                $('#contenedorSeleccion').html('Error al cargar la página.'); // Maneja errores de carga
            }
        });
    });

    $('#Menu_deducciones a').click(function (event) {
        event.preventDefault(); // Previene la recarga de la página por defecto al hacer clic en un enlace

        var url = $(this).attr('href'); // Obtiene la URL del enlace

        // Realiza una solicitud AJAX para cargar el contenido de la URL en el contenedor
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#contenedorSeleccion').html(data); // Coloca el contenido cargado en el contenedor
            },
            error: function () {
                $('#contenedorSeleccion').html('Error al cargar la página.'); // Maneja errores de carga
            }
        });
    });
});
