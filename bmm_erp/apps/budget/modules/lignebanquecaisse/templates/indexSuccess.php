<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lignebanquecaisse/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Liste des Attributions du banques aux interfaces budget', array(), 'messages') ?></h1>

  <?php include_partial('lignebanquecaisse/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('lignebanquecaisse/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('lignebanquecaisse/filters', array('form' => $filters, 'configuration' => $configuration, 'id_caissebanque'=>$id_caissebanque, 'id_budget' => $id_budget)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('lignebanquecaisse/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'id_caissebanque'=>$id_caissebanque,'id_budget'=>$id_budget)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('lignebanquecaisse/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('lignebanquecaisse/list_actions', array('helper' => $helper)) ?>
    </ul>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('lignebanquecaisse/list_footer', array('pager' => $pager, 'id_caissebanque'=>$id_caissebanque,'id_budget'=>$id_budget)) ?>
  </div>
</div>
