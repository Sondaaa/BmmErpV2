<?php if ($field->isPartial()): ?>
    <?php include_partial('ligneoperationcaisse/' . $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('ligneoperationcaisse', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <tr class="<?php echo $class ?>">
        <td>
            <?php echo $form[$name]->renderLabel($label) ?>
        </td>
        <td>
            <?php echo $form[$name]->renderError() ?>
            <?php if ($name != "id_caisse"): ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
            <?php else: ?>
                <?php $caisses = Doctrine_Core::getTable('caissesbanques')->findByIdTypecb(1); ?>
                <select name="<?php $name ?>">
                    <option value="0"></option>
                    <?php foreach ($caisses as $c) { ?>
                        <option value="<?php echo $c->getId() ?>"><?php echo $c ?></option>
                    <?php } ?> 
                </select>
            <?php endif; ?>
            <?php if ($help || $help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
