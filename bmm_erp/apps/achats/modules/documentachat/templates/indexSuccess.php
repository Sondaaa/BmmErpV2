<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>


<div id="sf_admin_container">
        <h1><?php echo __('Liste des Bons de Commandes Internes (B.C.I)', array(), 'messages') ?></h1>
    

    <?php include_partial('documentachat/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'idtype' => '6')) ?>
        
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<style>

    .dropdown-menu > li > button {width: 100%; text-align: left !important;}
    .detail-button {width: 100%;}

</style>