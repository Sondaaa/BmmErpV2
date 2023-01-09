<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Listes des documents', array(), 'messages') ?></h1>

  <?php include_partial('documentachat/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
     

    <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration,'idtypedoc'=>$idtypedoc)) ?>
    
     
     
  </div>

  <div id="sf_admin_content">
    <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
