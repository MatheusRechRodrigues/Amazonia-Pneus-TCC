<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codcliente'])) 
    $codcliente = $_GET['codcliente'];

    // Verificar se o formulário de atualização foi submetido
    if (isset($_POST['update'])) {
        $nome = $_POST['nome'];
        $rua = $_POST['rua'];
        $cpf = $_POST['cpf'];
        $fone = $_POST['fone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $datanasc = $_POST['datanasc'];
        $ncasa = $_POST['ncasa'];
        $bairro = $_POST['bairro'];
        $complemento = $_POST['complemento'];
        $tipo = $_POST['tipo'];
        $ativo = $_POST['ativo'];
       

        if (!empty($nome) && !empty($rua) && !empty($cpf) && !empty($fone) && !empty($email) && !empty($senha) && !empty($datanasc) &&  !empty($ncasa) && !empty($bairro) && !empty($complemento) && !empty($tipo) && !empty($ativo) &&  ) {
            try {
                $sql = "UPDATE tb_clientes SET nome = :nome, rua = :rua, cpf = :cpf, fone = :fone, email = :email, senha = :senha, datanasc = :datanasc, ncasa = :ncasa, bairro = :bairro, complemento = :complemento, tipo = :tipo, ativo = :ativo WHERE codcliente = :codcliente";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':codcliente', $codcliente, PDO::PARAM_INT);
                $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
                $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                $stmt->bindParam(':fone', $fone, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
                $stmt->bindParam(':datanasc', $datanasc, PDO::PARAM_STR);
                $stmt->bindParam(':ncasa', $ncasa, PDO::PARAM_STR);
                $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
                $stmt->bindParam(':complemento', $complemento, PDO::PARAM_STR);
                $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                $stmt->bindParam(':ativo', $ativo, PDO::PARAM_STR);
                $stmt->execute();
                $message = "Registro alterado com sucesso!";
                $messageType = "success";
                // Redireciona após 2 segundos
                header("refresh:2;url=consulta.php");
            } catch (PDOException $e) {
                $message = "Erro ao atualizar registro: " . $e->getMessage();
                $messageType = "danger";
            }
        } else {
            $message = "Descrição não pode ser vazia!";
            $messageType = "danger";
        }
    }
     else {
        // Obter os detalhes do registro para preencher o formulário de atualização
        try {
            $sql = "SELECT * FROM tb_clientes WHERE codcliente = :codcliente";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codcliente', $codcliente, PDO::PARAM_INT);
            $stmt->execute();
            $tb_clientes = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = "Erro ao buscar registro: " . $e->getMessage();
            $messageType = "danger";
        }
        
    }
  else {
    header('Location: consulta.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Alterar Grupo</title>


</head>
<body>
<div class="container mt-5">
    <h2>Alterar Grupo</h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>" role="alert">
            <?php echo $message; ?>
            <?php if ($messageType == 'success'): ?>
                <p>Você será redirecionado em 2 segundos...</p>
            <?php else: ?>
                <a href="consulta.php" class="btn btn-secondary mt-2">Voltar</a>
            <?php endif; ?>
        </div>
    <?php elseif (isset($grupo)): ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo htmlspecialchars($grupo['codcliente']); ?>" required>
                
            </div>
            <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
            <a href="consulta.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Registro não encontrado.
            <a href="consulta.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    <?php endif; ?>
</div>


</body>
</html>