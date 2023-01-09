<?php $marche = MarchesTable::getInstance()->find($id);
 $data=[];?>

 <?php foreach ($marche->getLots() as $lot): ?>
                {
                name: "<?php echo $lot->getFournisseur()->getRs(); ?>",
                        // Define the data points. All series have a dummy year
                        // of 1970/71 in order to be compared on the same x axis. Note
                        // that in JavaScript, months start at 0 for January, 1 for February etc.
                        <!-- <?php //echo date('m', strtotime($details->getDatecreation())) - 1; ?>, <?php //echo date('d', strtotime($details->getDatecreation())); ?>), <?php //echo $montant; ?>] -->
                <?php $montant = 0; ?>
                <?php foreach ($lot->getDetailprix() as $details): ?>
                        <?php if ($details->getIdTypedetailprix() == 3 || $details->getIdTypedetailprix() == 4): ?>
                        <?php $montant = $montant + $details->getNetapayer(); ?>
                        <?php $data[]= date('Y', strtotime($details->getDatecreation())); ?>
                        <?php endif; ?>
    <?php endforeach; ?>
                        
                },
        <?php endforeach; ?>
        
<script>
 var name=<?php echo json_encode($data);?>;
 var data=<?php echo json_encode($data);?>;
    $(function () {
      
       //console.log(<?php echo json_encode($data);?>);
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
            series: [
                name:["2000","2001","2002"],
                data:[2000,2001,2002],
            ],
    });
    });
console.log("test "+name);
</script>