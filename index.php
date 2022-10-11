<?php
require_once "classes/usuarios.php";
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/msg-erro.css">
    <title>login-ETEC</title>
</head>
<body>
   
    <section class="area-login">

        <div class="animation">
            <div id="title-home">
                <h3>NewEco-Tec</h3>
                <p>Sua central de compras</p>
            </div>

            <img src="imagens/animation_svg.svg" alt="Animation-tecnology" id="img-animation">
        </div>

        <div class="login">
            <div>
                <img src="imagens/icone_form.png" alt="imagem icon">
            </div>

            <form  method="POST">
                <input type="email"  id="email" name="email_enter" placeholder="seu email" autofocus maxlength="45">
                <input type="password" id="senha" name="senha_enter" placeholder="sua senha" maxlength="30">
                <input type="submit" name="btn" value="Entrar" id="btn-enviar" >
            </form>

            <p>Não tem uma conta? <a href="cadastrar.php">criar minha conta</a></p>

            <?php
                if (isset($_POST["email_enter"])){
                    //clicou no botão
                    // addslashes -> previnir invasores e outras malícias
                    
                    $email = addslashes($_POST["email_enter"]);
                    $senha = addslashes($_POST["senha_enter"]);
                
                    // verificar se todos os campos foram enviados
                    if (!empty($email) && !empty($senha)){
                        //todos os campos foram enviados
                        if ($u->logar($email, $senha)){
                            // is true
                            header("location: neweco-home/home.php");
                        }else{
                            // is false
                            ?>
                            <div class="red-cd">
                                <p>Verifique se Senha ou Email estão corretos!</p>
                            </div>
                            <?php
                        }

                    }else{
                        ?>
                        <div class="red-cd">
                            <p>Porfavor!Envie todos os campos</p>
                        </div>
                       
                        <?php
                    }
                    }
            ?>
        </div>

    </section>




</body>
</html>