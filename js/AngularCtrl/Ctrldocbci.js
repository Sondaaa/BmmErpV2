//var domaineapp = "http://"+window.location.hostname+"/";
//var domaineapp = "";

var domaineapp = "http://" + window.location.hostname;
console.log(domaineapp);
//______________________________________________________________________________Sous détail de prix
app.controller('Ctrlfacturation', function ($scope, $http) {

    $scope.lignedocsdeponsedef = [];
    $scope.AfficheDocBCEP = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/AfficheligneListeboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $scope.lignedocsdeponsedef = data;
            var comArr = eval($scope.lignedocsdeponsedef);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }
            if ($scope.data[0]['droittimbre'] > 0.000) {
                $('#droit_timbre').prop("checked", true);
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ValiderDroitTimbre = function (p) {
        if ($("#droit_timbre").is(':checked') == true) {
            $scope.param = {
                "id_droittimbre": $('#droit_timbre').val()
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/AficheroitTimbreSociete',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $("#valeurdroit_societe").val(data['valeur']);
                $scope.calculerMnTTcApresDroitTimbre(p);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {

            $('#valeurdroit_societe').val(0.000);
            var mnttc_sansdroit = $('#total_ttc_provisoire_bcehidden').val();
            if (p) {
                $('#txt_mnttotal_bdc').val(mnttc_sansdroit);
            } else {
                $('#total_ttc_provisoire').val(mnttc_sansdroit);
            }
        }
    }
    $scope.calculerMnTTcApresDroitTimbre = function (p) {
        if ($('#ttcnet_jeton').val() != '') {
            if ($('#ttcnet_jeton').val() && $('#valeurdroit').val() != '0') {
                var droittimbre = parseFloat($('#valeurdroit_societe').val());
                var pttc = parseFloat($('#total_ttc_provisoire_bcehidden').val());
                var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                $('#ttcnet_jeton').val(total_pttc.toFixed(3));
            }
        }
    }

    $scope.UpdateDetailBcEDef = function (nordre) {

        var comArr = eval($scope.lignedocsdeponsedef);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle').val(comArr[i].codearticle);
                $('#designation').val(comArr[i].designation);
                $('#unite').val(comArr[i].idunite);
                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);
                $('#totalhTax').val(comArr[i].totalhtax);
                $('#totalhax').val(comArr[i].totalhax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#tva').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#remise').val((comArr[i].tauxremise * 1).toFixed(3));
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttc').val(comArr[i].totalttc);
                $('#observation').val(comArr[i].observation);
            }
        }
    }
    $scope.CalculTotalTtcBCEJeton = function (liste, id, def, id_htax) {
        console.log('id_htax' + id_htax);
        var comArr = eval(liste);
        var total_ttc = 0;
        var total_ttc_sans_timbre = 0;
        var total_htax = 0;
        var total_htax_net = 0;
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].puht != null) {
                var tva = comArr[i].tva;
                tva = tva.substring(0, tva.length - 1);
                total_ttc = total_ttc + (parseFloat(comArr[i].totalttc));
                total_ttc_sans_timbre = total_ttc_sans_timbre + (parseFloat(comArr[i].totalttc));
                total_htax = total_htax + (parseFloat(comArr[i].totalhTax));
                total_htax_net = total_htax_net + (parseFloat(comArr[i].totalhax));
            }
        }

        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].timbre) {
                comArr[i].total_ttc = parseFloat(comArr[i].timbre) + parseFloat(comArr[i].total_ttc);
            }
        }
        if ($("#droit_timbre").is(':checked') == true) {
            var droit_timbre = parseFloat($('#valeurdroit_societe').val());
            total_ttc = total_ttc + droit_timbre;
        }

        if ($("#droit_timbre_sys").is(':checked') == true) {
            var droit_timbre = parseFloat($('#valeurdroit_societe_sys').val());
            total_ttc = total_ttc + droit_timbre;
        }
        $('#total_ttc_provisoire_bcehidden').val(total_ttc_sans_timbre.toFixed(3));

        $('#' + id).val(parseFloat(total_ttc).toFixed(3));
        $('#txt_mnttotal_hidden').val(parseFloat(total_ttc).toFixed(3));
        //  $scope.claculerDroittimber();

    }

    $scope.DeleteLignebceDef = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocsdeponsedef);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponsedef.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocsdeponsedef[i].norgdre = conteur;
            conteur++;
        }

        $scope.CalculTotalTtcBCEJeton($scope.lignedocsdeponsedef, 'ttcnet_jeton', 'bce', 'total_htax_provisoire');
        ;
    }
    $scope.ChangerPrix = function (p) {
        var taux = 0;
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        nordre = $('#nordre').val();

        var comArr = eval($scope.lignedocsdeponsedef);
        for (i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                var puh_initial = parseFloat($('#puht').val());
                var pu = parseFloat($('#puht').val());
                taux = parseFloat($scope.lignedocsdeponsedef[i].tauxremise);
                console.log(taux + 'taux=');
                $scope.lignedocsdeponsedef[i].remise = parseFloat(pu * taux).toFixed(3);

                if (taux > 0) {
                    pu = pu - (pu * taux);
                }
                var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
                var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
                var taux_fodec = 0;
                if ($("#taufodec option:selected").text() != '') {
                    taux_fodec = $("#taufodec option:selected").text().trim();
                    taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
                }
                var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
                var prixthtava = prixht + fodec;
                var tva = 0;
                if ($("#tva option:selected").text() != '') {
                    txt_tva = $("#tva option:selected").text().trim();
                    tva = txt_tva.substring(0, txt_tva.length - 1);
                }
                var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
                // $('#totalttc').val(parseFloat(prixttc).toFixed(3));
                $scope.lignedocsdeponsedef[i].puht = puh_initial.toFixed(3);

                $scope.lignedocsdeponsedef[i].totalhTax = prixhtax.toFixed(3);
                $scope.lignedocsdeponsedef[i].totalhax = prixht.toFixed(3);
                $scope.lignedocsdeponsedef[i].totalhtva = prixthtava.toFixed(3);
                $scope.lignedocsdeponsedef[i].totalttc = prixttc.toFixed(3);
            }
        }


    }
    $scope.ValiderBondexterneJeton = function (iddoc) {
        console.log('ded');
        var doit_timbre;
        if ($scope.lignedocsdeponsedef.length > 0 || $scope.lignedocsdeponsedef.length > 0) {
            doit_timbre = $('#droit_timbre').val();
            var comArr = eval($scope.lignedocsdeponsedef);
            var tab = eval($scope.lignedocsdeponsedef);
            var total_ttc_provisoire;
            var droit_timbre_societe;
            var total_htax;
            total_ttc_provisoire = $('#ttcnet_jeton').val();
            droit_timbre_societe = $('#valeurdroit_societe').val();
            total_htax = $('#total_htax_sys').val();
            $scope.param = {
                "iddoc": iddoc,
                "listearticle": tab,
                'total_ttc_provisoire': total_ttc_provisoire,
                'total_htax': total_htax,
                'droit_timbre_societe': droit_timbre_societe,
            }
            $http({
                url: domaineapp + '/facturation_dev.php/documentachat/Savebonexternejeton',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: 'Bon Commande Jeton Mettre a jour avec succée!!!!!!!!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    },
                    callback: function (result) {
                        console.log(result);
                    }
                });

                window.location.reload();
                $("#btnvalider").addClass('disabledbutton');
            }, function myError(response) {
                alert(response);
            });
        } else
            bootbox.dialog({
                message: 'Il faut valider la liste des articles !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });


    }

    $('#droit_timbre').unbind('change');
    $('#droit_timbre')
            .change(function (event) {
                event.preventDefault();
                var total_ttc = 0;
                if ($('#droit_timbre').val() == "1") {
                    if ($("#ttcnet_jeton").val() != '') {
                        total_ttc = parseFloat($("#ttcnet_jeton").val());
                        total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                        $("#ttcnet_jeton").val(total_ttc.toLocaleString());
                    }
                } else {
                    if ($("#ttcnet_jeton").val() != '') {
                        total_ttc = parseFloat($("#ttcnet_jeton").val());
                        total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                        $("#ttcnet_jeton").val(total_ttc.toLocaleString());
                    }
                }
            })
    $scope.AddDetailBCEDef = function () {
        var remise = 0;
        var taux = 0;
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designation').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsdeponsedef.length + 1;
            nordre = $('#nordre').val();
            var comArr = eval($scope.lignedocsdeponsedef);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($('#puht').val()));
            $('#totalhax').val(parseFloat(prixht).toFixed(3));

            var taux_fodec = 0;
            if ($("#taufodec option:selected").text() != '') {
                taux_fodec = $("#taufodec option:selected").text().trim();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodec').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
            var tva = 0;
            if ($("#tva option:selected").text() != '') {
                tva = $("#tva option:selected").text().trim();
                tva = tva.substring(0, tva.length - 1);
            }
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttc').val(parseFloat(prixttc).toFixed(3));

            if ($('#remise').val() != "") {
                taux = parseFloat($('#remise').val()) / 100;
                remise = $('#remise').val();
            }
            // debugger;
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    comArr[i].norgdre = $('#nordre').val();
                    comArr[i].codearticle = $('#codearticle').val();
                    comArr[i].designation = $('#designation').val();
                    comArr[i].idunite = $('#unite').val();
                    comArr[i].unite = $("#unite option:selected").text();
                    comArr[i].qte = $('#qte').val();
                    comArr[i].puht = $('#puht').val();
                    comArr[i].totalhTax = $('#totalhTax').val();
                    comArr[i].remise = remise;
                    comArr[i].tauxremise = taux.toFixed(2);
                    comArr[i].totalhax = $('#totalhax').val();
                    comArr[i].idtaufodec = $('#taufodec').val();
                    comArr[i].taufodec = $("#taufodec option:selected").text();
                    comArr[i].fodec = $('#fodec').val();
                    comArr[i].totalhtva = $('#totalhtva').val();
                    comArr[i].idtva = $('#tva').val();
                    comArr[i].tva = $("#tva option:selected").text();
                    comArr[i].totalttc = $('#totalttc').val();
                    comArr[i].prixttc = prixttc;
                    comArr[i].idprojet = $('#projet').val();
                    comArr[i].projet = $("#projet option:selected").text();
                    comArr[i].observation = $('#observation').val();

                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponsedef.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'codearticle': $('#codearticle').val(),
                    'unite': $("#unite option:selected").text(),
                    'idunite': $('#unite').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'totalhTax': $('#totalhTax').val(),
                    'remise': remise,
                    'tauxremise': taux,
                    'totalhax': $('#totalhax').val(),
                    'taufodec': $("#taufodec option:selected").text(),
                    'idtaufodec': $('#taufodec').val(),
                    'fodec': $("#fodec").val(),
                    'totalhtva': $('#totalhtva').val(),
                    'tva': $("#tva option:selected").text(),
                    'idtva': $('#tva').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttc').val(),
                    'projet': $("#projet option:selected").text(),
                    'idprojet': $('#projet').val(),
                    'observation': $('#observation').val()
                });
            }

            $scope.ChangerPrix();
            $scope.CalculTotalTtcBCEJeton($scope.lignedocsdeponsedef, 'ttcnet_jeton', 'bce', 'total_htax_provisoire');

            $scope.ViderChampsBCEDef();
        } else {
            var message = '';
            if ($('#designation').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.ViderChampsBCEDef = function () {
        $('#nordre').val('');
        $('#designation').val('');
        $('#codearticle').val('');
        $('#qte').val('');
        $('#tva').val('');
        $('#projet').val('');
        $('#remise').val('');
        $('#tauxremise').val('');
        $("#idprojet").trigger("chosen:updated");
        //        $('#taufodec').val('');
        //        $("#idtaufodec").trigger("chosen:updated");
        $('#tva').trigger("chosen:updated");
        $('#taufodec').val('');
        $('#taufodec').trigger("chosen:updated");
        $('#puht').val('');
        $('#totalhax').val('');
        $('#fodec').val('');
        $('#totalhtva').val('');
        $('#totalttc').val('');
        $('#desc').val('');
        $('#remise').val('');
        $('#unite').val('');

        $('#unite').trigger("chosen:updated");
        $('#observation').val('');
    }


    $scope.InitialiserTypeDoc = function () {
        $("#documentachat_filters_id_typedoc").val($('#id_type').val());
        $('#documentachat_filters_id_typedoc').trigger("chosen:updated");
        $("#documentachat_filters_id_typedoc").val($('#id_type').val()).trigger("liszt:updated");
        $("#documentachat_filters_id_typedoc").trigger("chosen:updated");
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        //        alert(($("#documentachat_filters_id_typedoc").val()));

    }

    //    $scope.ChargerCombo = function (id, data) {
    //        $(id).empty();
    //        for (i = 0; i < data.length; i++) {
    //
    //            $(id).append("<option value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " => Mnt : " + data[i].mnt + "</option>");
    //        }
    //        $(id).val('').trigger("liszt:updated");
    //        $(id).trigger("chosen:updated");
    //    }

    $scope.InialiserChamps = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }

    $scope.IntialiserBoutonCloture = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        $('#btn_cloture').addClass('disabledbutton');
        var mnt_total = $('#total_facture').val();
        var mnt_total_quitance = $('#total_quitance_bdcr').val();
        if (mnt_total_quitance <= mnt_total) {
            $('#btn_cloture').removeClass('disabledbutton');
        }
    }
    $scope.CloturerFacture = function (iddoc) {
        $scope.param = {
            "iddoc": iddoc,
            "total_facture": $('#total_facture').val(),
        }
        $http({
            url: domaineapp + '/facturation.php/Documents/Cloturerfacture',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Facture Système Clôture avec succès  !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });

            $('#btn_cloture').addClass('disabledbutton');
            //            window.location.reload();

        }, function myError(response) {
            alert(response);
        });

    }

    $scope.AfficheDoc = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/facturation.php/Documents/ListeFactures',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docfacturesbdcregroupe = data;
            //            var total = 0;
            //            total = total + floatVal(data[0]['montanttotal'].trim());
            //            $('#total_facture').val(total);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.DetailLignedoc = function (idlignedoc) {

        $scope.param = {
            'idlignedoc': idlignedoc,
        }
        $http({
            url: domaineapp + '/facturation.php/Documents/Detaillignedemandeprix',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsDemandedeprix = data;
            $scope.detailfrs = data[0];
            $('#divdetail').attr('style', 'float: right;');
            $('#documentscan').attr('style', 'display: block');
        }, function myError(response) {
            alert("Erreur ....");
        });
    }


    $scope.MisAjour = function (id, iddoc) {

        $scope.param = {
            'idligne': id,
            'iddoc': iddoc,
            'qte': $('#qte' + id).val(),
            'mnht': $('#mntht' + id).val(),
            'idtva': $('#tva' + id + ' option:selected').text()
        }
        $http({
            url: domaineapp + 'facturation.php/documentachat/Misajourlignejeton',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ttcnet_jeton').val(data);
            var ttcnet_facture_mouvement = $('#ttcnet_facture_mouvement').val();
            bootbox.dialog({
                message: 'Votre Mise à jour a été effectuée avec succès...!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            if (parseFloat(ttcnet_facture_mouvement) != parseFloat(data)) {
                bootbox.dialog({
                    message: 'Le montant TTC du jeton est encore différent au montant TTC du facture saisie dans le mouvement !<br>Vous pouvez pas encore exporter ce jeton en facture.',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                $('#export_to_facture_tab').addClass('disabledbutton');
                $('#export_to_facture').addClass('disabledbutton');
            } else {
                $('#export_to_facture_tab').removeClass('disabledbutton');
                $('#export_to_facture').removeClass('disabledbutton');
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.Supprimer = function (id, iddoc) {
        $scope.param = {
            'idligne': id,
            'iddoc': iddoc
        }
        $http({
            url: domaineapp + 'facturation.php/documentachat/Supprimerlignejeton',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ttcnet_jeton').val(data);
            window.location.reload(window);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
});
app.controller('myCtrldoc', function ($scope, $compile, $http) {

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
                // if ($('#id_budget').val() && $('#id_budget').val() != "") {
                $("#numeroengaement").val($('#id_budget').val());
                $('#numeroengaement').trigger("chosen:updated");
                //  }
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ChargerComboCaissebanque = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].nordre + " : " + data[i].libelle + " Mnt:" + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $("#budget")
            .change(function () {
                if ($("#budget").val() && $("#budget").val() != "0") {
                    var id = $("#budget").val();
                    $scope.InialiserCombo('titrebudjet', id);
                } else {
                    $("#numeroengaement").empty();
                }
            })
            .trigger("change");
    $scope.InialiserComboEngagementsansBCI = function (table, id_titre) {
        $scope.param = {
            'table': table,
            'id': id_titre
        }
        $http({
            url: domaineapp + 'budget.php/Documents/AffichesourceSanBci',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (table == "titrebudjet") {
                $scope.ChargerCombo('#numeroengaementsansbci', data);
                // $("#numeroengaement").val(id_rubrique);
                // $('#numeroengaement').trigger("chosen:updated");
                // $scope.ChargerNordre(id_rubrique);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $("#numeroengaementsansbci")
            .change(function () {
                if ($("#numeroengaementsansbci").val() && $("#numeroengaementsansbci").val() != "") {
                    $scope.ChargerNordreSansBCi($("#numeroengaementsansbci").val());
                }
            })
            .trigger("change");
    $scope.ChargerNordreSansBCi = function (id) {

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
                $('#rubrique').val($scope.detailbudget.libelle);
                $('#numeroengaement').val($scope.detailbudget.id);
                //   $('#mntttc').val(parseFloat($scope.detailbudget.mnt).toLocaleString());
                if ($scope.detailbudget.mntprovisoire || $scope.detailbudget.mntengage) {
                    var total_engage = parseFloat(mntengage) + parseFloat(mntprovisoire);
                    console.log('ff' + total_engage);
                    $('#total_engage').val(parseFloat(total_engage).toLocaleString());
                } else {
                    total_engage = 0;
                    $('#total_engage').val(parseFloat(total_engage).toLocaleString());
                }
                $('#total_engage').val(parseFloat(total_engage).toLocaleString());
                $('#rubrique').val($scope.detailbudget.libelle);
                var mnt_alloue_avec_transfert = 0;
                if ($scope.detailbudget.mntretire)
                    mnt_alloue_avec_transfert = Number.parseFloat($scope.detailbudget.mnt) + Number.parseFloat($scope.detailbudget.mntexterne) + Number.parseFloat($scope.detailbudget.mntretire);

                else
                    mnt_alloue_avec_transfert = Number.parseFloat($scope.detailbudget.mnt) + Number.parseFloat($scope.detailbudget.mntexterne);
                $('#mnt').val(mnt_alloue_avec_transfert.toLocaleString());
                $('#credit').val(parseFloat(mntengage).toLocaleString());
                $('#mntencaisser').val(parseFloat(mntencaisser));
                $('#creaditporv').val(parseFloat(mntprovisoire).toLocaleString());
                var reliq = parseFloat(mnt_alloue_avec_transfert) - mntengage;
                $('#reliq').val(parseFloat(reliq).toLocaleString());
                if ($scope.detailbudget.mntprovisoire || $scope.detailbudget.mntengage && $scope.detailbudget.mnt) {
                    $('#reliqprovisoire').val(parseFloat(mnt_alloue_avec_transfert - total_engage).toLocaleString());
                } else
                    $('#reliqprovisoire').val(parseFloat(mnt_alloue_avec_transfert).toLocaleString());
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $("#budget_sansbci")
            .change(function () {

                if ($("#budget_sansbci").val() && $("#budget_sansbci").val() != "0") {
                    var id = $("#budget_sansbci").val();
                    $scope.InialiserComboEngagementsansBCI('titrebudjet', id);
                } else {
                    $("#numeroengaement").empty();
                }
            })
            .trigger("change");
    $scope.ValiderEngagementDefSansBCI = function (id) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            'idtype': 1,
            'description': $('#documentbudget_description').val(),
            'numero': $('#documentbudget_numero').val(),
            'idtypep': 6,
            'datecreation': $('#documentbudget_datecreation').val(),
            'mntttc': $('#mntttc_horsbci ').val(),
            'id': id,
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/SavespiecepreengagementDefinitifSansBCI',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.alert({
                message: "Fiche de Engagement Définitif effectuée avec succès !",
                callback: function () {
                    document.location.href = domaineapp + 'budget.php/DocumentDef';
                }
            })

        }, function myError(response) {
            alert("Erreur ....");
        });
    }


    $scope.InialiserComboSelected = function (table, id, id_budget, id_select) {
        console.log('  table=' + table + ' id= ' + id + ' id_select=' + id_select);
        $scope.param = {
            'table': table,
            'id': id_budget

        }
        $http({
            url: domaineapp + 'budget.php/Documents/AffichesourceSanBci',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (table == "titrebudjet") {
                var id_selected_ligne = "#id_budget";

                $scope.ChargerCombo2(id_select, data, id_selected_ligne);
                // if ($('#idbudget').val() && $('#idbudget').val() != "") {
                //     $(id_select).val($(id_selected_ligne).val());
                //     $(id_select).trigger("chosen:updated");

                // }
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
        $scope.ChargerNordreSansBCi($("#numeroengaementsansbci").val());
    }
    $scope.InitialiseSelectedValue = function () {
        if ($('#id_budget').val() != '') {
            var id = $("#id_budget").val();
            var id_budget = $('#budget_sansbci').val();
            $scope.InialiserComboSelected('titrebudjet', id, id_budget, '#numeroengaementsansbci');
        }

        //  $scope.VerifAjout();
    }
    $scope.InialiserDemandePrix = function () {
        $('#id_lieu_chosen').attr('style', 'width:100%');
        $('#id_lieu_p_chosen').attr('style', 'width:100%');
        $('#idnote_p_chosen').attr('style', 'width:100%');
    }
    $scope.AfficheLignedocBCIVersBCE = function (iddoc, p) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/AfficheligneListeboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (p === '') {
                $scope.lignedocsdeponse = data;
                var comArr = eval($scope.lignedocsdeponse);
                var nordre = 1;
                for (var i = 0; i < comArr.length; i++) {
                    comArr[i].norgdre = nordre;
                    nordre++;
                }
            } else {
                $scope.lignedocsdeponsep = data;
                var comArr = eval($scope.lignedocsdeponsep);
                var nordre = 1;
                for (var i = 0; i < comArr.length; i++) {
                    comArr[i].norgdre = nordre;
                    nordre++;
                }

            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.MisAjourLigneDocBonCommandeExterne144 = function (id) {
        //        alert($('#qte_' + id).val());
        if ($('#1puht_' + id).val() != "" && $('#1qte_' + id).val() != "") {
            console.log($('#1puht_' + id).val());
            var comArr = eval($scope.lignedocsdeponse1);
            for (var i = 0; i < comArr.length; i++) {
                //alert(comArr[i].norgdre + '===' + id);
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {

                    //alert($scope.lignedocs[i].qte);
                    if (parseFloat($scope.lignedocsdeponse1[i].qte) < $('#1qte_' + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#1qte_' + id).val($scope.lignedocsdeponse1[i].qte);
                    } else {
                        $scope.lignedocsdeponse1[i].qte = $('#1qte_' + id).val();
                    }
                    $scope.lignedocsdeponse1[i].puht = $('#1puht_' + id).val();
                    // $scope.lignedocsdeponse1[i].tva = $('#1tva_' + id + ' option:selected').text();
                    // $scope.lignedocsdeponse1[i].idtva = $('#1tva_' + id).val();
                    if ($('#1desc_' + id).val() != "")
                        $scope.lignedocsdeponse1[i].observation = $('#1desc_' + id).val();
                    if ($scope.alert_bdcp === "")
                        $('#inf_alert').html($('#inf_alert').html() + '<br>Mise à jour effectuée avec succès ligne :' + comArr[i].norgdre)

                    /*
                     'puht': $('#puht').val(),
                     'tva': $("#tva option:selected").text(),
                     'idtva': $('#tva').val(),
                     'observation': $('#desc').val() 
                     
                     */

                    break;
                }
            }
        }
    }
    //__________________________________________________________________________Paramétre creation ligne doc

    $scope.designation = {
        text: ''
    };
    $scope.designationsysBDCFac = {
        text: ''
    };

    $scope.code = {
        text: ''
    };
    $scope.codearticleFac = {
        text: ''
    };
    $scope.nordre = {
        text: ''
    };
    $scope.quantite = {
        text: ''
    };
    $scope.projetss = {
        text: ''
    };
    $scope.motifs = {
        text: ''
    };
    $scope.observation = {
        text: ''
    };
    $scope.mid = {
        text: ''
    };
    $scope.unitedemander = {
        text: ''
    };
    $scope.listedocs = [];
    //__________________________________________________________________________Parametre creation fiche bci
    $scope.typedocid = {
        text: ''
    };
    $scope.iduserdemandeur = {
        text: ''
    };
    $scope.ref = {
        text: ''
    };
    $scope.valide = {
        text: ''
    };
    $scope.listesBdcp = [];
    $scope.listesContrat = [];
    //________________________Symbole 
    $scope.AjoutSymbole = function (symbole) {
        var des = $('#designation').val() + symbole.trim();
        $('#designation').val(des);
    }

    $scope.ViderChampsContratBCI = function () {

        $('#nordre').val('');
        $('#designation_contrat').val('');
        $('#codearticle_contrat').val('');
        $('#qte').val('');
        $('#tva').val('');
        $('#projet').val('');
        $("#idprojet").trigger("chosen:updated");
        $('#taufodec').val('');
        $("#idtaufodec").trigger("chosen:updated");
        $('#tva').trigger("chosen:updated");
        $('#taufodec').val('');
        $('#taufodec').trigger("chosen:updated");
        $('#puht').val('');
        $('#totalhax').val('');
        $('#fodec').val('');
        $('#totalhtva').val('');
        $('#totalttc').val('');
        $('#desc').val('');
        $('#unite').val('');
        $('#unite').trigger("chosen:updated");
        $('#observation').val('');
    }
    $scope.DeleteLigneContratBCi = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocscontrat);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocscontrat.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocscontrat[i].norgdre = conteur;
            conteur++;
        }

        //        $scope.calculerMontantTotal();
    }
    $scope.AddDetailContratBCI = function () {
        console.log('Add detail Contrat BCi');
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designation_contrat').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocscontrat.length + 1;
            nordre = $('#nordre').val();
            var comArr = eval($scope.lignedocscontrat);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($("#puht").val()));
            $('#totalhax').val(parseFloat(prixht).toFixed(3));
            var taux_fodec = $("#taufodec option:selected").text();
            taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodec').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
            var tva = $("#tva option:selected").text();
            tva = tva.substring(0, tva.length - 1);
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttc').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.lignedocscontrat[i].norgdre = $('#nordre').val();
                    $scope.lignedocscontrat[i].codearticle = $('#codearticle_contrat').val();
                    $scope.lignedocscontrat[i].designation = $('#designation_contrat').val();
                    $scope.lignedocscontrat[i].idunite = $('#unite').val();
                    $scope.lignedocscontrat[i].unite = $("#unite option:selected").text();
                    $scope.lignedocscontrat[i].qte = $('#qte').val();
                    $scope.lignedocscontrat[i].puht = $('#puht').val();
                    $scope.lignedocscontrat[i].totalhax = $('#totalhax').val();
                    $scope.lignedocscontrat[i].idtaufodec = $('#taufodec').val();
                    $scope.lignedocscontrat[i].taufodec = $("#taufodec option:selected").text();
                    $scope.lignedocscontrat[i].fodec = $('#fodec').val();
                    $scope.lignedocscontrat[i].totalhtva = $('#totalhtva').val();
                    $scope.lignedocscontrat[i].idtva = $('#tva').val();
                    $scope.lignedocscontrat[i].tva = $("#tva option:selected").text();
                    $scope.lignedocscontrat[i].totalttc = $('#totalttc').val();
                    $scope.lignedocscontrat[i].prixttc = prixttc;
                    $scope.lignedocscontrat[i].idprojet = $('#projet').val();
                    $scope.lignedocscontrat[i].projet = $("#projet option:selected").text();
                    $scope.lignedocscontrat[i].observation = $('#observation').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocscontrat.push({
                    'norgdre': nbligne,
                    'designation': $('#designation_contrat').val(),
                    'codearticle': $('#codearticle_contrat').val(),
                    'unite': $("#unite option:selected").text(),
                    'idunite': $('#unite').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'totalhax': $('#totalhax').val(),
                    'taufodec': $("#taufodec option:selected").text(),
                    'idtaufodec': $('#taufodec').val(),
                    'fodec': $("#fodec").val(),
                    'totalhtva': $('#totalhtva').val(),
                    'tva': $("#tva option:selected").text(),
                    'idtva': $('#tva').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttc').val(),
                    'projet': $("#projet option:selected").text(),
                    'idprojet': $('#projet').val(),
                    'observation': $('#observation').val()
                });
            }

            $scope.calculerMontantTotalBCIContrat();
            $scope.ViderChampsContratBCI();
        } else {
            var message = '';
            if ($('#designation_contrat').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.calculerMontantTotalBCIContrat = function () {
        console.log('dcd');
        var total = 0;
        var comArr = eval($scope.lignedocscontrat);
        for (var i = 0; i < comArr.length; i++) {
            //            alert('pr' + parseFloat($scope.detailscontratss[i].prixttc));
            if (parseFloat($scope.lignedocscontrat[i].totalttc) != 0) {
                total = parseFloat(parseFloat(total) + parseFloat($scope.lignedocscontrat[i].totalttc));
            }
        }

        $('#montantcontratTotal').val(parseFloat(total).toFixed(3));
    }
    /******add Ligne traitement facture*************************************/
    $scope.AddDetailBDCSFacture = function () {
        console.log('Add detail BDCS Facture');
        if ($("#qtesysBDCFac").val() != '')
            qtedemander = parseFloat($("#qtesysBDCFac").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designationsysBDCFac').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsdeponse.length + 1;
            nordre = $('#nordreFac').val();
            var comArr = eval($scope.lignedocsdeponse);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($("#puhtsysBDCFac").val()));
            $('#totalhaxsysBDCFac').val(parseFloat(prixht).toFixed(3));

            var taux_fodec = 0;
            if ($("#taufodecsysBDCFac option:selected").text() != '') {
                taux_fodec = $("#taufodecsysBDCFac option:selected").text().trim();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodecsysBDCFac').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtvasysBDCFac').val(parseFloat(prixthtava).toFixed(3));

            var tva = 0;
            if ($("#tvasysBDCFac option:selected").text() != '') {
                tva = $("#tvasysBDCFac option:selected").text().trim();
                tva = tva.substring(0, tva.length - 1);
            }
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttcsysBDCFac').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.lignedocsdeponse[i].norgdre = $('#nordreFac').val();
                    $scope.lignedocsdeponse[i].codearticle = $('#codearticlesysBDCFac').val();
                    $scope.lignedocsdeponse[i].designation = $('#designationsysBDCFac').val();
                    //                    $scope.lignedocsdeponse[i].idunite = $('#unitesysBDCFac').val();
                    //                    $scope.lignedocsdeponse[i].unite = $("#unitesysBDCFac option:selected").text();
                    $scope.lignedocsdeponse[i].qte = $('#qtesysBDCFac').val();
                    $scope.lignedocsdeponse[i].puht = $('#puhtsysBDCFac').val();
                    $scope.lignedocsdeponse[i].totalhax = $('#totalhaxsysBDCFac').val();
                    $scope.lignedocsdeponse[i].idtaufodec = $('#taufodecsysBDCFac').val();
                    $scope.lignedocsdeponse[i].taufodec = $("#taufodecsysBDCFac option:selected").text();
                    $scope.lignedocsdeponse[i].fodec = $('#fodecsysBDCFac').val();
                    $scope.lignedocsdeponse[i].totalhtva = $('#totalhtvasysBDCFac').val();
                    $scope.lignedocsdeponse[i].idtva = $('#tvasysBDCFac').val();
                    $scope.lignedocsdeponse[i].tva = $("#tvasysBDCFac option:selected").text();
                    $scope.lignedocsdeponse[i].totalttc = $('#totalttcsysBDCFac').val();
                    $scope.lignedocsdeponse[i].prixttc = prixttc;
                    $scope.lignedocsdeponse[i].observation = $('#observationsysBDCFac').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponse.push({
                    'norgdre': nbligne,
                    'designation': $('#designationsysBDCFac').val(),
                    'codearticle': $('#codearticlesysBDCFac').val(),
                    'qte': $("#qtesysBDCFac").val(),
                    'puht': $('#puhtsysBDCFac').val(),
                    'totalhax': $('#totalhaxsysBDCFac').val(),
                    'taufodec': $("#taufodecsysBDCFac option:selected").text(),
                    'idtaufodec': $('#taufodecsysBDCFac').val(),
                    'fodec': $("#fodecsysBDCFac").val(),
                    'totalhtva': $('#totalhtvasysBDCFac').val(),
                    'tva': $("#tvasysBDCFac option:selected").text(),
                    'idtva': $('#tvasysBDCFac').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttcsysBDCFac').val(),
                    'observation': $('#observationsysBDCFac').val()
                });
            }


            $scope.CalculTotalTtc($scope.lignedocsdeponse, 'txt_mnttotal', 'fac');
            $scope.ViderChampsBDCSFacture();
        } else {
            var message = '';
            if ($('#designationsys').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.ViderChampsBDCSFacture = function () {
        $('#nordreFac').val('');
        $('#designationsysBDCFac').val('');
        $('#codearticleFac').val('');
        $('#qtesysBDCFac').val('');
        $('#puhtsysBDCFac').val('');
        $('#totalhaxsysBDCFac').val('');
        $('#tvasysBDCFac').val('');
        $('#tvasysBDCFac').trigger("chosen:updated");
        $('#taufodecsysBDCFac').val('');
        $('#taufodecsysBDCFac').trigger("chosen:updated");
        $('#fodecsysBDCFac').val('');
        $('#totalhtvasysBDCFac').val('');
        $('#totalttcsysBDCFac').val('');
        $('#observationsysBDCFac').val('');
    }


    $scope.UpdateDetailBDCFacture = function (nordre) {
        var comArr = eval($scope.lignedocsdeponse);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordreFac').val(comArr[i].norgdre);
                $('#codearticleFac').val(comArr[i].codearticle);
                $('#designationsysBDCFac').val(comArr[i].designation);
                $('#qtesysBDCFac').val(comArr[i].qte);
                $('#puhtsysBDCFac').val(comArr[i].puht);
                $('#totalhaxsysBDCFac').val(comArr[i].totalhax);
                $('#fodecsysBDCFac').val(comArr[i].fodec);
                $('#totalhtvasysBDCFac').val(comArr[i].totalhtva);
                $('#tvasysBDCFac').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodecsysBDCFac').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttcsysBDCFac').val(comArr[i].totalttc);
                $('#observationsysBDCFac').val(comArr[i].observation);

            }
        }
    }

    $scope.DeleteFacture = function (lignedoc) {
        var index = -1;
        var comArr = eval($scope.lignedocsdeponse);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].idprojet === lignedoc.idprojet && comArr[i].quantite === lignedoc.quantite && comArr[i].motif === lignedoc.motif && comArr[i].projet === lignedoc.projet && comArr[i].norgdre === lignedoc.norgdre && comArr[i].codearticle === lignedoc.codearticle && comArr[i].designation === lignedoc.designation) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponse.splice(index, 1);
        $scope.InialiserListesLignesDoc();
    }
    $scope.InialiserListesLignesDoc = function () {
        $scope.listesdocsvieu = $scope.lignedocsdeponse;
        var comArr1 = eval($scope.listesdocsvieu);
        $scope.lignedocsdeponse = [];
        for (var i = 0; i < comArr1.length; i++) {
            nbligne = $scope.lignedocsdeponse.length + 1;
            nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
            $scope.lignedocsdeponse.push({
                'norgdre': nbligne,
                'codearticleFac': comArr1[i].codearticle,
                'designationsysBDCFac': comArr1[i].designation,
                'qtesysBDCFac': comArr1[i].qte,
                'puhtsysBDCFac': comArr1[i].puht,
                'totalhaxsysBDCFac': comArr1[i].totalhax,
                'fodecsysBDCFac': comArr1[i].fodec,
                'totalhtvasysBDCFac': comArr1[i].totalhtva,
                'tvasysBDCFac': comArr1[i].idtva,
                'idtva': comArr1[i].idtva,
                'taufodecsysBDCFac': comArr1[i].mid,
                'idtaufodec': comArr1[i].idtaufodec,
                'totalttcsysBDCFac': comArr1[i].totalttc,
                'observationsysBDCFac': comArr1[i].observation,
            });
        }
    }
    /******************************fin traiter facture***********/
    //____________________________________________________choisir document

    $scope.ValiderChoisirContrat = function (id, ttc, id_rubrique, id_titre) {
        var msg = "Veuillez sélectionner ce document Contrat !!!";
        if ($('#check_' + id + ':checked').length === 0)
            msg = "Veuillez supprimer ce document Contrat!!!";
        if (confirm(msg)) {
            var total = 0;
            //            if ($('#total').val() != "" && $('#total').val() >= 0)
            //                total = $('#total').val();
            var comArr = eval($scope.listesContrat);
            var existe = 0;
            var ligne = -1;
            for (var i = 0; i < comArr.length; i++) {
                if (id_rubrique !== comArr[i].id_rubrique) {
                    bootbox.dialog({
                        message: "Veuillez sélectionner des contrats engagés avec la même rubrique budgétaire !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    //uncheck the checkbox
                    $('#check_' + id).prop("checked", false);
                    return;
                }
                if (comArr[i].id === id) {
                    existe = 1;
                    ligne = i;
                    break;
                }
            }
            if (existe == 0) {
                $scope.listesContrat.push({
                    'id': id,
                    'ttc': ttc,
                    'id_rubrique': id_rubrique
                });
                $('#idvalid').removeClass('disabledbutton');
            } else {
                if ($('#check_' + id + ':checked').length === 0)
                    $scope.listesContrat.splice(ligne, 1);
                else
                    $scope.listesContrat[ligne].ttc = ttc;
            }
            for (var i = 0; i < $scope.listesContrat.length; i++) {
                total = parseFloat(total) + parseFloat($scope.listesContrat[i].ttc);
            }
            $('#total').val(total.toFixed(3)); //
            $('#mntttc').val($('#total').val());
        } else {
            if ($('#check_' + id + ':checked').length === 0)
                $('#check_' + id).prop("checked", true);
            else
                $('#check_' + id).prop("checked", false);
        }

        if ($scope.listesContrat.length === 0) {
            $('#idvalid').addClass('disabledbutton');
        } else {
            //selectionner la rubrique budgétaire
            $('#budget').val(id_titre);
            $scope.InialiserComboBDC('titrebudjet', id_rubrique, id_titre);
        }
    }
    $scope.AjouterBCIContratAchatEtEnvoyerUniteAchat = function (iddoc, is_valide) {
        $scope.testPlafonContrat(iddoc, is_valide);

    }
    $scope.AjouterBCIContratAchat = function (iddoc, is_valide) {
        console.log('ded');
        $('#btnvalider').attr('class', 'disabledbutton');
        $scope.typedocid.text = $('#idtypedoc').val();
        $scope.iduserdemandeur.text = $('#documentachat_id_demandeur').val();
        $scope.ref.text = $('#documentachat_reference').val();
        var valide = $('#documentachat_valide').val();
        //        alert( valide);
        if ($('#idtypedoc').val() != '9')
            var id_nature = $('#documentachat_id_objet').val();
        else
            var id_nature = '';
        var id_contrat = $('#documentachat_id_contrat').val();
        var montant_estimatif = $('#documentachat_montantestimatif').val();
        var id_frs = $('#id_frs').val();

        var total_ttc_bdc = $('#montantcontratTotal').val();
        var datecreation = "";
        if ($('#documentachat_datecreation').val())
            datecreation = $('#documentachat_datecreation').val();
        if ($scope.iduserdemandeur.text != "" && $scope.typedocid.text != "" && $scope.lignedocscontrat.length > 0) {
            $scope.document = {
                'id_utilisateur': $scope.iduserdemandeur.text,
                'typedoc': $scope.typedocid.text,
                'ref': $scope.ref.text,
                //                'valide': valide,
                'listeslignesdoc': $scope.lignedocscontrat,
                'id_nature': id_nature,
                'id_contrat': id_contrat,
                'montant_estimatif': montant_estimatif,
                'iddoc': iddoc,
                'datecreation': datecreation,
                'total_ttc_bdc': total_ttc_bdc,
                'is_valide': is_valide,
                'id_frs': id_frs
            };
            $http({
                url: domaineapp + 'achats.php/documentachat/SavedocumentBCiContrat',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                //                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');

                document.location.href = domaineapp + 'achats.php/documentachat/showdocumentBCIcontrat' + data;
            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir la nature et/ou le demandeur, et ajouter les lignes d'articles !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }


    $scope.testPlafonContrat = function (iddoc, is_valide) {
        var iddoc = $('#documentachat_id_contrat').val();
        if (iddoc != '' && iddoc != 'undefined') {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/AfficheSumBCI',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                if (data) {
                    $('#contrat_mntttc').val(data['sommettc']);
                }
                var somme = parseFloat(data['sommettc']) + parseFloat($('#montantcontratTotal').val());
                var plafonne = $('#mnt_totlacontrat').val();
                console.log('somme=' + somme + 'mnttc' + $('#contrat_mntttc').val() + " csss" + $('#montantcontratTotal').val() + 'pal=' + plafonne);

                if (somme <= plafonne) {
                    $scope.AjouterBCIContratAchat(iddoc, is_valide);
                }
                //          
                else {
                    bootbox.dialog({
                        message: "Attention tu ne peut pas depaser le plafond du contrat ce sui est égale '" + plafonne + "'</br>\n\
                                     & le montant déjà consommé est égale '" + somme + "'",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }


            }, function myError(response) {
                alert("Erreur d'ajout");
            });
            //           $scope.calculerMontantTotal(); 
        }

    }
    $scope.AfficherLignecontrat = function () {
        var iddoc = $('#documentachat_id_contrat').val();
        if (iddoc != '' && iddoc != 'undefined') {
            $scope.AffichageFournisseur(iddoc);
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/Affichelignecontrat',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.lignedocscontrat = data;
                var comArr = eval($scope.lignedocscontrat);
                var nordre = 1;
                for (var i = 0; i < comArr.length; i++) {
                    comArr[i].norgdre = nordre;
                    nordre++;
                }

                $('#montantcontratTotal').val(data[0]['montantcontrat']);
                //                $('#id_frs').val(data[0]['id_frs']);

            }, function myError(response) {
                alert("Erreur d'ajout");
            });
            //                       $scope.calculerMontantTotal(); 
        }

    }
    $scope.AffichageFournisseur = function (id) {

        $scope.param = {
            'id_contrat': id

        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Affichagefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            //            console.log('data=' + data);
            if (data && data != 0) {
                $('#id_frs').val(data['id_frs']);
                $('#rs').val(data['rs']);
                $('#mnt_totlacontrat').val(data['montantcontrat']);
                //                console.log(data['montantcontrat']);

            }

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //***update 
    $scope.UpdateDetailContratBci = function (nordre) {
        var comArr = eval($scope.lignedocscontrat);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle_contrat').val(comArr[i].codearticle);
                $('#designation_contrat').val(comArr[i].designation);
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);
                $('#totalhax').val(comArr[i].totalhax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#tva').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttc').val(comArr[i].totalttc);
                $('#projet').val(comArr[i].idprojet);
                //                 $('#projet').val(comArr[i].idprojet),

                $('#observation').val(comArr[i].observation);
                break;
                $('#projetsid').val(lignedoc.projet);
            }
        }
    }

    $scope.UpdateDetailBci = function (nordre) {
        var comArr = eval($scope.lignedocsbcicontrat);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle').val(comArr[i].codearticle);
                $('#designation').val(comArr[i].designation);
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);
                $('#totalhax').val(comArr[i].totalhax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#tva').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttc').val(comArr[i].totalttc);
                $('#projet').val(comArr[i].idprojet);
                //                 $('#projet').val(comArr[i].idprojet),

                $('#observation').val(comArr[i].observation);
                break;
                $('#projetsid').val(lignedoc.projet);

            }
        }
    }
    $("#documentachat_id_contrat")
            .change(function () {
                if ($("#documentachat_id_contrat").val() != "") {
                    $('#contratpartiel').attr('style', 'width:100%');
                    $('#contratpartiel').attr('style', 'display: block');
                    $('#general').attr('style', 'display: none');
                    $scope.AfficherLignecontrat();
                } else {
                    $('#general').attr('style', 'display: block');
                    $('#general').attr('style', 'width:100%');
                    $('#contratpartiel').attr('style', 'display: none');
                }
            })
            .trigger("change");
    $scope.ValiderChoisir = function (id, ttc, id_rubrique, id_titre) {

        var msg = "Veuillez sélectionner ce document!!!";
        if ($('#check_' + id + ':checked').length === 0)
            msg = "Veuillez supprimer ce document!!!";
        if (confirm(msg)) {
            var total = 0;
            //            if ($('#total').val() != "" && $('#total').val() >= 0)
            //                total = $('#total').val();
            var comArr = eval($scope.listesBdcp);
            var existe = 0;
            var ligne = -1;
            for (var i = 0; i < comArr.length; i++) {
                if (id_rubrique !== comArr[i].id_rubrique) {
                    bootbox.dialog({
                        message: "Veuillez sélectionner des bons de commandes internes engagés avec la même rubrique budgétaire !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    //uncheck the checkbox
                    $('#check_' + id).prop("checked", false);
                    return;
                }
                if (comArr[i].id === id) {
                    existe = 1;
                    ligne = i;
                    break;
                }
            }
            if (existe == 0) {
                $scope.listesBdcp.push({
                    'id': id,
                    'ttc': ttc,
                    'id_rubrique': id_rubrique
                });
                $('#idvalid').removeClass('disabledbutton');
            } else {
                if ($('#check_' + id + ':checked').length === 0)
                    $scope.listesBdcp.splice(ligne, 1);
                else
                    $scope.listesBdcp[ligne].ttc = ttc;
            }
            for (var i = 0; i < $scope.listesBdcp.length; i++) {
                total = parseFloat(total) + parseFloat($scope.listesBdcp[i].ttc);
            }
            $('#total').val(total.toFixed(3)); //
            $('#mntttc').val($('#total').val());
        } else {
            if ($('#check_' + id + ':checked').length === 0)
                $('#check_' + id).prop("checked", true);
            else
                $('#check_' + id).prop("checked", false);
        }

        if ($scope.listesBdcp.length === 0) {
            $('#idvalid').addClass('disabledbutton');
        } else {

            //selectionner la rubrique budgétaire
            $('#budget').val(id_titre);
            // $scope.ChargerPopupValidationEngagement($scope.listesBdcp);
        }
    }

    $scope.ValiderChoisirBDC = function (id, ttc, id_rubrique, id_titre) {
        var msg = "Veuillez sélectionner ce document!!!";
        if ($('#check_' + id + ':checked').length === 0)
            msg = "Veuillez supprimer ce document!!!";
        if (confirm(msg)) {
            var total = 0;
            //            if ($('#total').val() != "" && $('#total').val() >= 0)
            //                total = $('#total').val();
            var comArr = eval($scope.listesBdcp);
            var existe = 0;
            var ligne = -1;
            for (var i = 0; i < comArr.length; i++) {
                if (id_rubrique !== comArr[i].id_rubrique) {
                    bootbox.dialog({
                        message: "Veuillez sélectionner des bons de commandes internes engagés avec la même rubrique budgétaire !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    //uncheck the checkbox
                    $('#check_' + id).prop("checked", false);
                    return;
                }
                if (comArr[i].id === id) {
                    existe = 1;
                    ligne = i;
                    break;
                }
            }
            if (existe == 0) {
                $scope.listesBdcp.push({'id': id, 'ttc': ttc, 'id_rubrique': id_rubrique});
                $('#idvalid').removeClass('disabledbutton');
            } else {
                if ($('#check_' + id + ':checked').length === 0)
                    $scope.listesBdcp.splice(ligne, 1);
                else
                    $scope.listesBdcp[ligne].ttc = ttc;
            }
            for (var i = 0; i < $scope.listesBdcp.length; i++) {
                total = parseFloat(total) + parseFloat($scope.listesBdcp[i].ttc);
            }
            $('#total').val(total.toFixed(3)); //
            $('#mntttc').val($('#total').val());
        } else {
            if ($('#check_' + id + ':checked').length === 0)
                $('#check_' + id).prop("checked", true);
            else
                $('#check_' + id).prop("checked", false);
        }

        if ($scope.listesBdcp.length === 0) {
            $('#idvalid').addClass('disabledbutton');
        } else {
            //selectionner la rubrique budgétaire
            $('#budget').val(id_titre);
            $scope.InialiserComboBDC('titrebudjet', id_rubrique, id_titre);
        }
    }
    $scope.InialiserComboBDC = function (table, id_rubrique, id_titre) {
        $scope.param = {
            'table': table,
            'id': id_titre
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/AffichesourceBDC',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (table == "titrebudjet") {
                $scope.ChargerCombo('#numeroengaement', data);
                $("#numeroengaement").val(id_rubrique);
                $('#numeroengaement').trigger("chosen:updated");
                $scope.ChargerNordre(id_rubrique);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ChargerPopupValidationEngagement = function (listesBdcp) {
        $scope.param = {
            'list': listesBdcp
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Engagement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            angular.element('#modal_fiche').html(data);
            $('#fiche').modal('show');
            $('#documentbudget_id_type').val($('#typeenga').val());
            $('#documentbudget_id_type').trigger("chosen:updated");
            $('#documentbudget_id_type_chosen').attr('style', 'width:100%');
            $('#documentbudget_id_type').trigger("chosen:updated");
            $('#budget_chosen').attr('style', 'width:100%');
            $('#budget').trigger("chosen:updated");
            $('#numeroengaement_chosen').attr('style', 'width:100%');
            $('#numeroengaement').trigger("chosen:updated");
            // if (!isNaN(parseInt($('#budget').val())))
            //     $scope.InialiserComboBudgetEngagement('titrebudjet', 'liste_rubrique', parseInt($('#budget').val()), null);

        },
                function myError(response) {
                    console.log("Erreur ...." + response);
                });

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
                                        $('#total_engage').val('');
                                        $('#rubrique').val('');
                                        $('#mnt').val('');
                                        $('#credit').val('');
                                        $('#mntencaisser').val('');
                                        $('#creaditporv').val();
                                        $('#mntttc').val('');
                                        $('#reliq').val('');
                                        $('#reliqprovisoire').val('');
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
    $scope.ChargerComboBudgetDocument = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {

            $(id).append("<option code='" + data[i].code + "' value='" + data[i].id + "'>" + data[i].code + " : " + data[i].libelle + " => Mnt : " + data[i].mnt + "</option>");
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

    $scope.ChargerNordre = function (id) {
        if (id && !isNaN(parseInt(id))) {
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
                    $('#id_rubrique_sous_rubrique').val(id);
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
                    $('#rubrique').val($scope.detailbudget.libelle);
                    $('#numeroengaement').val($scope.detailbudget.id);
                    // $('#mntttc').val(parseFloat($scope.detailbudget.mnt).toFixed(3).toLocaleString());
                    if ($scope.detailbudget.mntprovisoire && $scope.detailbudget.mntengage) {
                        var total_engage = parseFloat(mntengage) + parseFloat(mntprovisoire);
                        console.log('ff' + total_engage);
                        $('#total_engage').val(parseFloat(total_engage).toLocaleString());
                    } else {
                        total_engage = 0;
                        $('#total_engage').val(parseFloat(total_engage).toFixed(3).toLocaleString());
                    }

                    $('#total_engage').val(parseFloat(total_engage).toFixed(3).toLocaleString());
                    $('#rubrique').val($scope.detailbudget.libelle);
                    $('#mnt').val(parseFloat($scope.detailbudget.mnt + $scope.detailbudget.mntexterne + $scope.detailbudget.mntretire).toFixed(3).toLocaleString());
                    $('#credit').val(parseFloat(mntengage).toFixed(3).toLocaleString());
                    $('#mntencaisser').val(parseFloat(mntencaisser));
                    $('#creaditporv').val(parseFloat(mntprovisoire).toFixed(3).toLocaleString());
                    var reliq = parseFloat($scope.detailbudget.mnt) - mntengage;
                    $('#reliq').val(parseFloat(reliq).toFixed(3).toLocaleString());
                    if ($scope.detailbudget.mntprovisoire && $scope.detailbudget.mntengage && $scope.detailbudget.mnt) {
                        $('#reliqprovisoire').val(parseFloat($scope.detailbudget.mnt - total_engage).toLocaleString());
                    } else
                        $('#reliqprovisoire').val(parseFloat($scope.detailbudget.mnt).toFixed(3).toLocaleString());
                }
            }, function myError(response) {
                console.log("Erreur ...." + response);
            });
        }

    }
    $scope.InialiserPreengagment = function () {
        $scope.ChargerPopupValidationEngagement($scope.listesBdcp);
    }
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

    //_______________________________________________Ajouter préengagment document par rubrique
    $scope.AjouterParDocPreengagement = function () {
        var existe = 1;
        if (isNaN(parseInt($('#id_rubrique_sous_rubrique').val()))) {
            existe = 0;
            bootbox.dialog({
                message: "Veuillez sélectionner la rubrique d'engagment !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        if (existe != 0) {
            for (var i = 0; i < $scope.listesBdcp.length; i++) {
                if ($scope.listesBdcp[i].id)
                    $scope.AjouterPreengagementParListes($scope.listesBdcp[i].id);
            }
        }
    }

    $scope.AjouterParDocPreengagementDefinitif = function () {
        var existe = 1;
        if (!$('#numeroengaement').val()) {
            existe = 0;
            bootbox.dialog({
                message: "Veuillez sélectionner la rubrique d'engagment !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        //        if (parseFloat($('#mntencaisser').val()) <= parseFloat($('#total').val())){
        //            existe = 0;
        //            bootbox.dialog({
        //                message: "Veuillez changer la rubrique d'engagment !",
        //                buttons:
        //                        {
        //                            "button":
        //                                    {
        //                                        "label": "Ok",
        //                                        "className": "btn-sm"
        //                                    }
        //                        }
        //            });
        //        }
        if (existe != 0 && confirm("Voulez-vous engager ce rubrique ?")) {
            for (var i = 0; i < $scope.listesBdcp.length; i++) {
                if ($scope.listesBdcp[i].id)
                    $scope.AjouterPreengagementParListesDef($scope.listesBdcp[i].id);
            }
        }
    }

    $scope.AjouterPreengagementParListesDef = function (iddoc) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            //            'mnt': $scope.total,
            'iddoc': iddoc,
            'idtype': 1,
            'object': $('#txt_object').val(),
            'numero': $('#documentbudget_numero').val(),
            'idtypep': 6,
            'datecreation': $('#documentbudget_datecreation').val(),
            'mntttc': $('#total').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/SavespiecepreengagementDefinitif',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Fiche de Engagement Définitif effectuée avec succès !',
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
    $scope.AjouterPreengagementParListes = function (iddoc) {
        $scope.param = {
            'idbudget': $('#id_rubrique_sous_rubrique').val(),
            'iddoc': iddoc,
            'idtype': 3,
            'object': $('#txt_object').val(),
            'numero': $('#documentbudget_numero').val(),
            'idtypep': 4,
            'datecreation': $('#documentbudget_datecreation').val(),
            'mntttc': $('#total').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/Savespiecepreengagement',
            method: "POST",
            data: $scope.param,
            dataType: 'json',
            contentType: 'application/json',
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
    $scope.AjouterParDocPreengagementBDCNULL = function () {
        var existe = 1;
        if (!$('#numeroengaement').val()) {
            existe = 0;
            bootbox.dialog({
                message: "Veuillez sélectionner la rubrique d'engagment !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        //        if (parseFloat($('#mntencaisser').val()) <= parseFloat($('#total').val())){
        //            existe = 0;
        //            bootbox.dialog({
        //                message: "Veuillez changer la rubrique d'engagment !",
        //                buttons:
        //                        {
        //                            "button":
        //                                    {
        //                                        "label": "Ok",
        //                                        "className": "btn-sm"
        //                                    }
        //                        }
        //            });
        //        }
        if (existe != 0 && confirm("Voulez-vous engager ce rubrique ?")) {
            for (var i = 0; i < $scope.listesBdcp.length; i++) {
                if ($scope.listesBdcp[i].id)
                    $scope.AjouterPreengagementParListesBDCNULL($scope.listesBdcp[i].id);
            }
        }
    }
    $scope.AjouterPreengagementParListesBDCNULL = function (iddoc) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            //            'mnt': $scope.total,
            'iddoc': iddoc,
            'idtype': 3,
            'object': $('#txt_object').val(),
            'numero': $('#documentbudget_numero').val(),
            'idtypep': 4,
            'datecreation': $('#documentbudget_datecreation').val(),
            'mntttc': $('#total').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/SavespiecepreengagementBDCNULL',
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


    //__________________________________________________________________________Listes des projets
    //ajouter préengagement document par ubique contrat

    $scope.AjouterParDocPreengagementContrat = function () {
        var existe = 1;
        if (!$('#numeroengaement').val()) {
            existe = 0;
            bootbox.dialog({
                message: "Veuillez sélectionner la rubrique d'engagment !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }

        if (existe != 0 && confirm("Voulez-vous engager ce rubrique ?")) {
            for (var i = 0; i < $scope.listesContrat.length; i++) {
                if ($scope.listesContrat[i].id)
                    $scope.AjouterPreengagementParListesContrat($scope.listesContrat[i].id);
            }
        }
    }
    $scope.AjouterPreengagementParListesContrat = function (iddoc) {
        $scope.param = {
            'idbudget': $('#numeroengaement').val(),
            //            'mnt': $scope.total,
            'iddoc': iddoc,
            'idtype': 3,
            'object': $('#txt_object').val(),
            'numero': $('#documentbudget_numero').val(),
            'idtypep': 4,
            'datecreation': $('#documentbudget_datecreation').val(),
            'mntttc': $('#total').val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/SavespiecepreengagementContrat',
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
    $scope.UniteMarche = function () {
        $('#idunitemarche').val('');
        $scope.param = {
            'libelle': $scope.unitedemander.text
        }
        $http({
            url: domaineapp + 'achats.php/documentachat/UniteMarche',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.projets = data;
            AjoutHtmlAfter(data, '#unitedemander', '#idunitemarche');
        }, function myError(response) {
            alert(response);
        });
    }
    //__________________________________________________________________________Listes des projets
    $scope.ProjetParMotif = function () {
        $('#idprojet').val('');
        $http({
            url: domaineapp + 'achats.php/documentachat/Projetparmotif',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.projets = data;
            AjoutHtmlAfter(data, '#projetsid', '#idprojet');
        }, function myError(response) {
            alert(response);
        });
    }

    //__________________________________________________________________________Recherche article by code ou designation
    $scope.RechercheArticleByCodeAndDesignation = function () {
        if ($scope.designation.text != '') {
            $scope.param = {
                'codearticle': $scope.code.text,
                'designation': $scope.designation.text
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/Articlebycodeanddesignation',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.lignedesignation = data;
                AjoutHtmlAfterDesignation(data, '#codearticle', '#designation');
                $('#ul_compte').focus();
            }, function myError(response) {
                alert(response);
            });
        } else {
            $scope.code.text = '';
            $('#codearticle').val('');
        }
    }

    $scope.goToList = function (e) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }

        switch (key) {
            // Down
            case 40:
                if ($('#ul_compte').attr('onkeydown'))
                    $('#ul_compte').focus();
                break;
                //Enter
            case 13:

                break;
        }
    }



    /***********traitement facturation*******/
    $scope.RechercheArticleByCodeAndDesignationFac = function () {
        if ($scope.designationsysBDCFac.text != '') {
            $scope.param = {
                'codearticle': $scope.codearticleFac.text,
                'designation': $scope.designationsysBDCFac.text
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/Articlebycodeanddesignation',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.lignedesignation = data;
                AjoutHtmlAfterDesignation(data, '#codearticleFac', '#designationsysBDCFac');
                $('#ul_compte').focus();
            }, function myError(response) {
                alert(response);
            });
        } else {
            $scope.code.text = '';
            $('#codearticle').val('');
        }
    }

    $scope.goToListFac = function (e) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }

        switch (key) {
            // Down
            case 40:
                if ($('#ul_compte').attr('onkeydown'))
                    $('#ul_compte').focus();
                break;
                //Enter
            case 13:

                break;
        }
    }
    /*********fin traitement facturation*************/
    //__________________________________________________________________________Affiche liste des motif
    $scope.MotifParProjet = function () {

        if ($('#idprojet').val() != "") {
            $('#mid').val('');
            $scope.param = {
                'idprojet': $('#idprojet').val(),
                'motiftext': $scope.motifs.text
            }
            $http({
                url: 'Listesmotifparprojet',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.projets = data;
                AjoutHtmlAfter(data, '#motifsid', '#mid');
            }, function myError(response) {
                alert(response);
            });
        }
    }

    //______________________________________________________________________Cherger Ligne B.C.I
    $scope.AfficheLignedocumentBCI = function (iddoc) {
        if (iddoc != '') {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/AfficheligneboninterneForEdite',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.listedocs = data;
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }
    $scope.AffichageLigneContrat = function () {

        $('#contratpartiel').attr('style', 'width:100%');
        $('#contratpartiel').attr('style', 'display: block');
        $('#general').attr('style', 'display: none');
    }

    //__________________________________________________________________________Ajouter lignedoc
    $scope.AjouterLigne = function () {
        trouve = 0;
        if ($('#designation').val() != "" && $('#quantite').val() != "") {
            if ($('#nordreid').val() == "") {
                nordre = $scope.listedocs.length + 1;
                //                nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
                if ($('#designation').val() != "" && $('#quantite').val() != "") {
                    $scope.listedocs.push({
                        'norgdre': nordre,
                        'codearticle': $('#codearticle').val(),
                        'designation': $('#designation').val(),
                        'quantite': $('#quantite').val(),
                        'unitedemander': $('#unitedemander').val(),
                        'idunitemarche': $('#idunitemarche').val(),
                        'motif': $('#motifsid').val(),
                        'observation': $('#observation').val(),
                        'projet': $('#projetsid').val(),
                        'idprojet': $('#idprojet').val(),
                        'mid': $('#mid').val()
                    });
                }
            } else {
                var comArr = eval($scope.listedocs);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordreid').val().trim() === 0) {

                        comArr[i].codearticle = $('#codearticle').val();
                        comArr[i].designation = $('#designation').val();
                        comArr[i].quantite = $('#quantite').val();
                        comArr[i].motif = $('#motifsid').val();
                        comArr[i].projet = $('#projetsid').val();
                        comArr[i].idprojet = $('#idprojet').val();
                        comArr[i].mid = $('#mid').val();
                        comArr[i].observation = $('#observation').val();
                        comArr[i].unitedemander = $('#unitedemander').val();
                        comArr[i].idunitemarche = $('#idunitemarche').val();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            bootbox.dialog({
                message: "Il faut vérifier la Quantité ou la Désignation !!!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        //        if (trouve === 1)
        $scope.InaliserChamps();
    }
    $scope.AjouterLigneMP = function () {
        if ($('#nordreid').val() == "") {
            nbligne = $scope.listedocs.length + 1;
            nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
            if ($('#idprojet').val() != "" && $('#designation').val() != "" && $('#quantite').val() != "" && $('#projetsid').val() != "") {
                $scope.listedocs.push({
                    'norgdre': nbligne,
                    'codearticle': $('#codearticle').val(),
                    'designation': $('#designation').val(),
                    'quantite': $('#quantite').val(),
                    'motif': $('#motifsid').val(),
                    'projet': $('#projetsid').val(),
                    'idprojet': $('#idprojet').val(),
                    'mid': $('#mid').val(),
                    'unitedemander': $('#unitedemander').val(),
                    'idunitemarche': $('#idunitemarche').val(),
                    'observation': $('#motifsid').val()
                });
                $scope.InaliserChamps();
            } else {
                bootbox.dialog({
                    message: 'Veuillez Vérifier les champs: Projet ou designation ou quantité...',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        } else {
            if ($('#idprojet').val() != "" && $('#designation').val() != "" && $('#quantite').val() != "" && $('#projetsid').val() != "") {
                var comArr = eval($scope.listedocs);
                for (var i = 0; i < comArr.length; i++) {
                    if (parseFloat(comArr[i].norgdre) === parseFloat($('#nordreid').val())) {
                        comArr[i].codearticle = $('#codearticle').val();
                        comArr[i].designation = $('#designation').val();
                        comArr[i].quantite = $('#quantite').val();
                        comArr[i].motif = $('#motifsid').val();
                        comArr[i].projet = $('#projetsid').val();
                        comArr[i].idprojet = $('#idprojet').val();
                        comArr[i].mid = $('#mid').val();
                        comArr[i].unitedemander = $('#unitedemander').val();
                        comArr[i].idunitemarche = $('#idunitemarche').val();
                        comArr[i].observation = $('#motifsid').val();
                        break;
                    }
                }
                $scope.InaliserChamps();
            } else {
                bootbox.dialog({
                    message: 'Veuillez Vérifier les champs: Projet ou designation ou quantité...',
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
    //__________________________________________________________________________Inialiser les champs
    $scope.InaliserChamps = function () {
        $('#nordreid').val('');
        $('#codearticle').val('');
        $('#designation').val('');
        $('#quantite').val('');
        $('#unitedemander').val('');
        $('#motifsid').val('');
        $('#projetsid').val('');
        $('#idprojet').val('');
        $('#mid').val('');
        $(".testul").remove();
        $('#observation').val('');
        $('#idunitemarche').val('');
        $('#id_unite').val('');
        $('#id_projet').val('');
        $("#id_unite").val('').trigger("chosen:updated");
        $("#id_projet").val('').trigger("chosen:updated");
    }
    //__________________________________________________________________________Delete ligne doc
    $scope.Delete = function (lignedoc) {
        var index = -1;
        var comArr = eval($scope.listedocs);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].idprojet === lignedoc.idprojet && comArr[i].quantite === lignedoc.quantite && comArr[i].motif === lignedoc.motif && comArr[i].projet === lignedoc.projet && comArr[i].norgdre === lignedoc.norgdre && comArr[i].codearticle === lignedoc.codearticle && comArr[i].designation === lignedoc.designation) {
                index = i;
                break;
            }
        }
        $scope.listedocs.splice(index, 1);
        $scope.InialiserListesLignesDoc();
    }
    //__________________________________________________________________________Function Inialiser les ordre des lignes
    $scope.InialiserListesLignesDoc = function () {
        $scope.listesdocsvieu = $scope.listedocs;
        var comArr1 = eval($scope.listesdocsvieu);
        $scope.listedocs = [];
        for (var i = 0; i < comArr1.length; i++) {
            nbligne = $scope.listedocs.length + 1;
            nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
            $scope.listedocs.push({
                'norgdre': nbligne,
                'codearticle': comArr1[i].codearticle,
                'designation': comArr1[i].designation,
                'quantite': comArr1[i].quantite,
                'motif': comArr1[i].motif,
                'projet': comArr1[i].projet,
                'idprojet': comArr1[i].idprojet,
                'mid': comArr1[i].mid
            });
        }
    }
    //__________________________________________________________________________Mis ajour ligne doc
    $scope.MisAJour = function (lignedoc) {
        $('#nordreid').val(lignedoc.norgdre);
        $('#codearticle').val(lignedoc.codearticle);
        $('#designation').val(lignedoc.designation);
        $('#quantite').val(lignedoc.quantite);
        $('#unitedemander').val(lignedoc.unitedemander);
        $('#motifsid').val(lignedoc.motif);
        $('#projetsid').val(lignedoc.projet);
        $('#idprojet').val(lignedoc.idprojet);
        $('#mid').val(lignedoc.mid);
        $('#observation').val(lignedoc.observation);
        $('#idunitemarche').val(lignedoc.idunitemarche);
        $('#id_unite').val(lignedoc.idunitemarche);
        $("#id_unite").val(lignedoc.idunitemarche).trigger("chosen:updated");
        $('#id_projet').val(lignedoc.idprojet);
        $("#id_projet").val(lignedoc.idprojet).trigger("chosen:updated");
        $(".testul").remove();
    }
    //__________________________________________________________________________Vider tous les champs
    $scope.ViderChamps = function () {
        $scope.InaliserChamps();
    }

    //__________________________________________________________________________Function Document
    $scope.AjouterBCI = function () {
        $('#btnvalider').attr('class', 'disabledbutton');
        $scope.typedocid.text = $('#idtypedoc').val();
        $scope.iduserdemandeur.text = $('#documentachat_id_demandeur').val();
        $scope.ref.text = $('#documentachat_reference').val();
        if ($scope.iduserdemandeur.text != "" && $scope.typedocid.text != "" && $scope.listedocs.length > 0) {
            $scope.document = {
                'id_utilisateur': $scope.iduserdemandeur.text,
                'typedoc': $scope.typedocid.text,
                'ref': $scope.ref.text,
                'listeslignesdoc': $scope.listedocs
            };
            $http({
                url: domaineapp + 'marchee.php/documentachat/Savedocument',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                document.location.href = 'showdocument' + data;
            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir la nature et/ou le demandeur, et ajouter les lignes d'articles !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    //**************conrole sur le reference


    $scope.Testerlexistance = function () {
        var code = $('#documentachat_reference').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'achats.php/documentachat/testexistancereference',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            //            alert(data + data['id'] + data['reference'] );
            if (data && data != 0) {
                $('#documentachat_reference').val(data['reference']);
                //                 bootbox.dialog({
                //                message: "Cette Référence existe déjà !!!",
                //                buttons:
                //                        {
                //                            "button":
                //                                    {
                //                                        "label": "Ok",
                //                                        "className": "btn-sm"
                //                                    }
                //                        }
                //            });
                document.location.href = "edit?id=" + data['id'];
                //            
            }


        }, function myError(response) {
            alert(response);
        });
    }
    $("#documentachat_reference")
            .change(function () {
                if ($("#documentachat_reference").val() != "") {

                    $scope.Testerlexistance();
                }

            })
            .trigger("change");
    //__________________________________________________________________________Function Document
    $scope.AjouterBCIAchat = function (iddoc) {
        $('#btnvalider').attr('class', 'disabledbutton');
        $scope.typedocid.text = $('#idtypedoc').val();
        $scope.iduserdemandeur.text = $('#documentachat_id_demandeur').val();
        $scope.ref.text = $('#documentachat_reference').val();
        var valide = $('#documentachat_valide').val();
        //        alert( valide);
        if ($('#idtypedoc').val() != '9')
            var id_nature = $('#documentachat_id_objet').val();
        else
            var id_nature = '';
        var id_contrat = $('#documentachat_id_contrat').val();
        var montant_estimatif = $('#documentachat_montantestimatif').val();
        var datecreation = "";
        if ($('#documentachat_datecreation').val())
            datecreation = $('#documentachat_datecreation').val();
        if ($scope.iduserdemandeur.text != "" && $scope.typedocid.text != "" && $scope.listedocs.length > 0) {
            $scope.document = {
                'id_utilisateur': $scope.iduserdemandeur.text,
                'typedoc': $scope.typedocid.text,
                'ref': $scope.ref.text,
                'valide': valide,
                'listeslignesdoc': $scope.listedocs,
                'id_nature': id_nature,
                'id_contrat': id_contrat,
                'montant_estimatif': montant_estimatif,
                'iddoc': iddoc,
                'datecreation': datecreation
            };
            $http({
                url: domaineapp + 'achats.php/documentachat/Savedocument',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                //if (window.location.href.indexOf("achats.php") > 0    ||  window.location.href.indexOf("achats.php") > 0)
                document.location.href = domaineapp + 'achats.php/documentachat/showdocument' + data;
                //                else
                //                    document.location.href = domaineapp + 'budget.php/documentachat/showdocument' + data;
            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir la nature et/ou le demandeur, et ajouter les lignes d'articles !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }


    $scope.AjouterBCIAchatEtEnvoyerUniteAchat = function (iddoc, is_valide) {
        $('#btnvalider').attr('class', 'disabledbutton');
        $scope.typedocid.text = $('#idtypedoc').val();
        $scope.iduserdemandeur.text = $('#documentachat_id_demandeur').val();
        $scope.ref.text = $('#documentachat_reference').val();
        var valide = $('#documentachat_valide').val();
        //        alert( valide);
        if ($('#idtypedoc').val() != '9')
            var id_nature = $('#documentachat_id_objet').val();
        else
            var id_nature = '';
        var id_contrat = $('#documentachat_id_contrat').val();
        var montant_estimatif = $('#documentachat_montantestimatif').val();
        var datecreation = "";
        if ($('#documentachat_datecreation').val())
            datecreation = $('#documentachat_datecreation').val();
        if ($scope.iduserdemandeur.text != "" && $scope.typedocid.text != "" && $scope.listedocs.length > 0) {
            $scope.document = {
                'id_utilisateur': $scope.iduserdemandeur.text,
                'typedoc': $scope.typedocid.text,
                'ref': $scope.ref.text,
                //                'valide': valide,
                'listeslignesdoc': $scope.listedocs,
                'id_nature': id_nature,
                'id_contrat': id_contrat,
                'montant_estimatif': montant_estimatif,
                'iddoc': iddoc,
                'datecreation': datecreation,
                'is_valide': is_valide
            };
            $http({
                url: domaineapp + 'achats.php/documentachat/Savedocument',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');

                document.location.href = domaineapp + 'achats.php/documentachat/showdocument' + data;

            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir la nature et/ou le demandeur, et ajouter les lignes d'articles !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }


    $scope.ModifierBCIEnvoyerUniteControlegestion = function (iddoc, is_valide) {
        $('#btnvalider').attr('class', 'disabledbutton');
        $scope.typedocid.text = $('#idtypedoc').val();
        $scope.iduserdemandeur.text = $('#documentachat_id_demandeur').val();
        $scope.ref.text = $('#documentachat_reference').val();
        var valide = $('#documentachat_valide').val();
        //        alert( valide);
        if ($('#idtypedoc').val() != '9')
            var id_nature = $('#documentachat_id_objet').val();
        else
            var id_nature = '';
        var id_contrat = $('#documentachat_id_contrat').val();
        var montant_estimatif = $('#documentachat_montantestimatif').val();
        var datecreation = "";
        if ($('#documentachat_datecreation').val())
            datecreation = $('#documentachat_datecreation').val();
        if ($scope.iduserdemandeur.text != "" && $scope.typedocid.text != "" && $scope.listedocs.length > 0) {
            $scope.document = {
                'id_utilisateur': $scope.iduserdemandeur.text,
                'typedoc': $scope.typedocid.text,
                'ref': $scope.ref.text,
                //                'valide': valide,
                'listeslignesdoc': $scope.listedocs,
                'id_nature': id_nature,
                'id_contrat': id_contrat,
                'montant_estimatif': montant_estimatif,
                'iddoc': iddoc,
                'datecreation': datecreation,
                'is_valide': is_valide
            };
            $http({
                url: domaineapp + 'achats.php/documentachat/SavedocumentEtEnvoyecg',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                //if (window.location.href.indexOf("achats.php") > 0    ||  window.location.href.indexOf("achats.php") > 0)
                document.location.href = domaineapp + 'achats.php/documentachat/showdocument' + data;
                document.location.reload();
                //                else
                //                    document.location.href = domaineapp + 'budget.php/documentachat/showdocument' + data;
            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir la nature et/ou le demandeur, et ajouter les lignes d'articles !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    //__________________________________________________________________________Function Document
    $scope.AjouterBCIMPAchat = function (iddoc) {
        $('#btnvalider').attr('class', 'disabledbutton');
        $scope.typedocid.text = $('#idtypedoc').val();
        $scope.iduserdemandeur.text = $('#documentachat_id_demandeur').val();
        $scope.ref.text = $('#documentachat_reference').val();
        var montant_estimatif = $('#documentachat_montantestimatif').val();
        if ($scope.iduserdemandeur.text != "" && $scope.typedocid.text != "" && $scope.listedocs.length > 0) {
            $scope.document = {
                'id_utilisateur': $scope.iduserdemandeur.text,
                'typedoc': $scope.typedocid.text,
                'ref': $scope.ref.text,
                'listeslignesdoc': $scope.listedocs,
                'montant_estimatif': montant_estimatif,
                'iddoc': iddoc
            };
            $http({
                url: domaineapp + 'marchee.php/documentachat/Savedocument',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                document.location.href = domaineapp + 'marchee.php/documentachat/showdocument' + data;
            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Veuillez choisir le demandeur et/ou ajouter les lignes d'articles !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    //___________________________________Affiche BCE
    $scope.AfficheBCE = function () {

        //        $('#dynamic-table').DataTable({
        //            dom: 'Bfrtip',
        //            buttons: [
        //                'csv', 'excel', 'pdf', 'print'
        //            ],
        //            'select': {
        //                'style': 'multi'
        //            },
        //            'order': [[1, 'asc']]
        //        });
        if ($('#idfrsselcet').val() != "") {
            $('#idfrs').val($('#idfrsselcet').val());
        }
    }
});
app.controller('myCtrldocvisa', function ($scope, $http) {

    // paramétre global
    $scope.fnalert = "";
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

    $scope.ChargerVisa = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        };
        $http({
            url: domaineapp + '/achats.php/documentachat/ChargerVisa',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.visadonnees = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //__________________________________________________________________________Recherche article by code ou designation
    $scope.ValiderChoix = function (id, qtedemander) {
        var input1 = $('#input_qte_pe' + id).val();
        var input2 = $('#input_qte_pa' + id).val();
        qtechan = parseFloat(input1) + parseFloat(input2);
        qtediff = parseFloat(qtedemander) - parseFloat(qtechan);
        if (qtediff >= 0) {

            $scope.param = {
                'input1': input1,
                'input2': input2,
                'id': id
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/Validerligne',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                if ($scope.fnalert != "1")
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
        } else
            bootbox.dialog({
                message: 'Vérifiez les quantités que vous avez saisie',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }

    //__________________________________________________________________________Recherche article by code ou designation
    $scope.ValiderTousChoix = function (listes_id) {
        $scope.fnalert = "1";
        var ids = listes_id.split(';');
        for (var i = 0; i <= ids.length; i++) {
            if (ids[i] && ids[i] != "") {
                var ch = ids[i].split("-");
                var id = ch[0];
                var qtedemander = ch[1];
                $scope.ValiderChoix(id, qtedemander);
            }
        }
        if (confirm("Mise à jour des quantités vérifiée !!! "))
            $("#btn_ajout").removeClass('disabledbutton');
    }

    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].nordre + " : " + data[i].libelle + " Mnt:" + data[i].mnt + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

    $scope.ChargerComboBudget = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

    $scope.InialiserComboBudget = function () {
        $scope.param = {
            'exercice': $("#id_exercice").val()
        }
        $http({
            url: domaineapp + 'budget.php/documentbudget/AfficheBudgetByExercice',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerComboBudget('#id_budget', data);
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $("#id_exercice")
            .change(function () {
                if ($("#id_exercice").val() && $("#id_exercice").val() != "0") {
                    $scope.InialiserComboBudget();
                } else {
                    $("#id_budget").empty();
                }
            })
            .trigger("change");
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
            $scope.ChargerCombo('#id_rubrique', data);
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $("#id_budget")
            .change(function () {
                if ($("#id_budget").val() && $("#id_budget").val() != "0") {
                    var id = $("#id_budget").val();
                    $scope.InialiserCombo('titrebudjet', id);
                } else {
                    $("#id_rubrique").empty();
                }
            })
            .trigger("change");


});
app.controller('CtrlDemandeprix', function ($scope, $http) {

    $scope.fournisseur = {
        text: ''
    };
    $scope.reffournisseur = {
        text: ''
    };
    $scope.fournisseur1 = {
        text: ''
    };
    $scope.reffournisseur1 = {
        text: ''
    };
    //    $scope.docDemandePrix = [];
    $scope.lignedocs = [];
    $scope.lignelignecontratAvenant = [];
    $scope.lignedocsdeponse = [];
    $scope.lignedocsdeponsep = [];
    $scope.enteteBExtrene = [];
    $scope.lignedocsdeponse1 = [];
    $scope.fodeclistes = [];
    $scope.lignedocscontratp = [];
    $scope.lignedocslignecontratp = [];
    $scope.alert_bdcp = "";
    $scope.UpdateDetailBcE = function (nordre) {
        var comArr = eval($scope.lignedocsdeponsep);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle').val(comArr[i].codearticle);
                $('#designation').val(comArr[i].designation);
                $('#unite').val(comArr[i].idunite);
                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);
                $('#totalhax').val(comArr[i].totalhax);
                $('#totalhTax').val(comArr[i].totalhTax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#tva').val(comArr[i].id_tva);
                $('#id_tva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#remise').val((comArr[i].tauxremise * 100).toFixed(3));
                $('#totalttc').val(comArr[i].totalttc);
                $('#projet').val(comArr[i].idprojet);
                //                 $('#projet').val(comArr[i].idprojet),
                $('#observation').val(comArr[i].observation);
            }
        }
    }
    $scope.claculerDroittimber = function () {
        var total_ttc = 0;

        if ($('#documentachat_droittimbre').val() == "1") {
            if ($("#total_ttc_provisoire").val() != '') {
                total_ttc = parseFloat($("#total_ttc_provisoire").val());
                total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                $("#total_ttc_provisoire").val(total_ttc.toLocaleString());
            }
        }
        if ($('#documentachat_droittimbre').val() == "0") {
            if ($("#total_ttc_provisoire").val() != '') {
                total_ttc = parseFloat($("#total_ttc_provisoire").val());
                total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                $("#total_ttc_provisoire").val(total_ttc.toLocaleString());
            }
        }
        // $scope.calculerMontantTotal();

    }

    $scope.claculerDroittimberbdc = function () {
        var total_ttc = 0;
        if ($('#bdc_droittimbre').val() == "1") {

            if ($("#txt_mnttotal_bdc").val() != '' && $("#txt_mnttotal_bdc").val() != 'undefined') {

                total_ttc = parseFloat($("#txt_mnttotal_bdc").val());
                total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                $("#txt_mnttotal_bdc").val(total_ttc.toLocaleString());
            }
        }
        if ($('#bdc_droittimbre').val() == "0") {
            //            alert($("#documentachat_droittimbre").val() + "fffffff");
            if ($("#txt_mnttotal_bdc").val() != '' && $("#txt_mnttotal_bdc").val() != 'undefined') {
                total_ttc = parseFloat($("#txt_mnttotal_bdc").val());
                total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                $("#txt_mnttotal_bdc").val(total_ttc.toLocaleString());
            }
        }
    }

//    $scope.claculerDroittimberbdcFacture = function () {
//        var total_ttc = 0;
//        if ($('#droit_timbre_bdc_fac_sys').val() == "1") {
//
//            if ($("#txt_mnttotal").val() != '' && $("#txt_mnttotal").val() != 'undefined') {
//
//                total_ttc = parseFloat($("#txt_mnttotal").val());
//                total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
//                $("#txt_mnttotal").val(total_ttc.toLocaleString());
//            }
//        }
//        if ($('#droit_timbre_bdc_fac_sys').val() == "0") {
//            //            alert($("#documentachat_droittimbre").val() + "fffffff");
//            if ($("#txt_mnttotal").val() != '' && $("#txt_mnttotal").val() != 'undefined') {
//                total_ttc = parseFloat($("#txt_mnttotal").val());
//                total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
//                $("#txt_mnttotal").val(total_ttc.toLocaleString());
//            }
//        }
//    }
    $('#droit_timbre_sys_bdc').unbind('change');
    $('#droit_timbre_sys_bdc')
            .change(function (event) {
                event.preventDefault();
                var total_ttc = 0;
                if ($('#droit_timbre_sys_bdc').val() == "1") {

                    if ($("#total_ttc_bdc").val() != '') {
                        //                        total_ttc = parseFloat($("#total_ttc_bdc").val());
                        //                        total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                        //                        $("#total_ttc_bdc").val(total_ttc.toLocaleString());
                    }
                } else {
                    $('#valeurdroit_societe').val(0.000);
                    if ($("#total_ttc_bdc").val() != '') {
                        //                        total_ttc = parseFloat($("#total_ttc_bdc").val());
                        //                        total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                        //                        $("#total_ttc_bdc").val(total_ttc.toLocaleString());
                    }
                }
            })
    //                $scope.claculerDroittimberDef();         
    $('#droit_timbre_sys').unbind('change');
    $('#droit_timbre_sys')
            .change(function (event) {
                event.preventDefault();
                var total_ttc = 0;
                if ($('#droit_timbre_sys').val() == "1") {
                    if ($("#total_ttc").val() != '') {
                        total_ttc = parseFloat($("#total_ttc").val());
                        total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                        $("#total_ttc").val(total_ttc.toLocaleString());
                    }
                } else {
                    if ($("#total_ttc").val() != '') {
                        total_ttc = parseFloat($("#total_ttc").val());
                        total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                        $("#total_ttc").val(total_ttc.toLocaleString());
                    }
                }


                //                $scope.claculerDroittimberDef();
            })

    $scope.ValiderDroitTimbreFacture = function () {
        if ($("#droit_timbre").is(':checked') == true) {
            $scope.param = {
                "id_droittimbre": $('#droit_timbre').val()
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/AficheroitTimbreSociete',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $("#valeurdroit_societe").val(data['valeur']);
                $scope.calculerMnTTcApresDroitTimbreFacture();
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $('#valeurdroit_societe').val(0.000);
            var mnttc_sansdroit = $('#txt_mnttotal_hidden').val();
            $('#txt_mnttotal').val(mnttc_sansdroit);

        }
    }

    $scope.calculerMnTTcApresDroitTimbreFacture = function () {
        var taux = 0;
        if ($('#txt_mnttotal').val() != '') {
            if ($('#txt_mnttotal').val() && $('#valeurdroit').val() != '0') {
                var droittimbre = parseFloat($('#valeurdroit_societe').val());

                var pttc = parseFloat($('#txt_mnttotal_hidden').val());
                var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                $('#txt_mnttotal').val(total_pttc.toFixed(3));
            }
        }
    }

//    $('#droit_timbre_bdc_fac_sys').unbind('change');
//    $('#droit_timbre_bdc_fac_sys')
//            .change(function (event) {
//                event.preventDefault();
//                var total_ttc = 0;
//                if ($('#droit_timbre_bdc_fac_sys').val() == "1") {
//                    if ($("#txt_mnttotal").val() != '') {
//                        total_ttc = parseFloat($("#txt_mnttotal").val());
//                        total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
//                        $("#txt_mnttotal").val(total_ttc.toLocaleString());
//                    }
//                } else {
//                    if ($("#txt_mnttotal").val() != '') {
//                        total_ttc = parseFloat($("#txt_mnttotal").val());
//                        total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
//                        $("#txt_mnttotal").val(total_ttc.toLocaleString());
//                    }
//                }
//
//
//                //                $scope.claculerDroittimberDef();
//            })
    $('#droit_timbre_bdc_sys').unbind('change');
    $('#droit_timbre_bdc_sys')
            .change(function (event) {
                event.preventDefault();
                var total_ttc = 0;
                if ($('#droit_timbre_bdc_sys').val() == "1") {
                    if ($("#total_ttc_bdc").val() != '') {
                        total_ttc = parseFloat($("#total_ttc_bdc").val());
                        total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                        $("#total_ttc_bdc").val(total_ttc.toLocaleString());
                    }
                } else {
                    if ($("#total_ttc_bdc").val() != '') {
                        total_ttc = parseFloat($("#total_ttc_bdc").val());
                        total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                        $("#total_ttc_bdc").val(total_ttc.toLocaleString());
                    }
                }
            })
    $('#bdc_droittimbre').unbind('change');
    $('#bdc_droittimbre')
            .change(function (event) {
                event.preventDefault();
                var total_ttc = 0;
                if ($('#bdc_droittimbre').val() == "1") {
                    if ($("#txt_mnttotal_bdc").val() != '') {
                        total_ttc = parseFloat($("#txt_mnttotal_bdc").val());
                        total_ttc = parseFloat(total_ttc + 0.600).toFixed(3);
                        $("#txt_mnttotal_bdc").val(total_ttc.toLocaleString());
                    }
                } else {
                    if ($("#txt_mnttotal_bdc").val() != '') {
                        total_ttc = parseFloat($("#txt_mnttotal_bdc").val());
                        total_ttc = parseFloat(total_ttc - 0.600).toFixed(3);
                        $("#txt_mnttotal_bdc").val(total_ttc.toLocaleString());
                    }
                }
            })
    $scope.UpdateDetailBcES = function (nordre) {
        var comArr = eval($scope.lignedocsdeponse);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordresys').val(comArr[i].norgdre);
                $('#codearticlesys').val(comArr[i].codearticle);
                $('#designationsys').val(comArr[i].designation);
                $('#unite').val(comArr[i].idunite);
                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qtesys').val(comArr[i].qte);
                $('#puhtsys').val(comArr[i].puht);
                $('#totalhTaxsys').val(comArr[i].totalhtax);
                $('#totalhaxsys').val(comArr[i].totalhax);
                $('#fodecsys').val(comArr[i].fodec);
                $('#totalhtvasys').val(comArr[i].totalhtva);

                $('#tvasys').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");

                $('#remisesys').val((comArr[i].tauxremise * 100).toFixed(3));
                $('#taufodecsys').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttcsys').val(comArr[i].totalttc);
                $('#observationsys').val(comArr[i].observation);
            }
        }
    }

    $scope.UpdateDetailBDCS = function (nordre) {
        //        alert('ddsc');
        var comArr = eval($scope.lignedocsdeponse);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordresysBDC').val(comArr[i].norgdre);
                $('#codearticlesysBDC').val(comArr[i].codearticle);
                $('#designationsysBDC').val(comArr[i].designation);
                //                $('#unite').val(comArr[i].idunite);
                //                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qtesysBDC').val(comArr[i].qte);
                $('#puhtsysBDC').val(comArr[i].puht);
                $('#totalhaxsysBDC').val(comArr[i].totalhax);
                $('#totalhTaxsys').val(comArr[i].totalhtax);
                $('#remisesys').val((comArr[i].tauxremise * 100).toFixed(3));
                $('#fodecsysBDC').val(comArr[i].fodec);
                $('#totalhtvasysBDC').val(comArr[i].totalhtva);
                $('#tvasysBDC').val(comArr[i].id_tva);
                $('#id_tva').val(comArr[i].id_tva).trigger("chosen:updated");
                $('#taufodecsysBDC').val(comArr[i].idtaufodec);
                $('#idtaufodecBDC').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttcsysBDC').val(comArr[i].totalttc);
                $('#observationsysBDC').val(comArr[i].observation);
            }
        }
    }
    $scope.UpdateDetailBDC = function (nordre) {
        var comArr = eval($scope.lignedocsdeponse1);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle').val(comArr[i].codearticle);
                $('#designation').val(comArr[i].designation);
                $('#unite').val(comArr[i].idunite);
                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);

                $('#totalhax').val(comArr[i].totalhax);
                $('#totalhTax').val(comArr[i].totalhTax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#remise').val((comArr[i].tauxremise * 100).toFixed(3));
                $('#totalttc').val(comArr[i].totalttc);
                $('#tva').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#projet').val(comArr[i].idprojet);
                //                 $('#projet').val(comArr[i].idprojet),
                $('#observation').val(comArr[i].observation);
            }
        }
    }

    $scope.AddDetailBCE = function () {
        var remise = 0;
        var taux = 0;
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designation').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsdeponsep.length + 1;
            nordre = $('#nordre').val();
            var comArr = eval($scope.lignedocsdeponsep);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($('#puht').val()));
            $('#totalhax').val(parseFloat(prixht).toFixed(3));

            var taux_fodec = 0;
            if ($("#taufodec option:selected").text() != '') {
                taux_fodec = $("#taufodec option:selected").text().trim();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodec').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
            var tva = 0;
            if ($("#tva option:selected").text() != '') {
                txt_tva = $("#tva option:selected").text().trim();
                tva = txt_tva.substring(0, txt_tva.length - 1);
            }
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttc').val(parseFloat(prixttc).toFixed(3));

            if ($('#remise').val() != "") {
                taux = parseFloat($('#remise').val()) / 100;
                remise = $('#remise').val();
            }
            // debugger;
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    comArr[i].norgdre = $('#nordre').val();
                    comArr[i].codearticle = $('#codearticle').val();
                    comArr[i].designation = $('#designation').val();
                    comArr[i].idunite = $('#unite').val();
                    comArr[i].unite = $("#unite option:selected").text();
                    comArr[i].qte = $('#qte').val();
                    comArr[i].puht = $('#puht').val();
                    comArr[i].totalhTax = $('#totalhTax').val();
                    comArr[i].remise = remise;
                    comArr[i].tauxremise = taux.toFixed(2);
                    comArr[i].totalhax = $('#totalhax').val();
                    comArr[i].idtaufodec = $('#taufodec').val();
                    comArr[i].taufodec = $("#taufodec option:selected").text();
                    comArr[i].fodec = $('#fodec').val();
                    comArr[i].totalhtva = $('#totalhtva').val();
                    comArr[i].id_tva = $('#tva').val();
                    comArr[i].tva = $("#tva option:selected").text();
                    comArr[i].totalttc = $('#totalttc').val();
                    comArr[i].prixttc = prixttc;
                    comArr[i].idprojet = $('#projet').val();
                    comArr[i].projet = $("#projet option:selected").text();
                    comArr[i].observation = $('#observation').val();

                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponsep.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'codearticle': $('#codearticle').val(),
                    'unite': $("#unite option:selected").text(),
                    'idunite': $('#unite').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'totalhTax': $('#totalhTax').val(),
                    'remise': remise,
                    'tauxremise': taux,
                    'totalhax': $('#totalhax').val(),
                    'taufodec': $("#taufodec option:selected").text(),
                    'idtaufodec': $('#taufodec').val(),
                    'fodec': $("#fodec").val(),
                    'totalhtva': $('#totalhtva').val(),
                    'tva': $("#tva option:selected").text(),
                    'id_tva': $('#tva').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttc').val(),
                    'projet': $("#projet option:selected").text(),
                    'idprojet': $('#projet').val(),
                    'observation': $('#observation').val()
                });
            }

            $scope.ChangerPrix();
            $scope.CalculTotalTtc($scope.lignedocsdeponsep, 'total_ttc_provisoire', 'bce', 'total_htax_provisoire');
            //$scope.CalculTotalTtc($scope.lignedocsdeponsep, 'total_ttc_provisoire')
            $scope.ViderChampsBCE();
        } else {
            var message = '';
            if ($('#designation').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.ChangerPrixListeRemisecommande = function (p) {
        if (p != 'bcep') {
            var comArr = eval($scope.lignedocsdeponse1);
            for (i = 0; i < comArr.length; i++) {
                var puh_initial = parseFloat($scope.lignedocsdeponse1[i].puht);
                var taux_fodec = 0;
                if ($scope.lignedocsdeponse1[i].taufodec)
                    taux_fodec = parseFloat($scope.lignedocsdeponse1[i].taufodec);
                var pu = puh_initial;
                var taux = parseFloat($scope.lignedocsdeponse1[i].tauxremise);
                $scope.lignedocsdeponse1[i].remise = parseFloat(pu * taux).toFixed(3);
                if (taux > 0) {
                    pu = pu - (pu * taux);
                }
                var qtedemander = $scope.lignedocsdeponse1[i].qte;
                var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
                var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
                var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
                var prixthtava = prixht + fodec;
                var tva = 0;
                if ($scope.lignedocsdeponse1[i].tva)
                    tva = parseFloat($scope.lignedocsdeponse1[i].tva);
                var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
                $scope.lignedocsdeponse1[i].puht = puh_initial.toFixed(3);
                $scope.lignedocsdeponse1[i].totalhTax = prixhtax.toFixed(3);
                $scope.lignedocsdeponse1[i].totalhax = prixht.toFixed(3);
                $scope.lignedocsdeponse1[i].totalhtva = prixthtava.toFixed(3);
                $scope.lignedocsdeponse1[i].totalttc = prixttc.toFixed(3);
                $scope.CalculTotalTtc($scope.lignedocsdeponse1, 'txt_mnttotal_bdc', 'bdc', 'total_htax_provisoire');
            }
        } else {
            var comArr = eval($scope.lignedocsdeponsep);
            for (i = 0; i < comArr.length; i++) {
                var puh_initial = parseFloat($scope.lignedocsdeponsep[i].puht);
                var taux_fodec = 0;
                if ($scope.lignedocsdeponsep[i].taufodec)
                    taux_fodec = parseFloat($scope.lignedocsdeponsep[i].taufodec);
                var pu = puh_initial;
                var taux = parseFloat($scope.lignedocsdeponsep[i].tauxremise);
                $scope.lignedocsdeponsep[i].remise = parseFloat(pu * taux).toFixed(3);
                if (taux > 0) {
                    pu = pu - (pu * taux);
                }

                var qtedemander = $scope.lignedocsdeponsep[i].qte;
                var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
                var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
                var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
                var prixthtava = prixht + fodec;
                var tva = 0;
                if ($scope.lignedocsdeponsep[i].tva)
                    tva = parseFloat($scope.lignedocsdeponsep[i].tva);
                var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
                $scope.lignedocsdeponsep[i].puht = puh_initial.toFixed(3);
                $scope.lignedocsdeponsep[i].totalhTax = prixhtax.toFixed(3);
                $scope.lignedocsdeponsep[i].totalhax = prixht.toFixed(3);
                $scope.lignedocsdeponsep[i].totalhtva = prixthtava.toFixed(3);
                $scope.lignedocsdeponsep[i].totalttc = prixttc.toFixed(3);
                $scope.CalculTotalTtc($scope.lignedocsdeponsep, 'total_ttc_provisoire', 'bce', 'total_htax_provisoire');
            }
        }
    }

    $scope.ChangerPrix = function (p) {
        var taux = 0;
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        nordre = $('#nordre').val();
        if (p) {
            var comArr = eval($scope.lignedocsdeponse1);
            for (i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    var puh_initial = parseFloat($('#puht').val());
                    var pu = parseFloat($('#puht').val());
                    taux = parseFloat($scope.lignedocsdeponse1[i].tauxremise);
                    console.log(taux + 'taux=');
                    $scope.lignedocsdeponse1[i].remise = parseFloat(pu * taux).toFixed(3);

                    if (taux > 0) {
                        pu = pu - (pu * taux);
                    }
                    var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
                    var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
                    var taux_fodec = 0;
                    if ($("#taufodec option:selected").text() != '') {
                        taux_fodec = $("#taufodec option:selected").text().trim();
                        taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
                    }
                    var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
                    var prixthtava = prixht + fodec;
                    var tva = 0;
                    if ($("#tva option:selected").text() != '') {
                        txt_tva = $("#tva option:selected").text().trim();
                        tva = txt_tva.substring(0, txt_tva.length - 1);
                    }
                    var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
                    $scope.lignedocsdeponse1[i].puht = puh_initial.toFixed(3);
                    $scope.lignedocsdeponse1[i].totalhTax = prixhtax.toFixed(3);
                    $scope.lignedocsdeponse1[i].totalhax = prixht.toFixed(3);
                    $scope.lignedocsdeponse1[i].totalhtva = prixthtava.toFixed(3);
                    $scope.lignedocsdeponse1[i].totalttc = prixttc.toFixed(3);
                }
            }
        } else {
            var comArr = eval($scope.lignedocsdeponsep);
            for (i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    var puh_initial = parseFloat($('#puht').val());
                    var pu = parseFloat($('#puht').val());
                    taux = parseFloat($scope.lignedocsdeponsep[i].tauxremise);
                    console.log(taux + 'taux=');
                    $scope.lignedocsdeponsep[i].remise = parseFloat(pu * taux).toFixed(3);

                    if (taux > 0) {
                        pu = pu - (pu * taux);
                    }
                    var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
                    var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
                    var taux_fodec = 0;
                    if ($("#taufodec option:selected").text() != '') {
                        taux_fodec = $("#taufodec option:selected").text().trim();
                        taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
                    }
                    var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
                    var prixthtava = prixht + fodec;
                    var tva = 0;
                    if ($("#tva option:selected").text() != '') {
                        txt_tva = $("#tva option:selected").text().trim();
                        tva = txt_tva.substring(0, txt_tva.length - 1);
                    }
                    var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
                    // $('#totalttc').val(parseFloat(prixttc).toFixed(3));
                    $scope.lignedocsdeponsep[i].puht = puh_initial.toFixed(3);

                    $scope.lignedocsdeponsep[i].totalhTax = prixhtax.toFixed(3);
                    $scope.lignedocsdeponsep[i].totalhax = prixht.toFixed(3);
                    $scope.lignedocsdeponsep[i].totalhtva = prixthtava.toFixed(3);
                    $scope.lignedocsdeponsep[i].totalttc = prixttc.toFixed(3);
                    // $scope.lignedocbce[i].totalht = parseFloat(pu * parseFloat($scope.lignedocbce[i].qte)).toFixed(3);
                    // $scope.lignedocbce[i].fodec = parseFloat($scope.lignedocbce[i].totalht) * fodectotal;
                }
            }
        }

    }

    $scope.ValiderDroitTimbreSysBDC = function (p) {
        if ($("#droit_timbre_sys_bdc").is(':checked') == true) {
            $scope.param = {
                "id_droittimbre": $('#droit_timbre_sys_bdc').val()
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/AficheroitTimbreSociete',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $("#valeurdroit_societe_sys").val(data['valeur']);
                $scope.calculerMnTTcApresDroitTimbreSysBDC();
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            var mnttc_sansdroit = '';
            if ($('#total_ttc_provisoire_bcehidden').val()) {
                mnttc_sansdroit = $('#total_ttc_provisoire_bcehidden').val();
            } else {
                mnttc_sansdroit = $('#total_ttc_bdc').val();
                mnttc_sansdroit = mnttc_sansdroit - 0.600;
            }
            $('#total_ttc_bdc').val(mnttc_sansdroit.toFixed(3));
            $('#valeurdroit_societe_sys').val(0.000);
        }
    }
    $scope.ValiderDroitTimbreSys = function () {
        if ($("#droit_timbre_sys").is(':checked') == true) {
            $scope.param = {
                "id_droittimbre": $('#droit_timbre_sys').val()
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/AficheroitTimbreSociete',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $("#valeurdroit_societe_sys").val(data['valeur']);
                // $scope.calculerMnTTcApresDroitTimbreSys();
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $('#valeurdroit_societe').val(0.000);
            var mnttc_sansdroit = $('#total_ttc_provisoire_bcehidden').val();
            $('#total_ttc_provisoire').val(mnttc_sansdroit);
        }
    }
    $scope.ValiderDroitTimbre = function (p) {
        if ($("#droit_timbre").is(':checked') == true) {
            $scope.param = {
                "id_droittimbre": $('#droit_timbre').val()
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/AficheroitTimbreSociete',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $("#valeurdroit_societe").val(data['valeur']);
                $scope.calculerMnTTcApresDroitTimbre(p);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {

            $('#valeurdroit_societe').val(0.000);
            var mnttc_sansdroit = $('#total_ttc_provisoire_bcehidden').val();
            if (p) {
                $('#txt_mnttotal_bdc').val(mnttc_sansdroit);
            } else {
                $('#total_ttc_provisoire').val(mnttc_sansdroit);
            }
        }
    }

    //    $scope.calculdroittimbre = function () {
    //        if ($("#id_droit_timbre_p").val()) {
    //            $scope.param = {
    //                "id_droittimbre": $('#id_droit_timbre_p').val()
    //            }
    //            $http({
    //                url: domaineapp + 'achats.php/documentachat/AficheroitTimbre',
    //                method: "POST",
    //                data: $scope.param,
    //                headers: {
    //                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //                }
    //            }).then(function mySucces(response) {
    //                data = response.data[0];
    //                $("#valeurdroit").val(data['valeur']);
    //                $scope.calculerMnTTc();
    //            }, function myError(response) {
    //                alert("Erreur d'ajout");
    //            });
    //        }
    //    }

    //    $('#id_droit_timbre_p').unbind('change');
    //    $("#id_droit_timbre_p")
    //            .change(function () {
    //                if ($("#id_droit_timbre_p").val() != "0") {
    //                    $scope.calculdroittimbre();
    //                } else {
    //                    var mnttc_sansdroit = $('#total_ttc_provisoire_bcehidden').val();
    //                    console.log(mnttc_sansdroit + 'r');
    //                    $('#total_ttc_provisoire').val(mnttc_sansdroit);
    //                }
    //
    //            })
    //            .trigger("change");

    $scope.calculerMnTTcApresDroitTimbre = function (p) {
        var taux = 0;
        if (p) {
            if ($('#total_ttc_provisoire').val() != '') {
                if ($('#txt_mnttotal_bdc').val() && $('#valeurdroit').val() != '0') {
                    var droittimbre = parseFloat($('#valeurdroit_societe').val());
                    var pttc = parseFloat($('#total_ttc_provisoire_bcehidden').val());
                    var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                    $('#txt_mnttotal_bdc').val(total_pttc.toFixed(3));
                }

            }
        } else {
            if ($('#total_ttc_provisoire').val() != '') {
                if ($('#total_ttc_provisoire').val() && $('#valeurdroit').val() != '0') {
                    var droittimbre = parseFloat($('#valeurdroit_societe').val());
                    var pttc = parseFloat($('#total_ttc_provisoire_bcehidden').val());
                    var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                    $('#total_ttc_provisoire').val(total_pttc.toFixed(3));
                }

            }
        }

    }

    $scope.calculerMnTTcApresDroitTimbreSysBDC = function (typedoc) {
        var taux = 0;
        var pttc = '';
        if ($('#total_ttc_bdc').val() != '') {
            if ($('#total_ttc_bdc').val() && $('#valeurdroit_societe_sys').val() != '0') {
                var droittimbre = parseFloat($('#valeurdroit_societe_sys').val());
                if ($('#total_ttc_sys_bdchidden').val())
                    pttc = parseFloat($('#total_ttc_sys_bdchidden').val());
                else
                    pttc = parseFloat($('#total_ttc_bdc').val());
                var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                $('#total_ttc_bdc').val(total_pttc.toFixed(3));
            }

        }
    }

    $scope.calculerMnTTcApresDroitTimbreSys = function (typedoc) {
        var taux = 0;
        if ($('#total_ttc').val() != '') {
            if ($('#total_ttc').val() && $('#valeurdroitsys').val() != '0') {
                var droittimbre = parseFloat($('#valeurdroit_societe').val());
                var pttc = parseFloat($('#total_ttc_sys_bcehidden').val());
                var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                $('#total_ttc').val(total_pttc.toFixed(3));
            }

        }
    }
    $scope.calculerMnTTc = function () {
        var taux = 0;
        if ($('#total_ttc_provisoire').val() != '') {
            if ($('#total_ttc_provisoire').val() && $('#valeurdroit').val() != '0') {
                var droittimbre = parseFloat($('#valeurdroit').val());
                var pttc = parseFloat($('#total_ttc_provisoire_bcehidden').val());
                var total_pttc = parseFloat(pttc) + parseFloat(droittimbre);
                $('#total_ttc_provisoire').val(total_pttc.toFixed(3));
            }
        }
    }
    $('#remisetotalvaleurHT').unbind('change');
    $("#remisetotalvaleurHT")
            .change(function () {
                if ($("#remisetotalvaleurHT").val() != "" && $("#remisetotalvaleurHT").val() != null) {
                    $scope.CalculerApresremiseHTAX();
                }
            })
            .trigger("change");

    $('#remisetotalvaleurHTSys').unbind('change');
    $("#remisetotalvaleurHTSys")
            .change(function () {

                if ($("#remisetotalvaleurHTSys").val() != "" && $("#remisetotalvaleurHTSys").val() != null) {
                    $scope.CalculerApresremiseHTAXSyst();
                }
            })
            .trigger("change");
    $scope.CalculerApresremiseSys = function () {
        var remisecomande = parseFloat($('#remisetotalpourcentageHTSys').val());
        for (j = 0; j < $scope.lignedocsdeponse.length; j++) {
            $scope.lignedocsdeponse[j].tauxremise = (remisecomande / 100).toFixed(3);
        }
        if ($('#remisetotalpourcentageHTSys').val() != "") {
            $scope.ChangerPrixListeRemisecommandeSys();

        }

    }

    $scope.ChangerPrixListeRemisecommandeSys = function () {
        var comArr = eval($scope.lignedocsdeponse);
        for (i = 0; i < comArr.length; i++) {
            var puh_initial = parseFloat($scope.lignedocsdeponse[i].puht);
            var taux_fodec = 0;
            if ($scope.lignedocsdeponse[i].taufodec)
                taux_fodec = parseFloat($scope.lignedocsdeponse[i].taufodec);
            var pu = puh_initial;
            var taux = parseFloat($scope.lignedocsdeponse[i].tauxremise);
            $scope.lignedocsdeponse[i].remise = parseFloat(pu * taux).toFixed(3);
            if (taux > 0) {
                pu = pu - (pu * taux);
            }
            var qtedemander = $scope.lignedocsdeponse[i].qte;
            var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            var prixthtava = prixht + fodec;
            var tva = 0;
            if ($scope.lignedocsdeponse[i].tva)
                tva = parseFloat($scope.lignedocsdeponse[i].tva);
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $scope.lignedocsdeponse[i].puht = puh_initial.toFixed(3);
            $scope.lignedocsdeponse[i].totalhtax = prixhtax.toFixed(3);
            $scope.lignedocsdeponse[i].totalhax = prixht.toFixed(3);
            $scope.lignedocsdeponse[i].totalhtva = prixthtava.toFixed(3);
            $scope.lignedocsdeponse[i].totalttc = prixttc.toFixed(3);
            $scope.CalculTotalTtcSys($scope.lignedocsdeponse, 'total_ttc_bdc', 'bce', 'total_htax_sys');
        }
    }

    $scope.CalculerApresremise = function (p) {

        var remisecomande = '';
        if ($('#remisetotalpourcentageHT').val() != '') {
            remisecomande = parseFloat($('#remisetotalpourcentageHT').val());
        } else {
            remisecomande = parseFloat($('#remisetotalpourcentageHT').val());
        }

        if (p != 'bcep') {
            for (j = 0; j < $scope.lignedocsdeponse1.length; j++) {
                $scope.lignedocsdeponse1[j].tauxremise = (remisecomande / 100);
            }
            if ($('#remisetotalpourcentageHT').val() != "") {

                $scope.ChangerPrixListeRemisecommande(p);

            }
        } else {
            for (j = 0; j < $scope.lignedocsdeponsep.length; j++) {
                $scope.lignedocsdeponsep[j].tauxremise = (remisecomande / 100);
            }

            if ($('#remisetotalpourcentageHT').val() != "") {

                $scope.ChangerPrixListeRemisecommande(p);

            }
        }

    }

    $scope.CalculerApresremiseHTAXSyst = function () {
        if ($('#remisetotalvaleurHTSys').val() != '') {
            if ($('#total_htax_sys').val() && $('#total_htax_sys').val() != 'undefined') {
                var totalremise = parseFloat($('#remisetotalvaleurHTSys').val());
                var pttc = parseFloat($('#total_htax_sys').val());
                var taux_remise = (totalremise * 100) / (pttc);
                $("#remisetotalpourcentageHTSys").val(taux_remise.toFixed(3));
                var total_pttc = parseFloat(pttc) - parseFloat(totalremise);

            }
        }

    }
    $scope.CalculerApresremiseHTAX = function () {
        var taux = 0;
        var ttthtax = 0;
        if ($('#remisetotalvaleurHT').val() != '') {
            if ($('#total_htax').val() && $('#total_htax').val() != 'undefined') {
                var totalremise = parseFloat($('#remisetotalvaleurHT').val());
                var pttc = parseFloat($('#total_htax').val());
                var taux_remise = (totalremise * 100) / (pttc);
                $("#remisetotalpourcentageHT").val(taux_remise.toFixed(3));
                $("#remisetotalpourcentageHT_Hidden").val(taux_remise);
                var total_pttc = parseFloat(pttc) - parseFloat(totalremise);

            }
        }

    }
    $scope.CalculerApresremisePourcentageHT = function () {
        var taux = 0;
        if ($('#remisetotalpourcentageHT').val() != '') {
            console.log($('#total_htax_provisoire').val(), 'rfe');
            if ($('#total_htax_provisoire').val() && $('#total_htax_provisoire').val() != 'undefined') {
                var taux = parseFloat($('#remisetotalpourcentageHT').val());
                var pttc = parseFloat($('#total_htax_provisoire').val());
                var totla_remise = parseFloat(pttc) * parseFloat(taux / 100);
                if (taux > 0) {
                    $('#remisetotalvaleurHT').val(totla_remise);
                }
            }
        }
    }
    $('#remisetotalpourcentageHT').unbind('change');
    $("#remisetotalpourcentageHT")
            .change(function () {
                if ($("#remisetotalpourcentageHT").val() != "" && $("#remisetotalpourcentageHT").val() != null) {
                    $scope.CalculerApresremisePourcentageHT();
                }
            })
            .trigger("change");
    $('#remisetotalpourcentageHTSys').unbind('change');
    $("#remisetotalpourcentageHTSys")
            .change(function () {
                if ($("#remisetotalpourcentageHTSys").val() != "" && $("#remisetotalpourcentageHTSys").val() != null) {
                    $scope.CalculerApresremisePourcentageHTSys();
                }
            })
            .trigger("change");
    $scope.CalculerApresremisePourcentageHTSys = function () {
        var taux = 0;
        if ($('#remisetotalpourcentageHTSys').val() != '') {
            if ($('#total_htax_sys').val() && $('#total_htax_sys').val() != 'undefined') {
                var taux = parseFloat($('#remisetotalpourcentageHTSys').val());
                var pttc = parseFloat($('#total_htax_sys').val());
                var totla_remise = parseFloat(pttc) * parseFloat(taux / 100);
                if (taux > 0) {
                    $('#remisetotalvaleurHTSys').val(parseFloat(totla_remise).toFixed(3));
                }
            }
        }
    }

    $scope.AddDetailBCES = function () {

        var remise = 0;
        var taux = 0;
        if ($("#qtesys").val() != '')
            qtedemander = parseFloat($("#qtesys").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designationsys').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsdeponse.length + 1;
            nordre = $('#nordresys').val();
            var comArr = eval($scope.lignedocsdeponse);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($("#puhtsys").val()));
            var pu = parseFloat($('#puhtsys').val());
            var taux = parseFloat($('#remisesys').val());
            var remise = parseFloat(pu * taux).toFixed(3);
            $('#totalhTaxsys').val(parseFloat(prixht).toFixed(3));
            if (taux > 0) {
                pu = pu - (pu * taux / 100);
            }
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
            $('#totalhaxsys').val(parseFloat(prixht).toFixed(3));
            var taux_fodec = 0;
            if ($("#taufodecsys option:selected").text() != '') {
                taux_fodec = $("#taufodecsys option:selected").text().trim();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodecsys').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtvasys').val(parseFloat(prixthtava).toFixed(3));
            var tva = 0;
            if ($("#tvasys option:selected").text() != '') {
                txt_tva = $("#tvasys option:selected").text().trim();
                tva = txt_tva.substring(0, txt_tva.length - 1);
            }
            if ($('#remisesys').val() != "") {
                taux = parseFloat($('#remisesys').val()) / 100;
                remise = $('#remisesys').val();
            }
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttcsys').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.lignedocsdeponse[i].norgdre = $('#nordresys').val();
                    $scope.lignedocsdeponse[i].codearticle = $('#codearticlesys').val();
                    $scope.lignedocsdeponse[i].designation = $('#designationsys').val();
                    $scope.lignedocsdeponse[i].idunite = $('#unitesys').val();
                    $scope.lignedocsdeponse[i].unite = $("#unitesys option:selected").text();
                    $scope.lignedocsdeponse[i].qte = $('#qtesys').val();
                    $scope.lignedocsdeponse[i].puht = $('#puhtsys').val();
                    $scope.lignedocsdeponse[i].totalhtax = $('#totalhTaxsys').val();
                    $scope.lignedocsdeponse[i].remise = remise;
                    $scope.lignedocsdeponse[i].tauxremise = taux.toFixed(2);
                    $scope.lignedocsdeponse[i].totalhax = $('#totalhaxsys').val();
                    $scope.lignedocsdeponse[i].idtaufodec = $('#taufodecsys').val();
                    $scope.lignedocsdeponse[i].taufodec = $("#taufodecsys option:selected").text();
                    $scope.lignedocsdeponse[i].fodec = $('#fodecsys').val();
                    $scope.lignedocsdeponse[i].totalhtva = $('#totalhtvasys').val();
                    $scope.lignedocsdeponse[i].idtva = $('#tvasys').val();
                    $scope.lignedocsdeponse[i].tva = $("#tvasys option:selected").text();
                    $scope.lignedocsdeponse[i].totalttc = $('#totalttcsys').val();
                    $scope.lignedocsdeponse[i].prixttc = prixttc;
                    $scope.lignedocsdeponse[i].idprojet = $('#projetsys').val();
                    $scope.lignedocsdeponse[i].projet = $("#projetsys option:selected").text();
                    $scope.lignedocsdeponse[i].observation = $('#observationsys').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponse.push({
                    'norgdre': nbligne,
                    'designation': $('#designationsys').val(),
                    'codearticle': $('#codearticlesys').val(),
                    'unite': $("#unitesys option:selected").text(),
                    'idunite': $('#unitesys').val(),
                    'qte': $("#qtesys").val(),
                    'puht': $('#puhtsys').val(),
                    'totalhax': $('#totalhaxsys').val(),
                    'totalhtax': $('#totalhTaxsys').val(),
                    'remise': remise,
                    'tauxremise': taux,
                    'taufodec': $("#taufodecsys option:selected").text(),
                    'idtaufodec': $('#taufodecsys').val(),
                    'fodec': $("#fodecsys").val(),
                    'totalhtva': $('#totalhtvasys').val(),
                    'tva': $("#tvasys option:selected").text(),
                    'idtva': $('#tvasys').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttcsys').val(),
                    'projet': $("#projetsys option:selected").text(),
                    'idprojet': $('#projetsys').val(),
                    'observation': $('#observationsys').val()
                });
            }

            //  $scope.ChangerPrixDef();
            $scope.CalculTotalTtcSys($scope.lignedocsdeponse, 'total_ttc');
            $scope.ViderChampsBCES();
        } else {
            var message = '';
            if ($('#designationsys').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.ChangerPrixDef = function () {
        var taux = 0;
        var qtedemander;
        if ($("#qtesys").val() != '')
            qtedemander = parseFloat($("#qtesys").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        nordre = $('#nordre').val();
        var comArr = eval($scope.lignedocsdeponse);
        console.log($scope.lignedocsdeponse);
        for (i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                var puh_initial = parseFloat($('#puhtsys').val());
                var pu = parseFloat($('#puhtsys').val());
                taux = parseFloat($scope.lignedocsdeponse[i].tauxremise);
                console.log(taux + 'taux=');
                $scope.lignedocsdeponse[i].remise = parseFloat(pu * taux).toFixed(3);
                if (taux > 0) {
                    pu = pu - (pu * taux);
                }
                var prixhtax = parseFloat(parseFloat(qtedemander) * parseFloat(puh_initial));
                var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
                var taux_fodec = 0;
                if ($("#taufodecsys option:selected").text() != '') {
                    taux_fodec = $("#taufodecsys option:selected").text().trim();
                    taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
                }
                var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
                var prixthtava = prixht + fodec;
                var tva = 0;
                if ($("#tvasys option:selected").text() != '') {
                    txt_tva = $("#tvasys option:selected").text().trim();
                    tva = txt_tva.substring(0, txt_tva.length - 1);
                }
                var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
                $scope.lignedocsdeponse[i].puht = puh_initial.toFixed(3);
                $scope.lignedocsdeponse[i].totalhtax = prixhtax.toFixed(3);
                $scope.lignedocsdeponse[i].totalhax = prixht.toFixed(3);
                $scope.lignedocsdeponse[i].totalhtva = prixthtava.toFixed(3);
                $scope.lignedocsdeponse[i].totalttc = prixttc.toFixed(3);

                // $scope.lignedocbce[i].totalht = parseFloat(pu * parseFloat($scope.lignedocbce[i].qte)).toFixed(3);
                // $scope.lignedocbce[i].fodec = parseFloat($scope.lignedocbce[i].totalht) * fodectotal;
            }
        }
    }
    $scope.AddDetailBDC = function () {
        //####
        var remise = 0;
        var taux = 0;
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designation').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsdeponse1.length + 1;
            nordre = $('#nordre').val();
            var comArr = eval($scope.lignedocsdeponse1);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($("#puht").val()));
            $('#totalhax').val(parseFloat(prixht).toFixed(3));

            var taux_fodec = 0;
            if ($("#taufodec option:selected").text() != '') {
                taux_fodec = $("#taufodec option:selected").text().trim();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodec').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
            var tva = 0;
            if ($("#tva option:selected").text() != '') {
                var txt_tva = $("#tva option:selected").text().trim();
                tva = txt_tva.substring(0, txt_tva.length - 1);
            }
            if ($('#remise').val() != "") {
                taux = parseFloat($('#remise').val()) / 100;
                remise = $('#remise').val();
            }
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttc').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.lignedocsdeponse1[i].norgdre = $('#nordre').val();
                    $scope.lignedocsdeponse1[i].codearticle = $('#codearticle').val();
                    $scope.lignedocsdeponse1[i].designation = $('#designation').val();
                    $scope.lignedocsdeponse1[i].idunite = $('#unite').val();
                    $scope.lignedocsdeponse1[i].unite = $("#unite option:selected").text();
                    $scope.lignedocsdeponse1[i].qte = $('#qte').val();
                    $scope.lignedocsdeponse1[i].remise = remise;
                    $scope.lignedocsdeponse1[i].tauxremise = taux;
                    $scope.lignedocsdeponse1[i].puht = $('#puht').val();
                    $scope.lignedocsdeponse1[i].totalhTax = $('#totalhTax').val();
                    $scope.lignedocsdeponse1[i].totalhax = $('#totalhax').val();
                    $scope.lignedocsdeponse1[i].idtaufodec = $('#taufodec').val();
                    $scope.lignedocsdeponse1[i].taufodec = $("#taufodec option:selected").text();
                    $scope.lignedocsdeponse1[i].fodec = $('#fodec').val();
                    $scope.lignedocsdeponse1[i].totalhtva = $('#totalhtva').val();
                    $scope.lignedocsdeponse1[i].idtva = $('#tva').val();
                    $scope.lignedocsdeponse1[i].tva = $("#tva option:selected").text();
                    $scope.lignedocsdeponse1[i].totalttc = $('#totalttc').val();
                    $scope.lignedocsdeponse1[i].prixttc = prixttc;
                    $scope.lignedocsdeponse1[i].idprojet = $('#projet').val();
                    $scope.lignedocsdeponse1[i].projet = $("#projet option:selected").text();
                    $scope.lignedocsdeponse1[i].observation = $('#observation').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponse1.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'codearticle': $('#codearticle').val(),
                    'unite': $("#unite option:selected").text(),
                    'idunite': $('#unite').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'totalhax': $('#totalhax').val(),
                    'taufodec': $("#taufodec option:selected").text(),
                    'idtaufodec': $('#taufodec').val(),
                    'fodec': $("#fodec").val(),
                    'totalhtva': $('#totalhtva').val(),
                    'totalhTax': $('#totalhTax').val(),
                    'remise': remise,
                    'tauxremise': taux,
                    'tva': $("#tva option:selected").text(),
                    'idtva': $('#tva').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttc').val(),
                    'projet': $("#projet option:selected").text(),
                    'idprojet': $('#projet').val(),
                    'observation': $('#observation').val()
                });
            }

            $scope.ChangerPrix('p');
            $scope.CalculTotalTtc($scope.lignedocsdeponse1, 'txt_mnttotal_bdc', 'bdc');
            $scope.ViderChampsBCE();
        } else {
            var message = '';
            if ($('#designation').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.AddDetailBDCS = function () {

        if ($("#qtesysBDC").val() != '')
            qtedemander = parseFloat($("#qtesysBDC").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designationsysBDC').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsdeponse.length + 1;
            nordre = $('#nordresysBDC').val();
            var comArr = eval($scope.lignedocsdeponse);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($("#puhtsysBDC").val()));
            var pu = parseFloat($('#puhtsysBDC').val());
            var taux = parseFloat($('#remisesys').val());
            var remise = parseFloat(pu * taux).toFixed(3);
            $('#totalhTaxsys').val(parseFloat(prixht).toFixed(3));
            if (taux > 0) {
                pu = pu - (pu * taux / 100);
            }
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat(pu));
            $('#totalhaxsysBDC').val(parseFloat(prixht).toFixed(3));
            var taux_fodec = 0;
            if ($("#taufodecsysBDC option:selected").text() != '') {
                var taux_fodec = $("#taufodecsysBDC option:selected").text();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            $('#fodecsysBDC').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtvasysBDC').val(parseFloat(prixthtava).toFixed(3));
            var tva = 0;
            if ($("#tvasysBDC option:selected").text() != '') {
                var tva = $("#tvasysBDC option:selected").text();
                tva = tva.substring(0, tva.length - 1);
            }
            if ($('#remisesys').val() != "") {
                taux = parseFloat($('#remisesys').val()) / 100;
                remise = $('#remisesys').val();
            }
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttcsysBDC').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.lignedocsdeponse[i].norgdre = $('#nordresysBDC').val();
                    $scope.lignedocsdeponse[i].codearticle = $('#codearticlesysBDC').val();
                    $scope.lignedocsdeponse[i].designation = $('#designationsysBDC').val();
                    $scope.lignedocsdeponse[i].idunite = $('#unitesysBDC').val();
                    $scope.lignedocsdeponse[i].unite = $("#unitesysBDC option:selected").text();
                    $scope.lignedocsdeponse[i].qte = $('#qtesysBDC').val();
                    $scope.lignedocsdeponse[i].puht = $('#puhtsysBDC').val();
                    $scope.lignedocsdeponse[i].totalhax = $('#totalhaxsysBDC').val();
                    $scope.lignedocsdeponse[i].totalhtax = $('#totalhTaxsys').val();
                    $scope.lignedocsdeponse[i].remise = remise;
                    $scope.lignedocsdeponse[i].tauxremise = taux.toFixed(2);
                    $scope.lignedocsdeponse[i].idtaufodec = $('#taufodecsysBDC').val();
                    $scope.lignedocsdeponse[i].taufodec = $("#taufodecsysBDC option:selected").text();
                    $scope.lignedocsdeponse[i].fodec = $('#fodecsysBDC').val();
                    $scope.lignedocsdeponse[i].totalhtva = $('#totalhtvasysBDC').val();
                    $scope.lignedocsdeponse[i].id_tva = $('#tvasysBDC').val();
                    $scope.lignedocsdeponse[i].tva = $("#tvasysBDC option:selected").text();
                    $scope.lignedocsdeponse[i].totalttc = $('#totalttcsysBDC').val();
                    $scope.lignedocsdeponse[i].prixttc = prixttc;
                    //                    $scope.lignedocsdeponse[i].idprojet = $('#projetsys').val();
                    //                    $scope.lignedocsdeponse[i].projet = $("#projetsys option:selected").text();
                    $scope.lignedocsdeponse[i].observation = $('#observationsysBDC').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponse.push({
                    'norgdre': nbligne,
                    'designation': $('#designationsysBDC').val(),
                    'codearticle': $('#codearticlesysBDC').val(),
                    //                    'unite': $("#unitesys option:selected").text(),
                    //                    'idunite': $('#unitesys').val(),
                    'qte': $("#qtesysBDC").val(),
                    'puht': $('#puhtsysBDC').val(),
                    'totalhax': $('#totalhaxsysBDC').val(),
                    'totalhtax': $('#totalhTaxsys').val(),
                    'remise': remise,
                    'tauxremise': taux,
                    'taufodec': $("#taufodecsysBDC option:selected").text(),
                    'idtaufodec': $('#taufodecsysBDC').val(),
                    'fodec': $("#fodecsysBDC").val(),
                    'totalhtva': $('#totalhtvasysBDC').val(),
                    'tva': $("#tvasysBDC option:selected").text(),
                    'id_tva': $('#tvasysBDC').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttcsysBDC').val(),
                    //                    'projet': $("#projetsysBDC option:selected").text(),
                    //                    'idprojet': $('#projetsysBDC').val(),
                    'observation': $('#observationsysBDC').val()
                });
            }


            $scope.CalculTotalTtcSys($scope.lignedocsdeponse, 'total_ttc_bdc', 'def', 'total_htax_sys');
            $scope.ViderChampsBCES();
        } else {
            var message = '';
            if ($('#designationsys').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.ViderChampsBDC = function () {
        $('#nordre').val('');
        $('#designation').val('');
        $('#codearticle').val('');
        $('#qte').val('');
        $('#tva').val('');
        $('#projet').val('');
        $("#idprojet").trigger("chosen:updated");
        //        $('#taufodec').val('');
        //        $("#idtaufodec").trigger("chosen:updated");
        $('#tva').trigger("chosen:updated");
        $('#taufodec').val('');
        $('#taufodec').trigger("chosen:updated");
        $('#puht').val('');
        $('#totalhTax').val('');
        $('#totalhax').val('');
        $('#fodec').val('');
        $('#totalhtva').val('');
        $('#totalttc').val('');
        $('#desc').val('');
        $('#unite').val('');
        $('#unite').trigger("chosen:updated");
        $('#observation').val('');
    }

    $scope.ViderChampsBCES = function () {
        $('#nordresys').val('');
        $('#designationsys').val('');
        $('#codearticlesys').val('');
        $('#qtesys').val('');
        $('#tvasys').val('');
        $('#tvasys').trigger("chosen:updated");
        $('#taufodecsys').val('');
        $('#taufodecsys').trigger("chosen:updated");
        $('#puhtsys').val('');
        $('#totalhaxsys').val('');
        $('#fodecsys').val('');
        $('#totalhtvasys').val('');
        $('#totalttcsys').val('');
        $('#totalhtax').val('');
        $('#totalhTaxsys').val('');
        $('#remisesys').val('');
        $('#observationsys').val('');
    }


    $scope.ViderChampsBCE = function () {
        $('#nordre').val('');
        $('#designation').val('');
        $('#codearticle').val('');
        $('#qte').val('');
        $('#tva').val('');
        $('#projet').val('');
        $('#remise').val('');
        $('#tauxremise').val('');
        $("#idprojet").trigger("chosen:updated");
        //        $('#taufodec').val('');
        //        $("#idtaufodec").trigger("chosen:updated");
        $('#tva').trigger("chosen:updated");
        $('#taufodec').val('');
        $('#taufodec').trigger("chosen:updated");
        $('#puht').val('');
        $('#totalhax').val('');
        $('#fodec').val('');
        $('#totalhtva').val('');
        $('#totalttc').val('');
        $('#desc').val('');
        $('#remise').val('');
        $('#unite').val('');

        $('#unite').trigger("chosen:updated");
        $('#observation').val('');
    }
    $scope.DeleteLignebce = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocsdeponsep);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponsep.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocsdeponsep[i].norgdre = conteur;
            conteur++;
        }

        $scope.CalculTotalTtc();
    }

    $scope.DeleteLignebDC = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocsdeponse1);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponse1.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocsdeponse1[i].norgdre = conteur;
            conteur++;
        }

        $scope.CalculTotalTtc();
    }
    $scope.DeleteLignebceS = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocsdeponse);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponse.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocsdeponse[i].norgdre = conteur;
            conteur++;
        }

        $scope.CalculTotalTtc();
    }


    $scope.DeleteLigneBDCS = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocsdeponse);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponse.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocsdeponse[i].norgdre = conteur;
            conteur++;
        }

        $scope.CalculTotalTtc();
    }

    $scope.MisAjourLigneligneDocContratAvenant = function (id) {
        //alert(id);
        var comArr = eval($scope.lignedocslignecontratp);
        //   alert(comArr.length);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {

                $scope.lignedocslignecontratp[i].tauxpourcentage = $('#taupourc_' + id).val();
                alert($scope.lignedocslignecontratp[i].tauxpourcentage + 'll' + $('#taupourc_' + id).val());
            }
        }

    }

    $scope.ValiderContratAvenantTypeDate = function (iddoc, idcontrat) {
        //  alert('cd');
        if ($scope.lignedocslignecontratp.length > 0) {
            var comArr = eval($scope.lignedocslignecontratp);
        }
        $scope.param = {
            "iddoc": iddoc,
            "idcontrat": idcontrat,
            "listelignecontrat": $scope.lignedocslignecontratp,
            "datesigntaure": $('#datesigntaure').val(),
            "reference": $('#reference').val(),
            "numero_contrat": $('#numero_contrat').val(),
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/SaveContratdefintifAvenant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "Avenant Contrat Définitif est crée avec succès",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            //                    window.location.reload();
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.MisAjourLigneDocContrat = function (id) {
        if (p === '') {
            var comArr = eval($scope.lignedocscontratp);
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                    //alert($scope.lignedocs[i].qte);
                    if (parseFloat($scope.lignedocscontratp[i].qte) < $('#qte_' + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#qte_' + id).val($scope.lignedocscontratp[i].qte);
                    } else {
                        $scope.lignedocscontratp[i].qte = $('#qte_' + id).val();
                    }
                    $scope.lignedocscontratp[i].puht = $('#puht_' + id).val();
                    $scope.lignedocscontratp[i].tva = $('#tva_' + id + ' option:selected').text();
                    $scope.lignedocscontratp[i].idtva = $('#tva_' + id).val();
                    $scope.lignedocscontratp[i].tauxfodec = $('#tauxfodec_' + id + ' option:selected').text();
                    $scope.lignedocscontratp[i].idtauxfodec = $('#tauxfodec_' + id).val();
                    $scope.lignedocscontratp[i].observation = $('#desc_' + id).val();
                    //                    bootbox.dialog({
                    //                        message: 'Mise à jour effectuée avec succès !',
                    //                        buttons:
                    //                                {
                    //                                    "button":
                    //                                            {
                    //                                                "label": "Ok",
                    //                                                "className": "btn-sm"
                    //                                            }
                    //                                }
                    //                    });
                    break;
                }
            }

            $scope.CalculTotalTtccontrat($scope.lignedocscontratp, 'total_ttc');
        } else {
            var comArr = eval($scope.lignedocscontratp);
            for (var i = 0; i < comArr.length; i++) {
                //alert(comArr[i].norgdre + '===' + id);
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {

                    //alert($scope.lignedocs[i].qte);
                    if (parseFloat($scope.lignedocscontratp[i].qte) < $('#qte_' + p + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#qte_' + p + id).val($scope.lignedocscontratp[i].qte);
                    } else {
                        $scope.lignedocscontratp[i].qte = $('#qte_' + p + id).val();
                    }
                    $scope.lignedocscontratp[i].puht = $('#puht_' + p + id).val();
                    $scope.lignedocscontratp[i].tva = $('#tva_' + p + id + ' option:selected').text();
                    $scope.lignedocscontratp[i].idtva = $('#tva_' + p + id).val();
                    $scope.lignedocscontratp[i].taufodec = $('#taufodec_' + id + ' option:selected').text();
                    $scope.lignedocscontratp[i].idtaufodec = $('#taufodec_' + id).val();
                    $scope.lignedocscontratp[i].observation = $('#desc_' + p + id).val();
                    //                    bootbox.dialog({
                    //                        message: 'Mise à jour effectuée avec succès !',
                    //                        buttons:
                    //                                {
                    //                                    "button":
                    //                                            {
                    //                                                "label": "Ok",
                    //                                                "className": "btn-sm"
                    //                                            }
                    //                                }
                    //                    });
                    break;
                }
            }
            $scope.CalculTotalTtccontrat($scope.lignedocscontratp, 'total_ttc');
        }
    }

    $scope.MisAjourLigneligneDocContrat = function (id) {
        //alert(id);
        var comArr = eval($scope.lignedocslignecontratp);
        //   alert(comArr.length);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {

                $scope.lignedocslignecontratp[i].tauxpourcentage = $('#taupourc_' + id).val();
                $scope.lignedocslignecontratp[i].designation = $('#design_' + id).val();
                //   alert($scope.lignedocslignecontratp[i].tauxpourcentage + 'll' + $('#taupourc_' + id).val());
            }
        }

    }
    $scope.AfficheLignedocBCIVersContrat = function (iddoc, p, idcontrat) {
        $scope.param = {
            "id": iddoc,
            "idcontrat": idcontrat
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/AfficheligneListeboninternecontrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            if (p === '') {
            $scope.lignedocscontratp = data;
            var comArr = eval($scope.lignedocscontratp);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }
            //            } else {
            //                $scope.lignedocscontratp = data;
            //                var comArr = eval($scope.lignedocscontratp);
            //                var nordre = 1;
            //                for (var i = 0; i < comArr.length; i++) {
            //                    comArr[i].norgdre = nordre;
            //                    nordre++;
            //                }

            //            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.Afficherlignelignecontrat = function (idcontrat) {
        //        alert(idcontrat+'rf');
        $scope.param = {
            "idcontrat": idcontrat
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/AffichelignedeligneListeboninternecontrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            if (p === '') {
            //alert(data);
            $scope.lignedocslignecontratp = data;
            //            var comArr = eval($scope.lignedocslignecontratp);
            //            var nordre = 1;
            //            for (var i = 0; i < comArr.length; i++) {
            //                comArr[i].norgdre = nordre;
            //                nordre++;
            //            }

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ValiderDocumentdeprixModifier = function (iddoc) {
        if ($('#liste_fournisseur_demande tbody tr').length != 0) {
            if ($("#delai").val() != '') {
                var delai = $("#delai").val();
                if (isNaN(delai)) {
                    $("#delai").val('');
                    $("#datemax").val('');
                } else {
                    delai = parseInt($("#delai").val())
                    var data = new Date();
                    //Debut : incrementer délai en jour à une date définie
                    var mydate = new Date(data);
                    mydate.setDate(mydate.getDate() + delai);
                    var y = mydate.getFullYear(),
                            m = mydate.getMonth() + 1, // january is month 0 in javascript
                            d = mydate.getDate();
                    var pad = function (val) {
                        var str = val.toString();
                        return (str.length < 2) ? "0" + str : str
                    };
                    data = [y, pad(m), pad(d)].join("-");
                    //Fin : incrementer délai en jour à une date définie
                    $('#datemax_hidden').val(data);
                }
            }
            var date = $('#datemax').val();
            //        if ($('#delai').val() != '')
            //             datemax = data;
            //        else
            var datemax = $('#datemax_hidden').val();
            //        alert(datemax + date);
            var d2 = new Date(date);
            var d1 = new Date(datemax);
            var DateDiff = {
                inDays: function (d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000));
                },
                inWeeks: function (d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
                },
                inMonths: function (d1, d2) {
                    var d1Y = d1.getFullYear();
                    var d2Y = d2.getFullYear();
                    var d1M = d1.getMonth();
                    var d2M = d2.getMonth();
                    return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                },
                inYears: function (d1, d2) {
                    return d2.getFullYear() - d1.getFullYear();
                }
            }

            if ($('#datemax').val() != '') {
                var diff_j = DateDiff.inDays(d1, d2);
                var diff_y = DateDiff.inYears(d1, d2);
                var diff_m = DateDiff.inMonths(d1, d2);
                //                alert(diff_y +'diff_m'+ diff_m + 'date_j'+diff_j );
            }
            if (diff_j >= 0 && diff_m >= 0 && diff_y >= 0) {


                var fournisseur_ids = '';
                $('input[name="id_fournisseur_tr"]').each(function () {
                    fournisseur_ids = fournisseur_ids + $(this).val() + ',';
                });
                $scope.param = {
                    "iddoc": iddoc,
                    "listearticle": $scope.lignedocs,
                    "frs": fournisseur_ids,
                    "delai": $('#delai').val(),
                    "datemax": $('#datemax').val(),
                    "ref": $('#ref').val(),
                    'numerodoc': $('#hidden_numero_dp').val(),
                    'operation_dps': $('#operation_dps').val(),
                    'numerodossier': $('#numero_dossier').val(),
                    'idlieu': $('#id_lieu').val(),
                    'objet': $('#objet').val()
                }
                $http({
                    url: domaineapp + 'achats.php/Documents/SavedocumentprixModifier',
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
                    window.location.reload(window);
                }, function myError(response) {
                    alert(response);
                });
            } else
                bootbox.dialog({
                    message: 'Il faut choisr date supérieur au sommet du date système et le delai  !!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner au moin un fournisseur !!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }
    $scope.deleteFournisseur = function (id) {

        var index = -1;
        var comArr = eval($scope.lignefrss);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].id) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignefrss.splice(index, 1);
    }
    $scope.InialiserDemandePrix = function () {
        $('#id_lieu_chosen').attr('style', 'width:100%');
        $('#id_lieu_p_chosen').attr('style', 'width:100%');
        $('#idnote_p_chosen').attr('style', 'width:100%');
    }
    $scope.AfficheFournisseur = function (p) {
        $scope.param = {
            'frs': $('#fournisseur' + p).val(),
            'ref': $('#reffournisseur' + p).val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/listefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.fournisseurs = data;
            AjoutHtmlAfter(data, '#fournisseur' + p, '#reffournisseur' + p);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheFournisseur1 = function () {
        $scope.param = {
            'frs': $('#fournisseur1').val(),
            'ref': $('#reffournisseur1').val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.fournisseurs1 = data;
            AjoutHtmlAfter(data, '#fournisseur1', '#reffournisseur1');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AjouterFournisseur = function (p) {
        $scope.param = {
            'frs': $('#fournisseur' + p).val(),
            'ref': $('#reffournisseur' + p).val()
        }
        $http({
            url: domaineapp + '/achats.php/fournisseur/Ajoutfournisseur',
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
            alert("Erreur d'ajout");
        });
    }
    $scope.AjouterFournisseur1 = function () {
        $scope.param = {
            'frs': $('#fournisseur1').val(),
            'ref': $('#reffournisseur1').val()
        }
        $http({
            url: domaineapp + '/achats.php/fournisseur/Ajoutfournisseur',
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
            alert("Erreur d'ajout");
        });
    }
    $scope.ViderFournisseur = function (p) {
        $('#reffournisseur' + p).val('');
        $('#fournisseur' + p).val('');
    }
    $scope.ViderFournisseur1 = function () {
        $('#reffournisseur1').val('');
        $('#fournisseur1').val('');
    }
    $scope.ChoisArticle = function (iddoc) {
        $scope.param = {
            "iddoc": iddoc,
            "designation": $('#designation').val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Choisarticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfter(data, '#qtemax', '#designation');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.verifqte = function (deseignation) {
        $scope.param = {
            "deseignation": deseignation
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Verifqte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ValiderFacture = function (iddoc) {

        $scope.verfierSommeFacture(iddoc);
    }

    $scope.verfierSommeFacture = function (iddoc) {
        $scope.param = {
            "id": iddoc,
            "total_facture": $('#total_facture').val(),
            "montantfacture": $('#txt_mnttotal').val(),
            "total_quitance_bdcr": $('#total_quitance_bdcr').val(),
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/TesterSommeFacture',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data.trim();
            if (data === '0') {
                bootbox.dialog({
                    message: 'Voulez-vous verifier le montant dufacture on  ne peux pas depasser la somme des quitances Définitif !!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            } else if (data === '1') {
                $scope.ValidationFactureDuBDCReg(iddoc);
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }


    $scope.ValidationFactureDuBDCReg = function (iddoc) {
        if ($('#reffournisseur1').val() != "" && $('#txt_mnttotal').val()) {
            $scope.param = {
                "iddoc": iddoc,
                "mnttotal": $('#txt_mnttotal').val(),
                "listearticle": $scope.lignedocsdeponse,
                "frs": $('#reffournisseur1').val(),
                "lieulivraison": $('#id_lieup').val(),
                "val_droit_timbre": $('#valeurdroit_societe').val(),
            }
            $http({
                url: domaineapp + '/facturation_dev.php/Documents/Savefacture',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: 'Facture Système crée avec succès  !!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                window.location.reload();
            }, function myError(response) {
                alert(response);
            });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner un fournisseur ou saisir le montant ttc... !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }

    //affiche bon de deponse aux compatnt
    $scope.AfficheLignedocBCIVersBCE = function (iddoc, p) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/AfficheligneListeboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (p === '') {
                $scope.lignedocsdeponse = data;
                var comArr = eval($scope.lignedocsdeponse);
                var nordre = 1;
                for (var i = 0; i < comArr.length; i++) {
                    comArr[i].norgdre = nordre;
                    nordre++;
                }
                if (data[0]['total_ttc'] != 'undefined')
                    $("#total_ttc").val(data[0]['total_ttc']);
            } else {
                $scope.lignedocsdeponsep = data;
                var comArr = eval($scope.lignedocsdeponsep);
                var nordre = 1;
                for (var i = 0; i < comArr.length; i++) {
                    comArr[i].norgdre = nordre;
                    nordre++;
                }

            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //___inilisation bon de deponse au comptant provisire
    $scope.InialiserBDCPS = function () {
        $('#id_lieup_chosen').attr('style', 'width:100%');
        $('#id_lieup').trigger("chosen:updated");
        $('#id_lieu_chosen').attr('style', 'width:100%');
        $('#id_lieu').trigger("chosen:updated");
    }
    $scope.AfficheLignedocBCIVersBCE1 = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/AfficheligneListeboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsdeponse1 = data;
            var comArr = eval($scope.lignedocsdeponse1);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.MisAjourLigneDocBonCInterne = function (id) {
        var comArr = eval($scope.lignedocs);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                if (parseFloat($scope.lignedocs[i].qtemax) < $('#qte_' + id).val()) {
                    bootbox.dialog({
                        message: "Il faut vérifier la quantité !!!",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    $('#qte_' + id).val(parseFloat($scope.lignedocs[i].qtemax).toFixed(2));
                } else {
                    $scope.lignedocs[i].qte = $('#qte_' + id).val();
                    bootbox.dialog({
                        message: "Mise à jour avec succès !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
                break;
            }
        }
    }
    $scope.CalculTotalTtcSys = function (liste, id, def, id_htax) {
        console.log('id_htax' + id_htax);
        var comArr = eval(liste);
        // $('#totalhax' + id).val(parseFloat(total_ttc).toFixed(3));
        var total_ttc = 0;
        var total_ttc_sans_timbre = 0;
        var total_htax = 0;
        var total_htax_net = 0;
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].puht != null) {
                var tva = comArr[i].tva;
                tva = tva.substring(0, tva.length - 1);
                total_ttc = total_ttc + (parseFloat(comArr[i].totalttc));
                total_ttc_sans_timbre = total_ttc_sans_timbre + (parseFloat(comArr[i].totalttc));
                total_htax = total_htax + (parseFloat(comArr[i].totalhtax));
                total_htax_net = total_htax_net + (parseFloat(comArr[i].totalhax));
            }
        }
        var comArr = eval($scope.enteteBExtrene);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].timbre) {
                comArr[i].total_ttc = parseFloat(comArr[i].timbre) + parseFloat(comArr[i].total_ttc);
            }
        }
        if ($("#droit_timbre").is(':checked') == true) {
            var droit_timbre = parseFloat($('#valeurdroit_societe').val());
            total_ttc = total_ttc + droit_timbre;
        }

        if ($("#droit_timbre_sys").is(':checked') == true) {
            var droit_timbre = parseFloat($('#valeurdroit_societe_sys').val());
            total_ttc = total_ttc + droit_timbre;
        }

        $('#total_htax_net').val(total_htax_net.toFixed(3));

        $('#total_htax').val(total_htax.toFixed(3));

        $('#total_htax_sys').val(total_htax.toFixed(3));
        //  $('#' + id_htax).val(parseFloat(total_htax_net).toFixed(3));
        $('#total_ttc_provisoire_bce').val(total_htax.toFixed(3));
        $('#total_ttc_provisoire_bcehidden').val(total_ttc_sans_timbre.toFixed(3));
        $('#total_ttc_sys_bcehidden').val(total_ttc_sans_timbre.toFixed(3));
        $('#total_ttc_').val(total_ttc.toFixed(3));
        $('#total_ttc_provisoire_bdchidden').val(total_ttc_sans_timbre.toFixed(3));
        $('#total_ttc_sys_bcehidden').val(total_ttc_sans_timbre.toFixed(3));
        $('#total_ttc_sys_bdchidden').val(total_ttc_sans_timbre.toFixed(3));

        $('#' + id).val(parseFloat(total_ttc).toFixed(3));

        //        $scope.claculerDroittimber();
        //        if (def == 'bdc')
        //            $scope.claculerDroittimberbdc();
        //        if (def == 'fac')
        //            $scope.claculerDroittimberbdcFacture();

    }
    $scope.CalculTotalTtc = function (liste, id, def, id_htax) {
        console.log('id_htax' + id_htax);
        var comArr = eval(liste);
        // $('#totalhax' + id).val(parseFloat(total_ttc).toFixed(3));
        var total_ttc = 0;
        var total_ttc_sans_timbre = 0;
        var total_htax = 0;
        var total_htax_net = 0;
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].puht != null) {
                var tva = comArr[i].tva;
                tva = tva.substring(0, tva.length - 1);
                total_ttc = total_ttc + (parseFloat(comArr[i].totalttc));
                total_ttc_sans_timbre = total_ttc_sans_timbre + (parseFloat(comArr[i].totalttc));
                total_htax = total_htax + (parseFloat(comArr[i].totalhTax));
                total_htax_net = total_htax_net + (parseFloat(comArr[i].totalhax));
            }
        }

        // if ($scope.enteteBExtrene.length >= 1) {
        $scope.enteteBExtrene.push({
            'total_htax_inial': parseFloat(total_htax_net).toFixed(3),
            'total_ttc_inial': parseFloat(total_ttc).toFixed(3),
            'timbre': $('#id_droit_timbre_p').val(),
            //  'remise_pourcentage': $('#remisetotalpourcentage').val(),
            // 'remise_valeur': $('#remisetotalvaleurttc').val(),
            'total_htax_net': parseFloat(total_htax_net).toFixed(3),
            'total_ttc': parseFloat(total_ttc).toFixed(3),
        });
        // }
        console.log(eval($scope.enteteBExtrene));
        var comArr = eval($scope.enteteBExtrene);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].timbre) {
                comArr[i].total_ttc = parseFloat(comArr[i].timbre) + parseFloat(comArr[i].total_ttc);
            }
        }
        if ($("#droit_timbre").is(':checked') == true) {
            var droit_timbre = parseFloat($('#valeurdroit_societe').val());
            total_ttc = total_ttc + droit_timbre;
        }

        if ($("#droit_timbre_sys").is(':checked') == true) {
            var droit_timbre = parseFloat($('#valeurdroit_societe_sys').val());
            total_ttc = total_ttc + droit_timbre;
        }
        //        else if ($('#total_ttc_provisoire_bcehidden').val() != '' && $('#total_ttc_provisoire').val() != '') {
        //            var droit_timbre = parseFloat($('#valeurdroit_societe').val());
        //            total_ttc = total_ttc - droit_timbre;
        //        }
        $('#total_htax_net').val(total_htax_net.toFixed(3));
        $('#total_htax').val(total_htax.toFixed(3));
        $('#total_htax_sys').val(total_htax.toFixed(3));
        $('#total_htax_provisoire').val(total_htax.toFixed(3));
        $('#' + id_htax).val(parseFloat(total_htax_net).toFixed(3));
        $('#total_ttc_provisoire_bce').val(total_htax.toFixed(3));
        //$('#total_ttc_provisoire_bdc').val(total_htax.toFixed(3));
        $('#total_ttc_provisoire_bcehidden').val(total_ttc_sans_timbre.toFixed(3));
        $('#total_ttc_provisoire_bdc').val(total_ttc_sans_timbre.toFixed(3));



        $('#' + id).val(parseFloat(total_ttc).toFixed(3));
        $('#txt_mnttotal_hidden').val(parseFloat(total_ttc).toFixed(3));
        $scope.claculerDroittimber();
        if (def == 'bdc')
            $scope.claculerDroittimberbdc();
//        if (def == 'fac')
//            $scope.claculerDroittimberbdcFacture();

    }
    $scope.CalculTotalTtcBDC = function (liste, id) {
        var comArr = eval(liste);
        var total_ttc = 0;
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].puht != null && comArr[i].idtva != null) {
                var tva = comArr[i].tva;
                tva = tva.substring(0, tva.length - 1);
                total_ttc = total_ttc + (parseFloat(comArr[i].qte) * (parseFloat(comArr[i].puht) + parseFloat(comArr[i].puht) * parseFloat(tva) / 100));
            }
        }

        $('#' + id).val(parseFloat(total_ttc).toFixed(3));
    }
    $scope.CalculTotalTtccontrat = function (liste, id) {
        //         if ($("#qte").val() != '')
        //            qtedemander = parseFloat($("#qte").val());
        //        else
        //            qtedemander = 0;
        //        if ($('#designation').val() != "" && qtedemander > 0) {
        //            nbligne = $scope.detailscontratss.length + 1;
        //            nordre = $('#nordre').val();
        //            var comArr = eval($scope.detailscontratss);
        //            var existe = 0;
        //            var prixht = parseFloat(parseFloat($("#qte").val()) * parseFloat($("#puht").val()));
        //            $('#totalhax').val(parseFloat(prixht).toFixed(3));
        //
        //            var taux_fodec = $("#taufodec option:selected").text();
        //            taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
        ////            alert('tau='+taux_fodec);
        //
        //
        //            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
        ////            alert(taux_fodec + 'fodec=' + fodec);
        //            $('#fodec').val(parseFloat(fodec).toFixed(3));
        //            var prixthtava = prixht + fodec;
        //            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
        //            var tva = $("#tva option:selected").text();
        //            tva = tva.substring(0, tva.length - 1);
        ////            alert(tva);
        //            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
        //            $('#totalttc').val(parseFloat(prixttc).toFixed(3));
        var comArr = eval(liste);
        var total_ttc = 0;
        //        var totaht=0;
        //        var fodec =0;
        for (var i = 0; i < comArr.length; i++) {
            //            alert(comArr[i].puht+'puht' + comArr[i].idtva);
            if (comArr[i].puht != null && comArr[i].idtva != null) {
                var tva = comArr[i].tva;
                var taufodec = comArr[i].taufodec.trim();
                tva = tva.substring(0, tva.length - 1);
                taufodec = taufodec.substring(0, taufodec.length - 1);
                var prixht = parseFloat(parseFloat(parseFloat(comArr[i].qte) * parseFloat(comArr[i].puht)));
                var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taufodec) / 100));
                //               alert(prixht+'tva'+fodec+'tax'+taufodec +'tfodec');
                //                +taufodec);
                total_ttc = total_ttc + parseFloat((parseFloat(comArr[i].qte) * parseFloat(comArr[i].puht)) +
                        parseFloat((parseFloat(comArr[i].qte) * parseFloat(comArr[i].puht)) *
                                parseFloat(parseFloat(taufodec) / 100))) * parseFloat(1 + parseFloat(tva) / 100);
            }
        }
        //alert(total_ttc);
        $('#' + id).val(parseFloat(total_ttc).toFixed(3));
    }

    $scope.MisAjourLigneDocBonCommandeExterne = function (id, p) {

        if (p === '') {
            var comArr = eval($scope.lignedocsdeponse);
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                    if (parseFloat($scope.lignedocsdeponse[i].qte) < $('#qte_' + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#qte_' + id).val($scope.lignedocsdeponse[i].qte);
                    } else {
                        $scope.lignedocsdeponse[i].qte = $('#qte_' + id).val();
                    }
                    $scope.lignedocsdeponse[i].puht = $('#puht_' + id).val();
                    $scope.lignedocsdeponse[i].tva = $('#tva_' + id + ' option:selected').text();
                    $scope.lignedocsdeponse[i].idtva = $('#tva_' + id).val();
                    $scope.lignedocsdeponse[i].observation = $('#desc_' + id).val();
                    //                    bootbox.dialog({
                    //                        message: 'Mise à jour effectuée avec succès !',
                    //                        buttons:
                    //                                {
                    //                                    "button":
                    //                                            {
                    //                                                "label": "Ok",
                    //                                                "className": "btn-sm"
                    //                                            }
                    //                                }
                    //                    });

                    break;
                }
            }
            $scope.CalculTotalTtc($scope.lignedocsdeponse, 'total_ttc');
        } else {
            var comArr = eval($scope.lignedocsdeponsep);
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                    if (parseFloat($scope.lignedocsdeponsep[i].qte) < $('#qte_' + p + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#qte_' + p + id).val($scope.lignedocsdeponsep[i].qte);
                    } else {
                        $scope.lignedocsdeponsep[i].qte = $('#qte_' + p + id).val();
                    }
                    $scope.lignedocsdeponsep[i].puht = $('#puht_' + p + id).val();
                    $scope.lignedocsdeponsep[i].tva = $('#tva_' + p + id + ' option:selected').text();
                    $scope.lignedocsdeponsep[i].idtva = $('#tva_' + p + id).val();
                    $scope.lignedocsdeponsep[i].observation = $('#desc_' + p + id).val();
                    break;
                }
            }

            $scope.CalculTotalTtc($scope.lignedocsdeponsep, 'total_ttc_provisoire', 'bce', 'total_htax_provisoire');
        }
    }

    $scope.MisAjourLigneDocBonCommandeExterne1 = function (id) {

        if ($('#1puht_' + id).val() != "" && $('#1qte_' + id).val() != "") {

            //console.log($('#1puht_' + id).val());
            var comArr = eval($scope.lignedocsdeponse1);
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                    if (parseFloat($scope.lignedocsdeponse1[i].qte) < $('#1qte_' + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#1qte_' + id).val($scope.lignedocsdeponse1[i].qte);
                    } else {
                        $scope.lignedocsdeponse1[i].qte = $('#1qte_' + id).val();
                    }
                    $scope.lignedocsdeponse1[i].puht = $('#1puht_' + id).val();
                    //                    $scope.lignedocsdeponse1[i].tva = $('#1tva_' + id + ' option:selected').text();
                    //                    $scope.lignedocsdeponse1[i].idtva = $('#1tva_' + id).val();

                    $scope.lignedocsdeponse1[i].tva = $('#1tva_' + id + ' option:selected').text();
                    $scope.lignedocsdeponse1[i].idtva = $('#1tva_' + id).val();
                    //                    alert($scope.lignedocsdeponse1[i].idtva +'lllm');
                    if ($('#1desc_' + id).val() != "")
                        $scope.lignedocsdeponse1[i].observation = $('#1desc_' + id).val();
                    if ($scope.alert_bdcp === "")
                        $('#inf_alert').html($('#inf_alert').html() + '<br>Mise à jour effectuée avec succès ligne :' + comArr[i].norgdre)

                    /*
                     'puht': $('#puht').val(),
                     'tva': $("#tva option:selected").text(),
                     'idtva': $('#tva').val(),
                     'observation': $('#desc').val() 
                     
                     */

                    break;
                }
            }
            $scope.CalculTotalTtcBDC($scope.lignedocsdeponse1, 'txt_mnttotal');
        }
    }

    $scope.ValiderTousBDCP = function () {
        if (confirm('Valider tous les Modifications !!!')) {
            $scope.alert_bdcp = "a";
            var comArr = eval($scope.lignedocsdeponse1);
            for (var i = 0; i < comArr.length; i++) {
                //                console.log($scope.lignedocsdeponse1[i])
                $scope.MisAjourLigneDocBonCommandeExterne1(comArr[i].norgdre);
            }
            $('#btn_validation').removeClass('disabledbutton');
            bootbox.dialog({
                message: 'Mise à jour effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    $scope.DeleteLigneDocBonCInterne = function (id) {
        var index = -1;
        var comArr = eval($scope.lignedocs);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocs.splice(index, 1);
    }

    $scope.DeleteLigneligneContrar = function (id) {
        var index = -1;
        var comArr = eval($scope.lignedocslignecontratp);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocslignecontratp.splice(index, 1);
    }

    $scope.DeleteLigneLigneContratAvenant = function (id) {
        var index = -1;
        var comArr = eval($scope.lignelignecontratAvenant);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignelignecontratAvenant.splice(index, 1);
    }
    $scope.DeleteLigneDocBonCExterne = function (id, p) {
        var index = -1;
        if (p === '')
            var comArr = eval($scope.lignedocsdeponse);
        else
            var comArr = eval($scope.lignedocsdeponsep);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        if (p === '')
            $scope.lignedocsdeponse.splice(index, 1);
        else
            $scope.lignedocsdeponsep.splice(index, 1);
    }
    $scope.DeleteLigneDocBonCExterne1 = function (id) {
        var index = -1;
        var comArr = eval($scope.lignedocsdeponse1);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponse1.splice(index, 1);
    }
    $scope.AjouterLignedoc = function () {
        qteselectionnez = parseFloat($('#qte_txt').val());
        qtemax = parseFloat($('#qtemax').val());
        if ($('#designation').val() != "" && qteselectionnez <= qtemax && qtemax >= 0) {
            nbligne = $scope.lignedocs.length + 1;
            nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
            var comArr = eval($scope.lignedocs);
            var existe = 0;
            var ligne = 0;
            for (var i = 0; i < comArr.length; i++) {
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    ligne = i;
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocs.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'qte': $('#qte_txt').val()

                });
            } else {
                if (ligne != 0)
                    $scope.lignedocs[ligne].qte = $('#qte_txt').val();
            }
            $scope.ViderLignedoc();
        } else {
            alert('Vérifier !!!!');
        }
    }
    $scope.ViderLignedoc = function () {
        $('#designation').val('');
        $('#qte_txt').val('');
    }
    $scope.AfficheLignedocBCI = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/AfficheligneListeboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocs = data;
            var comArr = eval($scope.lignedocs);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
        $scope.AfficheFournisseur(iddoc);
    }

    $scope.Afficherfournisseur = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/Documents/AfficheFournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignefrss = data;
            var comArr = eval($scope.lignefrss);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].id = nordre;
                nordre++;
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ValiderDocumentdeprix = function (iddoc) {
        if ($('#liste_fournisseur_demande tbody tr').length != 0) {
            if ($("#delai").val() != '') {
                var delai = $("#delai").val();
                if (isNaN(delai)) {
                    $("#delai").val('');
                    $("#datemax").val('');
                } else {
                    delai = parseInt($("#delai").val())
                    var data = new Date();
                    //Debut : incrementer délai en jour à une date définie
                    var mydate = new Date(data);
                    mydate.setDate(mydate.getDate() + delai);
                    var y = mydate.getFullYear(),
                            m = mydate.getMonth() + 1, // january is month 0 in javascript
                            d = mydate.getDate();
                    var pad = function (val) {
                        var str = val.toString();
                        return (str.length < 2) ? "0" + str : str
                    };
                    data = [y, pad(m), pad(d)].join("-");
                    //Fin : incrementer délai en jour à une date définie
                    $('#datemax_hidden').val(data);
                }
            }
            var date = $('#datemax').val();
            //        if ($('#delai').val() != '')
            //             datemax = data;
            //        else
            var datemax = $('#datemax_hidden').val();
            //        alert(datemax + date);
            var d2 = new Date(date);
            var d1 = new Date(datemax);
            var DateDiff = {
                inDays: function (d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000));
                },
                inWeeks: function (d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
                },
                inMonths: function (d1, d2) {
                    var d1Y = d1.getFullYear();
                    var d2Y = d2.getFullYear();
                    var d1M = d1.getMonth();
                    var d2M = d2.getMonth();
                    return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                },
                inYears: function (d1, d2) {
                    return d2.getFullYear() - d1.getFullYear();
                }
            }

            if ($('#datemax').val() != '') {
                var diff_j = DateDiff.inDays(d1, d2);
                var diff_y = DateDiff.inYears(d1, d2);
                var diff_m = DateDiff.inMonths(d1, d2);
                //                alert(diff_y +'diff_m'+ diff_m + 'date_j'+diff_j );
            }
            if (diff_j >= 0 && diff_m >= 0 && diff_y >= 0) {


                var fournisseur_ids = '';
                $('input[name="id_fournisseur_tr"]').each(function () {
                    fournisseur_ids = fournisseur_ids + $(this).val() + ',';
                });
                $scope.param = {
                    "iddoc": iddoc,
                    "listearticle": $scope.lignedocs,
                    "frs": fournisseur_ids,
                    "delai": $('#delai').val(),
                    "datemax": $('#datemax').val(),
                    "ref": $('#ref').val(),
                    'numerodoc': $('#hidden_numero_dp').val(),
                    'operation_dps': $('#operation_dps').val(),
                    'numerodossier': $('#numero_dossier').val(),
                    'idlieu': $('#id_lieu').val(),
                    'objet': $('#objet').val()
                }
                $http({
                    url: domaineapp + '/achats.php/documentachat/Savedocumentprix',
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
                    window.location.reload(window);
                }, function myError(response) {
                    alert(response);
                });
            } else
                bootbox.dialog({
                    message: 'Il faut choisr date supérieur au  date système  !!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner au moin un fournisseur !!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }

    //__________________________________________________________________________Ajouter lignedoc bon de deponse
    $scope.AjouterLignedocBondeponse = function () {
        qtemax = parseFloat($('#qtemax').val());
        qtedemander = parseFloat($("#qte").val());
        if ($('#designation').val() != "" && qtemax >= qtedemander && qtemax > 0) {
            nbligne = $scope.lignedocsdeponse.length + 1;
            nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
            var comArr = eval($scope.lignedocsdeponse);
            var existe = 0;
            for (var i = 0; i < comArr.length; i++) {
                if (comArr[i].designation === $('#designation').val()) {
                    existe = 1;
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsdeponse.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'tva': $("#tva option:selected").text(),
                    'idtva': $('#tva').val(),
                    'observation': $('#desc').val()
                });
            }

        } else
            bootbox.dialog({
                message: 'Vérifiez la quantité !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }
    $scope.ViderLignedocBondeponse = function () {
        $('#designation').val('');
        $('#qte').val('');
        $('#tva').val(0);
        $('#puht').val('');
        $('#desc').val('');
    }
    $scope.ValiderBondedeponse = function (iddoc, idbdcp) {
        //        if ($('#fournisseur').val() != "") {
        var remisetotalpourcentageHT;
        var remisetotalvaleurHT;
        var droit_timbre_societe;
        var total_htax;
        droit_timbre_societe = $('#valeurdroit_societe_sys').val();
        total_htax = $('#total_htax_sys').val();
        remisetotalpourcentageHT = $('#remisetotalpourcentageHTSys').val();
        remisetotalvaleurHT = $('#remisetotalvaleurHTSys').val();
        var reference = $('#referencebdc').val();
        $scope.param = {
            "iddoc": iddoc,
            "idbdcp": idbdcp,
            "listearticle": $scope.lignedocsdeponse,
            "frs": $('#fournisseur').val(),
            "id_fils": $('#listesbdcp').val(),
            'id_lieu': $('#id_lieu').val(),
            'droit_tmibre': droit_timbre_societe,
            'total_ttc_bdc': $('#total_ttc_bdc').val(),
            'total_htax': total_htax,
            'remisetotalpourcentageHT': remisetotalpourcentageHT,
            'remisetotalvaleurHT': remisetotalvaleurHT,
            'reference': reference
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Savebondedeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Bon de dépenses aux comptant crée avec succès !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                },
                callback: function (result) {
                    console.log(result);
                }
            });

            document.location.href = '?iddoc=' + iddoc + '&idbdc=' + data.idbdc + '&tab=4';
            $("#btnvalider").addClass('disabledbutton');


        }, function myError(response) {
            alert(response);
        });
        //        } else
        //            bootbox.dialog({
        //                message: 'Il faut sélectionner un fournisseur!!!',
        //                buttons:
        //                        {
        //                            "button":
        //                                    {
        //                                        "label": "Ok",
        //                                        "className": "btn-sm"
        //                                    }
        //                        }
        //            });
    }

    $scope.ValiderBondedeponseRegrouppeDef = function (iddoc, idbdcp) {
        $scope.param = {
            "iddoc": iddoc,
            "idbdcp": idbdcp,
            "listearticle": $scope.lignedocsdeponse,
            "frs": $('#fournisseur').val(),
            "id_fils": $('#id_fils').val(),
            'id_lieu': $('#id_lieu').val(),
            'droit_tmibre': $('#droit_timbre_bdc_sys').val(),
            'total_ttc_bdc': $('#total_ttc_bdc').val(),
            'quitance_def_bdcr': $('#quitance_def_ttc_bdcr').val(),
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/SavebondedeponseRegroupe',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "Bon Dépense au Comptant Regroupe Définitif Crée avec succée !!!!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            window.location.reload();
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.ValiderBondedeponseDEF = function (iddoc, idbdcp) {
        var mnt_quitance = $('#quitance_def_ttc_bdc').val();
        var mnt_total = $('#total_ttc_bdc').val();
        if (mnt_quitance != mnt_total) {
            bootbox.dialog({
                message: 'Il faut que les deux montant sont égaux !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        } else {
            if ($('#fournisseur').val() != "") {
                $scope.param = {
                    "iddoc": iddoc,
                    "idbdcp": idbdcp,
                    "listearticle": $scope.lignedocsdeponse,
                    "frs": $('#fournisseur').val(),
                    "id_fils": $('#listesbdcp').val(),
                    'id_lieu': $('#id_lieu').val(),
                    'droit_tmibre': $('#droit_timbre_bdc_sys').val(),
                    'total_ttc_bdc': $('#total_ttc_bdc').val(),
                }
                $http({
                    url: domaineapp + '/achats.php/documentachat/SavebondedeponseDef',
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
                    alert(response);
                });
            } else
                bootbox.dialog({
                    message: 'Il faut sélectionner un fournisseur!!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
        }
    }
    $scope.ValiderBondedeponseProvisoireEnSerie = function (iddoc) {
        if ($('#fournisseur1').val() != "" && $('#txt_mnttotal_bdc').val()) {
            $scope.param = {
                "iddoc": iddoc,
                "mnttotal": $('#txt_mnttotal_bdc').val(),
                "listearticle": $scope.lignedocsdeponse1,
                "frs": $('#fournisseur1').val(),
                "lieulivraison": $('#id_lieup').val()
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/Savebondedeponseprovisoire',
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
                //                window.location.reload();
                $scope.viderInterface(iddoc);
            }, function myError(response) {
                alert(response);
            });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner un fournisseur ou saisir le montant TTC... !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }

    $scope.viderInterface = function () {
        $('#reffournisseur1').val('');
        $('#fournisseur1').val('');
        $('#txt_mnttotal').val('');
    }

    $scope.ValiderBondedeponseProvisoire = function (iddoc) {
        msg = "Enregistrer le bon de dépense au comptant provisoire!!";
        bootbox.confirm({
            message: msg,
            buttons: {
                cancel: {
                    label: "Annuler",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Valider",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {

                if (result) {
                    var remisetotalpourcentageHT;
                    var remisetotalvaleurHT;
                    var reference = $('#referencebdc_p').val();
                    var droit_timbre_societe;
                    var total_htax;
                    var type_bdc = $('#bdc_type').val();
                    var droit_timbre = $('#bdc_droittimbre').val();
                    droit_timbre_societe = $('#valeurdroit_societe').val();
                    var mnttotal_bdc = $('#txt_mnttotal_bdc').val();
                    total_htax = $('#total_htax').val();
                    remisetotalpourcentageHT = $('#remisetotalpourcentageHT').val();
                    remisetotalvaleurHT = $('#remisetotalvaleurHT').val();
                    $scope.param = {
                        "iddoc": iddoc,
                        "reference": reference,
                        "mnttotal": $('#txt_mnttotal').val(),
                        "listearticle": $scope.lignedocsdeponse1,
                        "frs": $('#fournisseur1').val(),
                        "lieulivraison": $('#id_lieup').val(),
                        "droit_timbre": droit_timbre,
                        "mnttotal_bdc": mnttotal_bdc,
                        "type_bdc": type_bdc,
                        'total_htax': total_htax,
                        'droit_timbre_societe': droit_timbre_societe,
                        'remisetotalpourcentageHT': remisetotalpourcentageHT,
                        'remisetotalvaleurHT': remisetotalvaleurHT,
                    }
                    $http({
                        url: domaineapp + '/achats.php/documentachat/Savebondedeponseprovisoire',
                        method: "POST",
                        data: $scope.param,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        data = response.data;
                        bootbox.dialog({
                            message: 'Bon de dépenses aux comptant provisoire crée avec succès!!! ',
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        window.location.reload();
                    }, function myError(response) {
                        alert(response);
                    });
                }
            }
        });


    }



    $scope.testermfiscaleconpteFournisseur = function (iddoc, p) {
        if ($('#fournisseur1').val() != "") {
            var idfrs = $('#reffournisseur1').val();
            $scope.param = {
                'idfrs': idfrs
            }
            $http({
                url: domaineapp + 'achats.php/documentachat/testexistancomptecomptable',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                if (data['id_compte'] == '' || data['id_compte'] == null || data['matriculefiscale'] == "" || data['matriculefiscale'] == null) {
                    bootbox.dialog({
                        message: "Il 'ya une information manquante : compte comptable et matricule fiscale !!!",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    //                document.location.href = "edit?id=" + data['id'];

                } else {
                    $scope.validationBonExterne(iddoc, p);
                }


            }, function myError(response) {
                alert(response);
            });
        }
    }
    $scope.disableBtn = false;
    $scope.ValiderBondexterne = function (iddoc, p) {

        //        $scope.testermfiscaleconpteFournisseur(iddoc, p);
        $scope.disableBtn = true;
        $scope.validationBonExterne(iddoc, p);
    }

    $scope.validationBonExterne = function (iddoc, p) {
        if (confirm('Voulez-vous Enregistrer Bon commande externe !!!')) {

            if (p == "" && $('#listesbdcp').val() == "0") {
                $('#btnvalider_bdcd').addClass('disabledbutton');
            }
            if ($('#fournisseur' + p).val() != "" && $('#maxreponse' + p).val() != "" && $('#idnote' + p).val() != "0") {
                var doit_timbre;
                if ($scope.lignedocsdeponsep.length > 0 || $scope.lignedocsdeponse.length > 0) {
                    if (p === '') {
                        doit_timbre = $('#droit_timbre_sys').val();
                        var comArr = eval($scope.lignedocsdeponse);
                        for (var i = 0; i < comArr.length; i++) {
                            if (comArr[i].puht == null && comArr[i].idtva == null) {
                                $('#btnvalider_bdcd').removeClass('disabledbutton');
                                bootbox.dialog({
                                    message: "Il faut saisir tout les prix unitaire H.T !",
                                    buttons: {
                                        "button": {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                                    }
                                });
                                return;
                            }
                        }

                        var tab = eval($scope.lignedocsdeponse);
                    } else {
                        doit_timbre = $('#documentachat_droittimbre').val();
                        var comArr = eval($scope.lignedocsdeponsep);
                        for (var i = 0; i < comArr.length; i++) {
                            if (comArr[i].puht == null && comArr[i].idtva == null) {
                                $('#btnvalider_bdcd').removeClass('disabledbutton');
                                bootbox.dialog({
                                    message: "Il faut saisir tout les prix unitaire H.T !",
                                    buttons: {
                                        "button": {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                                    }
                                });
                                return;
                            } else {
                                // $scope.MisAjourLigneDocBonCommandeExterne(comArr[i].norgdre, 'p_');
                            }
                        }
                        var tab = eval($scope.lignedocsdeponsep);
                    }
                    var datecreation = "";
                    if ($('#datecreation' + p).val())
                        datecreation = $('#datecreation' + p).val();

                    var id_fournisseur = '';
                    var remisetotalpourcentageHT;
                    var remisetotalvaleurHT;
                    var total_ttc_provisoire;
                    var droit_timbre_societe;
                    var reference;
                    var total_htax;
                    if (p == '') {
                        id_fournisseur = $("#listesbdcp").find(":selected").attr("fournisseuridbce");
                        total_ttc_provisoire = $('#total_ttc').val();
                        droit_timbre_societe = $('#valeurdroit_societe_sys').val();
                        total_htax = $('#total_htax_sys').val();
                        remisetotalpourcentageHT = $('#remisetotalpourcentageHTSys').val();
                        remisetotalvaleurHT = $('#remisetotalvaleurHTSys').val();
                        reference = $('#reference').val();
                    } else {
                        id_fournisseur = $('#fournisseur' + p).val();
                        reference = $('#reference' + p).val();
                        total_ttc_provisoire = $('#total_ttc_provisoire').val();
                        droit_timbre_societe = $('#valeurdroit_societe').val();
                        total_htax = $('#total_htax').val();
                        remisetotalpourcentageHT = $('#remisetotalpourcentageHT').val();
                        remisetotalvaleurHT = $('#remisetotalvaleurHT').val();
                    }
                    $scope.param = {
                        "iddoc": iddoc,
                        "listearticle": tab,
                        "frs": id_fournisseur,
                        "reference": reference,
                        "datemax": $('#maxreponse' + p).val(),
                        "id_note": $('#idnote' + p).val(),
                        "designation": $('#descriptionbce' + p).val(),
                        'id_lieu': $('#id_lieu' + p).val(),
                        'p': p,
                        'id_fils': $('#listesbdcp').val(),
                        'datecreation': datecreation,
                        'total_ttc_provisoire': total_ttc_provisoire,
                        'total_htax': total_htax,
                        'droit_timbre_societe': droit_timbre_societe,
                        'remisetotalpourcentageHT': remisetotalpourcentageHT,
                        'remisetotalvaleurHT': remisetotalvaleurHT,
                    }
                    $http({
                        url: domaineapp + '/achats.php/documentachat/Savebonexterne',
                        method: "POST",
                        data: $scope.param,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        data = response.data;
                        bootbox.dialog({
                            message: 'Bon Commande Externe ajouté avec succée!!!!!!!!!',
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            },
                            callback: function (result) {
                                console.log(result);
                            }
                        });

                        document.location.href = '?iddoc=' + $("#iddoc").val() + '&idbdc=' + data.idbdc + '&tab=4';
                        $("#btnvalider").addClass('disabledbutton');
                    }, function myError(response) {
                        alert(response);
                    });
                } else
                    bootbox.dialog({
                        message: 'Il faut valider la liste des articles !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
            } else {
                if ($('#fournisseur' + p).val() == "") {
                    $scope.disableBtn = false;
                    bootbox.dialog({
                        message: 'Il faut sélectionner un fournisseur!!! ',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                } else if ($('#maxreponse' + p).val() == "") {
                    $scope.disableBtn = false;
                    bootbox.dialog({
                        message: 'Il faut déternimer la date limite de la réponse!!! ',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                } else {
                    $scope.disableBtn = false;
                    bootbox.dialog({
                        message: 'Il faut choisir une note !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
            }
        } else {
            //$('#btnvalider_bdcd').addClass('disabledbutton');
        }
    }
    $scope.ValiderContratdefinitif = function (iddoc, p, idcontrat) {
        //listescontrat
        if ($('#fournisseur' + p).val() != "") {
            if ($scope.lignedocscontratp.length > 0 || $scope.lignedocscontratp.length > 0) {
                if (p === '') {
                    var comArr = eval($scope.lignedocscontratp);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].puht == null && comArr[i].idtva == null) {
                            $('#btnvalider_contrat').removeClass('disabledbutton');
                            bootbox.dialog({
                                message: "Il faut saisir tout les prix unitaire H.T !",
                                buttons: {
                                    "button": {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                                }
                            });
                            return;
                        }
                    }

                    var tab = eval($scope.btnvalider_contrat);
                } else {
                    var comArr = eval($scope.btnvalider_contrat);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].puht == null && comArr[i].idtva == null) {
                            $('#btnvalider_contrat').removeClass('disabledbutton');
                            bootbox.dialog({
                                message: "Il faut saisir tout les prix unitaire H.T !",
                                buttons: {
                                    "button": {
                                        "label": "Ok",
                                        "className": "btn-sm"
                                    }
                                }
                            });
                            return;
                        } else {
                            $scope.MisAjourLigneDocContrat(comArr[i].norgdre, 'p_');
                        }
                    }
                    var tab = eval($scope.lignedocscontratp);
                }
                var id_fournisseur = '';
                id_fournisseur = $('#fournisseur_id').val();
                $scope.param = {
                    "iddoc": iddoc,
                    "idcontrat": idcontrat,
                    "listearticle": $scope.lignedocscontratp,
                    "frs": id_fournisseur,
                    "datefin": $('#contratachat_datefin').val(),
                    "total_ttc": $('#total_ttc').val(),
                    "cautionement": $('#contratachat_cautionement').val(),
                    "retenuegaraentie": $('#contratachat_retenuegaraentie').val(),
                    "avance": $('#contratachat_avance').val(),
                    "penalite": $('#contratachat_penalite').val(),
                    "designation": $('#descriptionbce' + p).val(),
                    'p': p,
                    'id_fils': $('#listescontrat').val(),
                    "listelignecontrat": $scope.lignedocslignecontratp,
                }
                $http({
                    url: domaineapp + '/achats.php/documentachat/SaveContratdefintif',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    bootbox.dialog({
                        message: "Contrat Définitif est crée avec succès",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    window.location.reload();
                }, function myError(response) {
                    alert(response);
                });
            } else
                bootbox.dialog({
                    message: 'Il faut valider la liste des articles !',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
        } else {
            if ($('#fournisseur' + p).val() == "") {
                bootbox.dialog({
                    message: 'Il faut sélectionner un fournisseur!!! ',
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
    $scope.ListesTva = function () {

        $http({
            url: domaineapp + '/achats.php/documentachat/Listetva',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.tvalistes = data;
            $('#tvalistes').trigger("chosen:updated");
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ListesTva();
    $scope.ListesTauxfodec = function () {
        $http({
            url: domaineapp + '/achats.php/documentachat/Listetauxfodec',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.fodeclistes = data;
            $('#fodeclistes').trigger("chosen:updated");
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ListesTauxfodec();
    // $('#tva').removeClass("selectpicker");
    $scope.AfficheDoc = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listebondeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log(data);
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheDocBDCR = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/ListebondeponseRegroupeProvisore',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheDocBCEP = function (iddoc) {

        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listebcommandeexterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ChoisirBDCD = function (iddoc) {
        $scope.param = {
            'idlignedoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignedeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailfrs = data[0];
            $('#reffournisseur').val($scope.detailfrs.ref);
            $('#fournisseur').val($scope.detailfrs.rs);
            $('#referencebdc').val($scope.detailfrs.reference);
            $('#id_lieu').val($scope.detailfrs.id_lieu);
            $('#id_lieu').trigger("chosen:updated");
            $('#maxreponse').val($scope.detailfrs.maxreponsefrs);
            $('#idnote').val($scope.detailfrs.id_note);
            $('#total_htax_sys').val($scope.detailfrs.total_htax);
            $('#descriptionbce').val($scope.detailfrs.observation);
            $('#valeurdroit_societe_sys').val($scope.detailfrs.droittimbre);
            $('#remisetotalvaleurHTSys').val($scope.detailfrs.totalremisevaleur);
            $('#remisetotalpourcentageHTSys').val($scope.detailfrs.totalremisehpour);
            if ($scope.detailfrs.droittimbre > 0.000) {
                $('#droit_timbre_sys_bdc').prop("checked", true);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.AfficheLignePDCP = function (id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Affichelignebdcp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsdeponse = data;
            $('#total_ttc_bdc').val(data[0]['mntttc']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheLignePCEP = function (id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Affichelignebdcp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsdeponse = data;
            if (data[0]['droittimbre'] == 1) {
                var total_ttc = parseFloat(data[0]['mntttc']) + 0.600;
                $('#total_ttc').val(total_ttc);
            } else
                $('#total_ttc').val(data[0]['mntttc']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.EtatBDCP_dans_budget = function (id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Etatbdcpenbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = $.trim(response.data);
            if (data === '0') {
                if (confirm('Voulez-vous sélectionner le bon de dépense au comptant provisoire!!')) {
                    $scope.ChoisirBDCD(id);
                    $scope.AfficheLignePDCP(id);
                    $('#btnvalider_bdcd').removeClass('disabledbutton');
                } else {
                    $('#btnvalider_bdcd').addClass('disabledbutton');
                }
            } else {
                if (data === '1')
                    bootbox.dialog({
                        message: 'L\'imputation budget n\'est pas attribuée pour ce document provisoire !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                if (data === '2')
                    bootbox.dialog({
                        message: 'Bon de dépense définitif existe déjà !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                $('#btnvalider_bdcd').addClass('disabledbutton');
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.EtatBDCP_dans_budgetBDCNULL = function (id) {
        //        alert('dede');
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Etatbdcpenbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = $.trim(response.data);
            if (data === '0') {
                if (confirm('Voulez-vous sélectionner le bon de dépense au comptant provisoire!!')) {
                    $scope.ChoisirBDCD(id);
                    $scope.AfficheLignePDCP(id);
                    $('#btnvalider_bdcd').removeClass('disabledbutton');
                } else {
                    $('#btnvalider_bdcd').addClass('disabledbutton');
                }
            } else {
                if (data === '1')
                    bootbox.dialog({
                        message: 'L\'imputation budget n\'est pas attribuée pour ce document provisoire !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                if (data === '2')
                    bootbox.dialog({
                        message: 'Bon de dépense définitif existe déjà !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                $('#btnvalider_bdcd').addClass('disabledbutton');
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.ChoisirBDCP = function (iddoc) {
        $scope.param = {
            'idlignedoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignebcep',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailfrs = data[0];
            $('#reffournisseur').val($scope.detailfrs.ref);
            $('#reference').val($scope.detailfrs.reference);
            $('#fournisseur').val($scope.detailfrs.rs);
            $('#id_lieu').val($scope.detailfrs.id_lieu);
            $('#id_lieu').trigger("chosen:updated");

            $('#maxreponse').val($scope.detailfrs.maxreponsefrs);
            $('#idnote').val($scope.detailfrs.id_note);
            $('#total_htax_sys').val($scope.detailfrs.total_htax);
            $('#descriptionbce').val($scope.detailfrs.observation);
            $('#valeurdroit_societe_sys').val($scope.detailfrs.droittimbre);
            $('#remisetotalvaleurHTSys').val($scope.detailfrs.totalremisevaleur);
            $('#remisetotalpourcentageHTSys').val($scope.detailfrs.totalremisehpour);
            if ($scope.detailfrs.droittimbre > 0.000) {
                $('#droit_timbre_sys').prop("checked", true);
            }
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.EtatBCEP_dans_budget = function (id) {
        console.log('iddemandeprix=', id);
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Etatbdcpenbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = $.trim(response.data);
            if (data === '0') {
                if (confirm('Voulez-vous sélectionner le bon de commande externe provisoire!!')) {
                    $scope.ChoisirBDCP(id);
                    $scope.AfficheLignePCEP(id);
                    $('#btnvalider_bdcd').removeClass('disabledbutton');
                } else {
                    $('#btnvalider_bdcd').addClass('disabledbutton');
                }
            } else {
                if (data === '1')
                    bootbox.dialog({
                        message: 'L\'imputation budget n\'est pas attribuée pour ce document provisoire !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                if (data === '2')
                    bootbox.dialog({
                        message: 'Bon commande externe définitif existe déjà !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                $('#btnvalider_bdcd').addClass('disabledbutton');
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $('#tva').addClass("form-control");
});
app.controller('CtrlListesDemandeprix', function ($scope, $http) {

    $scope.docDemandePrix = [];
    $scope.AfficheDoc = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/ListedemandeprixByDocs',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.DetailLignedoc = function (idlignedoc) {

        $scope.param = {
            'idlignedoc': idlignedoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignedemandeprix',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsDemandedeprix = data;
            $scope.detailfrs = data[0];
            $('#divdetail').attr('style', 'float: right;');
            $('#documentscan').attr('style', 'display: block');
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
});
app.controller('CtrlListesBondeponse', function ($scope, $http) {

    $scope.docDemandePrix = [];
    $scope.docDemandePrixBDCRS = [];
    $scope.AfficheDocBDCRegroupe = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/ListebondeponseRegroupe',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrixBDCRS = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheDoc = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listebondeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            console.log('data=' + data);
            $scope.docDemandePrix = data;
            // $('#montant_total').val(data[0]['montanttotal'].trim());
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheDocBDCR = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/ListebondeponseRegroupe',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheMontantTotal = function (iddoc) {

        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/AfficheMontanttotal',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            if (!isNaN(parseFloat(data.montanttotal)))
                $('#montant_total').val(parseFloat(data.montanttotal));
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.DetailLignedocBDCR = function (idlignedoc) {

        $scope.param = {
            'idlignedoc': idlignedoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/DetaillignedeponseBDCR',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsDemandedeprix = data;
            $scope.detailfrs = data[0];
            $('#divdetail').attr('style', 'float: right;');
            $('#documentscan').attr('style', 'display: block');
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.ChoisirBDCD = function (iddoc) {
        $scope.param = {
            'idlignedoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignedeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailfrs = data[0];
            $('#reffournisseur').val($scope.detailfrs.ref);
            $('#fournisseur').val($scope.detailfrs.rs);
        }, function myError(response) {
            alert("Erreur ....");
        });
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Afficheligneboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocBDCP = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.DetailLignedoc = function (idlignedoc) {

        $scope.param = {
            'idlignedoc': idlignedoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignedeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsDemandedeprix = data;
            $scope.detailfrs = data[0];
            $('#divdetail').attr('style', 'float: right;');
            $('#documentscan').attr('style', 'display: block');
        }, function myError(response) {
            alert("Erreur ....");
        });
    }


    $scope.ValiderRegrouppementBondedeponseProvisoire = function (iddoc) {
        if ($('#montant_total').val() != '') {
            $scope.param = {
                "iddoc": iddoc,
                "mnttotal": $('#montant_total').val(),
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/Savebondedeponseprovisoireregrouepe',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                //                bootbox.dialog({
                //                    message: data,
                //                    buttons:
                //                            {
                //                                "button":
                //                                        {
                //                                            "label": "Ok",
                //                                            "className": "btn-sm"
                //                                        }
                //                            }
                //                });
                //                window.location.reload();
            }, function myError(response) {
                alert(response);
            });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner un fournisseur ou saisir le montant ttc... !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }

});
app.controller('CtrlListesBonexterne', function ($scope, $http) {

    $scope.docDemandePrix = [];
    $scope.atrubition = "";
    $scope.AfficheDoc = function (iddoc) {
        var atrubitionbudgetaire = "";
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listebonexterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.TestAjouterSignature = function (iddoc) {
        $scope.atrubition = "";
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Afficheatributionbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.atrubition = data;
            if (data != "")
                $('#atr_' + iddoc).removeClass('disabledbutton');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.DetailLignedoc = function (idlignedoc) {

        $scope.param = {
            'idlignedoc': idlignedoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignedeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsDemandedeprix = data;
            $scope.detailfrs = data[0];
            $('#divdetail').attr('style', 'float: right;');
            $('#documentscan').attr('style', 'display: block');
        }, function myError(response) {
            alert("Erreur ....");
        });
    }

    $scope.ValiderSignature = function (id) {

        $scope.param = {
            'id': id,
            'datesignature': $('#datesignature' + id).val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Signature',
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
            alert("Erreur ....");
        });
    }
    $scope.ValiderSignatureRedirectPage = function (id) {

        $scope.param = {
            'id': id,
            'datesignature': $('#datesignature' + id).val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Signature',
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
    }

});
//recherchedocs & detail document
app.controller('Ctrlrecherchedocs', function ($scope, $http) {


    $scope.listesbci = [];
    $scope.recherche = {
        text: ""
    };
    if ($('#designation').val() != "")
        $scope.recherche.text = $('#designation').val();
    $scope.AfficheDoc = function () {
        $scope.param = {
            'recherche': $('#designation').val(),
        }

        $http({
            url: domaineapp + '/achats.php/documentachat/Listeboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesbci = data;
            AjoutHtmlAfter(data, '#idbci', '#designation');
            //$('#designation').val(texte_recherche);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
});
//_____________________________________________________________________________controlleur marchés
app.controller('myCtrlmarche', function ($scope, $http) {
    $scope.financement = [];
    $scope.InialiserChamps = function () {
        $scope.FixerValeurUser();
    }
    $scope.FixerValeurUser = function () {
        var iduser = $('#iduser').val();
        var iddoc = $('#iddocumentachat').val();
        $('#marches_id_user').val(iduser);
        $('#marches_id_user').trigger("chosen:updated");
        $('#marches_id_user').attr('class', 'disabledbutton');
        if (iddoc != "") {

            $('#marches_id_documentachat').val(iddoc);
            $('#marches_id_documentachat').trigger("chosen:updated");
            $('#marches_id_documentachat').attr('class', 'disabledbutton');
        }
    }
    $scope.InialiserCombo = function (table, id) {
        $scope.param = {
            'table': table,
            'id': id
        }
        $http({
            url: domaineapp + 'marchee.php/marches/Affichesource',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (table == "sourcesbudget") {
                $scope.sourcesbudgets = data;
                $scope.ChargerCombo('#sltsource', data);
                console.log("Source");
                //   $scope.AjouterElement(data, '#sltsource', 'titrebudjet');
            }
            if (table == "titrebudjet") {
                $scope.titrebudget = data;
                $scope.ChargerCombo('#slttitre', data);
                console.log("titre");
                //  $scope.AjouterElement(data, '#slttitre', 'rubrique');
            }
            if (table == "rubrique") {
                $scope.ChargerCombo('#sltrub', data);
                //   $scope.AjouterElement(data, '#sltrub', 'sousrubrique');
                $scope.rubrique = data;
                console.log("Rubrique");
            }
            if (table == "sousrubrique") {
                $scope.sousrubrique = data;
                $scope.ChargerCombo('#sltsrub', data);
                console.log("Sous Rubrique");
            }
            $('#sltsource_chosen').attr('style', 'width:100%');
            $('#slttitre_chosen').attr('style', 'width:100%');
            $('#sltrub_chosen').attr('style', 'width:100%');
            $('#sltsrub_chosen').attr('style', 'width:100%');
            ////             $('select').attr('class', "chosen-select form-control");
            $('#sltsource').trigger("chosen:updated");
            $('#slttitre').trigger("chosen:updated");
            $('#sltrub').trigger("chosen:updated");
            $('#sltsrub').trigger("chosen:updated");
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $("#sltsource")
            .change(function () {
                if ($("#sltsource").val() != "" && $("#sltsource").val() != null) {
                    var id = $("#sltsource").val();
                    $scope.InialiserCombo('titrebudjet', id);
                    if (id == 2) {
                        $('#financement_id_tva').val(3);
                        $('#financement_id_tva').addClass('disabledbutton');
                    } else {
                        $('#financement_id_tva').val('');
                        $('#financement_id_tva').removeClass('disabledbutton');
                    }
                }
            })
            .trigger("change");
    $("#slttitre")
            .change(function () {
                if ($("#slttitre").val() != "" && $("#slttitre").val() != null) {
                    var id = $("#slttitre").val();
                    $scope.InialiserCombo('rubrique', id);
                }
            })
            .trigger("change");
    $("#sltrub")
            .change(function () {
                if ($("#sltrub").val() != "" && $("#sltrub").val() != null) {
                    var id = $("#sltrub").val();
                    $scope.InialiserCombo('sousrubrique', id);
                }
            })
            .trigger("change");
    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option  value='" + data[i].id + "'>" + data[i].libelle + "</option>");
            // $('#nbexterne').val(data[i].id);
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.CalculerTTC = function (op) {
        if (($('#financement_mntht').val() != "" || $('#financement_mntttc').val() != "") && $('#financement_id_tva option:selected').text() != '') {
            var tva = parseFloat($('#financement_id_tva option:selected').text().replace("%", ""));
            if (op != 0 && op != 2) {
                if ($('#financement_mntht').val() != "") {
                    var ht = parseFloat($('#financement_mntht').val());
                    var ttc = ht * (1 + (tva / 100));
                    var mnttva = ttc - ht;
                    $('#financement_mnttva').val(mnttva.toFixed(3));
                    $('#financement_mntttc').val(ttc.toFixed(3));
                } else {
                    $('#financement_mnttva').val('');
                    $('#financement_mntttc').val('');
                }
            }
            if (op != 0 && op != 1) {
                if ($('#financement_mntttc').val() != "") {
                    var ttc = parseFloat($('#financement_mntttc').val());
                    var ht = ttc / (1 + (tva / 100));
                    var mnttva = ttc - ht;
                    $('#financement_mnttva').val(mnttva.toFixed(3));
                    $('#financement_mntht').val(ht.toFixed(3));
                } else {
                    $('#financement_mnttva').val('');
                    $('#financement_mntht').val('');
                }
            }

            //Vérifier total TTC
            var montant_ttc_marche = $("#marches_mntttc").val();
            var montant_ttc = $('#financement_mntttc').val();
            //            alert(montant_ttc_marche+'gggg'+montant_ttc);
            if (montant_ttc_marche) {
                var total_ttc = 0;
                var comArr = eval($scope.financement);
                for (var i = 0; i < comArr.length; i++) {
                    total_ttc = parseFloat(total_ttc) + parseFloat(comArr[i].mntttc);
                }

                total_ttc = parseFloat(total_ttc) + parseFloat(montant_ttc);
                if (parseFloat(montant_ttc_marche) >= parseFloat(total_ttc)) {
                    //            rien à faire
                } else {
                    bootbox.dialog({
                        message: "Attention ! Vous avez dépaser le montant total TTC du Marché !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    $('#financement_mntht').val('0');
                    $('#financement_mnttva').val('0');
                    $('#financement_mntttc').val('0');
                }
            }
        }
    }

    $scope.AjouterElement = function (data, ComboName, nametable) {
        var select = $(ComboName);
        var option = $("<option >").val('').text('');
        select.prepend(option);
        select.find(option).prop('selected', true);
        select.find(option).click();
        for (i = 0; i < data.length; i++) {
            var option = $("<option ng-click='" + $scope.InialiserCombo(nametable, data[i].id) + "' >").val(data[i].id).text(data[i].source);
            select.prepend(option);
            select.find(option).prop('selected', true);
            select.find(option).click();
            select.trigger('chosen:updated');
            // $('#sltsource').append('<option value=' + data[i].id + '>' + data[i].source + '</option>');
        }
    }
    $scope.AjouterFinacement = function () {
        $("#BtnValide").addClass('disabledbutton');
        var valide = "";
        console.log('Valide=""');
        if (!$('#financement_id_tva').val())
            valide = "Veuillez choisir Tva\n";
        if (!$('#sltrub').val())
            valide += "Veuillez choisir rubrique\n";
        if (!$('#financement_mntht').val())
            valide += "Veuillez taper le mnt HT";
        console.log(valide);
        if (valide == "") {
            $scope.financement.push({
                'idfinancement': '',
                'ordre': $scope.financement.length + 1,
                'id_budget': $('#sltsource').val(),
                'id_titre': $('#slttitre').val(),
                'id_rubrique': $('#sltrub').val(),
                'id_sousrubrique': $('#sltsrub').val(),
                'budget': $('#sltsource option:selected').text(),
                'titre': $('#slttitre option:selected').text(),
                'rubrique': $('#sltrub option:selected').text(),
                'sousrubrique': $('#sltsrub option:selected').text(),
                'mntht': $('#financement_mntht').val(),
                'id_tva': $('#financement_id_tva').val(),
                'mnttva': $('#financement_mnttva').val(),
                'mntttc': $('#financement_mntttc').val(),
                'nature': $('#financement_natureprix').val(),
                'caractere': $('#financement_caracteristiqueprix').val(),
                'tva': $('#financement_id_tva option:selected').text()
            });
            $scope.Inialiserfinancement();
            $("#BtnValide").removeClass('disabledbutton');
        } else {
            bootbox.dialog({
                message: valide,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            $("#BtnValide").addClass('disabledbutton');
        }
    }
    $scope.DeleteLigne = function (ordre, idfn, id_lig) {
        msg = "Voulez-vous valider la supression du Budget Engagé  ?";
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
                    $scope.DeleteEngagementEtfinacnemment(ordre, idfn, id_lig);
                }
            }
        });
    }
    $scope.DeleteEngagementEtfinacnemment = function (ordre, idf, id_lig) {
        var index = -1;
        var comArr = eval($scope.financement);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].ordre === ordre) {
                index = i;
                break;
            }
        }
        $scope.financement.splice(index, 1);
        $scope.DeleteLigneBase(idf, id_lig);
    }
    $scope.DeleteLigneBase = function (idf, id_lig) {
        if (idf != "") {
            $scope.param = {
                'idf': idf,
                'id_lig': id_lig,
            }
            $http({
                url: domaineapp + 'marchee.php/financement/Deletefinancement',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                //                data = response.data;
                //                bootbox.dialog({
                //                    message: 'Suppression effectuée !',
                //                    buttons:
                //                            {
                //                                "button":
                //                                        {
                //                                            "label": "Ok",
                //                                            "className": "btn-sm"
                //                                        }
                //                            }
                //                });
            }, function myError(response) {
                alert(response);
            });
        }
    }
    $scope.Inialiserfinancement = function () {

        $('#sltsource').empty();
        $('#sltsource').val('').trigger("liszt:updated");
        $('#sltsource').trigger("chosen:updated");
        $('#slttitre').empty();
        $('#slttitre').val('').trigger("liszt:updated");
        $('#slttitre').trigger("chosen:updated");
        $('#sltrub').empty();
        $('#sltrub').val('').trigger("liszt:updated");
        $('#sltrub').trigger("chosen:updated");
        $('#sltsrub').empty();
        $('#sltsrub').val('').trigger("liszt:updated");
        $('#sltsrub').trigger("chosen:updated");
        $('#financement_mntht').val('');
        $('#financement_id_tva').val('');
        $('#financement_mnttva').val('');
        $('#financement_mntttc').val('');
        $('#financement_natureprix').val('');
        $('#financement_caracteristiqueprix').val('');
        $scope.InialiserCombo('sourcesbudget', '');
    }
    $scope.InialiserCampsFianancement = function () {
        $('#sltsource_chosen').attr('style', 'width:100%');
        $('#slttitre_chosen').attr('style', 'width:100%');
        $('#sltrub_chosen').attr('style', 'width:100%');
        $('#sltsrub_chosen').attr('style', 'width:100%');
        ////             $('select').attr('class', "chosen-select form-control");
        $('#sltsource').trigger("chosen:updated");
        $('#slttitre').trigger("chosen:updated");
        $('#sltrub').trigger("chosen:updated");
        $('#sltsrub').trigger("chosen:updated");
    }

    $scope.ChargerFinancement = function () {
        if ($('#idmarche').val() != '') {
            $scope.param = {
                'idmarche': $('#idmarche').val()
            }

            $http({
                url: domaineapp + 'marchee.php/financement/ChargerFinancement',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.financement = data;
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }
    $scope.ValiderAffectier = function () {
        $scope.param = {
            'source': $scope.financement,
            'idmarche': $('#idmarche').val()
        }

        $http({
            url: domaineapp + 'marchee.php/financement/Savefinancement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            if (data == "reload")
            window.location.reload();
            $scope.financement = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.InialiserChamps();
    // lot
    $scope.Calculerrrr = function (i, op) {
        var tva = parseFloat($('#lot' + i + ' #lots_id_tva option:selected').text());
        var rrr = parseFloat($('#lot' + i + ' #lots_rrr').val());
        if (op != 0 && op === '1') {
            var ht = parseFloat($('#lot' + i + ' #lots_totalht').val());
            if (rrr)
                var ttc = ht * (1 - (rrr / 100));
            else
                var ttc = ht;
            if (tva)
                var ttcnet = ttc * (1 + (tva / 100));
            else
                var ttcnet = ttc;
            $('#lot' + i + ' #lots_totalapresrrr').val(ttc.toFixed(3));
            $('#lot' + i + ' #lots_ttcnet').val(ttcnet.toFixed(3));
        }
        if (op != 0 && op === '4') {
            var ttcnet = parseFloat($('#lot' + i + ' #lots_ttcnet').val());
            if (tva)
                var ttc = ttcnet / (1 + (tva / 100));
            else
                var ttc = ttcnet;
            if (rrr)
                var htavantr = ttc * (1 + (rrr / 100));
            else
                var htavantr = ttc;
            $('#lot' + i + ' #lots_totalapresrrr').val(ttc.toFixed(3));
            $('#lot' + i + ' #lots_totalht').val(htavantr.toFixed(3));
        }
    }
    $scope.AfficheLot = function (i) {
        $('#lot' + i + ' #lots_id_marche').val($('#idmarche').val());
        $('#lot' + i + ' #lots_id_marche').addClass('disabledbutton');
        $('#lot' + i + ' #lots_id_frs_chosen').attr('style', 'width: 200px;');
        $('#lot' + i + ' #lots_id_tva_chosen').attr('style', 'width: 120px;');
        $scope.param = {
            'idmarche': $('#idmarche').val(),
            'numerolot': i
        }

        $http({
            url: domaineapp + 'marchee.php/lots/Affichelots',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                $('#lot' + i + ' #lots_objet').val(data[data.length - 1].objet);
                $('#lot' + i + ' #lots_id_frs').val(data[data.length - 1].id_frs);
                $('#lot' + i + ' #lots_totalht').val(data[data.length - 1].totalht);
                $('#lot' + i + ' #lots_rrr').val(data[data.length - 1].rrr);
                $('#lot' + i + ' #lots_totalapresrrr').val(data[data.length - 1].totalapresrrr);
                $('#lot' + i + ' #lots_ttcnet').val(data[data.length - 1].ttcnet);
                $('#lot' + i + ' #lots_id_tva').val(data[data.length - 1].id_tva);
                $('#lot' + i + ' #lots_id_frs').trigger("chosen:updated");
                $('#lot' + i + ' #lots_id_tva').trigger("chosen:updated");
                $('#lot' + i + ' #lots_id_tva_chosen').attr('style', 'width: 100px;');
            } else {
                $('#lot' + i + ' #lots_rrr').val("");
                $('#lot' + i + ' #lots_ttcnet').val("");
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AjouterLot = function (i) {
        $scope.param = {
            'nordre': $('#lot' + i + ' #lots_nordre').val(),
            'idmarche': $('#idmarche').val(),
            'objet': $('#lot' + i + ' #lots_objet').val(),
            'id_frs': $('#lot' + i + ' #lots_id_frs').val(),
            'totalht': $('#lot' + i + ' #lots_totalht').val(),
            'rrr': $('#lot' + i + ' #lots_rrr').val(),
            'totalapresrrr': $('#lot' + i + ' #lots_totalapresrrr').val(),
            'ttcnet': $('#lot' + i + ' #lots_ttcnet').val(),
            'id_tva': $('#lot' + i + ' #lots_id_tva').val(),
        }

        $http({
            url: domaineapp + 'marchee.php/lots/Savelots',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#lot' + i + ' #lots_objet').val(data[data.length - 1].objet);
            $('#lot' + i + ' #lots_id_frs').val(data[data.length - 1].id_frs);
            $('#lot' + i + ' #lots_totalht').val(data[data.length - 1].totalht);
            $('#lot' + i + ' #lots_rrr').val(data[data.length - 1].rrr);
            $('#lot' + i + ' #lots_totalapresrrr').val(data[data.length - 1].totalapresrrr);
            $('#lot' + i + ' #lots_ttcnet').val(data[data.length - 1].ttcnet);
            $('#lot' + i + ' #lots_id_tva').val(data[data.length - 1].id_tva);
            $('#lot' + i + ' #lots_id_tva').trigger("chosen:updated");
            $('#lot' + i + ' #lots_id_tva_chosen').attr('style', 'width: 100px;');
            bootbox.dialog({
                message: 'Mise à jour du lot ' + i + " Effectuée avec succés !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $("#marches_id_frs")
            .change(function () {
                if ($("#marches_id_frs").val() != "") {
                    $("#marches_nbrebinificaire").addClass('disabledbutton');
                    $('#marches_nbrebinificaire').val('1');
                    $("#marches_nbrelot").addClass('disabledbutton');
                } else {
                    $('#marches_nbrebinificaire').val("");
                    $("#marches_nbrebinificaire").removeClass('disabledbutton');
                    $("#marches_nbrelot").removeClass('disabledbutton');
                }
            })
            .trigger("change");
    //______________________________________________________________________________Ajouter Fournisseur
    $scope.AjouterFrs = function () {
        $scope.param = {
            'matricule': $('#mf').val(),
            'rs': $('#rs').val(),
            'nom': $('#nom').val(),
            'prenom': $('#prenom').val()
        }

        $http({
            url: domaineapp + 'marchee.php/fournisseur/Savefrs',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            var frs = data.split(",");
            $('#marches_id_frs').append("<option value='" + frs[0] + "'>" + frs[1] + "</option>");
            $('#marches_id_frs').val(frs[0]);
            $('#marches_id_frs').trigger("chosen:updated");
            ///lots_id_frs
            $('#lots_id_frs').append("<option value='" + frs[0] + "'>" + frs[1] + "</option>");
            $('#lots_id_frs').trigger("chosen:updated");
            bootbox.dialog({
                message: 'Ajout fiche fournisseur Effectuée avec succés !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
});
//______________________________________________________________________________Sous détail de prix
app.controller('CtrlSousdetail', function ($scope, $http) {
    $scope.maxumum = 0;
    $scope.ht_edit = 0;
    $scope.ttc_edit = 0;
    $scope.sousdetails = [];
    $scope.sousdetaillignecontrat = [];
    $scope.iddetail = "";
    $scope.InialiserChamps = function () {

        $('#sousdetailprix_id_unite_chosen').attr('style', 'width: 120px;');
        $('#sousdetailprix_nordre').val($scope.sousdetails.length + 1);
    }
    $scope.CalculerTotal = function () {
        if ($('#sousdetailprix_quetiteant').val() != "" && $('#sousdetailprix_prixunitaire').val() != "") {
            var totalht = parseFloat($('#sousdetailprix_quetiteant').val()) * parseFloat($('#sousdetailprix_prixunitaire').val());
            $('#sousdetailprix_prixthtva').val(totalht.toFixed(3));
        } else {
            $('#sousdetailprix_prixthtva').val('');
        }
    }
    $scope.InialiserTableau = function () {
        var comArr = eval($scope.sousdetails);
        var max = 0;
        if (comArr.length > 0)
            max = comArr[0].nordre;
        for (var i = 0; i < comArr.length - 1; i++) {
            for (var j = i + 1; j < comArr.length; j++) {
                //alert(parseFloat(comArr[j].nordre) + '>' + max);
                if (parseFloat(comArr[j].nordre) > max)
                    max = comArr[j].nordre;
            }
        }
        if (max === 0)
            max = 1;
        else
            max = parseFloat(max) + 0.1;
        $scope.maxumum = max;
        $('#sousdetailprix_nordre').val(max.toFixed(2));
        $('#sousdetailprix_designation').val("");
        $('#sousdetailprix_id_unite').val("");
        $('#sousdetailprix_id_unite').trigger("chosen:updated");
        $('#sousdetailprix_quetiteant').val("");
        $('#sousdetailprix_prixunitaire').val("");
        $('#sousdetailprix_prixthtva').val("");
    }
    $scope.VerifierLigne = function () {
        if ($('#sousdetailprix_nordre').val() != '' && $('#sousdetailprix_designation').val() != '' && $('#sousdetailprix_id_unite').val() != '' && $('#sousdetailprix_id_unite').val() != 0 && $('#sousdetailprix_id_unite').val() != null && $('#sousdetailprix_quetiteant').val() != '' && $('#sousdetailprix_prixunitaire').val() != '' && $('#sousdetailprix_prixthtva').val() != '')
            return true;
        else
            false;
    }
    $scope.AjouterSousdetailPrix = function () {
        if ($scope.VerifierLigne()) {
            var tauxtva = parseFloat($('#detail_tva').val().replace("%", ""));
            lignehtva = 0;
            if ($('#sousdetailprix_prixthtva').val() != "")
                lignehtva = $('#sousdetailprix_prixthtva').val();
            var lignettc = parseFloat(parseFloat(lignehtva) * (1 + (tauxtva / 100))).toFixed(3);
            var detailttc = 0;
            if ($('#detail_ttcnet').val() !== "")
                detailttc = parseFloat($('#detail_ttcnet').val()).toFixed(3);
            //            alert($scope.ttc_edit);
            var ttcnet = parseFloat(parseFloat($('#lots_ttcnet').val()).toFixed(3) - parseFloat((parseFloat(detailttc) + parseFloat(lignettc))).toFixed(3) + parseFloat($scope.ttc_edit)).toFixed(3);
            //        alert(parseFloat($('#lots_ttcnet').val()).toFixed(3) + ' - (' + detailttc + '+' + lignettc + ')');
            //            alert(ttcnet);
            if (ttcnet >= 0) {
                if ($('#sousdetailprix_id_unite').val() === "" && $('#sousdetailprix_prixthtva').val() === "") {
                    $scope.maxumum = parseInt($scope.maxumum) + 1;
                } else
                    $scope.maxumum = parseFloat($('#sousdetailprix_nordre').val()).toFixed(2);
                if ($scope.sousdetails.length <= 0)
                    $scope.maxumum = 1;
                var conteur = 0;
                var comArr = eval($scope.sousdetails);
                for (var i = 0; i < comArr.length; i++) {
                    //alert(comArr[i].nordre + ' === ' + $('#sousdetailprix_nordre').val());
                    var def = parseFloat(comArr[i].nordre) - parseFloat($('#sousdetailprix_nordre').val());
                    if (def === 0) {
                        comArr[i].nordre = $('#sousdetailprix_nordre').val();
                        comArr[i].designation = $('#sousdetailprix_designation').val();
                        comArr[i].idunite = $('#sousdetailprix_id_unite').val();
                        comArr[i].unite = $('#sousdetailprix_id_unite option:selected').text();
                        comArr[i].qte = $('#sousdetailprix_quetiteant').val();
                        comArr[i].puht = $('#sousdetailprix_prixunitaire').val();
                        comArr[i].totalht = $('#sousdetailprix_prixthtva').val();
                        conteur = 1;
                        break;
                    }
                }

                if (conteur == 0) {
                    $scope.sousdetails.push({
                        'nordre': parseFloat($scope.maxumum).toFixed(2),
                        'designation': $('#sousdetailprix_designation').val(),
                        'idunite': $('#sousdetailprix_id_unite').val(),
                        'unite': $('#sousdetailprix_id_unite option:selected').text(),
                        'qte': $('#sousdetailprix_quetiteant').val(),
                        'puht': $('#sousdetailprix_prixunitaire').val(),
                        'totalht': $('#sousdetailprix_prixthtva').val()
                    });
                }
                $scope.ht_edit = 0;
                $scope.ttc_edit = 0;
                $scope.InialiserTableau();
                $scope.CalculerDetailPrix();
            } else {
                bootbox.dialog({
                    message: 'Vous avez dépasser le montant total TTC !<br> Veuillez vérifiez la quantité et/ou le prix unitaire HTVA.',
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
                message: "Veuillez remplir tout les champs et/ou choisir l'unité.",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.AjouterSousdetailPrix_1 = function () {
        var tauxtva = parseFloat($('#detail_tva').val().replace("%", ""));
        lignehtva = 0;
        if ($('#sousdetailprix_prixthtva').val() != "")
            lignehtva = $('#sousdetailprix_prixthtva').val();
        var lignettc = parseFloat(lignehtva) * (1 + (tauxtva / 100));
        var detailttc = 0;
        if ($('#detail_ttcnet').val() !== "")
            detailttc = $('#detail_ttcnet').val();
        var ttcnet = parseFloat($('#lots_ttcnet').val()).toFixed(3) - parseFloat((parseFloat(detailttc) + lignettc)).toFixed(3);
        // alert(parseFloat($('#lots_ttcnet').val()).toFixed(3) + ' - (' + detailttc + '+' + lignettc + ')');

        if ($('#sousdetailprix_id_unite').val() === "" && $('#sousdetailprix_prixthtva').val() === "") {
            $scope.maxumum = parseInt($scope.maxumum) + 1;
        } else
            $scope.maxumum = parseFloat($('#sousdetailprix_nordre').val()).toFixed(2);
        if ($scope.sousdetails.length <= 0)
            $scope.maxumum = 1;
        var conteur = 0;
        var comArr = eval($scope.sousdetails);
        for (var i = 0; i < comArr.length; i++) {
            //alert(comArr[i].nordre + ' === ' + $('#sousdetailprix_nordre').val());
            var def = parseFloat(comArr[i].nordre) - parseFloat($('#sousdetailprix_nordre').val());
            if (def === 0) {
                comArr[i].nordre = $('#sousdetailprix_nordre').val();
                comArr[i].designation = $('#sousdetailprix_designation').val();
                comArr[i].idunite = $('#sousdetailprix_id_unite').val();
                comArr[i].unite = $('#sousdetailprix_id_unite option:selected').text();
                comArr[i].qte = $('#sousdetailprix_quetiteant').val();
                comArr[i].puht = $('#sousdetailprix_prixunitaire').val();
                comArr[i].totalht = $('#sousdetailprix_prixthtva').val();
                conteur = 1;
                break;
            }
        }

        if (conteur == 0) {
            $scope.sousdetails.push({
                'nordre': parseFloat($scope.maxumum).toFixed(2),
                'designation': $('#sousdetailprix_designation').val(),
                'idunite': $('#sousdetailprix_id_unite').val(),
                'unite': $('#sousdetailprix_id_unite option:selected').text(),
                'qte': $('#sousdetailprix_quetiteant').val(),
                'puht': $('#sousdetailprix_prixunitaire').val(),
                'totalht': $('#sousdetailprix_prixthtva').val(),
                'typeavenant': 'avenant',
                'idsousdetail': ''
            });
        }

        $scope.InialiserTableau();
        $scope.CalculerDetailPrix();
    }
    $scope.CalculerDetailPrix = function () {

        var totalht = 0;
        var totalapresrrr = 0;
        var rrr = parseFloat($('#detail_rrr').val());
        var tauxtva = parseFloat($('#detail_tva').val().replace("%", ""));
        var ttcnet = 0;
        for (i = 0; i < $scope.sousdetails.length; i++)
            if ($scope.sousdetails[i].totalht)
                totalht += parseFloat($scope.sousdetails[i].totalht);
        $('#detail_totalhtva').val(totalht.toFixed(3));
        // totalapresrrr = totalht * (1 - (rrr / 100));
        totalapresrrr = totalht * (1 - (rrr / 100));
        $('#detail_totalaprrr').val(totalapresrrr.toFixed(3));
        ttcnet = totalht * (1 + (tauxtva / 100));
        $('#detail_ttcnet').val(ttcnet.toFixed(3));
        var restehtax = parseFloat($('#lots_totalapresrrr').val());
        var restettc = parseFloat($('#lots_ttcnet').val());
        //alert(restettc + '-' + ttcnet);
        restettc = restettc - ttcnet;
        restehtax = restettc / (1 + (tauxtva / 100));
        $('#detail_resteTtcnet').val(Math.abs(restettc.toFixed(3)));
        $('#detail_resteHtax').val(Math.abs(restehtax.toFixed(3)));
    }
    $scope.ValiderSousDetail = function (id, idtype) {
        $scope.param = {
            'sousdetail': $scope.sousdetails,
            'mntht': $('#detail_totalhtva').val(),
            'rrr': $('#detail_rrr').val(),
            'mntapresrrr': $('#detail_totalaprrr').val(),
            'tauxtva': $('#detail_tva').val().replace("%", ""),
            'idtva': $('#detail_id_tva').val(),
            'ttcnet': $('#detail_ttcnet').val(),
            'idlot': id,
            'idtype': idtype
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Savesousdetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.AfficheSousDetailPrix(id);
            $scope.AfficheDetailPrix(id);
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
            alert(response);
        });
    }
    $scope.AfficheSousDetailPrix = function (id) {
        $scope.iddetail = id;
        $scope.param = {
            'idlot': id
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Affichesousdetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.sousdetails = data;
            $scope.InialiserTableau();
            $scope.CalculerDetailPrix();
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheDetailPrix = function (id) {
        $scope.iddetail = id;
        $scope.param = {
            'idlot': id
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Affichedetailprix',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                detail = data[0];
                $('#detail_totalhtva').val(detail.htva);
                $('#detail_rrr').val(detail.rrr);
                $('#detail_totalaprrr').val(detail.totalapresremise);
                $('#detail_tva').val(detail.libelle);
                $('#detail_id_tva').val(detail.idtva);
                $('#detail_ttcnet').val(detail.totalgeneral);
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.UpdateSousDetail = function (nordre) {
        var comArr = eval($scope.sousdetails);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].nordre === nordre) {
                $('#sousdetailprix_nordre').val(comArr[i].nordre);
                $('#sousdetailprix_designation').val(comArr[i].designation);
                $('#sousdetailprix_id_unite').val(comArr[i].idunite);
                //                comArr[i].unite = $$('#sousdetailprix_id_unite option:selected').text();
                $('#sousdetailprix_quetiteant').val(comArr[i].qte);
                $('#sousdetailprix_prixunitaire').val(comArr[i].puht);
                $('#sousdetailprix_prixthtva').val(comArr[i].totalht);
                $('#sousdetailprix_id_unite').trigger("chosen:updated");
                $scope.ht_edit = parseFloat(comArr[i].totalht).toFixed(3);
                $scope.ttc_edit = parseFloat(parseFloat(comArr[i].totalht) * (1 + parseFloat($('#detail_tva').val().replace("%", "")) / 100));
                //                montant_ht = montant_ht + parseFloat($('#detail_resteHtax').val());
                //                var reste_ttc = montant_ttc + parseFloat($('#detail_resteTtcnet').val());
                //                montant_ttc = parseFloat($('#detail_resteTtcnet').val()) - montant_ttc;
                //                
                //                $('#detail_ttcnet').val(montant_ttc);
                //                $('#detail_resteTtcnet').val(reste_ttc);
                //                $('#detail_resteHtax').val(parseFloat(montant_ht).toFixed(3));

                break;
            }
        }
    }
    $scope.DeletesousDetail = function (nordre) {
        var conteur = -1;
        var comArr = eval($scope.sousdetails);
        for (var i = 0; i < comArr.length; i++) {
            //alert(comArr[i].nordre + ' === ' + nordre);
            var def = parseFloat(comArr[i].nordre) - parseFloat(nordre);
            if (def === 0) {
                conteur = i;
                break;
            }
        }
        if (conteur != -1) {
            if ($scope.sousdetails[conteur].idsousdetail)
                $scope.DeleteParBase(parseFloat($scope.sousdetails[conteur].idsousdetail));
        }
        $scope.sousdetails.splice(conteur, 1);
        $scope.CalculerDetailPrix();
    }
    $scope.DeleteParBase = function (idsousdetail) {
        $scope.param = {
            'idsousdetail': idsousdetail
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Deletesousdetail',
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
    $scope.ValiderVarite = function (idsousdetail) {
        $scope.param = {
            'idsousdetail': idsousdetail,
            'qte': $('#qte' + idsousdetail).val()
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Misajourqte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: 'Mise à jour effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            $scope.AfficheDetailPrix($scope.iddetail);
            $scope.AfficheSousDetailPrix($scope.iddetail);
        }, function myError(response) {
            alert(response);
        });
    }
});
app.controller('CtrlContrat', function ($scope, $http) {
    $scope.designation = {
        text: ''
    };
    $scope.code = {
        text: ''
    };
    $scope.fournisseur = {
        text: ''
    };
    $scope.reffournisseur = {
        text: ''
    };
    $scope.fournisseur1 = {
        text: ''
    };
    $scope.reffournisseur1 = {
        text: ''
    };
    $scope.tvalistes = [];
    $scope.listeunites = [];
    //     $scope.fodeclistes = [];
    $scope.alert_bdcp = "";
    $scope.detailscontratss = [];
    $scope.InialiserCombo = function () {
        $('select').attr('style', 'width:100%');
        // $('select').trigger("chosen:updated");
        //        $('.chosen-select').trigger("chosen:updated");
        $('.chosen-container').trigger("chosen:updated");
    }



    $scope.ValiderContratAchat = function (iddoc) {
        var mnt_total = parseFloat($('#contratachat_montantcontrat').val());
        var nb_lignes = 1;
        var designation = '';
        var id_typepiece = '';
        var type_piece = '';
        var taux_pourcentage = '';
        var valeur_pourcetage = '';
        var id_ligne_achat = $('#id_lignedocachat').val();
        var total_pourcentage = 0;
        $('#liste_ligne tbody tr').each(function () {
            nb_lignes++;
            var i_ligne = $(this).attr('index_ligne');
            designation = designation + $('#designation_' + i_ligne).val() + ',,';
            id_typepiece = id_typepiece + $('#id_typepiece_' + i_ligne).val() + ',,';
            type_piece = type_piece + $('#typepiece_' + i_ligne).val() + ',,';
            if ($.isNumeric($('#valeur_pourcetage_' + i_ligne).val())) {
                valeur_pourcetage = valeur_pourcetage + $('#valeur_pourcetage_' + i_ligne).val() + ',,';
                taux_pourcentage = taux_pourcentage + $('#taux_pourcentage_' + i_ligne).val() + ',,';
                if (valeur_pourcetage == 'undefined')
                    valeur_pourcetage = 0;
                if ($('#valeur_pourcetage_' + i_ligne).val() != 'undefined' && $('#valeur_pourcetage_' + i_ligne).val() != '')
                    total_pourcentage = parseFloat(total_pourcentage + parseFloat($('#valeur_pourcetage_' + i_ligne).val()));
                i_ligne++;
            }
        });
        if (total_pourcentage != 100 && total_pourcentage != 0) {
            bootbox.dialog({
                message: 'Il Faut Vérifier les taux de pourcentages pour qu\'il soit à 100% !!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        //        alert(total_pourcentage+'fd');
        if (total_pourcentage == 100 || total_pourcentage == 0) {
            if ($scope.lignedocsbcicontrat.length > 0) {
                if ($('#fournisseur_id').val() != "" && $('#contratachat_montantcontrat').val()) {
                    $scope.document = {
                        "id_frs": $('#fournisseur_id').val(),
                        "type": $('#contratachat_type').val(),
                        "iddocachat": $('#id_docparent').val(),
                        "datesigntaure": $('#contratachat_datesigntaure').val(),
                        "datefin": $('#contratachat_datefin').val(),
                        "cautionement": $('#contratachat_cautionement').val(),
                        "retenuegaraentie": $('#contratachat_retenuegaraentie').val(),
                        "avance": $('#contratachat_avance').val(),
                        "penalite": $('#contratachat_penalite').val(),
                        "maxpinalite": $('#contratachat_maxpinalite').val(),
                        "numero": $('#contratachat_numero').val(),
                        "mnttotal": $('#contratachat_montantcontrat').val(),
                        "reference": $('#contratachat_reference').val(),
                        "typepaiement": $('#contratachat_typepaiment').val(),
                        //                    "mnt_plafon": $('#contratachat_montantplanfonne').val(),
                        "listearticle": $scope.lignedocsbcicontrat,
                        'iddoc': iddoc,
                        'id_ligne_achat': id_ligne_achat,
                        'designation': designation,
                        'id_typepiece': id_typepiece,
                        'type_piece': type_piece,
                        'valeur_pourcetage': valeur_pourcetage,
                    }
                    $http({
                        url: domaineapp + '/achats.php/contratachat/Savecontrat',
                        method: "POST",
                        data: $scope.document,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        data = response.data;
                        bootbox.dialog({
                            message: "Contrat Provisoire est mis a jour avec succès !!!!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        //                        window.location.reload();
                    }, function myError(response) {
                        alert(response);
                    });
                } else
                    bootbox.dialog({
                        message: 'Il faut sélectionner un fournisseur ... !!!',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
            } else {
                bootbox.dialog({
                    message: "Il faut ajouter au moin un ligne dans le contrat !",
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

    $scope.ValiderContratAchatAvenat = function (iddoc, id_docachat) {

        var id_lignedocachat = $('#id_lignedocachat').val();
        var mnt_total = parseFloat($('#contratachat_montantcontrat').val());
        var mnt_avenant = $('#montantavenant').val();
        var nb_lignes = 1;
        var designation = '';
        var id_typepiece = '';
        var type_piece = '';
        var taux_pourcentage = '';
        var valeur_pourcetage = '';
        var id_ligne_achat = $('#id_lignedocachat').val();
        var total_pourcentage = 0;
        $('#liste_ligne tbody tr').each(function () {
            nb_lignes++;
            var i_ligne = $(this).attr('index_ligne');
            designation = designation + $('#designation_' + i_ligne).val() + ',,';
            id_typepiece = id_typepiece + $('#id_typepiece_' + i_ligne).val() + ',,';
            type_piece = type_piece + $('#typepiece_' + i_ligne).val() + ',,';
            if ($.isNumeric($('#valeur_pourcetage_' + i_ligne).val())) {
                valeur_pourcetage = valeur_pourcetage + $('#valeur_pourcetage_' + i_ligne).val() + ',,';
                taux_pourcentage = taux_pourcentage + $('#taux_pourcentage_' + i_ligne).val() + ',,';
                if (valeur_pourcetage == 'undefined')
                    valeur_pourcetage = 0;
                if ($('#valeur_pourcetage_' + i_ligne).val() != 'undefined' && $('#valeur_pourcetage_' + i_ligne).val() != '')
                    total_pourcentage = parseFloat(total_pourcentage + parseFloat($('#valeur_pourcetage_' + i_ligne).val()));
                i_ligne++;
            }
        });
        if (total_pourcentage != 100 && total_pourcentage != 0) {
            bootbox.dialog({
                message: 'Il Faut Vérifier les taux de pourcentages pour qu\'il soit à 100% !!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        if (total_pourcentage == 100 || total_pourcentage == 0) {
            if ($scope.lignedocsbcicontrat.length > 0) {
                if ($('#fournisseur_id').val() != "" && $('#contratachat_montantcontrat').val()) {
                    $scope.document = {
                        "id_frs": $('#fournisseur_id').val(),
                        "type": $('#contratachat_type').val(),
                        "iddocachat": id_docachat,
                        "datesigntaure": $('#contratachat_datesigntaure').val(),
                        "numero": $('#contratachat_numero').val(),
                        "mnttotal": $('#montant_contrat').val(),
                        "reference": $('#contratachat_reference').val(),
                        "listearticle": $scope.lignedocsbcicontrat,
                        'iddoc': iddoc,
                        'id_ligne_achat': id_ligne_achat,
                        'designation': designation,
                        'id_typepiece': id_typepiece,
                        'type_piece': type_piece,
                        'valeur_pourcetage': valeur_pourcetage,
                        'mnt_avenant': mnt_avenant,
                        'id_lignedocachat': id_lignedocachat,
                    }
                    $http({
                        url: domaineapp + '/achats.php/contratachat/SavecontratAvenant',
                        method: "POST",
                        data: $scope.document,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        data = response.data;
                        bootbox.dialog({
                            message: "Avenat qui touche le détail de prix du Contrat est crée avec succès !!!!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        //                        window.location.reload();
                    }, function myError(response) {
                        alert(response);
                    });
                } else
                    bootbox.dialog({
                        message: 'Il faut sélectionner un fournisseur ... !!!',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
            } else {
                bootbox.dialog({
                    message: "Il faut ajouter au moin un ligne dans le contrat !",
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
    $scope.AddDetailligneContrat = function () {
        var index_ligne = 0;
        var count_ligne = -1;
        var id_ligne_achat = $('#id_lignedocachat').val()
        $scope.param = {
            "id": id_ligne_achat
        }
        $('#liste_ligne tbody tr').each(function () {
            count_ligne++;
        });
        console.log('count_lign' + count_ligne);
        $.ajax({
            url: domaineapp + '/achats.php/contratachat/addLigne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log('data=' + data);
            if (count_ligne > 0) {
                console.log('datalll' + index_ligne);
                $('#liste_ligne > tbody > tr').eq(index_ligne).after(data);
                index_ligne++;
            } else {
                $('#liste_ligne tbody').append(data);
                index_ligne = 0;
            }

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.Afficherlignebci = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/AfficheligneListeboninternec',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsbcicontrat = data;
            var comArr = eval($scope.lignedocsbcicontrat);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.UpdateDetailBci = function (nordre) {
        var comArr = eval($scope.lignedocsbcicontrat);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle').val(comArr[i].codearticle);
                $('#designation').val(comArr[i].designation);
                $('#unite').val(comArr[i].idunite);
                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);
                $('#totalhax').val(comArr[i].totalhax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#tva').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttc').val(comArr[i].totalttc);
                $('#projet').val(comArr[i].idprojet);
                //                 $('#projet').val(comArr[i].idprojet),

                $('#observation').val(comArr[i].observation);
                break;
                $('#projetsid').val(lignedoc.projet);
            }
        }
    }

    $scope.TesterlexistanceNumeroContrat = function () {
        var code = $('#contratachat_numero').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'achats.php/contratachat/testexistancenumerocontrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data && data != 0) {
                bootbox.dialog({
                    message: "Cette Contrat existe déjà !!!",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                //                document.location.href = "edit?id=" + data['id'];

            }


        }, function myError(response) {
            alert(response);
        });
    }
    $("#contratachat_numero")
            .change(function () {
                if ($("#contratachat_numero").val() != "") {

                    if ($("#id_docparent").val() == '')
                        $scope.TesterlexistanceNumeroContrat();
                }

            })
            .trigger("change");
    //     $scope.AfficherlignebciAvenant = function (iddoc) {
    //        $scope.param = {
    //            "id": iddoc
    //        }
    //        $http({
    //            url: domaineapp + '/achats.php/contratachat/AfficheligneListeboninternecAvenant',
    //            method: "POST",
    //            data: $scope.param,
    //            headers: {
    //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //            }
    //        }).then(function mySucces(response) {
    //            data = response.data;
    //            $scope.lignedocsbcicontrat = data;
    //            var comArr = eval($scope.lignedocsbcicontrat);
    //            var nordre = 1;
    //            for (var i = 0; i < comArr.length; i++) {
    //                comArr[i].norgdre = nordre;
    //                nordre++;
    //            }
    //
    //        }, function myError(response) {
    //            alert("Erreur d'ajout");
    //        });
    //    }
    $scope.AfficherlignebciAvenant = function (iddoc, idcontrat) {
        $scope.param = {
            "id": iddoc,
            "idcontrat": idcontrat
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/AfficheligneListeboninternecAvenant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsbcicontrat = data;
            var comArr = eval($scope.lignedocsbcicontrat);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AffichageModalitepaiment = function (iddoc, idcontrat) {
        $scope.param = {
            "id": iddoc,
            "idcontrat": idcontrat
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/AffichelignelignecontratAvenant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignelignecontratAvenant = data;
            var comArr = eval($scope.lignelignecontratAvenant);
            var nordre = 1;
            for (var i = 0; i < comArr.length; i++) {
                comArr[i].norgdre = nordre;
                nordre++;
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheLignedocumentContrat = function (iddoc) {

        if (iddoc != '') {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'achats.php/contratachat/AfficheligneContratForEdite',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.lignedocsbcicontrat = data;
                //                $('#norodre').val($scope.detailscontratss.length + 1);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
            //            $scope.calculerMontantTotalBCIContrat();
        }

    }

    $scope.RechercheArticleByCodeAndDesignationContrat = function () {
        //        if ($scope.designation.text != '') {
        $scope.param = {
            'codearticle': $scope.code.text,
            'designation': $scope.designation.text
        }
        $http({
            url: domaineapp + 'achats.php/documentachat/Articlebycodeanddesignation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedesignation = data;
            AjoutHtmlAfterDesignation(data, '#codearticle', '#designation');
            $('#ul_compte').focus();
        }, function myError(response) {
            alert(response);
        });
        //        } else {
        //            $scope.code.text = '';
        //            $('#codearticle').val('');
        //        }
    }

    $scope.goToListContrat = function (e) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }

        switch (key) {
            // Down
            case 40:
                if ($('#ul_compte').attr('onkeydown'))
                    $('#ul_compte').focus();
                break;
                //Enter
            case 13:

                break;
        }
    }
    $scope.calculerMontantTotal = function () {
        var total = 0;
        var comArr = eval($scope.lignedocsbcicontrat);
        for (var i = 0; i < comArr.length; i++) {



            //alert('pr' + parseFloat($scope.detailscontratss[i].prixttc));
            if (parseFloat($scope.lignedocsbcicontrat[i].totalttc) != 0) {
                total = parseFloat(parseFloat(total) + parseFloat($scope.lignedocsbcicontrat[i].totalttc));
            }
        }

        var mnt_contrat = parseFloat($('#montant_contrat').val()).toFixed(3);
        $('#mnttotal').val(parseFloat(total).toFixed(3));
        $('#contratachat_montantcontrat').val(parseFloat(total).toFixed(3));
        var aveant = total - mnt_contrat;
        $('#montantavenant').val(parseFloat(aveant).toFixed(3));
    }


    //__________________________________________________________________________Ajouter lignedoc bon de deponse
    $scope.AddDetail = function () {
        console.log('Add detail');
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if ($('#designation').val() != "" && qtedemander > 0) {
            nbligne = $scope.detailscontratss.length + 1;
            nordre = $('#nordre').val();
            var comArr = eval($scope.detailscontratss);
            var existe = 0;
            var prixht = parseFloat(parseFloat($("#qte").val()) * parseFloat($("#puht").val()));
            $('#totalhax').val(parseFloat(prixht).toFixed(3));
            var taux_fodec = $("#taufodec option:selected").text();
            taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            //            alert('tau='+taux_fodec);


            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            //            alert(taux_fodec + 'fodec=' + fodec);
            $('#fodec').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
            var tva = $("#tva option:selected").text();
            tva = tva.substring(0, tva.length - 1);
            //            alert(tva);
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttc').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.detailscontratss[i].norgdre = $('#nordre').val();
                    $scope.detailscontratss[i].codearticle = $('#codearticle').val();
                    $scope.detailscontratss[i].designation = $('#designation').val();
                    $scope.detailscontratss[i].idunite = $('#unite').val();
                    $scope.detailscontratss[i].unite = $("#unite option:selected").text();
                    $scope.detailscontratss[i].qte = $('#qte').val();
                    $scope.detailscontratss[i].puht = $('#puht').val();
                    $scope.detailscontratss[i].totalhax = $('#totalhax').val();
                    $scope.detailscontratss[i].idtaufodec = $('#taufodec').val();
                    $scope.detailscontratss[i].taufodec = $("#taufodec option:selected").text();
                    $scope.detailscontratss[i].fodec = $('#fodec').val();
                    $scope.detailscontratss[i].totalhtva = $('#totalhtva').val();
                    $scope.detailscontratss[i].idtva = $('#tva').val();
                    $scope.detailscontratss[i].tva = $("#tva option:selected").text();
                    $scope.detailscontratss[i].totalttc = $('#totalttc').val();
                    $scope.detailscontratss[i].prixttc = prixttc;
                    $scope.detailscontratss[i].idprojet = $('#projet').val();
                    $scope.detailscontratss[i].projet = $("#projet option:selected").text();
                    $scope.detailscontratss[i].observation = $('#observation').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.detailscontratss.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'codearticle': $('#codearticle').val(),
                    'unite': $("#unite option:selected").text(),
                    'idunite': $('#unite').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'totalhax': $('#totalhax').val(),
                    'taufodec': $("#taufodec option:selected").text(),
                    'idtaufodec': $('#taufodec').val(),
                    'fodec': $("#fodec").val(),
                    'totalhtva': $('#totalhtva').val(),
                    'tva': $("#tva option:selected").text(),
                    'idtva': $('#tva').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttc').val(),
                    'projet': $("#projet option:selected").text(),
                    'idprojet': $('#projet').val(),
                    'observation': $('#observation').val()
                });
            }

            $scope.calculerMontantTotal();
            $scope.ViderChampsContrat();
        } else {
            var message = '';
            if ($('#designation').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.AddDetailContrat = function () {
        console.log('Add detail');
        if ($("#qte").val() != '')
            qtedemander = parseFloat($("#qte").val());
        else
            qtedemander = 0;
        if (qtedemander == 0)
            qtedemander = 1;
        if ($('#designation').val() != "" && qtedemander > 0) {
            nbligne = $scope.lignedocsbcicontrat.length + 1;
            nordre = $('#nordre').val();
            var comArr = eval($scope.lignedocsbcicontrat);
            var existe = 0;
            var prixht = parseFloat(parseFloat(qtedemander) * parseFloat($("#puht").val()));
            $('#totalhax').val(parseFloat(prixht).toFixed(3));
            var taux_fodec = 0;
            if ($("#taufodec option:selected").text() != '') {
                taux_fodec = $("#taufodec option:selected").text().trim();
                taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
            }
            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
            //            alert(taux_fodec + 'fodec=' + fodec);
            $('#fodec').val(parseFloat(fodec).toFixed(3));
            var prixthtava = prixht + fodec;
            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
            var tva = 0;
            if ($("#tva option:selected").text() != '') {
                txt_tva = $("#tva option:selected").text().trim();
                tva = txt_tva.substring(0, txt_tva.length - 1);
            }
            //            alert(tva);
            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
            $('#totalttc').val(parseFloat(prixttc).toFixed(3));
            for (var i = 0; i < comArr.length; i++) {
                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                    existe = 1;
                    $scope.lignedocsbcicontrat[i].norgdre = $('#nordre').val();
                    $scope.lignedocsbcicontrat[i].codearticle = $('#codearticle').val();
                    $scope.lignedocsbcicontrat[i].designation = $('#designation').val();
                    $scope.lignedocsbcicontrat[i].idunite = $('#unite').val();
                    $scope.lignedocsbcicontrat[i].unite = $("#unite option:selected").text();
                    $scope.lignedocsbcicontrat[i].qte = $('#qte').val();
                    $scope.lignedocsbcicontrat[i].puht = $('#puht').val();
                    $scope.lignedocsbcicontrat[i].totalhax = $('#totalhax').val();
                    $scope.lignedocsbcicontrat[i].idtaufodec = $('#taufodec').val();
                    $scope.lignedocsbcicontrat[i].taufodec = $("#taufodec option:selected").text();
                    $scope.lignedocsbcicontrat[i].fodec = $('#fodec').val();
                    $scope.lignedocsbcicontrat[i].totalhtva = $('#totalhtva').val();
                    $scope.lignedocsbcicontrat[i].idtva = $('#tva').val();
                    $scope.lignedocsbcicontrat[i].tva = $("#tva option:selected").text();
                    $scope.lignedocsbcicontrat[i].totalttc = $('#totalttc').val();
                    $scope.lignedocsbcicontrat[i].prixttc = prixttc;
                    $scope.lignedocsbcicontrat[i].idprojet = $('#projet').val();
                    $scope.lignedocsbcicontrat[i].projet = $("#projet option:selected").text();
                    $scope.lignedocsbcicontrat[i].observation = $('#observation').val();
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocsbcicontrat.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'codearticle': $('#codearticle').val(),
                    'unite': $("#unite option:selected").text(),
                    'idunite': $('#unite').val(),
                    'qte': $("#qte").val(),
                    'puht': $('#puht').val(),
                    'totalhax': $('#totalhax').val(),
                    'taufodec': $("#taufodec option:selected").text(),
                    'idtaufodec': $('#taufodec').val(),
                    'fodec': $("#fodec").val(),
                    'totalhtva': $('#totalhtva').val(),
                    'tva': $("#tva option:selected").text(),
                    'idtva': $('#tva').val(),
                    'prixttc': prixttc,
                    'totalttc': $('#totalttc').val(),
                    'projet': $("#projet option:selected").text(),
                    'idprojet': $('#projet').val(),
                    'observation': $('#observation').val(),
                });
            }

            $scope.calculerMontantTotal();
            $scope.ViderChampsContrat();
        } else {
            var message = '';
            if ($('#designation').val() == "")
                message = 'Vérifiez la désignation du travaux';
            if (qtedemander <= 0) {
                if (message != '')
                    message = message + ' et ';
                else
                    message = 'Vérifiez';
                message = message + ' la quantité';
            }

            bootbox.dialog({
                message: message,
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }


    $scope.UpdateDetail = function (nordre) {
        //        console.log('Update detail' + nordre);
        var comArr = eval($scope.detailscontratss);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].norgdre) - parseFloat(nordre));
            if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
                $('#nordre').val(comArr[i].norgdre);
                $('#codearticle').val(comArr[i].codearticle);
                $('#designation').val(comArr[i].designation);
                $('#unite').val(comArr[i].idunite);
                $('#idunite').val(comArr[i].idunite).trigger("chosen:updated");
                $('#qte').val(comArr[i].qte);
                $('#puht').val(comArr[i].puht);
                $('#totalhax').val(comArr[i].totalhax);
                $('#fodec').val(comArr[i].fodec);
                $('#totalhtva').val(comArr[i].totalhtva);
                $('#tva').val(comArr[i].idtva);
                $('#idtva').val(comArr[i].idtva).trigger("chosen:updated");
                $('#taufodec').val(comArr[i].idtaufodec);
                $('#idtaufodec').val(comArr[i].idtaufodec).trigger("chosen:updated");
                $('#totalttc').val(comArr[i].totalttc);
                $('#projet').val(comArr[i].idprojet);
                //                 $('#projet').val(comArr[i].idprojet),

                $('#observation').val(comArr[i].observation);
                break;
                $('#projetsid').val(lignedoc.projet);
            }
        }
    }



    $scope.DeleteLigneContrat = function (id) {
        var index = -1;
        var conteur = 1;
        var comArr = eval($scope.lignedocsbcicontrat);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsbcicontrat.splice(index, 1);
        for (var i = 0; i < comArr.length; i++) {
            $scope.lignedocsbcicontrat[i].norgdre = conteur;
            conteur++;
        }

        $scope.calculerMontantTotal();
    }


    $scope.Initialiserligneconrat = function () {

        var comArr = eval($scope.lignedocsbcicontrat);
        var max = 0;
        console.log('max' + max + 'ff' + comArr.length);
        if (comArr.length > 0)
            max = comArr[comArr.length + 1].nordre;
        for (var i = 0; i < comArr.length - 1; i++) {
            for (var j = i + 1; j < comArr.length; j++) {
                //alert(parseFloat(comArr[j].nordre) + '>' + max);
                if (parseFloat(comArr[j].nordre) > max)
                    max = comArr[j].nordre;
            }
        }
        console.log('ff' + max);
        if (max === 0)
            max = 1;
        else
            max = parseFloat(max) + 0.1;
        console.log('ddd' + max);
        $scope.maxumum = max;
        $('#norodre').val(max.toFixed(2));
    }
    //        $('#sous_detail').attr('style', 'display: block');
    //        $scope.detailscontratss.push({
    //            'norgdre': nbligne,
    //            'designation': $('#designation').val(),
    //            'codearticle': $('#codearticle').val(),
    //            'unite': $("#unite option:selected").text(),
    //            'idunite': $('#unite').val(),
    //            'qte': $("#qte").val(),
    //            'puht': $('#puht').val(),
    //            'totalhax': $('#totalhax').val(),
    //            'taufodec': $("#taufodec option:selected").text(),
    //            'idtaufodec': $('#taufodec').val(),
    //            'fodec': $("#fodec").val(),
    //            'totalhtva': $('#totalhtva').val(),
    //            'tva': $("#tva option:selected").text(),
    //            'idtva': $('#tva').val(),
    //            'prixttc': prixttc,
    //            'totalttc': $('#totalttc').val(),
    //            'projet': $("#projet option:selected").text(),
    //            'idprojet': $('#projet').val(),
    //            'observation': $('#observation').val()
    //        });
    //        console.log('Add detail ligne contrat');
    //        if ($("#qte").val() != '')
    //            qtedemander = parseFloat($("#qte").val());
    //        else
    //            qtedemander = 0;
    //        if ($('#designation').val() != "" && qtedemander > 0) {
    //            nbligne = $scope.lignedocsbcicontrat.length + 1;
    //            nordre = $('#nordre').val();
    //            var comArr = eval($scope.lignedocsbcicontrat);
    //            var existe = 0;
    //            var prixht = parseFloat(parseFloat($("#qte").val()) * parseFloat($("#puht").val()));
    //            $('#totalhax').val(parseFloat(prixht).toFixed(3));
    //            var taux_fodec = $("#taufodec option:selected").text();
    //            taux_fodec = taux_fodec.substring(0, taux_fodec.length - 1);
    ////            alert('tau='+taux_fodec)
    //
    //            var fodec = parseFloat(parseFloat(prixht) * parseFloat(parseFloat(taux_fodec) / 100));
    ////            alert(taux_fodec + 'fodec=' + fodec);
    //            $('#fodec').val(parseFloat(fodec).toFixed(3));
    //            var prixthtava = prixht + fodec;
    //            $('#totalhtva').val(parseFloat(prixthtava).toFixed(3));
    //            var tva = $("#tva option:selected").text();
    //            tva = tva.substring(0, tva.length - 1);
    ////            alert(tva);
    //            var prixttc = parseFloat(parseFloat(prixthtava) * parseFloat(1 + parseFloat(tva) / 100));
    //            $('#totalttc').val(parseFloat(prixttc).toFixed(3));
    //            for (var i = 0; i < comArr.length; i++) {
    //                if (parseFloat(comArr[i].norgdre) - parseFloat(nordre) === 0) {
    //                    existe = 1;
    //                    $scope.lignedocsbcicontrat[i].norgdre = $('#nordre').val();
    //                    $scope.lignedocsbcicontrat[i].codearticle = $('#codearticle').val();
    //                    $scope.lignedocsbcicontrat[i].designation = $('#designation').val();
    //                    $scope.lignedocsbcicontrat[i].idunite = $('#unite').val();
    //                    $scope.lignedocsbcicontrat[i].unite = $("#unite option:selected").text();
    //                    $scope.lignedocsbcicontrat[i].qte = $('#qte').val();
    //                    $scope.lignedocsbcicontrat[i].puht = $('#puht').val();
    //                    $scope.lignedocsbcicontrat[i].totalhax = $('#totalhax').val();
    //
    //                    $scope.lignedocsbcicontrat[i].idtaufodec = $('#taufodec').val();
    //                    $scope.lignedocsbcicontrat[i].taufodec = $("#taufodec option:selected").text();
    //
    //                    $scope.lignedocsbcicontrat[i].fodec = $('#fodec').val();
    //                    $scope.lignedocsbcicontrat[i].totalhtva = $('#totalhtva').val();
    //                    $scope.lignedocsbcicontrat[i].idtva = $('#tva').val();
    //
    //                    $scope.lignedocsbcicontrat[i].tva = $("#tva option:selected").text();
    //                    $scope.lignedocsbcicontrat[i].totalttc = $('#totalttc').val();
    //                    $scope.lignedocsbcicontrat[i].prixttc = prixttc;
    //                    $scope.lignedocsbcicontrat[i].idprojet = $('#projet').val();
    //                    $scope.lignedocsbcicontrat[i].projet = $("#projet option:selected").text();
    //                    $scope.lignedocsbcicontrat[i].observation = $('#observation').val();
    //                    break;
    //                }
    //            }
    //            if (existe == 0) {
    //                $scope.lignedocsbcicontrat.push({
    //                    'norgdre': nbligne,
    //                    'designation': $('#designation').val(),
    //                    'codearticle': $('#codearticle').val(),
    //                    'unite': $("#unite option:selected").text(),
    //                    'idunite': $('#unite').val(),
    //                    'qte': $("#qte").val(),
    //                    'puht': $('#puht').val(),
    //                    'totalhax': $('#totalhax').val(),
    //                    'taufodec': $("#taufodec option:selected").text(),
    //                    'idtaufodec': $('#taufodec').val(),
    //                    'fodec': $("#fodec").val(),
    //                    'totalhtva': $('#totalhtva').val(),
    //                    'tva': $("#tva option:selected").text(),
    //                    'idtva': $('#tva').val(),
    //                    'prixttc': prixttc,
    //                    'totalttc': $('#totalttc').val(),
    //                    'projet': $("#projet option:selected").text(),
    //                    'idprojet': $('#projet').val(),
    //                    'observation': $('#observation').val()
    //                });
    //            }
    //
    //            $scope.calculerMontantTotal();
    //            $scope.ViderChampsContrat();
    //        } else {
    //            var message = '';
    //            if ($('#designation').val() == "")
    //                message = 'Vérifiez la désignation du travaux';
    //            if (qtedemander <= 0) {
    //                if (message != '')
    //                    message = message + ' et ';
    //                else
    //                    message = 'Vérifiez';
    //                message = message + ' la quantité';
    //            }
    //
    //            bootbox.dialog({
    //                message: message,
    //                buttons:
    //                        {
    //                            "button":
    //                                    {
    //                                        "label": "Ok",
    //                                        "className": "btn-sm"
    //                                    }
    //                        }
    //            });
    //        }


    $scope.Viderchamps = function () {
        $('#nordre').val('');
        $('#designation').val('');
        $('#qte').val('');
        $('#tva').val(0);
        $('#tva').trigger("chosen:updated");
        $('#puht').val('');
        $('#desc').val('');
        $('#unite').val('');
        $('#unite').trigger("chosen:updated");
        $('#observation').val('');
    }


    $scope.ViderChampsContrat = function () {
        $('#nordre').val('');
        $('#designation').val('');
        $('#codearticle').val('');
        $('#qte').val('');
        $('#tva').val('');
        $('#projet').val('');
        $("#idprojet").trigger("chosen:updated");
        $('#taufodec').val('');
        $("#idtaufodec").trigger("chosen:updated");
        $('#tva').trigger("chosen:updated");
        $('#taufodec').val('');
        $('#taufodec').trigger("chosen:updated");
        $('#puht').val('');
        $('#totalhax').val('');
        $('#fodec').val('');
        $('#totalhtva').val('');
        $('#totalttc').val('');
        $('#desc').val('');
        $('#unite').val('');
        $('#unite').trigger("chosen:updated");
        $('#observation').val('');
    }


    $scope.ListesTva = function () {
        $http({
            url: domaineapp + '/achats.php/documentachat/Listetva',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.tvalistes = data;
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ListesUnite = function () {
        $http({
            url: domaineapp + '/achats.php/documentachat/ListeUnite',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listeunites = data;
        }, function myError(response) {
            alert("Erreur ....");
        });
    }


    //    $scope.ValiderContratEN = function (iddoc) {
    ////        var mnt_planfond = parseFloat($('#contratachat_montantplanfonne').val());
    //        var mnt_total = parseFloat($('#contratachat_montantcontrat').val());
    ////        alert('mp' + mnt_planfond);
    ////        if (mnt_total > mnt_planfond)
    ////        {
    ////            bootbox.dialog({
    ////                message: 'Il ne faut pas dépasser le montant plafond du contrat ... !!!',
    ////                buttons:
    ////                        {
    ////                            "button":
    ////                                    {
    ////                                        "label": "Ok",
    ////                                        "className": "btn-sm"
    ////                                    }
    ////                        }
    ////            });
    ////        }
    //        var nb_lignes = 1;
    //        var designation = '';
    //        var id_typepiece = '';
    //        var type_piece = '';
    //        var taux_pourcentage = '';
    //        var valeur_pourcetage = '';
    //        var id_ligne_achat = $('#id_lignedocachat').val();
    //        var total_pourcentage = 0;
    //        $('#liste_ligne tbody tr').each(function () {
    ////                debugger;
    //            nb_lignes++;
    //            var i_ligne = $(this).attr('index_ligne');
    //            if ($('#valeur_pourcetage_' + i_ligne).val() == 'undefined')
    //            {
    ////                parseFloat($('#valeur_pourcetage_' + i_ligne).val()) = 0;
    //            }
    //            
    //            designation = designation + $('#designation_' + i_ligne).val() + ',,';
    //            id_typepiece = id_typepiece + $('#id_typepiece_' + i_ligne).val() + ',,';
    //            type_piece = type_piece + $('#typepiece_' + i_ligne).val() + ',,';
    //            if ($('#valeur_pourcetage_' + i_ligne).val() != 'undefined') {
    //                valeur_pourcetage = valeur_pourcetage + $('#valeur_pourcetage_' + i_ligne).val() + ',,';
    //                taux_pourcentage = taux_pourcentage + $('#taux_pourcentage_' + i_ligne).val() + ',,';
    //                if (valeur_pourcetage == 'undefined')
    //                    valeur_pourcetage = 0;
    //                if ($('#valeur_pourcetage_' + i_ligne).val() != 'undefined' && $('#valeur_pourcetage_' + i_ligne).val() != '')
    //                    total_pourcentage = parseFloat(total_pourcentage + parseFloat($('#valeur_pourcetage_' + i_ligne).val()));
    ////                alert('valeur_pourcetage=' + valeur_pourcetage + 'total=' + total_pourcentage);
    ////            alert(i_ligne + 'id_lign' + parseFloat($('#taux_pourcentage_' + i_ligne).val()));
    //                i_ligne++;
    //            }
    //        });
    ////        alert(total_pourcentage + 'rrr');
    ////        if (total_pourcentage != 100)
    ////        {
    ////            bootbox.dialog({
    ////                message: 'Il Faut Vérifier les taux de pourcentages pour qu\'il soit à 100% !!',
    ////                buttons:
    ////                        {
    ////                            "button":
    ////                                    {
    ////                                        "label": "Ok",
    ////                                        "className": "btn-sm"
    ////                                    }
    ////                        }
    ////            });
    ////        }
    ////        if ($scope.lignedocsbcicontrat.length > 0) {
    ////            if ($('#fournisseur_id').val() != "" && $('#contratachat_montantcontrat').val()) {
    ////                $scope.document = {
    ////                    "id_frs": $('#fournisseur_id').val(),
    ////                    "type": $('#contratachat_type').val(),
    ////                    "iddocachat": $('#id_docparent').val(),
    ////                    "datesigntaure": $('#contratachat_datesigntaure').val(),
    ////                    "numero": $('#contratachat_numero').val(),
    ////                    "mnttotal": $('#contratachat_montantcontrat').val(),
    ////                    "reference": $('#contratachat_reference').val(),
    //////                    "mnt_plafon": $('#contratachat_montantplanfonne').val(),
    ////                    "listearticle": $scope.lignedocsbcicontrat,
    ////                    'iddoc': iddoc,
    ////                    'id_ligne_achat': id_ligne_achat,
    ////                    'designation': designation,
    ////                    'id_typepiece': id_typepiece,
    ////                    'type_piece': type_piece,
    ////                    'valeur_pourcetage': valeur_pourcetage,
    ////                }
    ////                $http({
    ////                    url: domaineapp + '/achats.php/contratachat/Savecontrat',
    ////                    method: "POST",
    ////                    data: $scope.document,
    ////                    headers: {
    ////                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    ////                    }
    ////                }).then(function mySucces(response) {
    ////                    data = response.data;
    ////                    bootbox.dialog({
    ////                        message: data,
    ////                        buttons:
    ////                                {
    ////                                    "button":
    ////                                            {
    ////                                                "label": "Ok",
    ////                                                "className": "btn-sm"
    ////                                            }
    ////                                }
    ////                    });
    ////                    window.location.reload();
    ////                }, function myError(response) {
    ////                    alert(response);
    ////                });
    ////            } else
    ////                bootbox.dialog({
    ////                    message: 'Il faut sélectionner un fournisseur ... !!!',
    ////                    buttons:
    ////                            {
    ////                                "button":
    ////                                        {
    ////                                            "label": "Ok",
    ////                                            "className": "btn-sm"
    ////                                        }
    ////                            }
    ////                });
    ////        } else {
    ////            bootbox.dialog({
    ////                message: "Il faut ajouter au moin un ligne dans le contrat !",
    ////                buttons:
    ////                        {
    ////                            "button":
    ////                                    {
    ////                                        "label": "Ok",
    ////                                        "className": "btn-sm"
    ////                                    }
    ////                        }
    ////            });
    ////        }
    //    }

    $scope.AfficheFournisseurContrat = function (iddoc) {

        $scope.param = {
            'iddoc': iddoc
        }
        $http({
            url: domaineapp + '/achats.php/contratachat/Affichefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#fournisseur1').val(data['name']);
            $('#reffournisseur1').val(data['ref']);
            $('#fournisseur_id').val(data['id']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheFournisseur = function (p) {
        $scope.param = {
            'frs': $('#fournisseur' + p).val(),
            'ref': $('#reffournisseur' + p).val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.fournisseurs = data;
            AjoutHtmlAfter(data, '#fournisseur' + p, '#reffournisseur' + p);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheFournisseur1 = function (code, raison, id) {
        $(code).val('');
        $scope.param = {
            'frs': $(raison).val(),
            'ref': ''
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.fournisseurs1 = data;
            AjoutHtmlAfterRaison(data, code, raison, id);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AjouterFournisseur = function (p) {
        $scope.param = {
            'frs': $('#fournisseur' + p).val(),
            'ref': $('#reffournisseur' + p).val()
        }
        $http({
            url: domaineapp + '/achats.php/fournisseur/Ajoutfournisseur',
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
            alert("Erreur d'ajout");
        });
    }
    $scope.AjouterFournisseur1 = function () {
        $scope.param = {
            'frs': $('#fournisseur1').val(),
            'ref': $('#reffournisseur1').val()
        }
        $http({
            url: domaineapp + '/achats.php/fournisseur/Ajoutfournisseur',
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
            alert("Erreur d'ajout");
        });
    }
    $scope.ViderFournisseur = function (p) {
        $('#reffournisseur' + p).val('');
        $('#fournisseur' + p).val('');
    }
    $scope.ViderFournisseur1 = function () {
        $('#reffournisseur1').val('');
        $('#fournisseur1').val('');
    }
    $scope.ChoisArticle = function (iddoc) {
        $scope.param = {
            "iddoc": iddoc,
            "designation": $('#designation').val()
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Choisarticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfter(data, '#qtemax', '#designation');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.verifqte = function (deseignation) {
        $scope.param = {
            "deseignation": deseignation
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Verifqte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.InialiserLigneBCI = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/AfficheligneBCIpourContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailscontratss = data;
            var comArr = eval($scope.detailscontratss);
            for (var i = 0; i < comArr.length; i++) {
                $scope.detailscontratss[i].prixttc = 0;
            }
            $scope.calculerMontantTotal();
        }, function myError(response) {
            alert("Erreur de chargement des lignes B.C.I");
        });
    }

    $scope.AfficheLignedocBCI = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Afficheligneboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocs = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affiche bon de deponse aux compatnt
    $scope.AfficheLignedocBCIVersBCE = function (iddoc, p) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Afficheligneboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (p === '') {
                $scope.lignedocsdeponse = data;
            } else
                $scope.lignedocsdeponsep = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //___inilisation bon de deponse au comptant provisire
    $scope.InialiserBDCPS = function () {
        $('#id_lieup_chosen').attr('style', 'width:100%');
        $('#id_lieup').trigger("chosen:updated");
        $('#id_lieu_chosen').attr('style', 'width:100%');
        $('#id_lieu').trigger("chosen:updated");
    }
    $scope.AfficheLignedocBCIVersBCE1 = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Afficheligneboninterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsdeponse1 = data;
            //            alert($scope.lignedocsdeponse1.length);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.MisAjourLigneDocBonCommandeExterne = function (id, p) {
        //        alert($('#qte_' + id).val());
        if (p === '') {
            var comArr = eval($scope.lignedocsdeponse);
            for (var i = 0; i < comArr.length; i++) {
                //alert(comArr[i].norgdre + '===' + id);
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {

                    //alert($scope.lignedocs[i].qte);
                    if (parseFloat($scope.lignedocsdeponse[i].qte) < $('#qte_' + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#qte_' + id).val($scope.lignedocsdeponse[i].qte);
                    } else {
                        $scope.lignedocsdeponse[i].qte = $('#qte_' + id).val();
                    }
                    $scope.lignedocsdeponse[i].puht = $('#puht_' + id).val();
                    $scope.lignedocsdeponse[i].tva = $('#tva_' + id + ' option:selected').text();
                    $scope.lignedocsdeponse[i].idtva = $('#tva_' + id).val();
                    $scope.lignedocsdeponse[i].observation = $('#desc_' + id).val();
                    bootbox.dialog({
                        message: 'Mise à jour effectuée avec succès !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    /*
                     'puht': $('#puht').val(),
                     'tva': $("#tva option:selected").text(),
                     'idtva': $('#tva').val(),
                     'observation': $('#desc').val() 
                     
                     */

                    break;
                }
            }
        } else {
            var comArr = eval($scope.lignedocsdeponsep);
            for (var i = 0; i < comArr.length; i++) {
                //alert(comArr[i].norgdre + '===' + id);
                if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {

                    //alert($scope.lignedocs[i].qte);
                    if (parseFloat($scope.lignedocsdeponsep[i].qte) < $('#qte_' + p + id).val()) {
                        bootbox.dialog({
                            message: "Il faut vérifier la quantité !!!",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        $('#qte_' + p + id).val($scope.lignedocsdeponsep[i].qte);
                    } else {
                        $scope.lignedocsdeponsep[i].qte = $('#qte_' + p + id).val();
                    }
                    $scope.lignedocsdeponsep[i].puht = $('#puht_' + p + id).val();
                    $scope.lignedocsdeponsep[i].tva = $('#tva_' + p + id + ' option:selected').text();
                    $scope.lignedocsdeponsep[i].idtva = $('#tva_' + p + id).val();
                    $scope.lignedocsdeponsep[i].observation = $('#desc_' + p + id).val();
                    bootbox.dialog({
                        message: 'Mise à jour effectuée avec succès !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    break;
                }
            }
        }
    }



    $scope.ValiderTousBDCP = function () {
        if (confirm('Validez tous les Modification !!!')) {
            $scope.alert_bdcp = "a";
            for (var i = 0; i <= $scope.lignedocsdeponse1.length; i++) {
                //alert($scope.lignedocsdeponse1[i].id)
                $scope.MisAjourLigneDocBonCommandeExterne1($scope.lignedocsdeponse1[i].norgdre);
            }
            $('#btn_validation').removeClass('disabledbutton');
            bootbox.dialog({
                message: 'Mise à jour effectuée avec succès !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.DeleteLigneDocBonCInterne = function (id) {
        var index = -1;
        var comArr = eval($scope.lignedocs);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocs.splice(index, 1);
    }


    $scope.DeleteLigneDocBonCExterne = function (id, p) {
        var index = -1;
        if (p === '')
            var comArr = eval($scope.lignedocsdeponse);
        else
            var comArr = eval($scope.lignedocsdeponsep);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        if (p === '')
            $scope.lignedocsdeponse.splice(index, 1);
        else
            $scope.lignedocsdeponsep.splice(index, 1);
    }
    $scope.DeleteLigneDocBonCExterne1 = function (id) {
        var index = -1;
        var comArr = eval($scope.lignedocsdeponse1);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].norgdre) - parseFloat(id) === 0) {
                index = i;
                break;
            }
        }
        $scope.lignedocsdeponse1.splice(index, 1);
    }
    $scope.AjouterLignedoc = function () {
        qteselectionnez = parseFloat($('#qte_txt').val());
        qtemax = parseFloat($('#qtemax').val());
        if ($('#designation').val() != "" && qteselectionnez <= qtemax && qtemax >= 0) {
            nbligne = $scope.lignedocs.length + 1;
            nbligne = nbligne.toString().replace(/^(\d)$/, '0$1');
            // alert($scope.lignedocs.length);
            var comArr = eval($scope.lignedocs);
            var existe = 0;
            var ligne = 0;
            for (var i = 0; i < comArr.length; i++) {
                //                alert(comArr[i].designation.trim() +'==='+$('#designation').val().trim());
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    ligne = i;
                    break;
                }
            }
            if (existe == 0) {
                $scope.lignedocs.push({
                    'norgdre': nbligne,
                    'designation': $('#designation').val(),
                    'qte': $('#qte_txt').val()
                });
            } else {
                if (ligne != 0)
                    $scope.lignedocs[ligne].qte = $('#qte_txt').val();
            }
            $scope.ViderLignedoc();
        } else {
            bootbox.dialog({
                message: 'Vérifiez !!!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }





    $scope.ValiderBondedeponse = function (iddoc) {
        var reference = $('#referencebdc').val();
        if ($('#fournisseur').val() != "") {
            $scope.param = {
                "iddoc": iddoc,
                "listearticle": $scope.lignedocsdeponse,
                "frs": $('#fournisseur').val(),
                "id_fils": $('#listesbdcp').val(),
                'id_lieu': $('#id_lieu').val(),
                'reference': reference
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/Savebondedeponse',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;

                bootbox.dialog({
                    message: 'Bon de dépenses aux comptant crée avec succès !!!',
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    },
                    callback: function (result) {
                        console.log(result);
                    }
                });

                document.location.href = '?iddoc=' + $("#iddoc").val() + '&idbdc=' + data.idbdc + '&tab=4';
                $("#btnvalider").addClass('disabledbutton');
                //document.location.href = '?iddoc=' + $("#iddoc").val() + '&idbdc=' + data.idbdc + '&tab=4';
            }, function myError(response) {
                alert(response);
            });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner un fournisseur!!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }
    $scope.ValiderBondedeponseProvisoire = function (iddoc) {
        //        alert(iddoc);
        var doit_timbre = $('#bdc_droittimbre').val();
        var mnttotal_bdc = $('#txt_mnttotal_bdc').val();

        if ($('#fournisseur1').val() != "" && $('#txt_mnttotal').val()) {
            $scope.param = {
                "iddoc": iddoc,
                "mnttotal": $('#txt_mnttotal').val(),
                "listearticle": $scope.lignedocsdeponse1,
                "frs": $('#fournisseur1').val(),
                "lieulivraison": $('#id_lieup').val(),
                "doit_timbre": doit_timbre,
                "mnttotal_bdc": mnttotal_bdc,
            }
            $http({
                url: domaineapp + '/achats.php/documentachat/ValiderBondedeponseDEF',
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
                alert(response);
            });
        } else
            bootbox.dialog({
                message: 'Il faut sélectionner un fournisseur ou saisir le montant ttc... !!!',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
    }


    //    $scope.ValiderBondexterne = function (iddoc, p) {
    //         var total = $('#total').val() + $('#total_ttc_provisoire').val();
    //         alert($('#total').val()+'hhhhhh'+ $('#total_ttc_provisoire').val());
    //        var mnt_estimatif = $('#mnt_estimatif').val();
    //        if (total > mnt_estimatif) {
    //            bootbox.dialog({
    //                message: "Il faut vérifier les montants, tu dépasse le montant estimatif !!!",
    //                buttons:
    //                        {
    //                            "button":
    //                                    {
    //                                        "label": "Ok",
    //                                        "className": "btn-sm"
    //                                    }
    //                        }
    //            });
    //           
    //        }
    //     
    ////        if (p == "" && $('#listesbdcp').val() == "0") {
    ////            $('#btnvalider_bdcd').addClass('disabledbutton');
    ////        }
    ////        if ($('#fournisseur' + p).val() != "") {
    ////            if ($scope.lignedocsdeponsep.length > 0 || $scope.lignedocsdeponse.length > 0) {
    ////                if (p === '')
    ////                    var tab = eval($scope.lignedocsdeponse);
    ////                else
    ////                    var tab = eval($scope.lignedocsdeponsep);
    ////                $scope.param = {
    ////                    "iddoc": iddoc,
    ////                    "listearticle": tab,
    ////                    "frs": $('#fournisseur' + p).val(),
    ////                    "datemax": $('#maxreponse' + p).val(),
    ////                    "id_note": $('#idnote' + p).val(),
    ////                    "designation": $('#descriptionbce' + p).val(),
    ////                    'id_lieu': $('#id_lieu' + p).val(),
    ////                    'p': p,
    ////                    'id_fils': $('#listesbdcp').val()
    ////                }
    ////                $http({
    ////                    url: domaineapp + '/achats.php/documentachat/Savebonexterne',
    ////                    method: "POST",
    ////                    data: $scope.param,
    ////                    headers: {
    ////                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    ////                    }
    ////                }).then(function mySucces(response) {
    ////                    data = response.data;
    ////                    bootbox.dialog({
    ////                        message: data,
    ////                        buttons:
    ////                                {
    ////                                    "button":
    ////                                            {
    ////                                                "label": "Ok",
    ////                                                "className": "btn-sm"
    ////                                            }
    ////                                }
    ////                    });
    ////                    window.location.reload();
    ////                }, function myError(response) {
    ////                    alert(response);
    ////                });
    ////            } else
    ////                bootbox.dialog({
    ////                    message: 'Il faut valider la liste(s) des articles !',
    ////                    buttons:
    ////                            {
    ////                                "button":
    ////                                        {
    ////                                            "label": "Ok",
    ////                                            "className": "btn-sm"
    ////                                        }
    ////                            }
    ////                });
    ////        } else
    ////            bootbox.dialog({
    ////                message: 'Il faut sélectionner un fournisseur!!!',
    ////                buttons:
    ////                        {
    ////                            "button":
    ////                                    {
    ////                                        "label": "Ok",
    ////                                        "className": "btn-sm"
    ////                                    }
    ////                        }
    ////            });
    //    }

    $scope.AfficheDoc = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listebondeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheDocBCEP = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Listebcommandeexterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docDemandePrix = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ChoisirBDCD = function (iddoc) {
        $scope.param = {
            'idlignedoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignedeponse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailfrs = data[0];

            $('#reffournisseur').val($scope.detailfrs.ref);

            $('#fournisseur').val($scope.detailfrs.rs);
            $('#id_lieu').val($scope.detailfrs.id_lieu);
            $('#id_lieu').trigger("chosen:updated");
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.AfficheLignePDCP = function (id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Affichelignebdcp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsdeponse = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheLignePCEP = function (id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Affichelignebdcp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.lignedocsdeponse = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.EtatBDCP_dans_budget = function (id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Etatbdcpenbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data === '0') {
                if (confirm('Voulez-vous sélectionner le bon de dépense au comptant provisoire!!')) {
                    $scope.ChoisirBDCD(id);
                    $scope.AfficheLignePDCP(id);
                    $('#btnvalider_bdcd').removeClass('disabledbutton');
                } else {
                    $('#btnvalider_bdcd').addClass('disabledbutton');
                }
            } else {
                if (data === '1')
                    bootbox.dialog({
                        message: 'L\'imputation budget n\'est pas attribuée pour ce document provisoire !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                if (data === '2')
                    bootbox.dialog({
                        message: 'Bon de dépense définitif existe déjà !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                $('#btnvalider_bdcd').addClass('disabledbutton');
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ChoisirBDCP = function (iddoc) {
        $scope.param = {
            'idlignedoc': iddoc,
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Detaillignebcep',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailfrs = data[0];
            $('#reffournisseur').val($scope.detailfrs.ref);
            $('#reference').val($scope.detailfrs.reference);
            $('#fournisseur').val($scope.detailfrs.rs);
            $('#id_lieu').val($scope.detailfrs.id_lieu);
            $('#id_lieu').trigger("chosen:updated");
            $('#maxreponse').val($scope.detailfrs.maxreponsefrs);
            $('#idnote').val($scope.detailfrs.id_note);
            $('#descriptionbce').val($scope.detailfrs.observation);
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.EtatBCEP_dans_budget = function (id) {
        //alert(id);
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + '/achats.php/documentachat/Etatbdcpenbudget',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data === '0') {
                if (confirm('Voulez-vous sélectionner le bon de commande externe provisoire!!')) {
                    $scope.ChoisirBDCP(id);
                    $scope.AfficheLignePCEP(id);
                    $('#btnvalider_bdcd').removeClass('disabledbutton');
                } else {
                    $('#btnvalider_bdcd').addClass('disabledbutton');
                }
            } else {
                if (data === '1')
                    bootbox.dialog({
                        message: 'L\'imputation budget n\'est pas attribuée pour ce document provisoire',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                if (data === '2')
                    bootbox.dialog({
                        message: 'Bon commande externe définitif existe déjà !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                $('#btnvalider_bdcd').addClass('disabledbutton');
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

});
app.filter('integer', function () {
    return function (input) {
        var nb = parseFloat(input) - parseInt(input);
        if (nb === 0)
            return parseInt(input);
        else
            return input;
    };
});
app.filter('trusted', ['$sce', function ($sce) {
        var div = document.createElement('div');
        return function (text) {
            div.innerHTML = text;
            return $sce.trustAsHtml(div.textContent);
        };
    }]);
app.filter('trustAsHtml', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        };
    }]);