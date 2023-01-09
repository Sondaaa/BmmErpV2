<?php use_helper('I18N', 'Date') ?>
<?php include_partial('transfertbudget/assets') ?>

<div id="sf_admin_container">
    <?php if (!$etat): ?>
        <h1><?php echo __('Liste des transferts', array(), 'messages') ?></h1>
    <?php else: ?>
         <h1><?php echo __('Liste des transferts Annulés' , array(), 'messages') ?></h1>
    <?php endif; ?>
    <?php include_partial('transfertbudget/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('transfertbudget/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('transfertbudget/filters', array('form' => $filters, 'configuration' => $configuration, 'etat' => $etat)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('transfertbudget_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('transfertbudget/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'etat' => $etat)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('transfertbudget/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('transfertbudget/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('transfertbudget/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
