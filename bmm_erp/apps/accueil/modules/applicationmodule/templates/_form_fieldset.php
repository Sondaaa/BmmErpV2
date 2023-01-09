<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php
        include_partial('applicationmodule/form_field', array(
            'name' => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label' => $field->getConfig('label'),
            'help' => $field->getConfig('help'),
            'form' => $form,
            'field' => $field,
            'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_form_field_' . $name,
        ))
        ?>
    <?php endforeach; ?>

    <div class="col-lg-8">
        <div>
            <label>Actions</label>
            <div class="content">
                <table style="margin-bottom: 10px;">
                    <tbody>
                        <tr>
                            <td><input id="Création" type="checkbox" value="Création" name="actions"> Création</td>
                            <td><input id="Consultation" type="checkbox" value="Consultation" name="actions"> Consultation</td>
                            <td><input id="Modification" type="checkbox" value="Modification" name="actions"> Modification</td>
                            <td><input id="Suppression" type="checkbox" value="Suppression" name="actions"> Suppression</td>
                        </tr>
                        <tr>
                            <td><input id="Validation" type="checkbox" value="Validation" name="actions"> Validation</td>
                            <td><input id="Blocage" type="checkbox" value="Blocage" name="actions"> Blocage</td>
                            <td><input id="Annulation" type="checkbox" value="Annulation" name="actions"> Annulation</td>
                            <td><input id="Impression" type="checkbox" value="Impression" name="actions"> Impression</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>

</fieldset>

<script  type="text/javascript">

<?php foreach ($applicationmodule->getApplicationmoduleaction() as $ligne): ?>
        $("#<?php echo $ligne->getLibelle(); ?>").prop("checked", "true");
<?php endforeach; ?>

    function enregistrer(id) {
        if ($("#applicationmodule_id_application").val() != '' && $("#applicationmodule_libelle").val() != '') {
            var actions = '';
            $('[name="actions"]').each(function () {
                if ($(this).is(':checked'))
                    actions = actions + $(this).val() + ',';
            });
            
            $.ajax({
                url: '<?php echo url_for('applicationmodule/enregistrer') ?>',
                data: 'id=' + id +
                        '&id_application=' + $("#applicationmodule_id_application").val() +
                        '&libelle=' + $("#applicationmodule_libelle").val() +
                        '&actions=' + actions,
                success: function (data) {
                    bootbox.dialog({
                        message: "Sous module E.R.P enregistré !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    location.reload();
                }
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir le module et/ou saisir le libellé du sous module !",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }

</script>