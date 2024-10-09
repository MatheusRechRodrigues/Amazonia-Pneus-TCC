<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/crudstyle.css">
</head>

<body>

<!-- parte do menu, colocar em todos -->

    <header>
        <div class="menubar">



        </div>

        <img src="../assets/image/bandaglogo.png" alt="" class="circleyellow">
    </header>


    <img src="../assets/icon/menu-row-icon.png" class="menu-row-top-left">

    <nav class="navbar">

        <ul class="nav-links1">
            <li><a href="" class="menu-letters">Início</a></li>
            <li><a href="about.php" class="menu-letters">Sobre</a></li>
            <li><a href="about.php" class="menu-letters">Pneus</a></li>
            <li><a href="about.php" class="menu-letters">Contato</a></li>

        </ul>

    </nav>

    <img src="../assets/icon/cart.png" alt="" class="icon-cart">

    <img src="../assets/icon/icon.png" alt="" class="icon-profile">        


<!--  PARTE DO ADM LOGADO  -->

<?php

    if (!empty($_SESSION) && $_SESSION['tipo'] == 'A' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq
    { ?>
        <!-- tudo do html pro adm -->

        <div class="adm-div">

            <ul class="links-adm">
                <li> <a href="../consulta-user.php" class="menu-letters-adm">CLIENTES</a></li>
                <li> <a href="../consulta-pneu.php" class="menu-letters-adm">PNEUS</a></li>
                <li> <a href="../consulta-user.php" class="menu-letters-adm">IMAGENS</a></li>
                <li> <a href="../consulta-med.php" class="menu-letters-adm">MEDIDAS</a></li>
                <li> <a href="../consulta-city.php" class="menu-letters-adm">CIDADES</a></li>
            </ul>

        </div>
    <?php

    } else { //tela pro user, coisas que o usuario vai ter
        ?>


    <?php
    }
    ?>


<!-- colocar coisas abaixo do menu do adm  -->




<article class="part-inicio1"> </article>

<article class="part-inicio2"></article>




</body>

</html>