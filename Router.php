<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas() {
    $urlActual = $_SERVER['REQUEST_URL'] ?? '/';
    $metodo = $_SERVER['REQUEST_METHOD'];

    if($metodo === 'GET') {
        $fn = $this->rutasGET[$urlActual] ?? null;
    }

    if($fn) {
      // La url existe y hay una funcion asociada 
      call_user_func($fn, $this);
    } else {
      echo "Pagina no encontrada";
    }
  }
}