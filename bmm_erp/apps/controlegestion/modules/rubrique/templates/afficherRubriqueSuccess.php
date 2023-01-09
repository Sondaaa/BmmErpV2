<script type="text/javascript">

    $('#container').highcharts({
    chart: {
    type: 'column'
    },
            title: {
            text: 'Evolution des engagements budgétaire : <?php echo $rubrique->getTitrebudjet()->getLibelle() . ' : ' . $rubrique->getRubrique(); ?>'
            },
            subtitle: {
            text: 'Exercice : <?php echo $exercice; ?>'
            },
            xAxis: {
            categories: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Nouvembre', 'Décembre']
            },
            yAxis: {
            min: 0,
                    title: {
                    text: 'Total engagé par rapport au budget'
                    }
            },
            tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} TND</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
            },
            plotOptions: {
            column: {
            pointPadding: 0.2,
                    borderWidth: 0
            }
            },
            series: [{
            name: 'Montant Global',
                    data: [
<?php $flag = 0; ?>
<?php
for ($i = 0; $i < 12; $i++):
    ?>
    <?php if ($flag == 0): ?>
        <?php if($i < intval(date('m'))): echo $rubrique->getMnt(); else: echo '0'; endif; ?>
    <?php else: ?>
                            ,<?php if($i < intval(date('m'))): echo $rubrique->getMnt(); else: echo '0'; endif; ?>
    <?php endif; ?>
    <?php $flag ++; ?>
<?php endfor; ?>
                    ]

            }, {
            name: 'Encaissé',
                    data: [
<?php $flag = 0; ?>
<?php
for ($i = 0; $i < 12; $i++):
    ?>
    <?php if ($flag == 0): ?>
        <?php if($i < intval(date('m'))): echo $rubrique->getMntencaisse(); else: echo '0'; endif; ?>
    <?php else: ?>
                            ,<?php if($i < intval(date('m'))): echo $rubrique->getMntencaisse(); else: echo '0'; endif; ?>
    <?php endif; ?>
    <?php $flag ++; ?>
<?php endfor; ?>
                    ]

            },{
            name: 'Reliquat',
                    data: [
<?php $flag = 0; ?>
<?php $total = $rubrique->getMntencaisse() - $rubrique->getMntprovisoire(); ?>
<?php
for ($i = 0; $i < sizeof($listes); $i++):
    $total = $total - $listes[$i]['total'];
    ?>
    <?php if ($flag == 0): ?>
        <?php if($i < intval(date('m'))): echo $total; else: echo '0'; endif; ?>
    <?php else: ?>
                            ,<?php if($i < intval(date('m'))): echo $total; else: echo '0'; endif; ?>
    <?php endif; ?>
    <?php $flag ++; ?>
<?php endfor; ?>
                    ]

            },{
            name: 'Engagé + Provisoire',
                    data: [
<?php $flag = 0; ?>
<?php $total = $rubrique->getMntprovisoire(); ?>
<?php
for ($i = 0; $i < sizeof($listes); $i++):
    $total = $total + $listes[$i]['total'];
    ?>
    <?php if ($flag == 0): ?>
        <?php if($i < intval(date('m'))): echo $total; else: echo '0'; endif; ?>
    <?php else: ?>
                            ,<?php if($i < intval(date('m'))): echo $total; else: echo '0'; endif; ?>
    <?php endif; ?>
    <?php $flag ++; ?>
<?php endfor; ?>
                    ]

            }]
    });

</script>