<?php
$array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
$sous_label = '';
for ($i = 0; $i < sizeof($liste_detail_prix); $i++):
    $sous_label = $sous_label . "'" . $array[intval(date('m', strtotime($liste_detail_prix[$i]['datecreation'])))] . '-' . date('Y', strtotime($liste_detail_prix[$i]['datecreation'])) . "'" . ',';
endfor;
$label_article = '';
for ($i = 0; $i < sizeof($articles); $i++):
    $label_article = $label_article . "'" . $articles[$i]['libelle'] . "'" . ",";
endfor;
?>

<script type="text/javascript">

    var colors = Highcharts.getOptions().colors,
            categories = [<?php echo trim($label_article) ?>],
            name = 'Liste des Articles',
            data = [
<?php for ($i = 0; $i < sizeof($articles); $i++): ?>
                {
                y: <?php echo number_format(($liste[$articles[$i]['id']]['progress'] * 100) / $liste[$articles[$i]['id']]['totalttc'], 2); ?>,
                        color: colors[0],
                        drilldown: {
                        name: '<?php echo $articles[$i]['libelle']; ?>',
                                categories: [<?php echo $sous_label; ?>],
                                data: [
    <?php for ($j = 0; $j < sizeof($liste_detail_prix); $j++): ?>
        <?php $trouve = 0; ?>
        <?php for ($k = 0; $k < sizeof($articles_decompte); $k++): ?>
            <?php if (trim($articles[$i]['libelle']) == trim($articles_decompte[$k]['libelle']) && $liste_detail_prix[$j]['id'] == $articles_decompte[$k]['id_detail']): ?>
                <?php echo number_format(($articles_decompte[$k]['totalmois'] * 100) / $liste[$articles[$i]['id']]['totalttc'], 2); ?>,
                <?php $trouve = 1; ?>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($trouve == 0): ?>
            <?php echo '0' ?>,
        <?php endif; ?>
    <?php endfor; ?>
                                ],
                                color: colors[0]
                        }
                },
<?php endfor; ?>
            ];
            function setChart(name, categories, data, color) {
            chart.xAxis[0].setCategories(categories, false);
                    chart.series[0].remove(false);
                    chart.addSeries({
                    name: name,
                            data: data,
                            color: color || 'white'
                    }, false);
                    chart.redraw();
            }

    var chart = $('#container').highcharts({
    chart: {
    type: 'column'
    },
            title: {
            text: 'Progression des décomptes des Articles, Marché : <?php echo $marches ?>, Bénéficiaire : <?php echo $beneficiaire ?>',
            },
            subtitle: {
            text: 'Cliquez sur les colonnes pour afficher les décomptes. Cliquez à nouveau pour voir les articles.'
            },
            xAxis: {
            categories: categories
            },
            yAxis: {
            title: {
            text: 'Progression des décomptes en %'
            }
            },
            plotOptions: {
            column: {
            cursor: 'pointer',
                    point: {
                    events: {
                    click: function () {
                    var drilldown = this.drilldown;
                            if (drilldown) { // drill down
                    setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                    } else { // restore
                    setChart(name, categories, data);
                    }
                    }
                    }
                    },
                    dataLabels: {
                    enabled: true,
                            color: colors[0],
                            style: {
                            fontWeight: 'bold'
                            },
                            formatter: function () {
                            return this.y + '%';
                            }
                    }
            }
            },
            tooltip: {
            formatter: function () {
            var point = this.point,
                    s = this.x + ':<b>' + this.y + '% du progression</b><br/>';
                    if (point.drilldown) {
            s += 'Cliquez pour afficher ' + point.category + ' décomptes';
            } else {
            s += 'Cliquez pour retourner aux articles';
            }
            return s;
            }
            },
            series: [{
            name: name,
                    data: data,
                    color: 'white'
            }],
            exporting: {
            enabled: false
            }
    }).highcharts(); // return chart

</script>