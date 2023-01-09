<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>
<div class="page-header">
 <h1><?php echo __($titre, array(), 'messages'); ?></h1>

</div>
<div id="row">
    
 
  <div class="col-md-12">
      <?php include_partial('documentachat/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('documentachat/form_header', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('documentachat/form', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ,'idfrs' => $idfrs, 'iddocparent' => $iddocparent ,'idtype'=>$idtype)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('documentachat/form_footer', array('documentachat' => $documentachat, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
  </div>
  
</div>
