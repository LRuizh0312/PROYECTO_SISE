<?php

include ('data/basedatos.php');

$id =$_GET['id'];
$query = mysqli_query($db,"DELETE FROM  alumnos WHERE (id = '$id') ");

if ($query){
    header('location: index.php');
}


?>