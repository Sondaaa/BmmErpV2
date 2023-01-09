<?php if ($field->isPartial()): ?>
    <?php include_partial('caissesbanques/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('caissesbanques', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError() ?>
        <?php
        $class = "";
        if ($name == "id_typecb"):
            $class = "disabledbutton";
            $display = "none";
        else:
            $display = "block";
        endif;
        ?>
        <div class="<?php echo $class ?>" style="display: <?php echo $display ?>;">
    <?php echo $form[$name]->renderLabel($label) ?>

            <div class="content"><?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?></div>

            <?php if ($help): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php elseif ($help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo $help ?></div>
    <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
