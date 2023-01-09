<table class="table table-bordered table-hover" id="tableBodyScroll">
    <thead>
         <tr>
            <th  style="width: 5%;">#</th>
            <th  style="width: 30%;">Agents</th>
            <th  style="width: 5%;">Année</th>
            <th   style="width: 10%;">Droit Congé </th>
            <th  style="width: 10%;">Congé Prise </th>
            <th  style="width: 10%;" >Congé Restant</th>
        </tr>
       
       
    </thead>
    <tbody style="height: 108px;">
          <?php if ($congesPartype->count() != 0): ?>
            <?php $i = 1; ?>
            <?php foreach ($congesPartype as $congesT): ?>
                <tr>
                    <td style="text-align: center; width: 5%;"><?php echo $i; ?></td>
                    <td style="text-align: center; width: 30%;"><?php echo $congesT->getAgents() ?></td>
                    <td style="width: 5%;"><?php echo $congesT->getAnnee() ?></td>
                      <td style="text-align: center; width: 10%;"><?php echo $congesT->getNbjcongeannuelle() ?></td>
                    <td style=" width: 10%;"><?php echo $congesT->getNbrcongeralise() ?></td>
                     <td style=" width: 10%;"><?php echo $congesT->getNbrcongerestant() ?></td>
                       </tr>
                <?php $i++; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; font-size: 16px; vertical-align: middle; padding-top: 37px; padding-bottom: 38px;">Pas d'historique  </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php if ($congesPartype->count() != 0): ?>
    <script type="text/javascript">

        $('#container_type').highcharts({
        chart: {
        type: 'bar'
        },
                title: {
                text: 'Suivi  Par Type Congé :<br><?php // echo $presences->getAgents() ?>',
                },
                xAxis: {
                categories: ['Droit', 'Prise', 'Restant'],
                },
                yAxis: {
                min: 0,
                        title: {
                        text: 'Suivi  Par Type Congé'
                        }
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
    <?php foreach ($congesPartype as $congesT): ?>
                    {
                    name: "<?php echo $congesT->getAgents()->getNomcomplet()." ". $congesT->getAgents()->getPrenom() ?>",
                            data: [<?php echo $congesT->getNbjcongeannuelle() ?>, <?php echo $congesT->getNbrcongeralise()?>, <?php echo $congesT->getNbrcongerestant() ?>],
                    },
    <?php endforeach; ?>
                ]
        });
        $('#container_agent_type').highcharts({
        chart: {
        polar: true,
                type: 'line'
        },
                title: {
                text: 'Suivi  Par Type Congé :<br><?php // echo $presences->getAgents() ?>',
                        x: - 80
                },
                pane: {
                size: '80%'
                },
                xAxis: {
                categories: ['Droit', 'Prise', 'Restant'],
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
    <?php foreach ($congesPartype as $congesT): ?>
                    {
                    name: "<?php echo $congesT->getAgents()->getNomcomplet()." ". $congesT->getAgents()->getPrenom()?>",
                            data: [<?php echo $congesT->getNbjcongeannuelle() ?>, <?php echo $congesT->getNbrcongeralise()?>, <?php echo $congesT->getNbrcongerestant() ?>],
                    },
    <?php endforeach; ?>
                ]
        });
             
    </script>
<?php else: ?>
    <script>
                $('#container_type').html('');
                $('#container_agent_type').html('');
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