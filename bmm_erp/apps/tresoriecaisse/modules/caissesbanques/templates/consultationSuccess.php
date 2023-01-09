<div id="sf_admin_container">
    <h1>Fiche de Consultation Bancaire</h1>
    
    <div id="sf_admin_bar">
        <div>
            <div class="sf_admin_filter">
                <form  method="post">
                    <table cellspacing="0">
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <?php //echo $form->renderHiddenFields() ?>

                                    <input type="submit" value="Recherche" />
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Date début</td><td><input type="date" name="ddf"></td>
                            </tr>
                            <tr>
                                <td>Date fin</td><td><input type="date" name="dff"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div id="sf_admin_content">

    </div>

    <div id="sf_admin_footer">

    </div>
</div>