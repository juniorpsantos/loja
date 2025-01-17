<?php

class RedesSociais
{
    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'redes_sociais';

    public function salvaRede($data)
    {
        $this->data = $data;
        if (in_array('', $this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->banco();
        $this->vamosSalvar();
    }

    public function upRedes($id, $data)
    {
        $this->id = (int) $id;
        $this->data = $data;
        if (!$this->data) {
            return $this->resultado = false;
            exit();
        }

        $this->banco();
        $this->atualizandoRedesSociais();
    }

    public function excluindoRede($id)
    {
        $this->id = (int) $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        $this->agoraVamosExcluir();
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    private function banco()
    {

        unset($this->data['id'], $this->data['zion_firewall']);

        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['icone'] = (string) $this->data['icone'];
        $this->data['nome'] = (string) $this->data['nome'];
        $this->data['link'] = (string) $this->data['link'];
        $this->data['tipo'] = (string) $this->data['tipo'];
        $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];

        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data'] = date('Y-m-d H:i:s');
            $this->data['dia'] = date('d');
            $this->data['mes'] = date('m');
            $this->data['ano'] = date('Y');
        }
    }

    private function vamosSalvar()
    {

        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function atualizandoRedesSociais()
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function agoraVamosExcluir()
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }
}
