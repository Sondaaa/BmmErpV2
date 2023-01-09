var table;
function AjoutHtmlAfterForPatrimoine(data, id2, id3) {

    $(".testul ul").css('width', $(id2).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
                '<ul id="ul_compte" style="z-index: 9;">';

        for (i = 0; i < data.length; i++) {
            htmlins += '<li data-li="' + data[i].id + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementPatrimoine(\'' + data[i].id + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
        }
        htmlins += '</ul></div>';
    }
    $(id2).after(htmlins);
}

function ClickSelectElementPatrimoine(value2, id2, id3) {
    var name = "";
    for (i = 0; i < table.length; i++) {
        if (value2 - table[i].id === 0) {
            name = table[i].name;
            break;
        }
    }
    if (id3)
        $(id3).val(value2);
    if (id2)
        $(id2).val(name);
    $(id2).focus();
    $(".testul").remove();
    if ($('#idbd').val() != '')
        $('#txt_article').removeClass('disabledbutton');
    else {
        $('#txt_article').addClass('disabledbutton');
        $('#idarticle').val('');
        $('#txt_article').val('');
    }
}

function AjoutHtmlAfterRaisonNoCode(data, id2, id3) {

    $(".testul ul").css('width', $(id2).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
//                '<ul id="ul_compte" style="z-index: 9;">';
                '<ul id="ul_compte" onkeydown="selectLiFournisseurNoCode(event)" style="z-index: 9;">';

        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementFournisseurNoCode(\'' + data[i].id + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
            } else {
                htmlins += '<li data-li="' + data[i].id + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementFournisseurNoCode(\'' + data[i].id + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
            }
        }
        htmlins += '</ul></div>';
    }
    $(id2).after(htmlins);
}

function AjoutHtmlAfterRaisonBDCG(data, id2, id3) {
    $(".testul ul").css('width', $(id2).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
                '<ul id="ul_compte" onkeydown="selectLiFournisseurNoCode(event)" style="z-index: 9;">';
        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementFournisseurNoCode(\'' + data[i].id + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
            } else {
                htmlins += '<li data-li="' + data[i].id + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementFournisseurNoCode(\'' + data[i].id + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
            }
        }
        htmlins += '</ul></div>';
    }
    $(id2).after(htmlins);
}
function selectLiFournisseurNoCode(event) {
    highlighted = $(".testul ul li[class=selected_li]");
    switch (event.keyCode) {
        //Up
        case 38:
            if (highlighted && highlighted.prev().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.prev().addClass("selected_li");
            }
            break;
            //Down
        case 40:
            if (highlighted && highlighted.next().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.next().addClass("selected_li");
            }
            break;
            //Entrer
        case 13:
            if (highlighted) {
                var data_li = highlighted.attr('data-li');
                var id2 = highlighted.attr('id2');
                var id3 = highlighted.attr('id3');
                ClickSelectElementFournisseurNoCode(data_li, id2, id3);
            }
            break;
            //ESC
        case 27:
            $(".testul").remove();
            break;
    }
}

function ClickSelectElementFournisseurNoCode(value2, id2, id3) {
    var name = "";
    for (i = 0; i < table.length; i++) {
        if (value2 - table[i].id === 0) {
            name = table[i].name;
            break;
        }
    }
    if (id3)
        $(id3).val(value2);
    if (id2)
        $(id2).val(name);
    $(id2).focus();
    $(".testul").remove();
}

function AjoutHtmlAfterRaison(data, id1, id2, id3) {

    $(".testul ul").css('width', $(id2).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
//                '<ul id="ul_compte" style="z-index: 9;">';
                '<ul id="ul_compte" onkeydown="selectLiFournisseur(event)" style="z-index: 9;">';

        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementFournisseur(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
            } else {
                htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" id3="' + id3 + '" onclick="ClickSelectElementFournisseur(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
            }
        }
        htmlins += '</ul></div>';
    }
    $(id2).after(htmlins);
}
function selectLiFournisseur(event) {
    highlighted = $(".testul ul li[class=selected_li]");
    switch (event.keyCode) {
        //Up
        case 38:
            if (highlighted && highlighted.prev().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.prev().addClass("selected_li");
            }
            break;
            //Down
        case 40:
            if (highlighted && highlighted.next().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.next().addClass("selected_li");
            }
            break;
            //Entrer
        case 13:
            if (highlighted) {
                var data_li = highlighted.attr('data-li');
                var id1 = highlighted.attr('id1');
                var id2 = highlighted.attr('id2');
                var id3 = highlighted.attr('id3');
                ClickSelectElementFournisseur(data_li, id1, id2, id3);
            }
            break;
            //ESC
        case 27:
            $(".testul").remove();
            break;
    }
}

function ClickSelectElementFournisseur(value2, id1, id2, id3) {
    var reference = "";
    var name = "";
    for (i = 0; i < table.length; i++) {
        if (value2 - table[i].id === 0) {
            reference = table[i].ref;
            if (reference != "" && reference != null)
                reference = reference.trim();
            name = table[i].name;
            break;
        }
    }
    if (id3)
        $(id3).val(value2);
    if (id1)
        $(id1).val(reference);
    if (id2)
        $(id2).val(name);
    $(id2).focus();
    $(".testul").remove();
}



function AjoutHtmlAfterDesignation(data, id1, id2) {

    $(".testul ul").css('width', $(id2).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        if (data[0].ref && data[0].ref != "undefined")
            htmlins = '<div class="testul">' +
//                    '<ul id="ul_compte" style="z-index: 9;">';
                    '<ul id="ul_compte" onkeydown="selectLi(event, 1)" style="z-index: 9;">';
        else
            htmlins = '<div class="testul">' +
//                    '<ul id="ul_compte" style="z-index: 9;">';
                    '<ul id="ul_compte" onkeydown="selectLi(event, 0)" style="z-index: 9;">';
        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                if (data[i].ref && data[i].ref != "undefined")
                    htmlins += '<li class="selected_li" data-li="' + data[i].ref.trim() + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElementByRef(\'' + data[i].ref.trim() + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].ref.trim() + ' ' + data[i].name + '</li>';
                else {
                    htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                }
            } else {
                if (data[i].ref && data[i].ref != "undefined")
                    htmlins += '<li data-li="' + data[i].ref.trim() + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElementByRef(\'' + data[i].ref.trim() + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].ref.trim() + ' ' + data[i].name + '</li>';
                else {
                    htmlins += '<li data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                }
            }
        }
        htmlins += '</ul></div>';
    }
    $(id2).after(htmlins);
}
function AjoutHtmlAfter(data, id1, id2) {

    $(".testul ul").css('width', $(id2).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        if (data[0].ref && data[0].ref != "undefined")
            htmlins = '<div class="testul">' +
//                    '<ul id="ul_compte" style="z-index: 9;">';
                    '<ul id="ul_compte" onkeydown="selectLi(event, 1)" style="min-width: 150px;z-index: 12; height: 150px">';
        else
            htmlins = '<div class="testul" >' +
//                    '<ul id="ul_compte" style="z-index: 9;">';
                    '<ul id="ul_compte" onkeydown="selectLi(event, 0)" style="min-width: 150px;z-index: 12;height: 150px">';

        for (i = 0; i < data.length; i++) {
            if (data[i].name == null)
                data[i].name = '';
        }

        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                if (data[i].ref && data[i].ref != "undefined")
                    htmlins += '<li   id="li_' + data[i].ref.trim() + '"  class="selected_li" data-li="' + data[i].ref.trim() + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElementByRef(\'' + data[i].ref.trim() + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].ref.trim() + ' ' + data[i].name + '</li>';
                else {
                    htmlins += '<li id="li_' + data[i].id + '" class="selected_li" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                }
            } else {
                if (data[i].ref && data[i].ref != "undefined")
                    htmlins += '<li id="li_' + data[i].ref.trim() + '"  data-li="' + data[i].ref.trim() + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElementByRef(\'' + data[i].ref.trim() + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].ref.trim() + ' ' + data[i].name.replace(null, '') + '</li>';
                else {
                    htmlins += '<li id="li_' + data[i].id + '" data-li="' + data[i].id + '" id1="' + id1 + '" id2="' + id2 + '" onclick="ClickSelectElement(\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
                }
            }
        }
        htmlins += '</ul></div>';
    }
    $(id1).after(htmlins);
}
function ClickSelectElementByRef(value2, id1, id2) {
//    console.log('mpppp' + value2 + id1 + id2);
    var valeu1 = "";
    for (i = 0; i < table.length; i++) {
        if (table[i].ref != null) {
            if (value2 === table[i].ref.trim()) {
                valeu1 = table[i].name.trim();
                break;
            }
        }
    }
    if (id1)
        $(id1).val(value2);
    if (id2)
        $(id2).val(valeu1);
    $(id2).focus();

//    ClickSelectNumeroexterne(value2, value2);
    $(".testul").remove();

//    angular.element($("#li_" + value2)).scope().affichagenumeroexterne(id2);
}
function AjoutHtmlAfterPrix(data, id1, id2, id3, id4) {

    htmlins = '';
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
                '<ul>';
        for (i = 0; i < data.length; i++) {
            if (data[i].ref && data[i].ref != "undefined")
                htmlins += '<li onclick="ClickSelectElementPrix(\'' + data[i].ref + '\',\'' + data[i].name + '\',\'' + data[i].prix + '\',\'' + data[i].tva + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\',\'' + id4 + '\')">' + data[i].ref + ' ' + data[i].name + '</li>';
            else
                htmlins += '<li onclick="ClickSelectElementPrix(\'\',\'' + data[i].name + '\',\'' + data[i].prix + '\',\'' + data[i].tva + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\',\'' + id4 + '\')">' + data[i].name + '</li>';
        }
        htmlins += '</ul></div>';
    }
    $(id1).after(htmlins);
}

