<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/stylelogin.css" >
</head>
<body>

<!-- formulario de login -->
<div class="login-card">
  <div class="card-header">
    <h1>Login</h1>
  </div>
  <div class="card-body">
    <form id="form" action="./pages/userlog.php" method="post">
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required="">
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="senha" required="">
      </div>
      <div class="form-group">
        <button type="submit" class="login-button"><a class="alink">Login</a></button>
      </div>

<div class="forgotlinkdiv">
      <a href="./pages/forgot-password.php" class="linkcadastrolog">Esqueci minha senha</a>
      </div>  


      <div class="cadastrolinkdiv">
      <a class="cadastrolog">Sem conta?</a>
      <a href="cadastro-user.php" class="linkcadastrolog">Cadastre-se</a>
      </div>     

      
    </form>
  </div>
</div>

<img src="../public/assets/image/logoamazonia.png" >



</body>
</html>

