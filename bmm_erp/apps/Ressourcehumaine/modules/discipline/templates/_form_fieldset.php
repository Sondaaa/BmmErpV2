<div class="col-lg-12" ng-controller="CtrlRessourcehumaine">
    <fieldset >
        <?php if (!$form->getObject()->isNew()) { ?>
            <input type="hidden" id="nature" value="<?php echo trim($discipline->getIdNaturediscipline()) ?>">
        <?php } ?> 
        <table>
            <tbody>
                <tr>
                    <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                    <td><label>Type (Disciplines/Sanctions) </label></td>
                    <td>
                        <?php echo $form['id_typediscipline']->renderError() ?>
                        <?php echo $form['id_typediscipline'] ?>
                    </td>
                </tr> 
                <tr>
                    <td><label>Nature (Disciplines/Sanctions) </label></td>
                    <td>
                        <?php echo $form['id_naturediscipline']->renderError() ?>
                        <?php echo $form['id_naturediscipline'] ?>
                    </td>
                    <td><label>Nombre de jour</label></td>
                    <td>
                        <?php echo $form['nbrejour']->renderError() ?>
                        <?php echo $form['nbrejour'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Motif</label></td>
                    <td>
                        <?php echo $form['explication']->renderError() ?>
                        <?php echo $form['explication'] ?>
                    </td>
                    <td><label>Date</label></td>
                    <td>
                        <?php echo $form['date']->renderError() ?>
                        <?php echo $form['date'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>
<?php if (!$form->getObject()->isNew()): ?>
    <script  type="text/javascript">
        $(document).ready(function () {
            $('#discipline_id_naturediscipline option[value=' + $('#nature').val() + ']').attr('selected', 'selected');
            $('#discipline_id_naturediscipline').trigger("chosen:updated");
        })
    </script>
<?php endif; ?>