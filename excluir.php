<?php
require_once("verificarAcesso.php");
require_once("conexaoBD.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { header("Location: listar.php"); exit; }

$stmt = $conexao->prepare("SELECT idamigo, nome, apelido, email FROM amigo WHERE idamigo = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$amigo = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conexao->close();

if (!$amigo) { header("Location: listar.php"); exit; }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"><title>Excluir Amigo</title></head>
<body class="w3-light-grey">
<div class="w3-padding w3-content w3-third w3-display-middle">
    <div class="w3-white w3-card-4 w3-padding w3-round-large">
        <h1 class="w3-center w3-red w3-round-large w3-padding">Confirmar exclusão</h1>
        <p>Tem certeza que deseja excluir este amigo?</p>
        <p><b>Nome:</b> <?php echo htmlspecialchars($amigo['nome'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><b>Apelido:</b> <?php echo htmlspecialchars($amigo['apelido'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><b>E-mail:</b> <?php echo htmlspecialchars($amigo['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        <form action="excluirAction.php" method="post">
            <input type="hidden" name="txtID" value="<?php echo (int)$amigo['idamigo']; ?>">
            <a href="listar.php" class="w3-button w3-grey w3-round">Cancelar</a>
            <button type="submit" class="w3-button w3-red w3-round w3-right">Confirmar exclusão</button>
        </form>
    </div>
</div>
</body>
</html>
