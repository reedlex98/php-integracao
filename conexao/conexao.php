<?php 

    // Passo 1 - abrir conexão
    $server = "localhost";
    $user = "root";
    $passwd = "";
    $database = "andes";
    $conecta = mysqli_connect($server, $user, $passwd, $database);

    // Passo 2 - testar conexao

    if(mysqli_connect_errno()){
        die("Conexao falhou " . mysqli_connect_errno());
    }
?>