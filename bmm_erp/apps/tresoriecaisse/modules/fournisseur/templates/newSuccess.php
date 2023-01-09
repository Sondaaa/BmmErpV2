<?php use_helper('I18N', 'Date') ?>
<?php include_partial('fournisseur/assets') ?>

<div id="sf_admin_container">
  
  <?php include_partial('fournisseur/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('fournisseur/form_header', array('fournisseur' => $fournisseur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('fournisseur/form', array('fournisseur' => $fournisseur, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('fournisseur/form_footer', array('fournisseur' => $fournisseur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
