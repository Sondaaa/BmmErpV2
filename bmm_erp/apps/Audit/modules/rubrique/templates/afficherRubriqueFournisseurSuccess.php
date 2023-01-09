<table class="table table-bordered table-hover" cellspacing="0">
    <thead>
        <tr>
            <td style="width: 40%;">Budget</td>
            <td style="width: 40%;">Rubrique Budgétaire</td>
            <td style="width: 20%;">Total Engagé</td>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php if ($listes->count() != 0): ?>
            <?php foreach ($listes as $liste): ?>
                <tr>
                    <td><?php echo $liste->getTitrebudjet()->getLibelle(); ?></td>
                    <td><?php echo $liste->getRubrique(); ?></td>
                    <td style="text-align: center;"><?php echo $liste->getTotal(); ?></td>
                </tr>
                <?php $total = $total + $liste->getTotal(); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align: center; font-size: 16px; height: 100px; vertical-align: middle;">Pas d'engagement budgétaire pour ce fournisseur.</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr style="background-color: #ECECEC;">
            <td colspan="2" style="text-align: right; padding-right: 10px;">Total</td>
            <td style="text-align: center;"><?php echo $total; ?></td>
        </tr>
    </tfoot>
</table>
<?php if ($listes->count() != 0): ?>
    

    <script type="text/javascript">

        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Répartition des engagements budgétaires par rubrique budgétaire : Exercice <?php echo $exercice; ?><br><?php echo $fournisseur; ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
    <?php foreach ($listes as $liste): ?>
                            ['<?php echo $liste->getRubrique(); ?>', <?php echo $liste->getTotal(); ?>],
    <?php endforeach; ?>
                    ]
                }]
        });

    </script>
<?php endif; ?>