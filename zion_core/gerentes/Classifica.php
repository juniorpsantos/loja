<?php

class Classifica
{
    private int $id;
    private array $data;
    private bool $resultado;
    private const BD = 'classificacoes_produtos';

    public function criar(array $data): bool
    {
        $this->data = $data;
        if (in_array('', $this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->salvaNoBanco();
    }

    public function aprovar(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->aprovarClassificacao();
    }


    public function cancelar(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        return $this->cancelarClassificacao();
    }

    public function getResultado(): bool
    {
        return $this->resultado;
    }


    private function filtroBanco(): void
    {
        unset($this->data['zion_firewall']);
        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);
        $this->data['id_cliente'] = (int) $this->data['id_cliente'];
        $this->data['id_produto'] = (int) $this->data['id_produto'];
        $this->data['estrela'] = (int) $this->data['estrela'];
        $this->data['descricao'] = (string) $this->data['descricao'];
        $this->data['status'] = (string) 'N';
        $this->data['data'] = date('Y-m-d H:i:s');
        $this->data['dia'] = date('d');
        $this->data['mes'] = date('m');
        $this->data['ano'] = date('Y');
    }

    private function salvaNoBanco(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }


    private function aprovarClassificacao(): bool
    {
        $atualiza = new Atualizar();
        $dados = ['status' => 'S'];
        $atualiza->Atualizando(self::BD, $dados, "WHERE id = :id", "id={$this->id}");
        if ($atualiza->getResultado()) {
            return $this->resultado = true;
        }
    }


    private function cancelarClassificacao(): bool
    {
        $atualiza = new Atualizar();
        $dados = ['status' => 'N'];
        $atualiza->Atualizando(self::BD, $dados, "WHERE id = :id", "id={$this->id}");
        if ($atualiza->getResultado()) {
            return $this->resultado = true;
        }
    }
}
