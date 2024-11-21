<?php include "Views/Templates/header.php"; ?>

<div class="container">
    <!-- Prestaciones  -->
    <div class="mt-4 d-flex align-items-center">
        <div class="flex-fill">
            <h1 class="m-0 text">Regla aplicada a las prestaciones de ley (Mensual)</h1>
        </div>
        <div class="flex-fill text-end">
            <div class="btn-group">
                <button type="button" class="btn btn-success" onclick="frmPrestaciones()">
                    Agregar nueva regla
                </button>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-responsive table-bordered table-hover display nowrap" style="width:100%" id="tblPrestaciones">
            <thead class="table-dark">
                <tr>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>% Patronal</th>
                    <th>% Laboral</th>   
                    <th>Techo</th>     
                </tr>
            </thead>
            <tbody id="tabla" class="table table-striped">
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="prestacionesModal" tabindex="-1" aria-labelledby="prestacionesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmPrestaciones" onsubmit="agregarPrestacion(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="prestacionesModalLabel">Agregar regla</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <input type="hidden" id="id" name="id" class="form-control form-control-lg" />
                                <label for="tipo" class="form-label">Tipo de impuesto</label>
                                <select id="tipo" name="tipo" class="form-select" required>
                                    <option value="seguro medico">Seguro médico</option>
                                    <option value="pensiones">Pensiones</option>
                                    <option value="otros">Otros</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" maxlength="100" class="form-control" id="nombre" name="nombre" placeholder="Nombre del impuesto" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="desde" class="form-label">Aplicado desde</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="desde" name="desde" placeholder="Aplicado a salarios..." required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="hasta" class="form-label">Aplicado hasta</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="hasta" name="hasta" placeholder="Aplicado a salarios...">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="patronal" class="form-label">Porcentaje Patronal</label>
                                <input type="number" min="0" max="100" step="0.01" class="form-control" id="patronal" name="patronal" placeholder="Porcentaje">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="laboral" class="form-label">Porcentaje Laboral</label>
                                <input type="number" min="0" max="100" step="0.01" class="form-control" id="laboral" name="laboral" placeholder="Porcentaje">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="techo" class="form-label">Techo máximo salarial</label>
                                <input type="number" min="0" class="form-control" id="techo" name="techo" placeholder="Aplicado a salarios a partir de">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>