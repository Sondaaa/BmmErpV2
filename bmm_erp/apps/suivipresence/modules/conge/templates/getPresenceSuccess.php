
<?php
if ($mois != 0):
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    $mois_presence = strftime('%B', strtotime(date('Y') . '-' . trim($mois) . '-01'));
else:
    $mois_presence = '';
endif;
$agent = Doctrine_Core::getTable('agents')->findOneById($id)
?>
<?php if ($presences->count() != 0): ?>
    <?php if ($mois != 0): ?>
        <script type="text/javascript">
            $('#container_presence_1').highcharts({
            chart: {
            type: 'area',
                    spacingBottom: 30
            },
                    title: {
                    text: 'Suivi Présence Par Mois de <?php echo trim($agent->getNomcomplet()) . " " . trim($agent->getPrenom()); ?>  en <?php echo $mois_presence . " " . $annee ?>'
                    },
                    subtitle: {
                    text: 'Suivi Présence Par Mois',
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
        <?php $flag = 0; ?>
        <?php
        for ($i = 1; $i <= date("t", strtotime(date('Y') . '-' . trim($mois) . '-01')); $i++):
            ?>
            <?php
            if ($i < 10): $jour = "0" . $i;
            else: $jour = $i;
            endif;
            ?>
            <?php if ($flag == 0): ?>
                            '<?php echo $i . '-' . html_entity_decode(strftime("%a", strtotime(trim($annee) . "-" . trim($mois) . "-" . $jour))); ?>'
            <?php else: ?>
                            , '<?php echo $i . '-' . html_entity_decode(strftime("%a", strtotime(trim($annee) . "-" . trim($mois) . "-" . $jour))); ?>'
            <?php endif; ?>
            <?php $flag ++; ?>
        <?php endfor; ?>
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
                    name: '<?php echo trim($agent->getNomcomplet()) . " " . trim($agent->getPrenom()); ?>',
                            data: [
        <?php $flag = 0; ?>
        <?php foreach ($presences as $pr): ?>
            <?php if ($flag == 0): ?>
                <?php
                if ($pr->getSemaine() == 0): echo $pr->getSemaine();
                else: echo "1";
                endif;
                ?>
            <?php else: ?>
                                    ,<?php
                if ($pr->getSemaine() == 0): echo $pr->getSemaine();
                else: echo "1";
                endif;
                ?>
            <?php endif; ?>
            <?php $flag ++; ?>
        <?php endforeach; ?>
                            ]
                    }]
            });</script>
    <?php else: ?>
        <script type="text/javascript">
                    $('#container_presence_annuelle').highcharts({
            chart: {
            type: 'column'
            },
                    title: {
                    text: 'Suivi Anuelle de <?php echo trim($agent->getNomcomplet()) . " " . trim($agent->getPrenom()) . " en " . $annee; ?> '
                    },
                    xAxis: {
                    categories: [
        <?php $flag = 0; ?>
        <?php
        for ($i = 0; $i < sizeof($presences); $i++):
            ?>
            <?php if ($flag == 0): ?>
                            '<?php echo $presences[$i]['mois']; ?>'
            <?php else: ?>
                            , '<?php echo $presences[$i]['mois']; ?>'
            <?php endif; ?>
            <?php $flag ++; ?>
        <?php endfor; ?>
        <?php
        for ($j = intval($presences[sizeof($presences) - 1]['mois']) + 1; $j < 12; $j++):
            ?>
            <?php if (intval($presences[sizeof($presences) - 1]['mois']) == 0 || $j == 0): ?>
                            '<?php echo str_pad($j + 1, 2, '0', STR_PAD_LEFT); ?>'
            <?php else: ?>
                            , '<?php echo str_pad($j + 1, 2, '0', STR_PAD_LEFT); ?>'
            <?php endif; ?>
        <?php endfor; ?>
                    ]
                    },
                    yAxis: {
                    min: 0,
                            title: {
                            text: 'Suivi'
                            },
                            stackLabels: {
                            enabled: true,
                                    style: {
                                    fontWeight: 'bold',
                                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                    }
                            }
                    },
                    legend: {
                    align: 'right',
                            x: - 70,
                            verticalAlign: 'top',
                            y: 20,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                    },
                    tooltip: {
                    formatter: function() {
                    return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>' + 'Absence' + ':';
                    }
                    },
                    plotOptions: {
                    column: {
                    stacking: 'normal',
                            dataLabels: {
                            enabled: true,
                                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                            }
                    }
                    },
                    series: [{
                    name: 'Présence',
                            data: [
        <?php $flag = 0; ?>
        <?php
        for ($i = 0; $i < sizeof($presences); $i++):
            ?>
            <?php if ($flag == 0): ?>
                <?php echo $presences[$i]['nbpresence']; ?>
            <?php else: ?>
                                    ,<?php echo $presences[$i]['nbpresence'] ?>
            <?php endif; ?>
            <?php $flag ++; ?>
        <?php endfor; ?>
        <?php
        for ($j = sizeof($presences) + 1; $j < 12; $j++):
            ?>
            <?php if (sizeof($presences) == 0 || $j == 0): ?>
                <?php echo "0"; ?>
            <?php else: ?>
                                    ,<?php echo "0"; ?>
            <?php endif; ?>
        <?php endfor; ?>
                            ]
                    }, {
                    name: 'Absence',
                            data: [
        <?php $flag = 0; ?>
        <?php
        for ($i = 0; $i < sizeof($absence); $i++):
            ?>
            <?php if ($flag == 0): ?>
                <?php echo $absence[$i]['nbrjabsence'] ?>
            <?php else: ?>
                                    ,<?php echo $absence[$i]['nbrjabsence'] ?>
            <?php endif; ?>
            <?php $flag ++; ?>
        <?php endfor; ?>
                            ]
                    }]
            });</script>
    <?php endif; ?>
<?php else: ?>
    <table class="table table-bordered table-hover" id="tableBodyScroll">
        <tbody>
            <tr>
                <td  style="text-align: center; width: 100%; font-size: 16px; vertical-align: middle; padding-top: 37px; padding-bottom: 38px;">Pas d'enregistrement pour <?php echo trim($agent->getNomcomplet()) . " " . trim($agent->getPrenom()); ?>  en <?php echo $mois_presence . " " . $annee ?></td>
            </tr>
        </tbody>
    </table>
    <script>

                $('#container_presence_1').html('');
                $('#container_presence_annuelle').html('');
    </script>
<?php endif; ?>