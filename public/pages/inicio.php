<?php
session_start();
echo $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
<header class="header-top-menu">
    <div class="circle-yellow-bandai">
    <img src="" alt="">
</div>
</header>
 
<a href="../consulta.php">a</a>
<?php

if (!empty($_SESSION) && $_SESSION['tipo'] == 'a' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq
{ echo "Bem vindo Administrador !" ;}

else{ //tela pro user, coisas que o usuario vai ter
    ?>
<a href="../consulta.php">consulta</a>

<?php  
}
?>

</body>
</html>