<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos{

    private $conexao;
    private $produto;

    public function __construct(){
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto){
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria, quantidade_estoque) VALUES ('$produto->nome', $produto->preco, '$produto->categoria', '$produto->quantidade_estoque')";

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
        foreach ($listaArray as $produto) {
            $listaObjetos[] = new Produto($produto["nome"], $produto["preco"], $produto["categoria"], $produto["quantidade_estoque"], $produto['codigo']);

        }
        return $listaObjetos;
    }

    public function excluirProduto(int $codigo){

        $this->conexao->exec("DELETE FROM tb_produtos WHERE codigo = $codigo");

    }



    public function editarProduto($nome, $preco, $quantidade_estoque, $categoria){

}

}