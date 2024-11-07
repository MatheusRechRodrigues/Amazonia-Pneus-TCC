<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codcompra']))
    $codcompra = $_GET['codcompra'];

// Verificar se o formulário de atualização foi submetido
if (isset($_POST['update'])) {
    $entregue = $_POST['entregue'];
    $entrega = $_POST['entrega'];
    $codentrega = $_POST['codentrega'];
    $valorentrega = $_POST['valorentrega'];
    $formapagamento = $_POST['formapagamento'];
    $dtcompra = $_POST['dtcompra'];


    if (!empty($entregue) && !empty($entrega) && !empty($codentrega) && !empty($valorentrega) && !empty($formapagamento) && !empty($dtcompra)) {
        try {
            $sql = "UPDATE tb_compras SET entregue = :entregue, entrega = :entrega, codentrega = :codentrega, valorentrega = :valorentrega, formapagamento = :formapagamento, dtcompra = :dtcompra WHERE codcompra = :codcompra";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codcompra', $codcompra, PDO::PARAM_INT);
            $stmt->bindParam(':entregue', $entregue, PDO::PARAM_STR);
            $stmt->bindParam(':entrega', $entrega, PDO::PARAM_STR);
            $stmt->bindParam(':codentrega', $codentrega, PDO::PARAM_INT);
            $stmt->bindParam(':valorentrega', $valorentrega, PDO::PARAM_STR);
            $stmt->bindParam(':formapagamento', $formapagamento, PDO::PARAM_STR);
            $stmt->bindParam(':dtcompra', $dtcompra, PDO::PARAM_STR);

            $stmt->execute();
            $message = "Compra alterada com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=consulta-compra.php");
        } catch (PDOException $e) {
            $message = "Erro ao atualizar compra: " . $e->getMessage();
            $messageType = "danger";
        }
    } else {
        $message = "Todos os campos são obrigatórios!";
        $messageType = "danger";
    }
} else {
    // Obter os detalhes da compra para preencher o formulário de atualização
    try {
        $sql = "SELECT * FROM tb_compras WHERE codcompra = :codcompra";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codcompra', $codcompra, PDO::PARAM_INT);
        $stmt->execute();
        $tb_compras = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $message = "Erro ao buscar compra: " . $e->getMessage();
        $messageType = "danger";
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Compra</title>
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

        <h2>Alterar Compra</h2>
        <?php if ($message) : ?>
            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                <?php echo $message; ?>
                <?php if ($messageType == 'success') : ?>
                    <p>Você será redirecionado em 2 segundos...</p>
                <?php else : ?>
                    <a href="consulta-compra.php" class="btn btn-secondary mt-2">Voltar</a>
                <?php endif; ?>
            </div>
        <?php elseif (isset($tb_compras)) : ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="entregue">Entregue:</label>
                    <input type="text" class="form-control" id="entregue" name="entregue" value="<?php echo htmlspecialchars($tb_compras['entregue']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="entrega">Entrega:</label>
                    <input type="text" class="form-control" id="entrega" name="entrega" value="<?php echo htmlspecialchars($tb_compras['entrega']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="codentrega">Código de Entrega:</label>
                    <input type="number" class="form-control" id="codentrega" name="codentrega" value="<?php echo htmlspecialchars($tb_compras['codentrega']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="valorentrega">Valor da Entrega:</label>
                    <input type="text" class="form-control" id="valorentrega" name="valorentrega" value="<?php echo htmlspecialchars($tb_compras['valorentrega']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="formapagamento">Forma de Pagamento:</label>
                    <input type="text" class="form-control" id="formapagamento" name="formapagamento" value="<?php echo htmlspecialchars($tb_compras['formapagamento']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="dtcompra">Data da Compra:</label>
                    <input type="date" class="form-control" id="dtcompra" name="dtcompra" value="<?php echo htmlspecialchars($tb_compras['dtcompra']); ?>" required>
                </div>
                

                <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                <a href="consulta-compra.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Registro não encontrado.
                <a href="consulta-compra.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
