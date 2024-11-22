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
    <title>Login</title>
</head>
<body class="login">
    <div class="area-login">
        <div class="title">
            <h3 class="titulo">Login</h3>
        </div>
        
        <div class="card">
            <form class="form-login" method="POST">
                <div class="containerEmail">
                    <label >Usuário:</label>
                    <input type="email" name="email" placeholder="Digite seu E-mail"><br><br>
                </div>
                
                <div class="form-login">
                    <label>Senha:</label>
                    <input type="password" name="senha" placeholder="Digite sua Senha"><br><br>
                </div>
                
                <div class="form-login">
                    <a href="cadastrar.php">Cadastre-se</a><br><br>
                    <input type="submit" value="logar"><br><br>
                </div>
            </form>
        </div>

    </div>

<?php

    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha))
        {
            $usuario->conectar("crud", "localhost", "root", "");
            if($usuario->msgErro == "")
            {
                if($usuario->logar($email, $senha))
                {
                    header("location: editar.php");
                }else{
                    ?>
                        <div id="msn-sucesso">
                            Email ou Senha incorreto
                            Clique <a href="index.php">aqui</a> para logar
                        </div>
                        
                    <?php
                }
    
            }else{

                ?>
                <div id="msn-sucesso">
                    <?php echo "Erro: ".$usuario->$msgErro ?>
                    Clique <a href="index.php">aqui</a> para logar
                </div>
                
                <?php
            }
        }else{

            ?>
            <div id="msn-sucesso">
                Preencha todos os campos
                Clique <a href="index.php">aqui</a> para logar
            </div>
            
            <?php
        
        }

    }

?>
</body>
</html>