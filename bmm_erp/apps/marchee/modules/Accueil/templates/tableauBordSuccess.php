<div id="sf_admin_container">
    <h1 id="replacediv"> Marché
        <small><i class="ace-icon fa fa-angle-double-right"></i> Tableau de Bord</small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-orange ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter" style="float: left;">
                <i class="ace-icon fa fa-table"></i>
                Evolution des Marchés :
            </h5>
            <div style="width: 30%; float: left; margin-left: 1%; margin-top: 3px;">
                <?php $marches = MarchesTable::getInstance()->getAllOrderByNumero();?>
                <select id="marche_chart" onchange="drawChart()">
                <option></option>
                    <?php foreach ($marches as $marche): ?>
                        <option value="<?php echo $marche->getId(); ?>"><?php echo $marche; ?></option>
                    <?php endforeach;?>
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
                <div class="form-group" style="margin-bottom: 0px;" >
                    <div id="container" style="min-width: 381px; height: 281px; margin: 0 auto"></div>
                    <!-- <div id="zone_success"></div> -->
                    <div id="zone_success" style="display: block;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
<?php if ($marches->count() != 0): ?>
        $("#marche_chart").val('<?php echo $marches->getLast()->getId(); ?>');
<?php endif;?>
    drawChart();
    function drawChart() {
        if ($("#marche_chart").val()) {
         //   $('#container').html('');
            $.ajax({
                 url: '<?php echo url_for('Accueil/drawChart1') ?>',
                 data: 'id=' + $("#marche_chart").val(),
                 success: function (data) {
                    console.log('data='+ data);
                    $('#zone_success').fadeIn();
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
                B.C.I.M.P (Sans Visa)
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageBciWithoutVisa('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="bcimp_without_visa" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 10.5%; text-align: center;">N°</th>
                                <th style="width: 16.5%; text-align: center;">Date</th>
                                <th style="width: 14%; text-align: center;">B.C.I.M.P</th>
                                <th style="width: 37%;">Demandeur</th>
                                <th style="width: 24%; text-align: center;">M. Estimatif (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listBciWithoutVisa', array('bci_without_visa' => $bci_without_visa));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageBciWithoutVisa(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageBciWithoutVisa') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#bcimp_without_visa > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Marchés en Cours
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageMarcheCourant('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="marches_courant" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 8%; text-align: center;">N°</th>
                                <th style="width: 15%; text-align: center;">B.C.I.M.P</th>
                                 <th style="width: 25%;">Objet Marché</th>
                                <th style="width: 27%;">Projet</th>
                                <th style="width: 15%; text-align: center;">M. Global TTC (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listMarcheCourant', array('marche_courants' => $marche_courants));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageMarcheCourant(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageMarcheCourant') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#marches_courant > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-purple ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                B.C.I.M.P (Non affectés au Marché)
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageBciNotAffected('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="bcimp_not_affected" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 10.5%; text-align: center;">N°</th>
                                <th style="width: 16%; text-align: center;">Date</th>
                                <th style="width: 13.5%; text-align: center;">B.C.I.M.P</th>
                                <th style="width: 37%;">Demandeur</th>
                                <th style="width: 23%; text-align: center;">M. Estimatif (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listBciNotAffected', array('bci_not_affected' => $bci_not_affected));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageBciNotAffected(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageBciNotAffected') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#bcimp_not_affected > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-green2 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Bénéficiaires (Marchés en Cours)
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageBeneficiaireCourant('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="beneficiaire_courant" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 15%; text-align: center;">N° Ordre</th>
                                <th style="width: 18%; text-align: center;">Marché</th>
                                <th style="width: 45%;">Fournisseur</th>
                                <th style="width: 22%; text-align: center;">M. TTC. NET (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listBeneficiaireCourant', array('beneficiaire_courant' => $beneficiaire_courant));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageBeneficiaireCourant(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageBeneficiaireCourant') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#beneficiaire_courant > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                B.C.I.M.P (Marché en Cours)
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageBciCourant('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="bcimp_courant" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 12%; text-align: center;">N°</th>
                                <th style="width: 18%; text-align: center;">Date</th>
                                <th style="width: 15%; text-align: center;">B.C.I.M.P</th>
                                <th style="width: 33%;">
                                    Marché
                                    <span class="label label-success arrowed-in arrowed-in-right pull-right">
                                        Bénéficiaire
                                    </span>
                                </th>
                                <th style="width: 24%; text-align: center;">M. Estimatif (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listBciCourant', array('bci_courant' => $bci_courant));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageBciCourant(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageBciCourant') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#bcimp_courant > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Décomptes (Marché en Cours)
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageDecompte('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="decompte_courant" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 10%; text-align: center;">
                                    <span class="label label-primary arrowed-right">N°</span>
                                </th>
                                <th style="width: 14%; text-align: center;">Type</th>
                                <th style="width: 12%; text-align: center;">Date</th>
                                <th style="width: 16%; text-align: center;">Marché</th>
                                <th style="width: 30%;">Fournisseur</th>
                                <th style="width: 18%; text-align: center;">NET (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listDecompte', array('decomptes' => $decomptes));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageDecompte(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageDecompte') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#decompte_courant > tbody').html(data);
            }
        });
    }

</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-dark ui-sortable-handle" id="widget-box-2">
<!--        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                B.C.I.M.P Annulés
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageBciAnnule('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>-->
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
               Marché Clôturé
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageBciCloture('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>
<div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="bcimp_cloture" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 10%; text-align: center;">N°</th>

                                <th style="width: 15%; text-align: center;">B.C.I.M.P</th>
                                <th style="width: 15%; text-align: center;">Objet Marché</th>
                                <th style="width: 30%;">Fournisseur</th>
                                <th style="width: 20%; text-align: center;">M. Estimatif (DT)</th>
                                <th style="width: 20%; text-align: center;">Date Clôture</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listBciCloture', array('bci_cloture' => $bci_cloture));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!--        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="bcimp_annule" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 12%; text-align: center;">N°</th>
                                <th style="width: 18%; text-align: center;">Date</th>
                                <th style="width: 15%; text-align: center;">B.C.I.M.P</th>
                                <th style="width: 33%;">Demandeur</th>
                                <th style="width: 24%; text-align: center;">M. Estimatif (DT)</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php // include_partial('listBciAnnule', array('bci_annule' => $bci_annule)); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>-->
    </div>
</div>

<script>

    function goPageBciAnnule(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageBciAnnule') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#bcimp_annule > tbody').html(data);
            }
        });
    }

function goPageBciCloture(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageBciCloture') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#bcimp_cloture > tbody').html(data);
            }
        });
    }
</script>

<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable" id="widget-container-col-2">
    <div class="widget-box widget-color-red3 ui-sortable-handle" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i>
                Réclamations (Bénéficiaires)
            </h5>
            <div class="widget-toolbar">
                <a style="cursor: pointer;" onclick="goPageReclamation('1')"><i class="ace-icon fa fa-refresh"></i></a>
                <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                <a href="#" data-action="close"><i class="ace-icon fa fa-times"></i></a>
                <a href="#" data-action="fullscreen" class="orange2"><i class="ace-icon fa fa-expand"></i></a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="form-group" style="margin-bottom: 0px;">
                    <table id="reclamation" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 18%; text-align: center;">Date</th>
                                <th style="width: 45%;">Objet</th>
                                <th style="width: 37%;">Fournisseur</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php include_partial('listReclamation', array('reclamations' => $reclamations));?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function goPageReclamation(page) {
        $.ajax({
            url: '<?php echo url_for('Accueil/goPageReclamation') ?>',
            data: 'page=' + page,
            success: function (data) {
                $('#reclamation > tbody').html(data);
            }
        });
    }

</script>

<style>

    .highcharts-contextmenu hr{margin-top: 5px;margin-bottom: 5px;}

</style>