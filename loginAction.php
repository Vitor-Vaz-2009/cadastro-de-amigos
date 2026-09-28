<?php
session_start();
require_once("conexaoBD.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$nome = trim($_POST['txtNome'] ?? '');
$senha = $_POST['txtSenha'] ?? '';

if ($nome === '' || $senha === '') {
    header("Location: index.php?erro=preencha");
    exit;
}

$stmt = $conexao->prepare("SELECT nome, senha FROM usuario WHERE nome = ? LIMIT 1");
$stmt->bind_param("s", $nome);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Compatível com o projeto antigo, que armazena a senha em texto.
    // Se futuramente a tabela usar password_hash(), a verificação abaixo também aceita hash.
    $senhaValida = password_verify($senha, $usuario['senha']) || hash_equals((string)$usuario['senha'], (string)$senha);

    if ($senhaValida) {
        session_regenerate_id(true);
        $_SESSION['logado'] = $usuario['nome'];
        header("Location: principal.php");
        exit;
    }
}

$stmt->close();
$conexao->close();
header("Location: index.php?erro=1");
exit;
?>
