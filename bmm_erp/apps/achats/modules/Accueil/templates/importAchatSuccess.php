<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Achat  
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn btn-white btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
    <button id="verify_button" style="display: none;" class="btn btn-white btn-purple" onclick="verifier()"><i class="ace-icon fa fa-search"></i> Vérifier les paramètres</button>
    <button id="preparer_button" style="display: none;" class="btn btn-white btn-warning" onclick="makeTableFromColumn()"><i class="ace-icon fa fa-magic"></i> Préparer les pré-enregistrements</button>
    <a class="btn btn-white btn-success pull-right" href="<?php echo url_for('Accueil/import') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>

<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>

<div id="verif_enregistrement" style="display: none;">
    <legend>Paramètres</legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <button id="verif_parametre" class="btn btn-white btn-primary" onclick="verifyParametreBase()"><i class="ace-icon fa fa-search"></i> Vérifier l'existance dans la Base des Données</button>
        <button id="save_parametre" style="display: none;" class="btn btn-white btn-success" onclick="saveParametre()"><i class="ace-icon fa fa-save"></i> Enregistrer les Nouveaux Paramètres</button>
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
    <legend>Tableau B.C.I : <span id="count_bci"></span> <span style="font-size: 14px;">B.C.I</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_bci" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <legend>Tableau B.D.C : <span id="count_bdc"></span> <span style="font-size: 14px;">B.D.C</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_bdc" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <legend>Tableau B.C.E : <span id="count_bce"></span> <span style="font-size: 14px;">B.C.E</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_bce" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <legend>Tableau Factures : <span id="count_facture"></span> <span style="font-size: 14px;">Factures</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_facture" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <legend>Tableau Opérations : <span id="count_operation"></span> <span style="font-size: 14px;">Opérations</span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 15px;">
        <div id="verif_zone_operation" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <div class="col-xs-12 col-sm-12">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement ...</span>
        <button class="btn btn-white btn-primary pull-right" onclick="saveAchat()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import Achat</button>
    </div>
