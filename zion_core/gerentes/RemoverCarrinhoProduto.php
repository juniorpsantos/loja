<?php

class RemoverCarrinhoProduto
{

    private int $id;
    private string $idSessao;
    private bool $resultado;
    private const BD = 'carrinho';

    public function removerProduto(int $id, string $idSessao): bool
    {
        $this->id = $id;
        $this->idSessao = $idSessao;

        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->removerBancoCarrinho();
    }

    public function resultado(): bool
    {
        return $this->resultado;
    }


    private function removerBancoCarrinho(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id_sessao = :idSes AND id_produto = :id", "idSes={$this->idSessao}&id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }
}
