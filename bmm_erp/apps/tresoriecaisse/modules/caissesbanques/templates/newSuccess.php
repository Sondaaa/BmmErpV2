<?php use_helper('I18N', 'Date') ?>
<?php include_partial('caissesbanques/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nouvelle Fiche Compte', array(), 'messages') ?></h1>

  <?php include_partial('caissesbanques/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('caissesbanques/form_header', array('caissesbanques' => $caissesbanques, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('caissesbanques/form', array('caissesbanques' => $caissesbanques, 'form' => $form,'idtype'=>$idtype, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('caissesbanques/form_footer', array('caissesbanques' => $caissesbanques, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
