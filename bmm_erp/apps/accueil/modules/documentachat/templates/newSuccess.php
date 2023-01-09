<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>
<div class="page-header">
  <h1><?php echo __('NOUVELLE FICHE DEMANDE INTERNE', array(), 'messages') ?></h1>
</div><!-- /.page-header -->
<div id="row">
 
<div class="col-xs-12">
  <div id="alert alert-block alert-successs">
  <?php include_partial('documentachat/flashes') ?>
  </div>

  <div id="col-xs-12">
    <?php include_partial('documentachat/form_header', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
 
    <?php  include_partial('documentachat/form', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper , 'idtype'=>$idtyped)) ?>
  
    <?php include_partial('documentachat/form_footer', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
