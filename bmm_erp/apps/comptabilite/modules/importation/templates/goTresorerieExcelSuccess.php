<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Trésorerie  
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn  btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
     <button id="verify_button" style="display: none;" class="btn  btn-purple" onclick="verifier()"><i class="ace-icon fa fa-search"></i> Vérifier les paramètres</button>
    <button id="preparer_button" style="display: none;" class="btn  btn-warning" onclick="makeTableFromColumn()"><i class="ace-icon fa fa-magic"></i> Préparer les pré-enregistrements</button>
    <a class="btn  btn-success pull-right" href="<?php echo url_for('importation/tresorieExcel') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>

<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>
<div id="verif_enregistrement_comptecompatble_execution"></div>
<div id="verif_comptecomptable" style="display: none;">
    <legend>Compte Comptable </legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <button id="verif_parametre_palncomptable" class="btn  btn-primary" onclick="verifyParametrePlancomptable()"><i class="ace-icon fa fa-search"></i> Vérifier l'existance dans la Base des Données</button>
        <label id="save_parametre_compte" style="display: none;" class="btn  btn-success" onclick="saveComptecomptable()"><i class="ace-icon fa fa-save"></i> Il faut  Enregistrer les Nouveaux Compte comptables , Verifier l'exel puis inialiser l'import !!!</label>
    </div>
    <div class="col-xs-8 col-sm-8">
        <div id="verif_zone_comptecomptable" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="verif_zone_comptecomptable_non_trouvable" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="count_comptecomptable" class="col-xs-12 col-sm-12"></div>

    </div>
</div>
<div id="verif_zone" style="display: none;">
    <legend>Tableau Règlement : <span id="count_facture"></span> <span style="font-size: 14px;">Règlement</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_facture" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <div class="col-xs-12 col-sm-12">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement en cours  .................</span>
        <button id="save_button" class="btn  btn-primary pull-right" onclick="saveFacture()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import Trésorerie</button>
    </div>
