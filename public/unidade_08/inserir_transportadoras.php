<?php require_once("../../conexao/conexao.php"); ?>

<?php

$query_estados = "select estadoID, sigla, nome from estados";
$estados = mysqli_query($conecta, $query_estados);

if (!$estados) {
    die("Falha na consulta ao banco");
}

if (isset($_POST["submit"])) {
    $nome = utf8_decode($_POST["nometransportadora"]);
    $endereco = utf8_decode($_POST["endereco"]);
    $telefone = $_POST["telefone"];
    $cidade = utf8_decode($_POST["cidade"]);
    $cep = $_POST["cep"];
    $cnpj = $_POST["cnpj"];
    $estado = $_POST["estado"];

    $insert_transportadora = "insert into transportadoras ( nometransportadora, endereco, telefone, cidade, cep, cnpj, estadoID ) values ( ";
    $insert_transportadora .= " '{$nome}', '{$endereco}' , {$telefone}, '{$cidade}', {$cep}, {$cnpj}, {$estado} )";
    if (mysqli_query($conecta, $insert_transportadora)) {
        $sucesso = true;
    } else {
        $sucesso = false;
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curso PHP INTEGRACAO</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/crud.css" rel="stylesheet">
</head>

<body>
    <?php include_once("_incluir/topo.php"); ?>

    <main>

        <div id="janela_formulario">
            <form action="inserir_transportadoras.php" method="post">
                <h2>Cadastro de transportadora</h2>
                <?php
                if (isset($sucesso)) {
                    if ($sucesso) {
                        echo "<p class='sucesso'>Transportadora cadastrada com sucesso</p>";
                    }
                    else {
                        echo "<p class='fracasso'> Error: " . $insert_transportadora . " " . mysqli_error($conecta) . "</p>";
                    }
                } ?>
                <input type="text" name="nometransportadora" placeholder="Nome da transportadora" required>
                <input type="text" name="endereco" placeholder="Endereço" required>
                <input type="text" name="telefone" placeholder="Telefone" required>
                <input type="text" name="cidade" placeholder="Cidade" required>
                <select name="estado" required>
                    <option value="" selected>Selecione o estado da transportadora</option>
                    <?php while ($resultado_estados = mysqli_fetch_array($estados)) { ?>
                        <option value="<?php echo $resultado_estados[0] ?>" >
                            <?php echo"{$resultado_estados[1]} | " . utf8_encode($resultado_estados[2]) ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="text" name="cep" placeholder="CEP" required>
                <input type="text" name="cnpj" placeholder="CNPJ" required>
                <input type="submit" name="submit" value="Cadastrar">
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