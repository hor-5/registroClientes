<?php 
$jsonClientes = file_get_contents("clientes.txt");
$aClientes = json_decode($jsonClientes, true);

$pos = isset($_GET["pos"])? $_GET["pos"] : "";


if($_POST){
//definicion de variables
    $nombre = $_POST["txtNombre"];
    $dni = $_POST["txtDni"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];
    

//analizamos cada accion de los botones

    if(isset ($_GET["do"]) && isset($_POST) && $_GET["do"] == "editar"){
        $aClientes[$pos] = array ("dni" => $dni,
                          "nombre" => $nombre,
                          "telefono" => $telefono,
                          "correo" => $correo);
           } else{
               $aClientes[] = array ("dni" => $dni,
                          "nombre" => $nombre,
                          "telefono" => $telefono,
                          "correo" => $correo);
           }
    //convertir el array en json
    $jsonClientes = json_encode($aClientes);
    //guardar archivo
    file_put_contents("clientes.txt", $jsonClientes);
              
}

if(isset ($_GET["do"]) && $_GET["do"] == "eliminar"){
    
    $msg = "El registro fue eliminado con exito.Pulsa en";
    $msg2 ="para ingresar uno nuevo.";
    unset($aClientes[$pos]);
    $jsonClientes = json_encode($aClientes);
    file_put_contents("clientes.txt", $jsonClientes);
}

if(isset ($_GET["do"]) && $_GET["do"] == "new"){
    header("Location: index.php");
}
//inicio y Cierre de sesion.
session_start();
if(!isset ($_SESSION["nombre"])){
  header("Location:login.php");
}

if($_POST){
  if( isset ($_POST["btnCerrar"])){
      session_destroy();
      header("location:login.php");
  }
} 

       
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registroClientes</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="plugins/sweetAlert2/sweetalert2.min.css">
    <link rel="stylesheet" href="plugins/animate.css/animate.css">
    <link rel="stylesheet" href="estilos.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
<div class="row">
    <div class="col-12 text-right">
            
                <li class="nav-item dropdown no-arrow bg-light rounded-pill mt-1 mb-3">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 text-gray-600 small"><?php echo $_SESSION["nombre"]; ?></span>
                    <img class="img-profile rounded-circle" src="https://source.unsplash.com/user/erondu/60x60">
                    </a>                    
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">                    
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar sesión
                    </a>
                    </div>
                </li>
                 
    </div>    
 
    <div class="row ml-2">
        <div class="col-12 text-left " >
            <h1>Registro de clientes</h1>
        </div>   
        <div class="col-sm-6 ">
                 <?php if(isset($msg)) { ?>                  
                         <div class="alert alert-success" role="alert">
                            <?php echo $msg; ?>  <i class="fas fa-user-plus"> </i> <?php echo $msg2; ?>
                        </div>
                  <?php } ?>
        </div>
    
    </div>
</div>
    <div class="row">
        <div class="col-sm-6">
        <div class="card card-body rounded ">
            <form action="" method="post"class="form-group rounded">
                <div class="row">

                </div>
            <div class="row">
                <div class="col-12 pt-2">
                    
                    <label for="txtDni">DNI:</label>
                    <input class="form-control  rounded "  type="text" name="txtDni" id="txtDni" required value="<?php echo isset($aClientes[$pos]["dni"])? $aClientes[$pos]["dni"] : "" ; ?>">

                </div>
            </div>    
            <div class="row">
                <div class="col-12 pt-2">

                    <label for="txtNombre">Nombre y Apellido:</label>
                    <input class="form-control  rounded " type="text" name="txtNombre" id="txtNombre" required value="<?php echo isset($aClientes[$pos]["nombre"])? $aClientes[$pos]["nombre"] : "" ; ?>">

                </div>
            </div>    
            <div class="row">
                <div class="col-12 pt-2">

                    <label for="txtTelefono">Teléfono:</label>
                    <input class="form-control  rounded " type="text" name="txtTelefono" id="txtTelefono" required value="<?php echo isset($aClientes[$pos]["telefono"])? $aClientes[$pos]["telefono"] : "" ;  ?>">

                </div>
            </div>    
            <div class="row">
                <div class="col-12 pt-2">

                    <label for="txtCorreo">Correo:</label>
                    <input class="form-control rounded " type="text" name="txtCorreo" id="txtCorreo" required value="<?php echo isset($aClientes[$pos]["correo"])? $aClientes[$pos]["correo"] : "" ; ?>">

                </div>
            </div>    

            <div class="row pt-3">
                <div class="mr-3">
                    <button class="btn btn-success btn-sm  rounded-pill" name="btnAgregar" id="btnAgregar"><span><i class="fas fa-folder-plus"></i></span> Confirmar</button>
                </div>
                <div>
                    <a href="?pos=<?php echo $pos;?>& do=new" class="btn btn-warning btn-sm rounded-pill" name="btnLimpiar" id="btnLimpiar" type="reset"><span><i class="fas fa-redo-alt"></i></span>Limpiar</a>
                </div>
            </div>   
        
            </form> 
        </div>       
 
        </div>    
        <div class="col-sm-6">
            <table class="table table-hover table-borderless text-center">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th style="width:150px;">  <a class="btn btn-primary btn-sm rounded-circle" href="?pos=<?php echo $pos;?>& do=new"><i class="fas fa-user-plus"></i></a>       </th>
                    
                </tr>
                <?php 
                $pos = 0;
                foreach($aClientes as $pos => $cliente) { ?>
                <tr> 
                    <td><?php echo $cliente["dni"]; ?></td>
                    <td><?php echo $cliente["nombre"]; ?></td>
                    <td><?php echo $cliente["correo"]; ?></td>
                    <td>


                        <a class="btn btn-secondary rounded-circle btn-sm  d-inline" id="btnEditar" href="?pos=<?php echo $pos;?>& do=editar"><i class="fas fa-edit" ></i></a>
                        <a class="btn btn-danger rounded-circle btn-sm d-inline " id="btnEliminar" href="?pos=<?php echo $pos;?>& do=eliminar"><i class="fas fa-trash-alt" ></i></a>                   


                    </td>
                    
                </tr>
                <?php $pos++; } ?>  
            </table>
        </div>  
</div>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Está seguro que quiere salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Presiona el boton para cerrar sesión.</div>
          <div class="modal-footer">
          <form action="" method="POST" class="text-right"> 
              
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <button class="btn btn-primary" name="btnCerrar" action="login.php" type="submit">Cerrar sesion</button>
         </form> 
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="plugins/sweetAlert2/sweetalert2.all.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>