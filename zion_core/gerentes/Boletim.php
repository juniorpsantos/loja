<?php

class Boletim
{
    private int $id;
    private array $data;
    private bool $resultado;
    private const BD = 'boletim';

    public function criarBoletim(array $data): bool
    {
        $this->data = $data;
        if ($this->verificaCamposVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->cadastraBanco();
    }


    public function atualizarBoletim(int $id, array $data): bool
    {
        $this->id = $id;
        $this->data = $data;

        if ($this->verificaCamposVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->atualizarBanco();
    }


    public function excluirBoletim(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->excluirBanco();
    }


    public function cancelarBoletim(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->cancelarBanco();
    }

    public function ativarBoletim(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->ativarBanco();
    }

    public function getResultado(): bool
    {
        return $this->resultado;
    }

    /**
     * métodos privados 
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

        $this->data['email'] = (string) $this->data['email'];
        $this->data['status'] = (string) $this->data['status'];
        $this->data['tipo'] = (string) $this->data['tipo'];
        $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];

        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data']  = date('Y-m-d H:i:s');
            $this->data['dia']  = date('d');
            $this->data['mes']  = date('m');
            $this->data['ano']  = date('Y');
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


    private function atualizarBanco(): bool
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resultado = true;
        }
    }


    private function excluirBanco(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function cancelarBanco(): bool
    {
        $cancelar = new Atualizar();
        $dadosCancelar = ["status" => 'N'];
        $cancelar->Atualizando(self::BD, $dadosCancelar, "WHERE id = :id", "id={$this->id}");
        if ($cancelar->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function ativarBanco(): bool
    {
        $ativar = new Atualizar();
        $dadosAtivar = ["status" => 'S'];
        $ativar->Atualizando(self::BD, $dadosAtivar, "WHERE id = :id", "id={$this->id}");
        if ($ativar->getResultado()) {
            return $this->resultado = true;
        }
    }
}
