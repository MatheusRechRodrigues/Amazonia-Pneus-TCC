<?php

include '../../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();

$codcompra = 1; // Supondo um código de compra fixo (pode ser gerenciado via sessão)

// Buscar os itens no carrinho
$queryCarrinho = $pdo->prepare("SELECT p.codpneu, p.nomepneu, cp.qntd, cp.preco FROM tb_compras_pneus cp
                                JOIN tb_pneus p ON cp.codpneu = p.codpneu
                                WHERE cp.codcompra = :codcompra");
$queryCarrinho->bindParam(':codcompra', $codcompra);
$queryCarrinho->execute();

$itensCarrinho = $queryCarrinho->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pneus</title>
    <link rel="stylesheet" href="../assets/css/cart.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
</head>

<body>

<div class="produtos_container">
    <?php if ($itensCarrinho): ?>
        <h2>Itens no Carrinho</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Valor Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itensCarrinho as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nomepneu']); ?></td>
                            <td>
                                <div class="quantity-container">
                                    <button class="quantity-btn decrease" data-codpneu="<?php echo $item['codpneu']; ?>">-</button>
                                    <div class="quantity-display"><?php echo htmlspecialchars($item['qntd']); ?></div>
                                    <button class="quantity-btn increase" data-codpneu="<?php echo $item['codpneu']; ?>">+</button>
                                </div>
                            </td>
                            <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td class="total-price" data-preco="<?php echo $item['preco']; ?>">
                                R$ <?php echo number_format($item['qntd'] * $item['preco'], 2, ',', '.'); ?>
                            </td>
                            <td><button class="delete-btn" data-codpneu="<?php echo $item['codpneu']; ?>">Excluir</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    // atualiza o preço
    function updateTotalPrice(button) {
        var row = button.closest('tr');
        var quantityDisplay = row.find('.quantity-display');
        var totalPriceDisplay = row.find('.total-price');
        var pricePerUnit = parseFloat(totalPriceDisplay.data('preco'));
        var quantity = parseInt(quantityDisplay.text());
        var newTotalPrice = (pricePerUnit * quantity).toFixed(2);
        
        totalPriceDisplay.text("R$ " + newTotalPrice.replace('.', ','));
    }

    // função do mais
    $('.increase').click(function() {
        var row = $(this).closest('tr');
        var quantityDisplay = row.find('.quantity-display');
        var quantity = parseInt(quantityDisplay.text()) + 1;
        quantityDisplay.text(quantity);
        updateTotalPrice($(this));
    });

    // função do menos
    $('.decrease').click(function() {
        var row = $(this).closest('tr');
        var quantityDisplay = row.find('.quantity-display');
        var quantity = parseInt(quantityDisplay.text());
        if (quantity > 1) {
            quantity = quantity - 1;
            quantityDisplay.text(quantity);
            updateTotalPrice($(this));
        }
    });

    
    $('.delete-btn').click(function() {
        var codpneu = $(this).data('codpneu');
       
      
    });
});
</script>
</body>
</html>
