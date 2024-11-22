<?php
include_once 'Usuario.php'; 
$usuario = new Usuario();
$usuario->conectar("crud", "localhost", "root", ""); 

if (!empty($usuario->msgErro)) {
    echo "Erro: " . $usuario->msgErro;
    exit;
}


if (isset($_GET['id'])) {
    $id_usuario = intval($_GET['id']);
    $usuario_info = $usuario->getUsuarioId($id_usuario);
} else {
    echo "ID de usuário não encontrado!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $usuario->editarUsuario($id_usuario, $nome, $telefone, $email);
    header("Location: editar.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Editar Usuário</title>
</head>
<body>
<div class="area-tabela">
<h1>Editar Usuário</h1>
    <form method="POST">
    <table  class="tabela">
        <tr>
            <td><label for="nome">Nome:</label></td>
            <td><input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario_info['nome']) ?>" required></td>
        </tr>
        <tr>
            <td><label for="telefone">Telefone:</label></td>
            <td><input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($usuario_info['telefone']) ?>" required></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario_info['email']) ?>" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <button type="submit">Salvar Alterações</button>
            </td>
        </tr>
    </table>
    </form>
</div>

</body>
</html>
