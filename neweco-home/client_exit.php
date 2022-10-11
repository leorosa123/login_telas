<?php
session_start();
unset($_SESSION["id_usario"]);
header("location: ../index.php");
 ?>
 