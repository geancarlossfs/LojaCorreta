<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos {

    private $conexao;
    private $produto;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto){
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria) VALUES ('$produto->nome', $produto->preco, '$produto->categoria')";

        $this->conexao->exec($sql);
    }

    public function buscarProduto(int $codigo){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE codigo = $codigo");
        $produto = $consulta->fetch(PDO::FETCH_ASSOC);

        return $produto;

    }

    public function getProdutos(){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos");
        $listaArray = $consulta->fetchAll(PDO::FETCH_ASSOC);

        $listaObjetos = [];
        foreach ($listaArray as $prodLista){
            new Produto($prodLista['codigo'], $prodLista["nome"], $prodLista["preco"], $prodLista["categoria"], $prodLista["quantidade_estoque"]);

        }
        return $listaObjetos;
    }
}

