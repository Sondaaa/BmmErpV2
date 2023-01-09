<div id="sf_admin_container">
    <h1 id="replacediv"> Contrat Achat   
        <small><i class="ace-icon fa fa-angle-double-right"></i> Tableau de Bord</small>
    </h1>
</div>
<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-orange ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter" style="float: left;">
                <i class="ace-icon fa fa-table"></i>
                Evolution des Contrats Courant: 
            </h5>
            <div style="width: 30%; float: left; margin-left: 1%; margin-top: 3px;">
                <?php
                $documentachats = DocumentachatTable::getInstance()->getbyContrat();
                if (sizeof($documentachats) >= 1) {
                    foreach ($documentachats as $documentachat)
                        $doc_factures = DocumentachatTable::getInstance()->getByDocparentAndTypedoc($documentachat->getId(), 15);
                }
                ?>
                <select id="marche_chart" onchange="drawChart()">
                    <option></option>
                    <?php
                    if (sizeof($documentachats) >= 1) {

                        foreach ($doc_factures as $contrat):
                            ?>
                            <option value="<?php echo $contrat->getId(); ?>"><?php echo $contrat->getContratachat()->getReference() . ' N°' . $contrat->getContratachat()->getNumero(); ?></option>
                            <?php
                        endforeach;
                    }
                    ?>
                </select>
            </div>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="red"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                    <div id="zone_success"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
<?php
if (sizeof($documentachats) >= 1) {
    if ($doc_factures->count() != 0):
        ?>
            $("#contrat_chart").val('<?php echo $doc_factures->getLast()->getId(); ?>');
    <?php
    endif;
}
?>
    drawChart();
    function drawChart() {
        if ($("#contrat_chart").val()) {
            $('#container').html('');
            $.ajax({
                url: '<?php echo url_for('Accueil/drawChart') ?>',
                data: 'id=' + $("#contrat_chart").val(),
                success: function (data) {
                    $('#zone_success').html(data);
                }
            });
        }
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-grey ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Contrat Provisoire Annulé
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageContratProviAnnule('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="contrat_prov_annule" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Date Création</th>
                                <th>Date Annulation</th>
                                <th>Motif d'annulation</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
<?php include_partial('listcontratproviAnnule', array('contratprofisoire' => $contratprofisoire)); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageContratProviAnnule(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageContraprovannule') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#contrat_prov_annule > tbody').html(data);
            }
        });
    }

</script>


<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>               
                Contrat Provisoire
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageContratProvisoir('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="contrat_provisoire" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th class="center">Nom Contrat & Numéro</th>
                                <th style="text-align: center;">Date Création</th>
                                <th style="text-align: center;">Numéro BCIS</th>
                                <th>Fournisseur</th>

                                <th style="text-align: center;">Mnt.Contrat</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
<?php include_partial('listContratProvisoire', array('contrat_provisoire' => $contrat_provisoire)); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function goPageContratProvisoir(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageContratProvisoire') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#contrat_provisoire > tbody').html(data);
            }
        });
    }

</script>



<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-purple ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Contrat Définitif Annulé
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageContratDefAnnule('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="contrat_def_annule" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Date Création</th>
                                <th>Date Annulation</th>
                                <th>Motif d'annulation</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
<?php include_partial('listcontratdefiAnnule', array('contratdefannule' => $contratdefannule)); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageContratDefAnnule(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageContradefannule') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#contrat_def_annule > tbody').html(data);
            }
        });
    }

</script>


<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Contrat définitif
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageContratCourant('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="contrat_courant" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th class="center">Nom Contrat & Numéro</th>
                                <th style="text-align: center;">Date Création</th>
                                <th style="text-align: center;">Numéro BCIS</th>
                                <th>Fournisseur</th>

                                <th style="text-align: center;">Mnt.Contrat</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
<?php include_partial('listContratCourant', array('contrat_courants' => $contrat_courants)); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function goPageContratCourant(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageContratCourant') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#contrat_courant > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-red ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Contrat définitif Résilié
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageContratResiliser('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="contrat_resilier" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Date Création</th>
                                <th>Date Résiliation </th>
                                <th>Motif de Résiliation </th>
                                <th>Montant Consommés </th>
                                <th>Montant Restant </th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
<?php include_partial('listContratresilier', array('contrat_resilier' => $contrat_resilier)); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function goPageContratResiliser(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageContratResilier') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#contrat_resilier > tbody').html(data);
            }
        });
    }

</script>
<style>

    .highcharts-contextmenu hr{margin-top: 5px;margin-bottom: 5px;}

</style>