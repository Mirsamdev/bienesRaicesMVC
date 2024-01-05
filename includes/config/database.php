<?php
function conectarDB() : mysqli {
  $db = new mysqli('localhost', 'root', '1234', 'bienesraices');

if(!$db) {
  echo "Error no se pudo conectar";
  exit;
} 
return $db;
}

