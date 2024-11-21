<?php include "Views/Templates/header.php"; ?>

<!-- Renta  -->
<div class="container">
    <div class="mt-4 d-flex align-items-center">
        <div class="flex-fill">
            <h1 class="m-0 text">Reglas aplicadas a la Renta (Mensual)</h1>
        </div>
        <div class="flex-fill text-end">
            <div class="btn-group">
                <button type="button" class="btn btn-success" onclick="frmRenta()">
                    Agregar nueva regla
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-responsive table-bordered table-hover display nowrap" style="width:100%" id="tblRenta">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>% Aplicar</th>
                    <th>Sobre el exceso de</th>
                    <th>Más cuota fija</th>          
                </tr>
            </thead>
            <tbody id="tabla" class="table table-striped">
                
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rentaModal" tabindex="-1" aria-labelledby="rentaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmRenta" onsubmit="agregarRenta(event)">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5" id="rentaModalLabel">Agregar regla</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <input type="hidden" id="id" name="id" class="form-control form-control-lg" />
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" maxlength="50" class="form-control" id="nombre" name="nombre" placeholder="Nombre del impuesto" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="desde" class="form-label">Desde: </label>
                                <input type="number" min="0.00" step="0.01" class="form-control" id="desde" name="desde" placeholder="Aplicado a salarios" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="hasta" class="form-label">Hasta: </label>
                                <input type="number" min="0"  step="0.01" class="form-control" id="hasta" name="hasta" placeholder="Aplicado a salarios">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="aplicar" class="form-label">Porcentaje aplicado al</label>
                                <input type="number" min="0" max="100" step="0.01" class="form-control" id="aplicar" name="aplicar" placeholder="Porcentaje">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="sobre_exceso" class="form-label">Sobre exceso de</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="sobre_exceso" name="sobre_exceso" placeholder="Sobre exceso">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="cuota_fija" class="form-label">Cuota fíja</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="cuota_fija" name="cuota_fija" placeholder="Cuota fíja">
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