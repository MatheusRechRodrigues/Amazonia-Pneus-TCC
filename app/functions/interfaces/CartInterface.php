<?php 

namespace app\classes;

use app\interfaces\CartInterface;

class Cart implements CartInterface 
{
    protected $cart = [];

    public function add($product)
    {
        $this->cart[$product] = ($this->cart[$product] ?? 0) + 1;
    }

    public function remove($product)
    {
        unset($this->cart[$product]);
    }

    public function quantity($product, $quantity)
    {
        if ($quantity > 0) {
            $this->cart[$product] = $quantity;
        } else {
            $this->remove($product);
        }
    }

    public function clear()
    {
        $this->cart = [];
    }

    public function cart()
    {
        return $this->cart;
    }

    public function dump()
    {
        return print_r($this->cart, true);
    }
}
