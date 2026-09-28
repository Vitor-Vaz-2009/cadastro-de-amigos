<?php
require_once("verificarAcesso.php");
require_once("conexaoBD.php");

$busca = trim($_GET['nome'] ?? '');

if ($busca !== '') {
    $stmt = $conexao->prepare("SELECT idamigo, nome, apelido, email FROM amigo WHERE nome LIKE ? OR apelido LIKE ? OR email LIKE ? ORDER BY nome ASC");
    $termo = "%" . $busca . "%";
    $stmt->bind_param("sss", $termo, $termo, $termo);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conexao->query("SELECT idamigo, nome, apelido, email FROM amigo ORDER BY nome ASC");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Amigos</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="w3-light-grey">
<div class="w3-content w3-padding" style="max-width:1100px; margin:auto;">
    <div class="w3-bar w3-margin-bottom">
        <a href="principal.php" class="w3-button w3-teal w3-round"><i class="fa fa-home"></i> Início</a>
        <a href="cadastro.php" class="w3-button w3-blue w3-round"><i class="fa fa-user-plus"></i> Cadastrar amigo</a>
        <a href="logoutAction.php" class="w3-button w3-red w3-round w3-right">Sair</a>
    </div>

    <h1 class="w3-center w3-teal w3-round-large w3-padding">Lista de Amigos</h1>

    <form method="GET" class="w3-margin-bottom">
        <input class="w3-input w3-border w3-round" type="text" name="nome" placeholder="Pesquisar por nome, apelido ou e-mail" value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>">
        <button class="w3-button w3-teal w3-margin-top w3-round" type="submit"><i class="fa fa-search"></i> Pesquisar</button>
        <?php if ($busca !== ''): ?><a href="listar.php" class="w3-button w3-grey w3-margin-top w3-round">Limpar</a><?php endif; ?>
    </form>

    <?php if (!$resultado): ?>
        <div class="w3-panel w3-red"><p>Erro ao consultar os amigos: <?php echo htmlspecialchars($conexao->error, ENT_QUOTES, 'UTF-8'); ?></p></div>
    <?php elseif ($resultado->num_rows === 0): ?>
        <div class="w3-panel w3-pale-yellow w3-border"><p>Nenhum amigo encontrado.</p></div>
    <?php else: ?>
    <div class="w3-responsive">
        <table class="w3-table-all w3-centered w3-card-4">
            <thead>
                <tr class="w3-teal">
                    <th>Código</th><th>Nome</th><th>Apelido</th><th>E-mail</th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($linha = $resultado->fetch_assoc()):
                $id = (int)$linha['idamigo'];
                $nome = htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8');
                $apelido = htmlspecialchars($linha['apelido'], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($linha['email'], ENT_QUOTES, 'UTF-8');
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $apelido; ?></td>
                    <td><?php echo $email; ?></td>
                    <td>
                        <a class="w3-button w3-blue w3-round" href="atualizar.php?id=<?php echo $id; ?>" title="Editar"><i class="fa fa-pencil"></i></a>
                        <a class="w3-button w3-red w3-round" href="excluir.php?id=<?php echo $id; ?>" title="Excluir"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php
if (isset($stmt)) $stmt->close();
$conexao->close();
?>
</body>
</html>
