<?php include "Views/Templates/header.php"; ?>

<div class="container">
    <!-- Empleados -->
    <div class="mt-4 d-flex align-items-center">
        <div class="flex-fill">
            <h1 class="m-0 text">Nomina de empleados <span class="fw-bold"><?php echo date('Y-M-d') ?> LACTEOS EL SUR</span></h1>
        </div>
        <div class="flex-fill text-end">
            <div class="btn-group">
                <button type="button" class="btn btn-success" onclick="frmEmpleado()">
                    Ingresar Nuevo Empleado
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-responsive table-bordered table-hover display nowrap" style="width:100%" id="tblEmpleados">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>DUI</th>
                    <th>Sexo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Ingreso</th>
                    <th>Cargo</th>
                    <th>Sueldo</th>
                    <th>Seguro Medico</th>
                    <th>Pension</th>
                    <th>Numero de Afiliado</th>
                    <th>Lista de incrementos realizados</th>
                </tr>
            </thead>
            <tbody id="tabla" class="table table-striped">
                
            </tbody>
        </table>
    </div>
    <!-- End -->
    <!-- Modal -->
    <div class="modal fade" id="empleadosModal" tabindex="-1" aria-labelledby="empleadosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="empleadosModalLabel">Agregar Empleados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="frmEmpleados" onsubmit="agregarEmpleado(event)">
                        <div class="row">
                            <div style="overflow: auto;height: 500px">
                                <div class="row">
                                    <input type="hidden" id="txtid" name="txtid"
                                    class="form-control form-control-lg" />
                                    <!-- nombres -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtprimerNombre" style="width: 100%">Primer Nombre</label>
                                            <input type="text" id="txtprimerNombre" placeholder="Primer Nombre"
                                                name="txtprimerNombre" class="form-control form-control-lg"
                                                style="font-size: 15px;width: 100%; " required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtsegundoNombre" style="width: 100%">Segundo Nombre</label>
                                            <input type="text" id="txtsegundoNombre" placeholder="Segundo Nombre"
                                                name="txtsegundoNombre" class="form-control form-control-lg"
                                                style="font-size: 15px;width: 100%" required />
                                        </div>
                                    </div>
                                    <!-- apellidos -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtprimerApellido" style="width: 100%">Primer Apellido</label>
                                            <input type="text" id="txtprimerApellido" placeholder="Primer Apellido"
                                                name="txtprimerApellido" class="form-control form-control-lg"
                                                style="font-size: 15px;width: 100%" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtsegundoApellido" style="width: 100%">Segundo Apellido</label>
                                            <input type="text" id="txtsegundoApellido" placeholder="Segundo Apellido"
                                                name="txtsegundoApellido" class="form-control form-control-lg"
                                                style="font-size: 15px;width: 100%" required />
                                        </div>
                                    </div>
                                     <!-- Dui -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtDUI" style="width: 100%">DUI</label>
                                            <input type="number" id="txtDUI" placeholder="DUI del Empleado" name="txtDUI"
                                                class="form-control form-control-lg" style="font-size:15px; width: 100%"
                                                required />
                                        </div>
                                    </div>
                                    <!-- Sexo -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="sexo" style="width: 100%">Sexo</label>
                                            <select class="form-select form-control form-control-lg"
                                                style="font-size:15px; width: 100%" id="sexo" name="sexo">
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                                <option value="no_especificar">No especificar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Fecha Nacimiento -->
                                    <div class="col-md-12 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtFechaNacimiento" style="width: 100%">Fecha de Nacimiento</label>
                                            <input type="date" id="txtFechaNacimiento" name="txtFechaNacimiento"
                                                class="form-control form-control-lg" style="font-size:15px; width: 100%"
                                                required />
                                        </div>
                                    </div>
                                    <!-- Fecha de ingreso -->
                                    <div class="col-md-12 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtFechaIngreso" style="width: 100%">Fecha de Ingreso</label>
                                            <input type="date" id="txtFechaIngreso" name="txtFechaIngreso"
                                                class="form-control form-control-lg" style="font-size:15px; width: 100%"
                                                required />
                                        </div>
                                    </div>
                                    <!-- Cargo -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtCargo" style="width: 100%">Cargo</label>
                                            <input type="text" id="txtCargo" placeholder="Cargo en la Empresa" name="txtCargo"
                                                class="form-control form-control-lg" style="font-size:15px; width: 100%"
                                                required />
                                        </div>
                                    </div>
                                    <!-- Sueldo -->
                                    <div id="sueldo_div" class="col-md-6 my-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="txtSueldo">Sueldo</label>
                                            <input type="number" id="txtSueldo" placeholder="Ingresar Sueldo Mensual "
                                                name="txtSueldo" class="form-control form-control-lg"
                                                style="font-size:15px; width: 100%" required />
                                        </div>
                                    </div>
                                    <!-- Seguro medico -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="seguro" style="width: 100%">Seguro</label>
                                            <select class="form-select form-control form-control-lg"
                                                style="font-size:15px; width: 100%" id="seguro" name="seguro">
                                                <option value="ISSS">ISSS</option>
                                                <option value="OTRO">OTRO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Pension -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="pension" style="width: 100%">Pension</label>
                                            <select class="form-select form-control form-control-lg"
                                                style="font-size:15px; width: 100%" id="pension" name="pension">
                                                <option value="Crecer">AFP Crecer</option>
                                                <option value="Confia">AFP Confia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- numero de Afiliado -->
                                    <div class="col-md-6 my-2">
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="txtNumeroAfiliado" style="width: 100%">Numero de Afiliado</label>
                                            <input type="number" id="txtNumeroAfiliado" placeholder="Numero de Pension"
                                                name="txtNumeroAfiliado" class="form-control form-control-lg"
                                                style="font-size:15px; width: 100%" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Formulario Empleados -->

    <!-- Modal Incrementos Salariales-->
    <div class="modal fade" id="incrementoModal" tabindex="-1" aria-labelledby="incrementoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="incrementoModalLabel">Incremento Salarial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="frmIncremento" onsubmit="agregarIncremento(event)">
                        <div class="overflow-auto" style="height: 650px;">
                            <div class="container row">
                                <input type="hidden" id="id_empleado_incremento" name="id_empleado_incremento"
                                class="form-control form-control-lg" />
                                <!-- Empleado -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="nombre_empleado" class="form-label">Nombre del empleado</label>
                                        <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" disabled>
                                    </div>
                                </div>
                                <!-- Documento Único de Identidad -->
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="dui_incremento" class="form-label">Documento Único de Identidad</label>
                                        <input type="number" class="form-control" id="dui_incremento" name="dui_incremento" disabled>
                                    </div>
                                </div>
                                <!-- Cargo -->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="cargo_incremento" class="form-label">Cargo en la empresa</label>
                                        <input type="text" class="form-control" id="cargo_incremento" name="cargo_incremento" disabled>
                                    </div>
                                </div>
                                <!-- Fecha de Ingreso -->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="fecha_ingreso_incremento" class="form-label">Fecha de Ingreso</label>
                                        <input type="date" class="form-control" id="fecha_ingreso_incremento" name="fecha_ingreso_incremento" disabled>
                                    </div>
                                </div>
                                <!-- Salario Actual -->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="sueldo_actual" class="form-label">Salario Actual</label>
                                        <input type="number" min="0" step=".01" class="form-control" id="sueldo_actual" name="sueldo_actual" disabled>
                                    </div>
                                </div>
                            </div>
                            <h5 class="modal-title m-4" id="incrementoModalLabel">Realizar incremento Salarial</h5>
                            <div class="container row">
                                <!-- Incremento -->
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="sueldo_incremento" class="form-label">Incremento en el Salario</label>
                                        <input type="number" min="0" step=".01" class="form-control" id="sueldo_incremento" name="sueldo_incremento" placeholder="Incremento Salarial" required>
                                    </div>
                                </div>
                                <!-- A partir de -->
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="a_partir_de" class="form-label">Realizar incremento a partir de</label>
                                        <input type="date" class="form-control" id="a_partir_de" name="a_partir_de" required>
                                    </div>
                                </div>
                                <!-- Comentarios -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="comentarios_incremento" class="form-label">Comentarios</label>
                                        <textarea class="form-control" name="comentarios_incremento" id="comentarios_incremento" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Realizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include "Views/Templates/footer.php"; ?>