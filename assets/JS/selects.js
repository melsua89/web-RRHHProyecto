
var meses = [
    { id: 1, text: 'Enero' },
    { id: 2, text: 'Febrero' },
    { id: 3, text: 'Marzo' },
    { id: 4, text: 'Abril' },
    { id: 5, text: 'Mayo' },
    { id: 6, text: 'Junio' },
    { id: 7, text: 'Julio' },
    { id: 8, text: 'Agosto' },
    { id: 9, text: 'Septiembre' },
    { id: 10, text: 'Octubre' },
    { id: 11, text: 'Noviembre' },
    { id: 12, text: 'Diciembre' },
];

document.addEventListener("DOMContentLoaded", function(){
    $('.planillaaguinaldo').select2({
        // dropdownParent: $('#frmBuscarAguinaldo'),
        placeholder: "Buscar cambios en la planilla",
        theme: 'bootstrap-5',
        allowClear: true,
        minimumInputLength: 0,
        ajax:{
            url: base_url + 'Aguinaldo/buscarCambios',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    date: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('#selectplanillames').select2({
        // dropdownParent: $('#frmBuscarAguinaldo'),
        placeholder: "Buscar Mes",
        theme: 'bootstrap-5',
        allowClear: true,
        minimumInputLength: 0,
    });
    $('.buscarsalarialanio').select2({
        // dropdownParent: $('#frmBuscarAguinaldo'),
        placeholder: "Buscar Año",
        theme: 'bootstrap-5',
        allowClear: true,
        minimumInputLength: 0,
        ajax:{
            url: base_url + 'Planilla_Salarial/buscar_anio',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    anio: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.selectgenerarPlanillaSalarios').select2({
        dropdownParent: $('#planillaSalarialModal'),
        theme: 'bootstrap-5',
        allowClear: true,
        minimumInputLength: 0,
        data : meses,
    });
});

$("#selectplanillaanio").on("change", function () {
    let anio = document.getElementById("selectplanillaanio").value;
    if(anio === ''){
        $("#selectplanillames option[value]").remove();
    }else{
        $("#selectplanillames option[value]").remove();
        const url = base_url + "Planilla_Salarial/buscar_mes/" + anio;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $.each(res, function(index, opcion) {
                    $("#selectplanillames").append($('<option>', {
                        value: opcion.id,
                        text: opcion.text
                    }));
                });
            }
        }
    }
});






