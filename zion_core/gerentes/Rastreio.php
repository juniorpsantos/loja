<?php

class Rastreio
{

  private int $id;
  private array $data;
  private bool $resultado;
  private const BD = 'minhas_compras';

  public function enviarRastreio(int $id, array $data): bool
  {

    $this->id = $id;
    $this->data = $data;

    if (isset($this->data['zion_firewall'])) {
      unset($this->data['zion_firewall']);
    }

    if (in_array('', $this->data)) {
      return $this->resultado = false;
      exit();
    }

    return $this->salvarNoBanco();
  }


  public function finalizarPedido(int $id): bool
  {
    $this->id = $id;
    if (!$this->id) {
      return $this->resultado = false;
      exit();
    }

    return $this->finalizandoPedido();
  }


  public function cancelaFinalizacao(int $id): bool
  {
    $this->id = $id;
    if (!$this->id) {
      return $this->resultado = false;
      exit();
    }

    return $this->cancelandoFianlizacao();
  }

  public function getResultado(): bool
  {
    return $this->resultado;
  }


  private function salvarNoBanco(): bool
  {
    $atualizar = new Atualizar();
    $dados = ['rastreio' => $this->data['rastreio']];
    $atualizar->Atualizando(self::BD, $dados, "WHERE transacao = :id", "id={$this->id}");
    if ($atualizar->getResultado()) {
      return $this->resultado = true;
    }
  }


  private function finalizandoPedido(): bool
  {
    $atualizar = new Atualizar();
    $dados = ['finalizado' => 'S'];
    $atualizar->Atualizando(self::BD, $dados, "WHERE transacao = :id", "id={$this->id}");
    if ($atualizar->getResultado()) {
      return $this->resultado = true;
    }
  }


  private function cancelandoFianlizacao(): bool
  {
    $atualizar = new Atualizar();
    $dados = ['finalizado' => 'N'];
    $atualizar->Atualizando(self::BD, $dados, "WHERE transacao = :id", "id={$this->id}");
    if ($atualizar->getResultado()) {
      return $this->resultado = true;
    }
  }
}
