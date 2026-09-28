<?php
require_once("verificarAcesso.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Cadastro de Amigos</title>
</head>
<body class="w3-light-grey">
    <div class="w3-padding w3-content w3-half w3-display-middle">
        <div class="w3-white w3-card-4 w3-padding w3-round-large">
            <h1 class="w3-teal w3-center w3-round-large w3-padding">Cadastro de Amigos</h1>
            <h3>Bem-vindo, <?php echo htmlspecialchars($_SESSION['logado'], ENT_QUOTES, 'UTF-8'); ?>!</h3>
            <p>Escolha uma opção:</p>
            <div class="w3-center">
                <a href="listar.php" class="w3-button w3-teal w3-round w3-margin">Listar Amigos</a>
                <a href="cadastro.php" class="w3-button w3-blue w3-round w3-margin">Cadastrar Amigo</a>
                <a href="logoutAction.php" class="w3-button w3-red w3-round w3-margin">Sair</a>
            </div>
        </div>
    </div>
</body>
</html>
