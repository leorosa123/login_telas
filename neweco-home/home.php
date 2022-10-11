<?php 
session_start();
if (!isset($_SESSION["id_usuario"])){
    header("location: ../index.php");
    exit;
}
?>


<h1>SEJA BEM VINDO(A) A NEW-ECOO</h1>
<a href="client_exit.php">Sair do sistema</a>
