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
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/cadastrostyle.css" >
</head>
<body> 
 

<!-- formulario de login -->
<div class="login-card">
  <div class="card-header">
    <h1>ADICIONAR PNEUS</h1>
  </div>
  <div class="card-body">
    <form method="post">                                            
    
        <div class="form-group">
            <label for="text">Nome Pneu:</label>
            <input type="text" id="nomepneu" name="nomepneu" required="">
          </div>

         
          <div class="form-group">
            <label for="text">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required="">
          </div>
        
        
          <div class="form-group">
            <label for="text">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required="">
          </div>
        
        
        
        <div class="form-group">
        <label for="text">Preço:</label>
        <input type="number" id="preco" name="preco" required="">
      </div>
     
     
     

     
<!--  acaba aq os input, pra baixo botões   -->


      <div class="form-group">
        <button type="submit" class="login-button" name="btnAdd">Cadastrar Pneu</button>
        <a href="../pages/inicio.php"></a>
      </div>
     
     




   

    </form>
  </div>
</div>

<img src="../public/assets/image/logoamazonia.png" class="logoamazonia">
<?php
if (isset($_POST['btnAdd'])) {
    
    $nomepneu = $_POST['nomepneu'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'];
    
   
    
    if (!empty($nomepneu && $descricao && $tipo && $preco )) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_pneus (nomepneu,descricao,tipo,preco) VALUES (:nomepneu,:descricao,:tipo,:preco)");
            $stmt->bindParam(':nomepneu', $nomepneu);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':preco', $preco);
            $stmt->execute();
           
            
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Descrição não pode ser vazia!";
    }
}
?>

<button class="containerconsultavoltar">
                <a href="consulta-pneu.php">Voltar</a>
           </button>

</body>
</html>