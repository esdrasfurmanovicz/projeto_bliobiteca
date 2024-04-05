<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php"); 
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: clienteList.php");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == null){
    header("location: clienteList.php");
    exit();
}
$cliente = ClienteRepository::get($_POST["id"]);
if(!$cliente){
    header("location: clienteList.php");
    exit();
}

if(!isset($_POST['nome'])){
    header("Location: clienteNovo.php?id=".$cliente->getId());
    exit();
}
if($_POST["nome"] == "" || $_POST["nome"] == null){
    header("Location: clienteNovo.php?id=".$cliente->getId());
    exit();
}
$datetime = DateTime::createFromFormat('d/m/Y', $_POST["dataNascimento"]);
$dateFormatted = $datetime->format('Y-m-d');


$cliente->setNome($_POST['nome']);
$cliente->setTelefone($_POST['telefone']);
$cliente->setEmail($_POST['email']);
$cliente->setCpf($_POST['cpf']);
$cliente->setRg($_POST['rg']);
$cliente->setDataNascimento($dateFormatted);
$cliente->setAlteracaoFuncionarioId($user->getId());
$cliente->setDataAlteracao(date('Y-d-m H:i:s'));

ClienteRepository::update($cliente);



header("Location: clienteEditar.php?id=".$cliente->getId());