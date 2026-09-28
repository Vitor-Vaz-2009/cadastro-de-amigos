<?php
require_once("verificarAcesso.php");
require_once("conexaoBD.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: listar.php");
    exit;
}

$stmt = $conexao->prepare("SELECT idamigo, nome, apelido, email FROM amigo WHERE idamigo = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$amigo = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conexao->close();

if (!$amigo) {
    header("Location: listar.php?erro=nao_encontrado");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Atualizar Amigo</title>
</head>
<body class="w3-light-grey">
<a href="listar.php" class="w3-display-topleft"><i class="fa fa-arrow-circle-left w3-large w3-teal w3-button w3-xxlarge"></i></a>
<div class="w3-padding w3-content w3-third w3-margin w3-display-middle">
    <div class="w3-white w3-card-4 w3-padding w3-round-large">
        <h1 class="w3-center w3-teal w3-round-large w3-margin">Atualizar Amigo</h1>
        <form action="atualizarAction.php" method="post">
            <input name="txtID" type="hidden" value="<?php echo (int)$amigo['idamigo']; ?>">
            <label class="w3-text-teal"><b>Nome</b></label>
            <input name="txtNome" class="w3-input w3-light-grey w3-border" maxlength="100" value="<?php echo htmlspecialchars($amigo['nome'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
            <label class="w3-text-teal"><b>Apelido</b></label>
            <input name="txtApelido" class="w3-input w3-light-grey w3-border" maxlength="100" value="<?php echo htmlspecialchars($amigo['apelido'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
            <label class="w3-text-teal"><b>E-mail</b></label>
            <input name="txtEmail" class="w3-input w3-light-grey w3-border" type="email" maxlength="150" value="<?php echo htmlspecialchars($amigo['email'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
            <button class="w3-button w3-teal w3-round w3-right" type="submit"><i class="fa fa-refresh"></i> Atualizar</button>
        </form>
    </div>
</div>
</body>
</html>
