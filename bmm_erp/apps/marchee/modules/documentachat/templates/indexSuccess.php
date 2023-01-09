<?php use_helper('I18N', 'Date') ?>
<?php include_partial('documentachat/assets');
$user =$sf_user->getAttribute('userB2m');?>

<div id="sf_admin_container" class="<?php if (!$user->getAcceesDroit("formulaire marches")) echo 'disabledbutton' ?>" >
   
  <?php if ($idtype == 9): ?>
        <h1><?php echo __('Liste des Bons de Commandes Internes Marchés Publics (B.C.I.M.P)', array(), 'messages') ?></h1>
    <?php else: ?>
        <h1><?php echo __('Liste des documents', array(), 'messages') ?></h1>
    <?php endif; ?>

  <?php include_partial('documentachat/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('documentachat/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php  include_partial('documentachat/filters', array('form' => $filters,'idtype'=>$idtype, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('documentachat/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('documentachat/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
