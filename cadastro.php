<?php require_once("verificarAcesso.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cadastrar Amigo</title>
</head>
<body class="w3-light-grey">
<a href="principal.php" class="w3-display-topleft"><i class="fa fa-arrow-circle-left w3-large w3-teal w3-button w3-xxlarge"></i></a>
<div class="w3-padding w3-content w3-third w3-margin w3-display-middle">
    <div class="w3-white w3-card-4 w3-padding w3-round-large">
        <h1 class="w3-center w3-teal w3-round-large w3-margin">Cadastro de Amigos</h1>
        <form action="cadastroAction.php" method="post">
            <label class="w3-text-teal"><b>Nome</b></label>
            <input name="txtNome" class="w3-input w3-light-grey w3-border" maxlength="100" required>
            <br>
            <label class="w3-text-teal"><b>Apelido</b></label>
            <input name="txtApelido" class="w3-input w3-light-grey w3-border" maxlength="100" required>
            <br>
            <label class="w3-text-teal"><b>Email</b></label>
            <input name="txtEmail" class="w3-input w3-light-grey w3-border" type="email" maxlength="150" required>
            <br>
            <button name="btnAdicionar" class="w3-button w3-teal w3-round w3-right" type="submit">
                <i class="fa fa-user-plus"></i> Adicionar
            </button>
        </form>
    </div>
</div>
</body>
</html>
