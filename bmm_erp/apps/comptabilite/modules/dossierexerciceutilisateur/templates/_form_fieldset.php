<div class="col-sm-12" ng-controller="myCtrlPaysVille">
    <div class="col-sm-6">
        <fieldset style="width: 100%">
            <legend><i> Affectation</i></legend>
            <table>
                <tbody>
                    <tr>
                        <td><label> Choisir le Dossier et Exercice  </label></td>
                        <td >
                            <?php echo $form['id_dossierexercice']->renderError() ?>
                            <?php echo $form['id_dossierexercice'] ?>
                        </td>

                    </tr> 
                    <tr>
                        <td><label>Choisir Agent Existant </label></td>
                        <td>
                            <?php echo $form['id_utilisateur']->renderError() ?>
                            <?php echo $form['id_utilisateur'] ?>
                        </td>

                    </tr>
                    <tr>
                        <td ><label>Date de Création </label></td>
                        <td >
                            <?php echo $form['date']->renderError() ?>
                            <?php echo $form['date'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="col-sm-6">
        <fieldset style="width: 100%;">  
            <legend><i> Ajouter Utilisateur</i></legend>
            <table>
                <tr>
                    <td style="width: 20%;">

                        <label>Matricule <span class="required">*</span><br>(8 caractères)</label></td>
                    <td style="width: 30%;"> 
                        <div class="mws-form-row">
                            <input placeholder="Matricule" value="" id="matricule" type="text" >
                        </div>
                    </td>

                </tr><br>
                <tr> <td style="width: 20%;"><label>CIN <span class="required">*</span><br>(8 chiffres)</label></td>
                    <td style="width: 30%;">
                        <div class="mws-form-row">
                            <input placeholder="Cin " value="" id="cin" type="text" >
                        </div>
                    </td>


<!--                    <td>
                                                <a style="text-align: center" href="#modal-utilisateur" role="button" class="btn btn-primary" data-toggle="modal"  >
                                                <i class="ace-icon fa fa-save bigger-110"></i>Nouveau Utilisateur</a>
                    </td>-->

                </tr>

            </table>
            <br>
            <a style="margin-left: 5px;font-size: 14px" href="<?php echo url_for('agents/new') ?>" target="_blank"
               class ="btn  btn-danger pull-right"><i class="ace-icon fa fa-eye bigger-110  pull-left"></i> 
                Fiche Personnelle 
            </a>
            <a style="text-align: center; margin-left: 2px;font-size: 14px" href="#modal-agent" role="button" 
               class="btn btn-info pull-right disabledbutton " data-toggle="modal" id="btn_ajoutuser" >
                <i class="ace-icon fa fa-save bigger-110"></i>Nouveau Utilisateur</a>



        </fieldset>
        </br></br></br>
    </div>
</div>

<!--    <a  class="btn btn-xs btn-danger pull-right" href="<?php // echo url_for('@newAgents')                                           ?>"></a>-->
<div>
    <a id="btn_retour" type="button" style="width: 10%;width: 10%;margin-left: 25px;"   class="btn btn-primary1 pull-left" href="<?php echo url_for('@dossierexerciceutilisateur') ?>">
        Retour à la liste</a>

    <input style="margin-left: 1%;" id="btn_save"  type="submit" value="Ajouter" class="btn  btn-primary" >
</div>
<div id="modal-agent" class="modal fade" tabindex="-1">
    <?php
    include_partial('dossierexerciceutilisateur/agent', array());
    ?>
</div>
<!--<div id="modal-utilisateur" class="modal fade" tabindex="-1">
<?php
//    include_partial('dossierexerciceutilisateur/utilisateur', array());
?>
</div>-->
<script  type="text/javascript">

    $(document).ready(function () {



</script>
