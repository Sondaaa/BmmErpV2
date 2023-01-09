<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Operation budget
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<input type="hidden" id="id_titre" value="<?php echo $titre ?>">
<input type="hidden" id="id_tranche" value="<?php echo $tranche ?>">
<input type="hidden" id="id_rubrique" value="<?php echo $rubrique ?>">
<input type="hidden" id="id_sousrubrique" value="<?php echo $sousrubrique ?>">
<input type="hidden" id="id_typeoperation" value="<?php echo $type_operation ?>">
<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn btn-white btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
    <button id="verify_button" style="display: none;" class="btn btn-white btn-purple" onclick="verifier()"><i class="ace-icon fa fa-search"></i> Vérifier les paramètres</button>
    <button id="preparer_button" style="display: none;" class="btn btn-white btn-warning" onclick="makeTableFromColumn()"><i class="ace-icon fa fa-magic"></i> Préparer les pré-enregistrements</button>
    <a class="btn btn-xs btn-success pull-right" href="<?php echo url_for('accueil/import') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>

<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>

<div id="verif_enregistrement" style="display: none;">
    <legend>Paramètres</legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <button id="verif_parametre" class="btn btn-white btn-primary" onclick="verifyParametreBase()"><i class="ace-icon fa fa-search"></i> Vérifier l'existance dans la Base des Données</button>
        <button id="save_parametre" style="display: none;" class="btn btn-xs btn-success" onclick="saveParametre()"><i class="ace-icon fa fa-save"></i> Enregistrer les Nouveaux Paramètres</button>
    </div>
    <div class="col-xs-4 col-sm-4" style="margin-bottom: 20px;">
        <div id="verif_zone_demandeur" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="count_demandeur" class="col-xs-12 col-sm-12"></div>
    </div>
    <div class="col-xs-4 col-sm-4" style="margin-bottom: 20px;">
        <div id="verif_zone_service" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="count_service" class="col-xs-12 col-sm-12"></div>
    </div>
    <div class="col-xs-4 col-sm-4" style="margin-bottom: 20px;">
        <div id="verif_zone_unite" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="count_unite" class="col-xs-12 col-sm-12"></div>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div id="verif_zone_fournisseur" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="count_fournisseur" class="col-xs-12 col-sm-12"></div>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div id="verif_zone_article" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
        <div id="count_article" class="col-xs-12 col-sm-12"></div>
    </div>
</div>
<div id="verif_enregistrement_execution"></div>

<div id="verif_zone" style="display: none;">


    <legend>Tableau Engagement : <span id="count_bdc"></span> <span style="font-size: 14px;">Engagement</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_eng" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <legend>Tableau Ordonnancement : <span id="count_bce"></span> <span style="font-size: 14px;">Ordonnancement</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_ord" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>


    <div class="col-xs-12 col-sm-12">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement ...</span>
        <button id="save_button" class="btn btn-white btn-primary pull-right" onclick="saveEng()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import Opérations Budget</button>
    </div>
