<?php
include "../app/functions/database/conect.php"; // Assumindo que você já criou uma função de conexão PDO
session_start(); //colocar em tudo o session

$pdo = conect();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/icon/logoamazonia.ico" type="image/x-icon">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/cadastrostyle.css" >
</head>
<body> 
 

<!-- formulario de login -->
<div class="login-card-med">
  <div class="card-header">
    <h1>MEDIDAS DO PNEU</h1>
  </div>
  <div class="card-body">
    <form method="post">                                            
    
        <div class="form-group">
            <label for="text">Largura</label>
            <input type="text" id="largura" name="largura" required="">
          </div>

         
          <div class="form-group">
            <label for="text">Aro</label>
            <input type="number" id="aro" name="aro" required="">
          </div>
        
        
          <div class="form-group">
            <label for="text">Medida</label>
            <input type="number" id="medida" name="medida" required="">
          </div>
        
        
        
        <div class="form-group">
        <label for="text">Altura</label>
        <input type="text" id="altura" name="altura" required="">
      </div>
     
     
     
      <div class="form-group">
        <label for="text">Indice de Carga</label>
        <input type="text" id="indicecarga" name="indicecarga" required="">
      </div>
      
      
      
     
      <div class="form-group">
        <label for="text">Velocidade</label>
        <input type="text" id="velocidade" name="velocidade" required="">
      </div>




      <div class="form-group">
            <label for="text" >Construção ( R - C )</label>
            <input type="text" id="construcao" name="construcao" required="">
          </div>



          
          <div class="form-group">
            <label for="text">Raio</label>
            <input type="text" id="raio" name="raio" required="">
          </div>
          
          

          
          

     
<!--  acaba aq os input, pra baixo botões   -->


      <div class="form-group">
        <button type="submit" class="login-button" name="btnAdd">Cadastrar</button>
        <a href="consulta-user.php"></a>
      </div>
     
     




      <div class="cadastrolinkdiv">
    
      <a href="consulta-med.php" class="linkcadastrolog">VOLTAR</a>
      </div>     

    </form>
  </div>
</div>

<img src="../public/assets/image/logoamazonia.png" class="logoamazonia">
<div class="mensagem-banco">
<?php
if (isset($_POST['btnAdd'])) {
    
    $largura = $_POST['largura'];
    $aro = $_POST['aro'];
    $medida = $_POST['medida'];
    $altura = $_POST['altura'];
    $indicecarga = $_POST['indicecarga'];
    $velocidade = $_POST['velocidade'];
    $construcao = $_POST['construcao'];
    $raio = $_POST['raio'];
    
    
    if (!empty($largura && $aro && $medida && $altura && $indicecarga && $velocidade && $construcao && $raio)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_medidas (largura,aro,medida,altura,indicecarga,velocidade,construcao,raio) VALUES (:largura,:aro,:medida,:altura,:indicecarga,:velocidade,:construcao,:raio)");
            $stmt->bindParam(':largura', $largura);
            $stmt->bindParam(':aro', $aro);
            $stmt->bindParam(':medida', $medida);
            $stmt->bindParam(':altura', $altura);
            $stmt->bindParam(':indicecarga', $indicecarga);
            $stmt->bindParam(':velocidade', $velocidade);
            $stmt->bindParam(':construcao', $construcao);
            $stmt->bindParam(':raio', $raio);

            $stmt->execute();
            echo ' <div class="echoadd">Medida adicionada com sucesso!</div>';
            
            echo ' <div class="echoadd"> <br><br><a href="consulta-med.php">VOLTAR</a></div>';
            
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Descrição não pode ser vazia!";
    }
}
?>

</div>




</body>
</html>