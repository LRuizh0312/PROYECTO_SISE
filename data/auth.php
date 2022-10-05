<?php
session_start();
require_once('basedatos.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $accion = $_POST['accion'];
    if($accion === 'login'){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $sql = "SELECT id, nombre, username, estado
                FROM `usuarios`
                WHERE username='$usuario' AND password='$password'";
        $user = $db->query($sql);
        if($user){
            $_SESSION['usuarios']= $user;
            $respuesta = [
                "codigo" => 200,
                "data" => $user
            ];
        } else {
            $respuesta = [
                "codigo" => 404,
                "mensaje" => "Usuario y/o password incorrecto"
            ];
        }
        echo json_encode($respuesta);
    }
}
?>