<?php

/**
 *
 */

 require_once 'Conexao.class.php';
 require_once 'Funcoes.class.php';

class Pessoa
{
  private $con;
  private $objfunc;
  private $codigo;
  private $nome;
  private $cpf;

  public function __construct()
  {
    $this->con = new Conexao();
    $this->objfunc = new Funcoes();
  }

  public function __set($atributo, $valor)
  {
    $this->$atributo = $valor;
  }

  public function __get($atributo)
  {
    return $this->$atributo;
  }

  public function querySeleciona($dados)
  {
    try{
           $this->idpessoa = $dados['idpessoa'];
           $cst = $this->con->conectar()->prepare("SELECT idpessoa, nome, cpf FROM `pessoa` WHERE `idpessoa` = :idpess;");
           $cst->bindParam(":idpess", $this->idpessoa, PDO::PARAM_INT);
           $cst->execute();
           return $cst->fetch();
       } catch (PDOException $ex) {
           return 'error '.$ex->getMessage();
       }

  }

  public function querySelect()
  {
    try{
            $cst = $this->con->conectar()->prepare("SELECT `idpessoa`, `nome`, `cpf` FROM `pessoa`;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }

  }

  public function queryInsert($dados)
  {
    try{
            $this->nome = $dados['nome'];
            $this->email = $dados['cpf'];
            $cst = $this->con->conectar()->prepare("INSERT INTO `pessoa` (`nome`, `cpf`) VALUES (:nome, :cpf);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":cpf", $this->email, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }

  }

  public function queryUpdate($dados)
  {
    try{
            $this->idpessoa = $dados['idpessoa'];
            $this->nome = $dados['nome'];
            $this->cpf = $dados['cpf'];
            $cst = $this->con->conectar()->prepare("UPDATE `pessoa` SET  `nome` = :nome, `cpf` = :cpf WHERE `idpessoa` = :idpess;");
            $cst->bindParam(":idpess", $this->idpessoa, PDO::PARAM_INT);
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":cpf", $this->email, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }

  }

  public function queryDelete($dados)
  {
    try{
            $this->idpessoa = $dados['idpessoa'];
            $cst = $this->con->conectar()->prepare("DELETE FROM `pessoa` WHERE `idpessoa` = :idpess;");
            $cst->bindParam(":idpess", $this->idpessoa, PDO::PARAM_INT);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }

  }
}
?>
