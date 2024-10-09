<?php
session_start();
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codcidade']))
    $codcidade = $_GET['codcidade'];

    if (isset($_GET['codcidade'])) {
        $codcidade = $_GET['codcidade'];  
    
        if (isset($_POST['confirm'])) {
            try {
                $sql = "DELETE FROM tb_cidades WHERE codcidade = :codcidade";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':codcidade', $codcidade, PDO::PARAM_INT);
                $stmt->execute();
                $message = "Registro excluído com sucesso!";
                $messageType = "success";
                header("refresh:2;url=consulta-city.php");
                exit;
            } catch (PDOException $e) {
                $message = "Erro ao excluir o registro: " . $e->getMessage();
                $messageType = "danger";
            }
        } else {
            try {
                $sql = "SELECT * FROM tb_cidades WHERE codcidade = :codcidade";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':codcidade', $codcidade, PDO::PARAM_INT);
                $stmt->execute();
                $tb_cidades = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$tb_cidades) {
                    $message = "Registro não encontrado.";
                    $messageType = "danger";
                }
            } catch (PDOException $e) {
                $message = "Erro ao buscar registro: " . $e->getMessage();
                $messageType = "danger";
            }
        }
    } else {
        header('Location: consulta-city.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cidade</title>
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
    <h2>Excluir Cidade</h2>
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>" role="alert">
            <?php echo $message; ?>
            <?php if ($messageType == 'success'): ?>
                <p>Você será redirecionado em 2 segundos...</p>
            <?php else: ?>
                <a href="consulta-city.php" class="btn btn-secondary mt-2">Voltar</a>
            <?php endif; ?>
        </div>
    <?php elseif (isset($tb_cidades)): ?>
        <div class="alert alert-warning" role="alert">
            Tem certeza que deseja excluir o grupo <strong><?php echo htmlspecialchars($tb_cidades['codcidade']); ?></strong>?
        </div>
        <form method="post" action="">
            <button type="submit" name="confirm" class="btn btn-danger">Confirmar Exclusão</button>
            <a href="consulta-city.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Registro não encontrado.
            <a href="consulta-city.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>