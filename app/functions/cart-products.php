<?php

include '../database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
class CartProducts {

    
    
    
    public function products(CartInterface $cartInterface)
    {
        // Obtém os itens do carrinho da sessão
        $productsInCart = $cartInterface->cart();
        
        // Recupera os dados dos pneus e suas imagens do banco de dados
        $productsInDatabase = (new Read)->join(
            'tb_pneus', 
            'tb_imagens', 
            'tb_pneus.codpneu', 
            'tb_imagens.codpneu', 
            ['tb_pneus.*', 'tb_imagens.url AS image']
        );

        // Array vazio onde serão colocados os produtos do carrinho
        $products = [];
        $total = 0;

        foreach ($productsInCart as $productId => $quantity) {
            // Filtra o produto correspondente no banco de dados
            $product = [...array_filter($productsInDatabase, fn ($product) => (int)$product->codpneu === $productId)];

            // Monta os dados do produto para exibição no carrinho
            $products[] = [
                'id' => $productId,
                'product' => $product[0]->nomepneu,
                'price' => $product[0]->preco,
                'description' => $product[0]->descricao,
                'image' => $product[0]->image,
                'qty' => $quantity,
                'subtotal' => $quantity * $product[0]->preco
            ];

            // Atualiza o total do carrinho
            $total += $quantity * $product[0]->preco;
        }

        // Retorna os produtos e o total
        return [
            'products' => $products,
            'total' => $total
        ];
    }
}
