<?php
include '../../app/functions/database/conect.php'; 

$pdo = conect();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/cadastrostyle.css" >
</head>
<body> 
 

<!-- formulario de login -->
<div class="login-card">
  <div class="card-header">
    <h1>CADASTRO DE ADM</h1>
  </div>
  <div class="card-body">
    <form method="post">                                            
    <label class="n1">
        <div class="form-group">
            <label for="text">Nome</label>
            <input type="text" id="text" name="nome" required="">
          </div>

         
          <div class="form-group">
            <label for="text">Cpf</label>
            <input type="number" id="text" name="cpf" required="">
          </div>
          </label>
        
          <label class="n2">
          <div class="form-group">
            <label for="text">Telefone</label>
            <input type="number" id="text" name="fone" required="">
          </div>
        
        
        
        <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required="">
      </div>
      </label>
     
     <label class="n3">
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="senha" required="">
      </div>
      
      
      
     
      <div class="form-group">
        <label for="date">Data de Nascimento</label>
        <input type="date" id="date" name="datanasc" required="">
      </div>
      </label>



      <div class="form-group">
            <label for="text">Rua</label>
            <input type="text" id="text" name="rua" required="">
          </div>



          
          <div class="form-group">
            <label for="text">Bairro</label>
            <input type="text" id="text" name="bairro" required="">
          </div>
          
          

          
          <div class="form-group">
            <label for="text">N° Casa</label>
            <input type="number" id="text" name="ncasa" required="">
          </div>
          



          <div class="form-group">
            <label for="text">Complemento</label>
            <input type="text" id="text" name="complemento" required="">
          </div>




          <div class="form-group">
    <label>Tipo</label>
    <div>
        <label>
            <input type="radio" id="adm" name="tipo" value="a">
            Adm
        </label>
        <label>
            <input type="radio" id="cliente" name="tipo" value="c">
            Cliente
        </label>
    </div>
</div>
     
<!--  acaba aq os input, pra baixo botões   -->


      <div class="form-group">
        <button type="submit" class="login-button" name="btnAdd">Cadastrar</button>
        <a href="../pages/inicio.php"></a>
      </div>
     
     




      

    </form>
  </div>
</div>

<img src="../assets/image/logoamazonia.png" class="logoamazonia">
<div class="mensagem-banco">
<?php
if (isset($_POST['btnAdd'])) {
    
    $nome = $_POST['nome'];
    $rua = $_POST['rua'];
    $cpf = $_POST['cpf'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $datanasc = $_POST['datanasc'];
    $ncasa = $_POST['ncasa'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $tipo = $_POST['tipo'];
    
    
    // colocar os bagui aq   //
    
    if (!empty($nome && $cpf && $fone && $email && $senha && $datanasc && $ncasa && $bairro && $complemento && $tipo)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_clientes (nome,rua,cpf,fone,email,senha,datanasc,ncasa,bairro,complemento,tipo) VALUES (:nome,:rua,:cpf,:fone,:email,:senha,:datanasc,:ncasa,:bairro,:complemento,:tipo)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':fone', $fone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':datanasc', $datanasc);
            $stmt->bindParam(':ncasa', $ncasa);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
            echo ' <div class="echoadd">Adm adicionado com sucesso!</div>';
            
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