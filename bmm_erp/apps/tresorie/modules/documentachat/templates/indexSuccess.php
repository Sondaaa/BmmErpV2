<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>

<div id="sf_admin_container" >
    <?php if ($idtype == 1): ?>
        <h1><?php echo __('Liste des Fiches d\'Engagements Définitifs', array(), 'messages') ?></h1>
    <?php elseif ($idtype == 3): ?>
        <h1><?php echo __('Liste des Fiches d\'Engagements Provisoires', array(), 'messages') ?></h1>
    <?php else: ?>
        <h1><?php echo __('Liste des Fiches de Paiements', array(), 'messages') ?></h1>
    <?php endif; ?>
    <h1><?php echo __('Liste des documents', array(), 'messages') ?></h1>

    <?php include_partial('documentachat/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">

        <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration)) ?>

    </div>

    <div id="sf_admin_content">
        <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
