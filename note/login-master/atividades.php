<?php
    $host = "localhost";
    $user = "root";
    $senha = "";
    $database = "login";

    $connection = new mysqli( "localhost", "root", "", "login");

    if(isset($_POST['criar'])){
        $atividade = $_POST['atividade'];
        $query = mysqli_query($connection, "INSERT INTO users (atividade) VALUES ('$atividade')");
    }
?>