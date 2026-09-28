<?php
$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Login - Cadastro de Amigos</title>
</head>
<body class="w3-light-grey">
    <div class="w3-padding w3-content w3-third w3-display-middle">
        <h1 class="w3-teal w3-center w3-round-large w3-padding">Login</h1>

        <?php if ($erro === '1'): ?>
            <div class="w3-panel w3-red w3-round">
                <p>Nome ou senha incorretos.</p>
            </div>
        <?php elseif ($erro === 'preencha'): ?>
            <div class="w3-panel w3-orange w3-round">
                <p>Preencha o nome e a senha.</p>
            </div>
        <?php endif; ?>

        <form action="loginAction.php" method="POST" class="w3-container w3-white w3-padding w3-card-4">
            <label><b>Nome:</b></label>
            <input class="w3-input w3-border" type="text" name="txtNome" required autofocus>
            <br>
            <label><b>Senha:</b></label>
            <input class="w3-input w3-border" type="password" name="txtSenha" required>
            <br>
            <button class="w3-button w3-teal w3-round" type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
