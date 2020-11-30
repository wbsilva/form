<?php

/**
 *
 */
class Conexao
{
  private $usuario;
  private $senha;
  private $banco;
  private $servidor;
  private static $pdo;

  public function __construct ()
  {
      $this->servidor = "localhost";
      $this->banco = "agenda";
      $this->ususario = "root";
      $this->senha = "123qwe";
  }

  public function conectar()
  {
    try {
      if (is_null(self::$pdo))
      {
        self::$pdo = new PDO("mysql:host=".$this->servidor.";bdname=".$this->banco, $this->ususario, $this->senha);
      }
      return sefl::$pdo;
    } catch (PDOException $ex) {

    }

  }
}


?>
