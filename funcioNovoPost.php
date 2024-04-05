<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();
if(!isset($_POST['nome'])){

    header("Location: funcioNovo.php");
    exit();
}
if($_POST["nome" == ''] || $_POST["nome" == null]){

    header("Location: funcioNovo.php");
    exit();
}

$funcio = Factory::funcionario();

$funcio->setNome($_POST['nome']);
$funcio->setCpf($_POST['cpf']);
$funcio->setTelefone($_POST['telefone']);
$funcio->setEmail($_POST['email']);
$funcio->setSenha($_POST['senha']);
$funcio->setinclusaoFuncionarioId($user->getID());
$funcio->setDataInclusao(date('Y-d-m H:i:s'));

$funcio_retorno = FuncionarioRepository::insert($funcio);

if($funcio_retorno > 0){
    header("Location: funcioEditar.php?id=".$funcio_retorno);
    exit();
}

header("Location: funcioNovo.php");
    exit();
