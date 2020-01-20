<?php require_once("../../conexao/conexao.php"); ?>
<?php require_once("./_incluir/funcoes.php"); ?>

<?php
    if( isset($_POST['submit'])){
        $imagempequena = publicarImagem($_FILES['imagempequena']);
        $imagemgrande = publicarImagem($_FILES['imagemgrande']);

        if($imagemgrande[1] && $imagempequena[1]){

            $nomeproduto = utf8_decode($_POST['nomeproduto']);
            $codigobarra = utf8_decode($_POST['codigobarra']);
            $tempoentrega = $_POST['tempoentrega'];
            $categoriaID = $_POST['categoriaID'];
            $fornecedorID = $_POST['fornecedorID'];
            $precounitario = $_POST['precounitario'];
            $precovenda = $_POST['precovenda'];

            $insereProduto = "insert into produtos (imagempequena, imagemgrande, nomeproduto, codigobarra, tempoentrega, categoriaID, fornecedorID, precounitario, precorevenda) values ('{$imagempequena[1]}','{$imagemgrande[1]}','{$nomeproduto}','{$codigobarra}',{$tempoentrega},{$categoriaID},{$fornecedorID},{$precounitario},{$precovenda})";

            $qInsereProduto = mysqli_query($conecta, $insereProduto);

            if(!$qInsereProduto) {
                die("Falha na consulta ao banco");   
            }

            header('location:listagem.php');

        }
        else{
            $erroMensagem = array($imagempequena[0], $imagemgrande[0]);
        }
    }

    // Consulta ao banco de dados
    $categorias = "SELECT categoriaID, nomecategoria ";
    $categorias .= "FROM categorias ";
    $qCategorias = mysqli_query($conecta, $categorias);
    if(!$qCategorias) {
        die("Falha na consulta ao banco");   
    }

    // Consulta ao banco de dados
    $fornecedores = "SELECT fornecedorID, nomefornecedor ";
    $fornecedores .= "FROM fornecedores ";
    $qFornecedores = mysqli_query($conecta, $fornecedores);
    if(!$qFornecedores) {
        die("Falha na consulta ao banco");   
    }
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

                <form action="incluir.php" method="post" enctype="multipart/form-data">

                <?php if ( isset($erroMensagem) ){  ?>
                    <?php foreach ($erroMensagem as $mensagem) {?>
                        <p> <?php echo $mensagem ?> </p>
                    <?php  }?>
                <?php  }?>

                <h2>Incluir novo produto</h2>
                    <label for="nomeproduto">Nome do produto</label>
                    <input type="text" name="nomeproduto" id="nomeproduto">
                    <label for="codigobarra">Código de barra</label>
                    <input type="text" name="codigobarra" id="codigobarra">
                    <label for="tempoentrega">Tempo de entrega</label>
                    <input type="radio" name="tempoentrega" value=5> 5 dias
                    <input type="radio" name="tempoentrega" value=8> 8 dias
                    <input type="radio" name="tempoentrega" value=15> 15 dias
                    <input type="radio" name="tempoentrega" value=30> 30 dias
                    <label for="categoriaID">Categoria</label>
                    <select name="categoriaID" id="categoriaID">
                        <?php while ($categoria = mysqli_fetch_assoc($qCategorias)){?>
                            <option value=<?php echo $categoria['categoriaID']?>> <?php echo $categoria['nomecategoria'] ?> </option>
                        <?php }?>
                    </select>
                    <label for="fornecedorID">Fornecedor</label>
                    <select name="fornecedorID" id="fornecedorID">
                        <?php while ($fornecedor = mysqli_fetch_assoc($qFornecedores)){?>
                            <option value=<?php echo $fornecedor['fornecedorID']?>> <?php echo $fornecedor['nomefornecedor'] ?> </option>
                        <?php }?>
                    </select>
                    <label for="precovenda">Preco de revenda</label>
                    <input type="number" name="precovenda" id="precovenda">
                    <label for="precounitario">Preco unitário</label>
                    <input type="number" name="precounitario" id="precounitario">
                    <label for="imagempequena">Imagem pequena</label>
                    <input type="file" name="imagempequena" id="imagempequena">
                    <label for="imagemgrande">Imagem grande</label>
                    <input type="file" name="imagemgrande" id="imagemgrande">
                    <input type="submit" name="submit" value="Inserir novo produto">
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