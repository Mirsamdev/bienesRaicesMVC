<?php

namespace Controllers;

use Model\Blog;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
class PaginasController {
  public static function blog( Router $router ) {

    //$router->render('paginas/blog');
    
    $blogs = Blog::all();
    
    
    
    $router->render('paginas/blog', [
    
    'blogs' => $blogs
    
    ]);
    
    }
    
    
    
    public static function entrada( Router $router ) {
    
    //$router->render('paginas/entrada');
    
    $id = validarORedireccionar('/blog');
    
    
    
    // Obtener los datos de la propiedad
    
    $blog = Blog::find($id);
    
    
    
    $router->render('paginas/entrada', [
    
    'blog' => $blog
    
    ]);
    
    }
    
    
  
  public static function index( Router $router ) {

    $propiedades = Propiedad::get(3);
    $inicio = true;

    $router->render('paginas/index', [
        'propiedades' => $propiedades,
        'inicio' => $inicio
    ]);
  }

  public static function nosotros( Router $router ) {
    
    $router->render('paginas/nosotros');
  }

  public static function propiedades( Router $router ) {

    $propiedades = Propiedad::all();

    $router->render('paginas/propiedades', [
      'propiedades' => $propiedades
    ]);
  }

  public static function propiedad( Router $router ) {

    $id = validarORedireccionar('/propiedades');

    // buscar la propiedad por su id 
    $propiedad = Propiedad::find($id);

      $router->render('paginas/propiedad', [ 
        'propiedad' => $propiedad
      ]);
  }


}