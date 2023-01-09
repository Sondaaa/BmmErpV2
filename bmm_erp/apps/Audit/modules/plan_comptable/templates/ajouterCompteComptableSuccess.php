<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Ajouter Compte Comptable
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Ajouter compte comptable</h4>
            </div>

            <div class="widget-body" ng-controller="myCtrlCompteComptable">
                <div class="widget-main">
                    <table style="width: 100%;">
                        <tr id="ligne_dossier_classe">
                        <input type="hidden" id="id_class">
                        <td>
                            <fieldset>
                                <label style="width: 100%;">Dossier comptable : </label>
                            </fieldset>
                        </td>
                        <td >
                            <fieldset>
                                <label style="width: 100%;"> Numéro comptable * :</label>
                            </fieldset>
                        </td>
                        <td >
                            <fieldset>
                                <label style="width: 100%;">Intitulé * :</label>
                            </fieldset>
                        </td>
                        </tr>
                        <tr id="ligne_dossier_classe_champs">
                            <td>
                                <input value="<?php echo trim($dossier->getCode()) . ' - ' . trim($dossier->getRaisonsociale()); ?>" type="text" disabled="true">
                            </td>
                            <td >
                                <input type="hidden" id="id_compte_select">
                                <input class="form-control" ng-model="compte_select_for_plan.text" 
                                       id="compte_select" placeholder="numéro compte comptable" 
                                       value="" type="text"  onfocus="this.select();"
                                       ng-change="Choisircomptecomptable('#compte_select', '#id_compte_select')"
                                       maxlength="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>"/>
                            </td>
                            <td >
                                <div class="mws-form-item" style="margin-left: 0%">
                                    <input class="large" placeholder="Intitulé du compte comptable" id="libelle" type="text" obligatoire=true>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td >
                                <fieldset>
                                    <label style="width: 100%;">Type * :</label>
                                </fieldset>
                            </td>
                            <td >
                                <fieldset>
                                    <label style="width: 100%;">Compte Collectif * :</label>
                                </fieldset>
                            </td>
                            <td style="width: 20%;">
                                <fieldset>
                                    <label style="width: 100%;">Lettrage :</label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; display: none">
                                <div class="mws-form-row">
                                    <input class="large" id="numero_compte" placeholder="numéro compte comptable"
                                           type="text" obligatoire=true 
                                           maxlength="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>" ><!--onfocus="setLibelle()"-->
                                    <input id="chiffre_numero_compte" value="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>" type="hidden">
                                </div>
                            </td>
                            <td style="display: none">
                                <input type="hidden" id="id_compte_select">
                                <input ng-model="compte_select_for_plan.text" id="compte_select" placeholder="numéro compte comptable" value="" type="text" style="width: 100%;" onfocus="this.select();" ng-change="Choisircomptecomptable('#compte_select', '#id_compte_select')"/>
                            </td>

                            <td >
                                <div class="mws-form-row">
                                    <select id="standard" >
                                        <option value=""></option>
                                        <option value="0">Général</option>
                                        <option value="1">Collectif</option>

                                    </select>
                                </div>
                            </td>
                            <td  id="compte_standard" class="disabledbutton">
                                <?php $compte = PlancomptableTable::getInstance()->findbyStandar(); ?>
                                <div class="mws-form-row">
                                    <select id="comptestandar">
                                        <option value=""></option>
                                        <?php foreach ($compte as $cc): ?>
                                            <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getNumerocompte() . ' - ' . $cc->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </td>
                            <td>
                                <select id="lettrage">
                                    <option value=""></option>
                                    <option value="2">Sans specification </option>
                                    <option value="0" >Non Lettrable</option>
                                    <option value="1">Lettrable</option>
                                </select>
                            </td>
                        </tr>
                        <tr>



                            <td style="width: 20%;">
                                <fieldset>
                                    <label style="width: 100%;">En sommeil :</label>
                                </fieldset>
                            </td>
                            <td style="width: 20%;">
                                <fieldset>
                                    <label style="width: 100%;">Sens par défaut :</label>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <label style="width: 100%">Devise :</label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>



                            <td>
                                <select id="ensommeil">
                                    <option value="" ></option>
                                    <option value="1" >Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </td>
                            <td>
                                <select id="senspardefaut">
                                    <option value=""></option>
                                    <option value="2" >Sans specification </option>
                                    <option value="0" >Crédit</option>
                                    <option value="1">Débit</option>
                                </select>
                            </td>

                            <td>
                                <select id="devise">
                                    <option value=""></option>
                                    <?php foreach ($devises as $devise): ?>
                                        <option value="<?php echo $devise->getId(); ?>"><?php echo $devise->getLibelle(); ?> (<?php echo $devise->getSigle(); ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                        <tr style="display: none;">
                            <td>
                                <fieldset>
                                    <label style="width: 100%">Nature du Solde :</label>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <label style="width: 100%">Devise :</label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr style="display: none;">
                            <td>
                                <select id="nature">
                                    <option value="0">Débiteur</option>
                                    <option value="1">Créditeur</option>
                                    <option value="2">Soldé</option>
                                    <option value="3" selected="true">Libre</option>
                                </select>
                            </td>
                            <td>
                                <select id="devise">
                                    <option value=""></option>
                                    <?php foreach ($devises as $devise): ?>
                                        <option value="<?php echo $devise->getId(); ?>"><?php echo $devise->getLibelle(); ?> (<?php echo $devise->getSigle(); ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-sm btn-success pull-right" onclick="ajouter()">
                                <i class="ace-icon fa fa-save bigger-110"></i> 
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setLibelle() {
        var num = '';
        var chiffre = $('#chiffre_numero_compte').val();
        if (chiffre != '') {
            if ($('#id_compte_select').val() != '') {
                numero_select = $('#compte_select').val();
                var index = numero_select.indexOf(" ");
                var num = numero_select.substring(0, index);
                var s = parseInt(chiffre) - parseInt(num.length);
                for (var i = 0; i < s; i++)
                    num += 0;
            }
        }
        $('#numero_compte').val(num);
    }
    function ajouter() {
        $.ajax({
            url: '<?php echo url_for('@saveCompteComptable') ?>',
            data: 'numerocompte=' + $('#compte_select').val() +
                    '&libelle=' + $('#libelle').val() +
                    '&id_compte_select=' + $('#id_compte_select').val() +
                    '&nature=' + $('#nature').val() +
                    '&ensommeil=' + $('#ensommeil').val() +
                    '&senspardefaut=' + $('#senspardefaut').val() +
                    '&comptestandar=' + $('#comptestandar').val() +
                    '&lettrage=' + $('#lettrage').val() +
                    '&standard=' + $('#standard').val() +
                    '&devise=' + $('#devise').val() +
                    '&dossier=' + "<?php echo $dossier->getId(); ?>",
            success: function (data) {
                if (data == 'existe') {
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Ce numéro de compte comptable existe déjà !</span>",
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
                    bootbox.dialog({
                        message: "<span class='bigger-110' style='margin:20px;'>Ajout avec succées !!!!!</span>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                    resetCompte();
                }

            }
        });

    }

    function champsObligatoires() {
        var valide = true;
//        $('input[type="text"][obligatoire=true]').each(function () {
//            if ($(this).val() !== '')
//                $(this).css('border', '');
//            else {
//                $(this).css('border-color', '#f2a696');
//                valide = false;
//            }
//        });
//
//        if ($("#id_compte_select").val() != '') {
//            $("#compte_select").css('border', '');
//        } else {
//            $("#compte_select").css('border-color', '#f2a696');
//            valide = false;
//        }
//
//        if (valide == false) {
//            bootbox.dialog({
//                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Veuillez remplir les champs obligatoires ( * ) !</span>",
//                buttons:
//                        {
//                            "button":
//                                    {
//                                        "label": "Ok",
//                                        "className": "btn-sm"
//                                    }
//                        }
//            });
//        }
//
//        return valide;
    }

    function resetCompte() {
        $("#numero_compte").val('');
         
        $("#ensommeil").val('');
        $('#ensommeil').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
        $('#libelle').val('');
        $('#id_compte_select').val('');
        $('#compte_select').val('');

        $("#comptestandar").val("");
        $('#comptestandar').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");
        $("#standard").val("");
        $('#standard').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");
        $("#devise").val("");
        $('#devise').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");
        $("#lettrage").val("");
        $('#lettrage').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");

        $("#senspardefaut").val("");
        $('#senspardefaut').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");
    }

</script>

<script  type="text/javascript">
    document.title = ('BMM - G. Compta. : Ajouter compte comptable');
</script>