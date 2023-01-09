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
                                 <td>Lieu</td>
                                 <td>
                                    <?php echo $form['id_lieu']->renderError() ?>
                                    <?php echo $form['id_lieu'] ?>
                                </td>
                                <td>Date d'accident </td>
                                <td>
                                    <?php echo $form['date']->renderError() ?>
                                    <?php echo $form['date'] ?>
                                </td>
                               
                                
                            </tr>
                            <tr>
                                <td>Motif d'accident</td>
                                <td colspan="3">
                                    <?php echo $form['motif']->renderError() ?>
                                    <?php echo $form['motif'] ?>
                                </td>
                                  <td>Nbre des jours de convalescence </td>
                                <td>
                                    <?php echo $form['nbrjour']->renderError() ?>
                                    <?php echo $form['nbrjour'] ?>
                                </td>
                              
                            </tr>
                            <tr>
                                <!-- ." " ."Jour "-->
                                
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