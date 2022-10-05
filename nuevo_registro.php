<?php
require('data/basedatos.php');


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo 'Enviado por el método post';
    $nombres = $_POST ['nombre'];
    $apellidos = $_POST ['apellido'];
    $razon_social = $nombres. ' '.$apellidos;
    $sedes = $_POST ['sedes'];
    $tipo_documento = $_POST ['tipoDocumento'];
    $numero_documento =$_POST['numeroDocumento'];
    $direccion = $_POST ['direccion'];
    $referencia = $_POST ['referencia'];

    $sql = "INSERT INTO `alumnos`( `nombres`, `apellidos`, `razon_social`, 
    `direccion`, `referencia`, `id_sedes`, `id_tipo_documento`,
     `numero_documento`, `estado`) 
    VALUES ('$nombres','$apellidos','$razon_social','$direccion','$referencia',
    '$sedes','$tipo_documento','$numero_documento','1')";

    
$resultado = $db->query($sql);
if($resultado){
    header ('location:index.php');
}
exit;

}


///PARA EL CASO DE SEDE 
$sql = "SELECT * FROM sedes";
$resultado = $db->query($sql);           
$sede = [];                       
while($tipo = $resultado->fetch_assoc()){  
$sede[] = $tipo;                  
}  


////PARA EL CASO DE TIPO_DOCUMENTO 
$sql = "SELECT * FROM tipo_documento";
$resultado = $db->query($sql);    

$tipos_documento = [];                     
while($tipo = $resultado->fetch_assoc()){  
    $tipos_documento[] = $tipo;            
    }                                      




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Matricula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
    crossorigin="anonymous">    
</head>
<body>
    <div class="container">
        <h1>Editar Matricula</h1>
        <form method= "POST">
        <div class="mb-3">
                <label for="nombre" class="form-label">Nombres:</label>
                <input type="text" name= "nombre" id="nombre" class="form-control">     
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label" >Apellidos:</label>
                <input type="text" name="apellido" id="apellido" class="form-control">
            </div>

            <div class="mb-3">
                <label for="sedes"class="form-label">sede:</label>
                <select class="form-control"id="sedes" name="sedes">
                    <option value="0">--SELECIONE--</option>
                    <?php
                    foreach ($sede as $tipo):           
                    ?>
                    
                    <option value="<?php echo $tipo ['id'] ?>">
                    <?php echo $tipo['nombre']?> 
                </option>
                    <?php        
                    endforeach;

                ?>   

            </select>
            </div>

            <div class="mb-3">
                <label for="tipoDocumento"class="form-label-">Tipo Documento:</label>
                <select class="form-control" id="tipoDocumento" name="tipoDocumento">
                    <option value="0">--SELECIONE--</option>
                    <?php
                     foreach ($tipos_documento as $tipo):
                    ?>

                    <option value="<?php echo $tipo ['id'] ?>"> 
                    <?php echo $tipo['nombre']?></option>
                    <?php
                    endforeach;
                    ?>

            </select>
            </div>

            <div class="mb-3">
                <label for="numeroDocumento" class="form-label">Nº Documento:</label>
                <input type="text" name="numeroDocumento" id="numeroDocumento" class="form-control">
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
            </div>

            <div class="mb-3">
                <label for="referencia" class="form-label">Referencia:</label>
                <textarea name="referencia"  id="referencia "  rows="5" 
                class="form-control" ></textarea>
            </div>

            <input type="submit" value="Guardar" class="btn btn-primary">

                </form>
                </div>
</body>
</html>