<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('MODIFIER FICHE Demande Achat %%numerodocachat%%', array('%%numerodocachat%%' => $documentachat->getNumerodocachat()), 'messages') ?></h1>

  <?php include_partial('documentachat/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('documentachat/form_header', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('documentachat/form', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'iddoc'=>$iddoc)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('documentachat/form_footer', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
