<?php
session_start();
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codmedida']))
    $codcliente = $_GET['codmedida'];

    if (isset($_GET['codmedida'])) {
        $codmedida = $_GET['codmedida'];  // Corrigido para $codpneu
    
        if (isset($_POST['confirm'])) {
            try {
                $sql = "DELETE FROM tb_medidas WHERE codmedida = :codmedida";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':codmedida', $codmedida, PDO::PARAM_INT);
                $stmt->execute();
                $message = "Registro excluído com sucesso!";
                $messageType = "success";
                header("refresh:2;url=consulta-med.php");
                exit;
            } catch (PDOException $e) {
                $message = "Erro ao excluir o registro: " . $e->getMessage();
                $messageType = "danger";
            }
        } else {
            try {
                $sql = "SELECT * FROM tb_medidas WHERE codmedida = :codmedida";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':codmedida', $codmedida, PDO::PARAM_INT);
                $stmt->execute();
                $tb_medidas = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$tb_medidas) {
                    $message = "Registro não encontrado.";
                    $messageType = "danger";
                }
            } catch (PDOException $e) {
                $message = "Erro ao buscar registro: " . $e->getMessage();
                $messageType = "danger";
            }
        }
    } else {
        header('Location: consulta-med.php');
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
    <h2>Excluir Medida</h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>" role="alert">
            <?php echo $message; ?>
            <?php if ($messageType == 'success'): ?>
                <p>Você será redirecionado em 2 segundos...</p>
            <?php else: ?>
                <a href="consulta-med.php" class="btn btn-secondary mt-2">Voltar</a>
            <?php endif; ?>
        </div>
    <?php elseif (isset($tb_medidas)): ?>
        <div class="alert alert-warning" role="alert">
            Tem certeza que deseja excluir o grupo <strong><?php echo htmlspecialchars($tb_medidas['codmedida']); ?></strong>?
        </div>
        <form method="post" action="">
            <button type="submit" name="confirm" class="btn btn-danger">Confirmar Exclusão</button>
            <a href="consulta-med.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Registro não encontrado.
            <a href="consulta-med.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>