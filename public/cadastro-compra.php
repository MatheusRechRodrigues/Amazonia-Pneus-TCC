<?php
include "../app/functions/database/conect.php"; // Assumindo que você já criou uma função de conexão PDO
session_start(); //colocar em tudo o session

$pdo = conect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Compra</title>
    <link rel="stylesheet" href="./assets/css/cadastrostyle.css" >
</head>
<body> 

<!-- formulario de cadastro de compra -->
<div class="login-card-med">
  <div class="card-header">
    <h1>Cadastro de Compra</h1>
  </div>
  <div class="card-body">
    <form method="post">                                            

        <div class="form-group">
            <label for="entregue">Entregue (0 para Não, 1 para Sim)</label>
            <input type="number" id="entregue" name="entregue" required="">
        </div>

        <div class="form-group">
            <label for="entrega">Endereço de Entrega</label>
            <input type="text" id="entrega" name="entrega" required="">
        </div>

        <div class="form-group">
            <label for="codentrega">Código de Entrega</label>
            <input type="number" id="codentrega" name="codentrega" required="">
        </div>

        <div class="form-group">
            <label for="valorentrega">Valor da Entrega (R$)</label>
            <input type="text" id="valorentrega" name="valorentrega" required="">
        </div>

        <div class="form-group">
            <label for="formapagamento">Forma de Pagamento (ID)</label>
            <input type="number" id="formapagamento" name="formapagamento" required="">
        </div>

        <div class="form-group">
            <label for="dtcompra">Data da Compra</label>
            <input type="date" id="dtcompra" name="dtcompra" required="">
        </div>

        <div class="form-group">
            <label for="codcliente">Código do Cliente</label>
            <input type="number" id="codcliente" name="codcliente" required="">
        </div>

        <div class="form-group">
            <label for="token">Token</label>
            <input type="text" id="token" name="token" required="">
        </div>

        <!-- Botões de envio -->
        <div class="form-group">
            <button type="submit" class="login-button" name="btnAdd">Cadastrar Compra</button>
            <a href="consulta-compra.php"></a>
        </div>

        <div class="cadastrolinkdiv">
            <a href="consulta-compra.php" class="linkcadastrolog">VOLTAR</a>
        </div>     

    </form>
  </div>
</div>

<img src="../public/assets/image/logoamazonia.png" class="logoamazonia">

<div class="mensagem-banco">
<?php
if (isset($_POST['btnAdd'])) {
    
    $entregue = $_POST['entregue'];
    $entrega = $_POST['entrega'];
    $codentrega = $_POST['codentrega'];
    $valorentrega = $_POST['valorentrega'];
    $formapagamento = $_POST['formapagamento'];
    $dtcompra = $_POST['dtcompra'];
    $codcliente = $_POST['codcliente'];
    $token = $_POST['token'];
    
    if (!empty($entregue && $entrega && $codentrega && $valorentrega && $formapagamento && $dtcompra && $codcliente && $token)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_compras (entregue, entrega, codentrega, valorentrega, formapagamento, dtcompra, codcliente, token) VALUES (:entregue, :entrega, :codentrega, :valorentrega, :formapagamento, :dtcompra, :codcliente, :token)");
            $stmt->bindParam(':entregue', $entregue);
            $stmt->bindParam(':entrega', $entrega);
            $stmt->bindParam(':codentrega', $codentrega);
            $stmt->bindParam(':valorentrega', $valorentrega);
            $stmt->bindParam(':formapagamento', $formapagamento);
            $stmt->bindParam(':dtcompra', $dtcompra);
            $stmt->bindParam(':codcliente', $codcliente);
            $stmt->bindParam(':token', $token);

            $stmt->execute();
            echo ' <div class="echoadd">Compra adicionada com sucesso!</div>';
            
            echo ' <div class="echoadd"> <br><br><a href="consulta-compra.php">VOLTAR</a></div>';
            
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Todos os campos são obrigatórios!";
    }
}
?>
</div>

</body>
</html>
