<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>
<div class="page-header">
  <?php if ($idtyped == 4) : ?>
    <h1><?php echo __('Liste des Demandes Internes (D.I)', array(), 'messages') ?></h1>
  <?php elseif ($idtyped == 6) : ?>
    <h1><?php echo __('Liste des DA par Caisse', array(), 'messages'); ?></h1>
  <?php endif;  ?>
</div><!-- /.page-header -->
<div class="row">

  <div class="col-xs-12">
    <?php include_partial('documentachat/flashes') ?>

    <div id="alert alert-block alert-successs">
      <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
    </div>
    <div class="col-md-12">
      <?php include_partial('documentachat/list_actions', array('helper' => $helper)) ?>
    </div>

    <div id="sf_admin_bar">
      <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration, 'idtype' => $idtyped, 'id_typedoc' => $idtyped)) ?>
    </div>

    <div id="sf_admin_content">
      <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'idtype' => $idtyped, 'id_typedoc' => $idtyped)) ?>

    </div>

    <div id="sf_admin_footer">
      <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
    </div>
  </div>
</div>