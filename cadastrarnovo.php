<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro</title>
</head>
<body class="cadastro">
    <div class="area-login">
        <div class="card">
            <span class="title">Cadastrar Novo Usuario</span>
            <form class="form-login" action="" method="POST">
                <label for="">Nome:</label>
                <input type="text" name="nome" placeholder="Digite seu nome"><br><br>

                <label for="">Telefone:</label>
                <input type="tel" name="telefone" placeholder="Digite seu telefone"><br><br>

                <label for="">E-mail:</label>
                <input type="email" name="email" placeholder="Digite seu E-mail"><br><br>

                <label for="">Senha:</label>
                <input type="password" name="senha" placeholder="Digite sua senha"><br><br>

                <label for="">Confirmar Senha:</label>
                <input type="password" name="confSenha" placeholder="Confirme sua senha"><br><br>
            
                <input class="button" type="submit" value="CADASTRAR"><br><br>
            
                <a href="editar.php">Voltar</a>
            </form>
        </div>
    </div>
<?php
    if(isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confSenha = addslashes( $_POST['confSenha']);


        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha))
        {
            $usuario->conectar("crud", "localhost", "root", "");
            if($usuario->msgErro == "")
            {
                if($senha == $confSenha)
                {
                    if($usuario->cadastrar($nome,$telefone,$email,$senha))
                    {
                        ?>

                            <div id="msn-sucesso">
                                Cadastrado com sucesso!
                            </div>
                        <?php
                        
                    }
                    else
                    {
                        ?>
                        <div id="msn-sucesso">
                            E-mail já cadasatrado. 
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div id="msn-sucesso">
                        A senha e Confirmar Senha não correspondem
                    </div>
                    <?php
                }
            }
            else
            {
                ?>
                <div id="msn-sucesso">
                    <?php echo "Erro: ".$usuario->msgErro;?>
                </div>
                <?php
            }
        }
        else
        {
            ?>
            <div id="msn-sucesso">
                Preencha todos os campos.
            </div>
            <?php
        }
    }

?>
</body>
</html>