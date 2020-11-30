<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/Pessoa.class.php';
require_once 'classes/Funcoes.class.php';

$objFcn = new Pessoa();
$objFcs = new Funcoes();

if(isset($_POST['btCadastrar'])){
    if($objFcn->queryInsert($_POST) == 'ok'){
        header('location: /form');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

if(isset($_POST['btAlterar'])){
    if($objFcn->queryUpdate($_POST) == 'ok'){
        header('location: ?acao=edit&func='.$objFcs->base64($_POST['func'],1));
    }else{
        echo '<script type="text/javascript">alert("Erro em alterar");</script>';
    }
}

if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit': $func = $objFcn->querySeleciona($_GET['func']); break;
        case 'delet':
            if($objFcn->queryDelete($_GET['func']) == 'ok'){
                header('location: /form');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}

?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Formulário de cadastro</title>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>

<div id="lista">
    <?php foreach($objFcn->querySelect() as $rst){ ?>
    <div class="pessoa">
        <div class="nome"><?=$rst['nome']?></div>
        <div class="editar"><a href="?acao=edit&func=<?=$rst['idpessoa']?>" title="Editar dados"><img src="img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>
        <div class="excluir"><a href="?acao=delet&func=<?=$rst['idpessoa']?>" title="Excluir esse dado"><img src="img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
    </div>
    <?php } ?>
</div>

<div id="formulario">
    <form name="formCad" action="" method="post">
    	<label>Nome: </label><br>
        <input type="text" name="nome" required="required"><br>
        <label>CPF: </label><br>
        <input type="text" name="cpf" required="required"><br>
        <?php if(isset($_GET['acao']) <> 'edit'){ ?>
        <?php } ?>
        <br>
        <input type="submit" name="<?=(isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" value="<?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar')?>">
        <input type="hidden" name="func" value="<?=(isset($func['idpessoa']))?($objFcs->base64($func['idpessoa'], 1)):('')?>">
    </form>
</div>

</body>
</html>
