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


<!--  PARTE DO ADM LOGADO  -->

<?php

    if (!empty($_SESSION) && $_SESSION['tipo'] == 'A' && empty($_SESSION['tipo'] == '')) //tela pro adm, somente o adm vai ter acesso a links aq
    { ?>
        <!-- tudo do html pro adm -->

        <div class="adm-div">

            <ul class="links-adm">
                <li> <a href="../consulta-user.php" class="menu-letters-adm">CLIENTES</a></li>
                <li> <a href="../consulta-pneu.php" class="menu-letters-adm">PNEUS</a></li>
                <li> <a href="../consulta-img.php" class="menu-letters-adm">IMAGENS</a></li>
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

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>





    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .carousel {
            position: relative;
            max-width: 600px; /* Largura máxima do carrossel */
            margin: auto;
            overflow: hidden; /* Oculta imagens fora do container */
            border-radius: 10px; /* Bordas arredondadas */
        }

        .carousel img {
            width: 100%; /* Faz a imagem ocupar toda a largura do container */
            border-radius: 10px; /* Bordas arredondadas nas imagens */
            display: none; /* Inicialmente, todas as imagens estão ocultas */
        }

        .active {
            display: block; /* Mostra a imagem ativa */
        }
    </style>

<div class="carousel">
    <img src="https://via.placeholder.com/600x300/FF5733/FFFFFF?text=Imagem+1" alt="Imagem 1" class="active">
    <img src="https://via.placeholder.com/600x300/33FF57/FFFFFF?text=Imagem+2" alt="Imagem 2">
    <img src="https://via.placeholder.com/600x300/3357FF/FFFFFF?text=Imagem+3" alt="Imagem 3">
    <img src="https://via.placeholder.com/600x300/FFFF33/000000?text=Imagem+4" alt="Imagem 4">
</div>

<script>
    let index = 0;
    const images = document.querySelectorAll('.carousel img');

    function showNextImage() {
        images[index].classList.remove('active'); // Remove a classe "active" da imagem atual
        index = (index + 1) % images.length; // Avança para a próxima imagem, voltando ao início se necessário
        images[index].classList.add('active'); // Adiciona a classe "active" à próxima imagem
    }

    // Muda a imagem a cada 3 segundos
    setInterval(showNextImage, 3000);
</script>











</body>

</html>