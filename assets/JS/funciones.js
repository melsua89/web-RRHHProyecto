
function alertas(msg, icono) {
    Swal.fire({
        position: 'center',
        icon: icono,
        title: msg,
        showConfirmButton: true,
        timer: 3000
    })
}

function frmEmpleado() {
    document.getElementById("empleadosModalLabel").textContent= "Agregar Empleado";
    $('.col-md-6:has(input#txtSueldo)').addClass("d-block");
    $('.col-md-6:has(input#txtSueldo)').removeClass("d-none");
    $( "#txtSueldo" ).prop( "disabled", false );
    $('.col-md-6:has(input#txtDUI)').addClass("d-block");
    $('.col-md-6:has(input#txtDUI)').removeClass("d-none");
    $( "#txtDUI" ).prop( "disabled", false );
    document.getElementById("frmEmpleados").reset();
    document.getElementById("txtid").value = "";
    $("#empleadosModal").modal("show");
}

function agregarEmpleado(e) {
    e.preventDefault();
    const url = base_url + "Empleados/agregar";
    const frm = document.getElementById("frmEmpleados");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#empleadosModal").modal("hide");
            frm.reset();
            tblEmpleados.ajax.reload();
            alertas(res.msg, res.icono);
        }
    }
}

function btneditarEmpleado(id){
    const url = base_url + "Empleados/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("empleadosModalLabel").textContent = "Modificar datos";
            document.getElementById("txtid").value = res.id
            document.getElementById("txtprimerNombre").value = res.primernombre;
            document.getElementById("txtsegundoNombre").value = res.segundonombre;
            document.getElementById("txtprimerApellido").value = res.primerapellido;
            document.getElementById("txtsegundoApellido").value = res.segundoapellido;
            document.getElementById("sexo").value = res.sexo;
            document.getElementById("txtFechaNacimiento").value = res.fechanacimiento;
            document.getElementById("txtFechaIngreso").value = res.fechaingreso;
            document.getElementById("txtCargo").value = res.cargo;
            document.getElementById("seguro").value = res.seguromedico;
            document.getElementById("pension").value = res.pension;
            document.getElementById("txtNumeroAfiliado").value = res.numeroafiliado;

            $('.col-md-6:has(input#txtDUI)').addClass("d-none");
            $('.col-md-6:has(input#txtDUI)').removeClass("d-block");
            $( "#txtDUI" ).prop( "disabled", true );
            $('.col-md-6:has(input#txtSueldo)').addClass("d-none");
            $('.col-md-6:has(input#txtSueldo)').removeClass("d-block");
            $( "#txtSueldo" ).prop( "disabled", true );

            $("#empleadosModal").modal("show");
        }
    }
}

function btnIncrementoEmpleado(id){
    const url = base_url + "Empleados/incremento/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("empleadosModalLabel").textContent = "Modificar datos";
            document.getElementById("id_empleado_incremento").value = res.id
            document.getElementById("nombre_empleado").value = res.primernombre + " " + res.segundonombre + " " + res.primerapellido + " " + res.segundoapellido;
            document.getElementById("dui_incremento").value = res.dui;
            document.getElementById("cargo_incremento").value = res.cargo;
            document.getElementById("fecha_ingreso_incremento").value = res.fechaingreso;
            document.getElementById("sueldo_actual").value = res.sueldo;
            $("#incrementoModal").modal("show");
        }
    }
}

function agregarIncremento(e) {
    e.preventDefault();
    const url = base_url + "Empleados/registrar_incremento";
    const frm = document.getElementById("frmIncremento");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#incrementoModal").modal("hide");
            frm.reset();
            tblEmpleados.ajax.reload();
            alertas(res.msg, res.icono);
        }
    }
}

function btneliminarEmpleado(id){
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "El empleado no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Empleados/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEmpleados.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function frmPrestaciones() {
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Ten en cuenta que al modifcar una regla, afectara el calculo de la planilla salarial",
        icon: 'info',
        width: '40em',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("prestacionesModalLabel").textContent= "Agregar nueva regla";
            document.getElementById("frmPrestaciones").reset();
            document.getElementById("id").value = "";
            $("#prestacionesModal").modal("show");
        }
    })
}

