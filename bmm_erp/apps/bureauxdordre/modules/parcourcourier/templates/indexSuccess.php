<?php use_helper('I18N', 'Date') ?>
<?php include_partial('parcourcourier/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Mouvements des courriers', array(), 'messages') ?></h1>

    <?php include_partial('parcourcourier/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('parcourcourier/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('parcourcourier/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('parcourcourier_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('parcourcourier/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('parcourcourier/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('parcourcourier/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('parcourcourier/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
