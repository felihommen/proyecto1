<?php
// Muestra el listado de redes
require './basededatos.php';
$bd = new basededatos;
$redes = $bd->getRedes();
?>
<h1>Listado de redes</h1>


<table class="table table-striped">
    <thead>
        <tr>
            <th>IP</th>
            <th>Máscara</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($redes){
            foreach($redes as $row){
                echo '<tr>';
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td></td>";
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>