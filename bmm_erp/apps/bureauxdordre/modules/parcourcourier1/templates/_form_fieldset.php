<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <?php
    $valide = "";
    if (isset($_REQUEST['valide']))
        $valide = $_REQUEST['valide'];
   
    $vartypecourrier = "";
    if (!$form->getObject()->isNew())
        if ($form->getObject()->getCourrier()->getIdType() == "1")
            $vartypecourrier = '1';
    ?>
    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>

        <?php
        $label = $field->getConfig('label');
        $cacher = "";
        if ($vartypecourrier == '1' && $label == "Description")
            $cacher = "1";
        if ($vartypecourrier == '1' && $label == "Max Réponse")
            $cacher = "1";
        if ($vartypecourrier == '1' && $label == "Action")
            $cacher = "1";
        if($valide=="0")
            $cacher="";
        if ($cacher != "1")
            include_partial('piecejoint/form_field', array(
                'name' => $name,
                'attributes' => $field->getConfig('attributes', array()),
                'label' => $field->getConfig('label'),
                'help' => $field->getConfig('help'),
                'form' => $form,
                'field' => $field,
                'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_form_field_' . $name,
            ));
        ?>
    <?php endforeach; ?>
</fieldset>
