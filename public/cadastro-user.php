<?php
include "../app/functions/database/conect.php"; // Assumindo que você já criou uma função de conexão PDO
session_start();

$pdo = conect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./assets/css/register.css">
    <link rel="shortcut icon" href="./assets/icon/logoamazonia.ico" type="image/x-icon">
    <script>
      function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        if (password !== confirmPassword) {
          document.getElementById('passwordError').innerText = 'As senhas não coincidem!';
          return false;
        }
        document.getElementById('passwordError').innerText = '';
        return true;
      }
    </script>
</head>
<body>
<img src="../public/assets/image/logoamazonia.png" class="logoamazonia">

<div class="login-card-user">
  <div class="card-header">
    <h1>Cadastro</h1>
  </div>
  <div class="card-body">
    <form method="post" onsubmit="return validatePassword()">
      <div class="form-group-row">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" id="nome" name="nome" required="">
        </div>

        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="number" id="cpf" name="cpf" required="">
        </div>
      </div>

      <div class="form-group-row">
        <div class="form-group">
          <label for="fone">Telefone</label>
          <input type="number" id="fone" name="fone" required="">
        </div>

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" required="">
        </div>
      </div>

      <div class="form-group-row">
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" id="password" name="senha" required="">
        </div>

        <div class="form-group">
          <label for="confirm_password">Repetir Senha</label>
          <input type="password" id="confirm_password" name="confirm_senha" required="">
          <span id="passwordError" class="error-message"></span>
        </div>
      </div>

      <div class="form-group-row">
        <div class="form-group">
          <label for="datanasc">Data de Nascimento</label>
          <input type="date" id="datanasc" name="datanasc" required="">
        </div>

        <div class="form-group">
          <label for="rua">Rua</label>
          <input type="text" id="rua" name="rua" required="">
        </div>
      </div>

      <div class="form-group-row">
        <div class="form-group">
          <label for="bairro">Bairro</label>
          <input type="text" id="bairro" name="bairro" required="">
        </div>

        <div class="form-group">
          <label for="ncasa">N° Casa</label>
          <input type="number" id="ncasa" name="ncasa" required="">
        </div>
      </div>

      <div class="form-group">
        <label for="complemento">Complemento</label>
        <input type="text" id="complemento" name="complemento" required="">
      </div>

      <div class="form-group">
        <button type="submit" class="login-button" name="btnAdd">Cadastrar</button>
      </div>

      <div class="cadastrolinkdiv">
        <a>Já possui cadastro</a>
        <a href="index.php" class="linkcadastrolog">Entrar</a>
      </div>

    </form>
  </div>
</div>

</body>
</html>

<?php
if (isset($_POST['btnAdd'])) {
    $nome = $_POST['nome'];
    $rua = $_POST['rua'];
    $cpf = $_POST['cpf'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $confirm_senha = md5($_POST['confirm_senha']);
    $datanasc = $_POST['datanasc'];
    $ncasa = $_POST['ncasa'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];

    // Verifica se a senha e a confirmação são iguais antes de inserir no banco
    if ($senha === $confirm_senha) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_clientes (nome, rua, cpf, fone, email, senha, datanasc, ncasa, bairro, complemento) VALUES (:nome, :rua, :cpf, :fone, :email, :senha, :datanasc, :ncasa, :bairro, :complemento)");
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
            $stmt->execute();
            echo '<div class="echoadd">Usuário adicionado com sucesso!</div>';
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo '<div class="echoadd">senhas não coincidem!</div>';
    }
}
?>
</div>

</body>
</html>
