<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentbudget/assets') ?>

<div id="sf_admin_container">
     <?php // if ($idtype == 1): ?>
        <h1><?php //echo __('Liste des Fiches d\'Engagements Définitifs', array(), 'messages') ?></h1>
    <?php if ($idtype == 3): ?> 
        <h1><?php echo __('Liste des Fiches d\'Engagements Provisoires', array(), 'messages') ?></h1>
    <?php else: ?>
         <h1><?php echo __('Liste des Fiches de Paiements', array(), 'messages') ?></h1> 
     <?php endif; ?> 

    <?php include_partial('documentbudget/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('documentbudget/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('documentbudget/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('documentbudget/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'idtype' => 3)) ?>
        <ul class="sf_admin_actions">
            <?php include_partial('documentbudget/list_batch_actions', array('helper' => $helper)) ?>
            <?php include_partial('documentbudget/list_actions', array('helper' => $helper)) ?>
        </ul>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('documentbudget/list_footer', array('pager' => $pager)) ?>
    </div>
</div>