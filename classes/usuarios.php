<?php

class Usuario {
    private $pdo;
    public $error_pdo = "";

    public function connect(){
        try{
            $pdo = new PDO("mysql:dbname=teste_log;host=localhost", "root", ""); // criando a conexão pdo
        }catch(PDOException $e){
            $error_pdo = $e->getMessage();
            return $error_pdo;
        }catch(Exception $e){
            $error_pdo = $e->getMessage();
            return $error_pdo;
        }
    }

    public function cadastrar($nome, $senha, $email, $cpf, $telefone){

        $pdo = new PDO("mysql:dbname=teste_log;host=localhost", "root", "");
    
        $sql = $pdo -> prepare("SELECT id_usuario from usuario where email = :e"); // testando se o usuario já existe através do seu email e id gerado
        $sql ->bindValue(":e", $email);
        $sql ->execute();

        if ($sql ->RowCount() > 0){
            
            return false; // Se existir um id > 0 significa que o bd encontrou um email cadastrado com id
        }else{

            // não existe id para o email cadastrado, podemos inserir o cadastro

            $sql = $pdo-> prepare("INSERT INTO usuario(nome, senha, email, cpf, telefone) values(:n, :s, :e, :c, :t)");

            $sql ->bindValue(":n", $nome);
            $sql ->bindValue(":s", md5($senha));
            $sql ->bindValue(":e", $email);
            $sql ->bindValue(":c", $cpf);
            $sql ->bindValue(":t", $telefone);
            $sql -> execute();
            return True;

        }

    }

    public function logar($email, $senha){

        $pdo = new PDO("mysql:dbname=teste_log;host=localhost", "root", "");

        $sql = $pdo -> prepare("SELECT id_usuario from usuario WHERE email = :e and senha = :s");
        $sql -> bindValue(":e", $email);
        $sql -> bindValue(":s", md5($senha));
        $sql -> execute();

        if ($sql->rowCount() > 0){
            //acesso autorizado
            $dado = $sql -> fetch();
            //$dado = $sql -> fetch(); // transforma a linha de código em um Array
            session_start();
            $_SESSION["id_usuario"] = $dado["id_usuario"];
            return true; //acesso autorizado
        }else{
            return false; // acesso negado;
        }
    }
}

?>