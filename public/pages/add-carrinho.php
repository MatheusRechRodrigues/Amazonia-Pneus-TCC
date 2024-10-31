<?php

include '../../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codpneu = $_POST['id_pneu']; 
    $codcompra =  
    $qntd = 1;

    // Recuperar o preço do pneu
    $queryPneu = $pdo->prepare("SELECT preco FROM tb_pneus WHERE codpneu = :codpneu");
    $queryPneu->bindParam(':codpneu', $codpneu);
    $queryPneu->execute();
    $pneu = $queryPneu->fetch(PDO::FETCH_ASSOC);

    if ($pneu) {
        $preco = $pneu['preco'];

        
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
