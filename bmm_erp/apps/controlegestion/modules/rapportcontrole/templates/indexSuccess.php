<?php use_helper('I18N', 'Date') ?>
<?php include_partial('rapportcontrole/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Liste des Rapports Travaux des Chantiers', array(), 'messages') ?></h1>

  <?php include_partial('rapportcontrole/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('rapportcontrole/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('rapportcontrole/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('rapportcontrole_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('rapportcontrole/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php // include_partial('rapportcontrole/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('rapportcontrole/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('rapportcontrole/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<style>
    
    .sf_admin_action_new{margin-left:0% !important;}
    .sf_admin_td_actions{margin: 0 0 10px 0px !important;}
    
</style>