<?php
require_once('basedatos.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

}else {
    $accion = $_GET['accion'];
    if ($accion === 'listar'){
        $sql= "SELECT * FROM alumnos";
        $clientes =$db->query($sql);
        if(count($alumnos)> 0 ){
            $respuesta = [
                "codigo" => 200,
                "data" => $alumnos

            ];
        }else{
            $respuesta = [
                "codigo" => 404,
                "mensaje" => "No hay data disponible"
            ];
        }
        echo json_encode($respuesta);
    }
}
?>
