

<?php
    // Passo 3 - consultar no banco de dados
    require_once("../../conexao/conexao.php");

    $query = "select * from categorias";
    $categorias = mysqli_query($connection, $query);

    if(!$categorias){
        // Passo 4 - matar conexao caso consulta falhe
        die("Falha na consulta ao banco");
    }

    // print_r($categorias);

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP FUNDAMENTAL</title>
    </head>

    <body>
        <ul>
            <!-- Passo 5 Listar resultado da query -->
            <?php while ($registro = mysqli_fetch_array($categorias)) { ?>
                <li><?php echo $registro[1] ?></li>
            <?php }?>
        </ul>
        <!-- Passo 6 liberar espaço da query -->
        <?php mysqli_free_result($categorias) // Li?>
    </body>
</html>

<?php

    // Passo 7 - fechar conexao
    mysqli_close($connection);
?>