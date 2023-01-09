<?php $agent = Doctrine_Core::getTable('agents')->findOneById($id) ?>
<?php if ($presences->count() != 0): ?>
    <script type="text/javascript">
        $('#container_presence').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Suivi Présence Pour :<br> <?php echo trim($agent->getNomcomplet()) . " " . trim($agent->getPrenom()); ?> en <?php echo $annee ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Suivi Presence',
                    data: [
                        ['Présence <?php echo $presences[0]['nbpresence']; ?> Jour ',<?php echo $presences[0]['nbpresence']; ?>],
                        ['Absence <?php echo $absences[0]['nbrjabsence'] + $conges[0]['conge'] ?> Jour',<?php echo $absences[0]['nbrjabsence'] + $conges[0]['conge'] ?>]
                    ]
                }]
        });
        $('#container_absence').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Detail Absence Pour :<br> <?php echo trim($agent->getNomcomplet()) . " " . trim($agent->getPrenom()); ?> en <?php echo $annee ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Detail Absence ',
                    data: [
                        ['Absence Irrégulière <?php echo $absences[0]['nbrjabsence'] ?> Jour',<?php echo $absences[0]['nbrjabsence'] ?>],
                        ['Congé <?php echo $conges[0]['conge'] ?> Jour',<?php echo $conges[0]['conge'] ?>]
                    ]
                }]
        });
    </script>
<?php else: ?>
    <script>

        $('#container_presence').html('');
        $('#container_absence').html('');
    </script>
<?php endif; ?>