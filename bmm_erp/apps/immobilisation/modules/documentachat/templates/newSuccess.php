<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>
<div class="page-header">
  <?php if($form->getObject()->isNew()):?>
 <h1><?php echo __('Nouvelle fiche', array(), 'messages') ?></h1>
 <?php else:?>
<h1><?php echo __($form->getObject()->getNumeroDocachat(), array(), 'messages') ?></h1>
  <?php endif;?>

</div>
<div class="row">
 
<div class="col-xs-12">
  <?php include_partial('documentachat/flashes') ?>

  <div class="col-xs-12">
    <?php include_partial('documentachat/form_header', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div class="col-xs-12">
    <?php include_partial('documentachat/form', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'idfrs' => $idfrs, 'iddocparent' => $iddocparent ,'idtype'=>$idtype)) ?>
  </div>

  <div class="col-xs-12">
    <?php include_partial('documentachat/form_footer', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
</div>
