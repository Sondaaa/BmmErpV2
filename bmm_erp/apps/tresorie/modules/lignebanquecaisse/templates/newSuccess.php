<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lignebanquecaisse/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nouvelle fiche', array(), 'messages') ?></h1>

  <?php include_partial('lignebanquecaisse/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('lignebanquecaisse/form_header', array('lignebanquecaisse' => $lignebanquecaisse, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('lignebanquecaisse/form', array('lignebanquecaisse' => $lignebanquecaisse, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('lignebanquecaisse/form_footer', array('lignebanquecaisse' => $lignebanquecaisse, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
