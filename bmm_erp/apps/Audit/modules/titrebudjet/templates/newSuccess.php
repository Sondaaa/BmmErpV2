<?php use_helper('I18N', 'Date') ?>
<?php include_partial('titrebudjet/assets') ?>

<div id="sf_admin_container">
    <?php if (!(strpos(trim($prototype), "Direction") === false)): ?>
        <h1><?php echo __('Nouveau Budget Prévisionnel / Direction & Projet', array(), 'messages') ?></h1>
    <?php elseif (!(strpos(trim($prototype), "Global") === false)): ?>
        <h1><?php echo __('Nouveau Budget Prévisionnel Global', array(), 'messages') ?></h1>
    <?php else: ?>
        <h1><?php echo __('Nouvelle Fiche Budget Final', array(), 'messages') ?></h1>
    <?php endif; ?>
    <?php include_partial('titrebudjet/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('titrebudjet/form_header', array('titrebudjet' => $titrebudjet, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('titrebudjet/form', array('titrebudjet' => $titrebudjet, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'prototype' => $prototype)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('titrebudjet/form_footer', array('titrebudjet' => $titrebudjet, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
