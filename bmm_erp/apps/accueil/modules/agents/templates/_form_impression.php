<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Fiche Personnel : Impression Personnalisée</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12">
                    <legend>Données de Base<input id="base_check" name="base_check" type="checkbox" style="float: right;" onchange="checkAllBase()"></legend>
                    <table style="width: 100%">
                        <tr> 
                            <td>Matricule</td>
                            <td><input id="idrh_check" name="idrh" type="checkbox" style="width: 25px"></td>
                            <td>CIN</td>
                            <td><input id="cin" name="cin" type="checkbox" style="width: 25px"></td>
                            <td>Nom</td>
                            <td><input id="nom" name="nom" type="checkbox" style="width: 25px"></td>
                            <td>Prénom</td>
                            <td><input id="prenom" name="prenom" type="checkbox" style="width: 25px"></td>
                        </tr> 
                        <tr> 
                            <td>Date Naissance</td>
                            <td><input id="daten" name="daten" type="checkbox" style="width: 25px"></td>
                            <td>Lieu Naissance</td>
                            <td><input id="lieun" name="lieun" type="checkbox" style="width: 25px"></td>
                            <td>Sexe</td>
                            <td><input id="sexe" name="sexe" type="checkbox" style="width: 25px"></td>
                            <td>Adresse</td>
                            <td><input id="adresse" name="adresse" type="checkbox" style="width: 25px"></td>
                        </tr> 
                        <tr> 
                            <td>Regroupement </td>
                            <td><input id="reg" name="reg" type="checkbox" style="width: 25px"></td>
                            <td>Ville </td>
                            <td><input id="ville" name="ville" type="checkbox" style="width: 25px"></td>
                            <td>Situation Familiale</td>
                            <td><input id="situation" name="situation" type="checkbox" style="width: 25px"></td>
                            <td>Age </td>
                            <td><input id="age" name="age" type="checkbox" style="width: 25px"></td>
                        </tr>
                    </table>
                    <br>
                    <legend>Informations Supplémentaires<input id="info_check" name="info_check" type="checkbox" style="float: right;" onchange="checkAllInfo()"></legend>
                    <table style="width: 100%"> 
                        <tr> 
                            <td>Etat mulitaire </td>
                            <td><input id="etat" name="etat" type="checkbox" style="width: 25px"></td>
                            <td>Code Postal </td>
                            <td><input id="codep" name="codep" type="checkbox" style="width: 25px"></td>
                            <td> Pays </td>
                            <td><input id="paye" name="paye" type="checkbox" style="width: 25px"></td>
                            <td>GSM</td>
                            <td><input id="gsm" name="gsm" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr> 
                            <td>Identifiant unique (CNRPS)  </td>
                            <td><input id="idcnss"  name="idcnss" type="checkbox" style="width: 25px"></td>
                            <td>Date d'affiliation   </td>
                            <td><input id="dateaff" name="dateaff" type="checkbox" style="width: 25px"></td>
                            <td> RIP/B </td>
                            <td><input id="rib" name="rib"  type="checkbox" style="width: 25px"></td>
                            <td>Niveau Scolaire</td>
                            <td><input id="niveauscolaire" name="niveauscolaire" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr> 
                            <td>Chef Famille</td>
                            <td><input id="chef" name="chef" type="checkbox" style="width: 25px"></td>
                            <td>Nombres d'enfants</td>
                            <td><input id="nbrenfant" name="nbrenfant" type="checkbox" style="width: 25px"></td>
                            <td>Identifiant carte professionnelle</td>
                            <td><input id="idcarte" name="idcarte" type="checkbox" style="width: 25px"></td>
                        </tr>
                    </table>
                    <br>
                </fieldset>
                <div class="row"></div>
                <input type="hidden" id="id_imprime">
                <div class="modal-footer">
                    <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left" onclick="InitilaiserChoixFiche()">
                        Initialiser</button>
                    <button type="button" value="Imprimer" id="bntimp" class="btn btn-sm pull-left" onclick="printfiche()">
                        Imprimer</button>
                    <button id="btnfermer" class="btn btn-sm pull-right" data-dismiss="modal" onclick="annuler()">
                        Fermer</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script  type="text/javascript">
    function annuler() {
        $('#my-modalimpression ').removeClass('in');
        $('#my-modalimpression ').css('display', 'none');
        InitilaiserChoixFiche();
    }

    function InitilaiserChoixFiche() {
        $("#base_check").prop("checked", false);
        $("#info_check").prop("checked", false);
        checkAllBase();
        checkAllInfo();
    }

    function checkAllBase() {
        if ($('input[name=base_check]').is(':checked')) {
            $("#idrh_check").prop("checked", true);
            $("#nom").prop("checked", true);
            $("#prenom").prop("checked", true);
            $("#cin").prop("checked", true);
            $("#daten").prop("checked", true);
            $("#lieun").prop("checked", true);
            $("#sexe").prop("checked", true);
            $("#adresse").prop("checked", true);
            $("#reg").prop("checked", true);
            $("#ville").prop("checked", true);
            $("#situation").prop("checked", true);
            $("#age").prop("checked", true);
        } else {
            $("#idrh_check").prop("checked", false);
            $("#nom").prop("checked", false);
            $("#prenom").prop("checked", false);
            $("#cin").prop("checked", false);
            $("#daten").prop("checked", false);
            $("#lieun").prop("checked", false);
            $("#sexe").prop("checked", false);
            $("#adresse").prop("checked", false);
            $("#reg").prop("checked", false);
            $("#ville").prop("checked", false);
            $("#situation").prop("checked", false);
            $("#age").prop("checked", false);
        }
    }

    function checkAllInfo() {
        if ($('input[name=info_check]').is(':checked')) {
            $("#idcarte").prop("checked", true);
            $("#etat").prop("checked", true);
            $("#codep").prop("checked", true);
            $("#paye").prop("checked", true);
            $("#gsm").prop("checked", true);
            $("#idcnss").prop("checked", true);
            $("#dateaff").prop("checked", true);
            $("#nbrenfant").prop("checked", true);
            $("#chef").prop("checked", true);
            $("#niveauscolaire").prop("checked", true);
            $("#rib").prop("checked", true);
        } else {
            $("#idcarte").prop("checked", false);
            $("#etat").prop("checked", false);
            $("#codep").prop("checked", false);
            $("#paye").prop("checked", false);
            $("#gsm").prop("checked", false);
            $("#idcnss").prop("checked", false);
            $("#dateaff").prop("checked", false);
            $("#nbrenfant").prop("checked", false);
            $("#chef").prop("checked", false);
            $("#niveauscolaire").prop("checked", false);
            $("#rib").prop("checked", false);
        }
    }

    function printfiche() {
        var valide = false;
        var url = '';
        if ($('input[name=idrh]').is(':checked')) {
            if (url == '')
                url = '?idrh=' + $('#idrh').val();
            valide = true;
        }

        if ($('input[name=nom]').is(':checked')) {
            if (url == '')
                url = '?nom=' + $('#nom').val();
            else
                url = url + '&nom=' + $('#nom').val();
            valide = true;
        }

        if ($('input[name=prenom]').is(':checked')) {
            if (url == '')
                url = '?prenom=' + $('#prenom').val();
            else
                url = url + '&prenom=' + $('#prenom').val();
            valide = true;
        }

        if ($('input[name=cin]').is(':checked')) {
            if (url == '')
                url = '?cin=' + $('#cin').val();
            else
                url = url + '&cin=' + $('#cin').val();
            valide = true;
        }

        if ($('input[name=daten]').is(':checked')) {
            if (url == '')
                url = '?daten=' + $('#daten').val();
            else
                url = url + '&daten=' + $('#daten').val();
            valide = true;
        }

        if ($('input[name=lieun]').is(':checked')) {
            if (url == '')
                url = '?lieun=' + $('#lieun').val();
            else
                url = url + '&lieun=' + $('#lieun').val();
            valide = true;
        }

        if ($('input[name=sexe]').is(':checked')) {
            if (url == '')
                url = '?sexe=' + $('#sexe').val();
            else
                url = url + '&sexe=' + $('#sexe').val();
            valide = true;
        }

        if ($('input[name=adresse]').is(':checked')) {
            if (url == '')
                url = '?adresse=' + $('#adresse').val();
            else
                url = url + '&adresse=' + $('#adresse').val();
            valide = true;
        }

        if ($('input[name=reg]').is(':checked')) {
            if (url == '')
                url = '?reg=' + $('#reg').val();
            else
                url = url + '&reg=' + $('#reg').val();
            valide = true;
        }

        if ($('input[name=ville]').is(':checked')) {
            if (url == '')
                url = '?ville=' + $('#ville').val();
            else
                url = url + '&ville=' + $('#ville').val();
            valide = true;
        }

        if ($('input[name=situation]').is(':checked')) {
            if (url == '')
                url = '?situation=' + $('#situation').val();
            else
                url = url + '&situation=' + $('#situation').val();
            valide = true;
        }

        if ($('input[name=idcarte]').is(':checked')) {
            if (url == '')
                url = '?idcarte=' + $('#idcarte').val();
            else
                url = url + '&idcarte=' + $('#idcarte').val();
            valide = true;
        }

        if ($('input[name=etat]').is(':checked')) {
            if (url == '')
                url = '?etat=' + $('#etat').val();
            else
                url = url + '&etat=' + $('#etat').val();
            valide = true;
        }

        if ($('input[name=codep]').is(':checked')) {
            if (url == '')
                url = '?codep=' + $('#codep').val();
            else
                url = url + '&codep=' + $('#codep').val();
            valide = true;
        }

        if ($('input[name=paye]').is(':checked')) {
            if (url == '')
                url = '?paye=' + $('#paye').val();
            else
                url = url + '&paye=' + $('#paye').val();
            valide = true;
        }

        if ($('input[name=gsm]').is(':checked')) {
            if (url == '')
                url = '?gsm=' + $('#gsm').val();
            else
                url = url + '&gsm=' + $('#gsm').val();
            valide = true;
        }

        if ($('input[name=idcnss]').is(':checked')) {
            if (url == '')
                url = '?idcnss=' + $('#idcnss').val();
            else
                url = url + '&idcnss=' + $('#idcnss').val();
            valide = true;
        }

        if ($('input[name=dateaff]').is(':checked')) {
            if (url == '')
                url = '?dateaff=' + $('#dateaff').val();
            else
                url = url + '&dateaff=' + $('#dateaff').val();
            valide = true;
        }

        if ($('input[name=rib]').is(':checked')) {
            if (url == '')
                url = '?rib=' + $('#rib').val();
            else
                url = url + '&rib=' + $('#rib').val();
            valide = true;
        }
        if ($('input[name=niveauscolaire]').is(':checked')) {
            if (url == '')
                url = '?niveauscolaire=' + $('#niveauscolaire').val();
            else
                url = url + '&niveauscolaire=' + $('#niveauscolaire').val();
            valide = true;
        }

        if ($('input[name=chef]').is(':checked')) {
            if (url == '')
                url = '?chef=' + $('#chef').val();
            else
                url = url + '&chef=' + $('#chef').val();
            valide = true;
        }

        if ($('input[name=nbrenfant]').is(':checked')) {
            if (url == '')
                url = '?nbrenfant=' + $('#nbrenfant').val();
            else
                url = url + '&nbrenfant=' + $('#nbrenfant').val();
            valide = true;
        }

        if ($('input[name=age]').is(':checked')) {
            if (url == '')
                url = '?age=' + $('#age').val();
            else
                url = url + '&age=' + $('#age').val();
            valide = true;
        }

        if (valide) {
            url = url + '&id=' + $('#id_imprime').val();
            url = '<?php echo url_for('agents/imprimerFichePersonnelleAvecChoix') ?>' + url;
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