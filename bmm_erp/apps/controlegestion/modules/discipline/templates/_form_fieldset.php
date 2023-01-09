<div class="col-lg-10" ng-controller="CtrlRessourcehumaine">
    <fieldset >

        <table>
            <tbody> <tr>
                    <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                    <td><label>Type (Disciplines/Sanctions) </label></td>
                    <td>
                        <?php echo $form['id_typediscipline']->renderError() ?>
                        <?php echo $form['id_typediscipline'] ?>
                    </td></tr> 

                <tr>

                    <td><label>Nature (Disciplines/Sanctions) </label></td>
                    <?php
                    $magnature = Doctrine_Core::getTable('naturediscipline')->findAll();
                    ?>
                    <td>
                        <select id="magNature">
                            <option></option>
                            <?php foreach ($magnature as $magN) { ?>
                                <option  value="<?php echo $magN->getId() ?>">
                                    <?php echo $magN ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>

                    <td><label>Nombre de jour</label></td>
                    <td>
                        <?php echo $form['nbrejour']->renderError() ?>
                        <?php echo $form['nbrejour'] ?></td>
                </tr><tr>


                    <td><label>  Motif</label></td>
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
        </table></tbody>
    </fieldset>
</div>