<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contratachat/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('NOUVELLE FICHE CONTRAT', array(), 'messages') ?></h1>

  <?php include_partial('contratachat/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('contratachat/form_header', array('contratachat' => $contratachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('contratachat/form', array('contratachat' => $contratachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper , 'iddoc' => $iddoc)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('contratachat/form_footer', array('contratachat' => $contratachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
