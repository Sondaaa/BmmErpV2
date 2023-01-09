<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter col-xs-6" ng-controller="myCtrlTransfertbudget">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('transfertbudget_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="margin-bottom: 0px;" >
            <!--onmouseup="setMinMaxDate()"-->
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'transfertbudget_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $ligne = new Ligprotitrub();
                $annees = $_SESSION['exercice_budget'];
                $budgets = Doctrine_Query::create()
                                ->select("id,libelle")
                                ->from('titrebudjet')
                                ->where("Etatbudget=2")
                                ->andwhere("trim(typebudget) not like trim('Prototype')")
                                ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')")
                                ->orderBy('id asc')->execute();
                ?>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php if ($name == "id_source" || $name == "id_destination"): ?>
                        <?php
                        include_partial('transfertbudget/filters_field', array(
                            'name' => $name,
                            'attributes' => $field->getConfig('attributes', array()),
                            'label' => $field->getConfig('label'),
                            'help' => $field->getConfig('help'),
                            'form' => $form,
                            'ligne' => $ligne,
                            'budgets' => $budgets,
                            'field' => $field,
                            'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                        ))
                        ?>
                    <?php else: ?>
                        <?php
                        include_partial('transfertbudget/filters_field', array(
                            'name' => $name,
                            'attributes' => $field->getConfig('attributes', array()),
                            'label' => $field->getConfig('label'),
                            'help' => $field->getConfig('help'),
                            'form' => $form,
                            'field' => $field,
                            'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                        ))
                        ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
<?php if (!$etat) { ?>
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
                <div class="widget-main" style="padding: 7%; text-align: center; min-height: 265px;">
                    <a class="btn btn-outline btn_new btn-success" href="<?php echo url_for('transfertbudget/new') ?>" style="text-align: center;height: 60px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Nouvelle Fiche<br> Transfert</a>
                    <br>
                    <a target="_blank" class="btn btn-outline btn_new btn-success" href="<?php echo url_for('transfertbudget/imprimerListe') ?>" style="text-align: center;height: 60px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Imprimer Liste<br>des Transferts</a>
                    <?php if (isset($_SESSION['exercice_budget'])): ?>
                        <br>
                        <a target="_blank" class="btn btn-outline btn_new btn-success" href="<?php echo url_for('transfertbudget/imprimerListe?annee=' . $_SESSION['exercice_budget']) ?>" style="text-align: center;height: 60px !important; width: 250px; font-size: 14px !important; margin-top: 5px;">Imprimer Liste<br>des Transferts - <?php echo $_SESSION['exercice_budget']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <script  type="text/javascript">

        function setMinMaxDate() {
            var annee_exercice = '<?php echo $_SESSION['exercice_budget']; ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#transfertbudget_filters_datecreation_from').attr('min', min_date);
        $('#transfertbudget_filters_datecreation_from').attr('max', max_date);
        $('#transfertbudget_filters_datecreation_to').attr('min', min_date);
        $('#transfertbudget_filters_datecreation_to').attr('max', max_date);
    }

</script>

<style>

    .sf_admin_td_actions{margin: 0px !important;}

</style>