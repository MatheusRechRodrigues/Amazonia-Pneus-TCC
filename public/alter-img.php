<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codimg']))
    $codimg = $_GET['codimg'];

// Verificar se o formulário de atualização foi submetido
if (isset($_POST['update'])) {
    $nomeimg = $_POST['nomeimg'];
    $url = $_POST['url'];
    $codpneu = $_POST['codpneu'];

    if (!empty($nomeimg) && !empty($url) && !empty($codpneu)) {
        try {
            $sql = "UPDATE tb_imagens SET nomeimg = :nomeimg, url = :url, codpneu = :codpneu WHERE codimg = :codimg";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codimg', $codimg, PDO::PARAM_INT);
            $stmt->bindParam(':nomeimg', $nomeimg, PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':codpneu', $codpneu, PDO::PARAM_INT);

            $stmt->execute();
            $message = "Registro alterado com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=consulta-img.php");
        } catch (PDOException $e) {
            $message = "Erro ao atualizar registro: " . $e->getMessage();
            $messageType = "danger";
        }
    } else {
        $message = "Todos os campos devem ser preenchidos!";
        $messageType = "danger";
    }
} else {
    // Obter os detalhes do registro para preencher o formulário de atualização
    try {
        $sql = "SELECT * FROM tb_imagens WHERE codimg = :codimg";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codimg', $codimg, PDO::PARAM_INT);
        $stmt->execute();
        $tb_imagens = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Alterar Imagens</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">
</head>

<body>
    <header>
        <div class="menubar">

        </div>
        <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
    </header>
    <div class="containeralter">

        <h2>Alterar Imagem</h2>
        <?php if ($message) : ?>
            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                <?php echo $message; ?>
                <?php if ($messageType == 'success') : ?>
                    <p>Você será redirecionado em 2 segundos...</p>
                <?php else : ?>
                    <a href="consulta-img.php" class="btn btn-secondary mt-2">Voltar</a>
                <?php endif; ?>
            </div>
        <?php elseif (isset($tb_imagens)) : ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="nome">Nome da Imagem:</label>
                    <input type="text" class="form-control" id="nomeimg" name="nomeimg" value="<?php echo htmlspecialchars($tb_imagens['nomeimg']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="text" class="form-control" id="url" name="url" value="<?php echo htmlspecialchars($tb_imagens['url']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="codpneu">Pneu Relacionado:</label>
                    <input type="number" class="form-control" id="codpneu" name="codpneu" value="<?php echo htmlspecialchars($tb_imagens['codpneu']); ?>" required>
                </div>

                <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                <a href="consulta-img.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Registro não encontrado.
                <a href="consulta-img.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
