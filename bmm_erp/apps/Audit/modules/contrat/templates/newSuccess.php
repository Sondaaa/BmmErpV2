<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contrat/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nouvelle fiche Carrière', array(), 'messages') ?></h1>

  <?php include_partial('contrat/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('contrat/form_header', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('contrat/form', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('contrat/form_footer', array('contrat' => $contrat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
