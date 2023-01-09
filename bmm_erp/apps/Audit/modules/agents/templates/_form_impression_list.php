<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Liste des personnels : Impression Personnalisée</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12">
                    <legend>Données de Base<input id="base_check_all" name="base_check_all" type="checkbox" style="float: right;" onchange="checkAllBaseListe()"></legend>
                    <table style="width: 100%">
                        <tr> 
                            <td>Matricule</td>
                            <td><input id="idrh_check_all" name="idrh_all" type="checkbox" style="width: 25px"></td>
                            <td>CIN</td>
                            <td><input id="cin_all" name="cin_all" type="checkbox" style="width: 25px"></td>
                            <td>Nom</td>
                            <td><input id="nom_all" name="nom_all" type="checkbox" style="width: 25px"></td>
                            <td>Prénom</td>
                            <td><input id="prenom_all" name="prenom_all" type="checkbox" style="width: 25px"></td>
                        </tr> 
                        <tr> 
                            <td>Date Naissance</td>
                            <td><input id="daten_all" name="daten_all" type="checkbox" style="width: 25px"></td>
                            <td>Lieu Naissance</td>
                            <td><input id="lieun_all" name="lieun_all" type="checkbox" style="width: 25px"></td>
                            <td>Sexe</td>
                            <td><input id="sexe_all" name="sexe_all" type="checkbox" style="width: 25px"></td>
                            <td>Adresse</td>
                            <td><input id="adresse_all" name="adresse_all" type="checkbox" style="width: 25px"></td>
                        </tr> 
                        <tr> 
                            <td>Regroupement </td>
                            <td><input id="reg_all" name="reg_all" type="checkbox" style="width: 25px"></td>
                            <td>Ville </td>
                            <td><input id="ville_all" name="ville_all" type="checkbox" style="width: 25px"></td>
                            <td>Situation Familiale</td>
                            <td><input id="situation_all" name="situation_all" type="checkbox" style="width: 25px"></td>
                            <td>Age </td>
                            <td><input id="age_all" name="age_all" type="checkbox" style="width: 25px"></td>
                        </tr>
                    </table>
                    <br>
                    <legend>Informations Supplémentaires<input id="info_check_all" name="info_check_all" type="checkbox" style="float: right;" onchange="checkAllInfoListe()"></legend>
                    <table style="width: 100%"> 
                        <tr> 
                            <td>Etat mulitaire </td>
                            <td><input id="etat_all" name="etat_all" type="checkbox" style="width: 25px"></td>
                            <td>Code Postal </td>
                            <td><input id="codep_all" name="codep_all" type="checkbox" style="width: 25px"></td>
                            <td> Pays </td>
                            <td><input id="paye_all" name="paye_all" type="checkbox" style="width: 25px"></td>
                            <td>GSM</td>
                            <td><input id="gsm_all" name="gsm_all" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr> 
                            <td>Identifiant unique (CNRPS)  </td>
                            <td><input id="idcnss_all" name="idcnss_all" type="checkbox" style="width: 25px"></td>
                            <td>Date d'affiliation   </td>
                            <td><input id="dateaff_all" name="dateaff_all" type="checkbox" style="width: 25px"></td>
                            <td> RIP/B </td>
                            <td><input id="rib_all" name="rib_all" type="checkbox" style="width: 25px"></td>
                            <td>Niveau Scolaire</td>
                            <td><input id="niveauscolaire_all" name="niveauscolaire_all" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr> 
                            <td>Chef Famille</td>
                            <td><input id="chef_all" name="chef_all" type="checkbox" style="width: 25px"></td>
                            <td>Nombres d'enfants</td>
                            <td><input id="nbrenfant_all" name="nbrenfant_all" type="checkbox" style="width: 25px"></td>
                            <td>Identifiant carte professionnelle</td>
                            <td><input id="idcarte_all" name="idcarte_all" type="checkbox" style="width: 25px"></td>
                        </tr>
                    </table>
                    <br>
                </fieldset>
                <div class="row"></div>
                <div class="modal-footer">
                    <button type="button" value="Initialiser" class="btn btn-primary pull-left" onclick="InitilaiserListe()">
                        Initialiser</button>
                    <button type="button" value="Imprimer" id="bntimp" class="btn pull-left" onclick="printListePersonnel()">
                        Imprimer</button>
                    <button id="btnfermer" class="btn pull-right" data-dismiss="modal" onclick="annulerListe()">
                        Fermer</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script  type="text/javascript">

    function annulerListe() {
        $('#my-modalimpression-all').removeClass('in');
        $('#my-modalimpression-all').css('display', 'none');
        InitilaiserListe();
    }

    function InitilaiserListe() {
        $("#base_check_all").prop("checked", false);
        $("#info_check_all").prop("checked", false);
        checkAllBaseListe();
        checkAllInfoListe();
    }

    function checkAllBaseListe() {
        if ($('input[name=base_check_all]').is(':checked')) {
            $("#idrh_check_all").prop("checked", true);
            $("#nom_all").prop("checked", true);
            $("#prenom_all").prop("checked", true);
            $("#cin_all").prop("checked", true);
            $("#daten_all").prop("checked", true);
            $("#lieun_all").prop("checked", true);
            $("#sexe_all").prop("checked", true);
            $("#adresse_all").prop("checked", true);
            $("#reg_all").prop("checked", true);
            $("#ville_all").prop("checked", true);
            $("#situation_all").prop("checked", true);
            $("#age_all").prop("checked", true);
        } else {
            $("#idrh_check_all").prop("checked", false);
            $("#nom_all").prop("checked", false);
            $("#prenom_all").prop("checked", false);
            $("#cin_all").prop("checked", false);
            $("#daten_all").prop("checked", false);
            $("#lieun_all").prop("checked", false);
            $("#sexe_all").prop("checked", false);
            $("#adresse_all").prop("checked", false);
            $("#reg_all").prop("checked", false);
            $("#ville_all").prop("checked", false);
            $("#situation_all").prop("checked", false);
            $("#age_all").prop("checked", false);
        }
    }

    function checkAllInfoListe() {
        if ($('input[name=info_check_all]').is(':checked')) {
            $("#idcarte_all").prop("checked", true);
            $("#etat_all").prop("checked", true);
            $("#codep_all").prop("checked", true);
            $("#paye_all").prop("checked", true);
            $("#gsm_all").prop("checked", true);
            $("#idcnss_all").prop("checked", true);
            $("#dateaff_all").prop("checked", true);
            $("#nbrenfant_all").prop("checked", true);
            $("#chef_all").prop("checked", true);
            $("#niveauscolaire_all").prop("checked", true);
            $("#rib_all").prop("checked", true);
        } else {
            $("#idcarte_all").prop("checked", false);
            $("#etat_all").prop("checked", false);
            $("#codep_all").prop("checked", false);
            $("#paye_all").prop("checked", false);
            $("#gsm_all").prop("checked", false);
            $("#idcnss_all").prop("checked", false);
            $("#dateaff_all").prop("checked", false);
            $("#nbrenfant_all").prop("checked", false);
            $("#chef_all").prop("checked", false);
            $("#niveauscolaire_all").prop("checked", false);
            $("#rib_all").prop("checked", false);
        }
    }

    function printListePersonnel() {
        var valide = false;
        var url = '';
        if ($('input[name=idrh_all]').is(':checked')) {
            if (url == '')
                url = '?idrh=' + $('#idrh_all').val();
            valide = true;
        }

        if ($('input[name=nom_all]').is(':checked')) {
            if (url == '')
                url = '?nom=' + $('#nom_all').val();
            else
                url = url + '&nom=' + $('#nom_all').val();
            valide = true;
        }

        if ($('input[name=prenom_all]').is(':checked')) {
            if (url == '')
                url = '?prenom=' + $('#prenom_all').val();
            else
                url = url + '&prenom=' + $('#prenom_all').val();
            valide = true;
        }

        if ($('input[name=cin_all]').is(':checked')) {
            if (url == '')
                url = '?cin=' + $('#cin_all').val();
            else
                url = url + '&cin=' + $('#cin_all').val();
            valide = true;
        }

        if ($('input[name=daten_all]').is(':checked')) {
            if (url == '')
                url = '?daten=' + $('#daten_all').val();
            else
                url = url + '&daten=' + $('#daten_all').val();
            valide = true;
        }

        if ($('input[name=lieun_all]').is(':checked')) {
            if (url == '')
                url = '?lieun=' + $('#lieun_all').val();
            else
                url = url + '&lieun=' + $('#lieun_all').val();
            valide = true;
        }

        if ($('input[name=sexe_all]').is(':checked')) {
            if (url == '')
                url = '?sexe=' + $('#sexe_all').val();
            else
                url = url + '&sexe=' + $('#sexe_all').val();
            valide = true;
        }

        if ($('input[name=adresse_all]').is(':checked')) {
            if (url == '')
                url = '?adresse=' + $('#adresse_all').val();
            else
                url = url + '&adresse=' + $('#adresse_all').val();
            valide = true;
        }

        if ($('input[name=reg_all]').is(':checked')) {
            if (url == '')
                url = '?reg=' + $('#reg_all').val();
            else
                url = url + '&reg=' + $('#reg_all').val();
            valide = true;
        }

        if ($('input[name=ville_all]').is(':checked')) {
            if (url == '')
                url = '?ville=' + $('#ville_all').val();
            else
                url = url + '&ville=' + $('#ville_all').val();
            valide = true;
        }

        if ($('input[name=situation_all]').is(':checked')) {
            if (url == '')
                url = '?situation=' + $('#situation_all').val();
            else
                url = url + '&situation=' + $('#situation_all').val();
            valide = true;
        }

        if ($('input[name=idcarte_all]').is(':checked')) {
            if (url == '')
                url = '?idcarte=' + $('#idcarte_all').val();
            else
                url = url + '&idcarte=' + $('#idcarte_all').val();
            valide = true;
        }

        if ($('input[name=etat_all]').is(':checked')) {
            if (url == '')
                url = '?etat=' + $('#etat_all').val();
            else
                url = url + '&etat=' + $('#etat_all').val();
            valide = true;
        }

        if ($('input[name=codep_all]').is(':checked')) {
            if (url == '')
                url = '?codep=' + $('#codep_all').val();
            else
                url = url + '&codep=' + $('#codep_all').val();
            valide = true;
        }

        if ($('input[name=paye_all]').is(':checked')) {
            if (url == '')
                url = '?paye=' + $('#paye_all').val();
            else
                url = url + '&paye=' + $('#paye_all').val();
            valide = true;
        }

        if ($('input[name=gsm_all]').is(':checked')) {
            if (url == '')
                url = '?gsm=' + $('#gsm_all').val();
            else
                url = url + '&gsm=' + $('#gsm_all').val();
            valide = true;
        }

        if ($('input[name=idcnss_all]').is(':checked')) {
            if (url == '')
                url = '?idcnss=' + $('#idcnss_all').val();
            else
                url = url + '&idcnss=' + $('#idcnss_all').val();
            valide = true;
        }

        if ($('input[name=dateaff_all]').is(':checked')) {
            if (url == '')
                url = '?dateaff=' + $('#dateaff_all').val();
            else
                url = url + '&dateaff=' + $('#dateaff_all').val();
            valide = true;
        }

        if ($('input[name=rib_all]').is(':checked')) {
            if (url == '')
                url = '?rib=' + $('#rib_all').val();
            else
                url = url + '&rib=' + $('#rib_all').val();
            valide = true;
        }
        if ($('input[name=niveauscolaire_all]').is(':checked')) {
            if (url == '')
                url = '?niveauscolaire=' + $('#niveauscolaire_all').val();
            else
                url = url + '&niveauscolaire=' + $('#niveauscolaire_all').val();
            valide = true;
        }

        if ($('input[name=chef_all]').is(':checked')) {
            if (url == '')
                url = '?chef=' + $('#chef_all').val();
            else
                url = url + '&chef=' + $('#chef_all').val();
            valide = true;
        }

        if ($('input[name=nbrenfant_all]').is(':checked')) {
            if (url == '')
                url = '?nbrenfant=' + $('#nbrenfant_all').val();
            else
                url = url + '&nbrenfant=' + $('#nbrenfant_all').val();
            valide = true;
        }

        if ($('input[name=age_all]').is(':checked')) {
            if (url == '')
                url = '?age=' + $('#age_all').val();
            else
                url = url + '&age=' + $('#age_all').val();
            valide = true;
        }

        if (valide) {
            //Charger les motifs de recherche
            if ($('#agents_filters_idrh').val() != '')
            {
                if (url == '')
                    url = '?idrh_filtre=' + $('#agents_filters_idrh').val();
                else
                    url = url + '&idrh_filtre=' + $('#agents_filters_idrh').val();
            }

            if ($('#agents_filters_nomcomplet').val() != '')
            {
                if (url == '')
                    url = '?nom_filtre=' + $('#agents_filters_nomcomplet').val();
                else
                    url = url + '&nom_filtre=' + $('#agents_filters_nomcomplet').val();
            }

            if ($('#agents_filters_prenom').val() != '') {
                if (url == '')
                    url = '?prenom_filtre=' + $('#agents_filters_prenom').val();
                else
                    url = url + '&prenom_filtre=' + $('#agents_filters_prenom').val();
            }
            if ($('#agents_filters_id_regrouppement').val() != '0') {
                if (url == '')
                    url = '?id_regroupement=' + $('#agents_filters_id_regrouppement').val();
                else
                    url = url + '&id_regroupement=' + $('#agents_filters_id_regrouppement').val();
            }
            url = '<?php echo url_for('agents/imprimerListePersonnelleAvecChoix') ?>' + url;
            window.open(url, '_blank');
            win.focus();
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Il faut choisir au moins un champ !</span>",
                buttons:
                        {
                            "button":
                                    {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                        }
            });
        }
    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>