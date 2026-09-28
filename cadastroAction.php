<?php
require_once("verificarAcesso.php");
require_once("conexaoBD.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastro.php");
    exit;
}

$nome = trim($_POST['txtNome'] ?? '');
$apelido = trim($_POST['txtApelido'] ?? '');
$email = trim($_POST['txtEmail'] ?? '');

if ($nome === '' || $apelido === '' || $email === '') {
    header("Location: cadastro.php?erro=preencha");
    exit;
}

$stmt = $conexao->prepare("INSERT INTO amigo (nome, apelido, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $apelido, $email);
$sucesso = $stmt->execute();
$erro = $stmt->error;
$stmt->close();
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Cadastro</title>
</head>
<body>
<div class="w3-padding w3-content w3-third w3-display-middle">
<?php if ($sucesso): ?>
    <div class="w3-panel w3-green w3-round"><h3>Amigo salvo com sucesso!</h3></div>
    <a href="listar.php" class="w3-button w3-teal">Ver lista de amigos</a>
<?php else: ?>
    <div class="w3-panel w3-red w3-round"><h3>Erro ao cadastrar!</h3><p><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></p></div>
    <a href="cadastro.php" class="w3-button w3-teal">Voltar</a>
<?php endif; ?>
</div>
</body>
</html>