</div>
<script type="text/javascript">
    alasql('select * into html("#res",{headers:true}) \ from xlsx("<?php echo sfconfig::get('sf_appdir') . $url_fichier ?>",\{headers:true})');

    function verifier() {
        $("#verify_button").fadeOut();
        makeTableParameterFromColumn();
    }

    function verifyParametreBase() {

        verifyParametreBaseFournisseur();
    }

    function saveParametre() {
        if ($('#verif_zone_demandeur table tbody tr').length != 0 || $('#verif_zone_service table tbody tr').length != 0 || $('#verif_zone_article table tbody tr').length != 0 || $('#verif_zone_fournisseur table tbody tr').length != 0) {
            if ($('#verif_zone_demandeur table tbody tr').length > 0)
                saveDemandeur();
            if ($('#verif_zone_service table tbody tr').length > 0)
                saveService();
            if ($('#verif_zone_unite table tbody tr').length > 0)
                saveUnite();
            if ($('#verif_zone_fournisseur table tbody tr').length > 0)
                saveFournisseur();
            if ($('#verif_zone_article table tbody tr').length > 0)
                saveArticle();
        } else {
            verifierFinParametre();
        }
    }

    function verifierFinParametre() {
        if ($('#verif_zone_demandeur table tbody tr').length == 0 && $('#verif_zone_service table tbody tr').length == 0 && $('#verif_zone_article table tbody tr').length == 0 && $('#verif_zone_fournisseur table tbody tr').length == 0 && $('#verif_zone_unite table tbody tr').length == 0) {
            $("#verif_enregistrement_execution").remove();
            $("#verif_enregistrement").remove();
            $("#preparer_button").fadeIn();
            $("#res").fadeIn();
        } else {
            $("#save_parametre").fadeIn();
        }
    }


    function saveFournisseur() {
        var libelles = '';
        var j = 0;
        var next_j = 100;
        $("#verif_zone_fournisseur table tbody tr").each(function() {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            $(this).remove();
            j++;
            if (j == next_j) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveFournisseur') ?>',
                    data: 'libelles=' + libelles,
                    success: function(data) {
                        verifierFinParametre();
                    }
                });
                libelles = '';
                j = 0;
            }
        });
        if (j != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/saveFournisseur') ?>',
                data: 'libelles=' + libelles,
                success: function(data) {
                    verifierFinParametre();
                }
            });
        }
    }

    function verifyParametreBaseDemandeur() {
        var libelles = '';
        $("#verif_zone_demandeur table tbody tr").each(function() {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/verifDemandeur') ?>',
            data: 'libelles=' + libelles,
            success: function(data) {
                $("#verif_enregistrement_execution").append(data);
                verifierFinParametre();
            }
        });
    }

    function verifyParametreBaseService() {
        var libelles = '';
        $("#verif_zone_service table tbody tr").each(function() {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/verifService') ?>',
            data: 'libelles=' + libelles,
            success: function(data) {
                $("#verif_enregistrement_execution").append(data);
                verifierFinParametre();
            }
        });
    }

    function verifyParametreBaseArticle() {
        var libelles = '';
        var k = 0;
        var next_k = 100;
        $("#verif_zone_article table tbody tr").each(function() {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/verifArticle') ?>',
                    data: 'libelles=' + libelles,
                    success: function(data) {
                        $("#verif_enregistrement_execution").append(data);
                        verifierFinParametre();
                    }
                });
                libelles = '';
                k = 0;
            }
        });
        if (k != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/verifArticle') ?>',
                data: 'libelles=' + libelles,
                success: function(data) {
                    $("#verif_enregistrement_execution").append(data);
                    verifierFinParametre();
                }
            });
        }
    }

    function verifyParametreBaseUnite() {
        var libelles = '';
        $("#verif_zone_unite table tbody tr").each(function() {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/verifUnite') ?>',
            data: 'libelles=' + libelles,
            success: function(data) {
                $("#verif_enregistrement_execution").append(data);
                verifierFinParametre();
            }
        });
    }

    function verifyParametreBaseFournisseur() {
        var libelles = '';
        var j = 0;
        var next_j = 100;
        $("#verif_zone_fournisseur table tbody tr").each(function() {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            j++;
            if (j == next_j) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/verifFournisseur') ?>',
                    data: 'libelles=' + libelles,
                    success: function(data) {
                        $("#verif_enregistrement_execution").append(data);
                        verifierFinParametre();
                    }
                });
                libelles = '';
                j = 0;
            }
        });
        if (j != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/verifFournisseur') ?>',
                data: 'libelles=' + libelles,
                success: function(data) {
                    $("#verif_enregistrement_execution").append(data);
                    verifierFinParametre();
                }
            });
        } else
            verifierFinParametre();
    }

    function makeTableParameterFromColumn() {

        var arr_fournisseur = [];
        var text_td = '';

        //fournisseur
        var text_table_fournisseur = '<table class="table table-bordered table-hover">';
        text_table_fournisseur = text_table_fournisseur + '<thead><tr><th>Fournisseur</th></tr></thead>';
        text_table_fournisseur = text_table_fournisseur + '<tbody>';
        $("#res table tbody tr").each(function() {

            if ($(this).find("td:eq(2)").text().trim() != '') {
                text_td = $(this).find("td:eq(2)").text().trim();
                if ($.inArray(text_td, arr_fournisseur) == -1) {
                    arr_fournisseur.push(text_td);
                    text_table_fournisseur = text_table_fournisseur + '<tr id="Four_niss_eur_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>' + text_td + '</td></tr>';
                }
            }
        });

        //fournisseur
        text_table_fournisseur = text_table_fournisseur + '</tbody>';
        text_table_fournisseur = text_table_fournisseur + '</table>';
        $("#res").fadeOut();

        $("#verif_zone_fournisseur").append(text_table_fournisseur);
        $("#verif_enregistrement").fadeIn();
    }

    function clearEmpty() {
        $("#loading_icon").fadeIn();
        //delete first ligne (obligatoire pour déterminer les colonnes)
        $("#res table tbody tr:first-child").remove();

        var text = '';
        //Replace +& par . dans tout les cellule
        $('#res table tbody tr td').each(function() {
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
        $('#res table tbody tr').each(function() {
            if ($(this).find('td:empty').length == $(this).find('td').length) {
                $(this).remove();
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
        $('#res table tbody tr').each(function() {
            if ($(this).find('td:eq(0)').html() != '') {
                $(this).find('td:eq(0)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(0)').html())));
            }

        });
    }

    function makeTableFromColumn() {
        var arr = [];
        var text_td = '';
        //Engagement
        var text_table_engagement = '<table class="table table-bordered table-hover">';
        text_table_engagement = text_table_engagement + '<thead><tr><th>Date</th><th>Montant TTC</th></tr></thead>';
        text_table_engagement = text_table_engagement + '<tbody>';
        //Ordenancement
        var text_table_ordonnancement = '<table class="table table-bordered table-hover">';
        text_table_ordonnancement = text_table_ordonnancement + '<thead><tr><th>Date</th><th>Montant TTC</th></tr></thead>';
        text_table_ordonnancement = text_table_ordonnancement + '<tbody>';

        var last_tr_engagement = '';
        var last_tr_ordonnance = '';

        var last_number = '';
        var montant = 0;
        //Eng.
        var arr_eng = [];
        var text_td_eng = '';
        //Ordonnance
        var arr_ord = [];
        var text_td_odr = '';

        $("#res table tbody tr").each(function() {

            text_td = $(this).find("td:first").text().trim();
            if (last_number != text_td) {
                text_table_engagement = text_table_engagement + last_tr_engagement;
                last_number = text_td;
            }


            //Engagement
            text_td_engagement = $(this).find("td:eq(4)").text().trim();
            if (text_td_engagement != '') {
                if ($.inArray(text_td_engagement, arr_eng) == -1) {
                    arr_eng.push(text_td_engagement);
                    montant = 0;

                    last_tr_engagement = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(4)').html().trim() + '</td><td><td>' + $(this).find('td:eq(0)').html().trim() + '</td></tr>';
                    text_table_engagement = text_table_engagement + last_tr_engagement;
                }
            }

            //ordonnance
            text_td_ordonnance = $(this).find("td:eq(5)").text().trim();
            if (text_td_ordonnance != '') {
                if ($.inArray(text_td_ordonnance, arr_ord) == -1) {
                    arr_ord.push(text_td_ordonnance);
                    montant = 0;

                    last_tr_ordonnance = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(5)').html().trim() + '</td><td><td>' + $(this).find('td:eq(0)').html().trim() + '</td></tr>';
                    text_table_ordonnancement = text_table_ordonnancement + last_tr_ordonnance;
                }
            }


        });


        //bdc
        text_table_engagement = text_table_engagement + '</tbody></table>';
        //bce
        text_table_ordonnancement = text_table_ordonnancement + '</tbody></table>';

        $("#res").fadeOut();
        $("#preparer_button").fadeOut();

        $("#verif_zone_eng").append(text_table_engagement);
        $("#verif_zone_ord").append(text_table_ordonnancement);

        //Count des Documents Achats

        $("#count_eng").html($('#verif_zone_eng table tbody tr').length);
        $("#count_ord").html($('#verif_zone_ord table tbody tr').length);

        $("#verif_zone").fadeIn();
    }




    function saveEng() {
        $('#loading_save_icon').fadeIn();
        var date = '';
        var libelle = '';
        var benificiere = '';
        var montant_eng = '';
        var montant_ord = '';
        var num_bdc_bce = '';
        var products = '';
        var k = 0;
        var next_k = 2;
        $("#res table tbody tr").each(function() {

            date = date + $(this).find("td:first").text().trim() + ';';
            libelle = libelle + $(this).find("td:eq(1)").text().trim() + ';;';
            benificiere = benificiere + $(this).find("td:eq(2)").text().trim() + ';;';
            products = products + $(this).find("td:eq(3)").text().trim() + ';;';
            montant_eng = montant_eng + $(this).find("td:eq(4)").text().trim() + ';;';
            montant_ord = montant_ord + $(this).find("td:eq(5)").text().trim() + ';;';
            num_bdc_bce = num_bdc_bce + $(this).find("td:eq(6)").text().trim() + ';;';

            k++;
            if (k == next_k) {

                $.ajax({
                    url: '<?php echo url_for('Accueil/saveEng') ?>',
                    data: 'id_titre=' + $('#id_titre').val() +
                        '&id_tranche=' + $('#id_tranche').val() +
                        '&id_rubrique=' + $('#id_rubrique').val() +
                        '&id_sousrubrique=' + $('#id_sousrubrique').val() +
                        '&id_typeoperation=' + $('#id_typeoperation').val() +
                        '&date=' + date +
                        '&libelle=' + libelle +
                        '&benificiere=' + benificiere +
                        '&montant_eng=' + montant_eng +
                        '&products=' + products +
                        '&montant_ord=' + montant_ord +
                        '&num_bdc_bce=' + num_bdc_bce,
                    success: function(data) {

                    }
                });
                date = '';
                benificiere = '';
                montant_eng = '';
                libelle = '';
                products = '';
                montant_ord = '';
                num_bdc_bce = '';
                k = 0;
            }
        });
        if (k != 0) {

            $.ajax({
                url: '<?php echo url_for('Accueil/saveEng') ?>',
                data: 'id_titre=' + $('#id_titre').val() +
                    '&id_tranche=' + $('#id_tranche').val() +
                    '&id_rubrique=' + $('#id_rubrique').val() +
                    '&id_sousrubrique=' + $('#id_sousrubrique').val() +
                    '&id_typeoperation=' + $('#id_typeoperation').val() +
                    '&date=' + date +
                    '&libelle=' + libelle +
                    '&benificiere=' + benificiere +
                    '&montant_eng=' + montant_eng +
                    '&products=' + products +
                    '&montant_ord=' + montant_ord +
                    '&num_bdc_bce=' + num_bdc_bce,
                success: function(data) {

                }
            });
        } else {
            $('#loading_save_icon').fadeOut();
            $("#save_button").hide();
        }
    }
</script>

<style>
    td,
    th {
        border-radius: 0 !important;
    }

    #res>table {
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

    thead>tr>th {
        border-bottom-width: 2px;
    }

    tbody>tr>td,
    thead>tr>td,
    thead>tr>th {
        border: 1px solid #ddd;
    }

    tbody>tr>td,
    thead>tr>td,
    thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
        max-width: 10%;
    }

    tbody>tr>td,
    thead>td,
    thead>td th {
        border-radius: 0 !important;
    }

    thead>tr {
        color: #707070;
        font-weight: 400;
        background: repeat-x #F2F2F2;
        background-image: none;
        background-image: linear-gradient(to bottom, #F8F8F8 0, #ECECEC 100%);
    }
</style>