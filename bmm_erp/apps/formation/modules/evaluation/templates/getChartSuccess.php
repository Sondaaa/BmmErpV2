<table class="table table-bordered table-hover" id="tableBodyScroll">
    <thead>
        <tr>
            <th rowspan="2" style="width: 10%;">#</th>
            <th rowspan="2" style="width: 40%;">Agent</th>
            <th colspan="5">Évaluation</th>
        </tr>
        <tr>
            <th style="width: 10%;">C.H.R</th>
            <th style="width: 10%;">C.M</th>
            <th style="width: 10%;">P.F</th>
            <th style="width: 10%;">D.A.L</th>
            <th style="width: 10%;">S.C.P</th>
        </tr>
    </thead>
    <tbody style="height: 108px;">
        <?php if ($evaluations->count() != 0): ?>
            <?php $i = 1; ?>
            <?php
            $total_chr = 0;
            $total_cm = 0;
            $total_pf = 0;
            $total_dal = 0;
            $total_scp = 0;
            ?>

            <?php foreach ($evaluations as $evaluation): ?>
                <tr>
                    <td style="text-align: center; width: 10%;"><?php echo $i; ?></td>
                    <td style="width: 40%;"><?php echo $evaluation->getAgents() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $evaluation->getConditionslogement() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $evaluation->getNotecomposant() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $evaluation->getNoteformateur() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $evaluation->getDegreobjectif() ?></td>
                    <td style="text-align: center; width: 10%;"><?php echo $evaluation->getStructureprog() ?></td>
                </tr>
                <?php $i++; ?>
                <?php
                $total_chr = $total_chr + $evaluation->getConditionslogement();
                $total_cm = $total_cm + $evaluation->getNotecomposant();
                $total_pf = $total_pf + $evaluation->getNoteformateur();
                $total_dal = $total_dal + $evaluation->getDegreobjectif();
                $total_scp = $total_scp + $evaluation->getStructureprog();
                ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; font-size: 16px; vertical-align: middle; padding-top: 37px; padding-bottom: 38px;">Pas d'évaluation pour cette formation</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<table class="table table-bordered table-hover" style="margin-bottom: 10px;">
    <tbody>
        <tr>
            <td style="text-align: center; width: 50%;">Note Moyenne / 3</td>
            <td style="text-align: center; width: 10%;"><?php echo number_format($total_chr / $evaluations->count(), 2, '.', '') ?></td>
            <td style="text-align: center; width: 10%;"><?php echo number_format($total_cm / $evaluations->count(), 2, '.', '') ?></td>
            <td style="text-align: center; width: 10%;"><?php echo number_format($total_pf / $evaluations->count(), 2, '.', '') ?></td>
            <td style="text-align: center; width: 10%;"><?php echo number_format($total_dal / $evaluations->count(), 2, '.', '') ?></td>
            <td style="text-align: center; width: 10%;"><?php echo number_format($total_scp / $evaluations->count(), 2, '.', '') ?></td>
        </tr>
    </tbody>
</table>
<ul>
    <li>C.H.R : Évaluation des Conditions d'Hébérgement et de Restauration</li>
    <li>C.M : Évaluation des Conditions Matérielles</li>
    <li>P.F : Évaluation de la Performance du Formateur</li>
    <li>D.A.L : Degré d'Atteinte de l'Objectif</li>
    <li>S.C.P : Structure et Contenu du Programme</li>
</ul>

<?php if ($evaluations->count() != 0): ?>
    <script type="text/javascript">

        $('#container').highcharts({
        chart: {
        type: 'bar'
        },
                title: {
                text: 'Evaluation de la Formation par Agent :<br><?php echo $evaluation->getBesoinsdeformation() ?>',
                },
                xAxis: {
                categories: ['C.H.R', 'C.M', 'P.F', 'D.A.L', 'S.C.P'],
                },
                yAxis: {
                min: 0,
                        title: {
                        text: 'Evaluation de la Formation'
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
    <?php foreach ($evaluations as $evaluation): ?>
                    {
                    name: "<?php echo $evaluation->getAgents() ?>",
                            data: [<?php echo $evaluation->getConditionslogement() ?>, <?php echo $evaluation->getNotecomposant() ?>, <?php echo $evaluation->getNoteformateur() ?>, <?php echo $evaluation->getDegreobjectif() ?>, <?php echo $evaluation->getStructureprog() ?>],
                    },
    <?php endforeach; ?>
                ]
        });
                $('#container_agent').highcharts({
        chart: {
        polar: true,
                type: 'line'
        },
                title: {
                text: 'Evaluation de la Formation par Agent :<br><?php echo $evaluation->getBesoinsdeformation() ?>',
                        x: - 80
                },
                pane: {
                size: '80%'
                },
                xAxis: {
                categories: ['C.H.R', 'C.M', 'P.F', 'D.A.L', 'S.C.P'],
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
    <?php foreach ($evaluations as $evaluation): ?>
                    {
                    name: "<?php echo $evaluation->getAgents() ?>",
                            data: [<?php echo $evaluation->getConditionslogement() ?>, <?php echo $evaluation->getNotecomposant() ?>, <?php echo $evaluation->getNoteformateur() ?>, <?php echo $evaluation->getDegreobjectif() ?>, <?php echo $evaluation->getStructureprog() ?>],
                            pointPlacement: 'on'
                    },
    <?php endforeach; ?>
                ]
        });
                $('#container_moyenne').highcharts({
        chart: {
        polar: true,
                type: 'line'
        },
                title: {
                text: 'Note Moyenne de la Formation',
                        x: - 80
                },
                pane: {
                size: '80%'
                },
                xAxis: {
                categories: ['C.H.R', 'C.M', 'P.F', 'D.A.L', 'S.C.P'],
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
                {
                name: "Note Moyenne",
                        data: [<?php echo number_format($total_chr / $evaluations->count(), 2, '.', '') ?>, <?php echo number_format($total_cm / $evaluations->count(), 2, '.', '') ?>, <?php echo number_format($total_pf / $evaluations->count(), 2, '.', '') ?>, <?php echo number_format($total_dal / $evaluations->count(), 2, '.', '') ?>, <?php echo number_format($total_scp / $evaluations->count(), 2, '.', '') ?>],
                        pointPlacement: 'on'
                }
                ]
        });</script>
<?php else: ?>
    <script>
                $('#container').html('');
                $('#container_agent').html('');
                $('#container_moyenne').html('');
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