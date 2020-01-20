<?php require_once("../../conexao/conexao.php"); ?>
<?php

session_start(); // Toda página que trabalha com variáveis de sessão deve conter essa função

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Curso PHP FUNDAMENTAL</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/login.css">
</head>

<body>
    <header>
        <div id="header_central">
            <img src="assets/logo_andes.gif">
            <img src="assets/text_bnwcoffee.gif">
        </div>
    </header>

    <main>
        <div id="janela_login">
            <form action="login.php" method="post">
                <h2>Login</h2>
                <?php
                if (isset($_POST["submit"])) {
                    $query = "select * from clientes where usuario =  '{$_POST["login"]}' and senha  = '{$_POST["pass"]}'";
                    $resultado = mysqli_query($conecta, $query);
                    // print_r($query);
                    if (!$resultado) {
                        die("Falha na consulta ao banco");
                    } 
                    $registro = mysqli_fetch_assoc($resultado);
                    if (empty($registro)) {
                        echo "<p>Login sem sucesso</p>";
                    } else{
                        $_SESSION["user_portal"] = $registro["clienteID"];
                        header("location:listagem.php");
                    }
                }
                ?>
                <input type="text" name="login" placeholder="Username" required>
                <input type="password" name="pass" placeholder="Password" required>
                <input type="submit" name="submit" value="Sign in">
            </form>
        </div>
    </main>

    <footer>
        <div id="footer_central">
            <p>ANDES &eacute; uma empresa fict&iacute;cia, usada para o curso PHP Integra&ccedil;&atilde;o com MySQL.</p>
        </div>
    </footer>
</body>

</html>

<?php
// Fechar conexao
mysqli_close($conecta);
?>