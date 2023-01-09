<?php use_helper('I18N', 'Date') ?>
<?php include_partial('situationadminouvrier/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Liste des Situations administratives ( الوضع الإداري )', array(), 'messages') ?></h1>

  <?php include_partial('situationadminouvrier/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('situationadminouvrier/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('situationadminouvrier/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('situationadminouvrier_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('situationadminouvrier/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
<!--    <ul class="sf_admin_actions">
      <?php // include_partial('situationadminouvrier/list_batch_actions', array('helper' => $helper)) ?>
      <?php // include_partial('situationadminouvrier/list_actions', array('helper' => $helper)) ?>
    </ul>-->
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('situationadminouvrier/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<div id="my-modal-situationouvrier" class="modal fade" tabindex="-1" style="width: 1200px;display: none">

</div>

<script>

    function chargerOuvrierSituation(id)
    {
        $.ajax({
            url: '<?php echo url_for('situationadminouvrier/chargerOuvrierSituation') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#my-modal-situationouvrier').html(data);
            }
        });
    }

</script>