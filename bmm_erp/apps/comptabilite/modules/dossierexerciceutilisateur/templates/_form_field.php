<?php if ($field->isPartial()): ?>
    <?php include_partial('dossierexerciceutilisateur/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('dossierexerciceutilisateur', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError() ?>
        <div>
            <?php echo $form[$name]->renderLabel($label) ?>

            <?php if ($name != "date"): ?>
                <div class="content"><?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?></div>
            <?php else: ?>
                <div class="content">
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" class="disabledbutton" name="dossierexerciceutilisateur[date]" id="dossierexerciceutilisateur_date">
                </div>
            <?php endif; ?>

            <?php if ($help): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php elseif ($help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo $help ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
