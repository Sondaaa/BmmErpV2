<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('tableauxammortisement_collection', array('action' => 'filter')) ?>" method="get">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'tableauxammortisement_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                        <!--<input type="submit" value="Calculer!!!" name="btn_calcul" />-->
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('tableauxammortisement/filters_field', array(
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
                <?php $form_immo = new ImmobilisationForm(); ?>
                <tr>
                    <td><label>Catégorie</label></td>
                    <td><?php echo $form_immo['id_categorie']; ?></td>
                </tr>
                <tr>
                    <td><label>Famille</label></td>
                    <td><?php echo $form_immo['id_famille']; ?></td>
                </tr>
                <tr>
                    <td><label>Sous Famille</label></td>
                    <td><?php echo $form_immo['id_sousfamille']; ?></td>
                </tr>
                <tr>
                    <td><label>Année</label></td>
                    <td><input id="annee" name="annee" type="text" value=""></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

<div class="col-xs-4 widget-container-col pull right" id="widget-container-col-1">
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
                <button onclick="imprimer()" class="btn btn-white btn-primary">Exporter Tableau Amortissement</button>
                <br><br>
                <a target="_blank" href="<?php echo url_for('tableauxammortisement/variation') ?>" class="btn btn-white btn-success">Tableau de Variation des Immobilisations</a>
            </div>
        </div>
    </div>
</div>

<script>

    function imprimer() {
        var url = '';
        if ($('#tableauxammortisement_filters_id_immobilisation').val() != '')
            url = '?id=' + $('#tableauxammortisement_filters_id_immobilisation').val();
        if ($('#immobilisation_id_categorie').val() != '') {
            if (url == '') {
                url = '?id_categorie=' + $('#immobilisation_id_categorie').val();
            } else {
                url = '&id_categorie=' + $('#immobilisation_id_categorie').val();
            }
        }
        if ($('#immobilisation_id_famille').val() != '') {
            if (url == '') {
                url = '?id_famille=' + $('#immobilisation_id_famille').val();
            } else {
                url = '&id_famille=' + $('#immobilisation_id_famille').val();
            }
        }
        if ($('#immobilisation_id_sousfamille').val() != '') {
            if (url == '') {
                url = '?id_sousfamille=' + $('#immobilisation_id_sousfamille').val();
            } else {
                url = '&id_sousfamille=' + $('#immobilisation_id_sousfamille').val();
            }
        }
        if ($('#annee').val() != '') {
            if (url == '') {
                url = '?annee=' + $('#annee').val();
            } else {
                url = '&annee=' + $('#annee').val();
            }
        }

        url = '<?php echo url_for('tableauxammortisement/imprimer') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>