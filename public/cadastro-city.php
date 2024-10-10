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
    <title>CIDADES</title>
    <link rel="stylesheet" href="./assets/css/cadastrostyle.css" >
</head>
<body> 
 

<!-- formulario de login -->
<div class="login-card-city">
  <div class="card-header">
    <h1>Cadastrar Cidades</h1>
  </div>
  <div class="card-body">
    <form method="post">                                            
    
        <div class="form-group">
            <label for="text">Estado:</label>
            <input type="text" id="estado" name="estado" required="" placeholder="PR-SC-RS">
          </div>

         
          <div class="form-group">
            <label for="text">Nome da Cidade</label>
            <input type="text" id="nome" name="nome" required="">
          </div>
        
        

     
<!--  acaba aq os input, pra baixo botões   -->


      <div class="form-group">
        <button type="submit" class="login-button" name="btnAdd">Cadastrar</button>
        <a href="consulta-city.php"></a>
      </div>
     
     




      <div class="cadastrolinkdiv">
    
      <a href="consulta-city.php" class="linkcadastrolog">VOLTAR</a>
      </div>     

    </form>
  </div>
</div>

<img src="../public/assets/image/logoamazonia.png" class="logoamazonia">
<div class="mensagem-banco">
<?php
if (isset($_POST['btnAdd'])) {
    
    $estado = $_POST['estado'];
    $nome = $_POST['nome'];
    

    
    
    if (!empty($estado && $nome )) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_cidades (estado,nome) VALUES (:estado,:nome)");
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':nome', $nome);
            
            $stmt->execute();
            echo ' <div class="echoadd">Cidade adicionada com sucesso!</div>';
            
            echo ' <div class="echoadd"> <br><br><a href="consulta-city.php">VOLTAR</a></div>';
            
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