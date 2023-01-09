<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets') ?>

<?php  if ($_SESSION['exercice_budget'] != date('Y')): ?>
    <script  type="text/javascript">
        document.location.href = "<?php echo sfconfig::get('sf_appdir') . 'budget.php' ?>";
    </script>
<?php endif; ?>

<div id="sf_admin_container">
    <?php if ($idtype == 6): ?>
        <h1><?php echo __('Liste des Bons de Commandes Internes (B.C.I)', array(), 'messages') ?></h1>
    <?php elseif ($idtype == 9): ?>   
        <h1><?php echo __('Liste des Bons de Commandes Internes Marchés Publics (B.C.I.M.P)', array(), 'messages') ?></h1>
    <?php else: ?>
        <h1><?php echo __('Liste des documents', array(), 'messages') ?></h1>
    <?php endif; ?>

    <?php include_partial('documentachat/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('documentachat/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'idtype' => $idtype)) ?>
        <?php if ($idtype == 6): ?>
            <ul class="sf_admin_actions">
                <?php include_partial('documentachat/list_batch_actions', array('helper' => $helper)) ?>
            </ul>
        <?php endif; ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<style>

    .dropdown-menu > li > button {width: 100%; text-align: left !important;}
    .detail-button {width: 100%;}

</style>