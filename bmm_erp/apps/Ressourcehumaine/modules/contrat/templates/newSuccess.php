<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contrat/assets') ?>

<div id="sf_admin_container">
    <?php if ($id_regerouppement != '') : ?>
    <h1><?php echo __('Nouvelle fiche Carrière - '. $regroupement, array(), 'messages') ?></h1>
    <?php else: ?>
    <h1><?php echo __('Nouvelle fiche Carrière ', array(), 'messages') ?></h1>
     <?php endif; ?>
    <?php include_partial('contrat/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('contrat/form_header', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('contrat/form', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'id_regerouppement' => $id_regerouppement)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('contrat/form_footer', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
