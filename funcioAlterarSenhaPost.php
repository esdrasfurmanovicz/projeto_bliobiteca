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

if(!isset($_POST['senha'])){
    header("Location: funcioEditar.php?id=".$funcio->getId());
    exit();
}
if($_POST["senha"] == "" || $_POST["senha"] == null){
    header("Location: funcioEditar.php?id=".$funcio->getId());
    exit();
}

if($_POST["senha"] != $_POST["repSenha"]){
    header("Location: funcioEditar.php?id=".$funcio->getId());
    exit();
}


$funcio->setSenha($_POST['senha']);
$funcio->setAlteracaoFuncionarioId($user->getId());
$funcio->setDataAlteracao(date('Y-d-m H:i:s'));

FuncionarioRepository::update($funcio);



header("Location: funcioEditar.php?id=".$funcio->getId());