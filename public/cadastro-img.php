<?php
include "../app/functions/database/conect.php"; // Assumindo que você já criou uma função de conexão PDO
session_start(); // Colocar em tudo o session

$pdo = conect();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/icon/logoamazonia.ico" type="image/x-icon">
    <title>Adicionar Imagem</title>
    <link rel="stylesheet" href="./assets/css/cadastrostyle.css">
</head>
<body>

<!-- Formulário de Adição de Imagem -->
<div class="login-card-pneu">
    <div class="card-header">
        <h1>ADICIONAR IMAGEM</h1>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">                                            

            <div class="form-group">
                <label for="text">Nome da Imagem:</label>
                <input type="text" id="nomeimg" name="nomeimg" required="">
            </div>

            <div class="form-group">
                <label for="text">URL da Imagem:</label>
                <input type="url" id="url" name="url" required="">
            </div>

            <div class="form-group">
                <label for="text">Pneu Relacionado:</label>
                <input type="text" id="codpneu" name="codpneu" required="">
            </div>

            <!-- Acaba aqui os input, pra baixo botões -->
            <div class="form-group">
                <button type="submit" class="login-button" name="btnAdd">Cadastrar Imagem</button>
                <a href="../pages/inicio.php"></a>
            </div>

            <div class="cadastrolinkdiv">
                <a href="consulta-img.php" class="linkcadastrolog">VOLTAR</a>
            </div> 
        </form>
    </div>
</div>

<img src="../public/assets/image/logoamazonia.png" class="logoamazonia">

<?php
if (isset($_POST['btnAdd'])) {
    
    $nomeimg = $_POST['nomeimg'];
    $url = $_POST['url'];
    $codpneu = $_POST['codpneu'];
    
    if (!empty($nomeimg) && !empty($url) && !empty($codpneu)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_imagens (nomeimg, url, codpneu) VALUES (:nomeimg, :url, :codpneu)");
            $stmt->bindParam(':nomeimg', $nomeimg);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':codpneu', $codpneu);
            $stmt->execute();
            echo '<div class="echoadd">Imagem adicionada com sucesso!</div>';
            echo '<div class="echoadd"> <br><br><a href="consulta-img.php">VOLTAR</a></div>';
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Todos os campos devem ser preenchidos!";
    }
}
?>

</body>
</html>
