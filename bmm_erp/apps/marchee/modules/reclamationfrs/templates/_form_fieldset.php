<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
  <?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
  <?php endif; ?>
</fieldset>
<fieldset ng-controller="Ctrlfrs" ng-init="InialiserReclamation(<?php echo $_REQUEST['idfrs'] ?>)">
    <legend>Données fiche</legend>
    <table>
        <tbody>
            <tr>
                <td><label>Date </label></td>
                <td>
                    <?php echo $form['daterec']->renderError() ?>
                    <?php echo $form['daterec'] ?>
                </td>
                <td><label>Fournisseur</label></td>
                <td <?php if($_REQUEST['idfrs'] != null): ?>class="disabledbutton"<?php endif; ?>>
                    <?php echo $form['id_frs']->renderError() ?>
                    <?php echo $form['id_frs'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Object </label></td>
                <td colspan="3">
                    <?php echo $form['object']->renderError() ?>
                    <?php echo $form['object'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Sujet</label></td>
                <td colspan="3">
                    <?php echo $form['sujet']->renderError() ?>
                    <?php echo $form['sujet'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>