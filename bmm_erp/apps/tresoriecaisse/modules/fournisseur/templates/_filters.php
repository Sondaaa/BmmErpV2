<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<button onclick="printListFournisseur()" class=" btn btn-xs btn-danger">
    <i class="ace-icon fa fa-print bigger-110"></i> Imprimer Liste des Fournisseurs
</button>
<button  onclick="exportFournisseur()" class=" btn btn-xs btn-primary">
    <i class="ace-icon fa fa-file_excel-o"></i> Exporter Liste des Fournisseurs vers Excel (.xlsx )
</button>



<script  type="text/javascript">
    function exportFournisseur() {
        var url = '';

        if ($('#fournisseur_filters_rs').val() != '')
        {
            if (url == '')
                url = '?rs=' + $('#fournisseur_filters_rs').val();
            else
                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
        }
        if ($('#fournisseur_filters_codefrs').val() != '')
        {
            if (url == '')
                url = '?codefrs=' + $('#fournisseur_filters_codefrs').val();
            else
                url = url + '&codefrs=' + $('#fournisseur_filters_codefrs').val();
        }
        if ($('#fournisseur_filters_id_famillearticle').val() != '')
        {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        if ($('#fournisseur_filters_id_activite').val() != '')
        {
            if (url == '')
                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
            else
                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
        }

        url = '<?php echo url_for('fournisseur/exporterFourniseseurExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
    function printListFournisseur() {
        var url = '';


        if ($('#fournisseur_filters_rs').val() != '')
        {
            if (url == '')
                url = '?rs=' + $('#fournisseur_filters_rs').val();
            else
                url = url + '&rs=' + $('#fournisseur_filters_rs').val();
        }
        if ($('#fournisseur_filters_codefrs').val() != '')
        {
            if (url == '')
                url = '?codefrs=' + $('#fournisseur_filters_codefrs').val();
            else
                url = url + '&codefrs=' + $('#fournisseur_filters_codefrs').val();
        }

        if ($('#fournisseur_filters_id_famillearticle').val() != '')
        {
            if (url == '')
                url = '?id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
            else
                url = url + '&id_famille=' + $('#fournisseur_filters_id_famillearticle').val();
        }
        if ($('#fournisseur_filters_id_activite').val() != '')
        {
            if (url == '')
                url = '?id_activite=' + $('#fournisseur_filters_id_activite').val();
            else
                url = url + '&id_activite=' + $('#fournisseur_filters_id_activite').val();
        }

        url = '<?php echo url_for('fournisseur/ImprimerListeFounisseur') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>
<div class="sf_admin_filter col-xs-6">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="<?php echo url_for('fournisseur_collection', array('action' => 'filter')) ?>" method="post">
      <table cellspacing="0" style="margin-bottom: 0px;">
      <tfoot>
        <tr>
          <td colspan="2">
            <?php echo $form->renderHiddenFields() ?>
            <?php echo link_to(__('Reset', array(), 'sf_admin'), 'fournisseur_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
            <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <?php include_partial('fournisseur/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
          )) ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>
</div>