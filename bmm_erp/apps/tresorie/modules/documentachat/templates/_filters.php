<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h5 style="color: #843534"> D.I.S: Demande Interne Système</h5>
<h5 style="color: #843534"> D.A : Demande Achat</h5>
<h5 style="color: #843534"> B.C.E.S: Bon de Commande Externe Système</h5>
<h5 style="color: #843534"> B.D.C.S: Bon de Dépenses au Comptant Système</h5>
<div class="sf_admin_filter col-xs-6">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('documentachat_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="margin-bottom: 0px;" onmouseup="setMinMaxDate()">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'documentachat_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php
//                $str = "?idtype=6";
                foreach ($configuration->getFormFilterFields($form) as $name => $field):
                    ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('documentachat/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                    ));
//                    if ($name != "datecreation")
//                        $str.="&" . $name . "=" . $form[$name]->getValue();
//                    else {
//                        $datecreation = $form[$name]->getValue();
//                       
//                        $str.="&De=" . date('Y-m-d', strtotime($datecreation['from'])) .
//                                "&à=" . date('Y-m-d', strtotime($datecreation['to']));
//                    }
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
<div class="col-xs-4 widget-container-col" id="widget-container-col-1">
    <div class="widget-box" id="widget-box-1">
        <div class="widget-header">
            <div class="widget-toolbar">
                <a href="#" data-action="collapse" class="btn btn-xs btn-success">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main" style="padding: 5%; text-align: center;">
                <a href="<?php echo url_for('documentachat/new?idtype=6') ?>" class="btn btn-outline btn_new btn-success" style="text-align: center;height: 55px !important; width: 250px;        font-size: 14px !important; " >Nouveau Demande Achat </a>  
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;"
                        target="_blanc" 
                        onclick="printListDocAchats()"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
<!--                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('documentachat/exporterdocumentExcel'). '' . $str   ?>" class=" btn btn-outline btn-primary">
               <i class="ace-icon fa fa-file-excel-o"></i>     Exporter vers Excel (.xlsx )
               </a>-->
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats()"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Excel (.xlsx )
                </button>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setMinMaxDate() {
        var annee_exercice = '<?php echo date('Y'); ?>';
//        var min_date = annee_exercice + '-01-01';
//        var max_date = annee_exercice + '-12-31';
//        $('#documentachat_filters_datecreation_from').attr('min', min_date);
//        $('#documentachat_filters_datecreation_from').attr('max', max_date);
//        $('#documentachat_filters_datecreation_to').attr('min', min_date);
//        $('#documentachat_filters_datecreation_to').attr('max', max_date);
    }
    function printListDocAchats() {
        var url = '';
        if ($('#documentachat_filters_datecreation_from').val() != '')
        {
            url = '?datedebut=' + $('#documentachat_filters_datecreation_from').val();
        }

        if ($('#documentachat_filters_datecreation_to').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#documentachat_filters_datecreation_to').val();
            else
                url = url + '&datefin=' + $('#documentachat_filters_datecreation_to').val();
        }

        if ($('#documentachat_filters_reference').val() != '')
        {
            if (url == '')
                url = '?reference=' + $('#documentachat_filters_reference').val();
            else
                url = url + '&reference=' + $('#documentachat_filters_reference').val();
        }
         if ($('#documentachat_filters_numero').val() != '')
        {
            if (url == '')
                url = '?numero=' + $('#documentachat_filters_numero').val();
            else
                url = url + '&numero=' + $('#documentachat_filters_numero').val();
        }
        url = '<?php echo url_for('Documents/imprimerlistedocument') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

    function ExportListDocAchats() {
        var url = '';
        if ($('#documentachat_filters_datecreation_from').val() != '')
        {
            url = '?datedebut=' + $('#documentachat_filters_datecreation_from').val();
        }


        if ($('#documentachat_filters_datecreation_to').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#documentachat_filters_datecreation_to').val();
            else
                url = url + '&datefin=' + $('#documentachat_filters_datecreation_to').val();
        }

        if ($('#documentachat_filters_reference').val() != '')
        {
            if (url == '')
                url = '?reference=' + $('#documentachat_filters_reference').val();
            else
                url = url + '&reference=' + $('#documentachat_filters_reference').val();
        }
        url = '<?php echo url_for('documentachat/exporterdocumentExcel') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }
</script>