function agregarPrestacion(e) {
    e.preventDefault();
    const url = base_url + "Prestaciones/agregar";
    const frm = document.getElementById("frmPrestaciones");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            frm.reset();
            tblPrestaciones.ajax.reload();
            alertas(res.msg, res.icono);
            $("#prestacionesModal").modal("hide");
        }
    }
}

function btnEditarPrestacion(id){
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Ten en cuenta que al modifcar una regla, afectara el calculo de la planilla salarial",
        icon: 'info',
        width: '40em',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Prestaciones/editar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    $("#prestacionesModal").modal("show");
                    document.getElementById("prestacionesModalLabel").textContent = "Modificar datos";
                    document.getElementById("id").value = res.id;
                    document.getElementById("tipo").value = res.tipo;
                    document.getElementById("nombre").value = res.nombre;
                    document.getElementById("desde").value = res.desde;
                    document.getElementById("hasta").value = res.hasta;
                    document.getElementById("patronal").value = res.patronal;
                    document.getElementById("laboral").value = res.laboral;
                    document.getElementById("techo").value = res.techo;
                }
            }
        }
    })
}

function btnEliminarPrestacion(id){
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Esta regla no se aplicara mas en la planilla de empleados!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Prestaciones/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblPrestaciones.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function frmRenta() {
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Ten en cuenta que al agregar una nueva regla, afectara el calculo de la planilla salarial",
        icon: 'info',
        width: '40em',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("rentaModalLabel").textContent = "Agregar nueva regla";
            document.getElementById("frmRenta").reset();
            document.getElementById("id").value = "";
            $("#rentaModal").modal("show");
        }
    })
}

function agregarRenta(e){
    e.preventDefault();
    const url = base_url + "Renta/agregar";
    const frm = document.getElementById("frmRenta");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            frm.reset();
            tblRenta.ajax.reload();
            alertas(res.msg, res.icono);
            $("#rentaModal").modal("hide");
        }
    }
}

function btnEditarRenta(id){
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Ten en cuenta que al modifcar una regla, afectara el calculo de la planilla salarial",
        icon: 'info',
        width: '40em',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Renta/editar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    $("#rentaModal").modal("show");
                    document.getElementById("rentaModalLabel").textContent = "Modificar datos";
                    document.getElementById("id").value = res.id;
                    document.getElementById("nombre").value = res.nombre;
                    document.getElementById("desde").value = res.desde;
                    document.getElementById("hasta").value = res.hasta;
                    document.getElementById("aplicar").value = res.aplicar;
                    document.getElementById("sobre_exceso").value = res.sobre_exceso;
                    document.getElementById("cuota_fija").value = res.cuota_fija;
                }
            }
        }
    })
}

function btnEliminarRenta(id){
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Esta regla no se aplicara mas en la planilla de empleados!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Renta/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblRenta.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function btnVerAguinaldoEmpleado(e){
    e.preventDefault();
    document.getElementById("selectCambio").reset();
    //document.getElementById("id").value = "";
    $("#buscarAguinaldoModal").modal("show");
}

function buscarCambiosAguinaldo(e){
    e.preventDefault();
    let fecha = document.getElementById('selectCambio').value;
    const url = base_url + "Aguinaldo/buscar/" + fecha;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = url;
        }
    }
}

function btnGenerarPlanillaAguinaldo(e){
    e.preventDefault();
    const url = base_url + "Aguinaldo/generarPlanilla";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            tblAguinaldo.ajax.reload();
            alertas(res.msg, res.icono);
        }
    }
}

function btnPlanillaSalarial(){
    Swal.fire({
        title: '¿ Esta seguro ?',
        text: "Se generar una nueva nomina salarial",
        icon: 'info',
        width: '40em',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("frmPlanillaSalarial").reset();
            $("#planillaSalarialModal").modal("show");
        }
    })
}

function generarPlanillaSalarial(e){
    e.preventDefault();
    const url = base_url + "Planilla_Salarial/generarPlanilla";
    const frm = document.getElementById("frmPlanillaSalarial");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#planillaSalarialModal").modal("hide");
            alertas(res.msg, res.icono);
            setTimeout(() => {
                location.reload(true);
            }, 2000);
        }
    }
}

function btnbuscarPlanillaSalarial(e){
    e.preventDefault();
    let anio = document.getElementById("selectplanillaanio").value;
    let mes = document.getElementById("selectplanillames").value;
    const url = base_url + "Planilla_Salarial/buscar?mes=" + mes + "&anio=" + anio;
    const frm = document.getElementById("frmBuscarPlanilla");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            frm.reset();
            window.location.href = url;
        }
    }
}

