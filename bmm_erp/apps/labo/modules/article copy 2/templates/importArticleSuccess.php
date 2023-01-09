<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Article
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn btn-white btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
    <a class="btn btn-xs btn-success pull-right" href="<?php echo url_for('article/Import') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>

<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>

<div id="verif_zone" style="display: none;">
    <div class="col-xs-12 col-sm-12" style="margin-top: 15px;">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement ...</span>
        <button id="save_button" class="btn btn-white btn-primary pull-right" onclick="saveArticles()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import articles</button>
    </div>
</div>
<script type="text/javascript">
    console.log('lancer alasql');
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
            }
        });

        $("table").addClass("table table-bordered table-hover");
        $("#loading_icon").fadeOut();
        $("#res").fadeIn();
        $("#verif_zone").fadeIn();
        $("#show_button").fadeOut();
    }

    function saveArticles() {
        $('#loading_save_icon').fadeIn();
        var ancien = '';
        var deseignation = '';
        var tva = '';
        var code_famille = '';
        var libelle_famille = '';
        var unite = '';
        var qte_theorique = '';
        var qte_retirer = '';
        var qte_reel = '';
        var prix_cmpd = '';
        var prix_unitaire = '';
        var code_nature = '';
        var libelle_nature = '';
        var code_sousfamille = '';
        var libelle_sfamille = '';
        var magasin='';

        var k = 0;
        var next_k = 50;
        $("#res table tbody tr").each(function() {
            ancien = ancien + $(this).find("td:first").text().trim() + ';';
            deseignation = deseignation + $(this).find("td:eq(1)").text().trim() + ';';
            tva = tva + $(this).find("td:eq(2)").text().trim() + ';';
            code_famille = code_famille + $(this).find("td:eq(3)").text().trim() + ';';
            libelle_famille = libelle_famille + $(this).find("td:eq(4)").text().trim() + ';';
            unite = unite + $(this).find("td:eq(5)").text().trim() + ';';

            qte_theorique = qte_theorique + $(this).find("td:eq(6)").text().trim() + ';';
            qte_retirer = qte_retirer + $(this).find("td:eq(7)").text().trim() + ';';
            qte_reel = qte_reel + $(this).find("td:eq(8)").text().trim() + ';';
            prix_cmpd = prix_cmpd + $(this).find("td:eq(9)").text().trim() + ';';
            prix_unitaire = prix_unitaire + $(this).find("td:eq(10)").text().trim() + ';';
            code_nature = code_nature + $(this).find("td:eq(11)").text().trim() + ';';
            libelle_nature = libelle_nature + $(this).find("td:eq(12)").text().trim() + ';';
            code_sousfamille = code_sousfamille + $(this).find("td:eq(13)").text().trim() + ';';
            libelle_sfamille = libelle_sfamille + $(this).find("td:eq(14)").text().trim() + ';';
            magasin = magasin + $(this).find("td:eq(15)").text().trim() + ';';


            k++;
            if (k == next_k) {
                datasource = {
                    'ancien': ancien,
                    'deseignation': deseignation,
                    'tva': tva,
                    'code_famille': code_famille,
                    'libelle_famille': libelle_famille,
                    'unite': unite,
                    'qte_theorique': qte_theorique,
                    'qte_retirer': qte_retirer,
                    'qte_reel': qte_reel,
                    'prix_cmpd': prix_cmpd,
                    'prix_unitaire': prix_unitaire,
                    'code_nature': code_nature,
                    'libelle_nature': libelle_nature,
                    'code_sousfamille': code_sousfamille,
                    'libelle_sfamille': libelle_sfamille,
                    'magasin': magasin,
                }
                $.ajax({
                    url: '<?php echo url_for('article/Savearticles') ?>',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(datasource),
                    success: function(data) {

                    }
                });

                ancien = '';
                deseignation = '';
                tva = '';
                code_famille = '';
                libelle_famille = '';
                unite = '';
                code_famille = '';
                libelle_famille = '';
                qte_theorique = '';
                qte_retirer = '';
                qte_reel = '';
                prix_cmpd = '';
                prix_unitaire = '';
                code_nature = '';
                libelle_nature = '';
                code_sousfamille = '';
                libelle_sfamille = '';
                magasin='';
                k = 0;
            }

        });
        if (k != 0) {
            datasource = {
                'ancien': ancien,
                    'deseignation': deseignation,
                    'tva': tva,
                    'code_famille': code_famille,
                    'libelle_famille': libelle_famille,
                    'unite': unite,
                    'qte_theorique': qte_theorique,
                    'qte_retirer': qte_retirer,
                    'qte_reel': qte_reel,
                    'prix_cmpd': prix_cmpd,
                    'prix_unitaire': prix_unitaire,
                    'code_nature': code_nature,
                    'libelle_nature': libelle_nature,
                    'code_sousfamille': code_sousfamille,
                    'libelle_sfamille': libelle_sfamille,
                    'magasin': magasin,
            }
            $.ajax({
                url: '<?php echo url_for('article/Savearticles') ?>',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify(datasource),
                success: function(data) {
                    $('#loading_save_icon').fadeOut();
                    $("#save_button").hide();

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