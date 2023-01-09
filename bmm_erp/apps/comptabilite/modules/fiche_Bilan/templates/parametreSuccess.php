<div id="sf_admin_container">
    <h1 id="replacediv"> Traitement 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Paramétrage du Bilan - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div id="list_bon" class="mws-panel-body" style="font-size: 12px;">
    <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
            <?php
            $desosier = DossiercomptableTable::getInstance()->findOneById($_SESSION['dossier_id']);
            ?>
            <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#parametre_actif">Actif</a></li>
            <li class="ui-state-default ui-corner-top"><a href="#parametre_passif">Capital Propre et Passif</a></li>
            <li class="ui-state-default ui-corner-top"><a href="#parametre_resultat">Résultat</a></li>
            <li class="ui-state-default ui-corner-top"><a href="#parametre_flux">Flux MA</a></li>
            <li class="ui-state-default ui-corner-top"><a href="#parametre_sig">SIG</a></li>
            <li class="ui-state-default ui-corner-top"><a href="#parametre_note">Notes aux Etats Financiers</a></li>

        </ul>

        <div id="parametre_actif" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <?php if ($_SESSION['dossier_id'] == 1): ?>           
                <?php include_partial("fiche_Bilan/parametre_actif", array("parametre_actif" => $parametre_actif)) ?>
            <?php else: ?>
                <?php include_partial("fiche_Bilan/parametre_actif_general", array("parametre_actif" => $parametre_actif)) ?>
            <?php endif; ?>
        </div>

        <div id="parametre_passif" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <?php if ($_SESSION['dossier_id'] == 1): ?>            
                <?php include_partial("fiche_Bilan/parametre_passif", array("parametre_passif" => $parametre_passif)) ?>
            <?php else: ?>
                <?php include_partial("fiche_Bilan/passif_general", array("parametre_passif" => $parametre_passif)) ?>
            <?php endif; ?>
        </div>

        <div id="parametre_resultat" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <?php if ($_SESSION['dossier_id'] == 1): ?>               
                <?php include_partial("fiche_Bilan/parametre_resultat", array("parametre_resultat" => $parametre_resultat)) ?>
            <?php else: ?>
                <?php include_partial("fiche_Bilan/resultat_general", array("parametre_resultat" => $parametre_resultat)) ?>

            <?php endif; ?>
        </div>

        <div id="parametre_flux" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <?php include_partial("fiche_Bilan/parametre_flux", array("parametre_flux" => $parametre_flux)) ?>
        </div>

        <div id="parametre_sig" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <?php include_partial("fiche_Bilan/parametre_sig", array("parametre_sig" => $parametre_sig)) ?>
        </div>

        <div id="parametre_note" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <?php include_partial("fiche_Bilan/parametre_note", array("parametre_note" => $parametre_note)) ?>
        </div>
    </div>
</div>

<script  type="text/javascript">
    var table = '';
    function chargerCompte(id1, id2, id3) {
        if ($(id1).val() != '') {
            $.ajax({
                url: '<?php echo url_for('saisie_pieces/Compteparnumero') ?>',
                data: 'numero=' + $(id1).val(),
                success: function (data) {
                    var data = JSON.parse(data);
                    $(".testul ul").css('width', $(id2).width());
                    htmlins = '';
                    table = data;
                    $(".testul").remove();
                    if (data.length > 0) {
                        htmlins = '<div class="testul">' +
                                '<ul id="ul_compte" onkeydown="selectLi(event)" style="z-index: 9;">';
                        for (i = 0; i < data.length; i++) {
                            if (i == 0)
                                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                            else
                                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="clickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
                        }
                        htmlins += '</ul></div>';
                    }
                    $(id1).after(htmlins);
                }
            });
        } else {
            $(id2).val('');
            $(id3).html('');
            $(id3).text();
        }
    }

    function clickSelectElement(value2, id1, id2, id3) {
        var valeu1 = "";
        var value3 = "";
        for (i = 0; i < table.length; i++) {
            if (value2 - table[i].id === 0) {
                valeu1 = table[i].name;
                value3 = table[i].numero;
                break;
            }
        }
        if (id1)
            $(id1).val(valeu1);
        if (id2)
            $(id2).val(value2);
        $(".testul").remove();
        $(id3).val(value3);
    }
    var highlighted;
    function selectLi(event) {
        highlighted = $(".testul ul li[class=selected_li]");
        switch (event.keyCode) {
            case 38:
                if (highlighted && highlighted.prev().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.prev().addClass("selected_li");
                }
                break;
            case 40:
                if (highlighted && highlighted.next().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.next().addClass("selected_li");
                }
                break;
            case 13:
                if (highlighted) {
                    var data_li = highlighted.attr('data-li');
                    var id1 = highlighted.attr('id1');
                    var id2 = highlighted.attr('id2');
                    var id3 = highlighted.attr('id3');
                    clickSelectElement(data_li, id1, id2, id3);
                }
                break;
            case 27:
                $(".testul").remove();
                break;
        }
    }

    function removeUl() {
        $(".testul").remove();
    }

</script>

<script  type="text/javascript">
    document.title = ('BMM - G. Compta. : T. Paramétrage du Bilan');
</script>

<style>

    .selected_li{
        background-color:#3875d7;
        background-image:-webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#3875d7),color-stop(90%,#2a62bc));
        background-image:-webkit-linear-gradient(#3875d7 20%,#2a62bc 90%);
        background-image:-moz-linear-gradient(#3875d7 20%,#2a62bc 90%);
        background-image:-o-linear-gradient(#3875d7 20%,#2a62bc 90%);
        background-image:linear-gradient(#3875d7 20%,#2a62bc 90%);
        color:#fff
    }

    .ui-helper-reset {font-size: 16px;}

</style>

<script  type="text/javascript">

    function chargerPrecedent(a) {
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/chargerPrecedent') ?>',
            data: 'index=' + a,
            success: function (data) {
                if (data == '0') {
                    bootbox.dialog({
                        message: "<h4 style='color:#4844bd;'>Pas d'anciens paramètres !</h4>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Fermer",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                } else {
                    switch (a) {
                        case '0':
                            $("#parametre_actif").html(data);
                            break;
                        case '1':
                            $("#parametre_passif").html(data);
                            break;
                        case '2':
                            $("#parametre_resultat").html(data);
                            break;
                        case '3':
                            $("#parametre_flux").html(data);
                            break;
                        case '4':
                            $("#parametre_sig").html(data);
                            break;
                    }
                    document.location.reload();
                    $("table").addClass("table table-bordered table-hover");
                    $("#chargement_button_" + a).hide();
                    $("#chargement_info_" + a).show();
                }
            }
        });
    }
  function chargerPrecedentGeneral(a) {
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/chargerPrecedentGeneral') ?>',
            data: 'index=' + a,
            success: function (data) {
                if (data == '0') {
                    bootbox.dialog({
                        message: "<h4 style='color:#4844bd;'>Pas d'anciens paramètres !</h4>",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Fermer",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                } else {
                    switch (a) {
                        case '0':
                            $("#parametre_actif").html(data);
                            break;
                        case '1':
                            $("#parametre_passif").html(data);
                            break;
                        case '2':
                            $("#parametre_resultat").html(data);
                            break;
                        case '3':
                            $("#parametre_flux").html(data);
                            break;
                        case '4':
                            $("#parametre_sig").html(data);
                            break;
                    }
                    $("table").addClass("table table-bordered table-hover");
                    $("#chargement_button_" + a).hide();
                    $("#chargement_info_" + a).show();
                }
            }
        });
    }

</script>