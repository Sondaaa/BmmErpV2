<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mouvementbanciare/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nouvelle fiche de mouvement', array(), 'messages') ?></h1>

  <?php include_partial('mouvementbanciare/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mouvementbanciare/form_header', array('mouvementbanciare' => $mouvementbanciare, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('mouvementbanciare/form', array('mouvementbanciare' => $mouvementbanciare, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'id'=>$id)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mouvementbanciare/form_footer', array('mouvementbanciare' => $mouvementbanciare, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
