var domaineapp = 'http://' + window.location.hostname + '/';
//var domaineapp = window.location.hostname;
app.controller('CtrlMouvement', function ($scope, $filter, $http) {
    //******** Detail of banque *****//
    $scope.detailCaisse = [];
    $scope.soldedepart = {'text': ''};
    $scope.soldefinal = {'text': ''};
    $scope.sold_final_hidden = {'text': ''};
    $scope.caisse = {'text': ''};
    $scope.code = {'text': ''};
    $scope.soldeinial = 0;
    //**** detail of operation bancaire **** ////
    $scope.listes_operations = [];
    $scope.soldetoal = 0;
    //*** Détails Ordonnance ***//
    $scope.numero = {'text': ''};
    $scope.fournisseur_rs = {'text': ''};
    $scope.fournisseur_rib = {'text': ''};
    $scope.mnt = {'text': ' '};


    $scope.AfficheDetailCaisseSuivi = function (id) {
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/AffichedetailcaisseSuivi',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.detailCaisse = data[0];
            $scope.soldedepart.text = parseFloat($scope.detailCaisse.mntouverture).toLocaleString();
            $('#sold_depart_hidden').val($scope.detailCaisse.mntouverture);
            //            $scope.soldedepart.text =parseFloat($scope.detailCaisse.mntouverture).toLocaleString();
            $scope.soldefinal.text = parseFloat($scope.detailCaisse.mntdefini).toLocaleString();
            $scope.sold_final_hidden.text = $scope.detailCaisse.mntdefini;
            $('#solde_final_hidden').val($scope.detailCaisse.mntdefini);
            $scope.code.text = $scope.detailCaisse.codecb;
            $scope.caisse.text = $scope.detailCaisse.libelle;
            $scope.affchedetailSolde(id);

        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.affchedetailSolde = function (id) {
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/AffichedetailSolde',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#depense').val(parseFloat(data[0]['depense']).toLocaleString());
            $('#depense_hidden').val(data[0]['depense']);
            if (data[0]['recette'] != '') {
                $('#recete').val(parseFloat(data[0]['recette']).toLocaleString());
                $('#recete_hidden').val(data[0]['recette']);
            } else
                $('#recete').val(0);
            if (data[0]['recette'] != '')
                var total = parseFloat(parseFloat(data[0]['recette']) - parseFloat(data[0]['depense']));
            $('#total_caisse').val(parseFloat(total).toLocaleString());

            $('#total_caisse_hidden').val(total);
            if ($scope.soldedepart.text)
                $scope.soldeinial = parseFloat($scope.soldedepart.text);
            else
                $scope.soldeinial = 0;
            $('#sold_depart').attr('class', 'disabledbutton');
            $scope.affchedetailQuitanceDef(id);


        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.affchedetailQuitanceDef = function (id) {
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/AffichedetailquitanceSuivi',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#mntquitanceD').val(parseFloat(data['mntquitanced']).toLocaleString());
            $('#mntquitanceD_hidden').val(data['mntquitanced']);

            var mntqu_def = parseFloat(data['mntquitanced']);
            var mntqu_prov = parseFloat($('#mntquitanceP').val());
            var total = mntqu_prov + mntqu_def;
            $('#total_quitance').val(parseFloat(total).toLocaleString());

            $('#total_quitance_hidden').val(total);
            $scope.affchedetailQuitanceProvisoire(id);

        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.affchedetailQuitanceProvisoire = function (id) {
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/AffichedetailquitanceSuiviProvisoire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#mntquitanceP').val(parseFloat(data['mntquitancep']).toLocaleString());
            $('#mntquitanceP_hidden').val(data['mntquitancep']);
            var mntqu_prov = parseFloat(data['mntquitancep']);
            var mntqu_def = parseFloat($('#mntquitanceD').val());
            var total = parseFloat(mntqu_prov + mntqu_def);
            $('#total_quitance').val(parseFloat(total).toLocaleString());
            $('#total_quitance_hidden').val(total);
            $scope.affchedetailSoldeavecSansQuitance(id);
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.affchedetailSoldeavecSansQuitance = function (id) {
        var solde_fin = parseFloat($('#solde_final_hidden').val());
        var total_quitance = parseFloat($('#total_quitance_hidden').val());
        var total_caisse = parseFloat($('#total_caisse_hidden').val());
        var sold_depart = parseFloat($('#sold_depart_hidden').val());
        //        var soldeavec_quitance = parseFloat(solde_fin + total_quitance);
        var soldeavec_quitance = parseFloat(total_caisse + sold_depart);
        //(total_caisse + "eddd" + total_quitance + "'rzs" + sold_depart);
        //        $('#solde_avecquitance').val(parseFloat(soldeavec_quitance).toLocaleString());
        $('#solde_avecquitance').val(parseFloat(soldeavec_quitance).toLocaleString());
        $('#solde_sansquitance').val(parseFloat(solde_fin).toLocaleString());

    }

    $("#id_caisse")
            .change(function () {
                if ($("#id_caisse").val() != "0") {
                    $scope.AfficheDetailCaisseSuivi($("#id_caisse").val());
                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");
                } else {
                    $('#mntquitanceD').val('');
                    $('#mntquitanceP').val('');
                    $('#total_quitance').val('');
                    $('#recete').val('');
                    $('#depense').val('');
                    $('#total_caisse').val('');
                    $('#solde_quiDef').val('');
                    $('#soldesansquitance').val('');
                    $('#total_solde_quitance').val('');
                    $('#solde_avecquitance').val('');
                    $('#solde_sansquitance').val('');
                    $('#sold_depart').val('');
                    $('#soldesansquitance').val('');
                    $('#nsolde').val('');
                    $('#caisse').val('');
                    $('#code').val('');
                    $('#sold_final').val('');
                }
            })
            .trigger("change");

    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option codeop='" + data[i].codeop + "' commission='" + data[i].valeurop + "' value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.AfficheDetailCaisse = function (id) {
        //('id_test_sss=' + id);
        $scope.param = {
            'idbanque': id
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/Affichedetailcaisse',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $scope.detailCaisse = data[0];

            $scope.soldedepart.text = $scope.detailCaisse.mntouverture;
            $scope.soldefinal.text = $scope.detailCaisse.mntdefini;
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
            //('solde final=' + $scope.soldefinal.text);
            if (!$scope.soldefinal.text) {
                $scope.soldefinal.text = $scope.soldeinial;
                $scope.soldetoal = parseFloat($scope.soldefinal.text);
            } else {
                $scope.soldetoal = parseFloat($scope.soldefinal.text);
            }
            if ($("#id_doc").val() == "") {
                $('#ordonnance_select').attr('style', 'display:block');
                $('#ordonnance_input_doc').attr('style', 'display:none');
            } else {
                $('#ordonnance_select').attr('style', 'display:none');
                $('#ordonnance_input_doc').attr('style', 'display:block');
            }
            //('solde totla=' + $scope.soldetoal);
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
            else
                $('#tdtype').attr('class', 'disabledbutton');
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.ListeOrdonnanceHorbci = function (id) {
        // console.log('id=', id);
        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/ListeOrdonnanceHorBci',
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

    $scope.ListeOrdonnance = function (id) {
        // console.log('id=', id);
        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/ListeOrdonnance',
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
            //('data=', $scope.detailOrdonnance.mnt);
            $scope.numero.text = $scope.detailOrdonnance.numero;
            $('#reforde_id').val($scope.detailOrdonnance.id);
            $('#reforde').val($scope.detailOrdonnance.numero);
            $scope.fournisseur_rs.text = $scope.detailOrdonnance.fournisseur_rs;
            $scope.fournisseur_rib.text = $scope.detailOrdonnance.fournisseur_rib;
            $('#val_debit').val($scope.detailOrdonnance.mnt);
            //($scope.mnt.text)
        }, function myError(response) {
            console.log(response);
        });
    }

//    $("#numero_doc")
//            .change(function () {
//                if ($("#numero_doc").val() != "" && $("#numero_doc").val() != "0" && $("#id_doc").val() != "" ) {
//                    $scope.DetailsOrdonnance($("#id_doc").val());
//                }
//            })
    $("#mouvementbanciare_id_documentbudget")
            .change(function () {
                if ($("#mouvementbanciare_id_documentbudget").val() != "" && $("#mouvementbanciare_id_documentbudget").val() != "0") {
                    // $scope.TestExistanceCertificat($("#mouvementbanciare_id_documentbudget").val());
                    $scope.DetailsOrdonnance($("#mouvementbanciare_id_documentbudget").val());
                }
            })
    $scope.LastOpeartionInCompteCai = function (id) {
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

    $("#mouvementbanciare_id_banque")
            .change(function () {
                if ($("#id_doc").val() == "") {
                    if ($("#mouvementbanciare_id_banque").val() != "" && $("#mouvementbanciare_id_banque").val() != "0") {
                        $scope.ViderLigne();
                        $scope.listes_operations.splice(0, $scope.listes_operations.length);
                        $scope.AfficheDetailCaisse($("#mouvementbanciare_id_banque").val());
                        //if ($("#type_mouvement").is(':checked'))
                        if ($("#typedoc").val() == "") {
                            $scope.ListeOrdonnance($("#mouvementbanciare_id_banque").val());
                        }
                        if ($("#typedoc").val() == "horbci") {
                            if ($("#id_doc").val() == "") {
                                $scope.ListeOrdonnanceHorbci($("#mouvementbanciare_id_banque").val());
                            }
                        }
                        $scope.ListeDesOperation($("#mouvementbanciare_id_banque").val(), $("#type_mouvement").is(':checked'));
                        $scope.LastOpeartionInCompteCai($("#mouvementbanciare_id_banque").val());
                        $('.chosen-container').attr("style", "width: 100%;");
                        $('.chosen-container').trigger("chosen:updated");

                    } else {
                        $('#details_mouvements').attr('style', 'display:none');
                    }
                } else {
                    $scope.listes_operations.splice(0, $scope.listes_operations.length);
                    $scope.AfficheDetailCaisse($("#mouvementbanciare_id_banque").val());
                    //if ($("#type_mouvement").is(':checked'))
                    $scope.ListeOrdonnance($("#mouvementbanciare_id_banque").val());
                    $scope.LastOpeartionInCompteCai($("#mouvementbanciare_id_banque").val());
                    //initialiser les selects
                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");

                }
            })
            .trigger("change");
    $("#mouvementbanciare_id_banque")
            .change(function () {
                if ($("#id_doc").val() == "") {
                    if ($("#mouvementbanciare_id_banque").val() != "" && $("#mouvementbanciare_id_banque").val() != "0") {
                        $scope.ViderLigne();
                        $scope.listes_operations.splice(0, $scope.listes_operations.length);

                        $scope.AfficheDetailCaisse($("#mouvementbanciare_id_banque").val());

                        if ($("#type_mouvement").is(':checked'))
                            $scope.ListeBonDepenseComptant($("#mouvementbanciare_id_banque").val());
                        //console.log('log_idbanque' + $("#mouvementbanciare_id_banque").val());
                        //   $scope.LastOpeartionInCompte($("#mouvementbanciare_id_banque").val());
                        //initialiser les selects
                        $('.chosen-container').attr("style", "width: 100%;");
                        $('.chosen-container').trigger("chosen:updated");

                    } else {
                        $('#details_mouvements').attr('style', 'display:none');
                    }
                } else {
                    $scope.listes_operations.splice(0, $scope.listes_operations.length);
                    $scope.AfficheDetailCaisse($("#mouvementbanciare_id_banque").val());
                    if ($("#type_mouvement").is(':checked'))
                        $scope.ListeBonDepenseComptant($("#mouvementbanciare_id_banque").val());
                    // console.log('log_idbanque' + $("#mouvementbanciare_id_banque").val());
                    //$scope.LastOpeartionInCompte($("#mouvementbanciare_id_banque").val());
                    //initialiser les selects
                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");

                }
            })
            .trigger("change");

    $scope.InitiliserCaisse = function (id) {
        if ($("#numero_doc").val() != "" && $("#numero_doc").val() != "0" && $("#id_doc").val() != "") {
            $scope.DetailsOrdonnance($("#id_doc").val());
        }
    }
    $scope.InitiliserCaisseanque = function (id) {
        console.log('cdcd');
        $('#mouvementbanciare_id_object').val('').trigger("liszt:updated");
        $('#mouvementbanciare_id_object').trigger("chosen:updated");
        if ($("#mouvementbanciare_id_banque").val() != "" && $("#mouvementbanciare_id_banque").val() != "0") {
            $scope.ViderLigne();
            $scope.listes_operations.splice(0, $scope.listes_operations.length);
            $scope.AfficheDetailCaisse($("#mouvementbanciare_id_banque").val());
            if ($("#type_mouvement").is(':checked')) {
                if (id != "") {
                    $scope.TestExistanceCertificat(id);
                    $scope.DetailsBonDepensesComptant(id);
                    $("#mouvementbanciare_id_banque").addClass('disabledbutton');
                    $("#mouvementbanciare_id_documentachat").val(id);
                    $('.chosen-container').attr("style", "width: 100%;");
                    $('.chosen-container').trigger("chosen:updated");
                    $("#mouvementbanciare_id_documentachat").addClass('disabledbutton');
                } else {
                    $scope.ListeBonDepenseComptant($("#mouvementbanciare_id_banque").val());
                }
            }
            // $scope.LastOpeartionInCompte($("#mouvementbanciare_id_banque").val());
            //initialiser les selects
            $('.chosen-container').attr("style", "width: 100%;");
            $('.chosen-container').trigger("chosen:updated");
        } else {
            $('#details_mouvements').attr('style', 'display:none');
        }
    }

    $scope.AddNewSolde = function (id) {
        //        console.log('id=' + id);
        $scope.param = {
            'idbanque': id,
            'mnt': parseFloat($('#sold_depart').val())
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/Addnewsolde',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $scope.AfficheDetailCaisse($("#mouvementbanciare_id_banque").val());

        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.LastOpeartionInCompte = function (id) {
        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/LastOpeartionInCompte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
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

    $("#mouvementbanciare_id_object")
            .change(function () {
                if ($("#id_doc").val() == "") {
                    if ($("#mouvementbanciare_id_object").val() != "" && $("#mouvementbanciare_id_object").val() != "0") {
                        if ($("#mouvementbanciare_id_object").val() == "4") {
                            $('#beneficiaire_input').attr('style', 'display:none');
                            $('#beneficiaire_select').attr('style', 'display:block');

                            //Cas de l'Encaissement
                            $('#ordonnance_select').attr('style', 'display:none');
                            $('#ordonnance_input').attr('style', 'display:block');

                            $scope.ListeCompteForTransfert($("#mouvementbanciare_id_banque").val());
                        } else {
                            $('#beneficiaire_select').attr('style', 'display:none');
                            $('#beneficiaire_input').attr('style', 'display:block');
                            if ($("#type_mouvement").is(':checked') == true) {
                                //Cas du Décaissement
                                $('#ordonnance_input').attr('style', 'display:none');
                                $('#ordonnance_select').attr('style', 'display:block');
                            }
                        }
                    } else {

                        $('#beneficiaire_select').attr('style', 'display:none');
                        $('#beneficiaire_input').attr('style', 'display:block');

                        if ($("#type_mouvement").is(':checked') == true) {
                            //Cas du Décaissement $('#ordonnance_input_doc').attr('style', 'display:block');
                            $('#ordonnance_input').attr('style', 'display:none');
                            $('#ordonnance_select').attr('style', 'display:block');
                        } else {
                            //Cas de l'Encaissement
                            $('#ordonnance_select').attr('style', 'display:none');
                            $('#ordonnance_input').attr('style', 'display:block');
                        }
                    }
                }
            })
            .trigger("change");

    $scope.PushNewLigne = function (id) {

        var valide = "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'>";

        if (!$('#mouvementbanciare_id_banque').val() || $('#mouvementbanciare_id_banque').val() == 0)
            valide += "<li> un Compte</li>";
        if (id == "") {
            if ($('#reforde').val() == '' && $("#numero_doc").val() == "")
                valide += "<li> un bon de dépenses au comptant</li>";
        }

        if (!$('#mouvementbanciare_dateoperation').val())
            valide += "<li> une date</li>";
        if (!$('#mouvementbanciare_id_object').val())
            valide += "<li> un objet de règlement</li>";

        if ($('#refbeni').val() == '' && $('#mouvementbanciare_id_object').val() == 1)
            valide += "<li> un bénéficiaire</li>";

        valide += "</ul>";

        var nbr = eval($('#current_operation').val()) + 1;

        if (valide == "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'></ul>") {
            $scope.listes_operations.push({
                'nb': nbr,
                'id_banque': $('#mouvementbanciare_id_banque').val(),
                'reford': $('#reforde').val(),
                'reford_id': $('#reforde_id').val(),
                'numero_doc': $('#numero_doc').val(),
                'id_documentachat': $('#mouvementbanciare_id_documentachat').val(),
                'flag_documentachat': $('#type_mouvement').is(':checked'),
                'id_object': $('#mouvementbanciare_id_object').val(),
                'id_banque_cible': $('#id_banque_cible').val(),
                'nomoperation': $('#mouvementbanciare_nomoperation').val(),
                'refbenifi': $('#refbeni').val(),
                'refinstrument': $('#mouvementbanciare_referenceautre').val(),
                'debit': $('#val_debit').val(),
                'credit': $('#val_credit').val(),
                'solde': "",
                'dateoperation': $('#mouvementbanciare_dateoperation').val(),
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

    $scope.PushNewLigneBDCG = function () {
        var valide = "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'>";
        if (!$('#mouvementbanciare_id_banque').val() || $('#mouvementbanciare_id_banque').val() == 0)
            valide += "<li> un Compte</li>";
        if ($('#reforde').val() == '')
            valide += "<li> un bon de dépenses au comptant</li>";
        if (!$('#mouvementbanciare_dateoperation').val())
            valide += "<li> une date</li>";
        if (!$('#mouvementbanciare_id_object').val())
            valide += "<li> un objet de règlement</li>";
        if ($('#refbeni').val() == '')
            valide += "<li> un bénéficiaire</li>";

        valide += "</ul>";

        var nbr = eval($('#current_operation').val()) + 1;

        if (valide == "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'></ul>") {
            $scope.listes_operations.push({
                'nb': nbr,
                'id_banque': $('#mouvementbanciare_id_banque').val(),
                'reford': $('#reforde').val(),
                'id_documentachat': $('#mouvementbanciare_id_documentachat').val(),
                'flag_documentachat': $('#type_mouvement').is(':checked'),
                'id_object': $('#mouvementbanciare_id_object').val(),
                'id_banque_cible': $('#id_banque_cible').val(),
                'nomoperation': $('#mouvementbanciare_nomoperation').val(),
                'refbenifi': $('#refbeni').val(),
                'refinstrument': $('#mouvementbanciare_referenceautre').val(),
                'debit': $('#val_debit').val(),
                'credit': $('#val_credit').val(),
                'solde': "",
                'dateoperation': $('#mouvementbanciare_dateoperation').val(),
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
            } else {
                if (comArr[i].debit != "" && comArr[i].debit > 0) {
                    $scope.listes_operations[i].solde = $scope.listes_operations[i - 1].solde - parseFloat(comArr[i].debit);
                }
                if (comArr[i].credit != "" && comArr[i].credit > 0) {
                    $scope.listes_operations[i].solde = $scope.listes_operations[i - 1].solde + parseFloat(comArr[i].credit);
                }
            }
        }
    }
    $scope.SaveOperations = function () {

        $scope.param = {
            'operations': $scope.listes_operations,
            'id_doc': $('#id_doc').val(),
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/Savemouvement',
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

    $scope.SaveOperationsBDCReg = function () {
        $scope.param = {
            'operations': $scope.listes_operations,
            'id_doc': $('#id_doc').val(),
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/SavemouvementBDCReg',
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
    $scope.ViderLigne = function () {
        $('#idformulaire input:text').val('');
        $('#idformulaire select').val('');
        $('#idformulaire_tva input:text').val('');
        $('#idformulaire select').trigger("chosen:updated");
    }
    $scope.Supprimer = function (nb) {
        var nbcom = nb + 0.1;
        console.log(nb + ',' + nbcom);
        var index = -1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].nb) + '-' + parseFloat(nb));
            if (parseFloat(comArr[i].nb) - parseFloat(nb) === 0) {
                index = i;
                break;
            }
        }

        console.log(index);
        $scope.listes_operations.splice(index, 1);
        var nbr = eval($('#current_operation').val()) - 1;
        $('#current_operation').val(nbr);
        $scope.OrganiserTable();
        $scope.CalculSolde();
    }

    $scope.OrganiserTable = function () {
        var ligne = eval($('#last_operation').val()) + 1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            comArr[i].nb = ligne;
            ligne++;
        }
    }

    $scope.ListeBonDepenseComptant = function (id) {
        //        console.log('id=' + id);
        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/ListeBonDepenseComptant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0)
                $scope.ChargerCombo('#mouvementbanciare_id_documentachat', data);
            else {
                $('#mouvementbanciare_id_documentachat').empty();
                $('#mouvementbanciare_id_documentachat').val('').trigger("liszt:updated");
                $('#mouvementbanciare_id_documentachat').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.AfficheBondepens = function (id) {
        console.log('idtesttttt=' + id);
        $scope.param = {
            'idbanque': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/ListeBonDepenseComptant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0)
                $scope.ChargerCombo('#mouvementbanciare_id_documentachat', data);
            else {
                $('#mouvementbanciare_id_documentachat').empty();
                $('#mouvementbanciare_id_documentachat').val('').trigger("liszt:updated");
                $('#mouvementbanciare_id_documentachat').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    $("#type_mouvement")
            .change(function () {
                if ($("#type_mouvement").is(':checked') == true) {
                    if ($("#mouvementbanciare_id_object").val() == "4") {
                        //Cas du Transfert
                        $('#ordonnance_select').attr('style', 'display:none');
                        $('#ordonnance_input').attr('style', 'display:block');
                    } else {
                        //Décaissement
                        $('#ordonnance_input').attr('style', 'display:none');
                        $('#ordonnance_select').attr('style', 'display:block');
                    }
                    //Activer débit & désactver crédit
                    $('#val_credit').val('');
                    $('#val_credit').attr('readonly', 'true');
                    $('#val_debit').removeAttr('readonly');
                } else {
                    //Encaissement
                    $('#ordonnance_select').attr('style', 'display:none');
                    $('#ordonnance_input').attr('style', 'display:block');

                    //Activer crédit & désactver débit
                    $('#val_debit').val('');
                    $('#val_debit').attr('readonly', 'true');
                    $('#val_credit').removeAttr('readonly');
                }

                $('#reforde').val('');
                $('#refbeni').val('');

                $scope.ViderLigne();
            })

    $("#mouvementbanciare_id_documentachat")
            .change(function () {
                if ($("#mouvementbanciare_id_documentachat").val() != "" && $("#mouvementbanciare_id_documentachat").val() != "0") {
                    $scope.TestExistanceCertificat($("#mouvementbanciare_id_documentachat").val());
                    //                    $scope.DetailsBonDepensesComptant($("#mouvementbanciare_id_documentachat").val());
                }
            })

    $scope.DetailsBonDepensesComptant = function (id) {
        $('#ordonnance_select').attr('style', 'display:block');
        $('#ordonnance_input').attr('style', 'display:none');

        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/DetailsBonDepensesComptant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;

            $scope.detailBonDepenses = data[0];

            $scope.numero.text = data[0]['numero'];
            $scope.fournisseur_rs.text = data[0]['fournisseur_rs'];
            $scope.mnt.text = data[0]['mnt'];
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.TestExistanceCertificat = function (id) {

        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/TestExistantccertificat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log(data.length + 'existance certif bdc');
            if ($("#mouvementbanciare_id_documentachat").val() != null) {
                if (data.length == 0) {
                    $scope.DetailsBonDepensesComptant($("#mouvementbanciare_id_documentachat").val());
                } else {
                    data = response.data[0];
                    if ($('#typebdcr').val() == 'BDCG')
                        $scope.DetailsOrdonnanceCrtifieBDCReg($("#mouvementbanciare_id_documentachat").val(), data['id'], id);
                    else
                        $scope.DetailsOrdonnanceCrtifie($("#mouvementbanciare_id_documentachat").val(), data['id'], id);
                }
            } else {
                $scope.DetailsOrdonnanceCrtifie(id, data[0]['id'], id);
                if ($('#typebdcr').val() == 'BDCG')
                    $scope.DetailsOrdonnanceCrtifieBDCReg(id, data[0]['id'], id);
                else
                    $scope.DetailsOrdonnanceCrtifie(id, data[0]['id'], id);
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.DetailsOrdonnanceCrtifieBDCReg = function (id, id_certif, id_docbudget) {

        $scope.param = {
            'id': id,
            'id_certif': id_certif,
            'id_docbudget': id_docbudget,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/DetailsOrdonnanceCertifieReg',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            var total_retenue = 0;
            var mont_debit = 0;
            var fournisseur = '';
            var rib_fournisseur = '';
            var factures = '';
            for (var i = 0; i < data.length; i++) {
                $scope.detailOrdonnance = data[i];
                mont_debit = mont_debit + parseFloat($scope.detailOrdonnance.montant_ordonnancenet);
                total_retenue = total_retenue + parseFloat($scope.detailOrdonnance.mnt_retenue);
                fournisseur = fournisseur + '*******' + $scope.detailOrdonnance.fournisseur_rs;
                rib_fournisseur = rib_fournisseur + $scope.detailOrdonnance.fournisseur_rib;
                factures = factures + '*******' + $scope.detailOrdonnance.numerofac;

                $scope.numero.text = $scope.detailOrdonnance.numero;

                //                $scope.fournisseur_rs.text = $scope.detailOrdonnance.fournisseur_rs;
                //                $scope.fournisseur_rib.text = $scope.detailOrdonnance.fournisseur_rib;
                $('#certificat').attr('style', 'display:block');
                $('#val_certificat_tva').val($scope.detailOrdonnance.mnt_retenuetva);
            }
            $('#val_certificat').val(parseFloat(total_retenue).toLocaleString());
            $('#val_debit').val(parseFloat(mont_debit).toLocaleString());
            $('#val_debit').val(parseFloat(mont_debit).toLocaleString());
            //            $('#factures').val(factures);
            $('#refbeni').val(fournisseur);
            $scope.afficheslistedesFactures(id);
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.afficheslistedesFactures = function (id) {
        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'tresorie.php/mouvementbanciare/DetailslistesFactures',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            var factures = '';
            for (var i = 0; i < data.length; i++) {
                $scope.detailOrdonnance = data[i];
                factures = factures + '---' + $scope.detailOrdonnance.name;
            }
            $('#factures').val(factures);
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
            url: domaineapp + 'tresorie.php/mouvementbanciare/DetailsOrdonnanceCertifie',
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
            $('#certificat').attr('style', 'display:block');
            $('#val_certificat').val($scope.detailOrdonnance.mnt_retenue);

            $('#val_certificat_tva').val($scope.detailOrdonnance.mnt_retenuetva);
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.ListeCompteForTransfert = function (id_banque) {
        //        console.log('id=' + id_banque);
        $scope.param = {
            'idbanque': id_banque,
        }
        $http({
            url: domaineapp + 'tresorie.php/caissesbanques/ListeCompteForTransfert',
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
                    $('#refbeni').val(beneficiaire);
                } else {
                    $('#refbeni').val('');
                }
            })
            .trigger("change");

});