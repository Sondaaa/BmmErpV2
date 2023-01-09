<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php if ($name != "datecreation" && $name != "total"): ?>
            <?php
            include_partial('rapportcontrole/form_field', array(
                'name' => $name,
                'attributes' => $field->getConfig('attributes', array()),
                'label' => $field->getConfig('label'),
                'help' => $field->getConfig('help'),
                'form' => $form,
                'field' => $field,
                'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_form_field_' . $name,
            ))
            ?>
        <?php else: ?>
            <?php if ($name == "datecreation"): ?>
                <div class="col-lg-12">
                    <div>
                        <label for="rapportcontrole_datecreation">Date Création</label>
                        <div class="content">
                            <input type="date" name="rapportcontrole[datecreation]" value="<?php
                            if ($form->isNew()):
                                echo date('Y-m-d');
                            else:
                                echo $rapportcontrole->getDatecreation();
                            endif;
                            ?>" id="rapportcontrole_datecreation" class="disabledbutton">
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-4">
                    <div>
                        <label for="rapportcontrole_total">Total</label>
                        <div class="content">
                            <?php if ($form->isNew()): ?>
                            <input type="text" readonly="true" name="rapportcontrole[total]" id="rapportcontrole_total" class="class" style="width: 100%;">
                            <?php else: ?>
                                <input type="text" readonly="true" value="<?php echo $rapportcontrole->getTotal(); ?>" name="rapportcontrole[total]" id="rapportcontrole_total" class="class" style="width: 100%;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</fieldset>
