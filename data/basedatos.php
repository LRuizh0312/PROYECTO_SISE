<?php
$db = new mysqli('localhost', 'Matriculas', '123456', 'datos_ep');
if(!$db){
    echo 'Error al conectar la base de datos';
    exit;
}