function btnHorasExtras(id){
    document.getElementById("frmHorasExtras").reset();
    const url = base_url + "Planilla_Salarial/horas_extras/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            
            if(res.id_planilla != null){
                $("#num_horas_extras").val(res.num_horas_extras).prop("disabled", true);
                $("#total_hora_extras").val(res.pago_horas_extras);
                $("#num_horas_nocturnas").val(res.num_horas_nocturnas).prop("disabled", true);
                $("#total_hora_nocturnas").val(res.pagos_horas_nocturnas);
                $("#horas_salario_bruto").val(res.salario_bruto);
                $("#id_nomina_horas_extras").val(res.id_planilla);
                $("#btnModificarHoras").addClass('d-block').removeClass('d-none'); 
                $("#btnGuardarHorasExtras").addClass('d-none').removeClass('d-block');
            } else {
                $("#id_nomina_horas_extras").val(res.id);
                $("#horas_salario_bruto").val(res.salario);
                $("#num_horas_extras").prop("disabled", false);
                $("#num_horas_nocturnas").prop("disabled", false);
                $("#btnModificarHoras").addClass('d-none').removeClass('d-block');
                $("#btnGuardarHorasExtras").addClass('d-block').removeClass('d-none');
            }

            $("#horas_salario_base").val(res.salario);
            $("#horasExtrasModal").modal("show");
        }
    }
}

$("#btnModificarHoras").click(function(){
    $("#num_horas_nocturnas").prop("disabled", false);
    $("#num_horas_extras").prop("disabled", false);
    $("#btnGuardarHorasExtras").addClass('d-block').removeClass('d-none');
    $("#btnModificarHoras").addClass('d-none').removeClass('d-block');
});

function generarHorasExtras(e){
    e.preventDefault();
    const url = base_url + "Planilla_Salarial/registrar_horas_extras";
    const frm = document.getElementById("frmHorasExtras");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#horasExtrasModal").modal("hide");
            frm.reset();
            alertas(res.msg, res.icono);
            setTimeout(() => {
                location.reload(true);
            }, 2000);
        }
    }
}

$("#num_horas_extras").on("change", function () {
    let horas = validarEntero($("#num_horas_extras").val());
    let salario_base = validarNumero($("#horas_salario_base").val());
    horas = (( salario_base / 30 / 8 ) * 2 )* horas;
    $("#total_hora_extras").val(horas.toFixed(2));
    

    let total_horas = validarNumero($("#total_hora_extras").val());
    let tatal_noc = validarNumero($("#total_hora_nocturnas").val());
    let salario_bruto = validarNumero($("#horas_salario_base").val());

    salario_bruto = salario_bruto + total_horas + tatal_noc;
    $("#horas_salario_bruto").val(salario_bruto.toFixed(2));
});


$("#num_horas_nocturnas").on("change", function () {
    let horas = validarEntero($("#num_horas_nocturnas").val());
    let salario_base = validarNumero($("#horas_salario_base").val());
    salario_base =  ( salario_base / 30 / 8 ) * 2;
    nocturnidad = (salario_base) * 0.25;
    horas = (salario_base + nocturnidad) * horas;
    $("#total_hora_nocturnas").val(horas.toFixed(2));

    let total_horas = validarNumero($("#total_hora_extras").val());
    let tatal_noc = validarNumero($("#total_hora_nocturnas").val());
    let salario_bruto = validarNumero($("#horas_salario_base").val());

    salario_bruto = salario_bruto + total_horas + tatal_noc;
    $("#horas_salario_bruto").val(salario_bruto.toFixed(2));
});

function btnRemuneraciones(id){
    document.getElementById("frmRemuneraciones").reset();
    const url = base_url + "Planilla_Salarial/remuneraciones/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if(res.id_planilla != null){
                $("#id_remuneraciones").val(res.id_planilla);
                $("#feriado").val(res.feriado).prop("disabled", true);
                $("#reintegro").val(res.reintegro).prop("disabled", true);
                $("#domingo").val(res.domingo).prop("disabled", true);
                $("#vacaciones").val(res.vacaciones).prop("disabled", true);
                $("#btnModificarRemuneraciones").addClass('d-block').removeClass('d-none'); 
                $("#btnGuardarRemuneraciones").addClass('d-none').removeClass('d-block');
            } else {
                $("#id_remuneraciones").val(res.id);
                $("#feriado").prop("disabled", false);
                $("#reintegro").prop("disabled", false);
                $("#domingo").prop("disabled", false);
                $("#vacaciones").prop("disabled", false);
                $("#btnModificarRemuneraciones").addClass('d-none').removeClass('d-block'); 
            }
            $("#remuneracionesModal").modal("show");
        }
    }
}

