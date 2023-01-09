<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">Liste Immobilisations : Impression Personnalisée</h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12">
                    <legend>Données de Base<input id="base_check" name="base_check" type="checkbox" style="float: right;" onchange="checkAllBase()"></legend>
                    <table style="width: 100%">
                        <tr>
                            <td>Numéro</td>
                            <td><input id="numero" name="numero" type="checkbox" style="width: 25px"></td>
                            <td>Date Création</td>
                            <td><input id="date_creation" name="date_creation" type="checkbox" style="width: 25px"></td>
                            <td>Date De Mise En Service</td>
                            <td><input id="date_enservice" name="date_enservice" type="checkbox" style="width: 25px"></td>
                            <td>Date De Mise En Rebut</td>
                            <td><input id="date_enrebut" name="date_enrebut" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr>
                            <td>Ancien Numéro Inventaire</td>
                            <td><input id="anicen_num" name="anicen_num" type="checkbox" style="width: 25px"></td>
                            <td>Emetteur</td>
                            <td><input id="emeteur" name="emeteur" type="checkbox" style="width: 25px"></td>

                        </tr>

                    </table>
                    <br>
                    <legend>DONNEES DE CLASSIFICATION<input id="info_check" name="info_check" type="checkbox" style="float: right;" onchange="checkAllClasification()"></legend>
                    <table style="width: 100%">
                        <tr>
                            <td>Catégorie </td>
                            <td><input id="categorie" name="categorie" type="checkbox" style="width: 25px"></td>
                            <td>Famille </td>
                            <td><input id="famille" name="famille" type="checkbox" style="width: 25px"></td>
                            <td>Sous Famille </td>
                            <td><input id="sous_famille" name="sous_famille" type="checkbox" style="width: 25px"></td>
                            <td>Code Immob</td>
                            <td><input id="code" name="code" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr>
                            <td>Désignation</td>
                            <td><input id="designation" name="designation" type="checkbox" style="width: 25px"></td>
                            <td>Déscription </td>
                            <td><input id="desciption" name="desciption" type="checkbox" style="width: 25px"></td>
                        </tr>

                    </table>
                    <br>
                    <legend>DONNEES D'AFFECTATION<input id="affectation_check" name="affectation_check" type="checkbox" style="float: right;" onchange="checkAllInfo()"></legend>
                    <table style="width: 100%">
                        <tr>
                            <td>Type Affectation </td>
                            <td><input id="type_affectation" name="type_affectation" type="checkbox" style="width: 25px"></td>
                            <td>Site </td>
                            <td><input id="site" name="site" type="checkbox" style="width: 25px"></td>
                            <td>Sous Site </td>
                            <td><input id="sous_site" name="sous_site" type="checkbox" style="width: 25px"></td>
                            <td>Local</td>
                            <td><input id="local" name="local" type="checkbox" style="width: 25px"></td>
                        </tr>
                        <tr>
                            <td>Date Acquisition</td>
                            <td><input id="date_acquisition" name="date_acquisition" type="checkbox" style="width: 25px"></td>
                            <td>MT HTVA </td>
                            <td><input id="mnttva" name="mnttva" type="checkbox" style="width: 25px"></td>
                            <td>TVA (en %) </td>
                            <td><input id="tva" name="tva" type="checkbox" style="width: 25px"></td>
                            <td>MT TTC </td>
                            <td><input id="mnttc" name="mnttc" type="checkbox" style="width: 25px"></td>
                        </tr>
                    </table>
                    </br>
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

