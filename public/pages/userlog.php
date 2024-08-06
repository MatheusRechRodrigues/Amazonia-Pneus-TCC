<?php
include '../../app/functions/database/conect.php'; 

$pdo = conect();

// Usado para iniciar uma sessão
session_start();

// Verifica se os dados do formulário foram enviados
if (empty($_POST) && empty($_POST["email"]) && empty($_POST["senha"])) {
    print "<script>location.href='index.php';</script>";
}

// Variáveis recebendo o valor digitado no formulário
$email = $_POST["email"];
$senha = $_POST["senha"];

// Consulta preparada para selecionar o usuário com o email e senha fornecidos
$sql = "SELECT * FROM tb_clientes WHERE email = :email AND senha = :senha";
$res = $pdo->prepare($sql);
$res->execute(array(':email' => $email, ':senha' => $senha));

// Obtém a quantidade de linhas retornadas pela consulta
$qtd = $res->rowCount();

if ($qtd > 0) {
    // Se encontrou um usuário, define as variáveis de sessão e redireciona para o inicio
    $row = $res->fetch(PDO::FETCH_ASSOC);
    $_SESSION["email"] = $email;
    $_SESSION["nome"] = $row['nome']; // 'nome' é uma chave do resultado da consulta, use aspas simples para acessar
    $_SESSION["tipo"] = $row['tipo'];  //pega o tipo do user

    

    echo "<script>alert('Logado!!');</script>";
    echo "<script>location.href='../pages/inicio.php';</script>";
} else {
    // Se não encontrou usuário, exibe mensagem de erro e redireciona para a página inicial
    echo "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
    echo "<script>location.href='../index.php';</script>";
}
?>
