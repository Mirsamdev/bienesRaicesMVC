<?php

namespace App;

class Vendedor extends ActiveRecord {

  protected static $tabla = 'vendedores';
  protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email'];

  public $id;
  public $nombre;
  public $apellido;
  public $telefono;
  public $email;

  public function __construct($args = []) {

    // Asignamos a titulo un arreglo titulo y en caso que no este titulo va ser string vacío
     $this->id = $args['id'] ?? '';
     $this->nombre = $args['nombre'] ?? '';
     $this->apellido = $args['apellido'] ?? '';
     $this->telefono = $args['telefono'] ?? '';
     $this->email = $args['email'] ?? '';
    }

    public function validar() {
        
    if(!$this->nombre) {
      self::$errores[] = "El nombre es obligatorio";
    }
    if(!$this->apellido) {
      self::$errores[] = "El apellido es obligatorio";
    }
    if(!$this->telefono) {
      self::$errores[] = "El Telefono es obligatorio";
    }
    if(!$this->email) {
      self::$errores[] = "El E-Mail es obligatorio";
    }

    if(!preg_match('/[0-9]{10}/', $this->telefono)) {
      self::$errores[] = "Formato no Valido";
    }

    return self::$errores;
  }
}