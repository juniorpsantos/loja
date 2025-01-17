<?php

class Adicionais
{

    private int $id;
    private array $data;
    private bool  $resultado;

    private const BD = 'adicionais';


    public function inserirAdicional(array $data): bool
    {
        $this->data = $data;
        if ($this->verificaCamposVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->cadastraBanco();
    }


    public function atualizaAdicional(int $id, array $data): bool
    {
        $this->id = $id;
        $this->data = $data;
        if (!$this->data) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->vamosAtualizarAdicional();
    }

    public function deleteAdicional(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->vamosExcluirAdicional();
    }

    public function getResultado(): bool
    {
        return $this->resultado;
    }

    /*****************************************
     * ***************************************
     * MÉTODOS PRIVADOS
     * ***************************************
     * ***************************************
     */

    private function verificaCamposVazios(array $data): bool
    {
        return in_array('', $data);
    }


    private function filtroBanco(): void
    {
        unset($this->data['id'], $this->data['zion_firewall']);

        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['nome'] = (string)  $this->data['nome'];
        $this->data['estoque'] = (int)  $this->data['estoque'];
        $this->data['id_produto'] = (int)  $this->data['id_produto'];
        $this->data['tipo'] = (string)  $this->data['tipo'];
        $this->data['tipo_cadastro'] = (string)  $this->data['tipo_cadastro'];

        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data'] = date('Y-m-d H:i:s');
            $this->data['dia'] = date('d');
            $this->data['mes'] = date('m');
            $this->data['ano'] = date('Y');
        }
    }

    private function cadastraBanco(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function vamosAtualizarAdicional(): bool
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function vamosExcluirAdicional(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }
}
