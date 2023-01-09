<table class="table table-bordered table-hover" id="tableBodyScroll">
    <thead>
        <tr>
            <th  style="width: 5%;">#</th>
            <th  style="width: 5%;">Année</th>
            <!--<th  style="width: 30%;">Agent</th>-->
            <th  style="width: 30%;">Type Congé </th>
            <th style="width: 10%;" >Droit </th>
            <th style="width: 10%;" >Congé Consommé</th>
            <th style="width: 10%;" >Congé Restant</th>
        </tr>
       
    </thead>
    <tbody style="height: 108px;">
        <?php if ($conges->count() != 0): ?>
            <?php $i = 1; ?>
            <?php foreach ($conges as $conge): ?>
                <tr>
                    <td style="text-align: center; width: 5%;"><?php echo $i; ?></td>
                      <td style="text-align: center; width: 5%;"><?php echo $conge->getAnnee() ?></td>
                    <!--<td style="width: 30%;"><?php // echo $conge->getAgents() ?></td>-->
                    <td style=" width: 30%;"><?php echo $conge->getTypeconge()->getLibelle() ?></td>
                      <td style="text-align: center; width: 10%;"><?php echo $conge->getNbjcongeannuelle() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $conge->getNbrcongeralise() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $conge->getNbrcongerestant()   ?></td>
                </tr>
                <?php $i++; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; font-size: 16px; vertical-align: middle; padding-top: 37px; padding-bottom: 38px;">Pas d'historique pou ce Agent  </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


<?php if ($conges->count() != 0): ?>
    <script type="text/javascript">

//        $('#container_conge').highcharts({
//        chart: {
//        type: 'bar'
//        },
//                title: {
//                text: 'Presnce par Agent :<br><?php // echo $conge->getNbrcongeralise() ?>',
//                },
//                xAxis: {
//                categories: ['Nb.H.N', 'Nb.H.S', 'NB.Abs'],
//                },
//                yAxis: {
//                min: 0,
//                        title: {
//                        text: ' Suivi Presence Par Agent'
//                        }
//                },
//                legend: {
//                backgroundColor: '#FFFFFF',
//                        reversed: true
//                },
//                plotOptions: {
//                series: {
//                stacking: 'normal'
//                }
//                },
//                series: [
//    <?php // foreach ($conges as $conge): ?>
//                    {
//                    name: "<?php // echo $conge->getAgents() ?>",
//                            data: [<?php // echo $conge->getNbrcongeralise() ?>, <?php // echo $conge->getNbjcongeannuelle() ?>, <?php // echo $conge->getAnnee() ?>, <?php // echo $evaluation->getDegreobjectif()   ?>, <?php // echo $evaluation->getStructureprog()   ?>],
//                    },
//    <?php // endforeach; ?>
//                ]
//        });
        
         $('#container_conge').highcharts({
        chart: {
        type: 'bar'
        },
                title: {
                text: 'Suivi Congé par Agent :<br><?php echo $conge->getAgents() ?>',
                },
                xAxis: {
                categories: ['Droit', 'C.Prise', 'C.Restant'],
                },
                yAxis: {
                categoties: ['1','2','3','4','5','6','7']
                },
                        
                legend: {
                backgroundColor: '#FFFFFF',
                        reversed: true
                },
                plotOptions: {
                series: {
                stacking: 'normal'
                }
                },
                series: [
    <?php foreach ($conges as $conge): ?>
                    {
                    name: "<?php echo  $conge->getTypeconge()->getlibelle() ?>",
                            data: [<?php echo $conge->getNbjcongeannuelle() ?>, <?php echo $conge->getNbrcongeralise() ?>, <?php echo $conge->getNbrcongerestant() ?>],
                    },
    <?php endforeach; ?>
                ]
        });
         $('#container_agent_conge').highcharts({
        chart: {
        polar: true,
                type: 'line'
        },
                title: {
                text: 'Congé par Agent :<br><?php echo $conge->getAgents()->getNomcomplet()." ".$conge->getAgents()->getPrenom() ?>',
//                        x: - 80
                },
                pane: {
//                size: '80%'
                },
                xAxis: {
                categories: ['Droit', 'C.Prise', 'C.Restant'],
                        tickmarkPlacement: 'on',
                        lineWidth: 0
                },
                yAxis: {
                gridLineInterpolation: 'polygon',
                        lineWidth: 0,
                        min: 0
                },
                tooltip: {
                shared: true,
                        pointFormat: '<span style="color:{series.color}">Agent : {series.name}: <b>{point.y}</b><br/>'
                },
                legend: {
                align: 'right',
                        verticalAlign: 'top',
                        y: 70,
                        layout: 'vertical'
                },
                series: [
    <?php foreach ($conges as $conge): ?>
                    {
                    name: "<?php echo $conge->getTypeconge()->getlibelle() ?>",
                            data: [<?php echo $conge->getNbjcongeannuelle() ?>, <?php echo $conge->getNbrcongeralise() ?>, <?php echo $conge->getNbrcongerestant() ?>],
                            pointPlacement: 'on'
                    },
    <?php endforeach; ?>
                ]
        });
              
    </script>
<?php else: ?>
    <script>
                $('#container_conge').html('');
                $('#container_agent_conge').html('');
    </script>
<?php endif; ?>

<style>

    .table > thead > tr > th {text-align: center;}

    #tableBodyScroll tbody {
        display: block;
        max-height: 300px;
        overflow-y: scroll;
    }

    #tableBodyScroll thead, tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

</style>