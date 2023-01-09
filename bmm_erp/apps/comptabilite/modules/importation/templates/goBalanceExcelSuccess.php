<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Balance
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn  btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
     <button id="verify_button" style="display: none;" class="btn  btn-purple" onclick="verifier()"><i class="ace-icon fa fa-search"></i> Vérifier les paramètres</button>
    <button id="preparer_button" style="display: none;" class="btn  btn-warning" onclick="makeTableFromColumn()"><i class="ace-icon fa fa-magic"></i> Préparer les pré-enregistrements</button>

    <a class="btn  btn-success pull-right" href="<?php echo url_for('importation/balanceexcel') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>
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
<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>

<div id="verif_zone" style="display: none;">
    <legend>Liste des Balances : <span id="count_facture"></span> <span style="font-size: 14px;"></span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_facture" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>
    <div class="col-xs-12 col-sm-12" style="margin-top: 15px;">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement ...</span>
        <button id="save_button" style="display: none;" class="btn  btn-primary pull-right" onclick="savePlan()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import Balance</button>
    </div>
</div>

<script  type="text/javascript">
    console.log('lancer alasql');
    function saveComptecomptable() {
        alert('Tout d\'abord ajouter les comptes comptables ci dessous  puis initiliser l\import ')
    }
    alasql('select * into html("#res",{headers:true}) \ from xlsx("<?php echo sfconfig::get('sf_appdir') . $url_fichier ?>",\{headers:true})');
