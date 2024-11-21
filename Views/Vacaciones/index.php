<?php include "Views/Templates/header.php"; ?>
<div class="container">
    
    <div class="mt-4 d-flex align-items-center">
        <div class="flex-fill">
            <h1 class="m-0 text">Planilla de Vacaciones</h1>
        </div>
    </div>
    <div class="container">
        <table class="table table-responsive table-bordered table-hover display nowrap" style="width:100%" id="tblVacaciones">
            <thead class="table-dark">
                <tr>
                    <th>Nombre del empleado</th>
                    <th>DUI</th>
                    <th>Sueldo Base</th>
                    <th>Fecha de ingreso</th>
                    <th>Fecha de inicio vacaciones</th>
                    <th>Fecha de fin vacaciones</th>
                    <th>Días de vacaciones</th>
                    <th>Total a Pagar</th>
                </tr>
            </thead>
            <tbody class="table table-striped">
                
            </tbody>
        </table>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>
