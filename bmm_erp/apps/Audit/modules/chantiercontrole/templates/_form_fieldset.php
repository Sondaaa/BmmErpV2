<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php if ($name != "datecreation"): ?>
            <?php
            include_partial('chantiercontrole/form_field', array(
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
            <div class="col-lg-4">
                <div>
                    <label for="chantiercontrole_datecreation">Date Création</label>
                    <div class="content"><input type="date" name="chantiercontrole[datecreation]" value="<?php
                        if ($form->isNew()):
                            echo date('Y-m-d');
                        else:
                            echo $chantiercontrole->getDatecreation();
                        endif;
                        ?>" id="chantiercontrole_datecreation" class="disabledbutton"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</fieldset>