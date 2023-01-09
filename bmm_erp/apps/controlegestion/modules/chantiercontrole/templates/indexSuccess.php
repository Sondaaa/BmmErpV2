<?php use_helper('I18N', 'Date') ?>
<?php include_partial('chantiercontrole/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Liste des Chantiers', array(), 'messages') ?></h1>

  <?php include_partial('chantiercontrole/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('chantiercontrole/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('chantiercontrole/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('chantiercontrole_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('chantiercontrole/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('chantiercontrole/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('chantiercontrole/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('chantiercontrole/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<style>
    
    .sf_admin_action_new{margin-left:0% !important;}
    .sf_admin_action_edit{margin-left:0% !important;}
    .sf_admin_td_actions{margin: 0 0 0px 0px !important;}
    
</style>