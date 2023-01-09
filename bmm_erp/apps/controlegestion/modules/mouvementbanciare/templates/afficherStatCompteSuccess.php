<?php $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre"); ?>
<script type="text/javascript">

    var colors = Highcharts.getOptions().colors,
            categories = [<?php foreach ($comptes as $compte): ?>'<?php echo substr($compte, 0, 8); ?>',<?php endforeach; ?>],
            name = 'Compte Bancaire',
            data = [
<?php $i = 0; ?>
<?php foreach ($comptes as $compte): ?>
                {
    <?php if (isset($liste[$compte->getId()])): ?>
                    y: <?php echo number_format($liste[$compte->getId()]['total'] * 100 / $total_tous, 2); ?>,
    <?php else: ?>
                    y: 0,
    <?php endif; ?>
                color: colors[<?php echo $i; ?>],
                        drilldown: {
                        name: '<?php echo $compte; ?>',
                <?php if (isset($liste[$compte->getId()])): ?>
                                categories: [<?php for($j = 0; $j < sizeof($rubriques); $j++): ?>'<?php echo $rubriques[$j]['libellerubrique'] ?>',<?php endfor; ?>],
                                data: [<?php for($j = 0; $j < sizeof($rubriques); $j++): ?><?php echo number_format($rubriques[$j]['total'] * 100 / $liste[$compte->getId()]['total'], 2) ?>,<?php endfor; ?>],
                       <?php else: ?>
                    categories: [],
                            data: [],
    <?php endif; ?>         
                                color: colors[<?php echo $i; ?>]
                        }
                },
    <?php $i++; ?>
<?php endforeach; ?>
            ];
            // Build the data arrays
            var browserData = [];
            var versionsData = [];
            for (var i = 0; i < data.length; i++) {

    // add browser data
    browserData.push({
    name: categories[i],
            y: data[i].y,
            color: data[i].color
    });
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
    var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5;
            versionsData.push({
            name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
    }
    }

    // Create the chart
    $('#container').highcharts({
    chart: {
    type: 'pie'
    },
            title: {
            text: 'Répartition Budgétaire par Compte Bancaire, <?php echo $array[intval($mois)]; ?>, <?php echo $annee ?>'
            },
            yAxis: {
            title: {
            text: 'Pourcentage'
            }
            },
            plotOptions: {
            pie: {
            shadow: false,
                    center: ['50%', '50%']
            }
            },
            tooltip: {
            valueSuffix: '%'
            },
            series: [{
            name: 'Compte Bancaire',
                    data: browserData,
                    size: '60%',
                    dataLabels: {
                    formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                    },
                            color: 'white',
                            distance: - 30
                    }
            }, {
            name: 'Rubrique Budgétaire',
                    data: versionsData,
                    size: '80%',
                    innerSize: '60%',
                    dataLabels: {
                    formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%' : null;
                    }
                    }
            }]
    });


</script>