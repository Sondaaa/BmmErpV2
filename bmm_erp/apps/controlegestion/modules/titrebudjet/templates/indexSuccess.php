<?php use_helper('I18N', 'Date') ?>
<?php include_partial('titrebudjet/assets') ?>

<div id="sf_admin_container">
    <?php if ($type_budget == "Prototype"): ?>
        <h1><?php echo __('Liste des budgets prototypes', array(), 'messages') ?></h1>
    <?php else: ?>
        <?php if ($type_budget == "Budget Prévisionnel"): ?>
            <h1><?php echo __('Liste des Budgets Prévisionnels / Direction & Projet', array(), 'messages') ?></h1>
        <?php elseif ($type_budget == "Budget Prévisionnel Global"): ?>
            <h1><?php echo __('Liste des Budgets Prévisionnels Globaux', array(), 'messages') ?></h1>
        <?php else: ?>
            <h1><?php echo __('Liste des Budgets Finaux', array(), 'messages') ?></h1>
        <?php endif; ?>
    <?php endif; ?>
    <?php include_partial('titrebudjet/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('titrebudjet/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('titrebudjet/filters', array('form' => $filters, 'configuration' => $configuration, 'type_budget' => $type_budget)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('titrebudjet/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
        <ul class="sf_admin_actions">
            <?php //include_partial('titrebudjet/list_batch_actions', array('helper' => $helper)) ?>
            <?php // include_partial('titrebudjet/list_actions', array('helper' => $helper)) ?>
        </ul>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('titrebudjet/list_footer', array('pager' => $pager)) ?>
    </div>
</div>