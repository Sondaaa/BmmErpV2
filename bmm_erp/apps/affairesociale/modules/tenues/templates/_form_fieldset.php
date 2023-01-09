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
<!--                            <input type="text" id="typetenue" value="<?php // echo trim($tenues->getTypetenue()) ?>">-->

                            <td >Agents </td>
                            <td>
                                <?php echo $form['id_agents']->renderError() ?>
                                <?php echo $form['id_agents'] ?>
                            </td>

                            <td class="disabledbutton">
                                <input style="width: 25px" type="text" ng-model="idrh.text" id="idrh" placeholder="Matricule"  class="form-control">
                                <input style="width: 25px" type="text" ng-model="nom.text" id="nom" placeholder="Nom"   class="form-control">
                            </td>
                            <td colspan="2" class="disabledbutton">

                                <input type="text" ng-model="poste.text" id="poste" placeholder="Poste"  class="form-control">
                                <input type="text" ng-model="dateaffectation.text" id="dateaffectation" placeholder="Date d'Affectation"   class="form-control">

                            </td>
                            </tr>
                            <tr>
                                <td>Type Mission</td>
                                <td>
                                    <?php echo $form['id_typemission']->renderError() ?>
                                    <?php echo $form['id_typemission'] ?>
                                </td>
                                <td>Type Tenue</td>
                                <td id='typetenue' class="disabledbutton">
                                    <?php echo $form['id_typetenue']->renderError() ?>
                                    <?php echo $form['id_typetenue'] ?>
                                </td>

                            </tr>


                            <tr>
                                <td>Date</td>
                                <td >
                                    <?php echo $form['date']->renderError() ?>
                                    <?php echo $form['date'] ?>
                                </td>
                                <td>Observation </td>
                                <td colspan="3">
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
<script  type="text/javascript">
    $(document).ready(function () {
//        $('#tenues_id_typetenue option[value=' + $('#typetenue').val() + ']').attr('selected', 'selected');
//        $('#tenues_id_typetenue').trigger("chosen:updated");


    })


</script>