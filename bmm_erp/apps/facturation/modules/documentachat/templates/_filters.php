<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<!--<div class="col-sm-6">-->
<div class="sf_admin_filter col-sm-8" id="document_achat_filtre">
    <div class="widget-box">
        <div class="widget-header">
            <h4 class="smaller">
                Recherche
                <?php if ($idtype == 15) : ?>
                    <small>Des Factures</small>
                <?php else : ?>
                    <small>Des Documents pour Facturer</small>
                <?php endif; ?>
            </h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <?php if ($form->hasGlobalErrors()) : ?>
                    <?php echo $form->renderGlobalErrors() ?>
                <?php endif; ?>
                <form action="<?php echo url_for('documentachat_collection', array('action' => 'filter')) ?>" method="post">
                    <table cellspacing="0" style="margin-bottom: 0px;">
                        <!--onmouseup="setMinMaxDate()"-->
                        <tbody>
                            <input type="hidden" id="id_type" value="<?php echo $idtype; ?>">
                            <?php
                            $str = "?idtype=" . $idtype .'&type_fac='. $type_fac;

                            foreach ($configuration->getFormFilterFields($form) as $name => $field) :
                            ?>
                                <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                                <?php if ($name != "id_typedoc") : ?>
                                    <?php $disabled = ''; ?>
                                <?php else : ?>
                                    <?php // $disabled = 'disabledbutton '; 
                                    ?>
                                <?php endif; ?>
                                <?php
                                include_partial('documentachat/filters_field', array(
                                    'name' => $name,
                                    'attributes' => $field->getConfig('attributes', array()),
                                    'label' => $field->getConfig('label'),
                                    'help' => $field->getConfig('help'),
                                    'form' => $form,
                                    'idtype' => $idtype,

                                    'field' => $field,
                                    'class' => $disabled . 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                                ));
                                if ($name != "datecreation")
                                    $str .= "&" . $name . "=" . $form[$name]->getValue();
                                else {
                                    $datecreation = $form[$name]->getValue();
                                    $str .= "&from=" . date('Y-m-d', strtotime($datecreation['from']))
                                        . "&to=" . date('Y-m-d', strtotime($datecreation['to']));
                                }
                                ?>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    <hr>
                    <?php echo $form->renderHiddenFields() ?>
                    <?php echo link_to(__('Reset', array(), 'sf_admin'), 'documentachat_collection', array('action' => 'filter'), array('query_string' => '_reset&id_typedoc=' . $idtype, 'method' => 'post', 'id_typedoc' => $idtype)) ?>
                    <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-4 widget-container-col" id="widget-container-col-1">
    <div class="widget-box" id="widget-box-1">
        <div class="widget-header">

            <h4 class="smaller">Action </h4>
        </div>
        <div class="widget-body">
            <div class="widget-main" style=" text-align: center;">
                <?php if ($idtype == 15 ) : ?>
                    <!-- <a href="<?php //echo url_for('documentachat/NewFactureHorsBCI') . $str ?>" class="btn btn-outline btn_new btn-success" style="text-align: center; height: 40px !important; width: 250px; font-size: 14px !important;">Nouvelle Fiche Facture Hors BCI
                    </a> <br><br> -->
                <?php endif; ?>

                <a target="_blanc" href="<?php echo url_for('Documents/Imprimerlistedocument') . $str ?>" class=" btn btn-outline btn_new btn-primary " style="text-align: center; height: 40px !important; width: 250px; font-size: 14px !important;">
                    <i class="fa fa-file-pdf-o"></i> Exporter PDF
                </a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //$('#documentachat_filters_id_typedoc').val($('#id_type').val());
    function setMinMaxDate() {
        var annee_exercice = '<?php echo date('Y'); ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#documentachat_filters_datecreation_from').attr('min', min_date);
        $('#documentachat_filters_datecreation_from').attr('max', max_date);
        $('#documentachat_filters_datecreation_to').attr('min', min_date);
        $('#documentachat_filters_datecreation_to').attr('max', max_date);


    }
</script>