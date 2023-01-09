<?php use_helper('I18N', 'Date') ?>
<?php include_partial('fournisseur/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Liste des fournisseurs', array(), 'messages') ?></h1>

    <?php include_partial('fournisseur/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('fournisseur/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('fournisseur/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('fournisseur_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('fournisseur/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <!--    <ul class="sf_admin_actions">
            <?php // include_partial('fournisseur/list_batch_actions', array('helper' => $helper)) ?>
            <?php // include_partial('fournisseur/list_actions', array('helper' => $helper)) ?>
                </ul>-->
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('fournisseur/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<script  type="text/javascript">

    function printList() {
        var url = '';
        if ($('#fournisseur_filters_id_activite').val() != '')
            url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();

        if ($('#fournisseur_filters_id_famillearticle').val() != '') {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        
        if ($('#fournisseur_filters_rib').val() != '') {
            if (url == '')
                url = '?rib=' + $('#fournisseur_filters_rib').val();
            else
                url = url + '&rib=' + $('#fournisseur_filters_rib').val();
        }
        
        if ($('#fournisseur_filters_id_naturecompte').val() != '') {
            if (url == '')
                url = '?id_naturecompte=' + $('#fournisseur_filters_id_naturecompte').val();
            else
                url = url + '&id_naturecompte=' + $('#fournisseur_filters_id_naturecompte').val();
        }
        url = '<?php echo url_for('fournisseur/imprimerListe') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>