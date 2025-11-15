<?php
if(isset($_POST['idReserva'])){
    
$idLibroEliminar= $_POST['idReserva'];
$archivoJson='../data/reservas.json';
$file = file_get_contents($archivoJson);

$datos = json_decode($file,true);
if(file_exists($archivoJson)){
    if($datos === null){
        echo "<div class='mensaje-reservas'>Error al leer el archivo JSON.</div>";
    }else{
        foreach ($datos as $index => $value) {
            if ($value['id'] == $idLibroEliminar) {
                unset($datos[$index]);
                break;
            }
        }
        $datos = array_values($datos);
        file_put_contents($archivoJson, json_encode($datos, JSON_PRETTY_PRINT));
        echo "Se ha cancelado la reserva con exito";
    }   
}
}
?>