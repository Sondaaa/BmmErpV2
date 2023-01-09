<?php use_helper('I18N', 'Date') ?>
<?php include_partial('parametragesociete/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Paramétrages sociétés', array(), 'messages') ?></h1>

  <?php include_partial('parametragesociete/flashes') ?>

  <div id="alert alert-block alert-successs">
    <?php include_partial('parametragesociete/list_header', array('pager' => $pager)) ?>
  </div>
  <div class="col-md-12">
  <?php include_partial('parametragesociete/list_actions', array('helper' => $helper)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('parametragesociete/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('parametragesociete_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('parametragesociete/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('parametragesociete/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
