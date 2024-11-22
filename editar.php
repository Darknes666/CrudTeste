<?php
include_once 'Usuario.php'; 
$usuario = new Usuario();
$usuario->conectar("crud", "localhost", "root", ""); 

if (!empty($usuario->msgErro)) {
    echo "Erro: " . $usuario->msgErro;
    exit;
}


if (isset($_GET['excluir'])) {
    $id_usuario = intval($_GET['excluir']);
    $usuario->excluirUsuario($id_usuario);
    header("Location: editar.php");
    exit;
}

$usuarios = $usuario->getUsuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Editar Usuários</title>
</head>
<body class="corpo-editar">
    <div class="area-tabela">
        <h1>Lista de Usuários</h1>
        <div class="form-login">
                    <a href="cadastrarnovo.php">Adicionar Usuario</a><br><br>
                </div>
        <table class="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($user['nome']) ?></td>
                        <td><?= htmlspecialchars($user['telefone']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td class="actions">
                            <a href="form_editar.php?id=<?= $user['id_usuario'] ?>">Editar</a>
                            <a href="?excluir=<?= $user['id_usuario'] ?>" onclick="return confirm('Confirme para excluir este usuário.')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
