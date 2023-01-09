//var domaineapp = "/BmmErpV2/web/";

var domaineapp = "http://" + window.location.hostname + "/";
app.controller('CtrlMouvement', function ($scope, $filter, $http) {

    //******** Detail of banque *****//
    $scope.detailBanque = [];
    $scope.rib_banque = {
        'text': ""
    };
    $scope.soldedepart = {
        'text': ''
    };
    $scope.soldefinal = {
        'text': ''
    };
    $scope.soldeinial = 0;
    //**** detail of operation bancaire **** ////
    $scope.listes_operations = [];
    $scope.soldetoal = 0;
    $scope.ListesDesCheques = [];
    //*** Détails Ordonnance ***//
    $scope.numero = {
        'text': ''
    };
    $scope.fournisseur_rs = {
        'text': ''
    };
    $scope.fournisseur_rib = {
        'text': ''
    };
    $scope.mnt = {
        'text': ''
    };

    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option codeop='" + data[i].codeop + "' commission='" + data[i].valeurop + "' value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.AfficheDetailBanque = function (id) {
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/Affichedetailbanque',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $scope.detailBanque = data[0];

            $scope.rib_banque.text = $scope.detailBanque.rib;
            if ($scope.detailBanque.mntdefini) {
                $scope.soldedepart.text = $scope.detailBanque.mntdefini;
                $scope.soldefinal.text = $scope.detailBanque.mntdefini;
            } else {
                $scope.soldedepart.text = $scope.detailBanque.mntouverture;
                $scope.soldefinal.text = $scope.detailBanque.mntouverture;
            }
            if ($scope.soldedepart.text)
                $scope.soldeinial = parseFloat($scope.soldedepart.text);
            else
                $scope.soldeinial = 0;
            if ($scope.soldeinial > 0) {
                $('#sold_depart').attr('class', 'disabledbutton');
                //Afficher la zone des lignes mouvements
                $('#details_mouvements').attr('style', 'display:block');
            } else
                $('#details_mouvements').attr('style', 'display:none');
            //            console.log('solde final=' + $scope.soldefinal.text);
            if (!$scope.soldefinal.text) {
                $scope.soldefinal.text = $scope.soldeinial;
                $scope.soldetoal = parseFloat($scope.soldefinal.text);
            } else {
                $scope.soldetoal = parseFloat($scope.soldefinal.text);
            }
            //            console.log('solde totla=' + $scope.soldetoal);
        }, function myError(response) {
            console.log(response);
        });
    }
    $("#mouvementbanciare_id_instrument")
            .change(function () {
                if ($("#mouvementbanciare_id_instrument").val() == "") {
                    $('#tdcheque').attr('style', 'display:none');
                    $('#btnchargercheque').attr('style', 'display:none');
                    $('#autre_que_cheque').attr('style', 'display:none');
                } else if ($("#mouvementbanciare_id_instrument").val() == "3" || $("#mouvementbanciare_id_instrument").val() == "4" || $("#mouvementbanciare_id_instrument").val() == "5") {
                    $('#tdcheque').attr('style', 'display:none');
                    $('#btnchargercheque').attr('style', 'display:none');
                    $('#autre_que_cheque').attr('style', 'display:block');
                } else {
                    // if ($("#type_mouvement").is(':checked')) {
                    $('#autre_que_cheque').attr('style', 'display:none');
                    $('#tdcheque').attr('style', 'display:block');
                    $('#btnchargercheque').attr('style', 'display:block');
                    $('#btnchargercheque').removeClass('disabledbutton');
                    // } else {
                    //     $('#tdcheque').attr('style', 'display:none');
                    //     $('#btnchargercheque').attr('style', 'display:none');
                    //     $('#autre_que_cheque').attr('style', 'display:block');
                    // }
                }
            })
            .trigger("change");



    $("#mouvementbanciare_id_banque")
            .change(function () {
                if ($("#id_doc").val() == "") {
                    if ($("#mouvementbanciare_id_banque").val() != "" && $("#mouvementbanciare_id_banque").val() != "0") {
                        $scope.ViderLigne();
                        $scope.listes_operations.splice(0, $scope.listes_operations.length);

                        $scope.AfficheDetailBanque($("#mouvementbanciare_id_banque").val());

                        if ($("#type_mouvement").is(':checked'))
                            $scope.ListeOrdonnance($("#mouvementbanciare_id_banque").val());
                        $scope.ListeDesOperation($("#mouvementbanciare_id_banque").val(), $("#type_mouvement").is(':checked'));
                        //                        console.log('log_idbanque' + $("#mouvementbanciare_id_banque").val());
                        $scope.LastOpeartionInCompte($("#mouvementbanciare_id_banque").val());
                        $scope.ListeDesCheques($("#mouvementbanciare_id_banque").val());

                        //initialiser les selects
                        $('.chosen-container').attr("style", "width: 100%;");
                        $('.chosen-container').trigger("chosen:updated");
                    } else {
                        $('#details_mouvements').attr('style', 'display:none');
                    }
                    if ($("#type_mouvement").is(':checked') == true) {
                        //Cas du Décaissement
                        $('#ordonnance_input').attr('style', 'display:none');
                        $('#ordonnance_select').attr('style', 'display:block');
                    } else {
                        //Cas de l'Encaissement
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:block');
                    }
                }
            })
            .trigger("change");
    $scope.InitiliserBanque = function (id, numero) {

        if ($("#mouvementbanciare_id_banque").val() != "" && $("#mouvementbanciare_id_banque").val() != "0") {
            $scope.ViderLigne();
            $scope.listes_operations.splice(0, $scope.listes_operations.length);
            $scope.AfficheDetailBanque($("#mouvementbanciare_id_banque").val());
            if ($("#type_mouvement").is(':checked'))
                $scope.ListeOrdonnance($("#mouvementbanciare_id_banque").val());
            $('#numero_doc').val(numero);
            //            $('#numero_doc').addClass('disabledbutton');
            //            console.log($('#reforde').val());
            $scope.ListeDesOperation($("#mouvementbanciare_id_banque").val(), $("#type_mouvement").is(':checked'));
            //            console.log('log_idbanque' + $("#mouvementbanciare_id_banque").val());
            $scope.LastOpeartionInCompte($("#mouvementbanciare_id_banque").val());
            $scope.ListeDesCheques($("#mouvementbanciare_id_banque").val());
            //            $scope.DetailsOrdonnance2(id);
            $scope.TestExistanceCertificat(id);
            //            $scope.TestExistanceCertificat(id);
            //             $scope.DetailsOrdonnance($("#mouvementbanciare_id_documentbudget").val());
            //initialiser les selects
            $('.chosen-container').attr("style", "width: 100%;");
            $('.chosen-container').trigger("chosen:updated");
        } else {
            $('#details_mouvements').attr('style', 'display:none');
        }
        if ($("#type_mouvement").is(':checked') == true) {
            //Cas du Décaissement
            //            $('#ordonnance_input').attr('style', 'display:none');
            //            $('#ordonnance_select').attr('style', 'display:block');

            $('#ordonnance_input_doc').attr('style', 'display:none');
            $('#ordonnance_select').attr('style', 'display:none');
            $('#ordonnance_input').attr('style', 'display:block');
        } else {
            //Cas de l'Encaissement
            $('#ordonnance_select').attr('style', 'display:none');
            $('#ordonnance_input_doc').attr('style', 'display:block');
            $('#ordonnance_input').attr('style', 'display:none');
        }

    }
    $("#mouvementbanciare_id_type")
            .change(function () {
                if ($("#mouvementbanciare_id_type").val() != "" && $("#mouvementbanciare_id_type").val() != "0") {
                    $scope.ListeInstrument($("#mouvementbanciare_id_banque").val(), $("#mouvementbanciare_id_type").val());
                    $('#tdcheque').attr('style', 'display:none');
                    $('#btnchargercheque').attr('style', 'display:none');
                    $('#autre_que_cheque').attr('style', 'display:none');
                }
            })
            .trigger("change");

    $scope.AddNewSolde = function (id) {
        // ;
        $scope.param = {
            'idbanque': id,
            'mnt': parseFloat($('#sold_depart').val())
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/Addnewsolde',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $scope.AfficheDetailBanque($("#mouvementbanciare_id_banque").val());

        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.LastOpeartionInCompte = function (id) {
        //        ;
        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/LastOpeartionInCompte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            console.log(data);
            if (data != '' && data != '""') {
                $('#show_last_operation').html(data);
                $('#last_operation').val(data);
                $('#current_operation').val(data);
            } else {
                $('#show_last_operation').html(" -");
                $('#last_operation').val('0');
                $('#current_operation').val('0');
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.ListeDesOperation = function (id, type) {
        //        ;
        $scope.param = {
            'idbanque': id,
            'type': type,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/Listeoperation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#tdtype').removeClass('disabledbutton');
            //            console.log('datatype=' + data.length);
            if (data.length > 0)
                $scope.ChargerCombo('#mouvementbanciare_id_type', data);
            // else
            //     $('#tdtype').attr('class', 'disabledbutton');
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.ListeInstrument = function (id_banque, id_type_operation) {
        //        console.log('id=' + id_banque);
        $scope.param = {
            'idbanque': id_banque,
            'id_type_operation': id_type_operation
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/instrumentpaiment/ListeInstrument',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#tdtype').removeClass('disabledbutton');
            //            console.log('datatype=' + data.length);
            if (data.length > 0)
                $scope.ChargerCombo('#mouvementbanciare_id_instrument', data);
            // else
            //     $('#tdtype').attr('class', 'disabledbutton');
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.ListeDesCheques = function (id) {
        //        ;
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/Listecheque',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                $scope.ListesDesCheques = data;
                $scope.ChargerCombo('#mouvementbanciare_id_cheque', data);

                $('#tdcheque').attr('class', 'disabledbutton');
            } else
                $('#tdcheque').attr('class', 'disabledbutton');

        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.PushNewLigne = function () {
        if ($("#mouvementbanciare_id_object").val() == "6") {
            $('#ref_ordon').attr('style', 'display:none');
            $('#tranche_budget').attr('style', 'display:block');
            $('#doc_budget').attr('style', 'display:none');
            $('#op_tranche_budget').attr('style', 'display:block');
            $('#op_tranche_budget_id').attr('style', 'display:none');
            $('#frs').attr('style', 'display:none');

        }
        var valide = "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'>";

        if (!$('#mouvementbanciare_id_banque').val() || $('#mouvementbanciare_id_banque').val() == 0)
            valide += "<li> un Compte</li>";
        if (!$('#mouvementbanciare_dateoperation').val())
            valide += "<li> une date</li>";
        if (!$('#mouvementbanciare_id_object').val())
            valide += "<li> un objet de règlement</li>";
        //        alert($('#numero_doc').val());
        if ($('#reforde').val() == '' && $('#numero_doc').val() == '' && $('#mouvementbanciare_id_documentbudget').val() == '')
            valide += "<li> une référence d'ordennancement</li>";
        //&& ($('#mouvementbanciare_id_object').val() != 2 && $('#mouvementbanciare_id_object').val() != 5)
        if ($('#refbeni').val() == '' && $('#mouvementbanciare_id_object').val() == 1)
            valide += "<li> un bénéficiaire</li>";
        if (!$('#mouvementbanciare_id_instrument').val())
            valide += "<li> un instrument</li>";

        valide += "</ul>";

        var nbr = eval($('#current_operation').val()) + 1;
        var nbr_commission = '';
        //        if ($scope.listes_operations.length > 0)
        //            nbr = $scope.listes_operations.length + 1;

        var flag_commission = $('#id-button-commission').is(':checked');

        if (flag_commission == true) {
            //            var commission = $('#mouvementbanciare_id_type option:selected').text().split(' - ');
            //            var titre_commission = commission[0];
            //            var valeur_commision = commission[1];
            var titre_commission = $('#mouvementbanciare_id_type option:selected').text();
            var valeur_commision = $('#mouvementbanciare_id_type option:selected').attr('commission');
            var id_commission = $('#mouvementbanciare_id_type').val();
            nbr_commission = nbr + 0.1;
        } else {
            var titre_commission = '';
            var valeur_commision = '';
            var id_commission = '';
            nbr_commission = '';
        }
        if (valide == "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'></ul>") {
            $scope.listes_operations.push({
                'nb': nbr,
                'id_banque': $('#mouvementbanciare_id_banque').val(),
                'tranchebudget_id': $('#mouvementbanciare_id_budget').val(),
                'tranchebudget': $('#mouvementbanciare_id_budget option:selected').text(),
                'reford': $('#reforde').val(),
                'numero_doc': $('#numero_doc').val(),
                'id_declaration': $('#id_declaration').val(),
                'id_documentbudget': $('#mouvementbanciare_id_documentbudget').val(),
                'flag_documentbudget': $('#type_mouvement').is(':checked'),
                'id_object': $('#mouvementbanciare_id_object').val(),
                'id_banque_cible': $('#id_banque_cible').val(),
                'refbenifi': $('#refbeni').val(),
                'id_instrument': $('#mouvementbanciare_id_instrument').val(),
                'instrument': $('#mouvementbanciare_id_instrument option:selected').text(),
                'id_cheque': $('#mouvementbanciare_id_cheque').val(),
                'ncheque': $('#mouvementbanciare_id_cheque option:selected').text(),
                'refinstrument': $('#mouvementbanciare_referenceautre').val(),
                'debit': $('#val_debit').val(),
                'credit': $('#val_credit').val(),
                'solde': "",
                'ribbeni': $('#ribbeni').val(),
                'dateoperation': $('#mouvementbanciare_dateoperation').val(),
                'id_type': $('#mouvementbanciare_id_type').val(),
                'nomoperation': $('#mouvementbanciare_nomoperation').val(),
                'nbr_commission': nbr_commission,
                'idcomm': id_commission,
                'titrecomm': titre_commission,
                'valeurcomm': valeur_commision,
                'flag_commission': flag_commission,
                'soldecomm': "",
                'tvaretenue': $('#val_certificat_tva').val(),
                'retenue': $('#val_certificat').val()
            });
            $('#current_operation').val(nbr);
            $scope.CalculSolde();
            $scope.ViderLigne();
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
        }
    }
    $scope.ChargerCheque = function () {
        var comArr = eval($scope.listes_operations);
        var datacheque = eval($scope.ListesDesCheques);
        var id_cheque = -1;
        if (datacheque.length > 0)
            id_cheque = datacheque[0].id;
        for (var i = 0; i < comArr.length; i++) {
            for (var j = 0; j < datacheque.length; j++) {
                if (datacheque[j].id != comArr[i].id_cheque) {
                    id_cheque = datacheque[j].id;
                    break;
                }
            }
        }
        if (id_cheque != -1) {
            $('#mouvementbanciare_id_cheque').val(id_cheque);
            $('#mouvementbanciare_id_cheque').trigger("chosen:updated");
        } else {
            bootbox.dialog({
                message: 'Vous n\'avez pas de chèques pour ce compte bancaire !',
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    $scope.CalculSolde = function () {

        var comArr = eval($scope.listes_operations);
        var solde_inial = $scope.soldetoal;
        for (var i = 0; i < comArr.length; i++) {
            if (i == 0) {
                if (comArr[i].debit != "" && comArr[i].debit > 0) {
                    $scope.listes_operations[i].solde = solde_inial - parseFloat(comArr[i].debit);
                }
                if (comArr[i].credit != "" && comArr[i].credit > 0) {
                    $scope.listes_operations[i].solde = solde_inial + parseFloat(comArr[i].credit);
                }
                $scope.listes_operations[i].soldecomm = $scope.listes_operations[i].solde - parseFloat($scope.listes_operations[i].valeurcomm);
                //$scope.soldetoal = $scope.listes_operations[i].soldecomm;
            } else {
                if (comArr[i].debit != "" && comArr[i].debit > 0) {
                    if ($scope.listes_operations[i - 1].soldecomm != "" && $scope.listes_operations[i - 1].soldecomm > 0)
                        $scope.listes_operations[i].solde = $scope.listes_operations[i - 1].soldecomm - parseFloat(comArr[i].debit);
                    else
                        $scope.listes_operations[i].solde = $scope.listes_operations[i - 1].solde - parseFloat(comArr[i].debit);
                }
                if (comArr[i].credit != "" && comArr[i].credit > 0) {
                    if ($scope.listes_operations[i - 1].soldecomm != "" && $scope.listes_operations[i - 1].soldecomm > 0)
                        $scope.listes_operations[i].solde = $scope.listes_operations[i - 1].soldecomm + parseFloat(comArr[i].credit);
                    else
                        $scope.listes_operations[i].solde = $scope.listes_operations[i - 1].solde + parseFloat(comArr[i].credit);
                }
                $scope.listes_operations[i].soldecomm = $scope.listes_operations[i].solde - parseFloat($scope.listes_operations[i].valeurcomm);
                // $scope.soldetoal = $scope.listes_operations[i].soldecomm;
            }
        }

        if ($scope.listes_operations[comArr.length - 1].soldecomm != '')
            $scope.soldefinal.text = parseFloat($scope.listes_operations[comArr.length - 1].soldecomm).toFixed(3);
        else
            $scope.soldefinal.text = parseFloat($scope.listes_operations[comArr.length - 1].solde).toFixed(3);
    }
    $scope.SaveOperations = function () {

        $scope.param = {
            'operations': $scope.listes_operations,
            'id_doc': $('#id_doc').val(),
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/Savemouvement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ViderLigne();
           document.location.href = "show?ids=" + data;
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.ChangerCommission = function (nb) {
        var valeurcomm = $('#lgop' + nb).val();
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            //            console.log(comArr[i].nb + '===' + nb);
            if (comArr[i].nb === nb) {
                $scope.listes_operations[i].soldecomm = $scope.listes_operations[i].solde - parseFloat(valeurcomm);
                $scope.listes_operations[i].valeurcomm = valeurcomm;
                //                console.log("Solde=" + $scope.listes_operations[i].soldecomm);
                break;
            }
        }
        $scope.CalculSolde();
    }
    $scope.ViderLigne = function () {
        $('#tdcheque').attr('style', 'display:none');
        $('#btnchargercheque').attr('style', 'display:none');
        $('#autre_que_cheque').attr('style', 'display:none');

        $('#idformulaire input:text').val('');
        $('#idformulaire select').val('');
        $('#idformulaire select').trigger("chosen:updated");
    }
    $scope.Supprimer = function (nb) {
        var nbcom = nb + 0.1;
        //        console.log(nb + ',' + nbcom);
        var index = -1;
        var index1 = -1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            //            console.log(parseFloat(comArr[i].nb) + '-' + parseFloat(nb));
            if (parseFloat(comArr[i].nb) - parseFloat(nb) === 0) {
                index = i;
                break;
            }
        }
        for (var i = 0; i < comArr.length; i++) {
            //            console.log(parseFloat(comArr[i].nbr_commission) + '-' + parseFloat(nbcom));
            if (parseFloat(comArr[i].nbr_commission) - parseFloat(nbcom) === 0) {
                index1 = i;
                break;
            }
        }
        //        console.log(index + '-' + index1);
        $scope.listes_operations.splice(index, 1);
        //        $scope.listes_operations.splice(index1, 1);
        var nbr = eval($('#current_operation').val()) - 1;
        $('#current_operation').val(nbr);
        $scope.OrganiserTable();
        $scope.CalculSolde();
    }
    $scope.SupprimerCommission = function (nb) {
        var index = -1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            if (parseFloat(comArr[i].nb) - parseFloat(nb) === 0) {
                index = i;
                break;
            }
        }
        $scope.listes_operations[index]['nbr_commission'] = '';
        $scope.listes_operations[index]['idcomm'] = '';
        $scope.listes_operations[index]['titrecomm'] = '';
        $scope.listes_operations[index]['valeurcomm'] = '';
        $scope.listes_operations[index]['flag_commission'] = false;
        $scope.listes_operations[index]['soldecomm'] = '';
    }
    $scope.OrganiserTable = function () {
        var ligne = eval($('#last_operation').val()) + 1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            comArr[i].nb = ligne;
            comArr[i].nbr_commission = ligne + 0.1;
            ligne++;
        }
    }

    $("#mouvementbanciare_filters_id_banque")
            .change(function () {
                if ($("#mouvementbanciare_filters_id_banque").val() != "" && $("#mouvementbanciare_filters_id_banque").val() != "0") {
                    $scope.ListeDesOperationVirement($("#mouvementbanciare_filters_id_banque").val(), '#mouvementbanciare_filters_id_type');
                    //nitialiser les selects
                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");
                } else {

                }
            })
            .trigger("change");

    $scope.ListeDesOperationVirement = function (id, id_select) {

        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/Listeoperationvirement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            console.log('datatype=' + data.length);
            if (data.length > 0)
                $scope.ChargerCombo(id_select, data);
        }, function myError(response) {
            console.log(response);
        });
    }

    $("#bordereauvirement_filters_id_compte")
            .change(function () {
                if ($("#bordereauvirement_filters_id_compte").val() != "" && $("#bordereauvirement_filters_id_compte").val() != "0") {
                    $scope.ListeDesOperationVirement($("#bordereauvirement_filters_id_compte").val(), '#bordereauvirement_filters_id_typeoperation');

                    //nitialiser les selects
                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");
                } else {

                }
            })
            .trigger("change");

    $scope.ListeOrdonnance = function (id) {

        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/ListeOrdonnance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0)
                $scope.ChargerCombo('#mouvementbanciare_id_documentbudget', data);
            else {
                $('#mouvementbanciare_id_documentbudget').empty();
                $('#mouvementbanciare_id_documentbudget').val('').trigger("liszt:updated");
                $('#mouvementbanciare_id_documentbudget').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }

    $("#type_mouvement")
            .change(function () {
                if ($("#type_mouvement").is(':checked') == true) {
                    //Décaissement
                    if ($("#mouvementbanciare_id_object").val() == "4") {
                        $('#beneficiaire_input').attr('style', 'display:none');
                        $('#beneficiaire_select').attr('style', 'display:none');
                        //Cas de l'Encaissement (Transfert)
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:block');

                        //$('#ordonnance_input_doc').attr('style', 'display:none');
                        $('#beneficiaire_input_doc').attr('style', 'display:none');
                        $('#declaration_select').attr('style', 'display:none');

                        $scope.ListeCompteForTransfert($("#mouvementbanciare_id_banque").val());
                    } else if ($("#mouvementbanciare_id_object").val() == "3") {
                        $('#beneficiaire_input').attr('style', 'display:block');
                        $('#beneficiaire_select').attr('style', 'display:none');
                        //Cas du Décaissement (déclaration)
                        $('#founisseur').attr('style', 'display:block');
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input_doc').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:none');
                        $('#declaration_select').attr('style', 'display:block');

                        $scope.ListeDeclarationForDeclaration($("#mouvementbanciare_id_banque").val());
                    } else if ($("#mouvementbanciare_id_object").val() == "7") {
                        if (!$("#type_mouvement").is(':checked')) {
                            $('#ordonnance_select').attr('style', 'display:none');
                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_input_doc').attr('style', 'display:none');
                            $('#declaration_select').attr('style', 'display:none');
                            $('#ribbeni').attr('style', 'display:none');
                            $('#founisseur').attr('style', 'display:block');
                            $('#beneficiaire_input').attr('style', 'display:none');
                            $('#row_allimentationbudget').attr('style', 'display:block')
                        } else {
                            bootbox.alert("Il faut choisir le type encaissement !!!");
                        }
                    } else if ($("#mouvementbanciare_id_object").val() == "6") {
                        //Cas du Transfert
                        $('#reforde').attr('style', 'display:none');
                        $('#tdtype').attr('style', 'display:none');
                        $('#ribbeni').attr('style', 'display:none');
                        $('#refbeni').attr('style', 'display:none');
                        $('#ordonnance_td').attr('style', 'display:none');
                        $('#tdribfrs').attr('style', 'display:none');
                        $('#tdbenificiaire').attr('style', 'display:none');
                        $('#row_allimentationbudget').attr('style', 'display:block');

                        $('#ref_ordon').attr('style', 'display:none');
                        $('#tranche_budget').attr('style', 'display:block');
                        $('#founisseur').attr('style', 'display:none');
                        $('#doc_budget').attr('style', 'display:none');
                        $('#op_tranche_budget').attr('style', 'display:block');
                        $('#op_tranche_budget_id').attr('style', 'display:none');
                        $('#frs').attr('style', 'display:none');

                    } else {

                        if ($('#id_doc').val() != '') {

                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_select').attr('style', 'display:none');
                            $('#ordonnance_input_doc').attr('style', 'display:block');
                            $('#declaration_select').attr('style', 'display:none');
                        } else {
                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_select').attr('style', 'display:block');
                            $('#ordonnance_input_doc').attr('style', 'display:none');
                            $('#declaration_select').attr('style', 'display:none');
                        }

                        //                        $scope.ListeDesOperation($("#mouvementbanciare_id_banque").val(), $("#type_mouvement").is(':checked'));
                        //                        var id = $('#id_doc').val();
                        //                        alert(id + 'id=');
                        //                        $("#mouvementbanciare_id_documentbudget").val(id);
                        //                        $('.chosen-container').attr("style", "width: 100%;");
                        //                        $('.chosen-container').trigger("chosen:updated");

                    }
                    $('#val_credit').val('');
                    $('#val_credit').attr('readonly', 'true');
                    $('#val_debit').removeAttr('readonly');
                } else {
                    //Encaissement
                    if ($("#mouvementbanciare_id_object").val() == "6") {
                        //Cas du Transfert
                        $('#reforde').attr('style', 'display:none');
                        $('#tdtype').attr('style', 'display:none');
                        $('#ribbeni').attr('style', 'display:none');
                        $('#founisseur').attr('style', 'display:block');
                        $('#refbeni').attr('style', 'display:none');
                        $('#ordonnance_td').attr('style', 'display:none');
                        $('#tdribfrs').attr('style', 'display:none');
                        $('#tdbenificiaire').attr('style', 'display:none');
                        $('#row_allimentationbudget').attr('style', 'display:block');

                    }
                    $('#ordonnance_select').attr('style', 'display:none');
                    $('#ordonnance_input').attr('style', 'display:block');
                    $('#ordonnance_input_doc').attr('style', 'display:none');
                    $('#declaration_select').attr('style', 'display:none');

                    //Activer crédit & désactver débit
                    $('#val_debit').val('');
                    $('#val_debit').attr('readonly', 'true');
                    $('#val_credit').removeAttr('readonly');
                }
                $scope.numero.text = '';
                $('#reforde').val('');
                $('#reforde').val('');
                $('#ribbeni').val('');
                $('#refbeni').val('');
                if ($('#mouvementbanciare_id_object').val() != '6')
                    $scope.ViderLigne();
                $scope.ListeDesOperation($("#mouvementbanciare_id_banque").val(), $("#type_mouvement").is(':checked'));

            })

    $("#mouvementbanciare_id_documentbudget")
            .change(function () {
                if ($("#mouvementbanciare_id_documentbudget").val() != "" && $("#mouvementbanciare_id_documentbudget").val() != "0") {
                    $scope.TestExistanceCertificat($("#mouvementbanciare_id_documentbudget").val());
                    $scope.DetailsOrdonnance($("#mouvementbanciare_id_documentbudget").val());
                }
            })


    $scope.DetailsOrdonnance2 = function (id) {

        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/DetailsOrdonnance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailOrdonnance = data[0];

            $scope.numero.text = $scope.detailOrdonnance.numero;
            $scope.fournisseur_rs.text = $scope.detailOrdonnance.fournisseur_rs;
            $scope.fournisseur_rib.text = $scope.detailOrdonnance.fournisseur_rib;
            $scope.mnt.text = $scope.detailOrdonnance.mnt;
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.DetailsOrdonnanceNumero = function (id) {

        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/DetailsOrdonnance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailOrdonnance = data[0];
            $scope.numero.text = $scope.detailOrdonnance.numero;
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.DetailsOrdonnance = function (id) {

        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/DetailsOrdonnance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailOrdonnance = data[0];

            $scope.numero.text = $scope.detailOrdonnance.numero;
            $scope.fournisseur_rs.text = $scope.detailOrdonnance.fournisseur_rs;
            $scope.fournisseur_rib.text = $scope.detailOrdonnance.fournisseur_rib;
            $scope.mnt.text = $scope.detailOrdonnance.mnt;
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.DetailsOrdonnanceCrtifie = function (id, id_certif) {

        $scope.param = {
            'id': id,
            'id_certif': id_certif,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/DetailsOrdonnanceCertifie',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailOrdonnance = data[0];

            //            $scope.numero.text = $scope.detailOrdonnance.numero;
            $scope.fournisseur_rs.text = $scope.detailOrdonnance.fournisseur_rs;
            $scope.fournisseur_rib.text = $scope.detailOrdonnance.fournisseur_rib;
            $scope.mnt.text = $scope.detailOrdonnance.mnt;
            $('#certificat').attr('style', 'display:block');
            $('#val_certificat').val($scope.detailOrdonnance.mnt_retenue);

            $('#val_certificat_tva').val($scope.detailOrdonnance.mnt_retenuetva);
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.TestExistanceCertificat = function (id) {

        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/TestExistantccertificat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log(data.length + 'existance certif' + $("#id_doc").val() + data.length);
            if ($("#id_doc").val() != null) {
                if (data.length == 0)
                    $scope.DetailsOrdonnance($("#id_doc").val());
                else {
                    // data = response.data[0];
                    $scope.DetailsOrdonnance(data[0]['idbudget']);
                    $scope.DetailsOrdonnanceCrtifie(id, data['id']);
                    $scope.DetailsOrdonnanceNumero(data[0]['idbudget']);
                }
            } else {
                //id_doc
                $scope.DetailsOrdonnance(data[0]['idbudget']);
                $scope.DetailsOrdonnanceCrtifie(id, data[0]['id']);
                $scope.DetailsOrdonnanceNumero(data[0]['idbudget']);
            }
        }, function myError(response) {
            console.log(response);
        });
    }
//    $('#budget_mouvement').change(function () {
//
//        if ($('#budget_mouvement').val() && !isNaN(parseInt($('#budget_mouvement').val()))) {
//            $scope.AfficheTrancheByBudget($('#budget_mouvement').val());
//        }
//
//    }).trigger("change");
//    $scope.AfficheTrancheByBudget = function (id) {
//        $scope.param = {
//            'id': id,
//        }
//        $http({
//            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/AfficheTranche',
//            method: "POST",
//            data: $scope.param,
//            dataType: 'json',
//            contentType: 'application/json',
//        }).then(function mySucces(response) {
//            data = response.data.tranches;
//            $('#mouvementbanciare_id_budget').html('');
//            $.each(data, function (index, value) {
//                $('#mouvementbanciare_id_budget').append('<option value="' + data[index].id + '">' + data[index].libelle + '</option>');
//            });
//            $('#mouvementbanciare_id_budget').trigger("chosen:updated");
//        }, function myError(response) {
//            console.log(response);
//        });
//    }
    $("#mouvementbanciare_id_object")
            .change(function () {
                if ($("#type_mouvement").is(':checked') == true) {
                    //Cas du Décaissement
                    if ($('#id_doc').val() != '') {
                        $('#ordonnance_input').attr('style', 'display:none');
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input_doc').attr('style', 'display:block');
                        $('#declaration_select').attr('style', 'display:none');
                    } else {
                        $('#ordonnance_input').attr('style', 'display:none');
                        $('#ordonnance_select').attr('style', 'display:block');
                        $('#ordonnance_input_doc').attr('style', 'display:none');
                        $('#declaration_select').attr('style', 'display:none');
                    }
                }
                if ($("#mouvementbanciare_id_object").val() != "" && $("#mouvementbanciare_id_object").val() != "0") {
                    if ($("#mouvementbanciare_id_object").val() == "4") {
                        $('#beneficiaire_input').attr('style', 'display:none');
                        $('#beneficiaire_select').attr('style', 'display:none');
                        //Cas de l'Encaissement (Transfert)
                        $('#founisseur').attr('style', 'display:block');
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:block');
                        $('#beneficiaire_input_doc').attr('style', 'display:none');
                        $('#declaration_select').attr('style', 'display:none');

                        $scope.ListeCompteForTransfert($("#mouvementbanciare_id_banque").val());
                    } else if ($("#mouvementbanciare_id_object").val() == "3") {
                        $('#beneficiaire_input').attr('style', 'display:block');
                        $('#founisseur').attr('style', 'display:block');
                        $('#beneficiaire_select').attr('style', 'display:none');
                        //Cas du Décaissement (déclaration)
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input_doc').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:none');
                        $('#declaration_select').attr('style', 'display:block');

                        $scope.ListeDeclarationForDeclaration($("#mouvementbanciare_id_banque").val());
                    } else if ($("#mouvementbanciare_id_object").val() == "7") {
                        if (!$("#type_mouvement").is(':checked')) {
                            $('#ordonnance_select').attr('style', 'display:none');
                            $('#founisseur').attr('style', 'display:block');
                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_input_doc').attr('style', 'display:none');
                            $('#declaration_select').attr('style', 'display:none');
                            $('#ribbeni').attr('style', 'display:none');
                            $('#beneficiaire_input').attr('style', 'display:none');
                            $('#row_allimentationbudget').attr('style', 'display:block')
                        } else {
                            bootbox.alert("Il faut choisir le type encaissement !!!");
                        }



                    } else if ($("#mouvementbanciare_id_object").val() == "6") {
                        //Cas du Transfert
                        $('#reforde').attr('style', 'display:none');
                        $('#tdtype').attr('style', 'display:none');
                        $('#ribbeni').attr('style', 'display:none');
                        $('#refbeni').attr('style', 'display:none');
                        $('#ordonnance_td').attr('style', 'display:none');
                        $('#tdribfrs').attr('style', 'display:none');
                        $('#tdbenificiaire').attr('style', 'display:none');
                        $('#row_allimentationbudget').attr('style', 'display:block');

                        $('#ref_ordon').attr('style', 'display:none');
                        $('#tranche_budget').attr('style', 'display:block');
                        $('#founisseur').attr('style', 'display:none');
                        $('#doc_budget').attr('style', 'display:none');
                        $('#op_tranche_budget').attr('style', 'display:block');
                        $('#op_tranche_budget_id').attr('style', 'display:none');
                        $('#frs').attr('style', 'display:none');

                    } else if ($("#mouvementbanciare_id_object").val() == "1" || $("#mouvementbanciare_id_object").val() == "2" || $("#mouvementbanciare_id_object").val() == "5") {
                        console.log($("#mouvementbanciare_id_object").val() + 'id_objet');
                        $('#ref_ordon').attr('style', 'display:block');
                        $('#frs').attr('style', 'display:block');
                        $('#tdtype').attr('style', 'display:block');
                        $('#tranche_budget').attr('style', 'display:none');
                        $('#doc_budget').attr('style', 'display:block');
                        $('#op_tranche_budget').attr('style', 'display:none');
                        $('#op_tranche_budget_id').attr('style', 'display:none');
                        $('#founisseur').attr('style', 'display:block');
                        $('#row_allimentationbudget').attr('style', 'display:none')
                        $('#beneficiaire_select').attr('style', 'display:none');
                        $('#beneficiaire_input').attr('style', 'display:block');
                        $('#ordonnance_td').attr('style', 'display:block');
                        if ($('#id_doc').val() == '')
                            $('#ordonnance_select').attr('style', 'display:block');
                        // if ($("#type_mouvement").is(':checked') == true) {
                        //     //Cas du Décaissement
                        //     if ($('#id_doc').val() != '') {
                        //         $('#ordonnance_input').attr('style', 'display:none');
                        //         $('#ordonnance_select').attr('style', 'display:none');
                        //         $('#ordonnance_input_doc').attr('style', 'display:block');
                        //         $('#declaration_select').attr('style', 'display:none');
                        //     } else {
                        //         $('#ordonnance_input').attr('style', 'display:none');
                        //         $('#ordonnance_select').attr('style', 'display:block');
                        //         $('#ordonnance_input_doc').attr('style', 'display:none');
                        //         $('#declaration_select').attr('style', 'display:none');
                        //     }
                        // }
                    }
                } else {
                    $('#beneficiaire_select').attr('style', 'display:none');
                    $('#ordonnance_input_doc').attr('style', 'display:none');
                    $('#founisseur').attr('style', 'display:block');
                    $('#beneficiaire_input').attr('style', 'display:block');
                    if ($("#type_mouvement").is(':checked') == true) {
                        //Cas du Décaissement
                        if ($('#id_doc').val() != null) {
                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_select').attr('style', 'display:none');
                            $('#ordonnance_input_doc').attr('style', 'display:block');
                            $('#declaration_select').attr('style', 'display:none');
                        } else {
                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_select').attr('style', 'display:block');
                            $('#ordonnance_input_doc').attr('style', 'display:none');
                            $('#declaration_select').attr('style', 'display:none');
                        }
                    } else {
                        //Cas de l'Encaissement
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:block');
                        $('#ordonnance_input_doc').attr('style', 'display:none');
                        $('#declaration_select').attr('style', 'display:none');
                    }
                }
                if ($("#mouvementbanciare_id_documentbudget").val() == "" || $("#mouvementbanciare_id_documentbudget").val() == "0") {
                    $scope.numero.text = '';
                    $('#reforde').val('');

                    $('#refbeni').val('');
                    $('#ribbeni').val('');
                    $('#ribbeni').removeAttr('readonly');
                }
            })
            .trigger("change");

    $scope.ListeCompteForTransfert = function (id_banque) {
        //        console.log('id=' + id_banque);
        $scope.param = {
            'idbanque': id_banque,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/caissesbanques/ListeCompteForTransfert',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0)
                $scope.ChargerCombo('#id_banque_cible', data);
            else {
                $('#id_banque_cible').empty();
                $('#id_banque_cible').val('').trigger("liszt:updated");
                $('#id_banque_cible').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }

    $("#id_banque_cible")
            .change(function () {
                if ($("#id_banque_cible").val() != "" && $("#id_banque_cible").val() != "0") {
                    var beneficiaire = $('#id_banque_cible option:selected').text();
                    var ribbeni = $('#id_banque_cible option:selected').attr('codeop');

                    $('#refbeni').val(beneficiaire);
                    $('#ribbeni').val(ribbeni.trim());
                    $('#ribbeni').attr('readonly', 'true');
                } else {
                    $('#refbeni').val('');
                    $('#ribbeni').val('');
                    $('#ribbeni').removeAttr('readonly');
                }
            })
            .trigger("change");

    $scope.ListeDeclarationForDeclaration = function (id_banque) {
        //        console.log('id=' + id_banque);
        $scope.param = {
            'idbanque': id_banque,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/ListeDeclaration',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0)
                $scope.ChargerCombo('#id_declaration', data);
            else {
                $('#id_declaration').empty();
                $('#id_declaration').val('').trigger("liszt:updated");
                $('#id_declaration').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }

    $("#id_declaration")
            .change(function () {
                if ($("#id_declaration").val() != "" && $("#id_declaration").val() != "0") {
                    $scope.DetailsDeclaration($("#id_declaration").val());
                }
            })

    $scope.DetailsDeclaration = function (id) {
        ;
        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresoriecaisse.php/mouvementbanciare/DetailsDeclaration',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailDeclaration = data[0];

            $scope.numero.text = $scope.detailDeclaration.libelle;
            $scope.mnt.text = $scope.detailDeclaration.montant;
        }, function myError(response) {
            console.log(response);
        });
    }

});