<?php if ($field->isPartial()): ?>
    <?php include_partial('documentachat/' . $name, array('type' => 'filter', 'form' => $form, 'idtype' => $idtype, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('documentachat', $name, array('type' => 'filter', 'form' => $form, 'idtype' => $idtype, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <tr class="<?php echo $class ?>  <?php if ($name == 'id_typedoc'): ?> disabledbutton <?php endif ?>">
        <td>
            <?php echo $form[$name]->renderLabel($label) ?>
        </td>
        <td>
            <?php echo $form[$name]->renderError() ?>

            <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>

            <?php if ($help || $help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
