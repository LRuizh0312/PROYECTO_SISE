<?php
include_once('includes/templates/header.php')
?>
  <?php
require "data/basedatos.php";

$sql = "SELECT A.id,razon_social, B.nombre AS sedes, C.nombre AS tipo_documento, A.numero_documento
FROM alumnos A INNER JOIN sedes B
ON A.id_sedes = B.id INNER JOIN tipo_documento C 
ON A.id_tipo_documento = C.id;";

$resultado = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
<h1>Registro de Matricula </h1>
<hr></hr>
<a href="nuevo_registro.php"class="btn btn-secondary">Nuevo</a>
<table class="table">
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Sedes</th>
        <th>Tipo Doc.</th>
        <th>Nº Documento</th>
        </tr>
    </thead>
    <tbody id="tblData">
        <?php
        while($alumno = $resultado->fetch_assoc()):
        ?>
         <tr>
                            <td><?php echo $alumno['razon_social']?></td>
                            <td><?php echo $alumno['sedes']?></td>
                            <td><?php echo $alumno['tipo_documento']?></td>
                            <td><?php echo $alumno['numero_documento']?></td>
                            
                            <td>
                            <a href="editar_alumno.php?id=<?php echo $alumno['id'];?>" class="btn btn-primary">Editar</a>
                            <th><a href="eliminar.php?id=<?php echo $alumno['id']; ?>" class="btn btn-danger">Eliminar</a></th>
                            </td>
                        </tr>
                        <?php
                        endwhile;
                        ?>
                        </tbody>    
                </table>
                    </div>
            </boy>
        </html> 
<?php
include_once('includes/templates/footer.php')
?>