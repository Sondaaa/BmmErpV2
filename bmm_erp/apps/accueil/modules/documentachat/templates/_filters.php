<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $user = $sf_user->UserConnected(); ?>
<div class="col-sm-6 widget-container-col" id="widget-container-col-12">
  <div class="widget-box ui-sortable-handle" id="widget-box-1">
    <div class="widget-header">
      <h4 class="widget-title lighter"> Recherche</h4>


    </div>

    <div class="widget-body">
      <div class="widget-main padding-6 no-padding-left no-padding-right">
        <?php if ($form->hasGlobalErrors()) : ?>
          <?php echo $form->renderGlobalErrors() ?>
        <?php endif; ?>

        <form id="myformfileter" name="myformfileter" action="<?php echo url_for('documentachat_collection', array('action' => 'filter')) ?>" method="post">
          <table cellspacing="0">
            <tfoot>
              <tr>
                <td colspan="2">
                  <?php echo $form->renderHiddenFields() ?>
                  <?php echo link_to(__('Reset', array(), 'sf_admin'), 'documentachat_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post','class'=>'btn btn-xs btn-danger')) ?>
                  <a class="btn btn-xs btn-success" onclick="myformfileter.submit()">
                  <span class="fa fa-search"></span>
                  <?php echo __('Filter', array(), 'sf_admin') ?>
                  </a>
                </td>
              </tr>
            </tfoot>
            <tbody>
              <?php foreach ($configuration->getFormFilterFields($form) as $name => $field) : ?>
                <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) {
                  continue;
                }
                ?>
                <?php include_partial('documentachat/filters_field', array(
                  'name' => $name,
                  'attributes' => $field->getConfig('attributes', array()),
                  'label' => $field->getConfig('label'),
                  'help' => $field->getConfig('help'),
                  'form' => $form,
                  'field' => $field,
                  'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                )) ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php if ($idtype != 23) : ?>
      <div class="col-xs-4 " id="widget-container-col-1">
        <a href="<?php echo url_for('documentachat/new?idtype=' . $idtype) ?>" class="btn btn-outline btn_new btn-success">
                <?php if ($idtype == 4) : ?>
                  <span class="fa fa-plus"></span> Demande Interne
                <?php elseif ($idtype == 6) : ?>
                  Nouveau DA Par Caisse
                <?php endif; ?>
              </a>
              <?php if ($idtype == 4 && $user->getIsAdmin()) : ?>
                <a href="<?php echo url_for('documentachat/indexbonsortie?idtype=23') ?>" class="btn btn-outline btn_new btn-danger">
                  Liste des Bons de Sorties
                </a>
              <?php endif; ?>
      </div>
    <?php endif; ?>