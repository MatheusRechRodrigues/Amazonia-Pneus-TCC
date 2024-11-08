<?php

include '../database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();

//Classes que teram as funções que faram as ações dentro do carrinho de compras
class Cart implements CartInterface
{
    public function add($product)
    {
        //if para testar se a SESSION existe, caso não exista ele vai criar uma
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        //if para adicionar um valor ao produto, adicionando mais um. Caso ja exista na SESSION algum produto será adicionado a ele mais 1
        if (!isset($_SESSION['cart'][$product])) {
            $_SESSION['cart'][$product] = 1;
        } else {
            $_SESSION['cart'][$product] += 1;
        }
    }
    public function remove($product)
    {
        if (isset($_SESSION['cart'][$product])) {
            unset($_SESSION['cart'][$product]);
            //unset remove resultados de dentro de um array.
        }
    }
    public function quantity($product, $quantity)
    {

        if (isset($_SESSION['cart'][$product])) {
            //if para definir caso a quantidade seja 0 ou vazia, vai remover o produto do carrinho
            if ($quantity === 0 || $quantity === '') {
                $this->remove($product);
                return;
            }
            //Cart junto de product que quando dado uma quantidade, Cart retorna a quantidade
            $_SESSION['cart'][$product] = $quantity;
        }
    }
    public function clear()
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }
    public function cart()
    {
        //Essa SESSION caso cart exista ele inicia a SESSION, caso não exista ele retorna um array vazio
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        }
        return [];
        //batata XD
    }

    public function dump()
    {
        //verifica se existe a SESSION, caso exista ele da um var_dump no SESSION cart, mostrando todos os valores ali de dentro
        if (isset($_SESSION['cart'])) {
            var_dump($_SESSION['cart']);
        }
    }
}
