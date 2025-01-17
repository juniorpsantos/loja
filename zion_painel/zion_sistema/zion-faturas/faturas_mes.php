<div class="main-content">


    <!-- INICIO NAVEGAÇÃO --->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Faturas Mês</li>
        </ol>
    </nav>
    <!-- FIM NAVEGAÇÃO --->

    <section class="section">
        <div class="section-body">
            <!-- INICIO TOKEN URL --->
            <?php include_once('./token.php'); ?>
            <!-- FIM TOKEN URL --->


            <!-- INICIO TABELA -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <?php
                            $mes = date('m');
                            $ano = date('Y');
                            ?>


                            <h4>Faturas Aprovadas do Mês de <?= Formata::Mes($mes) ?> de <?= $ano ?></h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Data</th>
                                            <th>Cliente</th>
                                            <th>CPF</th>
                                            <th>E-mail</th>
                                            <th>Transação</th>
                                            <th>Valor</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        $zion->Leitura('faturas', "WHERE status = 'paid' AND mes = :mes AND ano = :ano ORDER BY data DESC", "mes={$mes}&ano={$ano}");
                                        $faturas = Formata::Resultado($zion);
                                        if ($faturas) {
                                            foreach ($zion->getResultado() as $fatura) {
                                                $fatura = (object) $fatura;

                                                $status = '';
                                                switch ($fatura->status) {
                                                    case $fatura->status == 'new':
                                                        $status = '<button class="btn btn-primary">Novo</button>';
                                                        break;
                                                    case $fatura->status == 'waiting':
                                                        $status = '<button class="btn btn-warning">Pendente</button>';
                                                        break;
                                                    case $fatura->status == 'identified':
                                                        $status = '<button class="btn btn-primary">Aguardando Pagamento Identificado</button>';
                                                        break;
                                                    case $fatura->status == 'paid':
                                                        $status = '<button class="btn btn-success">Aprovado</button>';
                                                        break;
                                                    case $fatura->status == 'approved':
                                                        $status = '<button class="btn btn-info">Pagamento Aprovado e Aguardando a Liberação da Opreadora de Cartão</button>';
                                                        break;
                                                    case $fatura->status == 'unpaid':
                                                        $status = '<button class="btn btn-danger">O Pagamento Foi Recursado Verique com a Opreadora do Cartão</button>';
                                                        break;
                                                    case $fatura->status == 'refunded':
                                                        $status = '<button class="btn btn-danger">O Pagamento Foi Devolvido</button>';
                                                        break;
                                                    case $fatura->status == 'contested':
                                                        $status = '<button class="btn btn-danger">O Pagamento Contestado Pelo Cliente</button>';
                                                        break;
                                                    case $fatura->status == 'canceled':
                                                        $status = '<button class="btn btn-danger">Cobrança cancelada pelo vendedor ou pelo pagador</button>';
                                                        break;
                                                    case $fatura->status == 'settled':
                                                        $status = '<button class="btn btn-success">Marcado como pago manualmente!</button>';
                                                        break;
                                                    case $fatura->status == 'link':
                                                        $status = '<button class="btn btn-warning">Gerado o link de pagamento pendente!</button>';
                                                        break;
                                                    case $fatura->status == 'expired':
                                                        $status = '<button class="btn btn-danger">O pagamento expirou, pois ultrapassou o prazo limite!</button>';
                                                        break;
                                                }
                                        ?>
                                                <tr>
                                                    <td><?= $fatura->id ?></td>

                                                    <td><?= date('d/m/Y', strtotime($fatura->data)) ?></td>
                                                    <td><?= $fatura->cliente_nome ?> </td>
                                                    <td><?= $fatura->cliente_cpf ?> </td>
                                                    <td><?= $fatura->cliente_email ?> </td>
                                                    <td><?= $fatura->transacao ?> </td>
                                                    <td><b><?= number_format($fatura->valor_total, 2, ',', '.') ?></b></td>
                                                    <td><?= $status ?></td>
                                                </tr>

                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>


    <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO -->
    <!-- Large modal -->
    <div class="modal fade ajuda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Fique tranquilo que vou te ajudar, veja o vídeo até o final 2x</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ffuF8-Nebuw?rel=0" allowfullscreen></iframe>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- FIM DA JANELA DE MODAL DE TREINAMENTO -->
</div>

<?php
$zion = null;
$ler = null;

?>