function selectLi(event, choix) {
    highlighted = $(".testul ul li[class=selected_li]");
    switch (event.keyCode) {
        //Up
        case 38:
            if (highlighted && highlighted.prev().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.prev().addClass("selected_li");
            }
            break;
            //Down
        case 40:
            if (highlighted && highlighted.next().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.next().addClass("selected_li");
            }
            break;
            //Entrer
        case 13:
            if (highlighted) {
                var data_li = highlighted.attr('data-li');
                var id1 = highlighted.attr('id1');
                var id2 = highlighted.attr('id2');
                if (choix == 0)
                    ClickSelectElement(data_li, id1, id2);
                else
                    ClickSelectElementByRef(data_li, id1, id2);
            }
            break;
            //ESC
        case 27:
            $(".testul").remove();
            break;
    }
}

function AjoutHtmlAfterTRansfert(data, id1, id2, id3) {
    htmlins = '';
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
                '<ul>';
        for (i = 0; i < data.length; i++) {

            if (data[i].ref && data[i].ref != "undefined")
                htmlins += '<li onclick="ClickSelectElementTransfert(\'' + data[i].ref + '\',\'' + data[i].name + '\',\'' + data[i].qtemax + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].ref + ' ' + data[i].name + '</li>';
            else
                htmlins += '<li onclick="ClickSelectElementTransfert(\'' + data[i].name + '\',\'' + data[i].id + '\',\'' + data[i].qtemax + '\',\'' + id1 + '\',\'' + id2 + '\',\'' + id3 + '\')">' + data[i].name + '</li>';
        }
        htmlins += '</ul></div>';
    }
    $(id1).after(htmlins);
}

