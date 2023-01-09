<?php use_helper('I18N', 'Date') ?>
<?php include_partial('agents/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Mise à jour fiche Personnelle', array(), 'messages') ?></h1>

  <?php include_partial('agents/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('agents/form_header', array('agents' => $agents, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('agents/form', array('agents' => $agents, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'id_regerouppement' => $id_regerouppement ))?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('agents/form_footer', array('agents' => $agents, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
