<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Achatdoc/assets') ?>
<div class="page-header">
  <h1><?php if ($idtype != 23)
        echo __('NOUVELLE FICHE DEMANDE INTERNE', array(), 'messages');
      else echo __('NOUVELLE DEMANDE APPROVISIONNEMENT', array(), 'messages'); ?></h1>
</div><!-- /.page-header -->
<div id="row">
  <div class="col-xs-12">
    <div id="alert alert-block alert-successs">
      <?php include_partial('Achatdoc/flashes') ?>
    </div>

    <div id="col-xs-12">




      <?php include_partial('Achatdoc/form_header', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>

      <?php include_partial('Achatdoc/form', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'idtype' => $idtype)) ?>

      <?php include_partial('Achatdoc/form_footer', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
  </div>
</div>