<?php 
require_once "classes/usuarios.php";
$u = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/msg-erro.css">
    <title>Cadastro-ETEC</title>
</head>
<body>

    <section id="home-neweco">
        <div id="title-home">
                <h3>NewEco-Tec</h3>
                <p>Sua central de compras</p>
        </div>
    </section>
       
    <section class="area-login-cadas">

        <div class="login-cadas">
       
            <a href="index.php"><img src="imagens/icone_form.png" alt="imagem icon" id="img-php"></a>
           
            <form action="cadastrar.php" method="POST">
                <input type="text" name="nome" id="nome" placeholder="seu nome" autofocus maxlength="35">
                <input type="email" name="email" id="email" placeholder="seu email" maxlength="45">
                <input type="tel" name="telefone" id="telefone" placeholder="seu telefone" maxlength="12">
                <input type="text" name="cpf" id="cpf" placeholder="seu cpf" maxlength="12">
                <input type="password" name="senha" id="senha" placeholder="sua senha" maxlength="25">
                <input type="password" name="confsenha" id="confr_senha" placeholder="confirmar senha" maxlength="25">
                <input type="submit" value="Cadastrar" id="btn-enviar" >
            </form>

            <?php
            // verificar se clicou no botão de enviar
            if (isset($_POST["nome"])){
                //clicou no botão
                // addslashes -> previnir invasores e outras malícias
                $nome = addslashes($_POST["nome"]);
                $senha = addslashes($_POST["senha"]);
                $email = addslashes($_POST["email"]);
                $telefone = addslashes($_POST["telefone"]);
                $cpf = addslashes($_POST["cpf"]);
                $conf_senha = addslashes($_POST["confsenha"]);

                 // verificar se todos os campos foram enviados
                 if (!empty($nome) && !empty($senha) && !empty($email) && !empty($telefone) && !empty($cpf) && !empty($conf_senha)){
                    // todos os campos foram preenchidos

                    if ($u->connect() == ""){
                        //echo "sem erros";
                        if ($senha == $conf_senha){ // validar cadastro de senhas

                            if ($u ->cadastrar($nome, $senha, $email, $cpf, $telefone)){ // retorno verdadeiro significa cadastro realizado
                                ?>
                                <div id="green-cd">
                                    <p>Cadastro realizado!!Acesse sua conta!</p>
                                   
                                </div>
                                
                                <?php
                            }else{
                                ?>
                                <div class="red-cd">
                                    <p>Email já cadastradoTente novamente cadastrar</p>
                                </div>
                                
                                <?php
                            }
                        }else{
                            ?>
                            <div class="red-cd">
                                <p>Senhas não coincidem</p>
                            </div>
                           
                            <?php
                        }
                       
                    }else{
                        ?>
                        <div class="red-cd">
                            <p>
                            ocorreu um erro de conexão!!
                            </p>
                        </div>
                       
                        <?php
                    }
                  
                }else{
                    // todos os campos não estão preenchidos
                    ?>
                    <div class="red-cd">
                        <p>preencha todos os campos</p>
                    </div>
                    
                    <?php
                }
            }
            ?>

        </div>

    </section>
</body>
</html>