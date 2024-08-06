<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
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
    $datanasc = $_POST['datanasc'];
    $ncasa = $_POST['ncasa'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $tipo = $_POST['tipo'];
    $ativo = $_POST['ativo'];

//Ivan gay dms
    if (!empty($nome) && !empty($rua) && !empty($cpf) && !empty($fone) && !empty($email) && !empty($datanasc) &&  !empty($ncasa) && !empty($bairro) && !empty($complemento) && !empty($tipo) && !empty($ativo)) {
        try {
            $sql = "UPDATE tb_clientes SET nome = :nome, rua = :rua, cpf = :cpf, fone = :fone, email = :email, datanasc = :datanasc, ncasa = :ncasa, bairro = :bairro, complemento = :complemento, tipo = :tipo, ativo = :ativo WHERE codcliente = :codcliente";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codcliente', $codcliente, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt->bindParam(':fone', $fone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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
} else {
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

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Grupo</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">

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
                    <a href="consulta.php" class="btn btn-secondary mt-2">Voltar</a>
                <?php endif; ?>
            </div>
        <?php elseif (isset($tb_clientes)) : ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($tb_clientes['nome']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="rua">Rua:</label>
                    <input type="text" class="form-control" id="rua" name="rua" value="<?php echo htmlspecialchars($tb_clientes['rua']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="cpf">Cpf:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($tb_clientes['cpf']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="fone">Fone:</label>
                    <input type="text" class="form-control" id="fone" name="fone" value="<?php echo htmlspecialchars($tb_clientes['fone']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($tb_clientes['email']); ?>" required>


                </div>
                <div class="form-group">
                    <label for="datanasc">Data de Nasc:</label>
                    <input type="text" class="form-control" id="datanasc" name="datanasc" value="<?php echo htmlspecialchars($tb_clientes['datanasc']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="ncasa">N° Casa:</label>
                    <input type="text" class="form-control" id="ncasa" name="ncasa" value="<?php echo htmlspecialchars($tb_clientes['ncasa']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars($tb_clientes['bairro']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="complemento">complemento:</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo htmlspecialchars($tb_clientes['complemento']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tb_clientes['tipo']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="ativo">Ativo:</label>
                    <input type="text" class="form-control" id="ativo" name="ativo" value="<?php echo htmlspecialchars($tb_clientes['ativo']); ?>" required>

                </div>


                <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                <a href="consulta.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Registro não encontrado.
                <a href="consulta.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>