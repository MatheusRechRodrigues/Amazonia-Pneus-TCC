<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codcidade']))
    $codcidade = $_GET['codcidade'];

// Verificar se o formulário de atualização foi submetido
if (isset($_POST['update'])) {
    $estado = $_POST['estado'];
    $nome = $_POST['nome'];
    


    if ( !empty($estado) && !empty($nome)) {
        try {
            $sql = "UPDATE tb_cidades SET estado = :estado, nome = :nome WHERE codcidade = :codcidade";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codcidade', $codcidade, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            
            
            $stmt->execute();
            $message = "Registro alterado com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=consulta-city.php");
        } catch (PDOException $e) {
            $message = "Erro ao atualizar registro: " . $e->getMessage();
            $messageType = "danger";
        }
    } else {
        $message = "Descrição não pode ser vazia!";
        $messageType = "danger";
    }
} else {
    // Obter os detalhes do registro para preencher o formulário de atualização
    try {
        $sql = "SELECT * FROM tb_cidades WHERE codcidade = :codcidade";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codcidade', $codcidade, PDO::PARAM_INT);
        $stmt->execute();
        $tb_cidades = $stmt->fetch(PDO::FETCH_ASSOC);


        
    } catch (PDOException $e) {
        $message = "Erro ao buscar registro: " . $e->getMessage();
        $messageType = "danger";
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Cidades</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">
    <link rel="shortcut icon" href="./assets/icon/logoamazonia.ico" type="image/x-icon">

</head>

<body>
    <header>
        <div class="menubar">

        </div>
        <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
    </header>
    <div class="containeralter">

        <h2>Alterar Cidade</h2>
        <?php if ($message) : ?>
            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                <?php echo $message; ?>
                <?php if ($messageType == 'success') : ?>
                    <p>Você será redirecionado em 2 segundos...</p>
                <?php else : ?>
                    <a href="consulta-city.php" class="btn btn-secondary mt-2">Voltar</a>
                <?php endif; ?>
            </div>
        <?php elseif (isset($tb_cidades)) : ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="<?php echo htmlspecialchars($tb_cidades['estado']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($tb_cidades['nome']); ?>" required>

                </div>
                


                <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                <a href="consulta-city.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Registro não encontrado.
                <a href="consulta-city.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>