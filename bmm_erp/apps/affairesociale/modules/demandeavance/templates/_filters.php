<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('demandeavance_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'demandeavance_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('demandeavance/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                    ))
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
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
                <a href="<?php echo url_for('demandeavance/new') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; font-size: 14px !important; " >Nouvelle Fiche Demande d'avance</a>  
                <br><br>

                <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListdemaned()" class=" btn btn-primary">
                    Imprimer Liste des Demandes Avance
                </button>
                <!--                <br><br>
                                <button style="font-size: 14px !important; font-weight: bold !important;" onclick="printListretenue()" class=" btn btn-danger">
                                    Imprimer Liste des Retenues Avance
                                </button>-->
            </div>


        </div>
    </div>
</div>
<!--                 <li>
                     <a href="#my-modal" role="button" data-toggle="modal">Imprimer Listes (Demande/Retenue)d'Avances Sur Salaire</a>
                 </li>-->
<!--<div id="my-modal" class="modal fade" tabindex="-1" style="width: 1200px"> 
<?php // include_partial('demandeavance/avance', array()); ?>
</div>-->
<script  type="text/javascript">

    function printListdemaned() {
       var url = '';
        if ($('#demandeavance_filters_id_typeavance').val() != '')
        {   url = '?id_typeavance=' + $('#demandeavance_filters_id_typeavance').val();}

        if ($('#demandeavance_filters_id_agents').val() != '0')
        {
            if (url == '')
                url = '?id_agents=' + $('#demandeavance_filters_id_agents').val();
            else
                url = url + '&id_agents=' + $('#demandeavance_filters_id_agents').val();
        }

        if ($('#demandeavance_filters_mois').val() != '') {
            if (url == '')
                url = '?id_mois=' + $('#demandeavance_filters_mois').val();
            else
                url = url + '&id_mois=' + $('#demandeavance_filters_mois').val();
        }
        if ($('#demandeavance_filters_annee').val() != '0') {
            if (url == '')
                url = '?id_annee=' + $('#demandeavance_filters_annee').val();
            else
                url = url + '&id_annee=' + $('#demandeavance_filters_annee').val();
        }

        url = '<?php echo url_for('demandeavance/imprimerListeDemandedavance') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

  function printListretenue() {
        var url = '';
        if ($('#demandeavance_filters_id_typeavance').val() != '')
        {   url = '?id_typeavance=' + $('#demandeavance_filters_id_typeavance').val();}

        if ($('#demandeavance_filters_id_agents').val() != '0')
        {
            if (url == '')
                url = '?id_agents=' + $('#demandeavance_filters_id_agents').val();
            else
                url = url + '&id_agents=' + $('#demandeavance_filters_id_agents').val();
        }

        if ($('#demandeavance_filters_mois').val() != '') {
            if (url == '')
                url = '?id_mois=' + $('#demandeavance_filters_mois').val();
            else
                url = url + '&id_mois=' + $('#demandeavance_filters_mois').val();
        }
        if ($('#demandeavance_filters_annee').val() != '0') {
            if (url == '')
                url = '?id_annee=' + $('#demandeavance_filters_annee').val();
            else
                url = url + '&id_annee=' + $('#demandeavance_filters_annee').val();
        }

        url = '<?php echo url_for('demandeavance/imprimerListeRetenue') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>