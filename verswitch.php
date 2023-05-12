<?php
// Muestra la tabla con información de un switch concreto
include './basededatos.php';
$bd = new basededatos;
$sw = $_GET['sw'];
echo "<h1>$sw</h1>";
echo '<table id="tablasw" class="table table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th>Switch</th>';
echo '<th>Nº puerto</th>';
echo '<th>Descripción</th>';
echo '<th>Acciones</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
if ($res=$bd->getswitch($sw)){
    foreach($res as $row){
        echo '<tr>';
        echo '<td align="left">'.$row[1].'</td>';
        echo '<td align="left">'.$row[2].'</td>';
        echo '<td align="left">'.$row[3].'</td>';
        echo "<td><a data-bs-toggle=modal href=#modalEditPuerto data-sw='$row[1]' data-descripcion='$row[3]' data-puerto='$row[2]' data-cod='$row[0]'><i class=bi-pencil-square></i></a></td>";
        echo '</tr>';
    }
}
echo '</tbody>';
echo '</table>';
?>
<!-- Modal -->
<div class="modal fade" id="modalEditPuerto" tabindex="-1" aria-labelledby="modalEditPuertoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditPuertoLabel">Modificar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="./operaciones.php" id="formModificarPuerto">
                    <input type="hidden" name="cod">
                    <input type="hidden" name="sw">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" maxlenght="100" class="form-control" name="descripcion" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formModificarPuerto" name="modificarpuerto"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>