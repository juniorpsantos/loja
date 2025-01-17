<?php

class Categorias
{
    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'categorias';

    public function inserirCategoria(array $data): bool
    {
        $this->data = $data;
        if ($this->verificaCampoVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtrarBanco();
        return $this->criarDepartamento();
    }


    public function atualizaCategoria(int $id, array $data): bool
    {

        $this->id = (int) $id;
        $this->data = $data;

        if ($this->verificaCampoVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }


        $this->filtrarBanco();
        return $this->atualizandoCategoria();
    }


    public function excluirCategoria(int $id): bool
    {
        $this->id = (int) $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->vamosRemoverCategoria();
    }

    public function getResultado(): bool
    {
        return $this->resultado;
    }


    //métodos privados 

    private function verificaCampoVazios(array $data): bool
    {
        return in_array('',  $data);
    }

    private function filtrarBanco(): void
    {


        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        unset($this->data['zion_firewall'], $this->data['id']);


        $this->data['url'] = Formata::Name($this->data['nome']) . '-msflix-' . time() . '-' . date('H');
        $this->data['nome'] = (string) $this->data['nome'];
        $this->data['usuario'] = (int) $this->data['usuario'];
        $this->data['tipo'] = (string) $this->data['tipo'];
        $this->data['status'] = (string) 'S';
        $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];

        if ($this->data['tipo'] === 'filho' && isset($this->data['pai'])) {
            $this->data['pai'] = (int) $this->data['pai'];
        }

        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data'] = date('Y-m-d H:i:s');
            $this->data['dia'] = date('d');
            $this->data['mes'] = date('m');
            $this->data['ano'] = date('Y');
        }
    }

    private function criarDepartamento(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }


    private function atualizandoCategoria()
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resultado = true;
        }
    }


    private function vamosRemoverCategoria()
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }
}
