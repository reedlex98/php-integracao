<?php require_once("../../conexao/conexao.php"); ?>
<?php
if (isset($_GET["codigo"])) {
    $produto_id = $_GET["codigo"];
    $consulta = "select * from produtos where produtoID = " . $produto_id;
    $resultado = mysqli_query($conecta, $consulta);
    if (!$resultado) {
        die("Erro na consulta ao mysql");
    } else {
        $registro = mysqli_fetch_assoc($resultado);
    }
} else {
    Header("location: index.php");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Curso PHP FUNDAMENTAL</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/produto_detalhe.css" rel="stylesheet">
    <link href="_css/produtos.css" rel="stylesheet">
</head>

<body>
    <?php include_once("_incluir/topo.php"); ?>

    <main>
        <div id="detalhe_produto">
            <ul>
                <?php // foreach($registro $chave => $campo){?>
                <li>
                    <h2><?php echo $registro["nomeproduto"] ?></h2>
                </li>
                <li class="imagem"> <img src="./<?php echo $registro["imagemgrande"] ?>" alt="<?php echo $registro["nomeproduto"] ?>"> </li>
                <li> <?php echo $registro["descricao"] ?> </li>
                <li> Preço: <?php echo $registro["precounitario"] ?> </li>
                <?php // } ?>
            </ul>
        </div>
    </main>

    <?php include_once("_incluir/rodape.php"); ?>
</body>

</html>

<?php
// Fechar conexao
mysqli_close($conecta);
?>