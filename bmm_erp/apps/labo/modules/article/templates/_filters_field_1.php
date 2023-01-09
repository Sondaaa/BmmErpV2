<?php if ($field->isPartial()): ?>
    <?php include_partial('article/' . $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('article', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <?php  if ($i % 2 == 0) {
        echo '<tr class="' . $class . '">';
    } ?>


    <td>
        <?php  echo $form[$name]->renderLabel($label) ?>
    </td>
    <td>
        <?php echo $form[$name]->renderError() ?>

        <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>

        <?php if ($help || $help = $form[$name]->renderHelp()): ?>
            <div class="help"><?php echo __($help, array(), 'messages') ?></div>
    <?php endif; ?>
    </td>
    <?php if ($i % 2 != 0) {
        echo '</tr>';
    } ?>

<?php endif; ?>
