<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: empresListAll.php?1");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == null){
    header("location: empresListAll.php?2");
    exit();
}
$empres = EmprestimoRepository::get($_POST["id"]);
if(!$empres){
    header("location: empresListAll.php?3");
    exit();
}

if(EmprestimoRepository::countByDataDevolucao($_POST["id"]) > 0){
    header("location: empresListAll.php?4");
    exit(); 
}
if(EmprestimoRepository::countByDataRenovacao($_POST["id"]) > 0){
    header("location: empresListAll.php?5");
    exit(); 
}
if(EmprestimoRepository::countByDataAlteracao($_POST["id"]) > 0){
    header("location: empresListAll.php?6");
    exit(); 
}
if($empres->getDataVencimento() < date('Y-m-d')){
    header("location: empresListAll.php?7");
    exit(); 
}

$emprestimo = Factory::emprestimo();


$emprestimo->setDataVencimento(EmprestimoRepository::autoCompleteVencimento());
$emprestimo->setAlteracaoFuncionarioId($user->getId());
$emprestimo->setRenovacaoFuncionarioId($user->getId());
$emprestimo->setDataAlteracao(date('Y-d-m h:i:s'));
$emprestimo->setDataRenovacao(date('Y-d-m h:i:s'));

EmprestimoRepository::update($emprestimo);

header("Location: empresListAll.php?8");