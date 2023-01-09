<div id="sf_admin_container" ng-controller="myCtrlPaysVille" >
    <div class="modal-dialog" >
        <div class="modal-content" ng-init="InialiserChampsSelect()">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Ajouter Agent</h3>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <fieldset>
                            <div class="col-lg-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;">
                                                <label>Matricule <br>(8 caractères)</label></td>
                                            <td style="width: 30%;"> 
                                                <div class="mws-form-row">
                                                    <input placeholder="Matricule" value="" id="matricule_popup" type="text" disabled="true">
                                                </div>
                                            </td>
                                            <td style="width: 20%;"><label>CIN </label></td>
                                            <td style="width: 30%;">
                                                <div class="mws-form-row">
                                                    <input placeholder="Cin " value="" id="cin_popup" type="text" disabled="true">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Nom <span class="required">*</span></label></td>
                                            <td>
                                                <div class="mws-form-row">
                                                    <input placeholder="Nom " value="" id="nom" type="text" >
                                                </div>
                                            </td>
                                            <td><label>Prénom</label></td>
                                            <td>
                                                <div class="mws-form-row">
                                                    <input placeholder="Prénom " value="" id="prenom" type="text" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>     
                                            <td><label>Date Naissance </label></td>
                                            <td>
                                                <div class="mws-form-row">
                                                    <input placeholder="Date Naissance " value="" id="date" type="date" >
                                                </div>
                                            </td>
                                            <td><label>Lieu Naissacance </label></td>
                                            <?php $villes = Doctrine_Core::getTable('gouvernera')->findAll();
                                            ?>
                                            <td style="width: 25%">
                                                <div class="mws-form-row">
                                                    <select id="lieun" class="mws-select2 large">
                                                        <option value=""></option>
                                                        <?php foreach ($villes as $ville): ?>
                                                            <option value="<?php echo $ville->getId() ?>"><?php echo $ville->getGouvernera() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>  
                                        </tr>
                                        <tr>  
                                            <td><label>Sexe </label></td>
                                            <td>
                                                <div class="mws-form-row" >
                                                    <?php $mags = Doctrine_Core::getTable('sexe')->findAll();
                                                    ?>
                                                    <select id="sexe">
                                                        <option></option>
                                                        <?php foreach ($mags as $magd) { ?>
                                                            <option value="<?php echo $magd->getId() ?>"><?php echo $magd ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><label> Situation familiale <span class="required">*</span></label></td>
                                            <?php $etatciviles = Doctrine_Core::getTable('etatcivil')->findAll();
                                            ?>
                                            <td style="width: 25%">
                                                <div class="mws-form-row">
                                                    <select id="etatcivile" class="mws-select2 large">
                                                        <option value=""></option>
                                                        <?php foreach ($etatciviles as $etatcivile): ?>
                                                            <option value="<?php echo $etatcivile->getId() ?>"><?php echo $etatcivile->getLibelle() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Pays </label></td>
                                            <?php $payss = Doctrine_Core::getTable('pays')->findAll();
                                            ?>
                                            <td style="width: 25%">
                                                <div class="mws-form-row">
                                                    <select id="pays" class="mws-select2 large">
                                                        <option value=""></option>
                                                        <?php foreach ($payss as $pays): ?>
                                                            <option value="<?php echo $pays->getId() ?>"><?php echo $pays->getPays() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><label> Ville </label></td>
                                            <?php $villes = Doctrine_Core::getTable('gouvernera')->findAll();
                                            ?>
                                            <td style="width: 25%">
                                                <div class="mws-form-row">
                                                    <select id="ville" class="mws-select2 large">
                                                        <option value=""></option>
                                                        <?php foreach ($villes as $ville): ?>
                                                            <option value="<?php echo $ville->getId() ?>"><?php echo $ville->getGouvernera() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>  
                                        </tr>
                                        <tr>   
                                            <td><label>Adresse </label></td>
                                            <td colspan="3" >
                                                <div class="mws-form-row">
                                                    <input placeholder="Adresse" value="" id="adresse" type="text" >
                                                </div>
                                            </td> 
                                        </tr>
                                        <tr>  
                                            <td><label>Dossier </label></td>
                                            <?php $dossier = Doctrine_Core::getTable('dossiercomptable')->findAll();
                                            ?>
                                            <td colspan="3">
                                                <div class="mws-form-row">
                                                    <select id="id_dossier">
                                                        <option value=""></option>
                                                        <?php foreach ($dossier as $dos): ?>
                                                            <option value="<?php echo $dos->getId() ?>"><?php echo $dos->getRaisonsociale() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td> 
                                        </tr>

                                        <tr>
                                            <td style="width: 20%;"><label>Login </label></td>
                                            <td style="width: 30%;">
                                                <div class="mws-form-row">
                                                    <input placeholder="Login " value="" id="login" type="text" >
                                                </div>
                                            </td>
                                            <td><label>Mot de passe </label></td>
                                            <td>
                                                <div class="mws-form-row">
                                                    <input placeholder="Mot de Passe " value="" id="pwd" type="password" >
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><label>Etat </label></td>
                                            <td colspan="3"> 
                                                <div class="mws-form-row">

                                                    <select id="etatutilisateur" class="mws-select2 large">
                                                        <option value=""></option>
                                                        <option value="Utilisateru Bloqué">Utilisateru Bloqué</option>
                                                        <option value="Utilisateru Actif">Utilisateru Actif</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </fieldset>  
                    </form>
                </div>
            </div>
            <div class="row"></div>
            <div class="modal-footer">

                <button style="margin-left: 2px" class="btn btn-sm btn-danger pull-right " data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    fermer
                </button>
                <button   class="btn btn-sm btn-primary pull-right" data-dismiss="modal" onclick="ajouterAgent()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>




            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script  type="text/javascript">
    function ajouterAgent() {
        if ($('#matricule').val() != '') {
            $('#matricule').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterAgents') ?>',
                data: 'matricule=' + $('#matricule_popup').val() + '&cin=' + $('#cin_popup').val() + '&nom=' + $('#nom').val()
                        + '&prenom=' + $('#prenom').val() + '&date=' + $('#date').val() + '&lieun=' + $('#lieun').val()
                        + '&sexe=' + $('#sexe').val() + '&etatcivile=' + $('#etatcivile').val() + '&pays=' + $('#pays').val()
                        + '&ville=' + $('#ville').val() + '&id_dossier=' + $('#id_dossier').val() + '&adresse=' + $('#adresse').val() +
                        '&login=' + $('#login').val() + '&pwd=' + $('#pwd').val() + '&etatutilisateur=' + $('#etatutilisateur').val(),
                success: function (data) {
                    if (data !='') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cet Agent enrgistré avec sucées !!!</span>",
                            buttons:
                                    {
                                        "button":
                                                {
                                                    "label": "Ok",
                                                    "className": "btn-sm"
                                                }
                                    }
                        });
                    $('#matricule').val('');
                    $('#cin').val('');
                    $('#nom').val('');
                    $('#prenom').val('');
                    $('#date').val('');
                    $('#leiun').val('');
                    $('#leiun').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#pays').val('');
                    $('#pays').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#etatcivile').val('');
                    $('#etatcivile').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#id_dossier').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                    $('#adresse').val('');
                    $('#agents_id').val('');
                    $('#agents_id').html(data);
                    document.location.reload(true);

//                    $('#dossierexerciceutilisateur_id_utilisateur').html(data);
//                    $('.chosen-container').attr("style", "width: 100%;");
//                    $('#dossierexerciceutilisateur_id_utilisateur').val('').trigger("liszt:updated");
//                    $('#dossierexerciceutilisateur_id_utilisateur').trigger("chosen:updated");
//                    }
                }
                }});
        }
        else {
            $('#matricule').css('border-color', '#f2a696');
        }
    }

    function ajouterUtilsateur() {
        if ($('#matricule').val() != '') {
            $('#matricule').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterAgents') ?>',
                data: 'matricule=' + $('#matricule').val() + '&cin=' + $('#cin').val() + '&nom=' + $('#nom').val()
                        + '&prenom=' + $('#prenom').val() + '&date=' + $('#date').val() + '&lieun=' + $('#lieun').val()
                        + '&sexe=' + $('#sexe').val() + '&etatcivile=' + $('#etatcivile').val() + '&pays=' + $('#pays').val()
                        + '&ville=' + $('#ville').val() + '&adresse=' + $('#adresse').val(),
                success: function (data) {
                    if (data == 'existe') {
                        bootbox.dialog({
                            message: "<span class='bigger-110' style='margin:20px;'>Cet Agent existe déjà !</span>",
                            buttons:
                                    {
                                        "button":
                                                {
                                                    "label": "Ok",
                                                    "className": "btn-sm"
                                                }
                                    }
                        });
                        return false;
                    } else {
                        $('#matricule').val('');
                        $('#cin').val('');
                        $('#nom').val('');
                        $('#prenom').val('');
                        $('#date').val('');
                        $('#leiun').val('');
                        $('#leiun').trigger("chosen:updated");
                        $('.chosen-container').trigger("chosen:updated");
                        $('#pays').val('');
                        $('#pays').trigger("chosen:updated");
                        $('.chosen-container').trigger("chosen:updated");
                        $('#ville').val('');
                        $('#ville').trigger("chosen:updated");
                        $('.chosen-container').trigger("chosen:updated");
                        $('#etatcivile').val('');
                        $('#etatcivile').trigger("chosen:updated");
                        $('.chosen-container').trigger("chosen:updated");
                        $('#adresse').val('');

                        $('#dossierexerciceutilisateur_id_utilisateur').val('');
                        $('#dossierexerciceutilisateur_id_utilisateur').html(data);

//                        $('#list_forme > tbody').html(data);
                    }
                }
            });
        }
        else {
            $('#matricule').css('border-color', '#f2a696');
        }
    }
</script>
<style>
    .table{margin-bottom: 5px;}
</style>