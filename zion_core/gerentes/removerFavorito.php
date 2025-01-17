<?php

class removerFavorito
{
    private int $id;
    private string $idSes;
    private bool $resultado;
    private const BD = 'favoritos';

    public function excluirFavorito(int $id, string $ses): bool
    {
        $this->id = $id;
        $this->idSes = $ses;

        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return  $this->removerFavorito();
    }


    public function getResultado(): bool
    {
        return $this->resultado;
    }


    private function removerFavorito(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id_produto = :id AND id_sessao = :idSes", "id={$this->id}&idSes={$this->idSes}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }
}
