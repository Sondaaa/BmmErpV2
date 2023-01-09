<?php use_helper('I18N', 'Date') ?>
<?php include_partial('lieuaffectationouvrier/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Liste des Lieus d\'afféctations(مكان العمل )', array(), 'messages') ?></h1>

  <?php include_partial('lieuaffectationouvrier/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('lieuaffectationouvrier/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('lieuaffectationouvrier/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('lieuaffectationouvrier_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('lieuaffectationouvrier/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
<!--    <ul class="sf_admin_actions">
      <?php // include_partial('lieuaffectationouvrier/list_batch_actions', array('helper' => $helper)) ?>
      <?php // include_partial('lieuaffectationouvrier/list_actions', array('helper' => $helper)) ?>
    </ul>-->
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('lieuaffectationouvrier/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<div id="my-modal-Lieuouvrier" class="modal fade" tabindex="-1" style="width: 1200px;display: none">

</div>

<script  type="text/javascript">

    function chargerOuvrierLieu(id)
    {
        $.ajax({
            url: '<?php echo url_for('lieuaffectationouvrier/chargerOuvrierLieu') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#my-modal-Lieuouvrier').html(data);
            }
        });
    }

</script>