<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codpneu']))
    $codpneu = $_GET['codpneu'];

// Verificar se o formulário de atualização foi submetido
if (isset($_POST['update'])) {
    $nomepneu = $_POST['nomepneu'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'];
    


    if (!empty($nomepneu) && !empty($descricao) && !empty($tipo) && !empty($preco)) {
        try {
            $sql = "UPDATE tb_pneus SET nomepneu = :nomepneu, descricao = :descricao, tipo = :tipo, preco = :preco WHERE codpneu = :codpneu";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codpneu', $codpneu, PDO::PARAM_INT);
            $stmt->bindParam(':nomepneu', $nomepneu, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            
            $stmt->execute();
            $message = "Registro alterado com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=consulta-pneu.php");
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
        $sql = "SELECT * FROM tb_pneus WHERE codpneu = :codpneu";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codpneu', $codpneu, PDO::PARAM_INT);
        $stmt->execute();
        $tb_pneus = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Alterar Pneus</title>
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

        <h2>Alterar Grupo</h2>
        <?php if ($message) : ?>
            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                <?php echo $message; ?>
                <?php if ($messageType == 'success') : ?>
                    <p>Você será redirecionado em 2 segundos...</p>
                <?php else : ?>
                    <a href="consulta-pneu.php" class="btn btn-secondary mt-2">Voltar</a>
                <?php endif; ?>
            </div>
        <?php elseif (isset($tb_pneus)) : ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="nome">Nome do Pneu:</label>
                    <input type="text" class="form-control" id="nomepneu" name="nomepneu" value="<?php echo htmlspecialchars($tb_pneus['nomepneu']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="rua">Descrição:</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo htmlspecialchars($tb_pneus['descricao']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="cpf">Tipo:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tb_pneus['tipo']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="fone">Preço:</label>
                    <input type="text" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($tb_pneus['preco']); ?>" required>

              

                <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                <a href="consulta-pneu.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Registro não encontrado.
                <a href="consulta-pneu.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>