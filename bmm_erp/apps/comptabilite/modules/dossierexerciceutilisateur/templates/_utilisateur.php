<div id="sf_admin_container" ng-controller="myCtrlPaysVille" ng-init="InialiserChampsSelect()">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="smaller lighter blue no-margin">Ajouter Utilisateur</h3>
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

                                                <label>Personnel <span class="required"></span><br></label></td>

                                            <?php $agents = Doctrine_Core::getTable('agents')->findAll();
                                            ?>
                                            <td style="width: 25%" colspan="5">
                                                <div class="mws-form-row">
                                                    <select id="agents_id" class="mws-select2 large">
                                                        <option value=""></option>
                                                        <?php foreach ($agents as $agent): ?>
                                                            <option value="<?php echo $agent->getId() ?>"><?php echo $agent; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td> 


                                        </tr>
                                        <tr>
                                            <td style="width: 20%;"><label>Login <span class="required"></span></label></td>
                                            <td style="width: 30%;">
                                                <div class="mws-form-row">
                                                    <input placeholder="Login " value="" id="login" type="text" >
                                                </div>
                                            </td>
                                            <td><label>Mot de passe <span class="required"></span></label></td>
                                            <td>
                                                <div class="mws-form-row">
                                                    <input placeholder="Mot de Passe " value="" id="pwd" type="password" >
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><label>Etat <span class="required"></span></label></td>
                                            <td colspan=""> <div class="mws-form-row">
                                                    <select id="etatutilisateur" class="mws-select2 large">
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
            <div class="modal-footer">

                <button style="margin-left: 3px" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    fermer
                </button> 
                <button   class="btn btn-sm btn-primary pull-right" data-dismiss="modal" onclick="ajouterUtilisateur()">
                    <i class="ace-icon fa fa-plus"></i>
                    Ajouter
                </button>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script  type="text/javascript">
    function ajouterUtilisateur() {
        if ($('#agents_id').val() != '') {
            $('#agents_id').css('border', '');
            $.ajax({
                url: '<?php echo url_for('@ajouterUtilisateur') ?>',
                data: 'agents_id=' + $('#agents_id').val() +
                        '&login=' + $('#login').val() +
                        '&pwd=' + $('#pwd').val()
                        + '&etat=' + $('#etatutilisateur').val(),
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
                        $('#login').val('');
                        $('#pwd').val('');
                        $('#agents_id').val('');
                        $('#agents_id').trigger("chosen:updated");
                        $('.chosen-container').trigger("chosen:updated");
                        $('#etatutilisateur').val('');
                        $('#etatutilisateur').trigger("chosen:updated");
                        $('.chosen-container').trigger("chosen:updated");
                        $('#dossierexerciceutilisateur_id_utilisateur').val('');
                        $('#dossierexerciceutilisateur_id_utilisateur').html(data);

//                        $('#list_forme > tbody').html(data);
                        document.location.reload(true);
                    }
                }
            });
        }
        else {
            $('#login').css('border-color', '#f2a696');
        }
    }


</script>