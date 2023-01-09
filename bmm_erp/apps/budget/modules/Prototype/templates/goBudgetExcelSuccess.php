<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/alasql.min.js"></script>
<script src="<?php echo sfconfig::get('sf_appdir') ?>assets/excel/xlsx.core.min.js"></script>
<!--uploads/import_format/achat.xlsx-->

<div id="sf_admin_container">
    <h1 id="replacediv"> Budget
        <small><i class="ace-icon fa fa-angle-double-right"></i> Import : <?php echo $name; ?></small>
    </h1>
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;">
    <button id="show_button" class="btn btn-white btn-primary" onclick="clearEmpty()"><i class="ace-icon fa fa-edit"></i> Traiter les Données <i id="loading_icon" style="display: none; margin-left: 5px; margin-right: 0px;" class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i></button>
    <a class="btn btn-xs btn-success pull-right" href="<?php echo url_for('Prototype/importbudget') ?>"><i class="ace-icon fa fa-undo"></i> Initialiser l'import</a>
</div>

<div id="res" class="col-xs-12 col-sm-12" style="overflow: auto; display: none; max-height: 300px;"></div>

<div id="verif_zone" style="display: none;">
    <div class="col-xs-12 col-sm-12" style="margin-top: 15px;">
        <span id="loading_save_icon" class="orange" style="display: none;"><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> enregistrement ...</span>
        <button id="save_button" class="btn btn-white btn-primary pull-right" onclick="saveBudget()"><i class="ace-icon fa fa-save"></i>Enregistrer Tout & Finaliser Import budget</button>
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

    function saveBudget() {
        $('#loading_save_icon').fadeIn();
        var source = '';
        var categorie = '';
        var rubrique = '';
        var sous_rubrique = '';
        var projet = '';
        var responsable = '';

        var k = 0;
        var next_k = 50;
        $("#res table tbody tr").each(function() {
            source = source + $(this).find("td:first").text().trim() + ';';
            categorie = categorie + $(this).find("td:eq(1)").text().trim() + ';';
            rubrique = rubrique + $(this).find("td:eq(2)").text().trim() + ';';
            sous_rubrique = sous_rubrique + $(this).find("td:eq(3)").text().trim() + ';';
            projet = projet + $(this).find("td:eq(4)").text().trim() + ';';
            responsable = responsable + $(this).find("td:eq(5)").text().trim() + ';';

            k++;
            if (k == next_k) {
                datasource = {
                    'source': source,
                    'categorie': categorie,
                    'rubrique': rubrique,
                    'sous_rubrique': sous_rubrique,
                    'projet': projet,
                    'responsable': responsable
                }
                $.ajax({
                    url: '<?php echo url_for('Prototype/SaveBudget') ?>',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(datasource),
                    success: function(data) {

                    }
                });

                source = '';
                categorie = '';
                rubrique = '';
                sous_rubrique = '';
                projet = '';
                responsable = '';
                k = 0;
            }

        });
        if (k != 0) {
            datasource = {
                'source': source,
                'categorie': categorie,
                'rubrique': rubrique,
                'sous_rubrique': sous_rubrique,
                'projet': projet,
                'responsable': responsable
            }
            $.ajax({
                url: '<?php echo url_for('Prototype/SaveBudget') ?>',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify(datasource),
                success: function(data) {
                    $('#loading_save_icon').fadeOut();
                    //                    $("#save_button").hide();

                }
            });
        } else {
            $('#loading_save_icon').fadeOut();

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