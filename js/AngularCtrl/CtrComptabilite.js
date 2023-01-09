var domaineapp = 'http://' + window.location.hostname + '/';

app.controller('myCtrlPaysVille', function ($scope, $http) {

    $scope.SaveNote = function () {
        var content = $("#editor1").html();
        content = content.replace(/&nbsp;/g, " ");
        $scope.param = {
            'content': content
        }
        $http({
            url: domaineapp + 'comptabilite.php/fiche_Bilan/saveNote',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            bootbox.dialog({
                message: "<h4 style='color:#4844bd;'>Paramètre enregistré avec succès !</h4>",
                buttons: {
                    "button": {
                        "label": "Fermer",
                        "className": "btn-sm"
                    }
                }
            });


        }, function myError(response) {
            alert(response);
        });
    }
    $scope.calculcontrole = function () {
        var total_courant_actif = parseFloat($('#total_courant_actif').val());
        var total_courant_passif = parseFloat($('#total_courant_passif').val());
        var controle_courant = total_courant_passif - total_courant_actif;
        $('#controle_courant').val(parseFloat(Math.abs(controle_courant)).toFixed(2));
        var total_prec_actif = $('#total_prec_passif').val();
        var total_prec_passif = $('#total_prec_actif').val();
        var controle_passif = total_prec_passif - total_prec_actif;
        $('#controle_prec').val(parseFloat(Math.abs(controle_passif)).toFixed(2));
    }
    $("#total_courant_actif") && $("#total_prec_actif") && $("#total_courant_passif") && $("#total_prec_passif")
        .change(function () {
            if (($("#total_courant_actif").val() != "" && $("#total_courant_passif").val() != "") || ($("#total_prec_actif").val() != "" && $("#total_prec_passif").val() != "")) {
                $scope.calculcontrole();
            }
        })
        .trigger("change");
    $scope.calculcontroleexercicenet = function () {

        var resultat_exercice_courant = $('#resultat_exercice_courant').val();
        var total_exercie_courant = $('#total_exercie_courant').val();
        var controle_exrcice_courant = resultat_exercice_courant - total_exercie_courant;
        $('#controle_exercice_courant').val(parseFloat(Math.abs(controle_exrcice_courant)).toFixed(3));
        var resultat_exercice_prec = $('#resultat_exercice_prec').val();
        var total_exercie_prec = $('#total_exercie_prec').val();
        var controle_exrcice_prec = resultat_exercice_prec - total_exercie_prec;

        $('#controle_exercice_prec').val(parseFloat(Math.abs(controle_exrcice_prec)).toFixed(3));


    }
    $("#resultat_exercice_courant") && $("#total_exercie_courant") && $("#resultat_exercice_prec") && $("#total_exercie_prec")
        .change(function () {

            if (($("#resultat_exercice_courant").val() != "" && $("#total_exercie_courant").val() != "") || ($("#resultat_exercice_prec").val() != "" && $("#total_exercie_prec").val() != "")) {
                $scope.calculcontroleexercicenet();
            }

        })
        .trigger("change");

    $scope.calculcontroleexercicenetGeneral = function () {

        var resultat_exercice_courant = $('#resultat_exercice_courant_general').val();
        var total_exercie_courant = $('#total_exercie_courant_general').val();

        var controle_exrcice_courant = parseFloat(resultat_exercice_courant) + parseFloat(total_exercie_courant);
        //         alert(parseFloat(resultat_exercice_courant)+parseFloat(total_exercie_courant));
        $('#controle_exercice_courant').val(parseFloat(Math.abs(controle_exrcice_courant)).toFixed(3));
        var resultat_exercice_prec = $('#resultat_exercice_prec_general').val();
        var total_exercie_prec = $('#total_exercie_prec_general').val();
        var controle_exrcice_prec = parseFloat(resultat_exercice_prec) + parseFloat(total_exercie_prec);

        $('#controle_exercice_prec').val(parseFloat(Math.abs(controle_exrcice_prec)).toFixed(3));


    }
    $("#resultat_exercice_courant_general") && $("#total_exercie_courant_general") && $("#resultat_exercice_prec_general") && $("#total_exercie_prec_general")
        .change(function () {

            if (($("#resultat_exercice_courant_general").val() != "" && $("#total_exercie_courant_general").val() != "") || ($("#resultat_exercice_prec_general").val() != "" && $("#total_exercie_prec_general").val() != "")) {
                $scope.calculcontroleexercicenetGeneral();
            }

        })
        .trigger("change");

    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

    $scope.getPiececomptable = function () {
        var id_journal = $('#journal_comptable').val();
        $scope.param = {
            'id_journal': id_journal
        }
        $http({
            url: domaineapp + 'comptabilite.php/saisie_pieces/afficherpiececomptable',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data && data != 0 && data != 'undefined') {
                $scope.ChargerCombo('#numero_min', data);
                $('#numero_min').val(data);
                $('#numero_min').trigger("chosen:updated");
                $scope.ChargerCombo('#numero_max', data);
                $('#numero_max').val(data);
                $('#numero_max').trigger("chosen:updated");
            } else {
                $('#numero_min').val('').trigger("liszt:updated");
                $('#numero_min').trigger("chosen:updated");
                $('#numero_max').val('').trigger("liszt:updated");
                $('#numero_max').trigger("chosen:updated");
                //                $('#numero_min').val('');
                //                $('#numero_min').trigger("chosen:updated");
                //
                //                $('#numero_max').val('');
                //                $('#numero_max').trigger("chosen:updated");
            }
        }, function myError(response) {
            alert(response);
        });
    }

    $("#journal_comptable")
        .change(function () {
            if ($("#journal_comptable").val() != "-1") {
                $scope.getPiececomptable();
            } else {
                $scope.ChargerCombo('#numero_max', '');
                $scope.ChargerCombo('#numero_min', '');
                $('#numero_min').val('').trigger("liszt:updated");
                $('#numero_min').trigger("chosen:updated");
                $('#numero_max').val('').trigger("liszt:updated");
                $('#numero_max').trigger("chosen:updated");
                //                    $('#numero_min').val('');
                //                    $('#numero_min').trigger("chosen:updated");

                //                    $('#numero_max').val('');
                //                    $('#numero_max').trigger("chosen:updated");
            }

        })
        .trigger("change");

    $scope.affecterexercice = function () {
        var code = $('#dernier_dossier').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'comptabilite.php/plan_comptable/affecterexercice',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data && data != 0) {
                $('#dernier_exercice').val(data['id']);

            }


        }, function myError(response) {
            alert(response);
        });

    }
    $("#dernier_dossier")
        .change(function () {

            if ($("#dernier_dossier").val() != "") {
                $scope.affecterexercice();
            }

        })
        .trigger("change");

    $scope.affecterexerciceCourant = function () {
        var code = $('#courant_dossier').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'comptabilite.php/plan_comptable/affecterexercice',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data && data != 0) {
                $('#courant_exercice').val(data['id']);

            }


        }, function myError(response) {
            alert(response);
        });

    }
    $("#courant_dossier")
        .change(function () {

            if ($("#courant_dossier").val() != "") {
                $scope.affecterexerciceCourant();
            }

        })
        .trigger("change");
    /*contrle eta resultat de eta sig*/

    $scope.calculcontroleexercicenetetatsig = function () {

        var resultat_exercice_courant = $('#resultat_exercice_sig_courant').val();
        var total_exercie_courant = $('#total_exercie_sig_courant').val();
        var controle_exrcice_courant = resultat_exercice_courant - total_exercie_courant;
        $('#controle_exercice_sig_courant').val(parseFloat(Math.abs(controle_exrcice_courant)).toFixed(3));
        var resultat_exercice_prec = $('#resultat_exercice_sig_prec').val();
        var total_exercie_prec = $('#total_exercie_sig_prec').val();
        var controle_exrcice_prec = resultat_exercice_prec - total_exercie_prec;

        $('#controle_exercice_sig_prec').val(parseFloat(Math.abs(controle_exrcice_prec)).toFixed(3));


    }
    $("#resultat_exercice_sig_courant") && $("#total_exercie_sig_courant") && $("#resultat_exercice_sig_prec") && $("#total_exercie_sig_prec")
        .change(function () {

            if (($("#resultat_exercice_sig_courant").val() != "" && $("#total_exercie_sig_courant").val() != "") || ($("#resultat_exercice_sig_prec").val() != "" && $("#total_exercie_sig_prec").val() != "")) {
                $scope.calculcontroleexercicenetetatsig();
            }

        })
        .trigger("change");
    $scope.InialiserPopup = function () {

        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    //existnce de maquette 
    $scope.TestExistanceMaquette = function () {
        var code = $('#code_maquette').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'comptabilite.php/maquette_saisie/testexistancemaquette',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data && data != 0) {
                $('#code_maquette').val(data['code']);
                $('#id_maquette').val(data['id']);
                $('#code_maquette').val('');
                alert('cette Maquette est déja existant !!');
            }


        }, function myError(response) {
            alert(response);
        });
    }
    $("#code_maquette")
        .change(function () {

            if ($("#code_maquette").val() != "") {
                $scope.TestExistanceMaquette();
            }

        })
        .trigger("change");

    //tester le numero externe 

    $scope.affichersolde = function () {
        //        alert('12222');
        //        alert(id);
        //        $scope.param = {
        ////            'id': id
        //        }
        //        $http({
        //            url: domaineapp + 'comptabilite.php/saisie_pieces/affichersolde',
        //            method: "POST",
        //            data: $scope.param,
        //            headers: {
        //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        //            }
        //        }).then(function mySucces(response) {
        //            data = response.data[0];
        //            if (data != 0) {
        //            
        //                $('#solde').val(data['soldeouv'] - data['solde']);
        //                $('#type_solde').val(data['typesolde']);
        //            }
        //
        //
        //        }, function myError(response) {
        //            alert(response);
        //        });
    }
    //exisitnce journal
    $scope.TestExistanceJournal = function () {
        var code = $('#code_comptable').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'comptabilite.php/journal/testexistancejournal',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data != 0) {
                $('#code_comptable').val(data['code']);
                $('#id_comptable').val(data['id']);
                $('#code_comptable').val('');

                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Cette Journal comptable  existe déjà !</span>",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }


        }, function myError(response) {
            alert(response);
        });
    }
    $("#code_comptable")
        .change(function () {

            if ($("#code_comptable").val() != "") {
                $scope.TestExistanceJournal();
            }

        })
        .trigger("change");

    //existance de matricule 
    $scope.TestExistanceidrhcomptabilite = function () {
        var agent_idrh = $('#matricule').val();
        $scope.param = {
            'idrh': agent_idrh

        }
        $http({
            url: domaineapp + 'comptabilite_dev.php/agents/testidrh',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#cin').val(data['cin']);
            $('#matricule_popup').addClass("disabledbutton");
            $('#matricule_popup').val(data['idrh']);
            $('#cin_popup').val(data['cin']);
            $('#cin_popup').addClass("disabledbutton");
            alert("");
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Cette Matricule existe déjà !! !</span>",
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
    $("#matricule")
        .change(function () {
            if ($("#cin").val() != "" && $("#matricule").val() != "") {
                ($("#btn_ajoutuser")).removeClass("disabledbutton");
            } else {
                ($("#btn_ajoutuser")).addClass("disabledbutton");
            }
            if ($("#cin").val() == "") {
                if ($("#matricule").val() != "") {
                    $scope.TestExistanceidrhcomptabilite();
                    $scope.InialiserChampsPopup();
                } else {
                    $('#matricule_popup').val("");
                    $('#cin_popup').val("");
                    $('#matricule_popup').removeClass("disabledbutton");
                    $('#cin_popup').removeClass("disabledbutton");
                }
            }

        })
        .trigger("change");
    //************////
    //******existnce cin 
    $scope.TestExistance = function () {
        var agent_cin = $('#cin').val();
        $scope.param = {
            'cin': agent_cin
        }
        $http({
            url: domaineapp + 'comptabilite.php/agents/testcin',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#matricule').val(data['idrh']);
            $('#matricule_popup').addClass("disabledbutton");
            $('#matricule_popup').val(data['idrh']);
            $('#cin_popup').val(data['cin']);
            $('#cin_popup').addClass("disabledbutton");
            alert("CIN existe déjà !!");
            $scope.InialiserChampsPopup();
        }, function myError(response) {
            alert(response);
        });
    }
    $("#cin")
        .change(function () {
            if ($("#matricule").val() == "") {
                if ($("#cin").val() != "") {
                    $scope.TestExistance();
                    $scope.InialiserChampsPopup();
                } else {
                    $('#matricule_popup').val("");
                    $('#cin_popup').val("");
                    $('#matricule_popup').removeClass("disabledbutton");
                    $('#cin_popup').removeClass("disabledbutton");
                }
            }

        })
        .trigger("change");
    //*************//
    $("#cin")
        .change(function () {

            if ($("#cin").val() != "" && $("#matricule").val() != "") {
                ($("#btn_ajoutuser")).removeClass("disabledbutton");
                $("#matricule_popup").val($("#matricule").val());
                $("#cin_popup").val($("#cin").val());
            }

        })
        .trigger("change");
    $("#matricule")
        .change(function () {

            if ($("#cin").val() != "" && $("#matricule").val() != "") {
                ($("#btn_ajoutuser")).removeClass("disabledbutton");
                $("#matricule_popup").val($("#matricule").val());
                $("#cin_popup").val($("#cin").val());
            }

        })
        .trigger("change");
    $scope.InialiserChampsPopup = function () {
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.InialiserChampsSelect = function () {

        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
        $("#pays").change(function () {
            //            console.log('init function click pays' + $("#pays").val());
            if ($("#pays").val() && $("#pays").val() != "") {
                var id = $("#pays").val();
                $scope.InialiserCombo(id);
            }
        })
            .trigger("change");
    }
    $scope.InialiserCombo = function () {

        //        $scope.param = {
        //            'id': id
        //        }

        //        $http({
        //            url: domaineapp + 'comptabilite.php/dossier/Villepayschoisi',
        //            method: "POST",
        //            data: $scope.param,
        //            headers: {
        //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        //            }
        //        }).then(function mySucces(response) {
        //            data = response.data;
        //
        ////            $scope.ChargerCombo('#ville', data);
        ////            $("#ville").val('');
        ////            $('#ville').trigger("chosen:updated");
        //
        //        }, function myError(response) {
        //            alert("Erreur ....");
        //        });
    }




    //charger les contre partie aprtir du type journal
    $scope.ChargerDetailContreparite = function () {
        var id_type = $('#type_journal').val();
        $scope.param = {
            'id_typejournal': id_type
        }
        $http({
            url: domaineapp + 'comptabilite.php/journal/afficheContrepartie',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#contre_partie', data);
            $('#contre_partie').val(data);
            $('#contre_partie').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#type_journal")
        .change(function () {
            if ($("#type_journal").val() == "1" || $("#type_journal").val() == "2" || $("#type_journal").val() == "3") {
                //                   $scope.ChargerDetailContreparite();
            }
        })
        .trigger("change");
    // ********************** fin charger contre partie        
    //ctr sil existe le code du dossier 
    $scope.TestExistanceDossiercomptable = function () {
        var code = $('#code_dossier').val();
        $scope.param = {
            'code': code
        }
        $http({
            url: domaineapp + 'comptabilite.php/dossier/testcodedossiercomptable',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data != null) {
                //              $('#code').val(data['code']);
                $('#id_dossier').val(data['id']);
                $('#code_dossier').val('');

                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Ce Dossier Comptable existe déjà !</span>",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });

            } else {
            }

        }, function myError(response) {
            alert(response);
        });
    }
    $("#code_dossier")
        .change(function () {
            if ($("#code_dossier").val() != "") {
                $scope.TestExistanceDossiercomptable();
            }

        })
        .trigger("change");



    //charger la periode d'exercice

    $scope.Affichedetailexercie = function () {
        var id_exercie = $('#exercice').val();
        var date_debut = id_exercie + '-01-01';
        var date_fin = id_exercie + '-12-31';

        $('#date_debut_ouverture').val(date_debut);
        $('#date_fin_fermeture').val(date_fin);
        //        $scope.param = {
        //            'id_exercie': id_exercie
        //        }
        //        $http({
        //            url: domaineapp + 'comptabilite.php/dossier/affichedetailexercice',
        //            method: "POST",
        //            data: $scope.param,
        //            headers: {
        //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        //            }
        //        }).then(function mySucces(response) {
        //            if (data= 'undefined') {
        //                data = response.data[0];
        //                $('#date_debut_ouverture').val(data['dated']);
        //                $('#date_fin_fermeture').val(data['datef']);
        //            }
        //            else {
        //                
        //            }
        //        }, function myError(response) {
        //            alert(response);
        //        });
    }
    $("#exercice")
        .change(function () {
            if ($("#exercice").val() != "") {
                $scope.Affichedetailexercie();
            }
        })
        .trigger("change");
    //matricule fiscale 
    var arr = [13];
    var registre = '';
    $("#matricule_fiscale")
        .change(function () {
            $("#registre_commerce").val('');
            if ($("#matricule_fiscale").val() != "") {
                registre = '';
                arr = $("#matricule_fiscale").val();
                for (var i = 0; i <= 7; i++)
                    registre = registre + arr[i];
                $("#registre_commerce").val(registre);

            } else {
                $("#registre_commerce").val('');
                arr = [];
                registre = '';
            }
        })
        .trigger("change");

    //ajout forme juridique aprtir popup

    //    $scope.ajouterFormeJuridique = function () {
    //        $scope.param = {
    //            'libelle': $('#libelle').val(),
    //        }
    //        $http({
    //            url: domaineapp + 'comptabilte.php/dossier/saveforme',
    //            method: "POST",
    //            data: $scope.param,
    //            headers: {
    //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //            }
    //        }).then(function mySucces(response) {
    //            data = response.data;
    //            alert(data[0])
    //            $scope.ChargerCombo('#forme_juridique', data);
    //            $('#forme_juridique').val(data);
    //            $('#forme_juridique').trigger("chosen:updated");
    ////                location.reload();
    //            $scope.InaliserChampsPopup();
    //
    //        }, function myError(response) {
    //            alert("Erreur d'ajout");
    //        });
    //    }
    /////
    $scope.InaliserChampsPopup = function () {
        $('#libelle').val('');
    }
    $scope.chargernbravantage = function () {
        var dateenproduction = $('#dateentreenproduction').val();
        var datefinavantage = $('#datefinavantage').val();

        var d2 = new Date(datefinavantage);
        var d1 = new Date(dateenproduction)
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
        var nbrannee = DateDiff.inYears(d1, d2);
        $('#nbravantage').val(nbrannee);

    }

    $("#dateentreenproduction")
        .change(function () {
            if ($("#dateentreenproduction").val() != "" && $("#datefinavantage").val() != "") {
                $scope.chargernbravantage();
            } else {
                $('#nbravantage').val("");
            }
        })
        .trigger("change");

    $("#datefinavantage")
        .change(function () {
            if ($("#datefinavantage").val() != "" && $("#dateentreenproduction").val() != "") {
                $scope.chargernbravantage();
            } else {
                $('#nbravantage').val("");
            }
        })
        .trigger("change");
});

app.controller('myCtrlChangerExercice', function ($scope, $http) {

    $scope.InialiserChampsSelect = function () {

        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
        $('#exercice_courant_menu').trigger("chosen:updated");
        $('#id_typeregime').trigger("chosen:updated");
        $('#regime').trigger("chosen:updated");

    }
});

app.controller('myCtrlCompteComptable', function ($scope, $http) {
    console.log('Ctrlcompta');
    $scope.compte_select_for_plan = { text: '' };
    $scope.journal_option = { text: '' };
    $scope.nature_piece_option_edit = { text: '' };
    $scope.InitisilerNaturepiece = function () {
        $('#nature_piece').val('7');
        $('#nature_piece').trigger("liszt:updated");
        $('#nature_piece').trigger("chosen:updated");
        $('#nature_piece_option').val('Facture');

    }
    $scope.TestExistanceNumeroexterne = function () {
        var numero_externe = $('#numero_externe').val();
        var id_journal = $('#journal_id').val();
        var serie_id = $('#serie_id').val();

        $scope.param = {
            'numero_externe': numero_externe,
            'id_journal': id_journal,
            'serie_id': serie_id
        }
        $http({
            url: domaineapp + 'comptabilite.php/saisie_pieces/testexistanceNumeroexterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data && data != 0) {
                //                $('#code_maquette').val(data['code']);
                //                $('#id_maquette').val(data['id']);
                //                $('#code_maquette').val('');

                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Ce Numero externe  existe déjà !</span>",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }


        }, function myError(response) {
            alert(response);
        });
    }
    $("#numero_externe")
        .change(function () {

            if ($("#numero_externe").val() != "" && $('#journal_id').val() != "" && $('#detail_piece_id').val() == '') {
                $scope.TestExistanceNumeroexterne();
            }

        })
        .trigger("change");

    //cahrger le journal & nature piece form edit 

    $scope.InitisilerNaturepieceEtJournal = function (id_journal, id_naturepiece) {
        console.log('ed');  //        if (id_journal != '') {
        //            $('#journal_option').val(id_journal);
        if (id_journal != '') {
            $scope.param = {
                "id_journal": id_journal,
            }
            $http({
                url: domaineapp + 'comptabilite.php/saisie_pieces/AfficherJournal',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                //$scope.journal_option.text = data['name'];
                $('#journal_option').val(data['name']);
                $scope.InitisilerNaturepieceEdit(id_naturepiece);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }


    }
    $scope.InitisilerNaturepieceEdit = function (id_naturepiece) {
        if (id_naturepiece) {
            $scope.param = {
                "id_naturepiece": id_naturepiece,
            }
            $http({
                url: domaineapp + 'comptabilite.php/saisie_pieces/AfficherNaturePiece',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];

                //$scope.nature_piece_option_edit.text = data['name'];                
                $('#nature_piece_option_edit').val(data['name']);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });


        }


    }
    /*  */
    // change numero de compte comptable 

    $scope.testexistance = function () {
        var numero_compte = $('#compte_select').val();
        //        console.log(numero_compte);
        $scope.param = {
            'numero_compte': numero_compte

        }
        $http({
            url: domaineapp + 'comptabilite.php/plan_comptable/testexistancecompte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];

            if (data != null)
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Attention !</span><br><span class='bigger-110' style='margin:20px;color:#b31531;'>Cette compte Comptable existe déjà !</span>",
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
    $("#compte_select")
        .change(function () {
            if ($("#compte_select").val() != "") {
                numero_select = $('#compte_select').val();
                var num = numero_select.substring(0, 1);
                $('#id_compte_select').val(num);
                $scope.testexistance();
            }
        })
        .trigger("change");


    //******fin numero compte 

    $scope.AffichageCollectif = function () {
        var standard = $('#standard').val();
        if (standard == 0)
            $('#compte_standard').removeClass('disabledbutton');
        else
            $('#compte_standard').addClass('disabledbutton');
    }
    $("#standard")
        .change(function () {
            if ($("#standard").val() != "") {
                $scope.AffichageCollectif();
            }
        })
        .trigger("change");

    $scope.Choisircomptecomptable = function (id, id_hidden) {
        if ($(id).val() != '') {
            $(id_hidden).val('');
            $scope.param = {
                "numero": $(id).val()
            }
            $http({
                url: domaineapp + 'comptabilite.php/transfert/Compteparnumero',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                AjoutHtmlAfter(data, id, id_hidden);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $(id_hidden).val('');
        }
    }
    $scope.Choisirjournalcomptable = function (id, id_hidden) {
        //        $('#journal_id').val('');
        //        if ($(id).val() != '') {
        $(id_hidden).val('');
        $scope.param = {
            "numero": $(id).val()
        }
        $http({
            url: domaineapp + 'comptabilite.php/saisie_pieces/JournalParCode',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfter(data, id, id_hidden);
            //  $('#libelle_type_journal').val(data[0]['type_journal']);
            //            if ($('#journal_id').val() != '') {
            //                $scope.affichagenumeroexterne($('#journal_id').val());
            //            }



        }, function myError(response) {
            alert("Erreur d'ajout");
        });
        //        } else {
        //            $(id_hidden).val('');
        //        }
    }
//    $scope.Affichagenumeroexterne = function (id) {
//        $scope.param = {
//            "id_journal": id
//        }
//        $http({
//            url: domaineapp + 'comptabilite.php/saisie_pieces/Affichernumeroexterne',
//            method: "POST",
//            data: $scope.param,
//            headers: {
//                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
//            }
//        }).then(function mySucces(response) {
//            data = response.data;
//            console.log(data.length + 'length=');
//            if (data.length >= 1)
//                $('#numero_externe').val(data[0]['numero_externe']);
//            if (data.length == 0)
//                $('#numero_externe').val(1);
//
//
//        }, function myError(response) {
//            alert("Erreur d'ajout");
//        });
//    }
//   
    $scope.ChoisirjournalcomptableEdit = function (id, id_hidden) {
        $(id_hidden).val('');
        $scope.param = {
            "numero": $(id).val()
        }
        $http({
            url: domaineapp + 'comptabilite.php/saisie_pieces/JournalParCode',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfter(data, id, id_hidden);
            $('#libelle_type_journal').val(data[0]['type_journal']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.Choisirnaturepiece = function (id, id_hidden) {
        $scope.param = {
            "numero": $(id).val()
        }
        $http({
            url: domaineapp + 'comptabilite.php/saisie_pieces/NaturePieceParCode',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfter(data, id, id_hidden);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
        //        }

    }
    $scope.ChoisirjournalcomptableEdit = function (id, id_hidden) {
        $scope.param = {
            "numero": $(id).val()
        }
        $http({
            url: domaineapp + 'comptabilite.php/saisie_pieces/JournalParCode',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfter(data, id, id_hidden);
            $('#libelle_type_journal').val(data[0]['type_journal']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ChoisirnaturepieceEdit = function (id, id_hidden) {
        console.log('de' + id + id_hidden);
        //  $('#nature_piece_option_edit').attr('ng-controller', myCtrlCompteComptable);
        if ($(id).val() != '') {
            $(id_hidden).val('');
            $scope.param = {
                "numero": $(id).val()
            }
            $http({
                url: domaineapp + 'comptabilite.php/saisie_pieces/naturePieceParCodeEdit',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                AjoutHtmlAfter(data, id, id_hidden);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }
   
});
app.controller('CtrlUplaod', function ($scope, $http, $interval) {
    $scope.listeRef = [];
    $scope.msg = "";
    $scope.start = 0;
    $scope.AddFileUpload = function (id_dossier) {
        var file_data = document.getElementById('lib_fichier');

        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        console.log('Id Dossier=' + id_dossier);
        form_data.append('id_dossier', id_dossier);
        form_data.append('libelle', $('#libelle').val());
        var filename = $('#lib_fichier').val().replace(/.*(\/|\\)/, '');

        $scope.param = {
            'filename': filename

        }
        $.ajax({
            url: domaineapp + 'comptabilite.php/dossier/Uploaderfile',
            type: 'post',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (response) {
                var json = $.parseJSON(response);
                $scope.start = 0;
                $scope.Refrech(json);


            },
        });
    }
    $scope.Refrech = function (json) {
        var c = 0;
        console.log('refrech=' + $scope.start);
        var timer = $interval(function () {
            if ($scope.start === 0) {
                $scope.msg = json['msg'];
                $scope.listeRef.push({ 'url': json['url'], 'libelle': json['libelle'] });
                $scope.start = 1;
                c++;
            }
        }, 50);
        $('#libelle').val('');
        $('#lib_fichier').val('');
    }
    $scope.stopFight = function () {
        if (angular.isDefined(stop)) {
            $interval.cancel(stop);
            stop = undefined;
        }
    };


});
