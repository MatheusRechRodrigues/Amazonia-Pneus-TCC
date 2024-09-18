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
<header>
        <div class="menubar">



        </div>
        <img src="../assets/image/bandaglogo.png" alt="" class="circleyellow">
    </header>

    <nav class="navbar">
        
        <ul class="nav-links1">
            <li><a href="">Início</a></li>
            <li><a href="">Sobre</a></li>
        </ul>
        <ul class="nav-links2">
            <li><a href="">Serviços</a></li>
            <li><a href="">Contato</a></li>
            
        </ul>
        
    </nav>

<?php

if (!empty($_SESSION) && $_SESSION['tipo'] == 'A' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq

{?> 
<!-- tudo do html pro adm -->

<a  href="../consulta.php" class="buttons-adm">CONSULTA</a>

<br><br><br>
<h1>Olá administrador  </h1>

<?php  
}


else{ //tela pro user, coisas que o usuario vai ter
    ?>
<h1>Bem vindo nobre Cliente</h1>
<?php  
}
?>

</body>
</html>