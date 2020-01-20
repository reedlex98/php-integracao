<header>
    <div id="header_central">

        <?php 

        if(isset($_SESSION["user_portal"])){
            $codigo = $_SESSION["user_portal"];

            $pesquisa = "select nomecompleto from clientes where clienteID = '{$codigo}'";

            $result = mysqli_query($conecta, $pesquisa);

            if($result){
                $reg = mysqli_fetch_row($result);
                if(!empty($reg)){
                    echo "<div id=\"header_saudacao\"><h5>Bem vindo, {$reg[0]}</h5><h5><a href='logout.php'>Deslogar</a></h5></div>";
                }
            }
            else {
                die("falha no banco");
            }
        }
        ?>
        <img src="assets/logo_andes.gif">
        <img src="assets/text_bnwcoffee.gif">
    </div>
</header>