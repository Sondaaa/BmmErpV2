<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="col-xs-6 widget-container-col" id="widget-container-col-12">
  <div class="widget-box ui-sortable-handle" id="widget-box-1">
    <div class="widget-header">
      <h4 class="widget-title lighter"> Recherche</h4>


    </div>

    <div class="widget-body">
      <div class="widget-main padding-6 no-padding-left no-padding-right">
        <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
        <?php endif; ?>
        <form id="myformfileter" name="myformfileter" action="<?php echo url_for('situationadminouvrier_collection', array('action' => 'filter')) ?>" method="post">
          <table cellspacing="0">
            <tfoot>
              <tr>
                <td colspan="2">
                  <?php echo $form->renderHiddenFields() ?>
                  <?php echo link_to(__('Reset', array(), 'sf_admin'), 'situationadminouvrier_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post','class'=>'btn btn-xs btn-danger')) ?>
                  <a class="btn btn-xs btn-success" onclick="myformfileter.submit()">
                    <span class="fa fa-search"></span>
                    <?php echo __('Rechercher', array(), 'sf_admin') ?>
                  </a>
                  <!-- <input type="submit" class="btn btn-xs btn-success" value="" /> -->
                </td>
              </tr>
            </tfoot>
            <tbody>
              <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
              <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
              <?php include_partial('situationadminouvrier/filters_field', array(
              'name' => $name,
              'attributes' => $field->getConfig('attributes', array()),
              'label' => $field->getConfig('label'),
              'help' => $field->getConfig('help'),
              'form' => $form,
              'field' => $field,
              'class' => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
              )) ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-xs-4  widget-container-col" id="widget-container-col-1">
    <div class="widget-box" id="widget-box-1">
        <div class="widget-header">
            <div class="widget-toolbar">
                <a href="#" data-action="collapse" class="btn btn-white btn-success">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main" style="padding: 5%; text-align: center;">
                <a href="<?php echo url_for('situationadminouvrier/new') ?>"
                 class="btn btn-outline btn_new btn-success" 
                 style="text-align: center; width: 200px; font-size: 14px !important;height: 25%;">
                 Nouvelle Situations <br>Administrative</a>  
            </div>
        </div>
    </div>
</div>