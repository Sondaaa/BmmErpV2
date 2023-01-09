<div class="row" >
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller"> </h4>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-height: 200px;">
                    <fieldset>
                        <table>
                            <tr>
                                <td>Agents </td>
                                <td>
                                    <?php echo $form['id_agents']->renderError() ?>
                                    <?php echo $form['id_agents'] ?>
                                </td>
                                <td>Type d'aide</td>
                                <td>
                                    <?php echo $form['id_typeaide']->renderError() ?>
                                    <?php echo $form['id_typeaide'] ?>
                                </td>
                                <td>Date d'aide</td>
                                <td>
                                    <?php echo $form['date']->renderError() ?>
                                    <?php echo $form['date'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Origine d'Aide </td>
                                <td colspan="3">
                                    <?php echo $form['origine']->renderError() ?>
                                    <?php echo $form['origine'] ?>
                                </td>
                                <td>Montant </td>
                                <td>
                                    <?php echo $form['montant']->renderError() ?>
                                    <?php echo $form['montant'] ?>
                                </td>

                            </tr>
                            <tr>
                                <td>Observation </td>
                                <td colspan="5">
                                    <?php echo $form['observation']->renderError() ?>
                                    <?php echo $form['observation'] ?>
                                </td>
                            </tr>

                        </table>
                    </fieldset>


                </div>

            </div>
        </div>
    </div>
</div>



<style>

    .bootstrap-duallistbox-container .info {
        font-size: 14px;
    }

</style>