<?php


class Banners
{

    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'banners';

    public function criarBanner(array $data): bool
    {
        $this->data = $data;
        if ($this->verificaCamposVazios($this->data)) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        $this->enviaCapa();
        return $this->cadastraBannerBd();
    }


    public function atualizarBanner(int $id, array $data): bool
    {
        $this->id = $id;
        $this->data = $data;

        if (!$this->data) {
            return $this->resultado = false;
            exit();
        }

        $this->filtroBanco();
        $this->atualizaCapa();
        return $this->atualizaBannerBd();
    }


    public function removerBanner(int $id): bool
    {
        $this->id = $id;
        if (!$this->id) {
            return $this->resultado = false;
            exit();
        }

        $this->removerCapa();
        return $this->deletaBannerBd();
    }


    public function getResultado(): bool
    {
        return $this->resultado;
    }



    //métodos privados 

    private function verificaCamposVazios(array $data): bool
    {
        return in_array('', $data);
    }

    // envia imagem do banner
    private function enviaCapa(): void
    {
        if (isset($this->data['capa'])) {
            $enviaCapa = new Uploads(ZION_IMG_BANNERS);
            $urlCapa = Formata::Name($this->data['titulo']) . '-' . time() . '-ziontech-' . random_int(10, 25);
            $enviaCapa->Image($this->data['capa'], $urlCapa);

            if ($enviaCapa->getResult()) {
                $this->data['capa'] = $enviaCapa->getResult();
            } else {
                $this->data['capa'] = null;
            }
        }
    }

    //atualiza capa 
    private function atualizaCapa(): void
    {
        if (isset($this->data['capa'])) {
            $ler = new Ler();
            $ler->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
            $imagemCapa = ZION_IMG_BANNERS . $ler->getResultado()[0]['capa'];
            if (file_exists($imagemCapa) && !is_dir($imagemCapa)) {
                unlink($imagemCapa);
            }

            $enviaCapa = new Uploads(ZION_IMG_BANNERS);
            $urlCapa = Formata::Name($this->data['titulo']) . '-' . time() . '-ziontech-' . random_int(10, 25);
            $enviaCapa->Image($this->data['capa'], $urlCapa);
        }


        if (isset($enviaCapa) && $enviaCapa->getResult()) {
            if (isset($this->data['capa'])) {
                $this->data['capa'] = $enviaCapa->getResult();
            } else {
                unset($this->data['capa']);
            }
        } else {
            unset($this->data['capa']);
        }
    }


    //remover capa
    private function removerCapa(): void
    {
        $ler = new Ler();
        $ler->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
        $imagemCapa = ZION_IMG_BANNERS . $ler->getResultado()[0]['capa'];
        if (file_exists($imagemCapa) && !is_dir($imagemCapa)) {
            unlink($imagemCapa);
        }
    }

    //filtro contra sql injection 
    private function filtroBanco(): void
    {
        $capa = $this->data['capa'];

        unset($this->data['capa'], $this->data['zion_firewall'], $this->data['id']);
        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['titulo'] = (string) $this->data['titulo'];
        $this->data['capa'] = $capa;
        $this->data['link'] = (string) $this->data['link'];
        $this->data['local'] = (string) $this->data['local'];
        $this->data['tipo'] = (string) $this->data['tipo'];
        $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];

        if ($this->data['tipo_cadastro'] == 'criar') {
            $this->data['data'] = date('Y-m-d H:i:s');
            $this->data['dia'] = date('d');
            $this->data['mes'] = date('m');
            $this->data['ano'] = date('Y');
        }
    }

    //cadastra no bando de dados 
    private function cadastraBannerBd(): bool
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if ($criar->getResultado()) {
            return $this->resultado = true;
        }
    }

    //atualiza no banco de dados
    private function atualizaBannerBd(): bool
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if ($atualizar->getResultado()) {
            return $this->resultado = true;
        }
    }


    private function deletaBannerBd(): bool
    {
        $deletar = new Excluir();
        $deletar->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
        if ($deletar->getResultado()) {
            return $this->resultado = true;
        }
    }
}
