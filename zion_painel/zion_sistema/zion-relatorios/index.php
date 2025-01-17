<?php

$estoque = 0;
$visitas = 0;
$totalProdutos = 0;
$zion->Leitura('produto');
$produtoRelatorio = Formata::Resultado($zion);
if ($produtoRelatorio) {
    $totalProdutos = $zion->getContaLinhas();
    foreach ($zion->getResultado() as $produto) {
        $produto = (object) $produto;
        $estoque += $produto->estoque;
        $visitas += $produto->visitas;
    }
}

?>
<div class="main-content">
    <section class="section">
        <div class="section-body">

            <!-- INICIO CONTADOR DE VISITAS EM PRODUTOS -->
            <div class="row clearfix">

                <!-- INICIO CONTADOR DE VISITAS EM PRODUTOS -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Totalizações Gerais</h4>
                        </div>
                        <div class="card-body">
                            <div class="recent-report__chart">
                                <div id="barChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CONTADOR DE VISITAS EM PRODUTOS -->

            </div>
            <!-- FIM CONTADOR DE VISITAS EM PRODUTOS -->

        </div>
    </section>


</div>

<script>
    /** 
     * 
     * graficos totais produtos
     * MAYKONSILVEIRA.COM.BR
     * 
     */
    function barChart() {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end



        // Create chart instance
        var chart = am4core.create("barChart", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();


        // Add data
        chart.data = [


            {
                "country": "Total Estoque",
                "visits": <?= $estoque ?>
            },

            {
                "country": "Total Visitas",
                "visits": <?= $visitas ?>
            },

            {
                "country": "Total Produtos",
                "visits": <?= $totalProdutos ?>,
            },


        ];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;
        categoryAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;
        valueAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;


        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        // on hover, make corner radiuses bigger
        let hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", (fill, target) => {
            return chart.colors.getIndex(target.dataItem.index);
        })

        // Cursor
        chart.cursor = new am4charts.XYCursor();
    }
</script>