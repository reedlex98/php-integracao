<?php 
    require_once("../../conexao/conexao.php");
    require_once("./funcoes.php");
?>

<?php 

    if ( isset($_POST['enviar'])) {
        $mensagem = efetuaUpload($_FILES, './uploads');
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP INTEGRACAO</title>
        
        <!-- estilo -->
        <style>
            form {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            input{
                margin-bottom: 10px
            }

        </style>
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="upload_file" >
                <input type="submit" value="Publicar" name="enviar">
                <p>
                    <?php
                        if(isset($mensagem))
                            echo $mensagem 
                    ?>
                </p>
            </form>
            
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>