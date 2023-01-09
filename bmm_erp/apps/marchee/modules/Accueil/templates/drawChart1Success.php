<?php $marche = MarchesTable::getInstance()->find($id);?>

<script>

    $(function () {
    $('#container').highcharts({
    chart: {
    type: 'spline'
    },
            title: {
            text: 'Evolution du Marché : <?php echo $marche; ?>'
            },
            subtitle: {
            text: 'Evolution des paiements (Décomptes) par bénéficiaire'
            },
            xAxis: {
            type: 'datetime',
                    dateTimeLabelFormats: {// don't display the dummy year
                    month: '%e. %b',
                            year: '%b'
                    }
            },
            yAxis: {
            title: {
            text: 'Montant en DT'
            },
                    min: 0
            },
            tooltip: {
            formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%e. %b', this.x) + ': ' + this.y + ' DT';
            }
            },
            <?php $i = 1;?>
            series: [{
            name: '<?php echo "Lot" . $i; ?>',

                        // Define the data points. All series have a dummy year
                        // of 1970/71 in order to be compared on the same x axis. Note
                        // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
                        <?php foreach ($marche->getLots() as $lot): ?>
                                 <?php $montant = 0;?>
    <?php foreach ($lot->getDetailprix() as $details): ?>
        <?php if ($details->getIdTypedetailprix() == 3 || $details->getIdTypedetailprix() == 4): ?>
            <?php $montant = $montant + $details->getNetapayer();?>
                                [ <?php echo $montant; ?>],
        <?php endif;?>
    <?php endforeach;?>
                        ]
                },
<?php endforeach;?> <?php $i++;?>
            ]
    });
    });

</script>