<?php

include '../../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();


$codcompra = 1; // Supondo um código de compra fixo (pode ser gerenciado via sessão)

// Buscar os itens no carrinho
$queryCarrinho = $pdo->prepare("SELECT p.nomepneu, cp.qntd, cp.preco FROM tb_compras_pneus cp
                                JOIN tb_pneus p ON cp.codpneu = p.codpneu
                                WHERE cp.codcompra = :codcompra");
$queryCarrinho->bindParam(':codcompra', $codcompra);
$queryCarrinho->execute();

$itensCarrinho = $queryCarrinho->fetchAll(PDO::FETCH_ASSOC);

if ($itensCarrinho) {
    echo "<h2>Itens no Carrinho</h2>";
    echo "<table border='1'>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
            </tr>";
    foreach ($itensCarrinho as $item) {
        echo "<tr>
                <td>{$item['nomepneu']}</td>
                <td>{$item['qntd']}</td>
                <td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Seu carrinho está vazio.";
}

