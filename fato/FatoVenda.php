<?php

namespace FATOS;

class fatovenda{
    public $SK_cliente;
    public $SK_produto;
    public $SK_data;
    public $pedido;
    public $valor_venda;
    public $quantidade_venda;

    public function setFatoVenda($clinte, $produto, $data, $pedido, $valor, $quantidade){
        $this->SK_cliente = $clinte;
        $this->SK_produto = $produto;
        $this->SK_data = $data;
        $this->pedido = $pedido;
        $this->valor_venda = $valor;
        $this->quanidade_venda = $quantidade;
    }
}

?>