<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
  public static function index(Router $router) {
    $propiedades = Propiedad::all();

    $vendedores = Vendedor::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    $router->render('propiedades/admin', [
      'propiedades' => $propiedades,
      'resultado'   => $resultado,
      'vendedores' => $vendedores
    ]);
  }

  public static function crear(Router $router)
  {

    $propiedad = new Propiedad;
    
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $propiedad = new Propiedad($_POST['propiedad']);
      //SUBIDA DE ARCHIVOS//

      // Generar un nombre unico
      $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

      //Setear la imagen
      if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
      }



      // Validar
      $errores = $propiedad->validar();
      $CARPETA_IMAGENES = '../../imagenes/';
      if (empty($errores)) {
        // Dar permisos a la carpeta
        chmod(CARPETA_IMAGENES, 0777);
        
        // Crear la carpeta para subir imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
          mkdir(CARPETA_IMAGENES);
        };


        // Guardar la imagen
        $image->save($CARPETA_IMAGENES . $nombreImagen);
        
        // Guarda en la BD
        $propiedad->guardar();
      }
    }

    $router->render('propiedades/crear', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
      'errores' => $errores
    ]);
  }
  
  public static function actualizar(Router $router) {

    $id = validarORedireccionar('/admin');
    $propiedad = Propiedad::find($id);

    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Asignar los atributos
      $args = $_POST['propiedad'];
    
      $propiedad->sincronizar($args);
    
      // Validacion
      $errores = $propiedad->validar();
    
      // Subida de archivos
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
         
         if($_FILES['propiedad']['tmp_name']['imagen']) {
          $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
          $propiedad->setImagen($nombreImagen);
        }
    
      // Revisar que el array de errores este vacio
      if(empty($errores)) {
        if($_FILES['propiedad']['tmp_name']['imagen']) {
       // Almacenar imagen
       $image->save(CARPETA_IMAGENES . $nombreImagen);
      }
       $propiedad->guardar();
       }
      }

    $router->render('/propiedades/actualizar', [
      'propiedad' => $propiedad,
      'errores' => $errores,
      'vendedores' => $vendedores
    ]);
  }

  public static function eliminar()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);
 
      if ($id) {
        $tipo = $_POST['tipo'];
        if (validarTipoContenido($tipo)) {
          $propiedad = Propiedad::find($id);
          $resultado = $propiedad->eliminar();
          if ($resultado) {
            header('Location: /admin?resultado=3');
          }
        }
      }
    }
  }
}


