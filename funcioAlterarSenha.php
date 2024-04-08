<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: funcioList.php");
    exit();
}
if ($_GET['id'] == '' || $_GET['id'] == null) {
    header("Location: funcioList.php");
    exit();
}

$funcionario = FuncionarioRepository::get($_GET['id']);

if (!$funcionario) {
    header("Location: funcioList.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/novo.css">
    <link rel="stylesheet" href="style/senha.css">
</head>

<body>
    <?php include("include/menu.php") ?>
    <main>
        <div class="container">
            <h2>Funcionario > Editar</h2>
            <button class="voltar"><a href="funcioList.php">Voltar</a></button>
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="funcioAlterarSenhaPost.php" method="POST"> 
                        <div class="md-3">
                            <label for="senha" class="form-label">Nova Senha</label>
                            <div class="group">
                                <label class="icone">
                                            <input checked="checked" type="checkbox" id="togglePassword">
                                            <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"
                                                class="lock-open">
                                                <path
                                                    d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80v48c0 17.7 14.3 32 32 32s32-14.3 32-32V144C576 64.5 511.5 0 432 0S288 64.5 288 144v48H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H352V144z">
                                                </path>
                                            </svg>
                                            <svg viewBox="0 0 448 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="lock">
                                                <path
                                                    d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z">
                                                </path>
                                            </svg>
                                        </label>
                                <input type="password" name="senha" id="senha" class="form-control input" required>
                            </div>
                        </div><div class="md-3">
                            <label for="repSenha" class="form-label">Repita a Senha</label>
                            <div class="group">
                                <label class="icone">
                                            <input checked="checked" type="checkbox" id="togglePassword">
                                            <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"
                                                class="lock-open">
                                                <path
                                                    d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80v48c0 17.7 14.3 32 32 32s32-14.3 32-32V144C576 64.5 511.5 0 432 0S288 64.5 288 144v48H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H352V144z">
                                                </path>
                                            </svg>
                                            <svg viewBox="0 0 448 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="lock">
                                                <path
                                                    d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z">
                                                </path>
                                            </svg>
                                        </label>
                                <input type="password" name="repSenha" id="repSenha" class="form-control input" required>
                            </div>
                        </div>
                        <div class="md-3">
                            <input type="hidden" name="id" value="<?php echo $funcionario->getId(); ?>">
                            <button type="submit" class="enviar">Alterar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="js/senha.js"></script>
</body>

</html>