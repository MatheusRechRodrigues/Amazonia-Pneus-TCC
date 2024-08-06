
<?php
session_start();
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codcliente'])) {
    $codcliente = $_GET['codcliente'];

    // Verificar se o formulário de confirmação foi submetido
    if (isset($_POST['confirm'])) {
        try {
            $sql = "DELETE FROM tb_clientes WHERE codcliente = :codcliente";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codcliente', $codcliente, PDO::PARAM_INT);
            $stmt->execute();
            $message = "Registro excluído com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=consulta.php");
            exit; // Adiciona exit para garantir que o script não continue
        } catch (PDOException $e) {
            $message = "Erro ao excluir usuário: " . $e->getMessage();
            $messageType = "danger";
        }
    } else {
        // Obter os detalhes do registro para exibir na mensagem de confirmação
        try {
            $sql = "SELECT * FROM tb_clientes WHERE codcliente = :codcliente";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codcliente', $codcliente, PDO::PARAM_INT);
            $stmt->execute();
            $tb_clientes = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$tb_clientes) {
                $message = "Registro não encontrado.";
                $messageType = "danger";
            }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/crudstyle.css" >
</head>
<body>

<header>
    <div class="menubar">
        
    </div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<div class="container mt-5">
    <h2>Excluir Grupo</h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>" role="alert">
            <?php echo $message; ?>
            <?php if ($messageType == 'success'): ?>
                <p>Você será redirecionado em 2 segundos...</p>
            <?php else: ?>
                <a href="consulta.php" class="btn btn-secondary mt-2">Voltar</a>
            <?php endif; ?>
        </div>
    <?php elseif (isset($tb_clientes)): ?>
        <div class="alert alert-warning" role="alert">
            Tem certeza que deseja excluir o grupo <strong><?php echo htmlspecialchars($tb_clientes['codcliente']); ?></strong>?
        </div>
        <form method="post" action="">
            <button type="submit" name="confirm" class="btn btn-danger">Confirmar Exclusão</button>
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