</div>
<script  type="text/javascript">

    alasql('select * into html("#res",{headers:true}) \ from xlsx("<?php echo sfconfig::get('sf_appdir') . $url_fichier ?>",\{headers:true})');
 function saveComptecomptable() {
        alert('Tout d\'abord ajouter les comptes comptables ci dessous  puis initiliser l\import ')
    }

    function verifier() {
        $("#verify_button").fadeOut();
        makeTableParameterFromColumnComptecomptable();
    }
    function makeTableParameterFromColumnComptecomptable() {
        var arr_plancomptable = [];
        var text_td = '';
        var text_td_compt_charge = '';
        //fournisseur
        var text_table_fournisseur = '<table class="table table-bordered table-hover">';
        text_table_fournisseur = text_table_fournisseur + '<thead><tr><th>Compte Comptable   </th></tr></thead>';
        text_table_fournisseur = text_table_fournisseur + '<tbody>';
        $("#res table tbody tr").each(function () {
            if ($(this).find("td:eq(8)").text().trim() != '') {
                text_td = $(this).find("td:eq(8)").text().trim();

                if ($.inArray(text_td, arr_plancomptable) == -1) {
                    arr_plancomptable.push(text_td);
                    arr_plancomptable.push(text_td_compt_charge);
                    text_table_fournisseur = text_table_fournisseur +
                            '<tr id="Four_niss_eur_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>'
                            + $(this).find("td:eq(8)").text().trim() + '</td></tr>';
                }
            }
        });

        text_table_fournisseur = text_table_fournisseur + '</tbody>';
        text_table_fournisseur = text_table_fournisseur + '</table>';
        $("#res").fadeOut();
        $("#verif_zone_comptecomptable").append(text_table_fournisseur);
        $("#verif_comptecomptable").fadeIn();
    }

    function verifyParametrePlancomptable() {
        verifyParametreBasePlancomptable();
    }
    function verifierFinParametrePlancomptable() {
        if ($('#verif_zone_comptecomptable table tbody tr').length == 0) {
            $("#verif_enregistrement_comptecompatble_execution").remove();
            $("#verif_comptecomptable").remove();
            $("#preparer_button").fadeIn();
            $("#res").fadeIn();
        } else {

            $("#save_parametre_compte").fadeIn();
        }



    }
    function verifyParametreBasePlancomptable() {

        var compte_comptable = '';
        var j = 0;
        var next_j = 100;
        $("#verif_zone_comptecomptable table tbody tr").each(function () {
//            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            compte_comptable = compte_comptable + $(this).find("td:eq(0)").text().trim() + ';;';

            j++;
            if (j == next_j) {
                $.ajax({
                    url: '<?php echo url_for('importation/verifPlancomptableMouvement') ?>',
                    data: 'compte_comptable=' + compte_comptable,
                    success: function (data) {
                        $("#verif_enregistrement_comptecompatble_execution").append(data);
                        verifierFinParametrePlancomptable();
                    }
                });
                compte_comptable = '';

                j = 0;
            }
        });
        if (j != 0) {
            $.ajax({
                url: '<?php echo url_for('importation/verifPlancomptableMouvement') ?>',
                data: 'compte_comptable=' + compte_comptable,
                success: function (data) {
                    $("#verif_enregistrement_comptecompatble_execution").append(data);
                    verifierFinParametrePlancomptable();
                }
            });
        }
    }
   
    function clearEmpty() {
        $("#loading_icon").fadeIn();
        //delete first ligne (obligatoire pour déterminer les colonnes)
        $("#res table tbody tr:first-child").remove();
        var text = '';
        //Replace +& par . dans tout les cellule
        $('#res table tbody tr td').each(function () {
            text = $(this).html();
            if (text != '') {
                text = text.split('+').join('.');
                text = text.split('=').join('.');
                text = text.split('&').join('.');
                text = text.split('"').join('\'');
                $(this).html(text);
            }
        });
        //delete all clean rows and add attribute
        $('#res table tbody tr').each(function () {
            if ($(this).find('td:empty').length == $(this).find('td').length) {
                $(this).remove();
            } else {
                $(this).attr('facture', $(this).find('td:eq(0)').html().trim());
            }
        });
        checkDateAndFloat();
        $("table").addClass("table table-bordered table-hover");
        $("#loading_icon").fadeOut();
        $("#verify_button").fadeIn();
        $("#res").fadeIn();
        $("#show_button").fadeOut();
    }

    function renderFloat(myString) {
        return myString = myString.replace(/\D/g, '');
    }

    function addDays(date, days) {
        const newdate = new Date(date);
        days = parseInt(days) - 2;
        newdate.setDate(newdate.getDate() + parseInt(days));
        var dd = newdate.getDate();
        var mm = newdate.getMonth() + 1;
        var y = newdate.getFullYear();
        var someFormattedDate = ('0' + dd).slice(-2) + '/' + ('0' + mm).slice(-2) + '/' + y;
        //verifier si pas de date
        if (someFormattedDate == 'aN/aN/NaN')
            someFormattedDate = '';
        return someFormattedDate;
    }

    function checkDateAndFloat() {
        $('#res table tbody tr').each(function () {
            if ($(this).find('td:eq(0)').html() != '') {
                $(this).find('td:eq(0)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(0)').html())));
            }
            if ($(this).find('td:eq(3)').html() != '') {
                $(this).find('td:eq(3)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(3)').html())));
            }
            parseFloat($(this).find('td:eq(4)').html().trim()).toFixed(3);
            parseFloat($(this).find('td:eq(5)').html().trim()).toFixed(3);
            parseFloat($(this).find('td:eq(6)').html().trim()).toFixed(3);
        });
    }

    function makeTableFromColumn() {
        //facture
        var text_table_facture =
                '<table class="table table-bordered table-hover">';
        text_table_facture = text_table_facture + '<thead><tr><th style="text-align:center;">Date</th>\n\
    <th style="text-align:center;">Libellé</th>\n\
    <th style="text-align:center;">Numèro pièce</th>\n\
    <th style="text-align:center;">Date valeur</th>\n\
    <th style="text-align:center;">Montant HT</th>\n\
    <th style="text-align:center;">Total TVA</th>\n\
    <th style="text-align:center;">Total TTC</th>\n\
    <th style="text-align:center;">Type</th>\n\
    <th style="text-align:center;">Compte comptable</th></tr></thead>';
        text_table_facture = text_table_facture + '<tbody>';
        var last_tr_facture = '';
        //facture
        var arr_facture = [];
        var text_td_facture = '';
        var total_montant_ht = 0;
        var total_montant_tva = 0;
       
        var total_montant_ttc = 0;
        $("#res table tbody tr").each(function () {
            //facture
            text_td_facture = $(this).find("td:eq(3)").text().trim();
            if (text_td_facture != '') {
//                if ($.inArray(text_td_facture, arr_facture) == -1) {
                arr_facture.push(text_td_facture);
                var montant_ht = 0;
                var montant_tva = 0;
                var montant_ttc = 0;
                if ($(this).find('td:eq(4)').html().trim() != '')
                    if (!isNaN(montant_ht))
                    {
                        montant_ht = parseFloat(montant_ht) + parseFloat($(this).find('td:eq(4)').html().trim());
                        total_montant_ht += montant_ht;
                    }
                if ($(this).find('td:eq(5)').html().trim() != '')
                    if (!isNaN(montant_tva))
                    {
                        montant_tva = parseFloat(montant_tva) + parseFloat($(this).find('td:eq(5)').html().trim());
                        total_montant_tva += montant_tva;
                    }
                if ($(this).find('td:eq(6)').html().trim() != '')
                    if (!isNaN(montant_ttc))
                    {
                        montant_ttc = parseFloat(montant_ttc) + parseFloat($(this).find('td:eq(6)').html().trim());
                        total_montant_ttc += montant_ttc;
                    }
                last_tr_facture = '<tr><td style="text-align:center;">' +
                        $(this).find('td:eq(0)').html().trim() + '</td>\n\
                             <td style="text-align:center;">' + $(this).find('td:eq(1)').html().trim() +
                        '</td><td style="text-align:center;">' + $(this).find('td:eq(2)').html().trim() +
                        '</td><td style="text-align:center;">' + $(this).find('td:eq(3)').html().trim() +
                        '</td><td style="text-align:right;">' + parseFloat(montant_ht).toFixed(3)
                        + '</td><td style="text-align:right;">' + parseFloat(montant_tva).toFixed(3)
                        + '</td><td style="text-align:right;">' + parseFloat(montant_ttc).toFixed(3)
                        + '</td><td style="text-align:center;">' + $(this).find('td:eq(7)').html().trim()
                        + '</td><td style="text-align:center;">' + $(this).find('td:eq(8)').html().trim() +
                        '</td></tr>';
                text_table_facture = text_table_facture + last_tr_facture;
//                }
            }
        });
        //facture
        text_table_facture = text_table_facture + '\
            <tr style="background-color: #DCDCDC"><td>Total</td><td></td>\n\
           <td></td><td></td><td style="text-align:right;">' + parseFloat(total_montant_ht).toLocaleString() 
            + '</td><td style="text-align:right;">' + parseFloat(total_montant_tva).toLocaleString() 
            + '</td>' + '<td style="text-align:right;">' + parseFloat(total_montant_ttc).toLocaleString() 
            + '</td><td></td><td></td></tr></tbody></table>';

        $("#res").fadeOut();
        $("#preparer_button").fadeOut();
        $("#save_button").fadeIn();
        $("#verif_zone_facture").append(text_table_facture);
        //Count des Documents Achats
        $("#count_facture").html($('#verif_zone_facture table tbody tr').length -1);
        $("#verif_zone").fadeIn();
    }

    function saveFacture() {
        $('#loading_save_icon').fadeIn();
        var numero = '';
        var libelle = '';
        var date = '';
        var date_valeur = '';
        var doc = '';
        var montant_ht = '';
        var montant_tva = '';
        var type = '';
        var montant_ttc = '';
        var k = 0;
        var i = 0;
        var next_k = 50;
        var numero_compte = '';
        $("#verif_zone_facture table tbody tr").each(function () {
            doc = doc + $(this).find("td:first").text().trim() + ';';
            date = date + $(this).find("td:eq(0)").text().trim() + ';';
            libelle = libelle + $(this).find("td:eq(1)").text().trim() + ';';
            var myString = $(this).find("td:eq(2)").text().trim();
//            myString = myString.replace(/\D/g, '');
//            if (isNaN(myString))
//                numero = numero + '0' + ';';
//            else
            numero = numero + myString + ';';
            date_valeur = date_valeur + $(this).find("td:eq(3)").text().trim() + ';';
            if ($(this).find("td:eq(4)").text().trim() != '')
                montant_ht = montant_ht + $(this).find("td:eq(4)").text().trim() + ';';
            else
                montant_ht = montant_ht + '0' + ';';
            if ($(this).find("td:eq(5)").text().trim() != '')
                montant_tva = montant_tva + $(this).find("td:eq(5)").text().trim() + ';';
            else
                montant_tva = montant_tva + '0' + ';';
            if ($(this).find("td:eq(6)").text().trim() != '')
                montant_ttc = montant_ttc + $(this).find("td:eq(6)").text().trim() + ';';
            else
                montant_ttc = montant_ttc + '0' + ';';
            type = type + $(this).find("td:eq(7)").text().trim() + ';';
            numero_compte = numero_compte + $(this).find("td:eq(8)").text().trim() + ';';
            k++;
//            console.log(numero + ' ' + type);
            if (k == next_k) {
                var data = {
                    numero: numero,
                    doc: doc,
                    libelle: libelle,
                    date: date,
                    date_valeur: date_valeur,
                    montant_ht: montant_ht,
                    montant_tva: montant_tva,
                    type: type,
                    montant_ttc: montant_ttc,
                    numero_compte: numero_compte,
                };
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: '<?php echo url_for('importation/saveFactureTresorie') ?>',
                    data: JSON.stringify(data),
                    success: function (data) {

                    }
                });
                numero = '';
                libelle='';
                date = '';
                type = '';
                doc = '';
                montant_ht = '';
                montant_tva = '';
                date_valeur = '';
                montant_ttc = '';
                numero_compte = '';
                k = 0;
            }
        });
        if (k != 0) {
            var data = {
                numero: numero,
                doc: doc,
                libelle: libelle,
                date: date,
                date_valeur: date_valeur,
                montant_ht: montant_ht,
                
                montant_tva: montant_tva,
                type: type,
                montant_ttc: montant_ttc,
                numero_compte: numero_compte,
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                url: '<?php echo url_for('importation/saveFactureTresorie') ?>',
                data: JSON.stringify(data),
                success: function (data) {
                    if (data.msg === 'OK')
                    {
                        $('#loading_save_icon').fadeOut();
                        $("#save_button").hide();
                        bootbox.dialog({
                            message: "<span class='bigger-160' style='margin:20px;color:#b31531;'></span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Import Reglement de Trésorerie  avec succès !!!</div>",
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
            });
        } else {
            $('#loading_save_icon').fadeOut();
            $("#save_button").hide();
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'> </span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Import Reglement de Trésorerie avec succès !!!</div>",
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

    td, th{border-radius: 0 !important;}
    #res > table{
        border: 1px solid #ddd;
        border-radius: 0 !important;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
        box-sizing: border-box;
        font-size: 11px;
    }

    thead > tr > th {border-bottom-width: 2px;}
    tbody > tr > td, thead > tr > td, thead > tr > th {border: 1px solid #ddd;}
    tbody > tr > td, thead > tr > td, thead > tr > th {
        padding: 8px;
        line-height: 1.42857143;
        max-width: 10%;
    }

    tbody > tr > td, thead > td, thead > td th {border-radius: 0 !important;}
    thead > tr {
        color:  #707070;
        font-weight: 400;
        background: repeat-x #F2F2F2;
        background-image: none;
        background-image: linear-gradient(to bottom, #F8F8F8 0, #ECECEC 100%);
    }

</style>