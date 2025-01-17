<?php

class ConfigEmail
{

    private int $id;
    private array $data;
    private bool $resultado;
    private const BD = 'config_email';

    public function atualizaConfig(int $id, array $data): bool
    {

        $this->id = $id;
        $this->data = $data;

        if ($this->verificaCamposVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->salvarBanco();
    }


    public function getResultado(): bool
    {
        return $this->resultado;
    }


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

        $this->data['host'] = (string) $this->data['host'];
        $this->data['email'] = (string) $this->data['email'];
        $this->data['senha'] = (string) $this->data['senha'];
        $this->data['porta'] = (string) $this->data['porta'];
    }


    private function salvarBanco(): bool
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resultado = true;
        }
    }
}
