<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
  public static function index(Router $router) {

    $propiedades = Propiedad::all();
    $resultado = null;

    $router->render('propiedades/admin', [
      'propiedades' => $propiedades,
      'resultado'   => $resultado
    ]);
  }

  public static function crear(Router $router) {

    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
  
      $propiedad = new Propiedad($_POST['propiedad']);
      //SUBIDA DE ARCHIVOS//

      // Generar un nombre unico
      $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

    //Setear la imagen
      if($_FILES['propiedad']['tmp_name']['imagen']) {
      $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
      $propiedad->setImagen($nombreImagen);
 }
    


    // Validar
    $errores = $propiedad->validar();
    $CARPETA_IMAGENES = '../../imagenes/';
    if(empty($errores)) {
    // Crear la carpeta para subir imagenes
    if(!is_dir(CARPETA_IMAGENES)) {
      mkdir(CARPETA_IMAGENES);
    };

    // Guardar la imagen
    $image->save($CARPETA_IMAGENES . $nombreImagen);

    // Guarda en la BD
   $resultado = $propiedad->guardar();

    }
  }

  }
  public static function actualizar() {
    echo "actualizar Propiedad";
  }
}