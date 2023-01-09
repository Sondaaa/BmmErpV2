<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets');
?>
<input type="hidden" id="idtype" value="<?php echo $idtype; ?>">
<?php
switch ($idtype) {
    case 2:
        $titre = 'Liste des bons de dépenses au comptant';
        break;
    case 22:
        $titre = 'Liste des bons de dépenses au comptant Regroupes';
        break;
    case 7:
        $titre = 'Liste des bons commandes externes';
        break;
    case 20:
        $titre = 'Liste des Contrats ';
        break;
    case 15:
        $titre = 'Liste des factures';
        break;
    case 6:
        $titre = 'Liste des BCI du Contrat Partiel';
        break;
//    default :
        //        $titre = 'Liste des bons commandes interne du Contrat';
        break;
}

switch ($type_fac) {
    case "horbci":
        $titre = 'Liste des factures Hors BCI';
        break;
}
switch ($type) {
    case "BDCG":
        $titre .= '';
        break;
}
?>
<div id="sf_admin_container" ng-controller="Ctrlfacturation" ng-init="InitialiserTypeDoc()">
    <h1><?php echo __($titre, array(), 'messages') ?></h1>

    <?php include_partial('documentachat/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration, 'idtype' => $idtype, 'type' => $type, 'type_fac' => $type_fac)) ?>
    </div>
    <div id="sf_admin_content">
        <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'idtype' => $idtype, 'type' => $type)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('documentachat/list_footer', array('pager' => $pager, 'idtype' => $idtype, 'type' => $type)) ?>
    </div>
</div>

<script>
    $('#documentachat_filters_id_typedoc').val($('#idtype').val());
    function annulerFacture(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/annulerDocAchat') ?>',
            data: 'id=' + id,
            success: function (data) {
                document.location.reload();
            }
        });
    }
    function SuprrimerFacturehorsBCI(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/SuprrimerFacturehorsBCI') ?>',
            data: 'id=' + id,
            success: function (data) {
                document.location.reload();
            }
        });
    }
</script>