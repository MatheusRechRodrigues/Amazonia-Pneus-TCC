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

<!-- tres riscosdo menu side-bar -->
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
            <li><a href="" class="menu-letters">Início</a></li>
            <li><a href="about.php" class="menu-letters">Sobre</a></li>
            <li><a href="about.php" class="menu-letters">Pneus</a></li>
            <li><a href="about.php" class="menu-letters">Contato</a></li>

        </ul>

    </nav>

    <a href="cart.php"><img src="../assets/icon/cart.png" alt="" class="icon-cart"></a>

    <img src="../assets/icon/icon.png" alt="" class="icon-profile">        


    <section class="container">
	<div class="slider-wrapper">
		<div class="slider">
			<img id="slide-1" src="" alt="" />
			<img id="slide-2" src="" alt="" />
			<img id="slide-3" src="" alt="" />
		</div>
		<div class="slider-nav">
			<a href="#slide-1"></a>
			<a href="#slide-2"></a>
			<a href="#slide-3"></a>
		</div>
	</div>
</section>
 <div class="produtos-div">
<?php
// Supondo que você já tenha uma consulta que retorna pneus
$pneus = [
    [
        'codpneu' => 5,
        'nomepneu' => 'Pneu A',
        'descricao' => 'Pneu de alta performance para carros.',
        'preco' => 299.99
    ],
    [
        'codpneu' => 6,
        'nomepneu' => 'Pneu B',
        'descricao' => 'Pneu resistente para caminhões.',
        'preco' => 399.99
    ],
    [
      'codpneu' => 7,
      'nomepneu' => 'Pneu C',
      'descricao' => 'Pneu de alta durabilidade para caminhões.',
      'preco' => 499.99
  ]
    // Adicione mais pneus conforme necessário
];

foreach ($pneus as $pneu) {
    ?>
   
      
   <div class="produtos_container">
    <?php foreach ($pneus as $pneu) { ?>
        <div class="produto_card">
            <h3 class="produto_nome"><?php echo $pneu['nomepneu']; ?></h3>
            <p class="produto_descricao"><?php echo $pneu['descricao']; ?></p>
            <span class="produto_valor">R$ <?php echo number_format($pneu['preco'], 2, ',', '.'); ?></span>
            <form action="add-carrinho.php" method="post">
                <input type="hidden" name="id_pneu" value="<?php echo $pneu['codpneu']; ?>">
                <button type="submit">Adicionar ao Carrinho</button>
            </form>
        </div>
    <?php } ?>
</div>
    <?php
}
?>


<article class="part-inicio1"> 
    
</article>



<article class="part-inicio2">

</article>







</body>

</html>