function ClickSelectElementPrix(valeu1, value2, valeur3, valeur4, id1, id2, id3, id4) {
    if (id1)
        $(id1).val(valeu1);
    if (id2)
        $(id2).val(value2);
    if (id3)
        $(id3).val(valeur3);
    if (id4)
        $(id4).val(valeur4);
    $(".testul").remove();
}
function AjoutHtmlAfter1(data, id1, id2) {
//    alert(data);
    htmlins = '';
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
                '<ul>';
        for (i = 0; i < data.length; i++) {

            if (data[i].ref != "undefined")
                htmlins += '<li onclick="ClickSelectElement(\'' + data[i].ref + '\',\'' + data[i].name + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].ref + ' ' + data[i].name + '</li>';
            else
                htmlins += '<li onclick="ClickSelectElement(\'' + data[i].name + '\',\'' + data[i].id + '\',\'' + id1 + '\',\'' + id2 + '\')">' + data[i].name + '</li>';
        }
        htmlins += '</ul></div>';
    }
    $(id1).after(htmlins);
}
function ClickSelectElement(value2, id1, id2) {
//    console.log('p'+value2+id1+id2);
    var valeu1 = "";
    for (i = 0; i < table.length; i++) {
        if (value2 - table[i].id === 0) {
            valeu1 = table[i].name.trim();
            break;
        }
    }
    if (id1)
        $(id1).val(valeu1);
    if (id2)
        $(id2).val(value2);
    $(id2).focus();
    console.log('cd=' + value2);
    ClickSelectNumeroexterne(value2);
    $(".testul").remove();
//    if (id1)
//        $(id1).val(valeu1);
//    if (id2)
//        $(id2).val(value2);
//    $(".testul").remove();
//angular.element($("#li_" + value2)).scope().affichagenumeroexterne(id2);
}
function ClickSelectElementTransfert(val1, val2, val3, id1, id2, id3) {
    if (id1)
        $(id1).val(val1);
    if (id2)
        $(id2).val(val2);
    if (id3)
        $(id3).val(val3);

    $(".testul").remove();
}

