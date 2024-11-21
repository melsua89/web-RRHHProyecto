<?php include "Views/Templates/header.php"; ?>

<!-- Renta  -->
<div class="container">
    <div class="row mt-4">
        <div class="col-10 mb-3">
            <div class="">
                <h1 class="m-0 text">Planilla de Pago Salariales LACTEOS EL SUR </h1>
            </div>
        </div>
        <div class="col-2 mb-3">
            <div class="btn-group" style="width: 100%">
                <button type="button" class="btn btn-success" onclick="btnPlanillaSalarial()">
                    Generar planilla
                </button>
            </div>
        </div>
        <div class="col-6 mb-3">
            <form id="frmBuscarPlanilla" onsubmit="btnbuscarPlanillaSalarial(event)" style="width: 100%">
                <div class="input-group mb-3">
                    <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
                    <select class="buscarsalarialanio form-select" id="selectplanillaanio" required>
                    </select>
                    <select class="buscarsalarialmes form-select" id="selectplanillames" required>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <table class="table table-responsive table-bordered table-hover nowrap" id="tblSalarios" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th>N°</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Empleado</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <th>Hora extras (+)</th>
                    <th>Remuneraciones (+)</th>
                    <th>Descuentos (-)</th>
                    <th>(=) Salario Bruto</th>
                    <th>Prest. de Ley (-)</th>
                    <th>(=) Salario Neto</th>
                    <th>Boleta de Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['planilla'] as $empleados) :?>
                    <tr>
                        <td class="text-center" ><?php echo $empleados['n'] ?></td>
                        <td class="text-center" ><?php echo $empleados['anio'] ?></td>
                        <td class="text-center" ><?php echo $empleados['mes'] ?></td>
                        <td class="text-center" ><?php echo $empleados['nombrecompleto'] ?></td>
                        <td class="text-center" ><?php echo $empleados['cargo'] ?></td>
                        <td class="text-center" ><?php echo $empleados['salario_planilla'] ?></td>
                        <td class="text-center" ><?php echo $empleados['horas_extras'] ?></td>
                        <td class="text-center" ><?php echo $empleados['remuneraciones'] ?></td>
                        <td class="text-center" ><?php echo $empleados['descuentos'] ?></td>
                        <td class="text-center" ><?php echo $empleados['salario_bruto'] ?></td>
                        <td class="text-center" ><?php echo $empleados['p_de_ley'] ?></td>
                        <td class="text-center" ><?php echo $empleados['salario_neto'] ?></td>
                        <td class="text-center" ><?php echo $empleados['reporte'] ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="planillaSalarialModal" tabindex="-1" aria-labelledby="planillaSalarialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmPlanillaSalarial" onsubmit="generarPlanillaSalarial(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="planillaSalarialModalLabel">Generar nueva planilla</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="anio_planilla_salarios" class="form-label">Año correspondiente</label>
                                <input type="number" min="0" step="1" maxlength="50" class="form-control" id="anio_planilla_salarios" name="anio_planilla_salarios" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="mes_planilla_salarios" class="form-label">Mes correspondiente</label>
                                <select class="selectgenerarPlanillaSalarios" data-placeholder="Seleccionar mes" id = "mes_planilla_salarios" name="mes_planilla_salarios" required >
                                    <option></option>
                                </select >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Generar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Horas extras -->
<div class="modal fade" id="horasExtrasModal" tabindex="-1" aria-labelledby="horasExtrasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmHorasExtras" onsubmit="generarHorasExtras(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="horasExtrasModalLabel">Calculo de Horas extras</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <input type="number" min="0" step="1" id="id_nomina_horas_extras" name="id_nomina_horas_extras" hidden>
                            <label class="form-label mb-0">N° Horas extras realizadas (+)</label>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="num_horas_extras" class="form-label"></label>
                                    <input type="number" min="0" step="1" class="form-control text-center" id="num_horas_extras" name="num_horas_extras" required placeholder="Ingrese el numero">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="total_hora_extras" class="form-label"></label>
                                    <input type="number" min="0" step="1" class="form-control text-center" id="total_hora_extras" name="total_hora_extras" placeholder="Total calculado" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label mb-0">N° Horas extras nocturnas realizadas (+)</label>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="num_horas_nocturnas" class="form-label"></label>
                                    <input type="number" min="0" step="1" class="form-control text-center" id="num_horas_nocturnas" name="num_horas_nocturnas" required placeholder="Ingrese el numero">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="total_hora_nocturnas" class="form-label"></label>
                                    <input type="number" min="0" step="1" class="form-control text-center" id="total_hora_nocturnas" name="total_hora_nocturnas" placeholder="Total calculado" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="mb-3">
                                <label for="horas_salario_base" class="form-label mb-0">Salario Base</label>
                                <input type="number" min="0" step="1" class="form-control text-center" id="horas_salario_base" name="horas_salario_base" disabled>
                            </div>
                         </div>
                         <div class="col-6 mb-4">
                            <div class="mb-3">
                                <label for="horas_salario_bruto" class="form-label mb-0">Salario Bruto (=)</label>
                                <input type="number" min="0" step="1" class="form-control text-center" id="horas_salario_bruto" name="horas_salario_bruto" placeholder="Total calculado" disabled>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnModificarHoras" type="button" class="btn btn-secondary">Modificar</button>
                    <button id="btnGuardarHorasExtras" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Remuneraciones -->
