
<?php
;
$agent = Doctrine_Core::getTable('marches')->findOneById($id)
?>
<?php if ($marche->count() != 0): ?>
    
        <script type="text/javascript">
            $('#container_presence_1').highcharts({
            chart: {
            type: 'area',
                    spacingBottom: 30
            },
                    title: {
                    text: 'Suivi Marche  <?php echo trim($marche->getNumero()) ;?>'
                    },
                    subtitle: {
                    text: 'Suivi Maarche',
                            floating: true,
                            align: 'right',
                            verticalAlign: 'bottom',
                            y: 15
                    },
                    legend: {
                    layout: 'vertical',
                            align: 'left',
                            verticalAlign: 'top',
                            x: 100,
                            y: 20,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: '#FFFFFF'
                    },
                    xAxis: {
                    categories: [
       
                    ]
                    },
                    yAxis: {
                    title: {
                    text: 'Suivi'
                    },
                            labels: {
                            formatter: function () {
                            return this.value;
                            }
                            }
                    },
                    tooltip: {
                    formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y;
                    }
                    },
                    plotOptions: {
                    area: {
                    fillOpacity: 0.5
                    }
                    },
                    credits: {
                    enabled: false
                    },
                    series: [{
                    name: '<?php echo trim($marche->getNumero()); ?>',
                            data: [
        <?php $flag = 0; ?>
        <?php foreach ($marche as $pr): ?>
            <?php if ($flag == 0): ?>
                <?php
              //  if ($pr->getSemaine() == 0): echo $pr->getSemaine();
                // else: echo "1";
                // endif;
                ?>
            <?php else: ?>
                                    ,<?php
                // if ($pr->getSemaine() == 0): echo $pr->getSemaine();
                // else: echo "1";
                // endif;
                ?>
            <?php endif; ?>
            <?php $flag ++; ?>
        <?php endforeach; ?>
                            ]
                    }]
            });</script>
   <?php endif; ?>

