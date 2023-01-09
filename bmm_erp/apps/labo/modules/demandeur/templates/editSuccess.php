<?php use_helper('I18N', 'Date') ?>
<?php include_partial('demandeur/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Mise à jour fiche demandeur -%%libelle%%', array('%%libelle%%' => $demandeur->getLibelle()), 'messages') ?></h1>

  <?php include_partial('demandeur/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('demandeur/form_header', array('demandeur' => $demandeur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('demandeur/form', array('demandeur' => $demandeur, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('demandeur/form_footer', array('demandeur' => $demandeur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
