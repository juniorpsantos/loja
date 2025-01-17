<?php

class AddCarrinho
{
    private array $data;
    private int $id;
    private bool $resultado;

    private const BD = 'carrinho';

    public function inserir(array $data): bool
    {
        $this->data = $data;
        if (in_array('', $this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        $this->removerFavorito();
        return $this->salvarCarrinho();
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
        $this->data['id_cliente'] = (int) $this->data['id_cliente'];
        $this->data['id_sessao'] = (string) $this->data['id_sessao'];
        $this->data['valor'] = $this->data['valor'];
        $this->data['qtde'] = (int) $this->data['qtde'];
        $this->data['peso_correio'] = $this->data['peso_correio'];
        $this->data['diametro_correio'] = $this->data['diametro_correio'];
        $this->data['comprimento_correio'] = $this->data['comprimento_correio'];
        $this->data['largura_correio'] = $this->data['largura_correio'];
        $this->data['altura_correio'] = $this->data['altura_correio'];
        $this->data['status'] = (string) 'P';
        $this->data['data'] = date('Y-m-d H:i:s');
        $this->data['dia'] = date('d');
        $this->data['mes'] = date('m');
        $this->data['ano'] = date('Y');
        $this->data['hora'] = date('H:i');

        if (isset($this->data['cor'])) {
            $this->data['cor'] = (int) $this->data['cor'];
        }

        if (isset($this->data['tamanho'])) {
            $this->data['tamanho'] = (int) $this->data['tamanho'];
        }
    }

    private function removerFavorito(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover('favoritos', "WHERE id_produto = :id AND id_sessao = :idSes", "id={$this->data['id_produto']}&idSes={$this->data['id_sessao']}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }

    private function salvarCarrinho(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }
}
