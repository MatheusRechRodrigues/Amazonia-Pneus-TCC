<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

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
  <!-- body/ troca pro css -->

<!-- formulario de login -->
<div class="login-card">
  <div class="card-header">
    <h1>CADASTRO</h1>
  </div>
  <div class="card-body">
    <form>                                            <!-- pegar todos os name, exemplo: name="text" de cada input e colocar
       em $data = $_POST['data'];-->
    
        <div class="form-group">
            <label for="text">Nome</label>
            <input type="text" id="text" name="nome" required="">
          </div>

         
          <div class="form-group">
            <label for="text">Cpf</label>
            <input type="text" id="text" name="cpf" required="">
          </div>
        
        
          <div class="form-group">
            <label for="text">Telefone</label>
            <input type="text" id="text" name="fone" required="">
          </div>
        
        
        
        <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required="">
      </div>
     
     
     
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="senha" required="">
      </div>
      
      
      
     
      <div class="form-group">
        <label for="date">Data de Nascimento</label>
        <input type="date" id="date" name="datanasc" required="">
      </div>


     
<!--  acaba aq os input, pra baixo botões   -->


      <div class="form-group">
        <button type="submit" class="login-button" name="btnAdd">Cadastrar</button>
      </div>
     
     




      <div class="cadastrolinkdiv">
      <a class="cadastrolog">Já possui cadastro</a>
      <a href="./pages/login.php" class="linkcadastrolog">Entrar</a>
      </div>     

    </form>
  </div>
</div>

<img src="../public/assets/image/logoamazonia.png" >

<?php
if (isset($_POST['btnAdd'])) {
    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $datanasc = $_POST['datanasc'];
    
    // colocar os bagui aq   //
    
    if (!empty($nome && $cpf && $fone && $email && $senha && $datanasc)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_clientes (nome,cpf,fone,email,senha,datanasc) VALUES (:nome,:cpf,:fone,:email,:senha,:datanasc)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':fone', $fone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':datanasc', $datanasc);
            $stmt->execute();
            echo "Grupo adicionado com sucesso!";
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Descrição não pode ser vazia!";
    }
}
?>


</body>
</html>