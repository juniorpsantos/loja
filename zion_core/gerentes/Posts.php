<?php

class Posts
{
    private int $id;
    private array $data;
    private bool $resposta;

    private const BD = 'posts';

    public function criarPost(array $data): bool
    {
        $this->data = $data;
        if ($this->verificaCampoVazios($this->data)) {
            return $this->resposta = false;
            exit();
        }

        $this->filtroBanco();
        $this->enviaFoto();
        return  $this->cadastraNoBanco();
    }

    public function atualizaPost(int $id, array $data): bool
    {
        $this->id = $id;
        $this->data = $data;

        if (!$this->data) {
            return $this->resposta = false;
            exit();
        }

        $this->filtroBanco();
        $this->atualizaFoto();
        return  $this->atualizaNoBanco();
    }


    public function excluirPost(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resposta = false;
            exit();
        }

        $this->excluirFoto();
        return  $this->excluirNoBanco();
    }


    public function getResultado(): bool
    {
        return $this->resposta;
    }



    //métodos privados

    //verifica campos vazios 
    private function verificaCampoVazios(array $data): bool
    {
        return in_array('', $data);
    }

    //envia fotos
    private function enviaFoto(): void
    {
        if (isset($this->data['capa'])) {
            $enviaFoto = new Uploads(ZION_IMG_POSTS);
            $enviaFoto->Image($this->data['capa'], $this->data['url']);
        }

        if (isset($enviaFoto) && $enviaFoto->getResult()) {
            $this->data['capa'] = $enviaFoto->getResult();
        } else {
            $this->data['capa'] = null;
        }
    }

    //atualiza foto
    private function atualizaFoto(): void
    {
        if (isset($this->data['capa'])) {
            $lerFoto = new Ler();
            $lerFoto->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
            $nomeCapa = ZION_IMG_POSTS . $lerFoto->getResultado()[0]['capa'];

            if (file_exists($nomeCapa) && !is_dir($nomeCapa)) {
                unlink($nomeCapa);
            }

            $atualizaFoto = new Uploads(ZION_IMG_POSTS);
            $atualizaFoto->Image($this->data['capa'], $this->data['url']);
        }

        if (isset($atualizaFoto) && $atualizaFoto->getResult()) {
            $this->data['capa'] = $atualizaFoto->getResult();
        } else {
            unset($this->data['capa']);
        }
    }


    //excluir foto 
    private function excluirFoto(): void
    {
        $lerFoto = new Ler();
        $lerFoto->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
        $nomeCapa = ZION_IMG_POSTS . $lerFoto->getResultado()[0]['capa'];

        if (file_exists($nomeCapa) && !is_dir($nomeCapa)) {
            unlink($nomeCapa);
        }
    }

    //filtro sql 
    private function filtroBanco(): void
    {

        $capa = $this->data['capa'];
        $descricao = $this->data['descricao'];

        unset($this->data['capa'],  $this->data['descricao'],  $this->data['id'],  $this->data['zion_firewall']);

        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['url'] = Formata::Name($this->data['titulo']) . '-ziontech-' . time();
        $this->data['titulo'] = (string) $this->data['titulo'];
        $this->data['capa'] =  $capa;
        $this->data['descricao'] = $descricao;
        $this->data['sem_imagem'] = (string) $this->data['sem_imagem'];
        $this->data['status'] = (string) $this->data['status'];
        $this->data['usuario'] = (int) $this->data['usuario'];
        $this->data['tags'] = (string) $this->data['tags'];
        $this->data['tipo'] = (string) $this->data['tipo'];
        $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];

        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data'] = date('Y-m-d H:i:s');
            $this->data['dia'] = date('d');
            $this->data['mes'] = date('m');
            $this->data['ano'] = date('Y');
        }
    }

    //adiciona no banco de dados 
    private function cadastraNoBanco(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resposta = true;
        }
    }

    private function atualizaNoBanco(): bool
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resposta = true;
        }
    }

    private function excluirNoBanco(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resposta = true;
        }
    }
}
