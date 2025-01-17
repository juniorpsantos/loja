<?php

class AddFavoritos
{
    private array $data;
    private bool $resultado;
    private const BD = 'favoritos';

    public function inserirFavorito(array $data): bool
    {
        $this->data = $data;
        if (in_array('', $this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        return $this->adicionarFavorito();
    }

    public function getResultado(): bool
    {
        return $this->resultado;
    }


    private function filtroBanco(): void
    {
        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['id_produto'] = (int) $this->data['id_produto'];
        $this->data['id_sessao'] = (string) $this->data['id_sessao'];
        $this->data['id_cliente'] = (int) $this->data['id_cliente'];
        $this->data['data'] = date('Y-m-d H:i:s');
        $this->data['dia'] = date('d');
        $this->data['mes'] = date('m');
        $this->data['ano'] = date('Y');
    }

    private function adicionarFavorito(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }
}
