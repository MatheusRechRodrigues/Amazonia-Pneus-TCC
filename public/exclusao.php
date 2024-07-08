<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conect();
$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar se o formulário de confirmação foi submetido
    if (isset($_POST['confirm'])) {
        try {
            $sql = "DELETE FROM tb_grupo WHERE idgrupo = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Registro excluído com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=congrupo.php");
        } catch (PDOException $e) {
            $message = "Erro ao excluir registro: " . $e->getMessage();
            $messageType = "danger";
        }
    } else {
        // Obter os detalhes do registro para exibir na mensagem de confirmação
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
} else {
    header('Location: congrupo.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Excluir Grupo</title>

  
</head>
<body>
<div class="container mt-5">
    <h2>Excluir Grupo</h2>
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
        <div class="alert alert-warning" role="alert">
            Tem certeza que deseja excluir o grupo <strong><?php echo htmlspecialchars($grupo['descricao']); ?></strong>?
        </div>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="confirm" class="btn btn-danger">Confirmar Exclusão</button>
            <a href="congrupo.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Registro não encontrado.
            <a href="congrupo.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    <?php endif; ?>
</div>


</body>
</html>