<script type="text/javascript">
    function annuler() {
        $('#my-modalimpression ').removeClass('in');
        $('#my-modalimpression ').css('display', 'none');
        InitilaiserChoixFiche();
    }

    function InitilaiserChoixFiche() {
        $("#base_check").prop("checked", false);
        $("#info_check").prop("checked", false);
        $("#affectation_check").prop("checked", false);
        checkAllBase();
        checkAllInfo();
        checkAllClasification();
    }

    function checkAllBase() {
        if ($('input[name=base_check]').is(':checked')) {

            $("#numero").prop("checked", true);
            $("#date_creation").prop("checked", true);
            $("#date_enservice").prop("checked", true);
            $("#date_enrebut").prop("checked", true);
            $("#anicen_num").prop("checked", true);
            $("#emeteur").prop("checked", true);
        } else { 
            $("#numero").prop("checked", false);
            $("#date_creation").prop("checked", false);
            $("#date_enservice").prop("checked", false);
            $("#date_enrebut").prop("checked", false);
            $("#anicen_num").prop("checked", false);
            $("#emeteur").prop("checked", false);

        }
    }
    
    function checkAllClasification() {
        if ($('input[name=info_check]').is(':checked')) {
            $("#categorie").prop("checked", true);
            $("#famille").prop("checked", true);
            $("#sous_famille").prop("checked", true);
            $("#code").prop("checked", true);
            $("#designation").prop("checked", true);
            $("#desciption").prop("checked", true);
        } else {
            $("#categorie").prop("checked", false);
            $("#famille").prop("checked", false);
            $("#sous_famille").prop("checked", false);
            $("#code").prop("checked", false);
            $("#designation").prop("checked", false);
            $("#desciption").prop("checked", false);
        }
    }

    function checkAllInfo() {
        if ($('input[name=affectation_check]').is(':checked')) {
           
            $("#type_affectation").prop("checked", true);
            $("#site").prop("checked", true);
            $("#sous_site").prop("checked", true);
            $("#local").prop("checked", true);
            $("#date_acquisition").prop("checked", true);
            $("#mnttva").prop("checked", true);
            $("#tva").prop("checked", true);
            $("#mnttc").prop("checked", true);

        } else {
            $("#type_affectation").prop("checked", false);
            $("#site").prop("checked", false);
            $("#sous_site").prop("checked", false);
            $("#local").prop("checked", false);
            $("#date_acquisition").prop("checked", false);
            $("#mnttva").prop("checked", false);
            $("#tva").prop("checked", false);
            $("#mnttc").prop("checked", false);

        }
    }

    function printfiche() {
             
        var valide = false;
        var url = '';
        if ($('input[name=numero]').is(':checked')) {
            if (url == '')
                url = '?numero=' + $('#numero').val();
            valide = true;
        }

        if ($('input[name=date_creation]').is(':checked')) {
            if (url == '')
                url = '?date_creation=' + $('#date_creation').val();
            else
                url = url + '&date_creation=' + $('#date_creation').val();
            valide = true;
        }

        if ($('input[name=date_enservice]').is(':checked')) {
            if (url == '')
                url = '?date_enservice=' + $('#date_enservice').val();
            else
                url = url + '&date_enservice=' + $('#date_enservice').val();
            valide = true;
        }

        if ($('input[name=date_enrebut]').is(':checked')) {
            if (url == '')
                url = '?date_enrebut=' + $('#date_enrebut').val();
            else
                url = url + '&date_enrebut=' + $('#date_enrebut').val();
            valide = true;
        }

        if ($('input[name=anicen_num]').is(':checked')) {
            if (url == '')
                url = '?anicen_num=' + $('#anicen_num').val();
            else
                url = url + '&anicen_num=' + $('#anicen_num').val();
            valide = true;
        }

        if ($('input[name=emeteur]').is(':checked')) {
            if (url == '')
                url = '?emeteur=' + $('#emeteur').val();
            else
                url = url + '&emeteur=' + $('#emeteur').val();
            valide = true;
        }
             
        if ($('input[name=categorie]').is(':checked')) {
            if (url == '')
                url = '?categorie=' + $('#categorie').val();
            else
                url = url + '&categorie=' + $('#categorie').val();
            valide = true;
        }

        if ($('input[name=famille]').is(':checked')) {
            if (url == '')
                url = '?famille=' + $('#famille').val();
            else
                url = url + '&famille=' + $('#famille').val();
            valide = true;
        }

        if ($('input[name=sous_famille]').is(':checked')) {
            if (url == '')
                url = '?sous_famille=' + $('#sous_famille').val();
            else
                url = url + '&sous_famille=' + $('#sous_famille').val();
            valide = true;
        }

        if ($('input[name=code]').is(':checked')) {
            if (url == '')
                url = '?code=' + $('#code').val();
            else
                url = url + '&code=' + $('#code').val();
            valide = true;
        }

        if ($('input[name=designation]').is(':checked')) {
            if (url == '')
                url = '?designation=' + $('#designation').val();
            else
                url = url + '&designation=' + $('#designation').val();
            valide = true;
        }

        if ($('input[name=desciption]').is(':checked')) {
            if (url == '')
                url = '?desciption=' + $('#desciption').val();
            else
                url = url + '&desciption=' + $('#desciption').val();
            valide = true;
        }
             
        if ($('input[name=type_affectation]').is(':checked')) {
            if (url == '')
                url = '?type_affectation=' + $('#type_affectation').val();
            else
                url = url + '&type_affectation=' + $('#type_affectation').val();
            valide = true;
        }

        if ($('input[name=site]').is(':checked')) {
            if (url == '')
                url = '?site=' + $('#site').val();
            else
                url = url + '&site=' + $('#site').val();
            valide = true;
        }

        if ($('input[name=sous_site]').is(':checked')) {
            if (url == '')
                url = '?sous_site=' + $('#sous_site').val();
            else
                url = url + '&sous_site=' + $('#sous_site').val();
            valide = true;
        }

        if ($('input[name=local]').is(':checked')) {
            if (url == '')
                url = '?local=' + $('#local').val();
            else
                url = url + '&local=' + $('#local').val();
            valide = true;
        }

        if ($('input[name=date_acquisition]').is(':checked')) {
            if (url == '')
                url = '?date_acquisition=' + $('#date_acquisition').val();
            else
                url = url + '&date_acquisition=' + $('#date_acquisition').val();
            valide = true;
        }

        if ($('input[name=mnttva]').is(':checked')) {
            if (url == '')
                url = '?mnttva=' + $('#mnttva').val();
            else
                url = url + '&mnttva=' + $('#mnttva').val();
            valide = true;
        }
         
        if ($('input[name=tva]').is(':checked')) {
            if (url == '')
                url = '?tva=' + $('#tva').val();
            else
                url = url + '&tva=' + $('#tva').val();
            valide = true;
        }
        if ($('input[name=mnttc]').is(':checked')) {
            if (url == '')
                url = '?mnttc=' + $('#mnttc').val();
            else
                url = url + '&mnttc=' + $('#mnttc').val();
            valide = true;
        }

   

      
        if (valide) {
            // url = url + '&id=' + $('#id_imprime').val();
            url = '<?php echo url_for('immobilisation/imprimerFicheImmobAvecChoix') ?>' + url;
            window.open(url, '_blank');
            win.focus();
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Il faut choisir au moins un champ !</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
</script>
<style>
    .table {
        margin-bottom: 0px;
    }
</style>