<?php
#$a = new Conexion();
#$a -> conectar();
require_once "conexion.php";

class Datos extends Conexion{

#registro usuario
    public function registroUserModel($datosModel,$tabla){

        
$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( usuarios, 
password, email,id_tipo) VALUES (:usuario,:password,:email,:id_tipo)");

$stmt->bindParam(":usuario",$datosModel["usuario"], PDO::PARAM_STR);
$stmt->bindParam(":password",$datosModel["password"], PDO::PARAM_STR);
$stmt->bindParam(":email",$datosModel["email"], PDO::PARAM_STR);
$stmt->bindParam(":id_tipo",$datosModel["tipo"], PDO::PARAM_STR);

if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
    }

#registro producto
 public function registroProductModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( nombre, 
imagen, descripcion, genero, costo, stock, id_user) VALUES (:nombre,:imagen,:descripcion,:genero,:costo,:stock,:id_user)");

$stmt->bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
$stmt->bindParam(":imagen",$datosModel["imagen"], PDO::PARAM_STR);
$stmt->bindParam(":descripcion",$datosModel["descripcion"], PDO::PARAM_STR);
$stmt->bindParam(":genero",$datosModel["genero"], PDO::PARAM_STR);
$stmt->bindParam(":costo",$datosModel["costo"], PDO::PARAM_STR);
$stmt->bindParam(":stock",$datosModel["stock"], PDO::PARAM_STR);
$stmt->bindParam(":id_user",$datosModel["id_user"], PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
    }


#ingreso validacion
public function ingresoUserModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("SELECT usuarios, password,id_tipo,id_user,money FROM $tabla WHERE usuarios=:usuario");

$stmt->bindParam(":usuario",$datosModel["usuario"], PDO::PARAM_STR);
#$stmt->bindParam(":password",$datosModel["password"], PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetch();

$stmt->close();

    }
    
    #vista
public function vistaUserModel($tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }

    #editar usuario
public function editarUserModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id_user");
$stmt->bindParam(":id_user",$datosModel, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetch();
$stmt->close();

    }
        #editar producto
public function editarProductoModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto");
$stmt->bindParam(":id_producto",$datosModel, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetch();
$stmt->close();

    }


    #actualizar usuario
    public function actualizarUserModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("UPDATE `usuarios` SET `usuarios`=:usuario,`password`=:password,`email`=:email WHERE id_user=:id_user");

$stmt->bindParam(":usuario",$datosModel["usuario"], PDO::PARAM_STR);
$stmt->bindParam(":password",$datosModel["password"], PDO::PARAM_STR);
$stmt->bindParam(":email",$datosModel["email"], PDO::PARAM_STR);
$stmt->bindParam(":id_user",$datosModel["id_user"], PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();

    }
      #actualizar producto
    public function actualizarProductoModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("UPDATE `productos` SET `nombre`=:nombre,`imagen`=:imagen,`descripcion`=:descripcion,`genero`=:genero,`costo`=:costo,`stock`=:stock WHERE id_producto=:id_producto");

$stmt->bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
$stmt->bindParam(":imagen",$datosModel["imagen"], PDO::PARAM_STR);
$stmt->bindParam(":descripcion",$datosModel["descripcion"], PDO::PARAM_STR);
$stmt->bindParam(":genero",$datosModel["genero"], PDO::PARAM_STR);
$stmt->bindParam(":costo",$datosModel["costo"], PDO::PARAM_STR);
$stmt->bindParam(":stock",$datosModel["stock"], PDO::PARAM_STR);
$stmt->bindParam(":id_producto",$datosModel["id_producto"], PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();

    }
#borrar usuario
public function borrarUserModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("DELETE FROM  $tabla WHERE id_user = :id_user");
$stmt->bindParam(":id_user",$datosModel, PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
}
#borrar producto
public function borrarProductoModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("DELETE FROM  $tabla WHERE id_producto = :id_producto");
$stmt->bindParam(":id_producto",$datosModel, PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
}

#comprar producto
public function actStockModel($stock,$id){


$stmt = Conexion::conectar()->prepare("UPDATE `productos` SET `stock`=:stock WHERE id_producto=:id_producto");


$stmt->bindParam(":stock",$stock, PDO::PARAM_STR);
$stmt->bindParam(":id_producto",$id, PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
}

public function actMoneyModel($money,$id){

    
$stmt = Conexion::conectar()->prepare("UPDATE `usuarios` SET `money`=:mone WHERE id_user=:id_user");


$stmt->bindParam(":mone",$money, PDO::PARAM_INT);
$stmt->bindParam(":id_user",$id, PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
}

public function comprarProductoModel($id_producto,$id_comprador){

    
$stmt = Conexion::conectar()->prepare("INSERT INTO `ventas`( id_producto, id_comprador)
 VALUES (:id_producto,:id_comprador)");
$stmt->bindParam(":id_producto",$id_producto, PDO::PARAM_STR);
$stmt->bindParam(":id_comprador",$id_comprador, PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
}

    #vista productos
public function proUserModel($tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }
 #vista
public function pModel($id,$tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto");
$stmt->bindParam(":id_producto",$id, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }

 #vista mis productos
public function misUserModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id_user");
$stmt->bindParam(":id_user",$datosModel, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }

 #vista mis productos comprados
public function misJUserModel($datosModel){

$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto WHERE id_comprador=:id_comprador ");
$stmt->bindParam(":id_comprador",$datosModel, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }
 #vista mis productos vendidos
public function misVUserModel($datosModel){

$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas INNER JOIN productos ON ventas.id_producto=productos.id_producto WHERE id_user=:id_user ");
$stmt->bindParam(":id_user",$datosModel, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }

#registro comentario
 public function quejaModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( nombre, 
email, phone, mensaje, id_user, id_producto) VALUES (:nombre,:email,:phone,:mensaje,:id_user,:id_producto)");

$stmt->bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
$stmt->bindParam(":email",$datosModel["email"], PDO::PARAM_STR);
$stmt->bindParam(":phone",$datosModel["phone"], PDO::PARAM_STR);
$stmt->bindParam(":mensaje",$datosModel["mensaje"], PDO::PARAM_STR);
$stmt->bindParam(":id_user",$datosModel["id_user"], PDO::PARAM_STR);
$stmt->bindParam(":id_producto",$datosModel["id_producto"], PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
    }


 #vista mis comentarios
public function comentUserModel($tabla){

$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

$stmt->execute();
return $stmt->fetchAll();
$stmt->close();

    }

#borrar queja
public function borrarQuejaModel($datosModel,$tabla){

$stmt = Conexion::conectar()->prepare("DELETE FROM  $tabla WHERE id_comentario = :id_comentario");
$stmt->bindParam(":id_comentario",$datosModel, PDO::PARAM_STR);
if($stmt->execute()){

return "success";

}
else{
    return "errol";
}
$stmt->close();
}
}
?>