<div class="modal fade" id="remuneracionesModal" tabindex="-1" aria-labelledby="remuneracionesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmRemuneraciones" onsubmit="generarRemuneraciones(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="remuneracionesModalLabel">Remuneraciones Salariales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <input type="number" min="0" step="1" id="id_remuneraciones" name="id_remuneraciones" hidden>
                                <label for="feriado" class="form-label">Feriado (+)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="feriado" name="feriado" placeholder="Ingrese el total calculado" required>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="reintegro" class="form-label">Reintegro (+)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="reintegro" name="reintegro" placeholder="Ingrese el total calculado" required>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="domingo" class="form-label">Domingo (+)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="domingo" name="domingo" placeholder="Ingrese el total calculado" required>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="vacaciones" class="form-label">Vacaciones (+)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="vacaciones" name="vacaciones" required placeholder="Ingrese el total calculado">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnModificarRemuneraciones" type="button" class="btn btn-secondary">Modificar</button>
                    <button id="btnGuardarRemuneraciones" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Descuentos -->
<div class="modal fade" id="descuentosSalarialesModal" tabindex="-1" aria-labelledby="descuentosSalarialesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmDescuentosSalarial" onsubmit="generarDescuentosSalariales(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="descuentosSalarialesModalLabel">Descuentos Salariales</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <input type="number" min="0" step="1" id="id_descuentos" name="id_descuentos" hidden>
                                <label for="incapacidades" class="form-label">Incapacidades (-)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="incapacidades" name="incapacidades" placeholder="Ingrese el total calculado" required>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="permisos" class="form-label">Permisos (-)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="permisos" name="permisos" placeholder="Ingrese el total calculado" required>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="llegadas_tardias" class="form-label">Llegadas Tardías (-)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="llegadas_tardias" name="llegadas_tardias" placeholder="Ingrese el total calculado" required>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                           <div class="mb-3">
                           
                               <label for="dias_descontados" class="form-label">Días descontados (-)</label>
                               <input type="number" min="0" step="0.01" class="form-control text-center" id="dias_descontados" name="dias_descontados" placeholder="Ingrese el total calculado" required>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnModificarDescuentos" type="button" class="btn btn-secondary">Modificar</button>
                    <button id="btnGuardarDescuentos" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Prestaciones de Ley -->
<div class="modal fade" id="prestacionesLeyModal" tabindex="-1" aria-labelledby="prestacionesLeyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmPretacionesLey" onsubmit="generarPrestacionesLey(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="prestacionesLeyModalLabel">Prestaciones de Ley</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                           <div class="mb-3">
                           <input type="number" min="0" step="1" id="id_prestaciones_ley" name="id_prestaciones_ley" hidden>
                               <label for="prestaciones_salario_bruto" class="form-label">Salario Bruto</label>
                               <input type="number" min="0" step="0.01" class="form-control text-center" id="prestaciones_salario_bruto" name="prestaciones_salario_bruto" placeholder="Total calculado" disabled>
                           </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="afps" class="form-label">Cobro de AFP Laboral (-)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="afps" name="afps" placeholder="Total calculado" disabled>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="isss" class="form-label">Cobro del Seguro Laboral (-)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="isss" name="isss" placeholder="Total calculado" disabled>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="mb-3">
                                <label for="renta" class="form-label">Cobro de la Renta (-)</label>
                                <input type="number" min="0" step="0.01" class="form-control text-center" id="renta" name="renta" placeholder="Total calculado" disabled>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                           <div class="mb-3">
                               <label for="prestaciones_salario_neto" class="form-label">Salario Neto</label>
                               <input type="number" min="0" step="0.01" class="form-control text-center" id="prestaciones_salario_neto" name="prestaciones_salario_neto" placeholder="Total calculado" disabled>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>