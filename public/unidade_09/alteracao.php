<?php require_once("../../conexao/conexao.php"); ?>
<?php
    // tabela de transportadoras

    if (isset($_POST["submit"])) {

        $nometransportadora = utf8_decode($_POST['nometransportadora']);
        $endereco = utf8_decode($_POST['endereco']);
        $cidade = utf8_decode($_POST['cidade']);
        $cep = utf8_decode($_POST['cep']);

        $update_transportadora = "update transportadoras set nometransportadora = '{$nometransportadora}',  endereco = '{$endereco}' , telefone = {$_POST['telefone']}, cidade = '{$cidade}', estadoID = {$_POST['estado']}, cep = '{$cep}' , cnpj = {$_POST['cnpj']} where transportadoraID = {$_GET['codigo']}";

        print_r($update_transportadora);

        $consulta_tr = mysqli_query($conecta, $update_transportadora);
        if(!$consulta_tr) {
            die("erro no banco");
        }
        
        header("location:listagem.php");
    }

    $codigoTransportadora = $_GET["codigo"];

    $tr = "SELECT * FROM transportadoras where transportadoraID = {$codigoTransportadora}";
    $consulta_tr = mysqli_query($conecta, $tr);
    if(!$consulta_tr) {
        die("erro no banco");
    }


    $dados_transportadora = mysqli_fetch_assoc($consulta_tr);

    $estados = "select estadoID, nome from estados";
    $consulta_estados =  mysqli_query($conecta, $estados);

    if(!$consulta_estados) {
        die("erro no banco");
    }

    
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP INTEGRACAO</title>
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
        
            <div id="janela_formulario">
                <form action="alteracao.php?codigo=<?php echo $codigoTransportadora ?>" method="post">
                    <h2>Alteração de Dados</h2>
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input name="nometransportadora" type="text" value="<?php echo utf8_encode($dados_transportadora["nometransportadora"]) ?>">
                    <label for="endereco">Endereco</label>
                    <input name="endereco" type="text" value="<?php echo utf8_encode($dados_transportadora["endereco"]) ?>">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" value="<?php echo $dados_transportadora["telefone"] ?>">
                    <label for="cidade">Cidade</label>
                    <input name="cidade" type="text" value="<?php echo utf8_encode( $dados_transportadora["cidade"]) ?>">
                    <label for="estado">Estado</label>
                    <select name="estado">
                        <?php while($dados_estados = mysqli_fetch_assoc($consulta_estados)){?>
                            <?php if($dados_estados['estadoID'] == $dados_transportadora['estadoID']) { ?>
                                <option value="<?php echo $dados_estados["estadoID"] ?>" selected><?php echo utf8_encode($dados_estados["nome"]) ?></option> 
                            <?php } else {?>
                                <option value="<?php echo $dados_estados["estadoID"] ?>"><?php echo utf8_encode($dados_estados["nome"]) ?></option> 
                            <?php } ?>
                        <?php }?>
                    </select>
                    <label for="codigo">CEP</label>
                    <input name="cep" type="text" value="<?php echo $dados_transportadora["cep"] ?>">
                    <label for="codigo">CNPJ</label>
                    <input name="cnpj" type="text" value="<?php echo $dados_transportadora["cnpj"] ?>">
                    <input name="submit" type="submit" value="Alterar dados">
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