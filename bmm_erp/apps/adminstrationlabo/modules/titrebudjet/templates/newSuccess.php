<?php use_helper('I18N', 'Date') ?>
<?php include_partial('titrebudjet/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Nouvelle fiche budget', array(), 'messages') ?></h1>

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
