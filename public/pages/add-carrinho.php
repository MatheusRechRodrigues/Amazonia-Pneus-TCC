<?php

include '../../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codpneu = $_POST['id_pneu']; // ID do pneu enviado no formulário
    $codcompra =  // Supondo um código de compra fixo (pode ser gerenciado via sessão)
    $qntd = 1; // Quantidade fixa (pode ser gerenciado via sessão ou input do usuário)

    // Recuperar o preço do pneu
    $queryPneu = $pdo->prepare("SELECT preco FROM tb_pneus WHERE codpneu = :codpneu");
    $queryPneu->bindParam(':codpneu', $codpneu);
    $queryPneu->execute();
    $pneu = $queryPneu->fetch(PDO::FETCH_ASSOC);

    if ($pneu) {
        $preco = $pneu['preco'];

        // Adicionar ao carrinho
        $queryCarrinho = $pdo->prepare("INSERT INTO tb_compras_pneus (codcompra, codpneu, qntd, preco) VALUES (:codcompra, :codpneu, :qntd, :preco)");
        $queryCarrinho->bindParam(':codcompra', $codcompra);
        $queryCarrinho->bindParam(':codpneu', $codpneu);
        $queryCarrinho->bindParam(':qntd', $qntd);
        $queryCarrinho->bindParam(':preco', $preco);

        if ($queryCarrinho->execute()) {
            echo "Pneu adicionado ao carrinho com sucesso!";
            header("Location: carrinho.php");
            exit;
        } else {
            echo "Erro ao adicionar o pneu ao carrinho.";
        }
    } else {
        echo "Pneu não encontrado.";
    }
} else {
    echo "Requisição inválida.";
}
?>
