<div class="col-lg-8">
    <fieldset >

        <table>
            <tbody> <tr>
                    <td><label>Agents </label></td>
                    <td>
                        <?php echo $form['id_agents']->renderError() ?>
                        <?php echo $form['id_agents'] ?>
                    </td>
                    <td><label> Nature (Récompenses/Médailles) </label></td>
                    <td>
                        <?php echo $form['id_typerecompense']->renderError() ?>
                        <?php echo $form['id_typerecompense'] ?>
                    </td></tr> 

                <tr>
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
            </tbody>
        </table>
    </fieldset>
    <fieldset style="width: 50px;margin-left: 450px">
        <table>
            <tr>
                <td><label>Source</label></td>
                    <td>
                        <?php echo $form['source']->renderError() ?>
                        <?php echo $form['source'] ?>
                    </td>
            </tr>
        </table>
    </fieldset>
</div>