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



<?php

if (!empty($_SESSION) && $_SESSION['tipo'] == 'a' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq

{?> 
<!-- tudo do html pro adm -->

<a  href="../consulta.php">CONSULTA</a>

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