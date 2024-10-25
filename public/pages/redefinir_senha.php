<?php
include '../../app/functions/database/conect.php'; 
$pdo = conect();

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar se o token é válido e ainda não expirou
    $query = "SELECT * FROM tb_clientes WHERE token = ? AND token_expira > NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $token, PDO::PARAM_STR);
    $stmt->execute();
    $clientes = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($clientes) {
        // Se o token for válido, exibe o formulário para redefinir a senha
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nova_senha = $_POST['senha'];
            $confirmar_senha = $_POST['confirmar_senha'];

            if ($nova_senha === $confirmar_senha) {
                // Criptografa a nova senha
                $senha_criptografada = md5($nova_senha);

                // Atualiza a senha no banco de dados e remove o token
                $query = "UPDATE tb_clientes SET senha = :senha, token = NULL, token_expira = NULL WHERE codcliente = :codcliente";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':senha', $senha_criptografada, PDO::PARAM_STR);
                $stmt->bindParam(':codcliente', $clientes['codcliente'], PDO::PARAM_INT);
                $stmt->execute();

                echo "<script>alert('Sua senha foi redefinida com sucesso!');</script>";
                echo "<script>location.href='../index.php';</script>";
            } else {
                echo "As senhas não coincidem. Tente novamente.";
            }
        }
   
    }
} else {
    echo "Token não fornecido!";
}
?>

<!-- Formulário de redefinição de senha -->
<form action="" method="POST">
    <input type="password" name="senha" placeholder="Nova senha" required>
    <input type="password" name="confirmar_senha" placeholder="Confirmar nova senha" required>
    <button type="submit">Redefinir Senha</button>
</form>
