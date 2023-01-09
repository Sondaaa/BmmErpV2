<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>
<div class="page-header">
  <h1><?php echo __('Listes des documents', array(), 'messages') ?></h1>
</div>
<div clss="row">

  <div class="col-xs-12">
    <div class="col-xs-12">
      
        <?php include_partial('documentachat/flashes') ?>
      
    </div>

    <div id="alert alert-block alert-successs">
      <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
    </div>
    <div class="col-md-12">
      <?php include_partial('documentachat/list_actions', array('helper' => $helper)) ?>
    </div>

    <div id="sf_admin_bar">
      <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
      <form action="<?php echo url_for('documentachat_collection', array('action' => 'batch')) ?>" method="post">
        <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'id_valide' => $id_valide)) ?>

      </form>
    </div>

    <div id="sf_admin_footer">
      <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
    </div>
  </div>
</div>