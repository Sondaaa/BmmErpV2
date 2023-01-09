<?php use_helper('I18N', 'Date') ?>
<?php include_partial('pvrception/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Mise à jour fiche P.V Réception', array(), 'messages') ?></h1>

    <?php include_partial('pvrception/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('pvrception/form_header', array('pvrception' => $pvrception, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('pvrception/form', array('pvrception' => $pvrception, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('pvrception/form_footer', array('pvrception' => $pvrception, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
