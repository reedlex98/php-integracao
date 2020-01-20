<?php require_once("../../conexao/conexao.php"); ?>
<?php
    if( isset($_POST["submit"]) ) {
        $delete_query = "delete from transportadoras where transportadoraID = {$_POST['transportadoraID']}";
        $operacao_deletar = mysqli_query($conecta, $delete_query);

        if(!$operacao_deletar) {
            die("Erro na alteracao");   
        } else {
            header("location:listagem.php");   
        }
        
    }

    // Consulta a tabela de transportadoras
    $tr = "SELECT * ";
    $tr .= "FROM transportadoras ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $tr .= "WHERE transportadoraID = {$id} ";
    } else {
        $tr .= "WHERE transportadoraID = 1 ";
    }
    
    $con_transportadora = mysqli_query($conecta,$tr);
    if(!$con_transportadora) {
        die("Erro na consulta");
    }

    $info_transportadora = mysqli_fetch_assoc($con_transportadora);

    // consulta aos estados
    $estados = "SELECT nome ";
    $estados .= "FROM estados where estadoID = {$info_transportadora['estadoID']}";
    $lista_estados = mysqli_query($conecta, $estados);
    if(!$lista_estados) {
       die("erro no banco"); 
    }
    $linha = mysqli_fetch_assoc($lista_estados)

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP INTEGRACAO</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
            <div id="janela_formulario">
                <form action="exclusao.php" method="post">
                    <h2>Alteração de Transportadoras</h2>
                    
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["nometransportadora"])  ?>" name="nometransportadora" id="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["endereco"])  ?>" name="endereco" id="endereco">
                    
                    <label for="cidade">Cidade</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["cidade"])  ?>" name="cidade" id="cidade">
                    
                    <label for="estados">Estados</label>
                    <input type="text" name="estados" id="estados" value="<?php echo $linha['nome'] ?>">
                    
                    <label for="cep">CEP</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["cep"])  ?>" name="cep" id="cep">                    
                    
                    <label for="telefone">Telefone</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["telefone"])  ?>" name="telefone" id="telefone">                    

                    <label for="cnpj">CNPJ</label>
                    <input type="text" value="<?php echo utf8_encode($info_transportadora["cnpj"])  ?>" name="cnpj" id="cnpj">                    

                    <input type="hidden" name="transportadoraID" value="<?php echo $info_transportadora["transportadoraID"] ?>">
                    <input type="submit" name="submit" value="Confirmar exclusão">                    
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