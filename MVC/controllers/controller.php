<?php
class MvcController{
#llamada a la plantilla


    public function plantilla(){

        include "views/template.php";
    }

public function navegacion(){

if(isset($_GET["action"])){
        $enlaces = $_GET["action"];
    }
    else{
        $enlaces = "navi";
    }
    $respuesta = EnlacesPaginas::navs($enlaces);

    include $respuesta;
    }
   
    #interaccion usuario variable get
#enlace a las paginas
public function enlacesPagina(){


    if(isset($_GET["action"])){
        $enlaces = $_GET["action"];
    }
    else{
        $enlaces = "index";
    }
    $respuesta = EnlacesPaginas::enlacesPaginasModel($enlaces);

    include $respuesta;
}
#enlace a las paginas
public function enlaceFooter(){


    if(isset($_GET["action"])){
        $enlaces = $_GET["action"];
    }
    else{
        $enlaces="foot";
    }
    $respuesta = EnlacesPaginas::foot($enlaces);

    include $respuesta;
}
#registro usuarios
#--------------------------------------------------------------
public function registroUsuarioController(){


if(isset($_POST["usuarioRegistro"])){

if (preg_match('/^[a-zA-Z0-9]+$/',$_POST["usuarioRegistro"]) &&
preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/',$_POST["password"]) &&
preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/',$_POST["email"])
) {
    


    $datosController = array("usuario"=>$_POST["usuarioRegistro"],
                              "password"=>$_POST["password"],
                              "email"=>$_POST["email"],
                              "tipo"=>$_POST["tipo"]
                            );
  
$respuesta = Datos::registroUserModel($datosController,"usuarios");
if( $respuesta=="success"){

    header("location:index.php?action=ok");
}

else{
header("location:index.php");

}}
}

}
#validacion usuarios
#--------------------------------------------------------------
public function ingresoUsuarioController(){
if(isset($_POST["usuarioIngreso"])){

    $datosController = array("usuario"=>$_POST["usuarioIngreso"],
                              "password"=>$_POST["password"]
                            );
  
$respuesta = Datos::ingresoUserModel($datosController,"usuarios");

if($respuesta["usuarios"]== $_POST["usuarioIngreso"] && $respuesta["password"]==$_POST["password"]){
if ($respuesta["id_tipo"]=="1" ) {
  session_start();
$_SESSION["admi"] = true;
$_SESSION["validar"] = $respuesta["id_user"];
$_SESSION["money"] = $respuesta["money"];
$_SESSION["tipo"] = $respuesta["id_tipo"];
    header("location:index.php?action=usuarios");
}
    elseif($respuesta["id_tipo"]=="2"){
        session_start();
$_SESSION["validar"] = $respuesta["id_user"];
$_SESSION["buyer"] = true;
$_SESSION["money"] = $respuesta["money"];
$_SESSION["tipo"] = $respuesta["id_tipo"];
    header('location:index.php?action=home2&id='.$respuesta["id_user"].'');}
    elseif($respuesta["id_tipo"]=="3") {
    session_start();
$_SESSION["validar"] = $respuesta["id_user"];
$_SESSION["seller"] = true;
$_SESSION["money"] = $respuesta["money"];
$_SESSION["tipo"] = $respuesta["id_tipo"];
    header('location:index.php?action=productos3&id='.$respuesta["id_user"].'');
    }

}



else{

    header("location:index.php?action=fallo");
}
}


}
#vista usuarios
public function vistaUsuariosController(){

    $respuesta = Datos:: vistaUserModel("usuarios");

    foreach($respuesta as $row=> $item){
 echo'<tr>
 
<td>'.$item["usuarios"].'</td>
<td>'.$item["password"].'</td>
<td>'.$item["email"].'</td>
<td><a href="index.php?action=editar&id='.$item["id_user"].'"><button>Editar</button></a></td>
<td><a href="index.php?action=usuarios&idBorrar='.$item["id_user"].'"><button>Borrar</button></a></td>
<td><a href="index.php?action=usuarios&idContrato='.$item["id_user"].'"><button>Generar</button></a></td>
</tr>';}
   
}
#editar usuarios
public function editarUsuarioController(){
$datos= $_GET["id"];

    $respuesta = Datos:: editarUserModel($datos,"usuarios");

    
 echo'
<input type = "hidden" value="'.$respuesta["id_user"].'" name="id_user" >
<input type = "text" value="'.$respuesta["usuarios"].'" name="usuario" required>
<input type = "text" value="'.$respuesta["password"].'" name="password" required>
<input type = "email" value="'.$respuesta["email"].'" name="email" required>
<input type = "submit" value="Actualizar">';
   
}
#editar productos
public function editarProductoController(){
$datos= $_GET["id"];

    $respuesta = Datos:: editarProductoModel($datos,"productos");

    
 echo'
<input type = "hidden" value="'.$respuesta["id_producto"].'" name="id_producto" >
<input type = "text" value="'.$respuesta["nombre"].'" name="nombre" required>
<input type = "text" value="'.$respuesta["imagen"].'" name="imagen" required>
<input type = "text" value="'.$respuesta["descripcion"].'" name="descripcion" required>
<input type = "text" value="'.$respuesta["genero"].'" name="genero" required>
<input type = "text" value="'.$respuesta["costo"].'" name="costo" required>
<input type = "text" value="'.$respuesta["stock"].'" name="stock" required>
<input type = "submit" value="Actualizar">';
   
}
#actualizar  producto
public function actualizarProductoController(){

    if (isset($_POST["nombre"])) {
        $datosController = array(
            "id_producto"=>$_POST["id_producto"],
            "nombre"=>$_POST["nombre"],
            "imagen"=>$_POST["imagen"],
            "descripcion"=>$_POST["descripcion"],
            "genero"=>$_POST["genero"],
            "costo"=>$_POST["costo"],
             "stock"=>$_POST["stock"]
        );

 $respuesta = Datos::actualizarProductoModel($datosController,"productos");
if( $respuesta == "success"){

    header("location:index.php?action=productos3");
}

else{
echo "error";

}
    }
}
#actualizar usuario
public function actualizarUsuarioController(){

    if (isset($_POST["usuario"])) {
        $datosController = array(
            "id_user"=>$_POST["id_user"],
            "usuario"=>$_POST["usuario"],
           "password"=>$_POST["password"],
                "email"=>$_POST["email"]
        );

 $respuesta = Datos::actualizarUserModel($datosController,"usuarios");
if( $respuesta == "success"){

    header("location:index.php?action=cambio");
}

else{
echo "error";

}
    }
}
#borrar usuario
public function borrarUsuarioController(){

    if (isset($_GET["idBorrar"])) {
        $datosController = $_GET["idBorrar"];
         $respuesta = Datos::borrarUserModel($datosController,"usuarios");
            
        

 
if( $respuesta == "success"){

    header("location:index.php?action=usuarios");
}

else{
echo "error";

}
    }
}
#borrar productos
public function borrarProductoController(){

    if (isset($_GET["idBorrar"])) {
        $datosController = $_GET["idBorrar"];
         $respuesta = Datos::borrarProductoModel($datosController,"productos");
            
        

 
if( $respuesta == "success"){

    header("location:index.php?action=productos3");
}

else{
echo "error";

}
    }
}

#vista productos
public function proUsuariosController(){

    $respuesta = Datos:: proUserModel("productos");

    foreach($respuesta as $row=> $item){
 echo'<tr>
<td>'.$item["nombre"].'</td>
<td><img src="'. $item["imagen"].'"alt="logotipo2" class="logo2"></td> 
<td>'.$item["descripcion"].'</td>
<td>'.$item["genero"].'</td>
<td>'.$item["costo"].'</td>
<td>'.$item["stock"].'</td>

<td><a href="index.php?action=productos&idBorrar='.$item["id_producto"].'"><button>Borrar</button></a></td>
</tr>';}
   
}
#vista productos
public function prodUsuariosController(){



    $respuesta = Datos:: proUserModel("productos");

    foreach($respuesta as $row=> $item){
 echo'
 
  

    <div class="col-lg-3 col-md-4 col-6" >
      <a href="index.php?action=producto'.$_SESSION["tipo"].'&id='.$item["id_producto"].'" class="d-block mb-2 h-100 ">
 <img    class="img-fluid img-thumbnail"   src="'. $item["imagen"].'" alt="">
        </a>
    </div>
    
 
 ';}
   
}
#vista producto
public function pController(){
$datos= $_GET["id"];
    $respuesta = Datos:: pModel($datos,"productos");
$carrito=0;


    foreach($respuesta as $row=> $item){

 echo'
  <h1 class="font-weight-light text-center text-lg-center mt-4 mb-0">'. $item["nombre"].' </h1>

  <hr class="mt-2 mb-5">

  <div class=" row text-center ">

    <div class=" row col-lg-3 col-md-4 col-6" >
      <a href="#" class="d-block mb-2 h-100 text-lg-left ">
 <img    class="img-fluid img-thumbnail"   src="'. $item["imagen"].'" alt="">
        </a>
        
    </div>
    <div>
    
 <p align="right"> '. $item["descripcion"].'  </p><br/>
<p align="right">Precio  </p><br/>
<p align="right">$ '. $item["costo"].'.00  </p><br/>

<p align="right"> Stock   '. $item["stock"].'  </p><br/>
     </div>
  
   </div>
<div align="center">
 <a href=""><button  type="button" class="btn btn-primary" >Add to cart</button></a>
  <a href="index.php?action=producto'.$_SESSION["tipo"].'&id='.$item["id_producto"].'&costo='.$item["costo"].'&id_buyer='.$_SESSION["validar"].'&money='.$_SESSION["money"].'&stock='.$item["stock"].'"><button  type="button" class="btn btn-primary" >Comprar</button></a>

</div>
 '
 
 
 ;}
   
}
#comprar productos



public function comprarProductoController(){
    
    if ((isset($_GET["id"]))&&(isset($_GET["costo"]))) {
     

        $datos= $_GET["id"];

        $idB= $_GET["id_buyer"];
        $costo=$_GET["costo"];
        $costo= (int)$costo;
        $money=$_GET["money"];
        $money= (int)$money;
if ($money>=$costo) {
   


        $money=$money-$costo;

        $stock=$_GET["stock"]-1;

        
        $respuesta2 = Datos::actMoneyModel($money,$idB); 
        $respuesta1 = Datos::actStockModel($stock,$datos);
        
        $respuesta3 = Datos::comprarProductoModel($datos,$idB); 

 

if(( $respuesta1 == "success")&& ( $respuesta2 == "success")){

    header('location:index.php?action=producto'.$_SESSION["tipo"].'&id='.$datos.'');
echo "Compra exitosa";
}

else{
echo "error";

}
     }
    else{
echo "Dinero insuficiente";

}
    
    
    }
}



#registro productos
public function registroProductController(){
$datos= $_SESSION["validar"]; 

if(isset($_POST["productoRegistro"])){

$image="assets/".$_POST["imagen"];

    $datosController = array("nombre"=>$_POST["productoRegistro"],
                            "imagen"=>$image,
                            "descripcion"=>$_POST["descripcion"],
                            "genero"=>$_POST["genero"],
                            "costo"=>$_POST["costo"],
                            "stock"=>$_POST["stock"],
                             "id_user"=>$datos );
  

$respuesta = Datos::registroProductModel($datosController,"productos");
if( $respuesta=="success"){

    header("location:index.php?action=productos3");
}

else{
header("location:index.php");

}
}

}
#registro quejas
public function quejaController(){
$datos= $_SESSION["validar"]; 
$dato= $_GET["id"];
if((isset($_POST["mensaje"]))  && (isset($_GET["id"]))  ){

    


    $datosController = array("nombre"=>$_POST["nombre"],
                            "email"=>$_POST["email"],
                            "phone"=>$_POST["phone"],
                            "mensaje"=>$_POST["mensaje"],
                             "id_user"=>$datos,
                                  "id_producto"=>$dato 
                                 );
  

$respuesta = Datos::quejaModel($datosController,"comentarios");
if( $respuesta=="success"){

    header('location:index.php?action=producto2&id='.$_GET["id"].'');
}

else{
echo'ERROR';

}
}

}





#vista productos
public function misUsuariosController(){
$datos= $_SESSION["validar"]; 

 $respuesta = Datos:: misUserModel($datos,"productos");

  echo'
  <div class="text-center">
 <a href="index.php?action=registrop&id='.$datos.'"><button  type="button" class="btn btn-primary" >Agregar</button></a>
   </div>';
 foreach($respuesta as $row=> $item){
 echo'

<tr>
<td>'.$item["nombre"].'</td>
<td><img src="'. $item["imagen"].'"alt="logotipo2" class="logo2"></td> 
<td>'.$item["descripcion"].'</td>
<td>'.$item["genero"].'</td>
<td>'.$item["costo"].'</td>
<td>'.$item["stock"].'</td>
<td><a href="index.php?action=editarp&id='.$item["id_producto"].'"><button>Editar</button></a></td>
<td><a href="index.php?action=productos3&idBorrar='.$item["id_producto"].'"><button>Borrar</button></a></td>

</tr>
'
;}  
}

#vista COMPRAS
public function mis2UsuariosController(){
$datos= $_SESSION["validar"]; 

 $respuesta = Datos:: misJUserModel($datos);


 foreach($respuesta as $row=> $item){
 echo'

<tr>
<td>'.$item["nombre"].'</td>
<td><img src="'. $item["imagen"].'"alt="logotipo2" class="logo2"></td> 
<td>'.$item["descripcion"].'</td>
<td>'.$item["genero"].'</td>
<td>'.$item["costo"].'</td>


<td><a href="index.php?action=productos3&idBorrar='.$item["id_producto"].'"><button>Borrar</button></a></td>

</tr>
'
;}  
}

#vista VENTAS
public function mis3UsuariosController(){
$datos= $_SESSION["validar"]; 

 $respuesta = Datos:: misVUserModel($datos);


 foreach($respuesta as $row=> $item){
 echo'

<tr>
<td>'.$item["nombre"].'</td>
<td><img src="'. $item["imagen"].'"alt="logotipo2" class="logo2"></td> 
<td>'.$item["descripcion"].'</td>
<td>'.$item["genero"].'</td>
<td>'.$item["costo"].'</td>


<td><a href="index.php?action=productos3&idBorrar='.$item["id_producto"].'"><button>Borrar</button></a></td>

</tr>
'
;}  
}

#vista quejas
public function comentController(){

    $respuesta = Datos:: comentUserModel("comentarios");

    foreach($respuesta as $row=> $item){
 echo'<tr>
<td>'.$item["nombre"].'</td>

<td>'.$item["email"].'</td>
<td>'.$item["phone"].'</td>
<td>'.$item["mensaje"].'</td>
<td>'.$item["id_producto"].'</td>

<td><a href="index.php?action=quejas&idBorrar='.$item["id_comentario"].'"><button>Borrar</button></a></td>
</tr>';}
   
}
#borrar quejas
public function borrarQuejaController(){

    if (isset($_GET["idBorrar"])) {
        $datosController = $_GET["idBorrar"];
         $respuesta = Datos::borrarQuejaModel($datosController,"comentarios");
            
        

 
if( $respuesta == "success"){

    header("location:index.php?action=quejas");
}

else{
echo "error";

}
    }
}

}
?>