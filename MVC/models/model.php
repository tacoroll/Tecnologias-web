<?php
class EnlacesPaginas{

    public function enlacesPaginasModel($enlacesmodel){
        if(
        $enlacesmodel=="editar"||
        $enlacesmodel=="ingresar"||
        $enlacesmodel=="usuarios"||
        $enlacesmodel=="registro" ||
        $enlacesmodel=="home"||
        $enlacesmodel=="usuarios"||
        $enlacesmodel=="productos" ||
         $enlacesmodel=="carrito" ||
         $enlacesmodel=="home2"||
         $enlacesmodel=="productos2"||
         $enlacesmodel=="home3"||
        $enlacesmodel=="productos3" ||
         $enlacesmodel=="ventas"||
       $enlacesmodel=="productop"||
        $enlacesmodel=="registrop"||
       $enlacesmodel=="editarp"||
        $enlacesmodel=="producto1"||
         $enlacesmodel=="producto2"||
          $enlacesmodel=="juegos"||
          $enlacesmodel=="producto3"||
         $enlacesmodel=="juegos"||
         $enlacesmodel=="quejas"||
        $enlacesmodel=="salir"
        
        ){

        $module ="views/modules/".$enlacesmodel.".php";

        }
else if($enlacesmodel == "index"){

    $module="views/modules/registro.php";
}
else if($enlacesmodel == "ok"){

    $module="views/modules/registro.php";
}
else if($enlacesmodel == "fallo"){

    $module="views/modules/ingresar.php";
}
else if($enlacesmodel == "cambio"){

    $module="views/modules/usuarios.php";
}

else {
 $module="views/modules/registro.php";

}
return $module;

    }



    public function navs($enlacesmodel){

 if(
        $enlacesmodel=="usuarios"||
        $enlacesmodel=="home"||
       $enlacesmodel=="producto"||
        $enlacesmodel=="productos" ||
        $enlacesmodel=="cambio" ||
          $enlacesmodel=="producto1"||
          $enlacesmodel=="quejas"||
         $enlacesmodel=="editar" 
    
        
        ){

        $module ="views/modules/navegacion.php";
     }
     elseif (
         
        $enlacesmodel=="home2"||
      $enlacesmodel=="juegos"||
  
        $enlacesmodel=="productos2" ||
          $enlacesmodel=="producto2"||
         $enlacesmodel=="carrito" 
     ) {
       $module ="views/modules/navegacion2.php";
     } elseif (
         
        $enlacesmodel=="home3"||
     $enlacesmodel=="productop"||
     $enlacesmodel=="editarp"||
        $enlacesmodel=="productos3" ||
          $enlacesmodel=="producto3"||
         $enlacesmodel=="registrop"||
         $enlacesmodel=="ventas" 
     ) {
       $module ="views/modules/navegacion3.php";
     }
     




        else {
 $module="views/modules/navi.php";

}

return $module;
}

 public function foot($enlacesmodel){

        
        if (
         
         $enlacesmodel=="producto3"||
         $enlacesmodel=="producto1"||
         $enlacesmodel=="producto2"
     )
      {
       $module ="views/modules/footer.php";
     }
     elseif (
         $enlacesmodel=="editar"||
        $enlacesmodel=="home"||
        $enlacesmodel=="usuarios"||
        $enlacesmodel=="productos" ||
         $enlacesmodel=="home2"||
         $enlacesmodel=="productos2"||
         $enlacesmodel=="home3"||
        $enlacesmodel=="productos3" ||
         $enlacesmodel=="ventas"||
       $enlacesmodel=="productop"||
        $enlacesmodel=="registrop"||
       $enlacesmodel=="editarp"||
       $enlacesmodel=="quejas"||
         $enlacesmodel=="juegos"
       
     ) {
         $module="views/modules/foo.php";
     }


        else {
        $module="views/modules/foot.php";
 
        }

return $module;
}



}




?>