function verifier() {
        $("#verify_button").fadeOut();
        makeTableParameterFromColumnComptecomptable();
    }
    function makeTableParameterFromColumnComptecomptable() {
        var arr_plancomptable = [];
        var text_td = '';var text_td_compt_charge='';
        //fournisseur
        var text_table_fournisseur = '<table class="table table-bordered table-hover">';
        text_table_fournisseur = text_table_fournisseur + '<thead><tr><th>Compte Comptable   </th></tr></thead>';
        text_table_fournisseur = text_table_fournisseur + '<tbody>';
        $("#res table tbody tr").each(function () {
            if ($(this).find("td:eq(1)").text().trim() != '' ) {
                text_td = $(this).find("td:eq(1)").text().trim();
                
                if ($.inArray(text_td, arr_plancomptable) == -1 ) {
                    arr_plancomptable.push(text_td);
                    arr_plancomptable.push(text_td_compt_charge);
                    text_table_fournisseur = text_table_fournisseur +
                            '<tr id="Four_niss_eur_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>'
                            + $(this).find("td:eq(1)").text().trim() + '</td></tr>';
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
    function verifyParametreBasePlancomptable() {
       
        var compte_comptable = '';
        var j = 0;
        var next_j = 100;
        $("#verif_zone_comptecomptable table tbody tr").each(function () {
            compte_comptable = compte_comptable + $(this).find("td:eq(0)").text().trim() + ';;';
            j++;
            if (j == next_j) {
                $.ajax({
                    url: '<?php echo url_for('importation/verifPlancomptableBalance') ?>',
                    data: 'compte_comptable=' + compte_comptable ,
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
                url: '<?php echo url_for('importation/verifPlancomptableBalance') ?>',
                data: 'compte_comptable=' + compte_comptable ,
                success: function (data) {
                    $("#verif_enregistrement_comptecompatble_execution").append(data);
                    verifierFinParametrePlancomptable();
                }
            });
        }
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
            }
        });

//        $("table").addClass("table table-bordered table-hover");
//        $("#loading_icon").fadeOut();
//        $("#res").fadeIn();
////        $("#verif_zone").fadeIn();
//        $("#show_button").fadeOut();
//        $("#preparer_button").fadeIn();
        $("table").addClass("table table-bordered table-hover");
        $("#loading_icon").fadeOut();
        $("#verify_button").fadeIn();
        $("#res").fadeIn();
        $("#show_button").fadeOut();
    }
        function makeTableFromColumn() {
        //facture
        var text_table_facture = '<table class="table table-bordered table-hover">';
        text_table_facture = text_table_facture + '<thead><tr><th style="text-align:center;">Classe</th>\n\
    <th style="text-align:center;">Numero Compte</th><th style="text-align:center;">Compte Comptable </th>\n\
<th>Solde debit</th><th style="text-align:center;">solde credit </th>\n\
</tr></thead>';
        text_table_facture = text_table_facture + '<tbody>';

        var last_tr_facture = '';
        //facture
        var arr_facture = [];
        var text_td_facture = '';

        var total_montant_ht = 0;
        var total_montant_tva = 0;
//        var total_montant_timbre = 0;
//        var total_montant_ttc = 0;
        $("#res table tbody tr").each(function () {
            //facture
            text_td_facture = $(this).find("td:eq(0)").text().trim();

            if (text_td_facture != '') {
//                if ($.inArray(text_td_facture, arr_facture) == -1) {
                arr_facture.push(text_td_facture);

                var solde_debit = 0;
                var solde_credit = 0;
//                var montant_timbre = 0;
//                var montant_ttc = 0;


                if ($(this).find('td:eq(3)').html().trim() != '')
                    if (!isNaN(solde_debit))
                    {
                        solde_debit = parseFloat(solde_debit) + parseFloat($(this).find('td:eq(3)').html().trim());
                        total_montant_ht += solde_debit;
                    }
                if ($(this).find('td:eq(4)').html().trim() != '')
                    if (!isNaN(solde_credit))
                    {
                        solde_credit = parseFloat(solde_credit) + parseFloat($(this).find('td:eq(4)').html().trim());
                        total_montant_tva += solde_credit;
                    }
               
                last_tr_facture = '<tr><td style="text-align:center;">' + $(this).find('td:eq(0)').html().trim()
                        + '</td><td style="text-align:center;">'
                        + $(this).find('td:eq(1)').html().trim()
                        + '</td><td style="text-align:left;">'
                        + $(this).find('td:eq(2)').html().trim()
                        + '</td>' 
                        + '<td style="text-align:right;">' + parseFloat(solde_debit).toFixed(3)
                        + '</td><td style="text-align:right;">' + parseFloat(solde_credit).toFixed(3)
                        + '</td></tr>';
                text_table_facture = text_table_facture + last_tr_facture;
//                }
            }
        });

        //facture
        text_table_facture = text_table_facture + '\
        <tr style="background-color: #DCDCDC"><td></td><td>Total</td><td></td><td style="text-align:right;">' + parseFloat(total_montant_ht).toLocaleString()  + '</td><td style="text-align:right;">' + parseFloat(total_montant_tva).toLocaleString()  + '</td>'+ '</tr></tbody></table>';
        $("#res").fadeOut();
        $("#preparer_button").fadeOut();
        
         $("#save_button").fadeIn();
        $("#verif_zone_facture").append(text_table_facture);
        //Count des Documents Achats
//        $("#count_facture").html($('#verif_zone_facture table tbody tr').length);
        $("#verif_zone").fadeIn();
        
    }

    function savePlan() {
        $('#loading_save_icon').fadeIn();
        var classe = '';
        var code = '';
        var libelle = '';

        var k = 0;
        var next_k = 50;
        $("#res table tbody tr").each(function () {
            classe = classe + $(this).find("td:first").text().trim() + ';';
            code = code + $(this).find("td:eq(1)").text().trim() + ';';
            libelle = libelle + $(this).find("td:eq(2)").text().trim() + ';;';

            k++;
            if (k == next_k) {
                console.log('k==next_k' + k + '' + next_k);
                console.log('classe=' + classe + 'code=' + code + 'libelle=' + libelle);
                $.ajax({
                    url: '<?php echo url_for('importation/savePlanComptable') ?>',
                    data: 'code=' + code +
                            '&libelle=' + libelle +
                            '&classe=' + classe,
                    success: function (data) {

                    }
                });

                code = '';
                classe = '';
                libelle = '';
                k = 0;
            }

        });
        if (k != 0) {
            console.log('k==' + k);
            console.log('classe=' + classe + 'code=' + code + 'libelle=' + libelle);
            $.ajax({
                url: '<?php echo url_for('importation/savePlanComptable') ?>',
                data: 'code=' + code +
                        '&libelle=' + libelle +
                        '&classe=' + classe,
                success: function (data) {
                    $('#loading_save_icon').fadeOut();
                    $("#save_button").hide();
                    savePlanDossier();
                }
            });
        } else {
            $('#loading_save_icon').fadeOut();

            $("#save_button").hide();
            savePlanDossier();
        }
    }


    function savePlanDossier() {
        $('#loading_save_icon').fadeIn();
        var code = '';
        var libelle = '';
        var soldeD = '';
        var soldeC = '';
        var code_parent = '';

        var k = 0;
        var next_k = 50;
        $("#res table tbody tr").each(function () {
            code = code + $(this).find("td:eq(1)").text().trim() + ';';
            libelle = libelle + $(this).find("td:eq(2)").text().trim() + ';;';

            var myString = $(this).find("td:eq(3)").text().trim();
            var myString_2 = $(this).find("td:eq(4)").text().trim();
            if (isNaN(myString))
            {
                soldeD = soldeD + '0' + ';';

            }
            else
            {
                soldeD = soldeD + myString + ';';
            }
            if (isNaN(myString_2)) {
                soldeC = soldeC + '0' + ';';
            }

            else {
                soldeC = soldeC + +myString_2 + ';';
            }
            code_parent = code_parent + $(this).find("td:eq(5)").text().trim() + ';';

            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('importation/savePlanDossierComptable') ?>',
                    data: 'soldeD=' + soldeD +
                            '&soldeC=' + soldeC +
                            '&code=' + code +
                            '&libelle=' + libelle +
                            '&code_parent=' + code_parent,
                    success: function (data) {

                    }
                });

                code = '';
                libelle = '';
                soldeD = '';
                soldeC = '';
                code_parent = '';
                k = 0;
            }
        });
        if (k != 0) {
            $.ajax({
                url: '<?php echo url_for('importation/savePlanDossierComptable') ?>',
                data: 'soldeD=' + soldeD +
                        '&soldeC=' + soldeC +
                        '&code=' + code +
                        '&libelle=' + libelle +
                        '&code_parent=' + code_parent,
                success: function (data) {
                    $('#loading_save_icon').fadeOut();

                    bootbox.dialog({
                        message: "<span class='bigger-160' style='margin:20px;color:#b31531;'></span><br><div class='bigger-110' style='margin:20px;color:#b31531;'> Balance est importé avec  succès !!!</div>",
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
            });
        } else {
            $('#loading_save_icon').fadeOut();
            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'></span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Balance est importé avec  succès !!!</div>",
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