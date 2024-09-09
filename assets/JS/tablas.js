// Obtener la fecha y hora actual
let fechaActual = new Date();

// Obtener partes específicas de la fecha
let anio = fechaActual.getFullYear();
let mes = fechaActual.getMonth() + 1;
let dia = fechaActual.getDate();
let horas = fechaActual.getHours();
let minutos = fechaActual.getMinutes();
let segundos = fechaActual.getSeconds();

let tblEmpleados, tblPrestaciones, tblRenta, tblAguinaldo, tblSalarios;
document.addEventListener("DOMContentLoaded", function(){
    const language = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "buttons" :{
            'copy': 'Copy',
            'copyTitle': '<i class="fa-solid fa-copy"></i> Copiado',
            'copySuccess': {
                '1': "Una fila en el porta papeles",
                '_': "%d filas en el porta papeles"
            },
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'Seleccione una fila',
                1: 'Una fila seleccionada'
            }
        }

    }
    tblEmpleados = new DataTable('#tblEmpleados', {
        fixedHeader: true,
        responsive: true,
        select: true,
        language,
        ajax: {
            url: base_url + "Empleados/mostrar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'primernombre'
            },
            {
                'data': 'segundonombre'
            },
            {
                'data': 'primerapellido'
            },
            {
                'data': 'segundoapellido'
            },
            {
                'data': 'dui'
            },
            {
                'data': 'sexo'
            },
            {
                'data': 'fechanacimiento'
            },
            {
                'data': 'fechaingreso'
            },
            {
                'data': 'cargo'
            },
            {
                'data': 'sueldo'
            },
            {
                'data': 'seguromedico'
            },
            {
                'data': 'pension'
            },
            {
                'data': 'numeroafiliado'
            },
            {
                'data': 'incrementos'
            }
        ],
        dom: "<'row'<'col-sm-12 py-4'B>>" +
        "<'row'<'col-12 col-md-4 col-xl-8'l><'col-12 col-md-8 col-xl-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'selected',
                text: '<button class="btn btn-dark" data-toggle="tooltip" data-placement="top">Modificar</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btneditarEmpleado(data.id);
                }
            },
            {
                extend: 'selected',
                text: '<button class="btn btn-primary" data-toggle="tooltip" data-placement="top">Realizar Incremento</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btnIncrementoEmpleado(data.id);
                }
            },
            {
                extend: 'selected',
                text: '<button class="btn btn-warning" data-toggle="tooltip" data-placement="top">Dar de baja</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btneliminarEmpleado(data.id);
                }
            },
            {
                extend: 'excel',
                footer: true,
                title: 'Archivo excel',
                filename: 'planilla',
                text: '<button class="btn btn-success " data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-file-excel fa-lg"></i></button>',
            },
            //Botón para CSV
            {
                extend: 'csv',
                footer: true,
                title: 'Archivo CSV',
                filename: 'planilla',
                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-dark" data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-file-csv fa-lg"></i></button>'
            },
            {
                extend: 'print',
                footer: true,
                title: 'Reporte',
                filename: 'planilla',
                text: '<button class="btn btn-light" data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-print fa-lg"></i></button>',
            },
            {
                extend: 'pdf',
                footer: true,
                title: 'Lista de Empleados en la empresa',
                filename: 'planilla',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                text: '<button class="btn btn-danger" data-toggle="tooltip" data-placement="top"><i class="fa-regular fa-file-pdf fa-lg"></i></button>',
            }
        ],
    });
    tblPrestaciones = new DataTable('#tblPrestaciones', {
        fixedHeader: true,
        responsive: true,
        select: true,
        language,
        ajax: {
            url: base_url + "Prestaciones/mostrar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'tipo'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'desde'
            },
            {
                'data': 'hasta'
            },
            {
                'data': 'patronal'
            },
            {
                'data': 'laboral'
            },
            {
                'data': 'techo'
            }
        ],
        dom: "<'row'<'col-sm-12 py-4'B>>" +
        "<'row'<'col-12 col-md-12 col-xl-12'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'selected',
                text: '<button class="btn btn-dark" data-toggle="tooltip" data-placement="top">Modificar regla</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btnEditarPrestacion(data.id);
                }
            },
            {
                extend: 'selected',
                text: '<button class="btn btn-danger" data-toggle="tooltip" data-placement="top">Eliminar regla</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btnEliminarPrestacion(data.id);
                }
            },
        ],
    });
    tblRenta = new DataTable('#tblRenta', {
        fixedHeader: true,
        responsive: true,
        select: true,
        language,
        ajax: {
            url: base_url + "Renta/mostrar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'nombre'
            },
            {
                'data': 'desde'
            },
            {
                'data': 'hasta'
            },
            {
                'data': 'aplicar'
            },
            {
                'data': 'sobre_exceso'
            },
            {
                'data': 'cuota_fija'
            }
        ],
        dom: "<'row'<'col-sm-12 py-4'B>>" +
        "<'row'<'col-12 col-md-12 col-xl-12'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'selected',
                text: '<button class="btn btn-dark" data-toggle="tooltip" data-placement="top">Modificar regla</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btnEditarRenta(data.id);
                }
            },
            {
                extend: 'selected',
                text: '<button class="btn btn-danger" data-toggle="tooltip" data-placement="top">Eliminar regla</button>',
                action: function ( e, dt, button, config ) {
                    data = dt.row( { selected: true } ).data();
                    btnEliminarRenta(data.id);
                }
            },
        ],
    });
    tblAguinaldo = new DataTable('#tblAguinaldo', {
        fixedHeader: true,
        responsive: true,
        select: true,
        language,
        ajax: {
            url: base_url + "Aguinaldo/mostrar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'nombrecompleto'
            },
            {
                'data': 'dui'
            },
            {
                'data': 'sueldo_base'
            },
            {
                'data': 'fechaingreso'
            },
            {
                'data': 'fecha_actual'
            },
            {
                'data': 'anios_laborales'
            },
            {
                'data': 'dias_base'
            },
            {
                'data': 'aguinaldo'
            },
            {
                'data': 'renta_aguinaldo'
            },
            {
                'data': 'liquido_pagar'
            }
        ],
        dom: "<'row'<'col-sm-12 py-4'B>>" +
        "<'row'<'col-12 col-md-4 col-xl-8'l><'col-12 col-md-8 col-xl-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            //Botón para PDF
            {
                extend: 'pdf',
                footer: true,
                title: 'Planilla del Aguinaldo ' + dia + "/" + mes + "/" + anio,
                filename: 'planilla_Aguinaldo_'+ dia + mes + anio + horas + minutos + segundos,
                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-danger" data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-file-pdf"></i></button>'
            },
            {
                extend: 'excel',
                footer: true,
                title: 'Planilla del Aguinaldo ' + dia + "/" + mes + "/" + anio,
                filename: 'planilla_Aguinaldo_'+ dia + mes + anio + horas + minutos + segundos,
                text: '<button class="btn btn-success " data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-file-excel fa-lg"></i></button>',
            },
            //Botón para CSV
            {
                extend: 'csv',
                footer: true,
                title: 'Planilla del Aguinaldo ' + dia + "/" + mes + "/" + anio,
                filename: 'planilla_Aguinaldo_'+ dia + mes + anio + horas + minutos + segundos,
                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-dark" data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-file-csv fa-lg"></i></button>'
            },
            {
                extend: 'print',
                footer: true,
                title: 'Planilla del Aguinaldo ' + dia + "/" + mes + "/" + anio,
                filename: 'planilla_Aguinaldo_'+ dia + mes + anio + horas + minutos + segundos,
                text: '<button class="btn btn-light" data-toggle="tooltip" data-placement="top"><i class="fa-solid fa-print fa-lg"></i></button>',
            },
        ],
    });
    tblSalarios = new DataTable('#tblSalarios', {
        fixedHeader: true,
        responsive: true,
        language,
        dom: "<'row'<'col-12 col-md-4 col-xl-8'l><'col-12 col-md-8 col-xl-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
})
