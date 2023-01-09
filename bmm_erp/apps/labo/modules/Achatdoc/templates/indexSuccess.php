<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Achatdoc/assets') ?>
<div class="page-header">
  <h1><?php echo __('Liste des Demandes Internes', array(), 'messages') ?></h1>
</div><!-- /.page-header -->
<div id="row">

  <div class="col-xs-12">
    <div id="alert alert-block alert-successs">
      <?php include_partial('Achatdoc/flashes') ?>
    </div>




    <div id="alert alert-block alert-successs">
      <?php include_partial('Achatdoc/list_header', array('pager' => $pager)) ?>
    </div>
    <div class="col-md-12">
      <?php include_partial('Achatdoc/list_actions', array('helper' => $helper, 'idtype' => $idtype)) ?>
    </div>

    <div id="sf_admin_bar">
      <?php include_partial('Achatdoc/filters', array('form' => $filters, 'configuration' => $configuration, 'idtype' => $idtype)) ?>
    </div>

    <div id="sf_admin_content">
      <?php include_partial('Achatdoc/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'idtype' => $idtype)) ?>

    </div>

    <div id="sf_admin_footer">
      <?php include_partial('Achatdoc/list_footer', array('pager' => $pager)) ?>
    </div>
  </div>
</div>