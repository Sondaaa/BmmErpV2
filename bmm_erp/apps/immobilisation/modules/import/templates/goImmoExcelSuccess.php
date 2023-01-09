<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Immobilisation
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn  btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
    <button id="preparer_button" style="display: none;" class="btn  btn-warning" onclick="makeTableFromColumn()"><i class="ace-icon fa fa-magic"></i> Préparer les pré-enregistrements</button>
    <a class="btn  btn-success pull-right" href="<?php echo url_for('import/importimmobExcel') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>

<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>

<div id="verif_zone" style="display: none;">
    <legend>Tableau Des Immobilisations : <span id="count_facture"></span> <span style="font-size: 14px;"></span></legend>
    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
        <div id="verif_zone_facture" class="col-xs-12 col-sm-12" style="overflow-x: auto; max-height: 300px;"></div>
    </div>

    <div class="col-xs-12 col-sm-12">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement ...</span>
        <button id="save_button" class="btn  btn-primary pull-right" onclick="saveImmobilisation()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import Immobilsation</button>
    </div>
</div>
<script type="text/javascript">
    alasql('select * into html("#res",{headers:true}) \ from xlsx("<?php echo sfconfig::get('sf_appdir') . $url_fichier ?>",\{headers:true})');

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
            } else {
                $(this).attr('facture', $(this).find('td:eq(0)').html().trim());
            }
        });
        checkDateAndFloat();
        $("table").addClass("table table-bordered table-hover");
        $("#loading_icon").fadeOut();
        $("#preparer_button").fadeIn();
        $("#res").fadeIn();
        $("#show_button").fadeOut();
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
            if ($(this).find('td:eq(8)').html() != '') {
                $(this).find('td:eq(8)').html(addDays('1900-01-01', parseInt($(this).find('td:eq(8)').html())));
            }
          
        });
    }

    function makeTableFromColumn() {
        //facture
        var text_table_facture = '<table class="table table-bordered table-hover">';
        text_table_facture = text_table_facture + '<thead><tr>\n\
            <th style="text-align:center;">N° Compte</th>\n\
            <th style="text-align:center;">Désignation</th>\n\
            <th style="text-align:center;">Code Classification</th>\n\
            <th style="text-align:center;">Classification Comptable</th>\n\
            <th style="text-align:center;">Fournisseur</th>\n\
            <th style="text-align:center;">Numéro facture</th>\n\
            <th style="text-align:center;">Ancien N° INVENTAIRE</th>\n\
            <th style="text-align:center;">V. Origine</th>\n\
            <th style="text-align:center;">Date Acquisition</th>\n\
            <th style="text-align:center;">Taux Amort.</th>\n\
            <th style="text-align:center;">Catégorie</th>\n\
            <th style="text-align:center;">Famille</th>\n\
            <th style="text-align:center;">Sous Famille</th> \n\
            <th style="text-align:center;">Site</th>\n\
            <th style="text-align:center;">Sous Site</th>\n\
            <th style="text-align:center;">Local</th>\n\
           </tr></thead>';
        text_table_facture = text_table_facture + '<tbody>';
        var last_tr_facture = '';
        //facture
        var arr_facture = [];
        var text_td_facture = '';
        $("#res table tbody tr").each(function() {
            //facture
            text_td_facture = $(this).find("td:eq(1)").text().trim();
            if (text_td_facture != '') {
                if ($.inArray(text_td_facture, arr_facture) == -1) {
                    arr_facture.push(text_td_facture);
                    last_tr_facture = '<tr><td style="text-align:center;">' +
                        $(this).find('td:eq(0)').html().trim() +
                        '</td><td style="text-align:center;">' + $(this).find('td:eq(1)').html().trim() +
                        '</td><td style="text-align:center;">' + $(this).find('td:eq(2)').html().trim() +
                        '</td><td>' + $(this).find('td:eq(3)').html().trim() +
                        '</td><td style="text-align:center;">' + $(this).find('td:eq(4)').html().trim() +
                        '</td><td style="text-align:center;">' + $(this).find('td:eq(5)').html().trim() +
                        '</td><td style="text-align:right;">' + $(this).find('td:eq(6)').html().trim() +
                        '</td><td style="text-align:right;">' + $(this).find('td:eq(7)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(8)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(9)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(10)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(11)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(12)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(13)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(14)').html().trim() + '</td>' +
                        '<td style="text-align:right;">' + $(this).find('td:eq(15)').html().trim() + '</td>' +
                        ' </tr>';
                    text_table_facture = text_table_facture + last_tr_facture;
                }
            }
        });
        $("#res").fadeOut();
        $("#preparer_button").fadeOut();
        $("#verif_zone_facture").append(text_table_facture);
        $("#count_facture").html($('#verif_zone_facture table tbody tr').length);
        $("#verif_zone").fadeIn();
    }

    function saveImmobilisation() {
        $('#loading_save_icon').fadeIn();
        var numerocompte = '';
        var designation = '';
        var codeCategorie = '';
        var classification='';
        var fournisseur = '';
        var numerofacture = '';
        var anciennum_invetaire = '';
        var valeurorigine='';
        var dateacquition = '';
        var tauxammortisement = '';
        var categorie='';
        var famille = '';
        var sousfamille = '';
        var site = '';
        var soussite = '';
        var local = '';
       

        var k = 0;
        var i = 0;
        var next_k = 50;
        $("#verif_zone_facture table tbody tr").each(function() {
            numerocompte = numerocompte + $(this).find("td:first").text().trim() + ';';
            designation = designation + $(this).find("td:eq(1)").text().trim() + ';';
            codeCategorie = codeCategorie + $(this).find("td:eq(2)").text().trim() + ';';
            classification = classification + $(this).find("td:eq(3)").text().trim() + ';';
            fournisseur = fournisseur + $(this).find("td:eq(4)").text().trim() + ';';
            numerofacture = numerofacture + $(this).find("td:eq(5)").text().trim() + ';';
            anciennum_invetaire = anciennum_invetaire + $(this).find("td:eq(6)").text().trim() + ';';
            valeurorigine = valeurorigine + $(this).find("td:eq(7)").text().trim() + ';';
            dateacquition = dateacquition + $(this).find("td:eq(8)").text().trim() + ';';
            tauxammortisement = tauxammortisement + $(this).find("td:eq(9)").text().trim() + ';';
            categorie = categorie + $(this).find("td:eq(10)").text().trim() + ';';
            famille = famille + $(this).find("td:eq(11)").text().trim() + ';';
            sousfamille = sousfamille + $(this).find("td:eq(12)").text().trim() + ';';
            site = site + $(this).find("td:eq(13)").text().trim() + ';';
            soussite = soussite + $(this).find("td:eq(14)").text().trim() + ';';
            local = local + $(this).find("td:eq(15)").text().trim() + ';';;
            k++;
            if (k == next_k) {
                var data = {
                    numerocompte: numerocompte,
                    designation: designation,
                    codeCategorie: codeCategorie,
                    classification: classification,
                    fournisseur: fournisseur,
                    numerofacture: numerofacture,
                    anciennum_invetaire: anciennum_invetaire,
                    valeurorigine: valeurorigine,
                    dateacquition: dateacquition,
                    tauxammortisement: tauxammortisement,
                    categorie: categorie,
                    famille: famille,
                    sousfamille: sousfamille,
                    site: site,
                    soussite: soussite,
                    local: local,

                };
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: '<?php echo url_for('import/saveImmobImport') ?>',
                    data: JSON.stringify(data),
                    success: function(data) {

                    }
                });

                 numerocompte = '';
         designation = '';
         codeCategorie = '';
         classification='';
         fournisseur = '';
         numerofacture = '';
         anciennum_invetaire = '';
         valeurorigine='';
         dateacquition = '';
         tauxammortisement = '';
         categorie='';
         famille = '';
         sousfamille = '';
         site = '';
         soussite = '';
         local = '';

                k = 0;
            }
        });
        if (k != 0) {
            var data = {
                numerocompte: numerocompte,
                    designation: designation,
                    codeCategorie: codeCategorie,
                    classification: classification,
                    fournisseur: fournisseur,
                    numerofacture: numerofacture,
                    anciennum_invetaire: anciennum_invetaire,
                    valeurorigine: valeurorigine,
                    dateacquition: dateacquition,
                    tauxammortisement: tauxammortisement,
                    categorie: categorie,
                    famille: famille,
                    sousfamille: sousfamille,
                    site: site,
                    soussite: soussite,
                    local: local,
                
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                url: '<?php echo url_for('import/saveImmobImport') ?>',
                data: JSON.stringify(data),
                success: function(data) {
                    if (data.msg == 'OK') {
                        $('#loading_save_icon').fadeOut();
                        $("#save_button").hide();

                        bootbox.dialog({
                            message: "<span class='bigger-160' style='margin:20px;color:#b31531;'></span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Import Immobilisation avec succès !!!</div>",
                            buttons: {
                                "button": {
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
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'></span><br><div class='bigger-110' style='margin:20px;color:#b31531;'>Import Immobilisation avec succès !!!</div>",
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