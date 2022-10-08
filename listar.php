 <?php
require_once('data/basedatos.php');
$listado_tipos =[];
$listado_sedes = [];
$cantidad_alumnos = 0;
$sedes= null;
$tipo =0;



$sql="SELECT * FROM sedes";
$resultado=$db->query($sql);
$numero_filas = $resultado->num_rows;
for($idx=0;$idx<$numero_filas;$idx++)   {
    $row = $resultado->fetch_assoc();
    $listado_tipos[]=$row;
}  

if($_SERVER['REQUEST_METHOD'] ==='POST')    {
    $tipo = $_POST['cboTipo'];
    $sql = "SELECT * FROM sedes WHERE id = $tipo";
    $resultado = $db->query($sql);
    if($resultado->num_rows > 0){
        $sedes = $resultado->fetch_object();
    }

$sql = "SELECT A.id,razon_social, B.nombre AS sedes, 
C.nombre AS tipo_documento, A.numero_documento
FROM alumnos A INNER JOIN sedes B
ON A.id_sedes = B.id INNER JOIN tipo_documento C 
ON A.id_tipo_documento = C.id
WHERE A.id_sedes = $tipo;";

$resultado = $db->query($sql);
 if($resultado->num_rows > 0){
        $cantidad_alumnos = $resultado->num_rows;
        while($row = $resultado->fetch_assoc()):
            $listado_sedes[] = $row;
        endwhile;
    }
}
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
    <h1>Listar por Sedes </h1>
    <hr></hr>
    <form method="POST">
     <div class ="mb-3">    
    <label for="cboTipo" class="form-label">Elegir Sede</label>
    <select name="cboTipo" id="cboTipo" class="form-control">
        <option value="0">Selecione</option>
        <?php
        if(count($listado_tipos)>0){
            foreach($listado_tipos as $tipo):
        ?>
        <option value="<?php echo $tipo["id"]?>" ><?php echo $tipo["nombre"] ?></option>
        <?php  
        endforeach;
    }
    ?>   
    </select>
</div>
<input type="submit" value="Consultar" class="btn btn-primary">
<a href="index.php" class="btn btn-danger">Regresar</a>
</form>
<?php
if(isset($sedes)):
    ?>
        <h3>Resultados de la consulta para el tipo: <?php echo $sedes->nombre; ?></h3>

<table class="table">
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Sedes</th>
        <th>Tipo Doc.</th>
        <th>N° Documento</th>
        </tr>
    </thead>
    <tbody >
        <?php
        foreach ($listado_sedes as $alumnos):
        ?>
                        <tr>
                            <td><?php echo $alumnos['razon_social']?></td>
                            <td><?php echo $alumnos['sedes']?></td>
                            <td><?php echo $alumnos['tipo_documento']?></td>
                            <td><?php echo $alumnos['numero_documento']?></td>
                            <td><a href="#" class="btn btn-primary">Ver detalles</a></td>            
                        </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                        <tfoot>
                    <tr>
                        <th colspan="5">Cantidad de registros: <?php echo $cantidad_alumnos ?></th>
                    </tr>
                </tfoot>    
                </table>
                <?php
                endif;
                ?>

                </div>
            </body>
        </html> 
