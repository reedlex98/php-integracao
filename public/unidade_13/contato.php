<?php 
    require_once("../../conexao/conexao.php");
    require_once("./_incluir/funcoes.php"); 
?>

<?php 
    if(isset($_POST['nome'])){
        $sucesso = enviarMensagem($_POST);
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP INTEGRACAO</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/contato.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main> 
            <div id="janela_formulario">
                <form action="contato.php" method="post">
                    <input type="text" name="nome" placeholder="Digite seu nome">
                    <input type="email" name="email" placeholder="Digite seu email">
                    <label>Mensagem</label>
                    <textarea name="mensagem"></textarea>
                    <input type="submit" name="enviar" value="Enviar Mensagem">
                    
                    <?php
                        if( isset($sucesso)) { 
                            if($sucesso){
                                echo "<p class='success'>Mensagem enviada com sucesso!</p>";
                            }
                            else{
                                echo "<p class='fail'>Problema para enviar a mensagem</p>";
                            }
                        }
                    ?>                     
                </form>
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>