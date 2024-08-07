<?php
include '../../app/functions/database/conect.php'; 

$pdo = conect();
session_start();

// Defina a constante para o administrador
define('ADMIN_EMAIL', 'matheusadm@gmail.com'); // Substitua pelo email do administrador
define('ADMIN_PASSWORD_HASH', md5('admamazonia')); // pass: admamazonia

// Verifica se os dados do formulário foram enviados
if (empty($_POST) || empty($_POST["email"]) || empty($_POST["senha"])) {
    echo "<script>location.href='index.php';</script>";
    exit();
}

// Variáveis recebendo o valor digitado no formulário
$email = $_POST["email"];
$senha = md5($_POST["senha"]); // Aplica o hash MD5 à senha fornecida



// Verifica se o login é do administrador
if ($email === ADMIN_EMAIL && $senha === ADMIN_PASSWORD_HASH) {
    $_SESSION["email"] = $email;
    $_SESSION["nome"] = 'Matheus'; // Nome do administrador
    $_SESSION["tipo"] = 'a'; // Tipo de usuário

    echo "<script>alert('Logado como Administrador!!');</script>";
    echo "<script>location.href='../pages/inicio.php';</script>"; // Redirecionar para o painel de administração
    exit();
}

// Consulta para verificar o usuário normal
$sql = "SELECT * FROM tb_clientes WHERE email = :email AND senha = :senha";
$res = $pdo->prepare($sql);
$res->execute(array(':email' => $email, ':senha' => $senha));

// Obtém a quantidade de linhas retornadas pela consulta
$qtd = $res->rowCount();


if ($qtd > 0) {
    // Se encontrou um usuário, define as variáveis de sessão e redireciona para o início
    $row = $res->fetch(PDO::FETCH_ASSOC);
    $_SESSION["email"] = $email;
    $_SESSION["nome"] = $row['nome'];
    $_SESSION["tipo"] = $row['tipo'];

    echo "<script>alert('Logado!!');</script>";
    echo "<script>location.href='../pages/inicio.php';</script>";
} else {
    // Se não encontrou usuário, exibe mensagem de erro e redireciona para a página inicial
    echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
    echo "<script>location.href='../index.php';</script>";
}
?>
