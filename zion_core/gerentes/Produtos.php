<?php

class Produtos
{

    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'produto';

    public function criarProduto(array $data): bool
    {

        $this->data = $data;
        if (!$this->data) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        $this->enviaFoto();
        $this->enviaArquivo();
        return $this->salvaBanco();
    }


    //ATUALIZA PRODUTOS NO BANCO DE DADOS 
    public function atualizaProduto(int $id, array $data): bool
    {
        $this->id = (int) $id;
        $this->data = $data;

        if (!$this->data) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        $this->atualizaFoto();
        $this->atualizaArquivo();
        return $this->atualizarNoBancoDeDados();
    }


    //remover produto
    public function excluirProduto(int $id): bool
    {
        $this->id = (int) $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        $this->removeCapa();
        $this->removeArquivo();
        return $this->removeProduto();
    }

    //respostas verdadeiras e falsas 
    public function getResultado(): bool
    {
        return $this->resultado;
    }



    /**
     * ***********************************************
     * ***********************************************
     * INICIO MÉTODOS PRIVADOS PARA INSERIR PRODUTO 
     * ***********************************************
     * ***********************************************
     */

    private function enviaFoto(): void
    {

        if (isset($this->data['capa'])) {
            $enviaFoto = new Uploads(ZION_IMG_PRODUTOS);
            $enviaFoto->Image($this->data['capa'], $this->data['url'] . '-ziontech-' . time());
        }

        if (isset($enviaFoto) && $enviaFoto->getResult()) {
            $this->data['capa'] = $enviaFoto->getResult();
        } else {
            $this->data['capa'] = null;
        }
    }

    private function enviaArquivo(): void
    {
        if (isset($this->data['arquivo'])) {
            $enviaArquivo = new Uploads(ZION_IMG_PRODUTOS);
            $enviaArquivo->File($this->data['arquivo'], $this->data['url'] . '-ziontech-' . time());
        }

        if (isset($enviaArquivo) && $enviaArquivo->getResult()) {
            $this->data['arquivo'] = $enviaArquivo->getResult();
        } else {
            $this->data['arquivo'] = null;
        }
    }


