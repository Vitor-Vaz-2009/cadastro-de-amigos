<?php
require_once("verificarAcesso.php");
require_once("conexaoBD.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: listar.php");
    exit;
}

$id = filter_input(INPUT_POST, 'txtID', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: listar.php?erro=exclusao");
    exit;
}

$stmt = $conexao->prepare("DELETE FROM amigo WHERE idamigo = ?");
$stmt->bind_param("i", $id);
$sucesso = $stmt->execute();
$erro = $stmt->error;
$stmt->close();
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"><title>Exclusão</title></head>
<body>
<div class="w3-padding w3-content w3-third w3-display-middle">
<?php if ($sucesso): ?>
    <div class="w3-panel w3-green w3-round"><h3>Amigo excluído com sucesso!</h3></div>
<?php else: ?>
    <div class="w3-panel w3-red w3-round"><h3>Erro ao excluir!</h3><p><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></p></div>
<?php endif; ?>
<a href="listar.php" class="w3-button w3-teal">Voltar para a lista</a>
</div>
</body>
</html>
