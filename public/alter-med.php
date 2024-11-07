<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
$message = '';
$messageType = '';

if (isset($_GET['codmedida']))
    $codmedida = $_GET['codmedida'];

// Verificar se o formulário de atualização foi submetido
if (isset($_POST['update'])) {
    $largura = $_POST['largura'];
    $aro = $_POST['aro'];
    $medida = $_POST['medida'];
    $altura = $_POST['altura'];
    $indicecarga = $_POST['indicecarga'];
    $velocidade = $_POST['velocidade'];
    $construcao = $_POST['construcao'];
    $raio = $_POST['raio'];

    


    if (!empty($largura) && !empty($aro) && !empty($medida) && !empty($altura) && !empty($indicecarga) && !empty($velocidade) && !empty($construcao) && !empty($raio)) {
        try {
            $sql = "UPDATE tb_medidas SET largura = :largura, aro = :aro, medida = :medida, altura = :altura, indicecarga = :indicecarga, velocidade = :velocidade, construcao = :construcao, raio = :raio WHERE codmedida = :codmedida";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codmedida', $codmedida, PDO::PARAM_INT);
            $stmt->bindParam(':largura', $largura, PDO::PARAM_INT);
            $stmt->bindParam(':aro', $aro, PDO::PARAM_STR);
            $stmt->bindParam(':medida', $medida, PDO::PARAM_STR);
            $stmt->bindParam(':altura', $altura, PDO::PARAM_STR);
            $stmt->bindParam(':indicecarga', $indicecarga, PDO::PARAM_STR);
            $stmt->bindParam(':velocidade', $velocidade, PDO::PARAM_STR);
            $stmt->bindParam(':construcao', $construcao,PDO::PARAM_STR);
            $stmt->bindParam(':raio', $raio, PDO::PARAM_STR);

            $stmt->execute();
            $message = "Registro alterado com sucesso!";
            $messageType = "success";
            // Redireciona após 2 segundos
            header("refresh:2;url=consulta-med.php");
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
        $sql = "SELECT * FROM tb_medidas WHERE codmedida = :codmedida";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codmedida', $codmedida, PDO::PARAM_INT);
        $stmt->execute();
        $tb_medidas = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Alterar as Medidas</title>
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

        <h2>Alterar as Medidas</h2>
        <?php if ($message) : ?>
            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                <?php echo $message; ?>
                <?php if ($messageType == 'success') : ?>
                    <p>Você será redirecionado em 2 segundos...</p>
                <?php else : ?>
                    <a href="consulta-med.php" class="btn btn-secondary mt-2">Voltar</a>
                <?php endif; ?>
            </div>
        <?php elseif (isset($tb_medidas)) : ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="largura">Largura:</label>
                    <input type="number" class="form-control" id="largura" name="largura" value="<?php echo htmlspecialchars($tb_medidas['largura']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="aro">Aro:</label>
                    <input type="number" class="form-control" id="aro" name="aro" value="<?php echo htmlspecialchars($tb_medidas['aro']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="medida">Medida:</label>
                    <input type="number" class="form-control" id="medida" name="medida" value="<?php echo htmlspecialchars($tb_medidas['medida']); ?>" required>

                </div>
                <div class="form-group">
                    <label for="altura">Altura:</label>
                    <input type="number" class="form-control" id="altura" name="altura" value="<?php echo htmlspecialchars($tb_medidas['altura']); ?>" required>
                </div>
              

                <div class="form-group">
                    <label for="indicecarga">Indicecarga:</label>
                    <input type="number" class="form-control" id="indicecarga" name="indicecarga" value="<?php echo htmlspecialchars($tb_medidas['indicecarga']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="velocidade">Velocidade:</label>
                    <input type="number" class="form-control" id="velocidade" name="velocidade" value="<?php echo htmlspecialchars($tb_medidas['velocidade']); ?>" required>
                </div>


                <div class="form-group">
                    <label for="construcao">Construção:</label>
                    <input type="text" class="form-control" id="construcao" name="construcao" value="<?php echo htmlspecialchars($tb_medidas['construcao']); ?>" required>
                </div>


                <div class="form-group">
                    <label for="raio">Raio:</label>
                    <input type="number" class="form-control" id="raio" name="raio" value="<?php echo htmlspecialchars($tb_medidas['raio']); ?>" required>
                </div>




                <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                <a href="consulta-med.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Registro não encontrado.
                <a href="consulta-med.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>