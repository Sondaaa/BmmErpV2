var domaineapp = "http://" + window.location.hostname + "/";
app.controller('myCtrlbudget', function ($scope, $http) {

    $scope.maxumum = 0;
    $scope.budgets = [];
    $scope.etatbudget = 1;
    $scope.iddetail = "";
    $scope.mntglobal = 0;
    //old_ordre : on l'utilise pour garder l'ancian ordre pour donner la possibilité de changer le numéro d'ordre par l'utilisateur
    $scope.old_ordre = "";

    $scope.InitialiserBudget = function () {
//        $('#budget').attr('style', 'width:100%');
//        $('#budget').trigger("chosen:updated");
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");

    }
    $scope.sorterFunc = function (ligne) {
        return parseInt(ligne.ligne_ordre);
    };
    $scope.InialiserChamps = function () {
        $('#ligprotitrub_nordre').focus();
        $('#ligprotitrub_nordre').val($scope.budgets.length + 1);
    }
    $scope.InialiserChampsTitres = function () {
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.AddSousDetailUp = function (ligne_ordre) {
        var msg = "Voulez vous que la rubriques ajoutée prend l'ordre : " + ligne_ordre + " ?";
        msg = msg + "<br>Si non, elle va prendre l'ordre " + parseInt(ligne_ordre - 1) + ".";
        msg = msg + " <span style='color:#c23434;'> => </span> Attention ! Si la rubrique d'ordre " + parseInt(ligne_ordre - 1) + " existe déjà elle va être remplacée !";

        bootbox.dialog({
            message: msg,
            buttons: {
                "success": {
                    "label": "Oui",
                    "className": "btn-sm btn-success",
                    "callback": function () {
                        $scope.goAddSousDetailUp(ligne_ordre);
                    }
                },
                "click": {
                    "label": "Non",
                    "className": "btn-sm btn-primary",
                    "callback": function () {
                        ligne_ordre = parseInt(ligne_ordre - 1);
                        $scope.goAddSousDetailUp(ligne_ordre);
                    }
                },
                "button": {
                    "label": "Annuler",
                    "className": "btn-sm"
                }
            }
        });
        //        bootbox.confirm({
        //            message: msg,
        //            buttons: {
        //                cancel: {
        //                    label: "Non",
        //                    className: "btn-sm",
        //                },
        //                confirm: {
        //                    label: "Oui",
        //                    className: "btn-primary btn-sm",
        //                }
        //            },
        //            callback: function (result) {
        //                if (result) {
        //                    $scope.goAddSousDetailUp(ligne_ordre);
        //                } else {
        //                    ligne_ordre = parseInt(ligne_ordre - 1);
        //                    $scope.goAddSousDetailUp(ligne_ordre);
        //                }
        //            }
        //        });
    }
    $scope.goAddSousDetailUp = function (ligne_ordre) {
        var comArr = eval($scope.budgets);
        for (var i = 0; i < comArr.length; i++) {
            if (parseInt(comArr[i].ligne_ordre) >= parseInt(ligne_ordre)) {
                var nordre = comArr[i].nordre;
                var til_existe = false;
                if (nordre[nordre.length - 1] == "'")
                    til_existe = true;
                nordre = parseInt(parseInt(nordre) + parseInt(1));
                if (til_existe) {
                    nordre = nordre + "'";
                    comArr[i].nordre = nordre.toString();
                } else
                    comArr[i].nordre = nordre;
                var new_ligne_ordre = parseInt(parseInt(comArr[i].ligne_ordre) + parseInt(1));
                comArr[i].ligne_ordre = new_ligne_ordre;

                var comSousArr = eval($scope.budgets[i].sousrubrique);
                for (var j = 0; j < comSousArr.length; j++) {
                    var sous_nordre = comSousArr[j].nordre;
                    var sous_nordre_Array = sous_nordre.split("-");
                    sous_nordre = parseInt(parseInt(sous_nordre_Array[0]) + parseInt(1)) + '-' + sous_nordre_Array[1];
                    comSousArr[j].nordre = sous_nordre.toString();
                }
            }
        }

        var sousrubrique = [];
        $scope.budgets.push({
            'ligne_ordre': ligne_ordre,
            'nordre': ligne_ordre.toString(),
            'designation': '',
            'mnt': 0,
            'nordre_s': '',
            'mntrubrique': 0,
            'sousrubrique': sousrubrique
        });
        $scope.$apply();
    }
    $scope.UpdateSousDetail = function (nordre) {
        var comArr = eval($scope.budgets);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].nordre === nordre) {
                $('#ligprotitrub_nordre').val(comArr[i].nordre);
                $('#ligprotitrub_code').val(comArr[i].code);
                $('#rubrique').val(comArr[i].designation);
                $('#ligprotitrub_mnt').val(comArr[i].mnt);
                $scope.old_ordre = comArr[i].nordre;
                break;
            }
        }
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
    $scope.AfficheSousDetailPrix = function (id) {
        $scope.iddetail = id;
        $scope.param = {
            'idlot': id
        }
        $http({
            url: domaineapp + 'budget.php/titrebudjet/Affichesousdetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.sousdetail.length > 0)
                $scope.budgets = data.sousdetail;
            $scope.etatbudget = data.etat;
            $scope.InialiserTableau();
            $scope.CalculerDetailPrix();
            $scope.mntglobal = $('#mnt').val();
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.Inialisation = function (id_user) {

        $('#titrebudjet_id_user').val(id_user);
        $('#titrebudjet_id_user').trigger("chosen:updated");

    }


    $scope.ValiderChoixDisponible = function (iddoc) {
        if ($('#numeroengaement').val()) {
            var id = $('#budget_avis_id').val();
            $('#check1_' + id).attr('checked', true);
            $('#check1_' + id).attr('class', 'disabledbutton');
            if (id == '7') {
                $('#details_budget').val($('#budget option:selected').text().trim());
                $('#details_rubrique').val($('#rubrique').val());
                $('#details_reliquat').val($('#reliq').val());
                $('#zone_avis_budgetaire').fadeIn();
            }

            $('#btn_enoyer-avis').show();

            $scope.param = {
                'valip': 1,
                'id': id,
                'reliquat': parseFloat($('#reliq').val()),
                'id_ligprotitub': $('#numeroengaement').val(),
                'iddoc': iddoc
            }
            $http({
                url: domaineapp + '/budget.php/documentachat/Validerligne',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: data,
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur");
            });
        } else {
            bootbox.dialog({
                message: "Avis budgétaire non affecté ! Veuillez choisir la rubrique budgétaire.",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    //__________________________________________________________________________Recherche article by code ou designation
    $scope.AjouterSousSousRubrique = function (idligne, action) {
        var id = idligne.replace("'", "0000");
        console.log('idligne=' + idligne);
        var reste = 0;
        var idligne_total = 0;
        if ($('#restemnt').val() !== "")
            reste = $('#restemnt').val();
        var ligne = 0;

        if (action == 0) {
            if ($("#mnt_sousrubrique_" + id).val() != "")
                ligne = $("#mnt_sousrubrique_" + id).val();
        } else {
            if ($("#mnts_sousrubrique_" + id).val() != "") {
                if ($("#hidden_mnts_sousrubrique_" + id).val() != "")
                    reste = parseFloat(reste) + parseFloat($("#hidden_mnts_sousrubrique_" + id).val());
                ligne = parseFloat($("#mnts_sousrubrique_" + id).val());
            }
        }

        var ttcnet = parseFloat(reste).toFixed(3) - parseFloat(ligne).toFixed(3);
        if (ttcnet < 0) {
            bootbox.dialog({
                message: "Attention !<br> Vous avez dépasser le reste du montant budgétaire : " + reste + " TND.",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            return;
        }

        var position = -1;
        for (var j = 0; j < $scope.budgets.length; j++) {
            console.log($scope.budgets[j].nordre.toString().trim() + '===' + idligne + "compare:" + $scope.budgets[j].nordre.toString().trim().localeCompare(idligne));
            if ($scope.budgets[j].nordre.toString().trim().localeCompare(idligne) === 0) {
                position = j;
                break;
            }
        }

        //        console.log('position:' + position);
        //        if (position != -1)
        //        {
        var conteur = 0;
        for (var j = 0; j < $scope.budgets.length; j++) {
            var comArr = eval($scope.budgets[j].sousrubrique);
            for (var i = 0; i < comArr.length; i++) {
                var def = 0;
                console.log('Action:' + action);
                if (action === 0) {
                    def = $('#txt_nordre_' + id).val().trim();
                } else {
                    //                    var id_sous = comArr[i].nordre;
                    def = $('#txts_nordre_' + id).val().trim();
                }
                var sous_nordre = comArr[i].nordre.replace('0000', "'");
                console.log(def + '===' + sous_nordre);
                if (def === sous_nordre) {
                    var idligne_total = $scope.budgets[j].nordre;
                    if (action === 1) {
                        console.log('Test valide');
                        //var id_sous = comArr[i].nordre;
                        //var id_sous;
                        comArr[i].nordre = $('#txts_nordre_' + id).val().trim();
                        comArr[i].code = $('#txts_code_' + id).val().trim();
                        comArr[i].designation = $('#txts_sousrubrique_' + id).val();
                        comArr[i].mnt = $('#mnts_sousrubrique_' + id).val();
                        comArr[i].nordre_s = $('#txts_nordre_rubrique_' + id).val();
                    } else {
                        comArr[i].nordre = $('#txt_nordre_' + id).val().trim();
                        comArr[i].code = $('#txt_code_' + id).val().trim();
                        comArr[i].designation = $('#txt_sousrubrique_' + id).val();
                        comArr[i].mnt = $('#mnt_sousrubrique_' + id).val();
                        comArr[i].nordre_s = $('#txt_nordre_rubrique_' + id).val();
                    }
                    conteur = 1;
                    break;
                }
            }
        }
        if (conteur == 0) {
            var idligne_total = $scope.budgets[position].nordre;
            $scope.budgets[position].sousrubrique.push({
                'idligne': "",
                'nordre': $('#txt_nordre_' + id).val(),
                'code': $('#txt_code_' + id).val(),
                'designation': $('#txt_sousrubrique_' + id).val(),
                'mnt': $('#mnt_sousrubrique_' + id).val(),
                'nordre_s': id
            });
        }

        $scope.CalculerTotalRubrique(idligne_total);
        //        $scope.CalculerTotalRubrique(idligne);
        //        }
        $scope.InialiserSousRubrique(id);
        $scope.CalculerDetailPrix();
        //        }
    }
    $scope.verifDesignation = function () {
        var trouve = 0;
        var comArr = eval($scope.budgets);
        for (var i = 0; i < comArr.length; i++) {
            //            var def = parseFloat(comArr[i].nordre) - parseFloat($('#ligprotitrub_nordre').val());
            var def = parseFloat(comArr[i].nordre) - parseFloat($scope.old_ordre);
            if ((comArr[i].designation.trim() === $('#rubrique').val().trim() || comArr[i].code.trim() === $('#ligprotitrub_code').val().trim()) && def != 0) {
                trouve = 1;
                break;
            }
        }
        return trouve;
    }
    $scope.GestionAlert = function () {
        var msg = "";
        if ($scope.verifDesignation() != 0) {
            msg += "<li> Rubrique et/ou code existe déjà</li>";
        }
        if ($scope.VerifUpdate($('#ligprotitrub_mnt').val(), $('#ligprotitrub_nordre').val()) < 0)
            msg += "<li> Le budget a été dépassé</li>";
        if ($('#ligprotitrub_nordre').val() === "")
            msg += "<li> Il faut remplir l'ordre du rubrique.</li>";
        if ($('#ligprotitrub_code').val() === "")
            msg += "<li> Il faut remplir le code du rubrique.</li>";

        if (msg != '')
            msg = "<span style='margin-left:20px;'>Attention : </span><ul style='margin-left:160px;'>" + msg + "</ul>";

        return msg;
    }
    $scope.AjouterSousdetailPrix = function () {
        //        var reste = 0;
        //        if ($('#restemnt').val() !== "")
        //            reste = $('#restemnt').val();
        //        var ligne = 0;
        //        if ($("#ligprotitrub_mnt").val() != "")
        //            ligne = $("#ligprotitrub_mnt").val();
        //        var ttcnet = parseFloat(reste).toFixed(3) - parseFloat(ligne).toFixed(3);
        $scope.maxumum = $scope.budgets.length + 1;
        var conteur = 0;
        var comArr = eval($scope.budgets);
        var msg = $scope.GestionAlert();
        if (msg === "") {
            for (var i = 0; i < comArr.length; i++) {
                //                var def = parseFloat(comArr[i].nordre) - parseFloat();
                //                console.log(comArr[i].nordre +'==='+ $('#ligprotitrub_nordre').val().trim());
                //                if (comArr[i].nordre === $('#ligprotitrub_nordre').val().trim()) {
                if (comArr[i].nordre === $scope.old_ordre) {
                    comArr[i].ligne_ordre = parseFloat($('#ligprotitrub_nordre').val().trim());
                    comArr[i].nordre = $('#ligprotitrub_nordre').val().trim();
                    comArr[i].designation = $('#rubrique').val();
                    comArr[i].mnt = $('#ligprotitrub_mnt').val();
                    comArr[i].code = $('#ligprotitrub_code').val();
                    conteur = 1;
                    break;
                }
            }
            //            console.log('conteur:'+conteur);
            if (conteur == 0) {
                var sousrubrique = [];
                var mnt_rubrique = 0;
                if ($('#ligprotitrub_mnt').val() != "")
                    mnt_rubrique = parseFloat($('#ligprotitrub_mnt').val());

                var ligne_ordre = $('#ligprotitrub_nordre').val().trim().replace("'", "");

                $scope.budgets.push({
                    'idligne': "",
                    'ligne_ordre': ligne_ordre,
                    'nordre': $('#ligprotitrub_nordre').val().trim(),
                    'code': $('#ligprotitrub_code').val().trim(),
                    'designation': $('#rubrique').val(),
                    'mnt': mnt_rubrique.toFixed(5),
                    'nordre_s': '',
                    'mntrubrique': 0,
                    'sousrubrique': sousrubrique
                });

                //                var item = {
                //                    'ligne_ordre': ligne_ordre,
                //                    'nordre': $('#ligprotitrub_nordre').val().trim(),
                //                    'designation': $('#rubrique').val(),
                //                    'mnt': mnt_rubrique.toFixed(5),
                //                    'nordre_s': '',
                //                    'mntrubrique': 0,
                //                    'sousrubrique': sousrubrique
                //                }
                //
                //                $scope.budgets.splice(0, 0, item);
                //                $scope.$apply();
            }
            $scope.CalculerDetailPrix();
            $scope.InialiserTableau();
            $('#ligprotitrub_nordre').focus();
        } else {
            bootbox.dialog({
                message: msg,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.InialiserNordreSousRubrique = function (id) {
        $scope.InialiserSousRubrique(id);
    }
    $scope.VerifUpdate = function (mntajouter, numero_rubrique) {
        var ttcnet = 0;
        var totalligne = 0;
        var reste = 0;
        if ($('#mnt').val() && $('#mnt').val() != "") {
            ttcnet = $('#mnt').val();
            for (i = 0; i < $scope.budgets.length; i++) {
                console.log($scope.budgets[i].nordre + '!=' + numero_rubrique);
                if ($scope.budgets[i].mnt && $scope.budgets[i].mnt != "" && $scope.budgets[i].mnt > 0 && $scope.budgets[i].nordre != numero_rubrique) {
                    {
                        totalligne += parseFloat($scope.budgets[i].mnt);
                        console.log(totalligne);
                    }
                }
            }
            reste = parseFloat(parseFloat(ttcnet) - (parseFloat(totalligne) + parseFloat(mntajouter)));
        }
        console.log(reste);
        return parseFloat(reste);
    }
    $scope.CalculerDetailPrix = function () {

        var restettc = 0;
        var totalligne = 0;
        var totalttc_ligne = 0;
        var ttcnet = 0;
        if ($('#mnt').val() != "")
            ttcnet = $('#mnt').val();
        for (i = 0; i < $scope.budgets.length; i++) {
            //            var tab = $scope.budgets[i].sousrubrique;
            totalligne = 0;
            if ($scope.budgets[i].mnt && $scope.budgets[i].mnt != "" && $scope.budgets[i].mnt > 0)
                totalligne += parseFloat($scope.budgets[i].mnt);
            //
            ////            for (var j = 0; j < tab.length; j++) {
            ////                totalligne += parseFloat(tab[j].mnt);
            ////            }
            //            if (totalligne) {
            $scope.budgets[i].mntrubrique = totalligne.toFixed(3);
            $scope.budgets[i].mnt = totalligne.toFixed(3);
            totalttc_ligne = parseFloat(totalttc_ligne) + parseFloat(totalligne);
            //            }
        }

        restettc = ttcnet - parseFloat(totalttc_ligne);
        if (restettc >= 0)
            $('#restemnt').val(parseFloat(restettc).toFixed(3));
        if (restettc == 0)
            $('#restemnt').val(parseFloat(0).toFixed(3));
    }

    $scope.InialiserTableau = function () {
        //        var tab = eval($scope.budgets);
        //        var numero_ordre_seq = 1;
        //        var max = 0;
        //        var leng = tab.length;
        //        max = leng;
        //        if (max === 0)
        //            max = 1;
        //        else
        //            max = parseFloat(max) + 1;
        //        $scope.maxumum = max;
        $('#ligprotitrub_nordre').val("");
        $('#ligprotitrub_code').val("");
        $('#rubrique').val("");
        $('#ligprotitrub_mnt').val("");
        //        for (var i = 0; i < tab.length; i++) {
        //            tab[i].nordre = numero_ordre_seq;
        //            if (tab[i].sousrubrique.length > 0) {
        //                var tab_sous = tab[i].sousrubrique;
        //                for (var j = 0; j < tab_sous.length; j++) {
        //                    var entiere = parseFloat(tab_sous[j].nordre) - parseFloat(Math.floor(tab_sous[j].nordre));
        //                    tab_sous[j].nordre = parseFloat(Math.floor(tab[i].nordre) + entiere).toFixed(2);
        //                    tab_sous[j].nordre_s = parseFloat(Math.floor(tab[i].nordre)).toFixed(2)
        //
        //                }
        //            }
        //            numero_ordre_seq++;
        //        }
    }
    $scope.InialiserSousRubrique = function (id) {
        var position = -1;
        //id=id.replace('0000',"'");
        var id1 = id.replace('0000', "'");
        console.log("id=" + id + 'id1=' + id1);
        $("#txt_nordre_" + id).val("");
        $("#txt_code_" + id).val("");
        $("#txt_sousrubrique_" + id).val("");
        $("#mnt_sousrubrique_" + id).val("");
        for (var j = 0; j < $scope.budgets.length; j++) {
            var nordre_relpace = $scope.budgets[j].nordre.toString().replace("'", "0000");
            console.log("compare:" + nordre_relpace + '===' + id);
            if (nordre_relpace.localeCompare(id) === 0) {
                position = j;
                break;
            }
        }
        console.log('position:' + position);
        if (position != -1) {
            var tab = $scope.budgets[position].sousrubrique;
            var max = tab.length;

            if (max > 0) {

                max += 1;
                max = id1 + '-' + max;
            } else
                max = id1 + '-' + 1;
            console.log("max:" + max);

            $("#txt_nordre_" + id).val(max);
            $("#txt_code_" + id).val("");
            console.log($("#txt_nordre_" + id).val());
            $("#txt_sousrubrique_" + id).val("");
            console.log($("#txt_sousrubrique_" + id).val());
            $("#mnt_sousrubrique_" + id).val("");
            console.log($("#mnt_sousrubrique_" + id).val());
        }
    }

    $scope.DeletesousDetail = function (nordre, idligne) {
        var conteur = -1;
        var comArr = eval($scope.budgets);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].nordre === nordre.trim()) {
                conteur = i;
                break;
            }
        }

        if (conteur != -1) {
            if (idligne && idligne != "")
                $scope.DeleteParBase(idligne);
        }

        $scope.budgets.splice(conteur, 1);

        $scope.InialiserTableau();
        $scope.CalculerDetailPrix();
    }

    $scope.DeleteParBase = function (idsousdetail) {
        $scope.param = {
            'idsousdetail': idsousdetail
        }
        $http({
            url: domaineapp + 'budget.php/titrebudjet/Deletesousdetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

        }, function myError(response) {
            alert(response);
        });
    }

    $scope.verifCodeVide = function () {
        var vide = 0;
        var comArr = eval($scope.budgets);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].code.trim() === "") {
                vide = 1;
                break;
            }
        }
        return vide;
    }

    $scope.ValiderSousDetail = function (id, idtype) {
        if ($scope.verifCodeVide() === 1 && idtype > 1) {
            bootbox.dialog({
                message: 'Veuillez saisir tout les codes des rubriques et/ou sous rubriques budgétaires !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        } else {
            var msg = "";
            if (idtype === 1)
                msg = "Voulez-vous enregistrer cette fiche budget ?";
            if (idtype === 3)
                msg = "Voulez-vous valider cette fiche budget ?";
            if (idtype === 2)
                msg = "Voulez-vous valider et fermer cette fiche budget ?";

            bootbox.confirm({
                message: msg,
                buttons: {
                    cancel: {
                        label: "Non",
                        className: "btn-sm",
                    },
                    confirm: {
                        label: "Oui",
                        className: "btn-primary btn-sm",
                    }
                },
                callback: function (result) {

                    if (result) {
                        $scope.goValiderSousDetail(id, idtype);
                    }
                }
            });
        }
    }

    $scope.goValiderSousDetail = function (id, idtype) {

        $scope.param = {
            'sousdetail': $scope.budgets,
            'idtype': idtype,
            'idbudget': id
        }
        $http({
            url: domaineapp + 'budget.php/titrebudjet/Savesousdetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            $scope.AfficheSousDetailPrix(id);
            bootbox.dialog({
                message: 'Mise à jour effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }, function myError(response) {
            alert('Erreur');
        });
    }

    $scope.CalculerTotalRubrique = function (id) {
        id = Math.floor(id);
        var mnttotal = 0;
        var position = -1;

        for (var j = 0; j < $scope.budgets.length; j++) {
            if (Math.floor($scope.budgets[j].nordre) === id) {
                position = j;
                break;
            }
        }

        if (position != -1) {
            var tab = $scope.budgets[position].sousrubrique;
            for (var i = 0; i < tab.length; i++) {
                mnttotal += parseFloat(tab[i].mnt);
            }
            //            $scope.budgets[position].mntrubrique = parseFloat(mnttotal).toFixed(5);
            $scope.budgets[position].mnt = parseFloat(mnttotal).toFixed(5);
        }
    }
    $scope.UpdateSousRubrique = function (sous_r, desination, mnt) {
        var numero_rubrique = Math.floor(sous_r);
        if ($scope.VerifUpdate(mnt, numero_rubrique) >= 0) {
            $('#my-modal_' + numero_rubrique).addClass("in");
            $('#my-modal_' + numero_rubrique).attr("style", 'display: block;"');
            $('#txt_nordre_' + numero_rubrique).val(sous_r);
            $('#txt_sousrubrique_' + numero_rubrique).val(desination);
            $('#mnt_sousrubrique_' + numero_rubrique).val(mnt);
        } else {
            bootbox.dialog({
                message: 'Vous avez dépasser le montant global du budget !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.DeleteSousRubrique = function (nordre, idligne) {
        var conteur = -1;
        // idligne=idligne.replace("0000","'");
        //        console.log('idligne:' + idligne);
        var tab = [];
        var comArr = eval($scope.budgets);
        //        var numero_ordre = nordre.replace('0000', "'");
        for (var i = 0; i < comArr.length; i++) {
            //            console.log('NumeroOrdre:' + numero_ordre + "Table.nordre:" + comArr[i].nordre);
            //            if (numero_ordre.localeCompare(comArr[i].nordre) === 0)
            //            {
            tab = comArr[i].sousrubrique;
            for (var j = 0; j < tab.length; j++) {
                nordre = nordre.replace("0000", "'");
                //                console.log('sous ordre:' + nordre + "===" + tab[j].nordre);
                var def = nordre.localeCompare(tab[j].nordre);
                if (def === 0) {
                    conteur = j;
                    break;
                }
            }
            if (conteur != -1)
                break;
            //            }
        }

        //        console.log('Position:' + conteur);
        if (conteur != -1 && tab.length > 0) {
            if (idligne && idligne != "")
                $scope.DeleteParBase(idligne);
            tab.splice(conteur, 1);
            $scope.RenisaliserSousRubrique(tab, nordre);
        }
        $scope.CalculerDetailPrix();
    }

    $scope.RenisaliserSousRubrique = function (tab, base_numero_ordre) {
        var numero_ordre_seq = base_numero_ordre + 0.1;
        //        for (var i = 0; i < tab.length; i++) {
        //            tab[i].nordre = numero_ordre_seq;
        //            numero_ordre_seq = numero_ordre_seq +"-"+1;
        //        }
    }

    //*****   Function Montant encaissé
    $scope.ValiderMntEncaisser = function (idligne, li_id) {
        var mnt_encaiser = $('#' + li_id + idligne).val();
        $scope.param = {
            'idligne': idligne,
            'mnt_encaisser': mnt_encaiser
        }
        $http({
            url: domaineapp + 'budget.php/ligprotitrub/Savemntencaisser',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: data,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            //window.location.reload();
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.CalculPourcentage = function (idpar) {
        $scope.mntglobal = $('#mnt').val() - $('#chaine_idp').val();
        var mntencaisser = $('#mnt_tr_' + idpar).val();
        console.log(mntencaisser + $scope.mntglobal);
        var pourcentage = ((parseFloat(mntencaisser) + $scope.mntglobal) / $('#mnt').val()) * 100;
        if (pourcentage <= 100) {
            $('#mnt_pour_ence_' + idpar).val(pourcentage.toFixed(2));
        } else {
            bootbox.dialog({
                message: 'Vous avez dépassé le montant global !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            $('#mnt_tr_' + idpar).val('');
            $('#mnt_pour_ence_' + idpar).val('');
        }
    }
    $scope.CalculMntParPourcentage = function (idpar) {

        var mntglobal = $('#mnt').val();
        var pourcentage = $('#mnt_pour_ence_' + idpar).val();
        var mntencaisser = mntglobal * (pourcentage / 100);

        if (mntencaisser <= mntglobal) {
            $('#mnt_tr_' + idpar).val(parseFloat(mntencaisser));
        } else {
            bootbox.dialog({
                message: 'Vous avez dépassé le montant global !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            $('#mnt_tr_' + idpar).val('');
            $('#mnt_pour_ence_' + idpar).val('');

        }
    }
    $scope.ValiderMntEncaisserPourcentage = function (id, idpara) {
        var mnt_encaiser = $('#mnt_pour_ence_' + idpara).val();
        var date_encaiser = $('#date_tran_' + idpara).val();
        var mnt = $('#mnt_tr_' + idpara).val();
        var alimentation_id = $('#alimentation_tranche').val();
        $scope.param = {
            'id': id,
            'mnt_encaisser': mnt_encaiser,
            'mnt_tr': mnt,
            'date': date_encaiser,
            'id_para_tr': idpara,
            'alimentation_id': alimentation_id,
        }
        if (date_encaiser && mnt) {
            $http({
                url: domaineapp + 'budget.php/ligprotitrub/Savemntencaisserpourcentage',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: data,
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur ....");
            });
        } else {
            bootbox.dialog({
                message: 'Veuillez remplir tous les champs !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.AlimenterRubriques = function (id) {
        if (parseFloat($('#montant_encaisse_rubrique_reste').val()) == 0) {
            var idpara = $('#idpara_tranche').val();
            var mnt_encaiser = $('#mnt_pour_ence_' + idpara).val();
            var date_encaiser = $('#date_tran_' + idpara).val();
            var mnt = $('#mnt_tr_' + idpara).val();
            var alimentation_id = $('#alimentation_tranche').val();

            var rubrique_id = '';
            var montants = '';

            $('input[nature="montant"]').each(function () {
                if ($(this).val() != '') {
                    rubrique_id = rubrique_id + $(this).attr('ligne_id') + ',';
                    montants = montants + $(this).val() + ';';
                }
            });

            if (rubrique_id != '') {
                $scope.param = {
                    'id': id,
                    'mnt_encaisser': mnt_encaiser,
                    'mnt_tr': mnt,
                    'date': date_encaiser,
                    'id_para_tr': idpara,
                    'alimentation_id': alimentation_id,
                    'rubrique_id': rubrique_id,
                    'montants': montants,
                }
                if (date_encaiser && mnt) {
                    $http({
                        url: domaineapp + 'budget.php/ligprotitrub/Savemntencaisserpourcentage',
                        method: "POST",
                        data: $scope.param,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        data = response.data;
                        bootbox.dialog({
                            message: data,
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        window.location.reload();
                    }, function myError(response) {
                        alert("Erreur ....");
                    });
                } else {
                    bootbox.dialog({
                        message: 'Veuillez remplir tous les champs !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
            } else {
                bootbox.dialog({
                    message: 'Veuillez remplir au moin un encaissement !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        } else {
            bootbox.dialog({
                message: "Veuillez vérifier les montants d'encaissement !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    /****** attachement document budget scanner  ***********/
    $scope.ValiderAttachementDocument = function (idbudget, titre) {
        var file_data = document.getElementById('piecejoint_chemin');
        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        $.ajax({
            url: '../Uploaderfile', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {
                alert(php_script_response); // display response from the PHP script, if any
                window.location.reload();
            }
        });
    }
    $scope.ValiderAttachementDocumentTransfert = function (idtransfert, titre) {
        var file_data = document.getElementById('piecejoint_chemin');
        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        form_data.append('idtransfert', idtransfert);
        form_data.append('titre', titre);
        $.ajax({
            url: '../Uploaderfile', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {
                alert(php_script_response); // display response from the PHP script, if any
                window.location.reload();
            }
        });
    }

    /***** Avis Budgétaire ******/
    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].nordre + " : " + data[i].libelle + " Mnt:" + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.InialiserCombo = function (table, id) {
        $scope.param = {
            'table': table,
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/AffichesourceParentOrFils',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (table == "titrebudjet") {
                $scope.ChargerCombo('#numeroengaement', data);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    //Création budget definitif
    $scope.getCodeRubrique = function (id, id2) {
        if ($(id).val() != '') {
            $scope.param = {
                "code": $(id).val()
            }
            $http({
                url: domaineapp + 'controlegestion.php/titrebudjet/getCodeRubrique',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                AjoutHtmlAfterTRansfert(data, id, id2, "#_");
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $(id2).val('');
        }
    }

    $scope.getLibelleRubrique = function (id, id2) {
        if ($(id).val() != '') {
            $scope.param = {
                "libelle": $(id).val()
            }
            $http({
                url: domaineapp + 'controlegestion.php/titrebudjet/getLibelleRubrique',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                AjoutHtmlAfterTRansfert(data, id, id2, "#_");
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $(id2).val('');
        }
    }
    $scope.ChangerPrototype = function (id_origine, id_categorie) {
        $('#prototypebudget_titre').html('');
        $('#prototypebudget_titre').trigger("chosen:updated");
        $scope.param = {
            'id_origine': id_origine,
            'id_categorie': id_categorie
        }
        $http({
            url: domaineapp + 'controlegestion.php/titrebudjet/getPrototypeByOrigineAndCategorie',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#prototypebudget_titre').append(data);
            $('#prototypebudget_titre').trigger("chosen:updated");

        }, function myError(response) {
            console.log("Erreur de chargement ....");
        });
    }
    $('#titrebudjet_id_source').change(function () {
        id_source = parseInt($('#titrebudjet_id_source').val());
        id_categorie = parseInt($('#titrebudjet_id_cat').val());
        if (Number.isInteger(id_source) && Number.isInteger(id_categorie)) {
            $scope.ChangerPrototype(id_source, id_categorie);
        }

    }).trigger('change');
    $('#titrebudjet_id_cat').change(function () {
        id_source = parseInt($('#titrebudjet_id_source').val());
        id_categorie = parseInt($('#titrebudjet_id_cat').val());
        if (Number.isInteger(id_source) && Number.isInteger(id_categorie)) {
            $scope.ChangerPrototype(id_source, id_categorie);
        }

    }).trigger('change');
    $('#budget')
            .change(function () {
                if ($("#budget").val() && $("#budget").val() != "0") {
                    var id = $("#budget").val();
                    $scope.InialiserComboBudgetEngagement('titrebudjet', 'liste_rubrique', id, null);
                    // $scope.InialiserCombo('titrebudjet', id);
                } else {
                    data = '';
                    $scope.ChargerCombo('#numeroengaement', data);
                    $scope.detailbudget = '';
                    $('#rubrique').val('');
                    $('#mnt').val('');
                    $('#credit').val('');
                    $('#reliq').val('');
                }
            })
            .trigger("change");
    $scope.ChargerComboBudgetDocument = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {

            $(id).append("<option code='" + data[i].code + "' value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " => Mnt : " + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.InialiserComboBudgetEngagement = function (table, rubrique, id_titre, id_rubrique) {

        $scope.param = {
            'table': table,
            'id': id_titre,
            'rubrique': rubrique
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichesource',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            console.log('length=' + data.length);
            if (table == "titrebudjet") {
                if (rubrique === 'liste_rubrique')
                    $('#div_select').html('');
                if (data.length > 0) {
                    $('#div_select').append('<select id="' + rubrique + '"></select><br>');

                    $scope.ChargerComboBudgetDocument('#' + rubrique, data);


                }

                if (id_rubrique && data.length === 0) {
                    $("#" + rubrique).val(id_rubrique);
                    $('#' + rubrique).trigger("chosen:updated");
                    $scope.ChargerNordre(id_rubrique);
                }

                $("#" + rubrique)
                        .change(function () {
                            if ($("#" + rubrique).val() && $("#" + rubrique).val() != "") {

                                id_rubrique = $("#" + rubrique).val();
                                if (data.length > 0) {
                                    if (rubrique === 'liste_rubrique') {
                                        $('#' + rubrique).nextAll('select').remove();

                                        $('#mnt').val('');
                                        $('#credit').val('');
                                        $('#reliq').val('');
                                    }

                                    $scope.InialiserComboBudgetEngagement(table, $("#" + rubrique + ' option:selected').attr('code'), id_titre, id_rubrique)

                                } else {
                                    $("#" + rubrique).val(id_rubrique);
                                    $('#' + rubrique).trigger("chosen:updated");
                                    $scope.ChargerNordre(id_rubrique);

                                }
                            }
                        })
                        .trigger("change");

                // $scope.ChargerNordre(id_rubrique);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });

    }
    // $("#numeroengaement")
    //     .change(function() {
    //         if ($("#numeroengaement").val() && $("#numeroengaement").val() != "") {
    //             $scope.ChargerNordre($("#numeroengaement").val());
    //         }
    //     })
    //     .trigger("change");
    $scope.ChargerNordre = function (id) {
        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {

                $scope.detailbudget = data[0];
                var mntengage = 0;
                if ($scope.detailbudget.mntengage)
                    mntengage = $scope.detailbudget.mntengage;
                $('#rubrique').val($scope.detailbudget.libelle);
                $('#mnt').val(parseFloat($scope.detailbudget.mnt).toLocaleString());
                $('#credit').val(parseFloat(mntengage).toLocaleString());
//                $('#numeroengaement').val(id);
                $('#id_budget').val($scope.detailbudget.id);
                $('#numeroengaement').val($scope.detailbudget.id);
                var reliq = parseFloat($scope.detailbudget.mnt) - parseFloat(mntengage);
                $('#reliq').val(parseFloat(reliq).toLocaleString());
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    //Visa d'achat
    $("#etat_visa")
            .change(function () {
                if ($("#etat_visa").val() && $("#etat_visa").val() != "") {
                    if ($("#etat_visa").val() != "1") {
                        $('#motif').val('');
                        $('#zone_motif').show();
                    } else {
                        $('#zone_motif').hide();
                    }
                } else {
                    $('#zone_motif').hide();
                }
            })
            .trigger("change");

    //__________________________________________________________________________Function ajouter visa doc achat
    $scope.AjouterVisa = function (iddoc) {
        if ($('#etat_visa').val() != '' && $('#visaid').val() != '0') {
            var idvisa = 0;
            if ($('#visaid').val())
                idvisa = $('#visaid').val();
            datejour = new Date();
            if ($('#datevisa').val() && $('#datevisa').val() != "") {
                datejour = $('#datevisa').val();
            }
            etatvisa = $('#etat_visa').val();

            $scope.param = {
                'iddoc': iddoc,
                'idvisa': idvisa,
                'datevisa': datejour,
                'etatvisa': etatvisa,
                'motif': $('#motif').val()
            };
            $http({
                url: domaineapp + '/achats.php/documentachat/Ajoutervisa',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.visadonnees = data;
                $('#zone_visa').hide();
                window.location.reload(window);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            bootbox.dialog({
                message: "Veuillez affecter une visa d'achat et/ou déterminer l'état du visa !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    //Check if budget global exist
    $scope.CheckBudgetGlobal = function (id_categorie, url) {
        $scope.param = {
            id_categorie: id_categorie
        }
        $http({
            url: domaineapp + 'controlegestion.php/budgetprevglobal/checkbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            if (data.id_budget) {
                document.location.href = url + '/' + data.id_budget + '/edit';
            } else
                $('input:submit').removeClass('disabledbutton');


        }, function myError(response) {
            console.log(response);
        });
    }
    $("#categorie_global").change(function () {

        if ($("#categorie_global").val()) {
            $scope.CheckBudgetGlobal($("#categorie_global").val(), $("#categorie_global").attr('url_link'))
        }
    })
    //fin check function dudget global exist


});
app.controller('myCtrlTransfertbudget', function ($scope, $http) {
    $scope.listesBudgetSource = [];
    $scope.listesBudgetDestination = [];
    $('.sf_admin_action_save').addClass('disabledbutton');
    $scope.InitialiseSelectedValue = function () {
        if ($('#budget_source_value').val() != '') {
            $("#budget").val($('#budget_source_value').val());
            var id = $("#budget").val();
            $scope.InialiserCombo('titrebudjet', id, '#numeroengaement_source', '#budget');
        }
        if ($('#budget_destination_value').val() != '') {
            $("#budgetdestination").val($('#budget_destination_value').val());
            var id = $("#budgetdestination").val();
            $scope.InialiserCombo('titrebudjet', id, '#numeroengaementdestination', "#budgetdestination");
        }
        $scope.VerifAjout();
    }
    $scope.VerifAjout = function () {
        if ($('#transfertbudget_mnttransfert').val() != "" && $('#transfertbudget_datecreation').val() && $('#transfertbudget_id_typetransfert').val() != "" && $('#transfertbudget_id_destination').val() != "")
            $('.sf_admin_action_save').removeClass('disabledbutton');
    }
    $('#transfertbudget_datecreation')
            .change(function () {
                $scope.VerifAjout();
            })
    $scope.VerifierMontant = function () {
        if ($('#maxtransfert').val() && $('#maxtransfert').val() != "") {
            var mnt = $('#maxtransfert').val() - $('#transfertbudget_mnttransfert').val();
            console.log('Mnt=' + mnt);
            if (mnt < 0) {
                bootbox.dialog({
                    message: 'Vous avez dépasser le montant !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                $('#transfertbudget_mnttransfert').val("");
            }
        }
        $scope.VerifAjout();
    }
    $("#transfertbudget_id_source")
            .change(function () {
                if ($("#transfertbudget_id_source").val() != "") {
                    $('#transfertbudget_sourcebudget').attr('style', 'display:none');
                    $('#label_source').attr('style', 'display:none');
                    // $('#transfertbudget_id_source').attr('style', 'display:block');
                    $('#transfertbudget_id_source_chosen').attr('style', 'display:block');
                    $('#label_sourceinterne').attr('style', 'display:block');
                }
            })
            .trigger("change");
    $scope.AfficheSourceExterne = function () {
        console.log("avant" + $('#transfertbudget_sourcebudget').val());
        if ($('#transfertbudget_sourcebudget').val() != "") {
            console.log("debut" + $('#transfertbudget_sourcebudget').val());
            //  $('#transfertbudget_id_source').attr('style', 'display:none');
            $('#transfertbudget_id_source_chosen').attr('style', 'display:none');
            $('#row_budget').attr('style', 'display:none');

            $('#label_sourceinterne').attr('style', 'display:none');
            $('#transfertbudget_sourcebudget').attr('style', 'display: block;');
            $('#label_source').attr('style', 'display: block;');
            console.log("fin" + $('#transfertbudget_sourcebudget').val());
        } else {
            // $('#transfertbudget_id_source').attr('style', 'display:block');
            $('#transfertbudget_id_source_chosen').attr('style', 'display:block');
            $('#label_sourceinterne').attr('style', 'display:block');
            $('#row_budget').attr('style', 'display:block');
        }
    }


    $("#budgetdestination").change(function () {
        if ($("#budgetdestination").val() && $("#budgetdestination").val() != "0") {
            var id = $("#budgetdestination").val();
            $scope.InialiserCombo('titrebudjet', id, '#numeroengaementdestination', "#budgetdestination");
        }
    })
            .trigger("change");
    $("#budget")
            .change(function () {
                if ($("#budget").val() && $("#budget").val() != "0") {

                    var id = $("#budget").val();
                    $scope.InialiserCombo('titrebudjet', id, '#numeroengaement_source', '#budget');
                    $('#transfertbudget_sourcebudget').attr('style', 'display:none');
                    $('#label_source').attr('style', 'display:none');

                    //Initialiser Budget Destination comme Budget Ressource
                    if ($("#transfertbudget_id_typetransfert").val() == 3) {
                        $('#budgetdestination').val(id);
                        $('#budgetdestination').trigger("chosen:updated");
                        //Charger les numéro d'engagement suivant le budget destination
                        $scope.InialiserCombo('titrebudjet', id, '#numeroengaementdestination', "#budgetdestination");
                    }
                }
            })
            .trigger("change");
    $("#transfertbudget_id_typetransfert")
            .change(function () {
                if ($("#transfertbudget_id_typetransfert").val() && $("#transfertbudget_id_typetransfert").val() != "0") {
                    var id = $("#transfertbudget_id_typetransfert").val();
                    // $scope.InialiserCombo('titrebudjet', id, '#numeroengaement', '#budget');
                    if (id == 1) {
                        $('#transfertbudget_id_source_chosen').attr('style', 'display:block');
                        $('#row_budget').attr('style', 'display:block');

                        $('#transfertbudget_sourcebudget').attr('style', 'display:none');
                        $('#label_source').attr('style', 'display:none');

                        $('#zone_budgetdestination').removeClass('disabledbutton');
                    } else if (id == 2) {
                        $('#transfertbudget_id_source_chosen').attr('style', 'display:none');
                        $('#row_budget').attr('style', 'display:none');
                        $('#tdbudgetsource').removeClass('disabledbutton');
                        $('#transfertbudget_sourcebudget').attr('style', 'display:block');
                        $('#label_source').attr('style', 'display:block');

                        $('#zone_budgetdestination').removeClass('disabledbutton');
                    } else {
                        $('#transfertbudget_id_source_chosen').attr('style', 'display:block');
                        $('#row_budget').attr('style', 'display:block');

                        $('#transfertbudget_sourcebudget').attr('style', 'display:none');
                        $('#label_source').attr('style', 'display:none');

                        $('#zone_budgetdestination').addClass('disabledbutton');

                        if ($("#budget").val() != $("#budgetdestination").val()) {
                            var id = $("#budget").val();
                            //Initialiser Budget Destination comme Budget Ressource
                            if ($("#transfertbudget_id_typetransfert").val() == 3) {
                                $('#budgetdestination').val(id);
                                $('#budgetdestination').trigger("chosen:updated");
                                //Charger les numéro d'engagement suivant le budget destination
                                $scope.InialiserCombo('titrebudjet', id, '#numeroengaementdestination', "#budgetdestination");
                            }
                        }

                        $('#budgetdestination').val(id);
                        $('#budgetdestination').trigger("chosen:updated");
                    }

                    $scope.VerifAjout();
                }
            })
            .trigger("change");
    $("#budgetsource")
            .change(function () {
                if ($("#budgetsource").val() && $("#budgetsource").val() != "0") {
                    var id = $("#budgetsource").val();
                    $scope.InialiserCombo('titrebudjet', id, '#transfertbudget_filters_id_source', '#budgetsource');
                    $('#tdbudgetsource').removeClass('disabledbutton');
                    //  $('#transfertbudget_sourcebudget').attr('style', 'display:none');
                }
            })
            .trigger("change");
    $("#budgetdestination")
            .change(function () {
                if ($("#budgetdestination").val() && $("#budgetdestination").val() != "0") {
                    var id = $("#budgetdestination").val();
                    $scope.InialiserCombo('titrebudjet', id, '#transfertbudget_filters_id_destination', '#budgetdestination');
                    $('#tdbudgetdestination').removeClass('disabledbutton');
                    // $('#transfertbudget_sourcebudget').attr('style', 'display:none');
                }
            })
            .trigger("change");
    $scope.InialiserCombo = function (table, id, id_select, idbudget) {
        console.log('  table=' + table + ' id= ' + id + ' id_select=' + id_select + '  idbudget=' + idbudget);
        $scope.param = {
            'table': table,
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/AffichesourceTransfertBudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            if (table == "titrebudjet") {
                if (idbudget === "#budget") {
                    $scope.listesBudgetSource = data;
                    var id_selected_ligne = "#id_budget";
                } else {
                    $scope.listesBudgetDestination = data;
                    var id_selected_ligne = "#id_budget_destination";
                }
                $scope.ChargerCombo2(id_select, data, id_selected_ligne);
                if ($(idbudget).val() && $(idbudget).val() != "") {
                    //  $(id_select).val($(idbudget).val());
                    $(id_select).val($(id_selected_ligne).val());
                    $(id_select).trigger("chosen:updated");
                }
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ChargerCombo2 = function (id, data, id_selected_ligne) {
        //  alert('id_selected=' + id_selected_ligne);
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            if (data[i].code)
                $(id).append("<option value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + "</option>");
            else
                $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val($(id_selected_ligne).val()).trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            if (data[i].code)
                $(id).append("<option value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + "</option>");
            else
                $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        // $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $("#numeroengaement_source")
            .change(function () {
                if ($("#numeroengaement_source").val() && $("#numeroengaement_source").val() != "0") {
                    var html = "<td colspan='2'><table>";
                    $('#transfertbudget_id_source').val($("#numeroengaement_source").val());
                    $('#transfertbudget_id_source').trigger("chosen:updated");
                    for (var i = 0; i < $scope.listesBudgetSource.length; i++) {
                        console.log($scope.listesBudgetSource[i].id + '===' + $("#numeroengaement_source").val());
                        if ($scope.listesBudgetSource[i].id - $("#numeroengaement_source").val().trim() === 0) {
                            var mntencaget = 0;
                            var mntp = 0;
                            var mntencaiser = 0;
                            var mntexterne = 0;
                            var mntretire = 0;
                            if ($scope.listesBudgetSource[i].mntengage)
                                mntencaget = $scope.listesBudgetSource[i].mntengage;
                            if ($scope.listesBudgetSource[i].mntprovisoire)
                                mntp = $scope.listesBudgetSource[i].mntprovisoire;
                            if ($scope.listesBudgetSource[i].mntencaisse)
                                mntencaiser = $scope.listesBudgetSource[i].mntencaisse;
                            if ($scope.listesBudgetSource[i].mntexterne)
                                mntexterne = $scope.listesBudgetSource[i].mntexterne;
                            if ($scope.listesBudgetSource[i].mntretire)
                                mntretire = $scope.listesBudgetSource[i].mntretire;
                            else
                                mntretire = 0;
                            var mntencaisseaprestransfert = parseFloat(mntencaiser) + parseFloat(mntretire);
                            html += "<tr><td>Mnt Alloué: " + $scope.listesBudgetSource[i].mnt + "</td></tr>";
                            html += "<tr><td>Mnt Transféré: " + Math.abs(mntretire) + "</td></tr>";
                            html += "<tr><td>Mnt Exterieur: " + Math.abs(mntexterne) + "</td></tr>";
                            html += "<tr><td>Mnt Engager Définitif: " + mntencaget + "</td></tr>";
                            html += "<tr><td>Mnt Engager provisoire: " + mntp + "</td></tr>";
                            html += "<tr><td>Mnt Encaiser: " + mntencaisseaprestransfert + "</td></tr>";
                            var maxtransfert = parseFloat(mntencaiser) - parseFloat(mntp) + parseFloat(mntexterne);
                            $('#maxtransfert').val(maxtransfert);
                            console.log(html);
                            break;
                        }
                    }
                    html += "</table></td>";
                    $('#detail_source').html(html);
                }
            })
            .trigger("change");
    $('#transfertbudget_id_destination')
            .change(function () {
                $scope.VerifAjout();
            }).trigger("change");

    $("#numeroengaementdestination")
            .change(function () {
                if ($("#numeroengaementdestination").val() && $("#numeroengaementdestination").val() != "0") {
                    var html = "<td colspan='2'><table>";
                    $('#transfertbudget_id_destination').val($("#numeroengaementdestination").val());
                    $('#transfertbudget_id_destination').trigger("chosen:updated");
                    for (var i = 0; i < $scope.listesBudgetDestination.length; i++) {
                        console.log($scope.listesBudgetDestination[i].id + '===' + $("#numeroengaementdestination").val());
                        if ($scope.listesBudgetDestination[i].id - $("#numeroengaementdestination").val().trim() === 0) {
                            var mntencaget = 0;
                            var mntp = 0;
                            var mntencaiser = 0;
                            var mntexterne = 0;
                            var mntretire = 0;
                            if ($scope.listesBudgetDestination[i].mntengage)
                                mntencaget = $scope.listesBudgetDestination[i].mntengage;
                            if ($scope.listesBudgetDestination[i].mntprovisoire)
                                mntp = $scope.listesBudgetDestination[i].mntprovisoire;
                            if ($scope.listesBudgetDestination[i].mntencaisse)
                                mntencaiser = $scope.listesBudgetDestination[i].mntencaisse;
                            if ($scope.listesBudgetDestination[i].mntexterne)
                                mntexterne = $scope.listesBudgetDestination[i].mntexterne;
                            if ($scope.listesBudgetDestination[i].mntretire)
                                mntretire = $scope.listesBudgetDestination[i].mntretire;
                            else
                                mntretire = 0;
                            var mntencaisseaprestransfert = parseFloat(mntencaiser) + parseFloat(mntexterne);
                            html += "<tr><td>Mnt Alloué: " + $scope.listesBudgetDestination[i].mnt + "</td></tr>";
                            html += "<tr><td>Mnt Extérieur: " + Math.abs(mntexterne) + "</td></tr>";
                            html += "<tr><td>Mnt Transféré: " + Math.abs(mntretire) + "</td></tr>";
                            html += "<tr><td>Mnt Engager Définitif: " + mntencaget + "</td></tr>";
                            html += "<tr><td>Mnt Engager provisoire: " + mntp + "</td></tr>";
                            html += "<tr><td>Mnt Encaiser: " + mntencaisseaprestransfert + "</td></tr>";
                            console.log(html);
                            break;
                        }
                    }
                    html += "</table></td>";
                    $('#detail_dest').html(html);
                    $scope.VerifAjout();
                }
            })
            .trigger("change");

});
app.filter('floor', function () {
    return function (input) {
        return Math.floor(input);
    };
});
app.filter('ceil', function () {
    return function (input) {
        var ce = input.toString().replace(".", "");
        return ce;
    };
});
app.filter('tulde', function () {
    return function (input) {
        var ce = input.toString().replace("'", "0000");
        return ce;
    };
});
app.controller('CtrlBudgetFilter', function ($scope, $http) {
    $scope.InaliserFilter = function () {
        var idtype = $('#idtype').val();
        if (idtype != "") {
            $('#documentbudget_filters_id_type').val(idtype);
            $('#documentbudget_filters_id_type').trigger("chosen:updated");
        }
    }
    $scope.InaliserFilter();
});
//CtrlFormEngagement
app.controller('CtrlFormEngagement', function ($scope, $http) {
    $scope.detailbudget = [];
    $scope.paramRubriqueBudget = [];
    //Pré-engagement 
    $scope.InialiserPreengagment = function () {
        $('#documentbudget_id_type').val($('#typeenga').val());
        $('#documentbudget_id_type').trigger("chosen:updated");
        $('#documentbudget_id_type_chosen').attr('style', 'width:100%');
        $('#documentbudget_id_type').trigger("chosen:updated");
        $('#budget_chosen').attr('style', 'width:100%');
        $('#budget').trigger("chosen:updated");
        $('#numeroengaement_chosen').attr('style', 'width:100%');
        $('#numeroengaement').trigger("chosen:updated");
        $('#numeroengaement_source_chosen').attr('style', 'width:100%');
        $('#numeroengaement_source').trigger("chosen:updated");

    }
    $("#numeroengaement")
            .change(function () {
                if ($("#numeroengaement").val() && $("#numeroengaement").val() != "") {
                    $scope.ChargerNordre($("#numeroengaement").val());
                }
            })
            .trigger("change");
    $scope.ValiderChoix = function (id, iddoc) {
        var id1 = $('#check1_' + id + ':checked').length;
        if (id1 > 0) {
            $('#check1_' + id).prop("checked", true);
        } else {
            $('#check1_' + id).prop("checked", false);
        }

        var count_checked = 0;
        $('[name="avis_checkbox"]').each(function () {
            if ($(this).is(':checked'))
                count_checked++;
        });

        if (count_checked == 0)
            $('#btn_enoyer-avis').hide();
        else
            $('#btn_enoyer-avis').show();

        $scope.param = {
            'valip': id1,
            'id': id,
            'reliquat': '',
            'id_ligprotitub': '',
            'iddoc': iddoc
        }
        $http({
            url: domaineapp + '/budget.php/documentachat/Validerligne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: data,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }, function myError(response) {
            alert("Erreur");
        });
    }
    $scope.ValiderChoixDisponibleProvioire = function (iddoc) {
        if ($('#numeroengaement').val()) {
            var id = $('#budget_avis_id').val();
            $('#check1_' + id).attr('checked', true);
            $('#check1_' + id).attr('class', 'disabledbutton');
            if (id == '7') {
                $('#details_budget').val($('#budget option:selected').text().trim());
                $('#details_rubrique').val($('#rubrique').val());
                $('#details_reliquat').val($('#reliq').val());
                $('#zone_avis_budgetaire').fadeIn();
            }

            $('#btn_enoyer-avis').show();

            $scope.param = {
                'valip': 1,
                'id': id,
                'reliquat': parseFloat($('#reliq').val()),
                'id_ligprotitub': $('#numeroengaement').val(),
                'iddoc': iddoc
            }
            $http({
                url: domaineapp + '/budget.php/documentachat/ValiderligneProvisoire',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: data,
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur");
            });
        } else {
            bootbox.dialog({
                message: "Avis budgétaire non affecté ! Veuillez choisir la rubrique budgétaire.",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.ValiderChoixDisponibleDef = function (iddoc) {
        if ($('#numeroengaement').val()) {
            var id = $('#budget_avis_id').val();
            $('#check1_' + id).attr('checked', true);
            $('#check1_' + id).attr('class', 'disabledbutton');
            if (id == '7') {
                $('#details_budget').val($('#budget option:selected').text().trim());
                $('#details_rubrique').val($('#rubrique').val());
                $('#details_reliquat').val($('#reliq').val());
                $('#zone_avis_budgetaire').fadeIn();
            }

            $('#btn_enoyer-avis').show();

            $scope.param = {
                'valip': 1,
                'id': id,
                'reliquat': parseFloat($('#reliq').val()),
                'id_ligprotitub': $('#numeroengaement').val(),
                'iddoc': iddoc
            }
            $http({
                url: domaineapp + '/budget.php/documentachat/ValiderligneDef',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: data,
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur");
            });
        } else {
            bootbox.dialog({
                message: "Avis budgétaire non affecté ! Veuillez choisir la rubrique budgétaire.",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.setAffichageRubrique = function (id) {
        $('.chosen-container').attr('style', 'width: 100%;');
        $('.chosen-container').trigger("chosen:updated");
        $('#budget_avis_id').val(id);
    }

    $scope.AnnulerChoixDisponible = function (iddoc) {
        var id = $('#budget_avis_id').val();
        $('#check1_' + id).removeAttr('checked');
        if (id == '7') {
            $('#details_budget').val('');
            $('#details_rubrique').val('');
            $('#details_reliquat').val('');
            $('#zone_avis_budgetaire').fadeOut();
        }

        var count_checked = 0;
        $('[name="avis_checkbox"]').each(function () {
            if ($(this).is(':checked'))
                count_checked++;
        });

        if (count_checked == 0)
            $('#btn_enoyer-avis').hide();

        $scope.param = {
            'valip': 0,
            'id': id,
            'iddoc': iddoc
        }
        $http({
            url: domaineapp + '/budget.php/documentachat/Validerligne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: data,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }, function myError(response) {
            alert("Erreur");
        });
    }

    $scope.ChargerNordre = function (id) {
        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {

                $scope.detailbudget = data[0];
                var mntengage = 0;
                if ($scope.detailbudget.mntengage)
                    mntengage = $scope.detailbudget.mntengage;
                $('#rubrique').val($scope.detailbudget.libelle);
                $('#mnt').val(parseFloat($scope.detailbudget.mnt).toLocaleString());
                $('#credit').val(parseFloat(mntengage).toLocaleString());
//                $('#numeroengaement').val(id);
                $('#numeroengaement').val($scope.detailbudget.id);
                var reliq = parseFloat($scope.detailbudget.mnt) - parseFloat(mntengage);
                $('#reliq').val(parseFloat(reliq).toLocaleString());
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.AjouterPreengagement = function (iddoc) {
        var existe = 1;
        if (!$('#numeroengaement').val()) {
            existe = 0;
            bootbox.dialog({
                message: "Veuillez sélectionner le rubrique d'engagment !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        if (parseFloat($('#mntencaisser').val()) <= parseFloat($('#mntttc').val())) {
            existe = 0;
            bootbox.dialog({
                message: "Veuillez changer le rubrique d'engagement !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        if (existe != 0 && confirm("Voulez-vous engager ce rubrique ?")) {
            $scope.param = {
                'idbudget': $('#numeroengaement').val(),
                'mnt': $scope.total,
                'iddoc': iddoc,
                'idtype': 3,
                'object': $('#txt_object').val(),
                'numero': $('#documentbudget_numero').val(),
                'idtypep': 4,
                'datecreation': $('#documentbudget_datecreation').val(),
                'mntttc': $('#mntttc').val()
            }
            $http({
                url: domaineapp + 'budget.php/documentbudget/Savespiecepreengagement',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: 'Fiche de pré-engagement effectuée avec succès !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur ....");
            });
        }
    }

    $scope.ValiderEngagement = function (iddoc, idpreengagement) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            'iddoc': iddoc,
            'idtype': 1,
            'idpreengagement': idpreengagement,
            'txt_object': $('#txt_object').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Validerengagement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.alert({
                message: "Fiche d\'engagement effectuée avec succès !",
                callback: function () {
                    window.location.reload();
                }
            })


        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.ValiderEngagementJeton = function (iddoc, iddodcbce) {
       $scope.param = {
            'iddoc': iddoc,
            'idtype': 1,         
            'iddodcbce': iddodcbce,
        }
        $http({
            url: domaineapp + 'budget_dev.php/documentbudget/ValiderengagementJeton',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.alert({
                message: "Fiche d\'engagement effectuée avec succès !",
                callback: function () {
                    window.location.reload();
                }
            })


        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.AnnulerEngagementDef = function (iddoc, idpreengagement) {
        
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            'iddoc': iddoc,
            'idtype': 1,
            'idpreengagement': idpreengagement
        }
        $http({
            url: domaineapp + 'budget_dev.php/documentbudget/AnnulerEngagementJeton',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.alert({
                message: "Fiche d\'engagement effectuée avec succès !",
                callback: function () {
                    window.location.reload();
                }
            })


        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.ValiderEngagementBDC = function (iddoc, idpreengagement) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            'iddoc': iddoc,
            'idtype': 1,
            'idpreengagement': idpreengagement,
            'txt_object': $('#txt_object').val(),
            'relicat_total': $('#relicat_total').val(),
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/ValiderengagementBDC',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Fiche d\'engagement effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            window.location.reload();
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    //documentbudget_id_type
    //--------valider engagement definit contrat 
    $scope.ValiderEngagementContrat = function (iddoc, idpreengagement) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            'iddoc': iddoc,
            'idtype': 1,
            'idpreengagement': idpreengagement,
            'txt_object': $('#txt_object').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/ValiderengagementContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Fiche d\'engagement effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            window.location.reload();
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    //valider engagement definitif avenant contrat

    $scope.ValiderEngagementAvenantContrat = function (iddoc, idpreengagement, idcontrat) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            'iddoc': iddoc,
            'idcontrat': idcontrat,
            'idtype': 1,
            'idpreengagement': idpreengagement,
            'txt_object': $('#txt_object').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/ValiderengagementAvenantContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Fiche d\'engagement effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            window.location.reload();
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.InaliserFilter = function () {
        var idtype = 1;
        if (idtype != "") {
            $('#documentbudget_id_type').val(idtype);
            $('#documentbudget_id_type').trigger("chosen:updated");
        }
        //typepiece
    }
    $scope.InialiserPieceJoint = function () {
        $('#typepiece_chosen').attr('style', 'width:100%');
        $('#typepiece').trigger("chosen:updated");
        //piece_chosen
        $('#piece_chosen').attr('style', 'width:100%');
        $('#piece').trigger("chosen:updated");
    }

    $scope.InialiserCombo = function (table, id) {
        //   alert('de' + table + id);
        $scope.param = {
            'table': table,
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/AffichesourceParamCompte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (table == "titrebudjet") {
                $scope.paramRubriqueBudget = data;
                $scope.ChargerComboCaissebanque('#numeroengaement', data);
                if ($('#id_budget').val() && $('#id_budget').val() != "") {
                    $("#numeroengaement").val($('#id_budget').val());
                    $('#numeroengaement').trigger("chosen:updated");
                }
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.InialiserComboContrat = function (table, id_titre, id_rubrique) {
        $scope.param = {
            'table': table,
            'id': id_titre
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/AffichesourceEngDEfContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            if (table == "titrebudjet") {
            $scope.ChargerCombo('#numeroengaement', data);
            $("#numeroengaement").val(id_titre);
            $('#numeroengaement').trigger("chosen:updated");
            $scope.ChargerNordre(id_titre);
            //            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $("#id_budget")
            .change(function () {
                if ($("#id_budget").val() && $("#id_budget").val() != "0") {
                    var id = $("#id_budget").val();
                    $scope.InialiserComboContrat('titrebudjet', id);
                } else {
                    $("#id_rubrique").empty();
                }
            })
            .trigger("change");

    $scope.ChargerComboBudgetDocument = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {

            $(id).append("<option code='" + data[i].code + "' value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " => Mnt : " + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.InialiserComboBudgetEngagement = function (table, rubrique, id_titre, id_rubrique) {

        $scope.param = {
            'table': table,
            'id': id_titre,
            'rubrique': rubrique
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichesource',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log('length=' + data.length);
            if (table == "titrebudjet") {
                if (rubrique === 'liste_rubrique')
                    $('#div_select').html('');
                if (data.length > 0) {
                    $('#div_select').append('<select id="' + rubrique + '"></select>');

                    $scope.ChargerComboBudgetDocument('#' + rubrique, data);


                }

                if (id_rubrique && data.length === 0) {
                    $("#" + rubrique).val(id_rubrique);
                    $('#' + rubrique).trigger("chosen:updated");
                    $scope.ChargerNordre(id_rubrique);
                }

                $("#" + rubrique)
                        .change(function () {
                            if ($("#" + rubrique).val() && $("#" + rubrique).val() != "") {

                                id_rubrique = $("#" + rubrique).val();
                                if (data.length > 0) {
                                    if (rubrique === 'liste_rubrique') {
                                        $('#' + rubrique).nextAll('select').remove();

                                        $('#mnt').val('');
                                        $('#credit').val('');
                                        $('#reliq').val('');
                                    }

                                    $scope.InialiserComboBudgetEngagement(table, $("#" + rubrique + ' option:selected').attr('code'), id_titre, id_rubrique)

                                } else {
                                    $("#" + rubrique).val(id_rubrique);
                                    $('#' + rubrique).trigger("chosen:updated");
                                    $scope.ChargerNordre(id_rubrique);

                                }
                            }
                        })
                        .trigger("change");

                // $scope.ChargerNordre(id_rubrique);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });

    }

    $("#budget_param_compte")
            .change(function () {
                if ($("#budget_param_compte").val() && $("#budget_param_compte").val() != "0") {
                    var id = $("#budget_param_compte").val();
                    $scope.InialiserCombo('titrebudjet', id);
                } else {
                    $("#numeroengaement").empty();
                }
            })
            .trigger("change");
    $("#budget")
            .change(function () {
                if ($("#budget").val() && $("#budget").val() != "0") {
                    var id = $("#budget").val();
                    $scope.InialiserComboBudgetEngagement('titrebudjet', 'liste_rubrique', id, null);
                } else {
                    $("#numeroengaement").empty();
                }
            })
            .trigger("change");

    $scope.ChargerNordre = function (id) {

        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            if (data.length > 0) {
                $scope.detailbudget = data[0];
                var mntengage = 0;
                var mntencaisser = 0;
                var mntprovisoire = 0;
                var total_engage = 0;
                if ($scope.detailbudget.mntengage)
                    mntengage = $scope.detailbudget.mntengage;
                if ($scope.detailbudget.mntprovisoire)
                    mntprovisoire = $scope.detailbudget.mntprovisoire;
                if ($scope.detailbudget.mntencaisse)
                    mntencaisser = $scope.detailbudget.mntencaisse;
                if ($scope.detailbudget.mntprovisoire)
                    var total_engage = parseFloat(mntprovisoire);
                if ($scope.detailbudget.mntengage)
                    var total_engage = parseFloat(mntengage) + total_engage;
                console.log(total_engage + 'dc' + mntengage + "csd" + mntprovisoire);
                $('#numeroengaement').val($scope.detailbudget.id);
                $('#id_budget').val($scope.detailbudget.id);
                $('#total_engage').val(parseFloat(total_engage).toLocaleString());
                $('#rubrique').val($scope.detailbudget.libelle);
                $('#mnt').val(parseFloat($scope.detailbudget.mnt).toLocaleString());
                $('#credit').val(parseFloat(mntengage).toLocaleString());
                $('#mntencaisser').val(parseFloat(mntencaisser));
                $('#creaditporv').val(parseFloat(mntprovisoire).toLocaleString());

                var reliq = parseFloat($scope.detailbudget.mnt) - mntengage;
                $('#reliq').val(parseFloat(reliq).toLocaleString());

                $('#reliqprovisoire').val(parseFloat($scope.detailbudget.mnt - total_engage).toLocaleString());

            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ChargerComboCaissebanque = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " Mnt:" + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " => Mnt : " + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.InaliserFilter();


    ////////////////Piece Joint
    $scope.listespieces = [];
    $scope.total = 0;
    $scope.AjouterPieceJoint = function (id, iddocbudget) {
        $scope.param = {
            'pieces': $scope.listespieces,
            'mnttotal': $scope.total,
            'iddoc': id,
            'iddocbudget': iddocbudget
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Savespiece',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $scope.listespieces = data;

        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.AjouterLignePiece = function () {
        var ch = $('#piece option:selected').text().split(':');
        var mnt = parseFloat(ch[2]).toFixed(3);
        var lignetotal = 0;
        $scope.listespieces.push({
            'id': $('#piece').val(),
            'doc': $('#piece option:selected').text(),
            'mnt': mnt,
            'type': $('#typepiece option:selected').text(),
            'ref': $('#ref').val()
        });
        for (var i = 0; i < $scope.listespieces.length; i++)
            lignetotal += parseFloat($scope.listespieces[i].mnt);
        $scope.total = lignetotal.toFixed(3);
    }
    $scope.ChargerComboPiece = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option  value='" + data[i].id + "'>Numéro : " + data[i].numero + " TTC : " + data[i].mntttc + "</option>");
            // $('#nbexterne').val(data[i].id);
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.ChargerBCE = function (id) {
        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Chargerbce',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerComboPiece('#piece', data);
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $("#typepiece")
            .change(function () {
                if ($("#typepiece").val() && $("#typepiece").val() != "0") {
                    var id = $("#typepiece").val();
                    if (id == 4)
                        $scope.ChargerBCE(id);

                }
            })
            .trigger("change");

});
// controlleur caisse et banque
app.controller('CtrlCaisse', function ($scope, $http) {
    $scope.detailbudget = [];
    $scope.listesarticleselectionner = [];
    //Pré-engagement 
    $scope.inialiserFormCaisse = function () {
        $('#caissesbanques_id_typecb').val($('#idtypecb').val());
        $('#caissesbanques_id_typecb').trigger("chosen:updated");
        $('#caissesbanques_id_typecb_chosen').attr('style', 'width:100%');
    }
    $scope.InialiserCaisseOuBanque = function () {
        $('#caissesbanques_filters_id_typecb').val($('#idtypehidden').val());
        $('#caissesbanques_filters_id_typecb').trigger("chosen:updated");
        $('#caissesbanques_filters_id_typecb_chosen').attr('style', 'width:100%');
    }
    $scope.InialiserQuittance = function () {
        $('#ligneoperationcaisse_id_user').val($('#id_user').val());
        $('#ligneoperationcaisse_id_user').trigger("chosen:updated");
        $('#ligneoperationcaisse_id_user_chosen').attr('style', 'width:100%');
        if ($('#id_demarcheur').val() && $('#id_demarcheur').val() != "")
            $('#ligneoperationcaisse_id_demarcheur').val($('#id_demarcheur').val());
        $('#ligneoperationcaisse_id_demarcheur').trigger("chosen:updated");
        $('#ligneoperationcaisse_id_demarcheur_chosen').attr('style', 'width:100%');
        if ($('#id_caisse').val() && $('#id_caisse').val() != "")
            $('#ligneoperationcaisse_id_caisse').val($('#id_caisse').val());
        $('#ligneoperationcaisse_id_caisse').trigger("chosen:updated");
        $('#ligneoperationcaisse_id_caisse_chosen').attr('style', 'width:100%');
        console.log("Caisse:" + $('#id_caisse').val());
    }
    $scope.AjouterQuittance = function (iddoc, idCatoperation, idlignerubrique) {

        console.log(idlignerubrique + ' ' + $('#idcaisse').val() + '!= "" &&' + $scope.listesarticleselectionner.length + ' > 0');
        if ($('#ligneoperationcaisse_id_caisse').val() != "" && $scope.listesarticleselectionner.length > 0) {
            $scope.param = {
                'idcaisse': $('#idcaisse').val(),
                'numero': $('#ligneoperationcaisse_numeroo').val(),
                'date': $("#ligneoperationcaisse_dateoperation").val(),
                'iddoc': iddoc,
                'idCatoperation': idCatoperation,
                'mnt': $('#ligneoperationcaisse_mntoperation').val(),
                'id_user': $('#id_user').val(),
                'id_demandeur': $('#ligneoperationcaisse_id_demarcheur').val(),
                'id_caisse': $('#ligneoperationcaisse_id_caisse').val(),
                'objet': $('#ligneoperationcaisse_objet').val(),
                'chequen': $('#ligneoperationcaisse_chequen').val(),
                'listearticle': $scope.listesarticleselectionner,
                'idlignerubrique': idlignerubrique

            }
            $http({
                url: domaineapp + 'tresorie.php/caissesbanques/Savespiecepreengagement',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: 'Fiche quittance créée avec succès !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur ....");
            });
        } else {
            bootbox.dialog({
                message: 'Veuillez Vérifier les champs...!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }



    $scope.AjouterQuittanceBDCRetenue = function (iddoc, idCatoperation) {
        if ($('#mnt_operation').val() != '') {
            if ($('#ligneoperationcaisse_mntoperation').val() > $('#mnt_operation').val()) {
                bootbox.dialog({
                    message: 'le montant provisoire ne peut pas être superier au montant quitance définitif!!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
            //        $scope.listesarticleselectionner = $('#liste_ligne').val();
            console.log($scope.listesarticleselectionner.length + 'ee' + $scope.listesarticleselectionner);
            if ($('#ligneoperationcaisse_id_caisse').val() != "") {
                $scope.param = {
                    'idcaisse': $('#idcaisse').val(),
                    'numero': $('#ligneoperationcaisse_numeroo').val(),
                    'date': $("#ligneoperationcaisse_dateoperation").val(),
                    'iddoc': iddoc,
                    'idCatoperation': idCatoperation,
                    'mnt': $('#ligneoperationcaisse_mntoperation').val(),
                    'id_user': $('#id_user').val(),
                    'id_demandeur': $('#ligneoperationcaisse_id_demarcheur').val(),
                    'id_caisse': $('#ligneoperationcaisse_id_caisse').val(),
                    'objet': $('#ligneoperationcaisse_objet').val(),
                    'chequen': $('#ligneoperationcaisse_chequen').val(),
                    'listearticle': $scope.listesarticleselectionner,
                }
                $http({
                    url: domaineapp + 'tresorie.php/caissesbanques/SavespiecepreengagementBDCRetenue',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    bootbox.dialog({
                        message: 'Fiche quittance créée avec succès !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    window.location.reload();
                }, function myError(response) {
                    alert("Erreur ....");
                });
            } else {
                bootbox.dialog({
                    message: 'Veuillez Vérifier les champs...!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        }

    }

    $scope.AjouterQuittanceBDC = function (iddoc, idCatoperation) {
        if ($('#ligneoperationcaisse_mntoperation').val() != '') {
            //        
            //            if ($('#ligneoperationcaisse_mntoperation').val() > $('#mnt_operation').val()) {
            //                bootbox.dialog({
            //                    message: 'le montant provisoire ne peut pas être superier au montant quitance définitif!!!',
            //                    buttons:
            //                            {
            //                                "button":
            //                                        {
            //                                            "label": "Ok",
            //                                            "className": "btn-sm"
            //                                        }
            //                            }
            //                });
            //            }
            //        $scope.listesarticleselectionner = $('#liste_ligne').val();
            console.log($scope.listesarticleselectionner.length + 'ee' + $scope.listesarticleselectionner);
            if ($('#ligneoperationcaisse_id_caisse').val() != "" && $scope.listesarticleselectionner.length > 0) {
                $scope.param = {
                    'idcaisse': $('#idcaisse').val(),
                    'numero': $('#ligneoperationcaisse_numeroo').val(),
                    'date': $("#ligneoperationcaisse_dateoperation").val(),
                    'iddoc': iddoc,
                    'idCatoperation': idCatoperation,
                    'mnt': $('#ligneoperationcaisse_mntoperation').val(),
                    'id_user': $('#id_user').val(),
                    'id_demandeur': $('#ligneoperationcaisse_id_demarcheur').val(),
                    'id_caisse': $('#ligneoperationcaisse_id_caisse').val(),
                    'objet': $('#ligneoperationcaisse_objet').val(),
                    'chequen': $('#ligneoperationcaisse_chequen').val(),
                    'listearticle': $scope.listesarticleselectionner,
                }
                $http({
                    url: domaineapp + 'tresorie.php/caissesbanques/SavespiecepreengagementBDC',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    bootbox.dialog({
                        message: 'Fiche quittance créée avec succès !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    window.location.reload();
                }, function myError(response) {
                    alert("Erreur ....");
                });
            } else {
                bootbox.dialog({
                    message: 'Veuillez Vérifier les champs...!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        }

    }

    $scope.AjouterQuittanceBDCDef = function (iddoc, idCatoperation, is_valide) {
        if (is_valide == true) {

            $scope.verifierlenombredesquitanceprovisoireetdef(iddoc, idCatoperation, is_valide);
        } else {
            $scope.SaveQuitanceBDCDefinitif(iddoc, idCatoperation, is_valide);
        }
    }

    $scope.CloturerQuitanceEnvoyeachat = function (iddoc, is_valide) {
        $scope.param = {
            'iddoc': iddoc,
            "is_valide": is_valide,
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/Savecloture',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Clôture avec succées  !!!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }, function myError(response) {
            alert("Erreur ....");
        });
    }


    $scope.SaveQuitanceBDCDefinitif = function (iddoc, idCatoperation, is_valide) {
        if ($('#mnt_operation').val() != '') {
            if ($('#ligneoperationcaisse_mntoperation').val() > $('#mnt_operation').val()) {
                bootbox.dialog({
                    message: 'le montant quitance définitif  ne peut pas être superieur au montant quitance provisoire!!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            } else {
                console.log($scope.listesarticleselectionner.length + 'ee' + $scope.listesarticleselectionner);
                if ($('#ligneoperationcaisse_id_caisse').val() != "" && $scope.listesarticleselectionner.length > 0) {
                    $scope.param = {
                        'idcaisse': $('#idcaisse').val(),
                        'numero': $('#ligneoperationcaisse_numeroo').val(),
                        'date': $("#ligneoperationcaisse_dateoperation").val(),
                        'iddoc': iddoc,
                        'idCatoperation': idCatoperation,
                        'mnt': $('#ligneoperationcaisse_mntoperation').val(),
                        'id_user': $('#id_user').val(),
                        'id_demandeur': $('#ligneoperationcaisse_id_demarcheur').val(),
                        'id_caisse': $('#ligneoperationcaisse_id_caisse').val(),
                        'objet': $('#ligneoperationcaisse_objet').val(),
                        'chequen': $('#ligneoperationcaisse_chequen').val(),
                        'retenueirpp': $('#ligneoperationcaisse_retenueirrp').val(),
                        'retenuetva': $('#ligneoperationcaisse_retenuetva').val(),
                        'listearticle': $scope.listesarticleselectionner,
                        "is_valide": is_valide,
                    }
                    $http({
                        url: domaineapp + 'tresorie.php/caissesbanques/SavespiecepreengagementBDCDef',
                        method: "POST",
                        data: $scope.param,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        data = response.data;
                        bootbox.dialog({
                            message: 'Fiche quittance créée avec succès !',
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        window.location.reload();
                    }, function myError(response) {
                        alert("Erreur ....");
                    });
                } else {
                    bootbox.dialog({
                        message: 'Veuillez Vérifier les champs...!!',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
            }
        }
    }
    $scope.verifierlenombredesquitanceprovisoireetdef = function (iddoc, idCatoperation, is_valide) {
        $scope.param = {
            "id": iddoc,
        }
        $http({
            url: domaineapp + '/tresorie.php/caissesbanques/TesterQuitancedefavecnombreprovisire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data.trim();
            if (data === '0') {
                bootbox.dialog({
                    message: 'Voulez-vous verifier le nombre des Quitances Définitifs est la même pour les quitances provisoires !!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            } else if (data === '1') {
                $scope.SaveQuitanceBDCDefinitif(iddoc, idCatoperation, is_valide);
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AjouterQuittanceBDCNULL = function (iddoc, idCatoperation, idlignerubrique) {
        console.log(idlignerubrique + ' ' + $('#idcaisse').val() + '!= "" &&' + $scope.listesarticleselectionner.length + ' > 0');
        if ($('#ligneoperationcaisse_id_caisse').val() != "" && $scope.listesarticleselectionner.length > 0) {
            $scope.param = {
                'idcaisse': $('#idcaisse').val(),
                'numero': $('#ligneoperationcaisse_numeroo').val(),
                'date': $("#ligneoperationcaisse_dateoperation").val(),
                'iddoc': iddoc,
                'idCatoperation': idCatoperation,
                'mnt': $('#ligneoperationcaisse_mntoperation').val(),
                'id_user': $('#id_user').val(),
                'id_demandeur': $('#ligneoperationcaisse_id_demarcheur').val(),
                'id_caisse': $('#ligneoperationcaisse_id_caisse').val(),
                'objet': $('#ligneoperationcaisse_objet').val(),
                'chequen': $('#ligneoperationcaisse_chequen').val(),
                'listearticle': $scope.listesarticleselectionner,
                'idlignerubrique': idlignerubrique

            }
            $http({
                url: domaineapp + 'tresorie.php/caissesbanques/SavespiecepreengagementBDCNULL',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: 'Fiche quittance créée avec succès !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur ....");
            });
        } else {
            bootbox.dialog({
                message: 'Veuillez Vérifier les champs...!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.AjouterQuittanceDEFBDCNULL = function (iddoc) {
        //        console.log( ' ' + $('#idcaisse').val() + '!= "" &&' + $scope.listesarticleselectionner.length + ' > 0');
        $scope.VerifierMntQuitanceAndTotalProvisoire(iddoc);
    }
    $scope.VerifierMntQuitanceAndTotalProvisoire = function (iddoc) {
        $scope.param = {
            "id": iddoc,
            "mntoperation": $('#ligneoperationcaisse_mntoperation').val(),
        }
        $http({
            url: domaineapp + '/tresorie.php/caissesbanques/TesterQuitancedefavectotalprovisoire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data.trim();

            if (data === '0') {
                bootbox.dialog({
                    message: 'Voulez-vous verifier le montnat du Quitance Définitif ne dépasse pas le provisoire !!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            } else if (data === '1') {

                $scope.SaveQuitanceDefinitif(iddoc);
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.SaveQuitanceDefinitif = function (iddoc) {
        if ($('#ligneoperationcaisse_id_caisse').val() != "" && $scope.listesarticleselectionner.length > 0) {
            $scope.param = {
                'idcaisse': $('#idcaisse').val(),
                'numero': $('#ligneoperationcaisse_numeroo').val(),
                'date': $("#ligneoperationcaisse_dateoperation").val(),
                'iddoc': iddoc,
                'mnt': $('#ligneoperationcaisse_mntoperation').val(),
                'id_user': $('#id_user').val(),
                'id_demandeur': $('#ligneoperationcaisse_id_demarcheur').val(),
                'id_caisse': $('#ligneoperationcaisse_id_caisse').val(),
                'objet': $('#ligneoperationcaisse_objet').val(),
                'chequen': $('#ligneoperationcaisse_chequen').val(),
                'listearticle': $scope.listesarticleselectionner,
            }
            $http({
                url: domaineapp + 'tresorie.php/caissesbanques/SavespiecepreengagementDef',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: 'Fiche quittance créée avec succès !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert("Erreur ....");
            });
        } else {
            bootbox.dialog({
                message: 'Veuillez Vérifier les champs...!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.AjouterArticleListeSelectionner = function (idligne) {
        var verif_cheked = $('#check_' + idligne + ':checked').val();
        //        var tab = $scope.listesarticleselectionner;
        //        var length = $scope.listesarticleselectionner.length;
        var position = -1;
        var chaine = "";
        if (length > 0) {
            for (var i = 0; i < $scope.listesarticleselectionner.length; i++) {
                //console.log(idligne + '===' + tab[i].idligne);
                if (idligne === $scope.listesarticleselectionner[i].idligne) {
                    position = i;
                    break;
                }
            }
        }
        if (position === -1) {
            //console.log('gg');
            if (confirm("Voulez-vous ajouter cette article!")) {
                $scope.listesarticleselectionner.push({
                    'idligne': idligne
                });
            } else {
                $('#check_' + idligne).prop("checked", false);
            }
        } else {
            if (!verif_cheked) {
                //console.log('tt'+position);
                if (confirm("Voulez-vous supprimer cette article!")) {
                    $scope.listesarticleselectionner.splice(position, 1);
                } else
                    $('#check_' + idligne).prop("checked", true);
            }
        }
        for (var i = 0; i < $scope.listesarticleselectionner.length; i++) {

            chaine += $scope.listesarticleselectionner[i].idligne + '\n\r';

        }
    }
});
//CtrlFormOrdonnance
app.controller('CtrlFormOrdonnance', function ($scope, $http) {
    $scope.listesdocuments = [];
    $scope.InialiserOrdonnance = function () {
        $('#documentbudget_id_type').val(2);
        $('#documentbudget_id_type').trigger("chosen:updated");
        $('#documentbudget_id_type_chosen').attr('style', 'width:100%');
        $('#documentbudget_id_type').trigger("chosen:updated");
        $('#budget_chosen').attr('style', 'width:100%');
        $('#budget').trigger("chosen:updated");
        $('#numeroengaement_chosen').attr('style', 'width:100%');
        $('#numeroengaement').trigger("chosen:updated");
    }
    $scope.ChargerComboBudgetDocument = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {

            $(id).append("<option code='" + data[i].code + "' value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " => Mnt : " + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.InialiserComboBudgetEngagement = function (table, rubrique, id_titre, id_rubrique) {

        $scope.param = {
            'table': table,
            'id': id_titre,
            'rubrique': rubrique
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichesource',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log('length=' + data.length);
            if (table == "titrebudjet") {
                if (rubrique === 'liste_rubrique')
                    $('#div_select').html('');
                if (data.length > 0) {
                    $('#div_select').append('<select id="' + rubrique + '"></select>');
                    $scope.ChargerComboBudgetDocument('#' + rubrique, data);
                }
                if (id_rubrique && data.length === 0) {
                    console.log('data1' + id_rubrique);
                    $("#" + rubrique).val(id_rubrique);
                    $('#' + rubrique).trigger("chosen:updated");
                    $scope.ChargerNordre(id_rubrique);
                }
                $("#" + rubrique)
                        .change(function () {

                            if ($("#" + rubrique).val() && $("#" + rubrique).val() != "") {
                                id_rubrique = $("#" + rubrique).val();

                                if (data.length > 0) {
                                    if (rubrique === 'liste_rubrique') {

                                        $('#' + rubrique).nextAll('select').remove();
                                        $('#mnt').val('');
                                        $('#credit').val('');
                                        $('#reliq').val('');
                                    }
                                    console.log(table + "," + $("#" + rubrique + ' option:selected').attr('code') + "," + id_titre + ", " + id_rubrique);
                                    $scope.InialiserComboBudgetEngagement(table, $("#" + rubrique + ' option:selected').attr('code'), id_titre, id_rubrique)
                                } else {
                                    console.log('data2' + id_rubrique);
                                    $("#" + rubrique).val(id_rubrique);
                                    $('#' + rubrique).trigger("chosen:updated");
                                    $scope.ChargerNordre(id_rubrique);

                                }
                            }
                        })
                        .trigger("change");

            }
        }, function myError(response) {
            alert("Erreur ....");
        });

    }


    $("#budget_param_compte")
            .change(function () {
                if ($("#budget_param_compte").val() && $("#budget_param_compte").val() != "0") {
                    var id = $("#budget_param_compte").val();
                    $scope.InialiserCombo('titrebudjet', id);
                } else {
                    $("#numeroengaement").empty();
                }
            })
            .trigger("change");
    $("#budget")
            .change(function () {
                if ($("#budget").val() && $("#budget").val() != "0") {
                    var id = $("#budget").val();
                    $scope.InialiserComboBudgetEngagement('titrebudjet', 'liste_rubrique', id, null);
                } else {
                    $("#numeroengaement").empty();
                }
            })
            .trigger("change");

    $scope.ChargerNordre = function (id) {

        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            if (data.length > 0) {

                $scope.detailbudget = data[0];
                var mntengage = 0;
                var mntencaisser = 0;
                var mntprovisoire = 0;
                if ($scope.detailbudget.mntengage)
                    mntengage = $scope.detailbudget.mntengage;
                if ($scope.detailbudget.mntprovisoire)
                    mntprovisoire = $scope.detailbudget.mntprovisoire;
                if ($scope.detailbudget.mntencaisse)
                    mntencaisser = $scope.detailbudget.mntencaisse;
                if ($scope.detailbudget.mntprovisoire && $scope.detailbudget.mntengage)
                    var total_engage = parseFloat(mntengage) + parseFloat(mntprovisoire);
                $('#total_engage').val(parseFloat(total_engage).toLocaleString());
                $('#rubrique').val($scope.detailbudget.libelle);
                $('#numeroengaement').val($scope.detailbudget.id);
                $('#id_budget').val($scope.detailbudget.id);
                $('#mnt').val(parseFloat($scope.detailbudget.mnt).toLocaleString());
                $('#credit').val(parseFloat(mntengage).toLocaleString());
                $('#mntencaisser').val(parseFloat(mntencaisser));
                $('#creaditporv').val(parseFloat(mntprovisoire).toLocaleString());

                var reliq = parseFloat($scope.detailbudget.mnt) - mntengage;
                $('#reliq').val(parseFloat(reliq).toLocaleString());

                $('#reliqprovisoire').val(parseFloat($scope.detailbudget.mnt - total_engage).toLocaleString());


            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.ChargerListesengagement = function () {
        id = $('#numeroengaement').val();
        $scope.listesdocuments = [];
        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichelistesengagement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesdocuments = data;
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.goToDetailsFacture = function (id) {
        var url = domaineapp + 'budget.php/lignemouvementfacturation/detailsFacture?id=' + id;
        window.location = url;
    }
    $scope.Valider = function (idp, numero) {
        var comArr = eval($scope.listesdocuments);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].numero === numero) {
                $scope.listesdocuments[i].idpiecejoint = '1';
                break;
            }
        }
    }
    $scope.AjouterOrdonnace = function () {
        var comArr = eval($scope.listesdocuments);
        for (var i = 0; i < comArr.length; i++) {
            if ($scope.listesdocuments[i].idpiecejoint === '1') {
                $scope.param = {
                    'idbudget': $('#numeroengaement').val(),
                    'iddoc': $scope.listesdocuments[i].iddocachat,
                    'idtype': 2,
                    'idpreengagement': $scope.listesdocuments[i].iddocbu
                }
                $http({
                    url: domaineapp + 'budget.php/documentbudget/Validerordennace',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                }, function myError(response) {
                    alert("Erreur ....");
                });
            }
        }
        bootbox.dialog({
            message: 'Fiche d\'ordonnance effectuée avec succés',
            buttons: {
                "button": {
                    "label": "Ok",
                    "className": "btn-sm"
                }
            }
        });
        window.location.reload();
    }

});

//CtrlFormOrdonnanceFournisseur
app.controller('CtrlFormOrdonnanceFournisseur', function ($scope, $http) {
    $scope.listesdocuments = [];
    $scope.InialiserOrdonnance = function () {
        $('#documentbudget_id_type').val(2);
        $('#documentbudget_id_type').trigger("chosen:updated");
        $('#documentbudget_id_type_chosen').attr('style', 'width:100%');
        $('#documentbudget_id_type').trigger("chosen:updated");
    }
    $("#documentachat_id_frs")
            .change(function () {
                if ($("#documentachat_id_frs").val() && $("#documentachat_id_frs").val() != "") {
                    $scope.ChargerListesengagement($("#documentachat_id_frs").val());
                }
            })
            .trigger("change");
    $scope.ChargerListesengagement = function (id) {
        $scope.listesdocuments = [];
        $scope.param = {
            'id': id
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Affichelistesengagementfournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesdocuments = data;
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.goToDetailsFacture = function (id) {
        var url = domaineapp + 'budget.php/lignemouvementfacturation/detailsFacture?id=' + id;
        window.location = url;
    }

});