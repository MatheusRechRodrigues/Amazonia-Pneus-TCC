
<?php
include '../../app/functions/database/conect.php'; 
session_start();
$pdo = conect();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/crudstyle.css">
    <link rel="stylesheet" href="../assets/css/itens.css">
    <title>Document</title>
</head>
<body>
<header>
    <!-- parte do menu, colocar em todos -->

    <header>
        <div class="menubar">



        </div>

        <img src="../assets/image/bandaglogo.png" alt="" class="circleyellow">
    </header>

<!-- tres riscos do menu side-bar -->
    <label class="popup">
  <input type="checkbox">
  <div class="burger" tabindex="0">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav class="popup-window">   
    <ul>
      
    <h3 class="nome-menu"> Menu</h3>
    <article class="line-grey"></article>
    <li>
        <button>       
          <span class="linkside">Colaboradores</span>
        </button>
      </li>
      <li>
        <button>  
          <span class="linkside">Desenvolvimento</span>
        </button>
      </li>
      <li>
        
        <button>  
          <span class="linkside">Onde Ficamos</span>
        </button>
      </li> 
      <li>
        <button>  
          <span class="linkside">Contato</span>
        </button>
      </li>
      <?php

if (!empty($_SESSION) && $_SESSION['tipo'] == 'A' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq
{ ?>
    <!-- tudo do html pro adm -->

<h3 class="nome-menu">Gerenciar Dados </h3>
<article class="line-grey"></article>

      <li>
    <button onclick="window.location.href='../consulta-med.php'">
        <span class="linkside">Medidas</span>
    </button>
</li>

<li>
    <button onclick="window.location.href='../consulta-user.php'">
        <span class="linkside">Cliente</span>
    </button>
</li>

<li>
    <button onclick="window.location.href='../consulta-pneu.php'">
        <span class="linkside">Pneus</span>
    </button>
</li>

<li>
    <button onclick="window.location.href='../consulta-img.php'">
        <span class="linkside">Imagens</span>
    </button>
</li>

<li>
    <button onclick="window.location.href='../consulta-compra.php'">
        <span class="linkside">Compras</span>
    </button>
</li>

<li>
    <button onclick="window.location.href='../consulta-city.php'">
        <span class="linkside">Cidades</span>
    </button>
</li>

    
<?php


} else { //tela pro user, coisas que o usuario vai ter
    ?>
<?php
}
?>

<img src="../assets/image/logoamazonia.png" class="img-menu-lado">
  </nav>
</label>







<nav class="navbar">

<ul class="nav-links1">
    <li><a href="inicio.php" class="menu-letters">Início</a></li>
    <li><a href="about.php" class="menu-letters">Sobre</a></li>
    <li><a href="about.php" class="menu-letters">Pneus</a></li>
    <li><a href="about.php" class="menu-letters">Contato</a></li>

</ul>

</nav>

<a href="carrinho.php"><img src="../assets/icon/cart.png" alt="" class="icon-cart"></a>

<img src="../assets/icon/icon.png" alt="" class="icon-profile">        

<?php

$codpneu = isset($_GET['codpneu']) ? (int)$_GET['codpneu'] : 0;


$sql = "
    SELECT p.codpneu, p.nomepneu, p.descricao, p.preco, i.url 
    FROM tb_pneus p
    INNER JOIN tb_imagens i ON p.codpneu = i.codpneu
    WHERE p.codpneu = :codpneu
";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':codpneu', $codpneu, PDO::PARAM_INT);
$stmt->execute();


$pneu = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Estilos para o layout da página do produto -->


<div class="produto_container">
    <?php if ($pneu) { ?>
        
        <div class="produto_info">
            <h1 class="produto_nome"><?php echo htmlspecialchars($pneu['nomepneu']); ?></h1>
            <p class="produto_descricao"><?php echo htmlspecialchars($pneu['descricao']); ?></p>
            <span class="produto_valor">R$ <?php echo number_format($pneu['preco'], 2, ',', '.'); ?></span>
            
            <form action="add-carrinho.php" method="post">
                <input type="hidden" name="id_pneu" value="<?php echo htmlspecialchars($pneu['codpneu']); ?>">
                <button type="submit" class="btn-carrinho">Adicionar ao Carrinho</button>
            </form>
        </div>

        <img class="produto_imagem" src="<?php echo htmlspecialchars($pneu['url']); ?>" alt="Imagem do <?php echo htmlspecialchars($pneu['nomepneu']); ?>">
    <?php } else { ?>
        <p>Produto não encontrado.</p>
    <?php } ?>
</div>







<article class="line-division"></article>
<div class="division-text-information">a </div>




    

</article>



</body>
</html>
