<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
  <?php if ($form->hasGlobalErrors()) : ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="<?php echo url_for('marche_prevesionelle_collection', array('action' => 'filter')) ?>" method="post">
    <table cellspacing="0">
      <tfoot>
        <tr>
          <td colspan="2">
            <?php echo $form->renderHiddenFields() ?>
            <?php echo link_to(__('Reset', array(), 'sf_admin'), 'marche_prevesionelle_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
            <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
            <!-- <a target="__blanc" href="<?php //echo url_for('marche_prevesionelle/print') 
                                            ?>" class="btn btn-xs btn-info" style="margin-left: 2px;float: right;">
              <i class="fa fa-print"></i> Imprimer listes des marches previsionelle / Exercice class="btn btn-xs btn-info"
            </a> -->
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($configuration->getFormFilterFields($form) as $name => $field) : ?>
          <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <?php include_partial('marche_prevesionelle/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
          )) ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>
</div>
<div class="col-xs-4 widget-container-col" id="widget-container-col-1">
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
        
        <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" onclick="printListMarches()" class="btn btn-xs btn-info">
          <i class="ace-icon fa fa-print bigger-110"></i> Imprimer listes des marches </br> previsionelle / Exercice 
        </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function printListMarches() {
    var url = '';
    if ($('#marche_prevesionelle_filters_id_exercice').val() != '') {
      url = '?id_exercice=' + $('#marche_prevesionelle_filters_id_exercice').val();
    }

    url = '<?php echo url_for('marche_prevesionelle/print') ?>' + url;
    window.open(url, '_blank');
    win.focus();
  }
</script>