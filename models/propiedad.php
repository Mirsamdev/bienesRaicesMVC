<?php

namespace Model;

class Propiedad extends ActiveRecord {
  
  protected static $tabla = 'propiedades';
  protected static $columnasDB = ['id','titulo','precio','imagen',
  'descripcion','habitaciones','wc','estacionamiento','creado','vendedorId'];

public $id;
public $titulo;
public $precio;
public $imagen;
public $descripcion;
public $habitaciones;
public $wc;
public $estacionamiento;
public $creado;
public $vendedorId;

public function __construct($args = []) 
{
  //Asignamos a titulo un arreglo titulo y en caso que no este titulo va ser string vacío
   $this->id = $args['id'] ?? '';
   $this->titulo = $args['titulo'] ?? '';
   $this->precio = $args['precio'] ?? '';
   $this->imagen = $args['imagen'] ?? '';
   $this->descripcion = $args['descripcion'] ?? '';
   $this->habitaciones = $args['habitaciones'] ?? '';
   $this->wc = $args['wc'] ?? 0;
   $this->estacionamiento = $args['estacionamiento'] ?? '';
   $this->creado = date('Y/m/d');
   $this->vendedorId = $args['vendedorId'] ?? '';
  }

  public function validar() {
  
    if(!$this->titulo) {
      self::$errores[] = "Debes ponerle un titulo a la Propiedad";
    }
    if(!$this->precio) {
      self::$errores[] = "Debes asignarle un precio a la Propiedad";
    }
  
    if( strlen ($this->descripcion) < 50 ) {
      self::$errores[] = "Asegurate de ponerle una descripcion que contenga minimo 50 caracteres";
    }
    if(!$this->habitaciones) {
      self::$errores[] = "El numero de habitaciones es obligatorio";
    }
    
    if(!$this->wc) {
      self::$errores[] = "Debes especificar cuantos Baños tiene la Propiedad";
    }
    
    if(!$this->estacionamiento) {
      self::$errores[] = "El campo de estacionamiento es obligatorio";
    }
    
    if(!$this->vendedorId) {
      self::$errores[] = "Elige un vendedor";
    }
    
    if(!$this->imagen) {
    self::$errores[] = 'La imagen es Obligatoria';
    }
    
  return self::$errores;
   }
}