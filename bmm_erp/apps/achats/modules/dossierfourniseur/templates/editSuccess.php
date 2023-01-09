<?php use_helper('I18N', 'Date') ?>
<?php include_partial('dossierfourniseur/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('MODIFIER Dossier Fournisseur', array(), 'messages') ?></h1>

  <?php include_partial('dossierfourniseur/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('dossierfourniseur/form_header', array('dossierfourniseur' => $dossierfourniseur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('dossierfourniseur/form', array('dossierfourniseur' => $dossierfourniseur, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('dossierfourniseur/form_footer', array('dossierfourniseur' => $dossierfourniseur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