//Début Document achat
function AjoutHtmlAfterForDocAchat(data, reference, id, date, montant) {
    $(".testul ul").css('width', $(reference).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
//                '<ul id="ul_compte" style="z-index: 9;">';
                '<ul id="ul_compte" onkeydown="selectLiForDocAchat(event)" style="z-index: 9;">';

        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + reference + '" id2="' + id + '" id3="' + date + '" id4="' + montant + '" onclick="ClickSelectElementForDocAchat(\'' + data[i].id + '\',\'' + reference + '\',\'' + id + '\',\'' + date + '\',\'' + montant + '\')">' + data[i].reference + '</li>';
            } else {
                htmlins += '<li data-li="' + data[i].id + '" id1="' + reference + '" id2="' + id + '" id3="' + date + '" id4="' + montant + '" onclick="ClickSelectElementForDocAchat(\'' + data[i].id + '\',\'' + reference + '\',\'' + id + '\',\'' + date + '\',\'' + montant + '\')">' + data[i].reference + '</li>';
            }
        }
        htmlins += '</ul></div>';
    }
    $(reference).after(htmlins);
}

//facturation liste des contrat

function AjoutHtmlAfterForDocAchatContrat(data, reference, id, date, montant, id_frs, id_libelle, id_ligne) {
//    alert(data[0].mnttc);
    $(".testul ul").css('width', $(reference).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
//    console.log($.trim(data) + data.length);
//    console.log(JSON.parse(data));

    if (data.length > 0) {
        htmlins = '<div class="testul">' +
//                '<ul id="ul_compte" style="z-index: 9;">';
                '<ul id="ul_compte" onkeydown="selectLiForDocAchatContrat(event)" style="z-index: 9;">';


        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                htmlins += '<li  id="li_' + data[i].id + '" class="selected_li" data-li="' + data[i].id + '" id1="' + reference + '" id2="' + id + '" id3="' + date + '" id4="' + montant + '" id5="' + id_frs + '" id6="' + id_libelle + '" id7="' + data[i].id_ligne + '" onclick="ClickSelectElementForDocAchatContrat(\'' + data[i].id + '\',\'' + reference + '\',\'' + id + '\',\'' + date + '\',\'' + montant + '\',\'' + id_frs + '\',\'' + id_libelle + '\',\'' + id_ligne + '\')">' + data[i].reference + '</li>';
            } else {
                htmlins += '<li  id="li_' + data[i].id + '" data-li="' + data[i].id + '" id1="' + reference + '" id2="' + id + '" id3="' + date + '" id4="' + montant + '" id5="' + id_frs + '" id6="' + id_libelle + '" id7="' + data[i].id_ligne + '" onclick="ClickSelectElementForDocAchatContrat(\'' + data[i].id + '\',\'' + reference + '\',\'' + id + '\',\'' + date + '\',\'' + montant + '\',\'' + id_frs + '\',\'' + id_libelle + '\',\'' + id_ligne + '\')">' + data[i].reference + '</li>';
            }
        }
        htmlins += '</ul></div>';
    }
    return htmlins;