$("#btnModificarRemuneraciones").click(function(){
    $("#feriado").prop("disabled", false);
    $("#reintegro").prop("disabled", false);
    $("#domingo").prop("disabled", false);
    $("#vacaciones").prop("disabled", false);
    $("#btnGuardarRemuneraciones").addClass('d-block').removeClass('d-none');
    $("#btnModificarRemuneraciones").addClass('d-none').removeClass('d-block'); 
});

function generarRemuneraciones(e){
    e.preventDefault();
    const url = base_url + "Planilla_Salarial/registrar_remuneraciones";
    const frm = document.getElementById("frmRemuneraciones");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#remuneracionesModal").modal("hide");
            frm.reset();
            alertas(res.msg, res.icono);
            setTimeout(() => {
                location.reload(true);
            }, 2000);
        }
    }
}

function btnDescuentosSalarios(id){
    document.getElementById("frmDescuentosSalarial").reset();
    const url = base_url + "Planilla_Salarial/descuentos/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if(res.id_planilla != null){
                $("#id_descuentos").val(res.id_planilla);
                $("#incapacidades").val(res.incapacidades).prop("disabled", true);
                $("#permisos").val(res.permisos).prop("disabled", true);
                $("#llegadas_tardias").val(res.llegadas_tardias).prop("disabled", true);
                $("#dias_descontados").val(res.dias_descontados).prop("disabled", true);
                $("#btnModificarDescuentos").addClass('d-block').removeClass('d-none');
                $("#btnGuardarDescuentos").addClass('d-none').removeClass('d-block');  
            } else {
                $("#id_descuentos").val(res.id);
                $("#incapacidades").prop("disabled", false);
                $("#permisos").prop("disabled", false);
                $("#llegadas_tardias").prop("disabled", false);
                $("#dias_descontados").prop("disabled", false);
                $("#btnModificarDescuentos").addClass('d-none').removeClass('d-block'); 
            }
            $("#descuentosSalarialesModal").modal("show");
        }
    }
}

$("#btnModificarDescuentos").click(function(){
    $("#incapacidades").prop("disabled", false);
    $("#permisos").prop("disabled", false);
    $("#llegadas_tardias").prop("disabled", false);
    $("#dias_descontados").prop("disabled", false);
    $("#btnGuardarDescuentos").addClass('d-block').removeClass('d-none');
    $("#btnModificarDescuentos").addClass('d-none').removeClass('d-block');    
});

function generarDescuentosSalariales(e){
    e.preventDefault();
    const url = base_url + "Planilla_Salarial/registrar_descuentos";
    const frm = document.getElementById("frmDescuentosSalarial");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#descuentosSalarialesModal").modal("hide");
            frm.reset();
            alertas(res.msg, res.icono);
            setTimeout(() => {
                location.reload(true);
            }, 2000);
        }
    }
}

function btnPresLeySalarios(id){
    document.getElementById("frmPretacionesLey").reset();
    const url = base_url + "Planilla_Salarial/prestaciones/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if(res.id_planilla != null){
                $("#id_prestaciones_ley").val(res.id_planilla);
                $("#afps").val(res.afps);
                $("#isss").val(res.isss);
                $("#renta").val(res.renta);
                $("#prestaciones_salario_bruto").val(res.salario_bruto);
                $("#prestaciones_salario_neto").val(res.salario_neto);
            }   
            else{
                $("#id_prestaciones_ley").val(res.id);
            }
            $("#prestacionesLeyModal").modal("show");
        }
    }
}

function validarNumero(valor){
    if(valor !== ''){
        if(isNaN(valor)){
            return 0;
        }else{
            return parseFloat(valor);
        }
    }else{
        return 0;
    }
}

function validarEntero(valor){
    if(valor !== ''){
        if(isNaN(valor)){
            return 0;
        }else{
            return parseInt(valor);
        }
    }else{
        return 0;
    }
}