    private function filtroBanco(): void
    {

        $capa = $this->data['capa'];
        $arquivo = $this->data['arquivo'];
        $descricao = $this->data['descricao'];

        unset($this->data['capa'], $this->data['arquivo'], $this->data['descricao'], $this->data['id'], $this->data['zion_firewall']);

        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['url'] = Formata::Name($this->data['titulo']) . '-ziontech-' . time() . '-' . Formata::Name(date('Y-m-d H:i'));
        $this->data['capa'] = $capa;
        $this->data['arquivo'] = $arquivo;
        $this->data['descricao'] = $descricao;
        $this->data['titulo'] = (string) $this->data['titulo'];
        $this->data['sub_titulo'] = (string) $this->data['sub_titulo'];
        $this->data['id_categoria'] = (int) $this->data['id_categoria'];
        $this->data['id_sub_categoria'] = (int) $this->data['id_sub_categoria'];
        $this->data['preco_alto'] = $this->data['preco_alto'];
        $this->data['preco'] = $this->data['preco'];
        $this->data['status'] = (string) $this->data['status'];
        $this->data['peso_correio'] = $this->data['peso_correio'];
        $this->data['diametro_correio'] = $this->data['diametro_correio'];
        $this->data['comprimento_correio'] = $this->data['comprimento_correio'];
        $this->data['largura_correio'] = $this->data['largura_correio'];
        $this->data['altura_correio'] = $this->data['altura_correio'];
        $this->data['tags'] = (string) $this->data['tags'];
        $this->data['destaque'] = (string) $this->data['destaque'];
        $this->data['video'] = (string) $this->data['video'];
        $this->data['estoque'] = (int) $this->data['estoque'];
        $this->data['usuario'] = (int) $this->data['usuario'];
        $this->data['oferta'] = $this->data['oferta'];
        $this->data['tipo'] = (string) $this->data['tipo'];
        $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];


        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data'] = date('Y-m-d H:i:s');
            $this->data['dia'] = date('d');
            $this->data['mes'] = date('m');
            $this->data['ano'] = date('Y');
            $this->data['novidade'] =  date('Y-m-d', strtotime(" + 30 days"));
        }
    }


    private function salvaBanco(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }

    /**
     * ***********************************************
     * ***********************************************
     * FIM MÉTODOS PRIVADOS PARA INSERIR PRODUTO 
     * ***********************************************
     * ***********************************************
     * -----------------------------------------------
     */


    /**
     * ***********************************************
     * ***********************************************
     * INICIO MÉTODOS PRIVADOS PARA ATUALIZAR O PRODUTO 
     * ***********************************************
     * ***********************************************
     */

    private function atualizaFoto(): void
    {

        if (isset($this->data['capa'])) {
            $lerCapaAtualizar = new Ler();
            $lerCapaAtualizar->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
            $nomeImagem = ZION_IMG_PRODUTOS . $lerCapaAtualizar->getResultado()[0]['capa'];

            if (file_exists($nomeImagem) && !is_dir($nomeImagem)) {
                unlink($nomeImagem);
            }

            $atualizaCapa = new Uploads(ZION_IMG_PRODUTOS);
            $atualizaCapa->Image($this->data['capa'], $this->data['url'] . '-ziontech-' . time());
        }

        if (isset($atualizaCapa) && $atualizaCapa->getResult()) {
            $this->data['capa'] = $atualizaCapa->getResult();
        } else {
            unset($this->data['capa']);
        }
    }

    private function atualizaArquivo(): void
    {

        if (isset($this->data['arquivo'])) {
            $lerArquivoAtualizar = new Ler();
            $lerArquivoAtualizar->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
            $nomeDoArquivo = ZION_IMG_PRODUTOS . $lerArquivoAtualizar->getResultado()[0]['arquivo'];

            if (file_exists($nomeDoArquivo) && !is_dir($nomeDoArquivo)) {
                unlink($nomeDoArquivo);
            }

            $atualizaArquivo = new Uploads(ZION_IMG_PRODUTOS);
            $atualizaArquivo->File($this->data['arquivo'], $this->data['url'] . '-ziontech-' . time());
        }

        if (isset($atualizaArquivo) && $atualizaArquivo->getResult()) {
            $this->data['arquivo'] = $atualizaArquivo->getResult();
        } else {
            unset($this->data['arquivo']);
        }
    }

    private function atualizarNoBancoDeDados(): bool
    {

        $atualizarProduto = new Atualizar();
        $atualizarProduto->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizarProduto->getResultado()) {
            return $this->resultado = true;
        }
    }

    /**
     * ***********************************************
     * ***********************************************
     * FIM MÉTODOS PRIVADOS PARA ATUALIZAR O PRODUTO 
     * ***********************************************
     * ***********************************************
     * -----------------------------------------------
     */


    /**
     * ***********************************************
     * ***********************************************
     * INICIO MÉTODOS PRIVADOS PARA REMOVER O PRODUTO 
     * ***********************************************
     * ***********************************************
     */

    private function removeCapa(): void
    {
        $lerCapaAtualizar = new Ler();
        $lerCapaAtualizar->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
        $nomeImagem = ZION_IMG_PRODUTOS . $lerCapaAtualizar->getResultado()[0]['capa'];

        if (file_exists($nomeImagem) && !is_dir($nomeImagem)) {
            unlink($nomeImagem);
        }
    }

    private function removeArquivo(): void
    {
        $lerArquivoAtualizar = new Ler();
        $lerArquivoAtualizar->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
        $nomeDoArquivo = ZION_IMG_PRODUTOS . $lerArquivoAtualizar->getResultado()[0]['arquivo'];

        if (file_exists($nomeDoArquivo) && !is_dir($nomeDoArquivo)) {
            unlink($nomeDoArquivo);
        }
    }

    private function removeProduto(): bool
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($excluir->getResultado()) {
            return $this->resultado = true;
        }
    }


    /**
     * ***********************************************
     * ***********************************************
     * FIM MÉTODOS PRIVADOS PARA REMOVER O PRODUTO 
     * ***********************************************
     * ***********************************************
     * -----------------------------------------------
     */
}