//     $('#id_ligne').val(data[0].id_ligne);
//     $scope.AfficherlesTauxpourcentage();
}
function ClickSelectElementForDocAchat(object_id, reference, id, date, montant) {
    var valeur_reference = "";
    var valeur_date = "";
    var valeur_montant = "";
    for (i = 0; i < table.length; i++) {
        if (object_id - table[i].id === 0) {
            valeur_reference = table[i].reference;
            valeur_date = table[i].datecreation;
            valeur_montant = table[i].mntttc;
            break;
        }
    }
    if (reference)
        $(reference).val(valeur_reference);
    if (id)
        $(id).val(object_id);
    if (date)
        $(date).val(valeur_date);
    if (montant)
        $(montant).val(valeur_montant);

    $(".testul").remove();

}
function ClickSelectLigneContrat(object_id, id_ligne) {

    angular.element($("#li_" + object_id)).scope().AfficherlesTauxpourcentage(id_ligne, object_id);
}

function ClickSelectNumeroexterne(object_id) {
    console.log('id_ligne=' + object_id);
//    angular.element($('#li_' + object_id)).scope().Affichagenumeroexterne(object_id);
}
function ClickSelectElementForDocAchatContrat(object_id, reference, id, date, montant, id_frs, id_libelle, id_ligne) {
    var valeur_reference = "";
    var valeur_date = "";
    var valeur_montant = "";
    var id_fournisseur = "";
    var libelle_fournisseur = "";
    var valeur_idligne = "";
    for (i = 0; i < table.length; i++) {
        if (object_id - table[i].id === 0) {
            valeur_reference = table[i].reference;
            valeur_date = table[i].datecreation;
            valeur_montant = table[i].mntttc;
            id_fournisseur = table[i].id_frs;
            libelle_fournisseur = table[i].rs;
            valeur_idligne = table[i].id_ligne;
            break;
        }
    }
    if (reference)
        $(reference).val(valeur_reference);
    if (id)
        $(id).val(object_id);
    if (date)
        $(date).val(valeur_date);
    if (montant)
        $(montant).val(valeur_montant);
    if (id_frs)
        $(id_frs).val(id_fournisseur);
    if (id_libelle) {
        $(id_libelle).val(libelle_fournisseur);
        if (libelle_fournisseur)
            $(id_libelle).attr('readonly', 'true');
    }
    if (id_ligne)
        $(id_ligne).val(valeur_idligne);
    ClickSelectLigneContrat(object_id, valeur_idligne);
    $(".testul").remove();
//    AfficherlesTauxpourcentage();
}


//Début Document achat
function AjoutHtmlAfterForDocAchatFournisseur(data, reference, id, date, montant, id_frs, id_libelle) {
    $(".testul ul").css('width', $(reference).width());
    htmlins = '';
    table = data;
    $(".testul").remove();
    if (data.length > 0) {
        htmlins = '<div class="testul">' +
//                '<ul id="ul_compte" style="z-index: 9;">';
                '<ul id="ul_compte" onkeydown="selectLiForDocAchat(event)" style="z-index: 9;">';

        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                htmlins += '<li class="selected_li" data-li="' + data[i].id + '" id1="' + reference + '" id2="' + id + '" id3="' + date + '" id4="' + montant + '" id5="' + id_frs + '" id6="' + id_libelle + '" onclick="ClickSelectElementForDocAchatFournisseur(\'' + data[i].id + '\',\'' + reference + '\',\'' + id + '\',\'' + date + '\',\'' + montant + '\',\'' + id_frs + '\',\'' + id_libelle + '\')">' + data[i].reference + '</li>';
            } else {
                htmlins += '<li data-li="' + data[i].id + '" id1="' + reference + '" id2="' + id + '" id3="' + date + '" id4="' + montant + '" id5="' + id_frs + '" id6="' + id_libelle + '" onclick="ClickSelectElementForDocAchatFournisseur(\'' + data[i].id + '\',\'' + reference + '\',\'' + id + '\',\'' + date + '\',\'' + montant + '\',\'' + id_frs + '\',\'' + id_libelle + '\')">' + data[i].reference + '</li>';
            }
        }
        htmlins += '</ul></div>';
    }
    $(reference).after(htmlins);
}

