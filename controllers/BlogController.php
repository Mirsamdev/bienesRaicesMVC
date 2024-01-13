<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {
     public static function index(Router $router) {

    $blogs = Blog::all();
    
    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;
    
    $router->render('blogs/index', [
    'blogs' => $blogs,
    'resultado' => $resultado
    ]);
    }

    public static function crear(Router $router) {



      $errores = Blog::getErrores();
      
      $blog = new Blog;
      
      
      
      
      
      // Ejecutar el código después de que el usuario envia el formulario
      
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
      
      
      /** Crea una nueva instancia */
      
      $blog = new Blog($_POST['blog']);
      
      
      
      // Generar un nombre único
      
      $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
      
      
      
      // Setear la imagen
      
      // Realiza un resize a la imagen con intervention
      
      if($_FILES['blog']['tmp_name']['imagen']) {
      
      $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
      
      $blog->setImagen($nombreImagen);
      
      }
      
      
      
      // Validar
      
      $errores = $blog->validar();
      
      if(empty($errores)) {
      
      
      
      // Crear la carpeta para subir imagenes
      
      if(!is_dir(CARPETA_IMAGENES)) {
      
      mkdir(CARPETA_IMAGENES);
      
      }
      
      
      
      // Guarda la imagen en el servidor
      
      $image->save(CARPETA_IMAGENES . $nombreImagen);
      
      
      
      // Guarda en la base de datos
      
      $resultado = $blog->guardar();
      
      
      
      if($resultado) {
      
      header('location: /admin?resultado=1');
      
      }
      
      }
      
      }
      
      
      
      $router->render('blogs/crear', [
      
      'errores' => $errores,
      
      'blog' => $blog
      
      ]);
      
      }
      
      
      
      public static function actualizar(Router $router) {
      
      
      
      $id = validarORedireccionar('/blogs');
      
      
      
      // Obtener los datos de la blog
      
      $blog = Blog::find($id);
      
      
      
      // Arreglo con mensajes de errores
      
      $errores = Blog::getErrores();
      
      
      
      
      
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
      
      
      // Asignar los atributos
      
      $args = $_POST['blog'];
      
      
      
      $blog->sincronizar($args);
      
      
      
      // Validación
      
      $errores = $blog->validar();
      
      
      
      // Subida de archivos
      
      // Generar un nombre único
      
      $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
      
      
      
      if($_FILES['blog']['tmp_name']['imagen']) {
      
      $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
      
      $blog->setImagen($nombreImagen);
      
      }
      
      
      
      
      
      if(empty($errores)) {
      
      // Almacenar la imagen
      
      if($_FILES['blog']['tmp_name']['imagen']) {
      
      $image->save(CARPETA_IMAGENES . $nombreImagen);
      
      }
      
      
      
      // Guarda en la base de datos
      
      $resultado = $blog->guardar();
      
      
      
      if($resultado) {
      
      header('location: /admin?resultado=2');
      
      }
      
      }
      
      
      
      }
      
      
      
      $router->render('blogs/actualizar', [
      
      'blog' => $blog,
      
      'errores' => $errores
      
      ]);
      
      }
      
      
      
      public static function eliminar() {
      
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
      
      
      // Leer el id
      
      $id = $_POST['id'];
      
      $id = filter_var($id, FILTER_VALIDATE_INT);
      
      
      
      if($id){
      
      $tipo = $_POST['tipo'];
      
      if(validarTipoContenido($tipo) ) {
      
      // encontrar y eliminar la blog
      
      $blog=Blog::find($id);
      
      
      
      //$blog->eliminar();
      
      $resultado = $blog->eliminar();
      
      
      
      // Redireccionar
      
      if($resultado) {
      
      header('location: /admin?resultado=3');
      
      }
      
      
      
      }
      
      
      
      }
      
      }
      
      }
      
      
      
      }
      
      
