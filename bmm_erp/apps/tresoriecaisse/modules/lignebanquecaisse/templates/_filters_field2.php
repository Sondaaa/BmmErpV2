<?php if ($field->isPartial()): ?>
    <?php include_partial('lignebanquecaisse/' . $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('lignebanquecaisse', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <tr class="<?php echo $class ?>">
        <td>
            <?php
            if ($name != "id_budget") {
                echo 'Compte Bancaire';
            }
            ?>
        </td>
        <td>
            <?php echo $form[$name]->renderError() ?>
            <?php if ($name != "id_caissebanque" && $name != "id_budget") { ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
                <?php
            } else {
                if ($name == "id_caissebanque") {
                    $banques = Doctrine_Core::getTable('caissesbanques')->findByIdTypecb(2);
                    ?>
                    <select name="lignebanquecaisse_filters[<?php echo $name ?>]">
                        <option value=""></option>
                        <?php foreach ($banques as $bn) { ?>
                            <option value="<?php echo $bn->getId() ?>"><?php echo $bn ?></option>
                        <?php } ?> 
                    </select>
                    <?php
                }
              
                if ($name == "id_budget") {
                    echo 'Budget';
                }
                if ($name == "id_budget") {
                    $budgets = Doctrine_Core::getTable('ligprotitrub')->findAll();
                    ?>
                    <select name="lignebanquecaisse_filters[<?php echo $name ?>]">
                        <option value=""></option>
                        <?php foreach ($budgets as $bn) { ?>
                            <option value="<?php echo $bn->getId() ?>"><?php echo $bn->getRubrique() ?></option>
                        <?php } ?> 
                    </select>
                    <?php
                }
            }
            ?>
            <?php if ($help || $help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>