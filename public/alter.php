<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['id'])) 
    $id = $_GET['id'];

    // Verificar se o formulário de atualização foi submetido
    if (isset($_POST['update'])) 
        $codcliente = $_POST['codcliente'];
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
        $codcidade = $_POST['codcidade'];
       

        if (!empty($descricao)) {
            try {
                $sql = "UPDATE tb_clientes SET nome = :nome WHERE idgrupo = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
                $stmt->execute();
                $message = "Registro atualizado com sucesso!";
                $messageType = "success";
                // Redireciona após 2 segundos
                header("refresh:2;url=congrupo.php");
            } catch (PDOException $e) {
                $message = "Erro ao atualizar registro: " . $e->getMessage();
                $messageType = "danger";
            }
        } else {
            $message = "Descrição não pode ser vazia!";
            $messageType = "danger";
        }
     else {
        // Obter os detalhes do registro para preencher o formulário de atualização
        try {
            $sql = "SELECT * FROM tb_grupo WHERE idgrupo = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $grupo = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = "Erro ao buscar registro: " . $e->getMessage();
            $messageType = "danger";
        }
    }
 else {
    header('Location: congrupo.php');
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
                <a href="congrupo.php" class="btn btn-secondary mt-2">Voltar</a>
            <?php endif; ?>
        </div>
    <?php elseif (isset($grupo)): ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo htmlspecialchars($grupo['descricao']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
            <a href="congrupo.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Registro não encontrado.
            <a href="congrupo.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    <?php endif; ?>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>