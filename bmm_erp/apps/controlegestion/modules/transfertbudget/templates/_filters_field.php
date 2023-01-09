<?php if ($field->isPartial()): ?>
    <?php include_partial('transfertbudget/' . $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('transfertbudget', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <tr class="<?php echo $class ?>">
        <td>
            <?php echo $form[$name]->renderLabel($label) ?>
        </td>
        <td>
            <?php if ($name == "id_source" || $name == "id_destination") { ?>
                <table>
                    <tr id="row_budget">
                        <td style="width: 40%">
                            <select id="<?php
                            if ($name == "id_source")
                                echo "budgetsource";
                            if ($name == "id_destination")
                                echo "budgetdestination"
                                ?>">
                                <option value="0">Sélectionnez</option>
                                <?php foreach ($budgets as $budget) { ?>
                                    <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                        <?php echo $budget->getLibelle() ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="disabledbutton" id="<?php
                        if ($name == "id_source")
                            echo "tdbudgetsource";
                        if ($name == "id_destination")
                            echo "tdbudgetdestination"
                            ?>">
                                <?php echo $form[$name]->renderError() ?>
                                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
                        </td>
                    </tr>
                </table>
            <?php }else { ?>
                <?php echo $form[$name]->renderError() ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
                <?php if ($help || $help = $form[$name]->renderHelp()): ?>
                    <div class="help"><?php echo __($help, array(), 'messages') ?></div>
                    <?php
                endif;
            }
            ?>
        </td>
    </tr>
<?php endif; ?>
