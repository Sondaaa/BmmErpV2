<?php
$var = 0;
$conn = Doctrine_Manager::getInstance()->getCurrentConnection();
$query = " SELECT grillepresence.jour as jour , motif.libelle as motif"
        . " FROM grillepresence , motif, presence"
        . " WHERE presence.id_agents=" . $id
        . " and grillepresence.id_presnece = presence.id"
        . " and grillepresence.id_motif=motif.id"
        . " and motif.id IS NOT NULL"
        . " and grillepresence.semaine='" . $var . "'"


;
$resultat = $conn->fetchAssoc($query);
?>
<table class="table table-bordered table-hover" id="tableBodyScroll" style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2" style="width: 10%;">#</th>
            <th rowspan="2"  style="width: 10%;">Année</th>
            <th rowspan="2"  style="width: 10%;">Mois</th>
            <th colspan="2"  style="width: 30%;">Présence</th>
            <th  style="width: 30%;" >Absence</th>
        </tr>
        <tr>
            <th style="width: 15%;">T.H.Normal</th>
            <th style="width: 15%;" >T.H.Supp </th>
            <th >Nbr.Jour Abscence</th>
<!--            <th style="width: 15%;" >Motif </th>-->
        </tr>
    <input type="hidden" id='annee' value="<?php echo $mois; ?> ">
    <input type="hidden" id='mois' value="<?php echo $annee; ?> ">

    </thead>
    <tbody style="height: 108px;">
        <?php if ($presences->count() != 0): ?>
            <?php $i = 1; ?>
            <?php foreach ($presences as $presence): ?>

                <tr>
                    <td style="text-align: center; width: 11%;"><?php echo $i; ?></td>
                    <td style="text-align: center; width: 12%;"><?php echo $presence->getAnnee() ?></td>
                    <td style="width: 11%;"><?php echo html_entity_decode(strftime("%B", strtotime(date("Y") . "-" . $presence->getMois() . "-" . date("d")))) ?></td>
                    <td style=" width: 17%;"><?php echo $presence->getNbrtotalnormal() ?></td>
                    <td style="text-align: center; width: 17%;"><?php echo $presence->getNbhsupp() ?></td>
                    <?php // for ($j = 0; $j < sizeof($resultat); $j++): ?>      
                    <td style="text-align: center;" >
                        <?php echo sizeof($resultat); ?> 
                        <button type="button" id='btn_<?php echo $i; ?>' class="btn btn-outline btn-success width-fixed" onclick="getDetail('<?php echo $i; ?>', '<?php echo $mois; ?>', '<?php echo $annee; ?>')"><i class="fa fa-eye"></i></button>
                    </td>
                    <?php // endfor; ?>
                <!--<td style="text-align: center; width: 15%;"><?php // echo $resultat[$j]['motif']  ?></td>-->
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
<ul>
    <li>NB.H.N : Nombre d'Heures Normales </li>
    <li>N.H.S : Nombre d'Heures Supplimentaires</li>
    <li>Nb.J.Abs: Nombre Jour d'Absence Non Justifiée</li>

</ul>

<script>
            function getDetail(i, mois, annee) {
            $.ajax({
            url: '<?php echo url_for('conge/affichedetail') ?>',
                    data: 'id=' + i + '&mois=' + mois + '&annee=' + annee,
                    success: function (data) {
                    bootbox.confirm({
                    message: data,
                            buttons: {
                            cancel: {
                            label: "Annuler",
                                    className: "btn-sm",
                            },
                                    confirm: {
                                    label: "Valider",
                                            className: "btn-primary btn-sm",
                                    }
                            },
                            callback: function (result) {
                            if (result) {
                            chargerCodeMotif(i);
                            }
                            }
                    });
                    }
            });
            }
</script>
<?php if ($presences->count() != 0): ?>
    <script type="text/javascript">

        $('#container_pres').highcharts({
        chart: {
        type: 'bar'
        },
                title: {
                text: 'Suivi Présence par Agent :<br><?php echo $presences->getFirst()->getAgents()->getNomcomplet() . " " . $presences->getFirst()->getAgents()->getPrenom() ?>',
                },
                xAxis: {
                categories: ['NB.H.N', 'N.H.S', 'Nb.J.Abs'],
                },
                yAxis: {
                min: 0,
                        title: {
                        text: 'Suivi Présence'
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
    <?php foreach ($presences as $presence): ?>
                    {
                    name: "<?php echo $presence->getAgents() ?>",
                            data: [<?php echo $presence->getNbrtotalnormal() ?>, <?php echo $presence->getNbhsupp() ?>, <?php echo (sizeof($resultat)) ?>],
                    },
    <?php endforeach; ?>
                ]
        });
                $('#container_agent_pr').highcharts({
        chart: {
        polar: true,
                type: 'line'
        },
                title: {
                text: 'Suivi Présence par Agent :<br><?php echo $presences->getFirst()->getAgents()->getNomcomplet() . " " . $presences->getFirst()->getAgents()->getPrenom() ?>',
                        x: - 80
                },
                pane: {
                size: '70%'
                },
                xAxis: {
                categories: ['Nb.H.N', 'Nb.H.S', 'Nb.J.Abs'],
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
    <?php foreach ($presences as $presence): ?>
                    {
                    name: "<?php echo $presence->getAgents() ?>",
                            data: [<?php echo $presence->getNbrtotalnormal() ?>, <?php echo $presence->getNbhsupp() ?>, <?php echo (sizeof($resultat)) ?>],
                            pointPlacement: 'on'
                    },
    <?php endforeach; ?>
                ]
        });</script>
<?php else: ?>
    <script>
                $('#container_pres').html('');
                $('#container_agent_pr').html('');



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