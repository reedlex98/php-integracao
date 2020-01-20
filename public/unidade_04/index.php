<?php require_once("../../conexao/conexao.php"); ?>


<?php
setlocale(LC_ALL, 'pt_BR');
$consulta  = "select produtoID, nomeproduto, tempoentrega, precounitario, imagempequena ";
$consulta .= "from produtos";
$resultado = mysqli_query($conecta, $consulta);

if (!$resultado) {
    die("Falha ao consultar ao banco");
}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Curso PHP FUNDAMENTAL</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/produtos.css">
</head>

<body>
    <?php include_once("./_incluir/topo.php") ?>

    <main>
        <div id="listagem_produtos">
            <?php while ($registro = mysqli_fetch_assoc($resultado)) { ?>
                <ul>
                    <li class="imagem"><img src="<?php echo $registro["imagempequena"] ?>" alt="<?php echo $registro["nomeproduto"] ?>"></li>
                    <li><h3><?php echo " Produto: " . $registro["nomeproduto"] ?></h3></li>
                    <li><?php echo " Tempo de entrega: " . $registro["tempoentrega"] ?></li>
                    <li><?php echo " Preco unitario: " . money_format("%.2n", $registro["precounitario"])  ?></li>
                </ul>
            <?php } ?>
        </div>
    </main>

    <?php include_once("./_incluir/rodape.php") ?>
</body>

</html>

<?php
// Fechar conexao
mysqli_close($conecta);
?>