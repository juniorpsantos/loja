<div class="main-content">
    <section class="section">
        <div class="section-body">


            <!-- INICIO CONTADOR DE VISITAS EM PRODUTOS -->
            <div class="row clearfix">

                <!-- INICIO CONTADOR DE VISITAS EM PRODUTOS -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Visitas por Notícias</h4>
                        </div>
                        <div class="card-body">
                            <div class="recent-report__chart">
                                <canvas id="meuGrafico" style="height:300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CONTADOR DE VISITAS EM PRODUTOS -->


            </div>
            <!-- FIM CONTADOR DE VISITAS EM PRODUTOS -->



            <!-- INICIO TABELA -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Visitas em Notícias</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>

                                            <th>Criado</th>
                                            <th>Nome</th>
                                            <th>Visitas</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $zion->Leitura('posts', "WHERE tipo = 'blog' ORDER BY visitas DESC");
                                        $categoriasRelatorio = Formata::Resultado($zion);
                                        if ($categoriasRelatorio) {
                                            foreach ($zion->getResultado() as $categoria) {
                                                $categoria = (object) $categoria;
                                        ?>
                                                <tr>
                                                    <td><?= date('d/m/Y', strtotime($categoria->data)) ?></td>
                                                    <td><?= $categoria->titulo ?></td>
                                                    <td> <?= $categoria->visitas ?> </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fim TABELA -->


        </div>
    </section>


</div>


<script>
    const ctx = document.getElementById('meuGrafico').getContext('2d');
    const meuGrafico = new Chart(ctx, {
        type: 'bar',
        data: {


            labels: [
                <?php
                $ler = new Ler();
                $ler->Leitura('posts', "WHERE tipo = 'blog' ORDER BY titulo ASC");
                if ($categoriasRelatorio) {
                    foreach ($ler->getResultado() as $categoria) {
                        $categoria = (object) $categoria;

                ?> '<?= $categoria->titulo ?>',
                <?php }
                } ?>

            ],


            datasets: [{
                label: 'Visitas por Notícias',


                data: [

                    <?php
                    $categoriasVisitas = Formata::Resultado($ler);
                    if ($categoriasVisitas) {
                        foreach ($ler->getResultado() as $categoria) {
                            $categoria = (object) $categoria;
                    ?>
                            <?= $categoria->visitas ?>,
                    <?php }
                    } ?>

                ],

                backgroundColor: 'rgba(84, 3, 138, 0.7)',
                borderColor: 'rgba(50,3, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>