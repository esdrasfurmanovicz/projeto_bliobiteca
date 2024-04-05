<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: funcioList.php");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == null){
    header("location: funcioList.php");
    exit();
}
$funcio = FuncionarioRepository::get($_POST["id"]);
if(!$funcio){
    header("location: funcioList.php");
    exit();
}

if(!isset($_POST['nome'])){
    header("Location: funcioNovo.php?id=".$funcio->getId());
    exit();
}
if($_POST["nome"] == "" || $_POST["nome"] == null){
    header("Location: funcioNovo.php?id=".$funcio->getId());
    exit();
}



$funcio->setNome($_POST['nome']);
$funcio->setCpf($_POST['cpf']);
$funcio->setTelefone($_POST['telefone']);
$funcio->setSenha($_POST['senha']);
$funcio->setEmail($_POST['email']);
$funcio->setAlteracaoFuncionarioId($user->getId());
$funcio->setDataAlteracao(date('Y-d-m H:i:s'));

FuncionarioRepository::update($funcio);



header("Location: funcioEditar.php?id=".$funcio->getId());