</div>
<script  type="text/javascript">

    alasql('select * into html("#res",{headers:true}) \ from xlsx("<?php echo sfconfig::get('sf_appdir') . $url_fichier ?>",\{headers:true})');
    function verifier() {
        $("#verify_button").fadeOut();
        makeTableParameterFromColumn();
    }

    function verifyParametreBase() {
        verifyParametreBaseDemandeur();
        verifyParametreBaseService();
        verifyParametreBaseUnite();
        verifyParametreBaseFournisseur();
        verifyParametreBaseArticle();
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

    function saveDemandeur() {
        var libelles = '';
        $("#verif_zone_demandeur table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim() + ';;';
            $(this).remove();
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/saveDemandeur') ?>',
            data: 'libelles=' + libelles,
            success: function (data) {
                verifierFinParametre();
            }
        });
    }

    function saveService() {
        var libelles = '';
        $("#verif_zone_service table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim() + ';;';
            $(this).remove();
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/saveService') ?>',
            data: 'libelles=' + libelles,
            success: function (data) {
                verifierFinParametre();
            }
        });
    }

    function saveUnite() {
        var libelles = '';
        $("#verif_zone_unite table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim() + ';;';
            $(this).remove();
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/saveUnite') ?>',
            data: 'libelles=' + libelles,
            success: function (data) {
                verifierFinParametre();
            }
        });
    }

    function saveArticle() {
        var libelles = '';
        var k = 0;
        var next_k = 100;
        $("#verif_zone_article table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim() + ';;';
            $(this).remove();
            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveArticle') ?>',
                    data: 'libelles=' + libelles,
                    success: function (data) {
                        verifierFinParametre();
                    }
                });
                libelles = '';
                k = 0;
            }
        });
        if (k != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/saveArticle') ?>',
                data: 'libelles=' + libelles,
                success: function (data) {
                    verifierFinParametre();
                }
            });
        }
    }

    function saveFournisseur() {
        var libelles = '';
        var j = 0;
        var next_j = 100;
        $("#verif_zone_fournisseur table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            $(this).remove();
            j++;
            if (j == next_j) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveFournisseur') ?>',
                    data: 'libelles=' + libelles,
                    success: function (data) {
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
                success: function (data) {
                    verifierFinParametre();
                }
            });
        }
    }

    function verifyParametreBaseDemandeur() {
        var libelles = '';
        $("#verif_zone_demandeur table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/verifDemandeur') ?>',
            data: 'libelles=' + libelles,
            success: function (data) {
                $("#verif_enregistrement_execution").append(data);
                verifierFinParametre();
            }
        });
    }

    function verifyParametreBaseService() {
        var libelles = '';
        $("#verif_zone_service table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/verifService') ?>',
            data: 'libelles=' + libelles,
            success: function (data) {
                $("#verif_enregistrement_execution").append(data);
                verifierFinParametre();
            }
        });
    }

    function verifyParametreBaseArticle() {
        var libelles = '';
        var k = 0;
        var next_k = 100;
        $("#verif_zone_article table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/verifArticle') ?>',
                    data: 'libelles=' + libelles,
                    success: function (data) {
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
                success: function (data) {
                    $("#verif_enregistrement_execution").append(data);
                    verifierFinParametre();
                }
            });
        }
    }

    function verifyParametreBaseUnite() {
        var libelles = '';
        $("#verif_zone_unite table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
        });
        $.ajax({
            url: '<?php echo url_for('Accueil/verifUnite') ?>',
            data: 'libelles=' + libelles,
            success: function (data) {
                $("#verif_enregistrement_execution").append(data);
                verifierFinParametre();
            }
        });
    }

    function verifyParametreBaseFournisseur() {
        var libelles = '';
        var j = 0;
        var next_j = 100;
        $("#verif_zone_fournisseur table tbody tr").each(function () {
            libelles = libelles + $(this).find("td:first").text().trim().toUpperCase() + ';;';
            j++;
            if (j == next_j) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/verifFournisseur') ?>',
                    data: 'libelles=' + libelles,
                    success: function (data) {
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
                success: function (data) {
                    $("#verif_enregistrement_execution").append(data);
                    verifierFinParametre();
                }
            });
        }
    }

    function makeTableParameterFromColumn() {
        var arr_demandeur = [];
        var arr_service = [];
        var arr_article = [];
        var arr_unite = [];
        var arr_fournisseur = [];
        var text_td = '';
        //demandeur
        var text_table_demandeur = '<table class="table table-bordered table-hover">';
        text_table_demandeur = text_table_demandeur + '<thead><tr><th>Demandeur</th></tr></thead>';
        text_table_demandeur = text_table_demandeur + '<tbody>';
        //service
        var text_table_service = '<table class="table table-bordered table-hover">';
        text_table_service = text_table_service + '<thead><tr><th>Service</th></tr></thead>';
        text_table_service = text_table_service + '<tbody>';
        //article
        var text_table_article = '<table class="table table-bordered table-hover">';
        text_table_article = text_table_article + '<thead><tr><th>Article</th></tr></thead>';
        text_table_article = text_table_article + '<tbody>';
        //unite
        var text_table_unite = '<table class="table table-bordered table-hover">';
        text_table_unite = text_table_unite + '<thead><tr><th>Unité</th></tr></thead>';
        text_table_unite = text_table_unite + '<tbody>';
        //fournisseur
        var text_table_fournisseur = '<table class="table table-bordered table-hover">';
        text_table_fournisseur = text_table_fournisseur + '<thead><tr><th>Fournisseur</th></tr></thead>';
        text_table_fournisseur = text_table_fournisseur + '<tbody>';
        $("#res table tbody tr").each(function () {
            if ($(this).find("td:eq(2)").text().trim() != '') {
                text_td = $(this).find("td:eq(2)").text().trim();
                if ($.inArray(text_td, arr_demandeur) == -1) {
                    arr_demandeur.push(text_td);
                    text_table_demandeur = text_table_demandeur + '<tr id="de_man_deur_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>' + text_td + '</td></tr>';
                }
            }
            if ($(this).find("td:eq(3)").text().trim() != '') {
                text_td = $(this).find("td:eq(3)").text().trim();
                if ($.inArray(text_td, arr_service) == -1) {
                    arr_service.push(text_td);
                    text_table_service = text_table_service + '<tr id="ser_vice_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>' + text_td + '</td></tr>';
                }
            }
            if ($(this).find("td:eq(4)").text().trim() != '') {
                text_td = $(this).find("td:eq(4)").text().trim();
                if ($.inArray(text_td, arr_article) == -1) {
                    arr_article.push(text_td);
                    text_table_article = text_table_article + '<tr id="ar_ti_cle_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>' + text_td + '</td></tr>';
                }
            }
            if ($(this).find("td:eq(6)").text().trim() != '') {
                text_td = $(this).find("td:eq(6)").text().trim();
                if ($.inArray(text_td, arr_unite) == -1) {
                    arr_unite.push(text_td);
                    text_table_unite = text_table_unite + '<tr id="uni_te_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>' + text_td + '</td></tr>';
                }
            }
            if ($(this).find("td:eq(14)").text().trim() != '') {
                text_td = $(this).find("td:eq(14)").text().trim();
                if ($.inArray(text_td, arr_fournisseur) == -1) {
                    arr_fournisseur.push(text_td);
                    text_table_fournisseur = text_table_fournisseur + '<tr id="Four_niss_eur_' + text_td.toUpperCase().replace(/[^a-z0-9]/gi, '') + '"><td>' + text_td + '</td></tr>';
                }
            }
        });
        //demandeur
        text_table_demandeur = text_table_demandeur + '</tbody>';
        text_table_demandeur = text_table_demandeur + '</table>';
        //service
        text_table_service = text_table_service + '</tbody>';
        text_table_service = text_table_service + '</table>';
        //article
        text_table_article = text_table_article + '</tbody>';
        text_table_article = text_table_article + '</table>';
        //unite
        text_table_unite = text_table_unite + '</tbody>';
        text_table_unite = text_table_unite + '</table>';
        //fournisseur
        text_table_fournisseur = text_table_fournisseur + '</tbody>';
        text_table_fournisseur = text_table_fournisseur + '</table>';
        $("#res").fadeOut();
        $("#verif_zone_demandeur").append(text_table_demandeur); //append where you need
        $("#verif_zone_service").append(text_table_service);
        $("#verif_zone_article").append(text_table_article);
        $("#verif_zone_unite").append(text_table_unite);
        $("#verif_zone_fournisseur").append(text_table_fournisseur);
        $("#verif_enregistrement").fadeIn();
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
                $(this).attr('bdc', $(this).find('td:eq(7)').html().trim());
                $(this).attr('bce', $(this).find('td:eq(8)').html().trim());
                $(this).attr('facture', $(this).find('td:eq(12)').html().trim());
                $(this).attr('operation', $(this).find('td:eq(10)').html().trim());
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
            if ($(this).find('td:eq(1)').html() != '') {
                $(this).find('td:eq(1)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(1)').html())));
            }
            if ($(this).find('td:eq(5)').html() != '') {
                $(this).find('td:eq(5)').html(renderFloat($(this).find('td:eq(5)').html()));
            }
            if ($(this).find('td:eq(9)').html() != '') {
                $(this).find('td:eq(9)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(9)').html())));
            }
            if ($(this).find('td:eq(11)').html() != '') {
                $(this).find('td:eq(11)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(11)').html())));
            }
            if ($(this).find('td:eq(13)').html() != '') {
                $(this).find('td:eq(13)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(13)').html())));
            }
        });
    }

    function makeTableFromColumn() {
        var arr = [];
        var text_td = '';
        //bci
        var text_table_bci = '<table class="table table-bordered table-hover">';
        text_table_bci = text_table_bci + '<thead><tr><th>B.C.I</th><th>Date</th><th>Demandeur</th><th>Service</th><th>Montant estimatif</th></tr></thead>';
        text_table_bci = text_table_bci + '<tbody>';
        //bdc
        var text_table_bdc = '<table class="table table-bordered table-hover">';
        text_table_bdc = text_table_bdc + '<thead><tr><th>B.C.I</th><th>B.D.C</th><th>Date</th><th>Demandeur</th><th>Service</th><th>Fournisseur</th><th>Montant TTC</th></tr></thead>';
        text_table_bdc = text_table_bdc + '<tbody>';
        //bce
        var text_table_bce = '<table class="table table-bordered table-hover">';
        text_table_bce = text_table_bce + '<thead><tr><th>B.C.I</th><th>B.C.E</th><th>Date</th><th>Demandeur</th><th>Service</th><th>Fournisseur</th><th>Montant TTC</th></tr></thead>';
        text_table_bce = text_table_bce + '<tbody>';
        //facture
        var text_table_facture = '<table class="table table-bordered table-hover">';
        text_table_facture = text_table_facture + '<thead><tr><th>B.C.E / B.D.C</th><th>Facture</th><th>Date</th><th>Fournisseur</th><th>Montant TTC</th></tr></thead>';
        text_table_facture = text_table_facture + '<tbody>';
        //opération
        var text_table_operation = '<table class="table table-bordered table-hover">';
        text_table_operation = text_table_operation + '<thead><tr><th>Facture</th><th>Opération</th><th>Date</th><th>Fournisseur</th><th>Montant TTC</th></tr></thead>';
        text_table_operation = text_table_operation + '<tbody>';
        var last_tr_bci = '';
        var last_tr_bdc = '';
        var last_tr_bce = '';
        var last_tr_facture = '';
        var last_tr_operation = '';
        var last_number = '';
        var montant = 0;
        //bdc
        var arr_bdc = [];
        var text_td_bdc = '';
        //bce
        var arr_bce = [];
        var text_td_bce = '';
        //facture
        var arr_facture = [];
        var text_td_facture = '';
        //facture
        var arr_operation = [];
        var text_td_operation = '';
        $("#res table tbody tr").each(function () {
            text_td = $(this).find("td:first").text().trim();
            if (last_number != text_td) {
                text_table_bci = text_table_bci + last_tr_bci;
                last_number = text_td;
            }
            if ($.inArray(text_td, arr) == -1) {
                arr.push(text_td);
                montant = parseFloat($(this).find('td:eq(15)').html().trim());
                last_tr_bci = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(1)').html().trim() + '</td><td>' + $(this).find('td:eq(2)').html().trim() + '</td><td>' + $(this).find('td:eq(3)').html().trim() + '</td><td>' + $(this).find('td:eq(15)').html().trim() + '</td></tr>';
            } else {
                montant = parseFloat(montant) + parseFloat($(this).find('td:eq(15)').html().trim());
                if (isNaN(montant))
                    montant = '';
                if (montant != '') {
                    last_tr_bci = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(1)').html() + '</td><td>' + $(this).find('td:eq(2)').html() + '</td><td>' + $(this).find('td:eq(3)').html() + '</td><td>' + parseFloat(montant).toFixed(3) + '</td></tr>';
                } else {
                    last_tr_bci = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(1)').html() + '</td><td>' + $(this).find('td:eq(2)').html() + '</td><td>' + $(this).find('td:eq(3)').html() + '</td><td></td></tr>';
                }
            }

            //bdc
            text_td_bdc = $(this).find("td:eq(7)").text().trim();
            if (text_td_bdc != '') {
                if ($.inArray(text_td_bdc, arr_bdc) == -1) {
                    arr_bdc.push(text_td_bdc);
                    montant = 0;
                    $('#res table tbody tr[bdc="' + text_td_bdc + '"]').each(function () {
                        if ($(this).find('td:eq(15)').html().trim() != '')
                            if (!isNaN(montant))
                                montant = parseFloat(montant) + parseFloat($(this).find('td:eq(15)').html().trim());
                    });
                    last_tr_bdc = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(7)').html().trim() + '</td><td>' + $(this).find('td:eq(1)').html().trim() + '</td><td>' + $(this).find('td:eq(2)').html().trim() + '</td><td>' + $(this).find('td:eq(3)').html().trim() + '</td><td>' + $(this).find('td:eq(14)').html().trim() + '</td><td>' + parseFloat(montant).toFixed(3) + '</td></tr>';
                    text_table_bdc = text_table_bdc + last_tr_bdc;
                }
            }

            //bce
            text_td_bce = $(this).find("td:eq(8)").text().trim();
            if (text_td_bce != '') {
                if ($.inArray(text_td_bce, arr_bce) == -1) {
                    arr_bce.push(text_td_bce);
                    montant = 0;
                    $('#res table tbody tr[bce="' + text_td_bce + '"]').each(function () {
                        if ($(this).find('td:eq(15)').html().trim() != '')
                            if (!isNaN(montant))
                                montant = parseFloat(montant) + parseFloat($(this).find('td:eq(15)').html().trim());
                    });
                    last_tr_bce = '<tr><td>' + text_td + '</td><td>' + $(this).find('td:eq(8)').html().trim() + '</td><td>' + $(this).find('td:eq(1)').html().trim() + '</td><td>' + $(this).find('td:eq(2)').html().trim() + '</td><td>' + $(this).find('td:eq(3)').html().trim() + '</td><td>' + $(this).find('td:eq(14)').html().trim() + '</td><td>' + parseFloat(montant).toFixed(3) + '</td></tr>';
                    text_table_bce = text_table_bce + last_tr_bce;
                }
            }

            //facture
            text_td_facture = $(this).find("td:eq(12)").text().trim();
            if (text_td_facture != '') {
                if ($.inArray(text_td_facture, arr_facture) == -1) {
                    arr_facture.push(text_td_facture);
                    montant = 0;
                    $('#res table tbody tr[facture="' + text_td_facture + '"]').each(function () {
                        if ($(this).find('td:eq(15)').html().trim() != '')
                            if (!isNaN(montant))
                                montant = parseFloat(montant) + parseFloat($(this).find('td:eq(15)').html().trim());
                    });
                    last_tr_facture = '<tr><td>' + $(this).find('td:eq(7)').html().trim() + $(this).find('td:eq(8)').html().trim() + '</td><td>' + $(this).find('td:eq(12)').html().trim() + '</td><td>' + $(this).find('td:eq(13)').html().trim() + '</td><td>' + $(this).find('td:eq(14)').html().trim() + '</td><td>' + parseFloat(montant).toFixed(3) + '</td></tr>';
                    text_table_facture = text_table_facture + last_tr_facture;
                }
            }

            //operation
            text_td_operation = $(this).find("td:eq(10)").text().trim();
            if (text_td_operation != '') {
                if ($.inArray(text_td_operation, arr_operation) == -1) {
                    arr_operation.push(text_td_operation);
                    montant = 0;
                    $('#res table tbody tr[operation="' + text_td_operation + '"]').each(function () {
                        if ($(this).find('td:eq(15)').html().trim() != '')
                            if (!isNaN(montant))
                                montant = parseFloat(montant) + parseFloat($(this).find('td:eq(15)').html().trim());
                    });
                    last_tr_operation = '<tr><td>' + $(this).find('td:eq(12)').html().trim() + '</td><td>' + $(this).find('td:eq(10)').html().trim() + '</td><td>' + $(this).find('td:eq(11)').html().trim() + '</td><td>' + $(this).find('td:eq(14)').html().trim() + '</td><td>' + parseFloat(montant).toFixed(3) + '</td></tr>';
                    text_table_operation = text_table_operation + last_tr_operation;
                }
            }
        });

        //bci
        text_table_bci = text_table_bci + last_tr_bci;
        text_table_bci = text_table_bci + '</tbody></table>';
        //bdc
        text_table_bdc = text_table_bdc + '</tbody></table>';
        //bce
        text_table_bce = text_table_bce + '</tbody></table>';
        //facture
        text_table_facture = text_table_facture + '</tbody></table>';
        //opération
        text_table_operation = text_table_operation + '</tbody></table>';
        $("#res").fadeOut();
        $("#preparer_button").fadeOut();
        $("#verif_zone_bci").append(text_table_bci); //append where you need
        $("#verif_zone_bdc").append(text_table_bdc);
        $("#verif_zone_bce").append(text_table_bce);
        $("#verif_zone_facture").append(text_table_facture);
        $("#verif_zone_operation").append(text_table_operation);
        //Count des Documents Achats
        $("#count_bci").html($('#verif_zone_bci table tbody tr').length);
        $("#count_bdc").html($('#verif_zone_bdc table tbody tr').length);
        $("#count_bce").html($('#verif_zone_bce table tbody tr').length);
        $("#count_facture").html($('#verif_zone_facture table tbody tr').length);
        $("#count_operation").html($('#verif_zone_operation table tbody tr').length);
        $("#verif_zone").fadeIn();
    }

    function saveAchat() {
        saveBci();
    }

    function saveBci() {
        if ($('#verif_zone_bci table tbody tr').length > 0) {
            $('#loading_save_icon').fadeIn();
            var numero = '';
            var date = '';
            var demandeur = '';
            var montant = '';
            var k = 0;
            var next_k = 100;
            $("#verif_zone_bci table tbody tr").each(function () {
                numero = numero + $(this).find("td:first").text().trim() + ';';
                date = date + $(this).find("td:eq(1)").text().trim() + ';';
                demandeur = demandeur + $(this).find("td:eq(2)").text().trim() + ';;';
                if ($(this).find("td:eq(4)").text().trim() != '')
                    montant = montant + $(this).find("td:eq(4)").text().trim() + ';';
                else
                    montant = montant + '0' + ';';
                k++;
                if (k == next_k) {
                    $.ajax({
                        url: '<?php echo url_for('Accueil/saveBci') ?>',
                        data: 'numero=' + numero +
                                '&date=' + date +
                                '&demandeur=' + demandeur +
                                '&montant=' + montant,
                        success: function (data) {

                        }
                    });
                    numero = '';
                    date = '';
                    demandeur = '';
                    montant = '';
                    k = 0;
                }
            });
            if (k != 0) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveBci') ?>',
                    data: 'numero=' + numero +
                            '&date=' + date +
                            '&demandeur=' + demandeur +
                            '&montant=' + montant,
                    success: function (data) {
                        saveLigneBci();
                    }
                });
            } else {
                saveLigneBci();
            }
        } else {
            goSecondStep();
        }
    }

    function goSecondStep() {
        if ($('#verif_zone_bdc table tbody tr').length > 0 || $('#verif_zone_bce table tbody tr').length > 0) {
            if ($('#verif_zone_bdc table tbody tr').length > 0) {

                saveBdc();
            }
            if ($('#verif_zone_bce table tbody tr').length > 0) {
                saveBce();
            }
        } else {
            gothirdStep();
        }
    }

    function gothirdStep() {
        if ($('#verif_zone_facture table tbody tr').length > 0) {
            saveFacture();
        } else {
            if ($('#verif_zone_operation table tbody tr').length > 0)
                saveOperation();
        }
    }

    function saveLigneBci() {
        var numero = '';
        var designation = '';
        var quantite = '';
        var unite = '';
        var montant = '';
        var k = 0;
        var next_k = 40;
        $("#res table tbody tr").each(function () {
            numero = numero + $(this).find("td:first").text().trim() + ';';
            designation = designation + $(this).find("td:eq(4)").text().trim() + ';;';
            if ($(this).find("td:eq(5)").text().trim() != '')
                quantite = quantite + $(this).find("td:eq(5)").text().trim() + ';';
            else
                quantite = quantite + '0' + ';';
            if ($(this).find("td:eq(6)").text().trim() != '')
                unite = unite + $(this).find("td:eq(6)").text().trim() + ';';
            else
                unite = unite + ' ' + ';';
            if ($(this).find("td:eq(15)").text().trim() != '')
                montant = montant + $(this).find("td:eq(15)").text().trim() + ';';
            else
                montant = montant + '0' + ';';
            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveLigneBci') ?>',
                    data: 'numero=' + numero +
                            '&designation=' + designation +
                            '&quantite=' + quantite +
                            '&unite=' + unite +
                            '&montant=' + montant,
                    success: function (data) {

                    }
                });
                numero = '';
                designation = '';
                quantite = '';
                unite = '';
                montant = '';
                k = 0;
            }
        });
        if (k != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/saveLigneBci') ?>',
                data: 'numero=' + numero +
                        '&designation=' + designation +
                        '&quantite=' + quantite +
                        '&unite=' + unite +
                        '&montant=' + montant,
                success: function (data) {
                    $('#loading_save_icon').fadeOut();
                    goSecondStep();
                }
            });
        } else {
            $('#loading_save_icon').fadeOut();
            goSecondStep();
        }
    }

    var jeton_bdc = 0;
    function saveBdc() {
        $('#loading_save_icon').fadeIn();
        var numero = '';
        var date = '';
        var demandeur = '';
        var fournisseur = '';
        var bci = '';
        var montant = '';
        var k = 0;
        var next_k = 45;
        $("#verif_zone_bdc table tbody tr").each(function () {
            bci = bci + $(this).find("td:first").text().trim() + ';';
            if (isNaN($(this).find("td:eq(1)").text().trim()))
                numero = numero + '0' + ';';
            else
                numero = numero + $(this).find("td:eq(1)").text().trim() + ';';
            date = date + $(this).find("td:eq(2)").text().trim() + ';';
            demandeur = demandeur + $(this).find("td:eq(3)").text().trim() + ';;';
            fournisseur = fournisseur + $(this).find("td:eq(5)").text().trim() + ';;';
            if ($(this).find("td:eq(6)").text().trim() != '')
                montant = montant + $(this).find("td:eq(6)").text().trim() + ';';
            else
                montant = montant + '0' + ';';
            k++;
            if (k == next_k) {
                jeton_bdc++;
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveBdc') ?>',
                    data: 'numero=' + numero +
                            '&date=' + date +
                            '&demandeur=' + demandeur +
                            '&fournisseur=' + fournisseur +
                            '&bci=' + bci +
                            '&montant=' + montant,
                    success: function (data) {
                        jeton_bdc--;
                    }
                });
                numero = '';
                date = '';
                demandeur = '';
                fournisseur = '';
                bci = '';
                montant = '';
                k = 0;
            }
        });
        if (k != 0) {
            jeton_bdc++;
            $.ajax({
                url: '<?php echo url_for('Accueil/saveBdc') ?>',
                data: 'numero=' + numero +
                        '&date=' + date +
                        '&demandeur=' + demandeur +
                        '&fournisseur=' + fournisseur +
                        '&bci=' + bci +
                        '&montant=' + montant,
                success: function (data) {
                    jeton_bdc--;
                    if (jeton_bdc == 0 && jeton_bce == 0)
                        gothirdStep();
                }
            });
        } else {
            if (jeton_bdc == 0 && jeton_bce == 0)
                gothirdStep();
        }
    }

    var jeton_bce = 0;
    function saveBce() {
        $('#loading_save_icon').fadeIn();
        var numero = '';
        var date = '';
        var demandeur = '';
        var fournisseur = '';
        var bci = '';
        var montant = '';
        var k = 0;
        var next_k = 40;
        $("#verif_zone_bce table tbody tr").each(function () {
            bci = bci + $(this).find("td:first").text().trim() + ';';
            if (isNaN($(this).find("td:eq(1)").text().trim()))
                numero = numero + '0' + ';';
            else
                numero = numero + $(this).find("td:eq(1)").text().trim() + ';';
            date = date + $(this).find("td:eq(2)").text().trim() + ';';
            demandeur = demandeur + $(this).find("td:eq(3)").text().trim() + ';;';
            fournisseur = fournisseur + $(this).find("td:eq(5)").text().trim() + ';;';
            if ($(this).find("td:eq(6)").text().trim() != '')
                montant = montant + $(this).find("td:eq(6)").text().trim() + ';';
            else
                montant = montant + '0' + ';';
            k++;
            if (k == next_k) {
                jeton_bce++;
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveBce') ?>',
                    data: 'numero=' + numero +
                            '&date=' + date +
                            '&demandeur=' + demandeur +
                            '&fournisseur=' + fournisseur +
                            '&bci=' + bci +
                            '&montant=' + montant,
                    success: function (data) {
                        jeton_bce--;
                    }
                });
                numero = '';
                date = '';
                demandeur = '';
                fournisseur = '';
                bci = '';
                montant = '';
                k = 0;
            }
        });
        if (k != 0) {
            jeton_bce++;
            $.ajax({
                url: '<?php echo url_for('Accueil/saveBce') ?>',
                data: 'numero=' + numero +
                        '&date=' + date +
                        '&demandeur=' + demandeur +
                        '&fournisseur=' + fournisseur +
                        '&bci=' + bci +
                        '&montant=' + montant,
                success: function (data) {
                    jeton_bce--;
                    if (jeton_bdc == 0 && jeton_bce == 0)
                        gothirdStep();
                }
            });
        } else {
            if (jeton_bdc == 0 && jeton_bce == 0)
                gothirdStep();
        }
    }

    function saveFacture() {
        $('#loading_save_icon').fadeIn();
        var numero = '';
        var date = '';
        var fournisseur = '';
        var doc = '';
        var montant = '';
        var k = 0;
        var next_k = 80;
        $("#verif_zone_facture table tbody tr").each(function () {
            doc = doc + $(this).find("td:first").text().trim() + ';';
            var myString = $(this).find("td:eq(1)").text().trim();
            myString = myString.replace(/\D/g, '');
            if (isNaN(myString))
                numero = numero + '0' + ';';
            else
                numero = numero + myString + ';';
            date = date + $(this).find("td:eq(2)").text().trim() + ';';
            fournisseur = fournisseur + $(this).find("td:eq(3)").text().trim() + ';;';
            if ($(this).find("td:eq(4)").text().trim() != '')
                montant = montant + $(this).find("td:eq(4)").text().trim() + ';';
            else
                montant = montant + '0' + ';';
            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveFacture') ?>',
                    data: 'numero=' + numero +
                            '&date=' + date +
                            '&fournisseur=' + fournisseur +
                            '&doc=' + doc +
                            '&montant=' + montant,
                    success: function (data) {

                    }
                });
                numero = '';
                date = '';
                fournisseur = '';
                doc = '';
                montant = '';
                k = 0;
            }
        });
        if (k != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/saveFacture') ?>',
                data: 'numero=' + numero +
                        '&date=' + date +
                        '&fournisseur=' + fournisseur +
                        '&doc=' + doc +
                        '&montant=' + montant,
                success: function (data) {
                    if ($('#verif_zone_operation table tbody tr').length > 0)
                        saveOperation();
                }
            });
        } else {
            if ($('#verif_zone_operation table tbody tr').length > 0)
                saveOperation();
        }
    }

    function saveOperation() {
        $('#loading_save_icon').fadeIn();
        var numero = '';
        var date = '';
        var fournisseur = '';
        var doc = '';
        var montant = '';
        var k = 0;
        var next_k = 80;
        $("#verif_zone_facture table tbody tr").each(function () {
            var myString_doc = $(this).find("td:first").text().trim();
            myString_doc = myString_doc.replace(/\D/g, '');
            if (isNaN(myString_doc))
                doc = doc + '0' + ';';
            else
                doc = doc + myString_doc + ';';
            var myString = $(this).find("td:eq(1)").text().trim();
            myString = myString.replace(/\D/g, '');
            if (isNaN(myString))
                numero = numero + '0' + ';';
            else
                numero = numero + myString + ';';
            date = date + $(this).find("td:eq(2)").text().trim() + ';';
            fournisseur = fournisseur + $(this).find("td:eq(3)").text().trim() + ';;';
            if ($(this).find("td:eq(4)").text().trim() != '')
                montant = montant + $(this).find("td:eq(4)").text().trim() + ';';
            else
                montant = montant + '0' + ';';
            k++;
            if (k == next_k) {
                $.ajax({
                    url: '<?php echo url_for('Accueil/saveOperation') ?>',
                    data: 'numero=' + numero +
                            '&date=' + date +
                            '&fournisseur=' + fournisseur +
                            '&doc=' + doc +
                            '&montant=' + montant,
                    success: function (data) {

                    }
                });
                numero = '';
                date = '';
                fournisseur = '';
                doc = '';
                montant = '';
                k = 0;
            }
        });
        if (k != 0) {
            $.ajax({
                url: '<?php echo url_for('Accueil/saveOperation') ?>',
                data: 'numero=' + numero +
                        '&date=' + date +
                        '&fournisseur=' + fournisseur +
                        '&doc=' + doc +
                        '&montant=' + montant,
                success: function (data) {
                    $('#loading_save_icon').fadeOut();
                }
            });
        } else {
            $('#loading_save_icon').fadeOut();
        }
    }

</script>

<style>

    td, th{
        border-radius: 0 !important;
    }

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

    thead > tr > th {
        border-bottom-width: 2px;
    }

    tbody > tr > td, thead > tr > td, thead > tr > th {
        border: 1px solid #ddd;
    }

    tbody > tr > td, thead > tr > td, thead > tr > th {
        padding: 8px;
        line-height: 1.42857143;
        max-width: 10%;
    }

    tbody > tr > td, thead > td, thead > td th {
        border-radius: 0 !important;
    }

    thead > tr {
        color:  #707070;
        font-weight: 400;
        background: repeat-x #F2F2F2;
        background-image: none;
        background-image: linear-gradient(to bottom, #F8F8F8 0, #ECECEC 100%);
    }

</style>