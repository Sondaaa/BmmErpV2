<?php use_helper('I18N', 'Date') ?>
<?php include_partial('parcourcourier/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Parcourcourier', array(), 'messages') ?></h1>

  <?php include_partial('parcourcourier/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('parcourcourier/form_header', array('parcourcourier' => $parcourcourier, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
     
    <?php include_partial('parcourcourier/form', array('parcourcourier' => $parcourcourier,'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('parcourcourier/form_footer', array('parcourcourier' => $parcourcourier, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