function ClickSelectElementForDocAchatFournisseur(object_id, reference, id, date, montant, id_frs, id_libelle) {
    var valeur_reference = "";
    var valeur_date = "";
    var valeur_montant = "";
    var id_fournisseur = "";
    var libelle_fournisseur = "";
    for (i = 0; i < table.length; i++) {
        if (object_id - table[i].id === 0) {
            valeur_reference = table[i].reference;
            valeur_date = table[i].datecreation;
            valeur_montant = table[i].mntttc;
            id_fournisseur = table[i].id_frs;
            libelle_fournisseur = table[i].rs;
            break;
        }
    }
    if (reference)
        $(reference).val(valeur_reference);
    if (id)
        $(id).val(object_id);
    if (date)
        $(date).val(valeur_date);
    if (montant)
        $(montant).val(valeur_montant);
    if (id_frs)
        $(id_frs).val(id_fournisseur);
    if (id_libelle) {
        $(id_libelle).val(libelle_fournisseur);
        if (libelle_fournisseur)
            $(id_libelle).attr('readonly', 'true');
    }

    $(".testul").remove();
}

function selectLiForDocAchat(event) {
    highlighted = $(".testul ul li[class=selected_li]");
    switch (event.keyCode) {
        //Up
        case 38:
            if (highlighted && highlighted.prev().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.prev().addClass("selected_li");
            }
            break;
            //Down
        case 40:
            if (highlighted && highlighted.next().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.next().addClass("selected_li");
            }
            break;
            //Entrer
        case 13:
            if (highlighted) {
                var data_li = highlighted.attr('data-li');
                var id1 = highlighted.attr('id1');
                var id2 = highlighted.attr('id2');
                var id3 = highlighted.attr('id3');
                var id4 = highlighted.attr('id4');
                ClickSelectElementForDocAchat(data_li, id1, id2, id3, id4);
            }
            break;
            //ESC
        case 27:
            $(".testul").remove();
            break;
    }
}

function selectLiForDocAchatContrat(event) {
    highlighted = $(".testul ul li[class=selected_li]");
    switch (event.keyCode) {
        //Up
        case 38:
            if (highlighted && highlighted.prev().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.prev().addClass("selected_li");
            }
            break;
            //Down
        case 40:
            if (highlighted && highlighted.next().length > 0) {
                $(".selected_li").removeClass("selected_li");
                highlighted.next().addClass("selected_li");
            }
            break;
            //Entrer
        case 13:
            if (highlighted) {
                var data_li = highlighted.attr('data-li');
                var id1 = highlighted.attr('id1');
                var id2 = highlighted.attr('id2');
                var id3 = highlighted.attr('id3');
                var id4 = highlighted.attr('id4');
                ClickSelectElementForDocAchat(data_li, id1, id2, id3, id4);
            }
            break;
            //ESC
        case 27:
            $(".testul").remove();
            break;
    }
}
function ToFloatRound(variable) {
    var nb = parseFloat(variable);
    return nb.toFixed(3);
}
function precisionRound(number, precision) {
    var factor = Math.pow(10, precision);

    return Math.round(number * factor) / factor;
}
var chosen = "";
$(document).keydown(function (e) { // 38-up, 40-down
    var ul = $('.testul ul');
    if (ul.children().length > 0) {
        highlighted = $(".testul ul li[class=selected_li]");
        switch (event.keyCode) {
            //Up
            case 38:
                if (highlighted && highlighted.prev().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.prev().addClass("selected_li");
                }
                break;
                //Down
            case 40:
                if (highlighted && highlighted.next().length > 0) {
                    $(".selected_li").removeClass("selected_li");
                    highlighted.next().addClass("selected_li");
                }
                break;
                //Entrer
            case 13:
                if (highlighted) {
                    var data_li = highlighted.attr('data-li');
                    var id1 = highlighted.attr('id1');
                    var id2 = highlighted.attr('id2');
                    var id3 = highlighted.attr('id3');
                    var id4 = highlighted.attr('id4');
                    var id7 = highlighted.attr('id7')
                    if (id3 && id4)
                        ClickSelectElementForDocAchat(data_li, id1, id2, id3, id4);
                    else
                        ClickSelectElement(data_li, id1, id2)
                    if (id7) {
                        console.log(id7);
                        ClickSelectLigneContrat(data_li, id7);
                    }
                    console.log('id2' + id2 + 'data_li=' + data_li);
//                    if (id2)
                    ClickSelectNumeroexterne(data_li);


                }
                break;
                //ESC
            case 27:
                $(".testul").remove();
                break;
        }
    }

});