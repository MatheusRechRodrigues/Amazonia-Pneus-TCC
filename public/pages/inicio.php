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
 




<?php

if (!empty($_SESSION) && $_SESSION['tipo'] == 'a' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq

{?> 
<!-- tudo do html pro adm -->
 <a href="../consulta.php">admin</a>


<?php  
}


else{ //tela pro user, coisas que o usuario vai ter
    ?>

<?php  
}
?>

</body>
</html>