<?php use_helper('I18N', 'Date') ?>
<?php include_partial('alimentationcompte/assets') ?>

<div id="sf_admin_container">
    
  <h1><?php echo __('Liste des alimentations des comptes bancaires/CCP', array(), 'messages') ?></h1>
 <h1><?php echo __('Relevé des mouvements', array(), 'messages') ?></h1>
    <?php
    $sDatedebut = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
    $d = new DateTime(date('Y-m-d'));
    $sDateFin = $d->format('Y-m-t');
    ?>
  <?php include_partial('alimentationcompte/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('alimentationcompte/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('alimentationcompte/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('alimentationcompte_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('alimentationcompte/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('alimentationcompte/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('alimentationcompte/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('alimentationcompte/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
