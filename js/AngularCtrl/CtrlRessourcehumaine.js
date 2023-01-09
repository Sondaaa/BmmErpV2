var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('CtrlRessourcehumaine', function ($scope, $http) {
    $scope.codeagent = { text: "" };
    $scope.nameagnet = { text: "" };
    $scope.ficheagents = [];
    $scope.listedocsE = [];
    $scope.listedocsC = [];
    $scope.listedocsL = [];
    $scope.listedocsP = [];
    $scope.listedocsS = [];
    $scope.listedocsF = [];
    $scope.listedocsD = [];
    $scope.listedocsPrime = [];
    $scope.listedocsTaches = [];
    $scope.listesTaches = [];
    $scope.listesPromotions = [];
    $scope.listesPrimes = [];
    $scope.listedocsOuvrier = [];
    $scope.listedocsCopie = [];
    $scope.listesSalairedebase = [];
    $scope.listeTauxSociale = [];
    $scope.listeContribitionPatronale = [];
    $scope.mt = 0;

    //affichage taux code sociale apartir code ociale fiche contrat
    $scope.AfficherTauxcodesociale = function () {
        var id_code = $("#contrat_id_codesociale").val();
        $scope.param = {
            "id_code": id_code,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheListelignecodesociale',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listeTauxSociale = data;
            $('#contrat_id_lignecodesociale').removeClass('disabledbutton');
            $scope.ChargerComboSelected('#contrat_id_lignecodesociale', data);
            $scope.calculTotalTauxcotisation();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $("#contrat_id_codesociale")
        .change(function () {
            if ($("#contrat_id_codesociale").val() != "") {
                $("#tauxsociale").removeClass('disabledbutton');
                $scope.AfficherTauxcodesociale();
            } else {
                $("#tauxsociale").addClass('disabledbutton');
                $('#contrat_id_lignecodesociale').val("");
                $('#contrat_id_lignecodesociale').trigger("chosen:updated");
            }
        })
        .trigger("change");
    $scope.AfficherTauxcontribition = function () {
        var id_code = $("#contrat_id_contribiton").val();
        $scope.param = {
            "id_code": id_code,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheListelignecontribition',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listeContribitionPatronale = data;
            $('#contribiton').removeClass('disabledbutton');
            $scope.ChargerComboSelected('#contrat_id_lignecontribition', data);
            $scope.calculTotalTauxcotisation();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $("#contrat_id_contribiton")
        .change(function () {
            if ($("#contrat_id_contribiton").val() != "") {
                $("#contribiton").removeClass('disabledbutton');
                $scope.AfficherTauxcontribition();
            } else {
                $("#contribiton").addClass('disabledbutton');
                $('#contrat_id_lignecontribition').val("");
                $('#contrat_id_lignecontribition').trigger("chosen:updated");
            }
        })
        .trigger("change");
    $scope.ChargerComboSelected = function (id, data) {
        $(id).empty();

        if (data.length > 1)
            $(id).append("<option value='0'></option>");
        var selected = '';
        for (i = 0; i < data.length; i++) {
            if (i == 0)
                selected = 'selected="true"';
            else
                selected = '';
            $(id).append("<option " + selected + " value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        if (data.length >= 1) {
            $(id).val(data[0].id).trigger("liszt:updated");
            $(id).trigger("chosen:updated");
        } else {
            $(id).val('').trigger("liszt:updated");
            $(id).trigger("chosen:updated");
        }

    }
    //charger deate naissance pour ouvirer 

    $scope.calculTotalTauxcotisation = function () {
        var id_ligne = $('#contrat_id_lignecontribition').val();
        var id_codesoc = $("#contrat_id_lignecodesociale").val();
        var total = 0;
        var comArr = eval($scope.listeTauxSociale);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].id - id_codesoc === 0) {
                total = comArr[i].taux;
            }
        }
        var comArr1 = eval($scope.listeContribitionPatronale);
        for (var i = 0; i < comArr1.length; i++) {
            if (comArr1[i].id - id_ligne === 0) {
                total = parseFloat(total) + parseFloat(comArr1[i].taux);
            }
        }
        $("#contrat_totaltauxsociale").val(parseFloat(total).toFixed(2));
    }
    $("#contrat_id_lignecodesociale")
        .change(function () {
            if ($("#contrat_id_lignecodesociale").val() != "0") {
                $scope.calculTotalTauxcotisation();
            }
        })
        .trigger("change");
    $("#contrat_id_lignecontribition")
        .change(function () {
            if ($("#contrat_id_lignecontribition").val() != "0") {
                $scope.calculTotalTauxcotisation();
            }
        })
        .trigger("change");


    $scope.ModifierRegime = function (id) {
        var nbrheure = $('#nbrheue').val();
        var total = $('#total').val();
        if (total == nbrheure) {
            var heure_jours = '';
            $('[name="jour_heure"]').each(function () {
                heure_jours = heure_jours + $(this).val() + ',';
            });
            var jourr = '';
            $('[name="jourr"]').each(function () {
                jourr = jourr + $(this).is(':checked') + ',';
            });
            var jour = '';
            $('[name="jour"]').each(function () {
                jour = jour + $(this).val() + ',';
            });

            $scope.param = {
                "heure_jours": heure_jours,
                "id": id,
                "jour": jour,
                "jourr": jourr,
            }
            $http({
                url: domaineapp + 'Ressourcehumaine.php/regimehoraire/editRegime',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: "mise à jour  avec succes!!",
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
        } else {
            alert("veuillez Verifier la somme ! Il doit être égale au nombre d'heure du régime choisi !");
        }

    }
    //initialiser
    $scope.initialiserRegime = function () {
        var id = $('#id_regime').val();
        $scope.param = {
            "id": id,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/regimehoraire/afficherRegime',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            for (var i = 0; i < data.length; i++) {
                var j = parseInt(i) + parseInt(1);
                $('#nbrheur_' + j).val(data[i]['nbrheuret']);
                if (data[i]['jourrepos'] == true) {
                    $('#jr_' + j).attr('checked', 'true');
                    $('#nbrheur_' + j).addClass("disabledbutton");
                } else {
                    $('#jr_' + j).removeAttr('checked');
                    $('#nbrheur_' + j).removeClass("disabledbutton");
                }
            }

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ChargerDetailDateNaissanceByOuvrier = function () {
        var id_ouvrier = $('#contratouvrier_id_ouvrier').val();
        $scope.param = {
            'id_ouvrier': id_ouvrier
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/AffichedetailDatenaissanceOuvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#datenaissance').val(data['datenaissance']);
            if ($("#datenaissance").val() != "" && $("#contratouvrier_daterecrutement").val() != "") {
                $scope.ChargerDateRetraiteOuvrier();
            } else {
                $('#datenaissance').val(data['datenaissance']);
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contratouvrier_id_ouvrier")
        .change(function () {
            if ($("#contratouvrier_id_ouvrier").val() != "") {
                $scope.ChargerDetailDateNaissanceByOuvrier();
            } else {
                $('#datenaissance').val("");
            }
        })
        .trigger("change");
    //charger date retraite pour l'ouvrier
    $scope.initialiserageretraite = function () {
        $('#contratouvrier_id_retraite').val(1);
        $('#contratouvrier_id_retraite').trigger("chosen:updated");
    }
    //cahrger retraite pour le personnel
    $scope.initialiserageretraiteAgents = function () {
        $('#contrat_id_retratite').val(2);
        $('#contrat_id_retratite').trigger("chosen:updated");

        $('#contrat_id_contribiton').val(1);
        $('#contrat_id_contribiton').trigger("chosen:updated");
        $scope.AfficherTauxcontribition();
        //        $('#contrat_id_lignecontribition').val(1);
        //        $('#contrat_id_lignecontribition').trigger("chosen:updated");
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/Afficheregimepardefaut',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#id_regime').val(data['id_regime']);
            var id_regime = $('#id_regime').val();
            $('#contrat_id_regime').val(id_regime);
            $('#contrat_id_regime').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.ChargerDateRetraiteOuvrier = function () {
        var id_retraite = $('#contratouvrier_id_retraite').val();
        var ageentre = $('#ageentre').val();
        var dateentretient = $('#contratouvrier_daterecrutement').val();
        var datenaissance = $('#datenaissance').val();
        var d2 = new Date(dateentretient);
        var d1 = new Date(datenaissance)
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
        var anciente = "A : " + DateDiff.inYears(d1, d2) + " M : " + DateDiff.inMonths(d1, d2) + "  J : " + DateDiff.inDays(d1, d2);
        $('#ageentre').val(anciente);
        $scope.param = {
            'datenaissance': datenaissance,
            'dateentretient': dateentretient,
            'id_retraite': id_retraite,
            'ageentre': ageentre,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/AfficheageetdateretraiteOuvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#contratouvrier_dateretraite').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datenaissance")
        .change(function () {
            if ($("#id_regrouppement").val() == "2" && $("#datenaissance").val() != "" && $("#contratouvrier_daterecrutement").val() != "") {
                $scope.ChargerDateRetraiteOuvrier();
            }
        })
        .trigger("change");
    $("#contratouvrier_daterecrutement")
        .change(function () {
            if ($("#id_regrouppement").val() != "1" && $("#datenaissance").val() != "" && $("#contratouvrier_daterecrutement").val() != "") {
                $scope.ChargerDateRetraiteOuvrier();
            }
        })
        .trigger("change");
    //charger date retraite pour personnel 

    $scope.ChargerDateRetraite = function () {
        if ($('#contrat_dateemposte').val() != '' && $('#datenaissance').val() != '') {
            var id_retraite = $('#contrat_id_retratite').val();
            var ageentre = $('#ageentre').val();
            var dateemposte = $('#contrat_dateemposte').val();
            var datenai = $('#datenaissance').val();
            var d2 = new Date(dateemposte);
            var d1 = new Date(datenai)
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
            var anciente = "A : " + DateDiff.inYears(d1, d2) + " M : " + DateDiff.inMonths(d1, d2) + "  J : " + DateDiff.inDays(d1, d2);
            $('#ageentre').val(anciente);
            $scope.param = {
                'datenaissance': datenai,
                'dateemposte': dateemposte,
                'id_retraite': id_retraite,
                'ageentre': ageentre,
            }
            $http({
                url: domaineapp + 'Ressourcehumaine.php/contrat/Afficheageetdateretraite',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#contrat_dateretraite').val(data);
            }, function myError(response) {
                alert(response);
            });
        } else {
            $('#ageentre').val('');
            $('#contrat_dateretraite').val('');
        }
    }
    $("#datenaissance")
        .change(function () {
            if ($("#datenaissance").val() != "" && $("#contrat_dateemposte").val() != "") {
                $scope.ChargerDateRetraite();
            } else {
                $('#contrat_dateretraite').val("");
            }
        })
        .trigger("change");
    $("#contrat_dateemposte")
        .change(function () {
            if ($("#datenaissance").val() != "" && $("#contrat_dateemposte").val() != "") {
                $scope.ChargerDateRetraite();
            }
            //            

        })
        .trigger("change");
    //tester sur cin existe ou nn agents
    $scope.TestExistance = function () {
        var agent_cin = $('#agents_cin').val();
        $scope.param = {
            'cin': agent_cin
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/testcin',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#agents_idrh').val(data['idrh']);
            alert("CIN existe déjà !!");
            document.location.href = "/BmmErpV2/web/Ressourcehumaine.php/agents/edit?id=" + data['id'];

        }, function myError(response) {
            alert(response);
        });
    }
    $("#agents_cin")
        .change(function () {
            if ($("#agents_id").val() == "") {
                if ($("#agents_cin").val() != "") {
                    if ($("#agents_cin").val().length == 8) {
                        $scope.TestExistance();
                    }
                }
            }

        })
        .trigger("change");
    //tester sur cin existe ou nn ouvrier
    $scope.TestExistanceCinouvrier = function () {
        var ouvrier_cin = $('#ouvrier_cin').val();
        $scope.param = {
            'cin': ouvrier_cin

        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/ouvrier/testcin',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#ouvrier_matricule').val(data['matricule']);
            alert("CIN existe déjà !!");
            document.location.href = "/BmmErpV2/web/Ressourcehumaine.php/ouvrier/" + data['id'] + "/edit";
        }, function myError(response) {
            alert(response);
        });
    }
    $("#ouvrier_cin")
        .change(function () {
            if ($("#ouvrier_id").val() == "") {
                if ($("#ouvrier_cin").val() != "") {
                    if ($("#ouvrier_cin").val().length == 8) {
                        $scope.TestExistanceCinouvrier();
                    }
                }
            }
        })
        .trigger("change");
    //idr existance agents

    $scope.TestExistanceidrh = function () {
        var agent_idrh = $('#agents_idrh').val();
        $scope.param = {
            'idrh': agent_idrh

        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/testidrh',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#agents_cin').val(data['cin']);
            $('#idagents').val(data['id']);
            alert("Matricule existe déjà !!");
            document.location.href = "/BmmErpV2/web/Ressourcehumaine.php/agents/edit?id=" + data['id'];
        }, function myError(response) {
            alert(response);
        });
    }
    $("#agents_idrh")
        .change(function () {
            if ($("#agents_id").val() == "") {
                if ($("#agents_idrh").val() != "") {
                    $scope.TestExistanceidrh();
                }
            }
        })
        .trigger("change");
    //idrh ouvrier test d'existance
    $scope.TestExistanceidrhOuvrier = function () {
        var ouvrier_idrh = $('#ouvrier_matricule').val();
        $scope.param = {
            'idrh': ouvrier_idrh
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/ouvrier/testidrh',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#ouvrier_cin').val(data['cin']);
            alert("Matricule existe déjà !!");
            document.location.href = "/BmmErpV2/web/Ressourcehumaine.php/ouvrier/" + data['id'] + "/edit";
        }, function myError(response) {
            alert(response);
        });
    }
    $("#ouvrier_matricule")
        .change(function () {
            if ($("#ouvrier_id").val() == "") {
                if ($("#ouvrier_matricule").val() != "") {
                    $scope.TestExistanceidrhOuvrier();
                }
            }
        })
        .trigger("change");
    //charger mat autorisation
    $scope.ChargerMAtByAgents = function () {
        var id_agent = $('#autoristation_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/autoristation/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#autoristation_id_agents")
        .change(function () {
            if ($("#autoristation_id_agents").val() != "") {
                $scope.ChargerMAtByAgents();
            }
        })
        .trigger("change");
    //demande de voir 
    $scope.ChargerMAtByPersonne = function () {
        var id_agent = $('#demandedevoirfichieradmin_id_demandeur').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/demandedevoirfichieradmin/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#matricule').val(data['matricule']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#demandedevoirfichieradmin_id_demandeur")
        .change(function () {
            if ($("#demandedevoirfichieradmin_id_demandeur").val() != "") {
                $scope.ChargerMAtByPersonne();
            } else {
                $('#matricule').val("");
            }
        })
        .trigger("change");
    //ajout copie dosssier 

    $scope.AjouterLigneCopie = function () {
        trouve = 0;
        if ($('#num').val() != "") {
            if ($('#nordre').val() == "") {
                nordre = $scope.listedocsCopie.length + 1;
                if ($('#num').val() != "") {
                    $scope.listedocsCopie.push({
                        'norgdre': nordre,
                        'type': $('#type').val(),
                        'num': $('#num').val(),
                        'contenu': $('#contenu').val(),
                    });
                }
            } else {
                var comArr = eval($scope.listedocsCopie);
                for (var i = 0; i < comArr.length; i++) {
                    if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                        comArr[i].num = $('#num').val();
                        comArr[i].type = $('#type').val();
                        comArr[i].contenu = $('#contenu').val();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut choisir un agent !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsCopie();
    }

    //initialiser champs copie
    $scope.InaliserChampsCopie = function () {
        $('#nordre').val('');
        $('#num').val('');
        $('#type').val('');
        $('#contenu').val('');
    }
    //MISAjour copie
    $scope.MisAJourCopie = function (lignedocCopie) {

        $('#nordre').val(lignedocCopie.norgdre);
        $('#num').val(lignedocCopie.num);
        $('#type').val(lignedocCopie.type);
        $('#contenu').val(lignedocCopie.contenu);
    }
    //Delete copie

    $scope.DeleteCopie = function (lignedocCopie) {
        var index = -1;
        var comArr = eval($scope.listedocsCopie);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocCopie.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsCopie.splice(index, 1);
        $scope.inialiserTableCopie();
    }
    $scope.inialiserTableCopie = function () {
        var arraytable = [];
        arraytable = $scope.listedocsCopie;
        $scope.listedocsCopie = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsCopie.push({
                'norgdre': i + 1,
                'num': arraytable[i].num,
                'type': arraytable[i].type,
                'contenu': arraytable[i].contenu,
            });
        }

    }
    //ajout ouvrier dans ligne Copie 
    $scope.validerAjoutCopie = function () {
        if ($scope.listedocsCopie.length > 0) {
            $scope.document = {
                'listeslignesdocCopie': $scope.listedocsCopie,
                'num': $('#num').val(),
                'type': $('#type').val(),
                'contenu': $('#contenu').val(),
                'idd': $('#demandedevoirfichieradmin_id').val(),
                'norgdre': $('#nordre').val,
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/demandedevoirfichieradmin/SavedocumentLigneCopie',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderCopie').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }

    //affichage ligne Copie

    $scope.AfficheLignedocCopie = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/demandedevoirfichieradmin/AfficheligneCopie',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsCopie = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //mission 
    $scope.ChargerMAtByAgent = function () {
        var id_agent = $('#mission_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/mission/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#matricule').val(data['matricule']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#mission_id_agents")
        .change(function () {
            if ($("#mission_id_agents").val() != "") {
                $scope.ChargerMAtByAgent();
            } else {
                $('#matricule').val("");
            }
        })
        .trigger("change");
    //mission ouvrier


    $scope.ChargerMAtByOuvrier = function () {
        var id_ouvrier = $('#mission_id_ouvrier').val();
        $scope.param = {
            'idouvrier': id_ouvrier
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/mission/AffichedetailOuvirer',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#matricule').val(data['matricule']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#mission_id_ouvrier")
        .change(function () {
            if ($("#mission_id_ouvrier").val() != "") {
                $scope.ChargerMAtByOuvrier();
            } else {
                $('#matricule').val("");
            }
        })
        .trigger("change");
    //attestation ouvirer --------------
    //charger detail ouvrier 
    $scope.ChargerDetailOuvrier = function () {
        if (idouv = $('#magouvrier').val()) {
            var idouv = $('#magouvrier').val();
            $scope.param = {
                'idou': idouv,
            }
            $http({
                url: domaineapp + 'Ressourcehumaine.php/attestationouvrier/AffichedetailOuvrier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $('#cin').val(data['cin']);
                $('#situation').val(data['situation']);
                $('#ninscrit').val(data['ninscrit']);
                $('#idouvrier').val(data['idouvrier']);
            }, function myError(response) {
                alert(response);
            });
        }
    }
    $("#magouvrier")
        .change(function () {
            if ($("#magouvrier").val() != "") {
                $scope.ChargerDetailOuvrier();
            }
        })
        .trigger("change");
    //Ajouter ligne ouvrier 
    $scope.AjouterLigneOuvrier = function () {
        trouve = 0;
        if ($('#magouvrier').val() != "") {
            if ($('#nordre').val() == "") {
                nordre = $scope.listedocsOuvrier.length + 1;
                if ($('#magouvrier').val() != "") {
                    $scope.listedocsOuvrier.push({
                        'norgdre': nordre,
                        'cin': $('#cin').val(),
                        'ninscrit': $('#ninscrit').val(),
                        'situation': $('#situation').val(),
                        'idouvrier': $('#idouvrier').val(),
                        'idmagouvrier': $('#magouvrier').val(),
                        'magouvrier': $('#magouvrier option:selected').text()

                    });
                }
            } else {

                var comArr = eval($scope.listedocsOuvrier);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                        comArr[i].cin = $('#cin').val();
                        comArr[i].ninscrit = $('#ninscrit').val();
                        comArr[i].idmagouvrier = $('#magouvrier').val();
                        comArr[i].situation = $('#situation').val();
                        comArr[i].idouvrier = $('#idouvrier').val();
                        comArr[i].magouvrier = $('#magouvrier option:selected').text();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut choisir un agent !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsOuvrier();
    }

    //initialiser champs Ouvrier
    $scope.InaliserChampsOuvrier = function () {
        $('#nordre').val('');
        $('#cin').val('');
        $('#ninscrit').val('');
        $('#idouvrier').val('');
        $('#situation').val('');
        $('#magouvrier').val('');
        $('#magouvrier').trigger("chosen:updated");
    }
    //MISAjour Ouvrier
    $scope.MisAJourOuvrier = function (lignedocOuvrier) {

        $('#nordre').val(lignedocOuvrier.norgdre);
        $('#cin').val(lignedocOuvrier.cin);
        $('#idouvrier').val(lignedocOuvrier.idouvrier);
        $('#ninscrit').val(lignedocOuvrier.ninscrit);
        $('#situation').val(lignedocOuvrier.situation);
        $('#magouvrier').val(lignedocOuvrier.idmagouvrier);
        $('#magouvrier').trigger("chosen:updated");
    }
    //Delete Ouvrier

    $scope.DeleteOuvrier = function (lignedocOuvrier) {
        var index = -1;
        var comArr = eval($scope.listedocsOuvrier);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocOuvrier.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsOuvrier.splice(index, 1);
        $scope.inialiserTableOuvrier();
    }
    $scope.inialiserTableOuvrier = function () {
        var arraytable = [];
        arraytable = $scope.listedocsOuvrier;
        $scope.listedocsOuvrier = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsOuvrier.push({
                'norgdre': i + 1,
                'cin': arraytable[i].cin,
                'ninscrit': arraytable[i].ninscrit,
                'idouvrier': arraytable[i].idouvrier,
                'situation': arraytable[i].situation,
                'magouvrier': arraytable[i].magouvrier,
            });
        }

    }
    //ajout ouvrier dans ligne ouvrier 
    $scope.validerAjout = function () {
        if ($scope.listedocsOuvrier.length > 0) {
            $scope.document = {
                'listeslignesdocOuvrier': $scope.listedocsOuvrier,
                'idouvrier': $('#idouvrier').val(),
                'idattestation': $('#attestationouvrier_id').val(),
                'norgdre': $('#nordre').val,
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/attestationouvrier/SavedocumentLigneOuvrier',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderouvrier').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }

    //--------------atestattion ouvier 
    //charger data personnellepopup
    $scope.chargerpersonne = function (id, mat, nom) {
        //     $('#inpersonne').val=id; 
        //      $('#nomagentsdebut').val=mat; 
        //      $('#iddebut').val=nom;

    }

    //cahrger nom apartir id du popup 
    $scope.ChargerDetailNomByAgent = function () {
        var iddebut = $('#iddebut').val();
        $scope.param = {
            'idd': iddebut,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AffichedetailNom',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#nomagentsdebut').val(data['nomcomplet']);
        }, function myError(response) {
            alert(response);
        });
    }
    //ajouter tache popup 
    $scope.AjouterTache = function () {
        $scope.param = {
            'libelle': $('#libelle').val(),
            'poste': $('#magTaches').val(),
        }

        $http({
            url: domaineapp + 'Ressourcehumaine.php/taches/Savetache',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert("Ajout de fiche tâche effectué avec succès");
            $scope.InaliserChampsPopup();
            location.reload();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.InialiserPopup = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.InaliserChampsPopup = function () {
        $('#libelle').val('');
        $('#magTaches').val('');
        $('#magTaches').trigger("chosen:updated");
    }

    $scope.AfficheAgents = function () {

        $scope.param = {
            'ag': $('#agents').val(),
            'ref': $('#refagents').val()
        }
        $http({
            url: domaineapp + '/Ressourcehumaine.php/contrat/ListeAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.agents = data;
            AjoutHtmlAfterTRansfert(data, '#refagents', '#agents', '#contrat_id_agents');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affiche ouvrier 

    $scope.AfficheOuvrier = function () {

        $scope.param = {
            'ouv': $('#ouvrier').val(),
            'ref': $('#refouvrier').val()
        }
        $http({
            url: domaineapp + '/Ressourcehumaine.php/contratouvrier/ListeOuvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ouvrier = data;
            AjoutHtmlAfterTRansfert(data, '#refouvrier', '#ouvrier', '#contratouvrier_id_ouvrier');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }


    $scope.AfficheAgents2 = function () {

        $scope.param = {
            'ag': $('#agents').val(),
            'ref': $('#refagents').val()
        }
        $http({
            url: domaineapp + '/Ressourcehumaine.php/contrat/ListeAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.agents = data;
            AjoutHtmlAfterTRansfert(data, '#refagents', '#agents', '#contrat_id_agents');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheAgents1 = function (id, nom) {
        if ($(nom).val() != '') {
            $(id).val('');
            $scope.param = {
                "ag": $(nom).val(),
                // 'ag': $('#agents').val(),
                //  'ref': $('#refagents').val()
            }
            $http({
                url: domaineapp + '/Ressourcehumaine.php/contrat/ListeAgents1',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.agents = data;
                AjoutHtmlAfter(data, id, id_hidden);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $(nom).val('');
        }
    }
    $scope.AddSalaire = function (id) {
        var montant = parseFloat($('#' + id).val());
        $scope.savegrille(id, montant);
    }
    $scope.AddSalaire2 = function (id) {
        var montant = parseFloat($('#' + id).val());
        $scope.savegrille2(id, montant);
    }
    $("#fonctionnaire input").change(function () {
        $scope.AddSalaire($(this).attr('id'), $(this).val());
    });
    $("#ouvrier input").change(function () {
        $scope.AddSalaire2($(this).attr('id'), $(this).val());
    });
    $scope.initialChampsOuvrier = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.initialChampsNiveauxEducatif = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        $('#libelle').val('');
        $('#libelle').trigger("chosen:updated");
    }
    $("#home input").change(function () {
        $scope.TestValidBtnAjout();
    });
    $("#home select").change(function () {
        $scope.TestValidBtnAjout();
    });
    $("#homeouvrier input").change(function () {
        $scope.TestCin();
    });
    $scope.TestCin = function () {
        msg2 = "";
        if ($("#ouvrier_cin").mask('99999999'))
            msg2 = "cin doit composer de 8 chiffre !!! ";
        console.log(msg2);
    }
    $scope.TestValidBtnAjout = function () {
        msg = "";
        if ($('#agents_cin').val() == "")
            msg = "Veuillez saisir le cin";
        if ($('#agents_nomcomplet').val() == "")
            msg += "\n Veuillez saisir le nom ";
        if ($('#agents_prenom').val() == "")
            msg += "\n Veuillez saisir le prenom ";
        if ($('#agents_datenaissance').val() == "")
            msg = "Veuillez saisir dae de naissance";
        if ($('#agents_id_sexe').val() == "")
            msg += "\n Veuillez sélectionnez le sexe ";
        if ($('#agents_adresse').val() == "")
            msg += "\n Veuillez saisir l'adresse ";
        if ($('#agents_id_gouvn').val() == "")
            msg += "\n Veuillez sélectionnez le ville ";
        if ($('#agents_id_regrouppement').val() == "")
            msg += "\n Veuillez sélectionnez le Regrouppement ";
        if ($('#agents_lieun').val() == "")
            msg += "\n Veuillez sélectionnez l'ieu de naissance ";
        if ($('#agents_id_etatcivil').val() == "")
            msg += "\n Veuillez sélectionnez l'etat civil ";

        //        if ($("#agents_cin").mask('99999999'))
        //           msg1 = "cin doit composer de 8 chiffre !!! ";
        console.log(msg);
        if (msg === "") {
            $('#btnvaliderPersonnelle').removeClass("disabledbutton");
            $('#btnvaliderPersonnelle').removeClass("btn-danger");
            $('#btnvaliderPersonnelle').addClass('btn-info');
        }
    }
    $scope.initialChampsSociale = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.initialChampsDonnedebase = function () {
        //$scope.ChargerCombo("con")

        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.initialChampsgrille = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        //        $scope.ChargerAnciennteGrade();
        //        $scope.ChargerAnciennteEchelle();
        //        $scope.ChargerAnciennteEchellon();
        //        $scope.ChargerAnciennteGenerale();
        //        $scope.ChargerDateRetraite();

    }
    $scope.initialChampstache = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.initialChamps = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.initialChampsPersonnelle = function () {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        $('#etatmulitaire').val('');
        $('#etatmulitaire').trigger("chosen:updated");
        $('#nbrenfants').val('');
        $('#nbrenfants').trigger("chosen:updated");
    }
    $scope.ChargerDetailRhByAgent = function () {
        var id_agent = $('#contrat_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
            $('#datenaissance').val(data['datenaissance']);
            $scope.ChargerDateRetraite();
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_id_agents")
        .change(function () {
            if ($("#contrat_id_agents").val() != "") {
                $scope.ChargerDetailRhByAgent();
            } else {
                $('#idrh').val('');
                $('#datenaissance').val('');
                $scope.ChargerDateRetraite();
            }
        })
        .trigger("change");




    $scope.ChargerDetailRhByAgentMilitaire = function () {
        var id_agent = $('#contrat_id_agents_militaire').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailMilitaire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
            $('#datenaissance').val(data['datenaissance']);

        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_id_agents_militaire")
        .change(function () {
            if ($("#contrat_id_agents_militaire").val() != "") {
                $scope.ChargerDetailRhByAgentMilitaire();
            } else {
                $('#idrh').val('');
                $('#datenaissance').val('');

            }
        })
        .trigger("change");
    //------salaire ouvrier 

    $scope.ChargerDetailOuvreir = function (iddoc) {
        if ($("#salaireouvrier_datefin").val() && $("#salaireouvrier_datedebut").val() && $('#salaireouvrier_id_contratouvrier').val()) {
            var idouv = $('#salaireouvrier_id_contratouvrier').val();
            var date_fin =$("#salaireouvrier_datefin").val();
            var date_debut=$("#salaireouvrier_datedebut").val();
            $scope.param = {
                'idag': idouv,
                'date_debut': date_debut,
                'date_fin': date_fin,
                
            }
            $http({
                url: domaineapp + 'Ressourcehumaine.php/salaireouvrier/AffichedetailHistoriqueOuvrier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.listesHistorique = data;
                var totalp = 0;
                for (var i = 0; i < $scope.listesHistorique.length; i++) {
                    totalp = eval(totalp) + eval($scope.listesHistorique[i].montantotal);
                }

                $('#salaireouvrier_salaire').val(totalp.toFixed(3));
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }

    $("#salaireouvrier_datedebut")
        .change(function () {
            if ($("#salaireouvrier_datedebut").val() != "") {
                $scope.ChargerDetailOuvreir();
            }
        })
        .trigger("change");

    $("#salaireouvrier_datefin")
        .change(function () {
            if ($("#salaireouvrier_datefin").val() != "") {
                $scope.ChargerDetailOuvreir();
            }
        })
        .trigger("change");
    $("#salaireouvrier_id_contratouvrier")
        .change(function () {
            if ($("#salaireouvrier_id_contratouvrier").val() != "") {
                $scope.ChargerDetailOuvreir();
            }
        })
        .trigger("change");
    //    $scope.calculMontantTotal = function ()
    //    {
    //        var totalHTT = 0;
    //        $('[name="ligne_montanttot"]').each(function () {
    //            var ligne_montant = 0;
    //            if ($(this).val() != '')
    //                ligne_montant = parseFloat($(this).val());
    //            totalHTT = parseFloat(totalHTT) + parseFloat(ligne_montant);
    //        });
    //        $('#salaireouvrier_salaire').val(parseFloat(totalHTT).toFixed(3));
    //
    //    }

    //---------

    $scope.AfficheAgentByText = function () {
        $scope.param = {
            'codeagent': $scope.codeagent.text,
            'nameagnet': $scope.nameagnet.text
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/Documents/RechercheByCodeArticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesagents = data;
            if ($('#nameagent').val() != "")
                AjoutHtmlAfter(data, '#nameagnet', '#codeagent');
            else
                AjoutHtmlAfter(data, '#codeagent', '#nameagnet');
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheFicheAgentByCode = function () {
        $scope.param = {
            'codeagent': $('#codeagent').val()
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/Documents/AfficheFicheAgent',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $scope.ficheagents = data;
            $('#nom').val($scope.ficheagents.nomcomplet);
            //           $scope.fiche

        }, function myError(response) {
            alert(response);
        });
    }

    //ajouter ligne langue
    $scope.AjouterLigneLangue = function () {
        trouve = 0;
        if ($('#descriptionl').val() != "" && $('#mag2').val() != "") {
            if ($('#nordre3').val() == "") {
                nordre3 = $scope.listedocsL.length + 1;
                if ($('#descriptionl').val() != "" && $('#mag2').val() != "") {
                    $scope.listedocsL.push({
                        'norgdre': nordre3,
                        'descriptionl': $('#descriptionl').val(),
                        'idmag2': $('#mag2').val(),
                        'mag2': $('#mag2 option:selected').text()

                    });
                }
            } else {

                var comArr = eval($scope.listedocsL);
                for (var i = 0; i < comArr.length; i++) {
                    if (comArr[i].norgdre - $('#nordre3').val().trim() === 0) {

                        comArr[i].descriptionl = $('#descriptionl').val();
                        comArr[i].idmag2 = $('#mag2').val();
                        comArr[i].mag2 = $('#mag2 option:selected').text();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir tous les champs !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsLangue();
    }

    //initialiser champs Langue
    $scope.InaliserChampsLangue = function () {
        $('#nordre3').val('');
        $('#descriptionl').val('');
        $('#mag2').val('');
        $('#mag2').trigger("chosen:updated");
    }
    //MISAjour LAngue
    $scope.MisAJourL = function (lignedocL) {

        $('#nordre3').val(lignedocL.norgdre);
        $('#descriptionl').val(lignedocL.descriptionl);
        $('#mag2').val(lignedocL.mag2);
        $('#mag2').trigger("chosen:updated");
    }
    //Delete langue
    $scope.DeleteL = function (lignedocL) {
        var index = -1;
        var comArr = eval($scope.listedocsL);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].mag2 === lignedocL.mag2 && comArr[i].norgdre === lignedocL.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsL.splice(index, 1);
        $scope.inialiserTableLangue();
    }
    //Ajouter ligne Specialite 
    $scope.AjouterLigneSpecialite = function () {
        trouve = 0;
        if ($('#descriptions').val() != "" && $('#mag1').val() != "") {
            if ($('#nordre2').val() == "") {
                nordre2 = $scope.listedocsS.length + 1;
                if ($('#descriptions').val() != "" && $('#mag1').val() != "") {
                    $scope.listedocsS.push({
                        'norgdre': nordre2,
                        'descriptions': $('#descriptions').val(),
                        'idmag1': $('#mag1').val(),
                        'mag1': $('#mag1 option:selected').text()

                    });
                }
            } else {

                var comArr = eval($scope.listedocsS);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordre2').val().trim() === 0) {

                        comArr[i].descriptions = $('#descriptions').val();
                        comArr[i].idmag1 = $('#mag1').val();
                        comArr[i].mag1 = $('#mag1 option:selected').text();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir tous les champs !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsSpecialite();
    }
    //initialiser champs specialite
    $scope.InaliserChampsSpecialite = function () {
        $('#nordre2').val('');
        $('#descriptions').val('');
        $('#mag1').val('');
        $('#mag1').trigger("chosen:updated");
    }
    //MISAjour Specialie
    $scope.MisAJourS = function (lignedocS) {

        $('#nordre2').val(lignedocS.norgdre);
        $('#descriptions').val(lignedocS.descriptions);
        $('#mag1').val(lignedocS.mag1);
        $('#mag1').trigger("chosen:updated");
    }
    //Delete specialite
    $scope.DeleteS = function (lignedocS) {
        var index = -1;
        var comArr = eval($scope.listedocsS);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].mag1 === lignedocS.mag1 && comArr[i].norgdre === lignedocS.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsS.splice(index, 1);
        $scope.inialiserTableSpecialite();
    }

    //Ajouter ligne PArents 
    $scope.AjouterLigneParents = function () {
        trouve = 0;
        if ($('#nom').val() != "") {
            if ($('#nordre6').val() == "") {
                nordre6 = $scope.listedocsP.length + 1;
                if ($('#nom').val() != "") {
                    $scope.listedocsP.push({
                        'norgdre': nordre6,
                        'nom': $('#nom').val(),
                        'prenom': $('#prenom').val(),
                        'daten': $('#daten').val(),
                    });
                }
            } else {

                var comArr = eval($scope.listedocsP);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordre6').val().trim() === 0) {
                        comArr[i].nom = $('#nom').val();
                        comArr[i].prenom = $('#prenom').val();
                        comArr[i].daten = $('#daten').val();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir le Nom !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsParents();
    }

    //initialiser champs Parents
    $scope.InaliserChampsParents = function () {
        $('#nordre6').val('');
        $('#nom').val('');
        $('#prenom').val('');
        $('#daten').val('');
    }
    //MISAjour PArents
    $scope.MisAJourP = function (lignedocP) {

        $('#nordre6').val(lignedocP.norgdre);
        $('#nom').val(lignedocP.nom);
        $('#prenom').val(lignedocP.prenom);
        $('#daten').val(lignedocP.daten);
    }
    //Delete Parents

    $scope.DeleteP = function (lignedocP) {
        var index = -1;
        var comArr = eval($scope.listedocsP);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].nom === lignedocP.nom && comArr[i].norgdre === lignedocP.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsP.splice(index, 1);
        $scope.inialiserTableParent();
    }

    //Ajouter ligne Conjoints 
    $scope.AjouterLigneConjoints = function () {
        trouve = 0;
        if ($('#nomc').val() != "") {
            if ($('#nordre4').val() == "") {
                nordre4 = $scope.listedocsC.length + 1;
                if ($('#nomc').val() != "") {
                    $scope.listedocsC.push({
                        'norgdre': nordre4,
                        'nomc': $('#nomc').val(),
                        'prenomc': $('#prenomc').val(),
                        'etattravail': $('#etattravail').is(':checked'),
                    });
                }
            } else {

                var comArr = eval($scope.listedocsC);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordre4').val().trim() === 0) {
                        comArr[i].nomc = $('#nomc').val();
                        comArr[i].prenomc = $('#prenomc').val();
                        comArr[i].etattravail = $('#etattravail').is(':checked');
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir le Nom !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsConjoints();
    }

    //initialiser champs Conjoints
    $scope.InaliserChampsConjoints = function () {
        $('#nordre4').val('');
        $('#nomc').val('');
        $('#prenomc').val('');
        $('#etattravail').val('');
    }
    //MISAjour Conjoints
    $scope.MisAJourC = function (lignedocC) {

        $('#nordre4').val(lignedocC.norgdre);
        $('#nomc').val(lignedocC.nomc);
        $('#prenomc').val(lignedocC.prenomc);
        $('#etattravail').val(lignedocC.etattravail);
    }
    //Delete Conjoints

    $scope.DeleteC = function (lignedocC) {
        var index = -1;
        var comArr = eval($scope.listedocsC);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].nomC === lignedocC.nomc && comArr[i].norgdre === lignedocC.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsC.splice(index, 1);
        $scope.inialiserTableConjoint();
    }

    //Ajouter ligne Enfants 
    $scope.AjouterLigneEnfants = function () {
        trouve = 0;
        var nbrenfant = $('#agents_nbrenfants').val();
        if ($('#nome').val() != "" && $('#datenai').val() != "" && $('#agents_nbrenfants').val().trim() != 0) {
            if ($('#nordre5').val() == "") {
                nordre5 = $scope.listedocsE.length + 1;
                if ($('#nome').val() != "") {
                    $scope.listedocsE.push({
                        'norgdre': nordre5,
                        'nome': $('#nome').val(),
                        'prenome': $('#prenome').val(),
                        'datenai': $('#datenai').val(),
                        'age': $('#age').val(),
                        'etudiant': $('#etudiant').is(':checked'),
                        'boursier': $('#boursier').is(':checked'),
                        'dece': $('#dece').is(':checked'),
                        'iddeduction': $('#deduction').val(),
                        'deduction': $('#deduction option:selected').text()
                    });
                }
                if ($('#agents_nbrenfants').val().trim() != 0) {
                    nordre5 = $scope.listedocsE.length;
                    if ($('#agents_nbrenfants').val().trim() - nordre5 == 0) {
                        $('#btnajoutE').addClass("disabledbutton");
                        $('#btnajoutE').removeClass('btn-info');
                    }
                }
            } else {
                var comArr = eval($scope.listedocsE);
                for (var i = 0; i < comArr.length; i++) {
                    if (comArr[i].norgdre - $('#nordre5').val().trim() === 0) {
                        comArr[i].nome = $('#nome').val();
                        comArr[i].prenome = $('#prenome').val();
                        comArr[i].datenai = $('#datenai').val();
                        comArr[i].age = $('#age').val();
                        comArr[i].etudiant = $('#etudiant').is(':checked');
                        comArr[i].boursier = $('#boursier').is(':checked');
                        comArr[i].dece = $('#dece').is(':checked');
                        comArr[i].iddeduction = $('#deduction').val();
                        comArr[i].deduction = $('#deduction option:selected').text();

                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir le Nom, la date de naissance et le nbre d'enfants!!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsEnfants();
    }
    //initialiser champs Enfants
    $scope.InaliserChampsEnfants = function () {
        $('#nordre5').val('');
        $('#nome').val('');
        $('#prenome').val('');
        $('#datenai').val('');
        $('#age').val('');
        $('#etudiant').removeAttr("checked");
        $('#boursier').removeAttr("checked");
        $('#dece').removeAttr("checked");
        $('#deduction').val('');
        $('#deduction').trigger("chosen:updated");
        if ($('#agents_nbrenfants').val().trim() != 0) {
            nordre5 = $scope.listedocsE.length;
            if ($('#agents_nbrenfants').val().trim() - nordre5 == 0) {
                $('#btnajoutE').addClass("disabledbutton");
                $('#btnajoutE').removeClass('btn-info');
            }
        }

    }
    //MISAjour Enfants
    $scope.MisAJourE = function (lignedocE) {

        $('#nordre5').val(lignedocE.norgdre);
        $('#nome').val(lignedocE.nome);
        $('#prenome').val(lignedocE.prenome);
        $('#datenai').val(lignedocE.datenai);
        $('#age').val(lignedocE.age);
        if (lignedocE.etudiant == true)
            $('#etudiant').prop("checked", true);
        else
            $('#etudiant').removeAttr("checked");
        if (lignedocE.boursier == true)
            $('#boursier').prop("checked", true);
        else
            $('#boursier').removeAttr("checked");

        if (lignedocE.dece == true)
            $('#dece').prop("checked", true);
        else
            $('#dece').removeAttr("checked");

        $('#deduction').val(lignedocE.iddeduction);
        $('#deduction').trigger("chosen:updated");

        $('#btnajoutE').removeClass("disabledbutton");
        $('#btnajoutE').addClass('btn-info');

    }
    //Delete Enfants  
    $scope.DeleteE = function (lignedocE) {
        var index = -1;
        var comArr = eval($scope.listedocsE);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].nome === lignedocE.nome && comArr[i].norgdre === lignedocE.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsE.splice(index, 1);
        $('#btnajoutE').removeClass('disabledbutton');
        $('#btnajoutE').addClass("btn-info");

        $scope.inialiserTableEnfant();
    }
    $scope.inialiserTableEnfant = function () {
        var arraytable = [];
        arraytable = $scope.listedocsE;
        $scope.listedocsE = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsE.push({
                'norgdre': i + 1,
                'nome': arraytable[i].nome,
                'prenome': arraytable[i].prenome,
                'datenai': arraytable[i].datenai,
                'age': arraytable[i].age,
                'etudiant': arraytable[i].etudiant,
                'boursier': arraytable[i].boursier,
                'iddeduction': arraytable[i].iddeduction,
                'deduction': arraytable[i].deduction
            });
        }
    }
    $scope.validerAjoutEnfants = function () {
        if ($scope.listedocsE.length > 0) {
            $scope.document = {
                'listeslignesdocE': $scope.listedocsE,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'paie.php/agents/SavedocumentEnfants',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderE').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }
    //affichage enfants
    $scope.AfficheLigneEnfants = function (iddoc) {
        if ($('#agents_nbrenfants').val().trim() != 0) {
            nordre5 = $scope.listedocsE.length;
            if ($('#agents_nbrenfants').val().trim() - nordre5 == 0) {
                $('#btnajoutE').addClass("disabledbutton");
                $('#btnajoutE').removeClass('btn-info');
            }
        }
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'paie.php/agents/AfficheligneEnfants',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsE = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheListesEnfants = function () {
        var id_agents = $("#paie_id_agents").val();
        var abattement = 0;
        $scope.param = {
            "id": id_agents
        }
        $http({
            url: domaineapp + 'paie.php/paie/AffichelisteEnfants',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsE = data;
            var totalp = 0;
            for (var i = 0; i < $scope.listedocsE.length; i++) {
                totalp = eval(totalp) + eval($scope.listedocsE[i].montant);
            }
            totalp = eval(abattement) + totalp;
            $('#abatement_enfants').val(totalp.toFixed(3));
            if ($('#chef').is("checked") == true)
                //            {

                $scope.calculabatementenfantchef();

            //            $('#paie_abattementenfant').val(totalp + 300);
            //            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //Ajouter ligne Formation 
    $scope.AjouterLigneF = function () {
        trouve = 0;
        if ($('#description').val() != "" && $('#mag').val() != "") {
            if ($('#nordreF').val() == "") {
                nordreF = $scope.listedocsF.length + 1;
                if ($('#description').val() != "" && $('#mag').val() != "") {
                    $scope.listedocsF.push({
                        'norgdre': nordreF,
                        'description': $('#description').val(),
                        'organistaion': $('#organistaion').val(),
                        'duree': $('#duree').val(),
                        'date': $('#date').val(),
                        'idmagF': $('#mag').val(),
                        'mag': $('#mag option:selected').text()

                    });
                }
            } else {

                var comArr = eval($scope.listedocsF);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordreF').val().trim() === 0) {
                        comArr[i].description = $('#description').val();
                        comArr[i].organistaion = $('#organistaion').val();
                        comArr[i].duree = $('#duree').val();
                        comArr[i].date = $('#date').val();
                        comArr[i].idmagF = $('#mag').val();
                        comArr[i].mag = $('#mag option:selected').text();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir tous les champs !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsF();
    }

    //initialiser champs formations continues
    $scope.InaliserChampsF = function () {
        $('#nordreF').val('');
        $('#description').val('');
        $('#organistaion').val('');
        $('#duree').val('');
        $('#date').val('');
        $('#mag').val('');
        $('#mag').trigger("chosen:updated");
    }
    //MISAjour Formations
    $scope.MisAJourF = function (lignedocF) {

        $('#nordreF').val(lignedocF.norgdre);
        $('#description').val(lignedocF.description);
        $('#organistaion').val(lignedocF.organistaion);
        $('#duree').val(lignedocF.duree);
        $('#date').val(lignedocF.date);
        $('#mag').val(lignedocF.mag);
        $('#mag').trigger("chosen:updated");
    }
    //Delete formations
    $scope.DeleteF = function (lignedocF) {
        var index = -1;
        var comArr = eval($scope.listedocsF);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].description === lignedocF.description && comArr[i].norgdre === lignedocF.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsF.splice(index, 1);
        $scope.inialiserTableFormation();
    }

    //ajouter ligne diplome
    $scope.AjouterLigneDiplome = function () {
        trouve = 0;
        if ($('#libelle').val() != "" && $('#magd').val() != "") {
            if ($('#nordre1').val() == "") {
                nordre1 = $scope.listedocsD.length + 1;
                if ($('#libelle').val() != "" && $('#magd').val() != "") {
                    $scope.listedocsD.push({
                        'norgdre': nordre1,
                        'annee': $('#annee').val(),
                        'libelle': $('#libelle').val(),
                        'idmagd': $('#magd').val(),
                        'magd': $('#magd option:selected').text()

                    });
                }
            } else {

                var comArr = eval($scope.listedocsD);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordre1').val().trim() === 0) {
                        comArr[i].annee = $('#annee').val();
                        comArr[i].libelle = $('#libelle').val();
                        comArr[i].idmagd = $('#magd').val();
                        comArr[i].magd = $('#magd option:selected').text();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir tous les champs !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsDiplome();
    }
    //initialiser champs  Diplomes
    $scope.InaliserChampsDiplome = function () {
        $('#nordre1').val('');
        $('#annee').val('');
        $('#libelle').val('');
        $('#libelle').trigger("chosen:updated");
        $('#magd').val('');
        $('#magd').trigger("chosen:updated");
    }
    //MISAjour Diplome
    $scope.inialiserTableDiplome = function () {
        var arraytable = [];
        arraytable = $scope.listedocsD;
        $scope.listedocsD = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsD.push({
                'norgdre': i + 1,
                'annee': arraytable[i].annee,
                'libelle': arraytable[i].libelle,
                'magd': arraytable[i].magd,
                'diplome': arraytable[i].diplome

            });
        }

    }
    $scope.inialiserTableLangue = function () {
        var arraytable = [];
        arraytable = $scope.listedocsL;
        $scope.listedocsL = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsL.push({
                'norgdre': i + 1,
                'descriptionl': arraytable[i].descriptionl,
                'idmag': arraytable[i].idmag,
                'langue': arraytable[i].langue

            });
        }

    }
    $scope.inialiserTableSpecialite = function () {
        var arraytable = [];
        arraytable = $scope.listedocsS;
        $scope.listedocsS = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsS.push({
                'norgdre': i + 1,
                'descriptions': arraytable[i].descriptions,
                'idmag': arraytable[i].idmag,
                'specialite': arraytable[i].specialite

            });
        }

    }
    $scope.inialiserTableFormation = function () {
        var arraytable = [];
        arraytable = $scope.listedocsF;
        $scope.listedocsF = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsF.push({
                'norgdre': i + 1,
                'description': arraytable[i].description,
                'organistaion': arraytable[i].organistaion,
                'duree': arraytable[i].duree,
                'date': arraytable[i].date,
                'idmag': arraytable[i].idmag,
                'typeexperience': arraytable[i].typeexperience

            });
        }

    }
    $scope.inialiserTableConjoint = function () {
        var arraytable = [];
        arraytable = $scope.listedocsC;
        $scope.listedocsC = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsC.push({
                'norgdre': i + 1,
                'nomc': arraytable[i].nomc,
                'prenomc': arraytable[i].prenomc,
                'etattravail': arraytable[i].etattravail,
            });
        }

    }

    $scope.inialiserTableParent = function () {
        var arraytable = [];
        arraytable = $scope.listedocsP;
        $scope.listedocsP = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsP.push({
                'norgdre': i + 1,
                'nom': arraytable[i].nom,
                'prenom': arraytable[i].prenom,
                'dateN': arraytable[i].dateN,
            });
        }

    }
    $scope.MisAJourD = function (lignedocD) {

        $('#nordre1').val(lignedocD.norgdre);
        $('#annee').val(lignedocD.annee);
        $('#libelle').val(lignedocD.libelle);
        $('#libelle').trigger("chosen:updated");
        $('#magd').val(lignedocD.idmagd);
        $('#magd').trigger("chosen:updated");
    }
    //Delete Diplome
    $scope.DeleteD = function (lignedocD) {
        var index = -1;
        var comArr = eval($scope.listedocsD);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocD.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsD.splice(index, 1);
        $scope.inialiserTableDiplome();
    }

    //charger age d'un agents 
    $scope.chargerage = function () {
        var datenaissance = $('#datenai').val();
        var datesys = new Date();

        var d2 = new Date(datesys);
        var d1 = new Date(datenaissance)
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
        $('#age').val(nbrannee);

    }
    $("#datenai")
        .change(function () {
            if ($("#datenai").val() != "") {
                $scope.chargerage();
            } else {
                $('#age').val("");
            }
        })
        .trigger("change");
    //charger age agents 
    $scope.chargerAgePersonnel = function () {
        var datenaissance = $('#agents_datenaissance').val();
        var datesys = new Date();

        var d2 = new Date(datesys);
        var d1 = new Date(datenaissance)
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
        $('#agents_age').val(nbrannee);

    }
    $("#agents_datenaissance")
        .change(function () {
            if ($("#agents_datenaissance").val() != "") {
                $scope.chargerAgePersonnel();
            } else {
                $('#agents_age').val("");
            }
        })
        .trigger("change");
    //charger age enfants
    $scope.ChargerAgeEnfants = function () {

        var datenaissance = $('#datenai').val();
        $scope.param = {
            'datenaissance': datenaissance

        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficheageEnfants',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#datema').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datenai")
        .blur(function () {
            if ($("#datenai").val() != "") {
                $scope.ChargerAgeEnfants();
            }
        })
        .trigger("change");
    //charger ancienete generale dans l'administration
    $scope.ChargerAnciennteGenerale = function () {
        var dateemposte = $('#contrat_dateemposte').val();
        $scope.param = {
            'dateemposte': dateemposte
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/Afficheanciennete',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ancienneteGeneral').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_dateemposte")
        .change(function () {
            if ($("#contrat_dateemposte").val() != "") {
                $scope.ChargerAnciennteGenerale();
            } else {
                $('#ancienneteGeneral').val('');
            }
        })
        .trigger("change");
    //charger nbre de jour 

    $scope.Chargernbrjour = function () {
        var datefin = $('#contratouvrier_datefincontrat').val();
        var datedd = $('#contratouvrier_datedebutcontrat').val();
        $scope.param = {
            'datefincontrat': datefin,
            'datedebutcontrat': datedd
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/Affichenbrejour',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbjour').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contratouvrier_datedebutcontrat") && $("#contratouvrier_datefincontrat")
        .change(function () {
            if ($("#contratouvrier_datedebutcontrat").val() != "" && $("#contratouvrier_datefincontrat").val() != "") {
                $scope.Chargernbrjour();
            }
        })
        .trigger("change");
    //charger anciente dans le grade    
    $scope.ChargerAnciennteGrade = function () {
        var dategrade = $('#contrat_dategrade').val();
        $scope.param = {
            'dategrade': dategrade
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheancienneteGrade',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ancienneteGrade').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_dategrade")
        .change(function () {
            if ($("#contrat_dategrade").val() != "") {
                $scope.ChargerAnciennteGrade();
            } else {
                $('#ancienneteGrade').val('');
            }
        })
        .trigger("change");
    $scope.ChargerAnciennteEchelle = function () {
        var dateechelle = $('#contrat_dateechelle').val();
        $scope.param = {
            'dateechelle': dateechelle
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheancienneteEchelle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ancienneteEchelle').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_dateechelle")
        .change(function () {
            if ($("#contrat_dateechelle").val() != "") {
                $scope.ChargerAnciennteEchelle();
            } else {
                $('#ancienneteEchelle').val('');
            }
        })
        .trigger("change");
    //anciente dans l'chelon

    $scope.ChargerAnciennteEchellon = function () {
        var dateechelon = $('#contrat_dateechelon').val();
        $scope.param = {
            'dateechelon': dateechelon
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheancienneteEchellon',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ancienneteEchellon').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_dateechelon")
        .change(function () {
            if ($("#contrat_dateechelon").val() != "") {
                $scope.ChargerAnciennteEchellon();
            } else {
                $('#ancienneteEchellon').val('');
            }
        })
        .trigger("change");
    //valider ajout lignediplomeagents

    $scope.valiedeAjout = function () {

        if ($scope.listedocsD.length > 0) {
            $scope.document = {
                'listeslignesdocD': $scope.listedocsD,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/Savedocument',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }
    //valider ajout lignelangueagents
    $scope.valiedeAjoutLangue = function () {
        if ($scope.listedocsL.length > 0) {
            $scope.document = {
                'listeslignesdocL': $scope.listedocsL,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentLangue',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderL').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }
    //valider ajout lignespecialiteagents
    $scope.valiedeAjoutSpecialite = function () {
        if ($scope.listedocsS.length > 0) {
            $scope.document = {
                'listeslignesdocS': $scope.listedocsS,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentSpecialite',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderS').attr('class', 'btn btn-outline btn-danger');
                //   document.location.href = 'showdocument' + data;
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }
    $scope.valiedeAjoutFormations = function () {
        if ($scope.listedocsF.length > 0) {
            $scope.document = {
                'listeslignesdocF': $scope.listedocsF,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentFormations',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderF').attr('class', 'btn btn-outline btn-danger');
                //   document.location.href = 'showdocument' + data;
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }

    $scope.valiedeAjoutConjoint = function () {
        if ($scope.listedocsC.length > 0) {
            $scope.document = {
                'listeslignesdocC': $scope.listedocsC,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentConjoints',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderC').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }

    $scope.valiedeAjoutEnfants = function () {
        if ($scope.listedocsE.length > 0) {
            $scope.document = {
                'listeslignesdocE': $scope.listedocsE,
                'id_agents': $('#agents').val(),
                'photo': $('#agents_photo').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentEnfants',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderE').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }
    $scope.valiedeAjoutParents = function () {
        if ($scope.listedocsP.length > 0) {
            $scope.document = {
                'listeslignesdocP': $scope.listedocsP,
                'id_agents': $('#agents').val(),
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentParents',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderP').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert("ERREUR ...!!!");
    }
    $scope.ChargerDetailPrime = function () {
        var idfonction = $('#contrat_id_fonction').val();
        var idsouscorps = $('#magC').val();
        $scope.param = {
            'idf': idfonction,
            'idsousc': idsouscorps,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailTitresPrimes',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerComboP('#magprime', data);
            $('#magprime').val(data);
            $('#magprime').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_id_fonction") && $("#magC")
        .change(function () {
            if ($("#contrat_id_fonction").val() != "" && $("#magC").val() != "") {
                $scope.ChargerDetailPrime();
            }
        })
        .trigger("change");
    $scope.ChargerSousdirection = function () {
        var direction = $('#direction_stat').val();
        $scope.param = {
            'idd': direction,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficherSousdirection',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#sous_direction_stat', data);
            $('#sous_direction_stat').val(data);
            $('#sous_direction_stat').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#direction_stat")
        .change(function () {
            if ($("#direction_stat").val() != "") {
                $scope.ChargerSousdirection();
            } else {
                $('#sous_direction_stat').val("0");
                $('#sous_direction_stat').trigger("chosen:updated");
            }
        })
        .trigger("change");
    $scope.ChargerService = function () {
        var sousdirection = $('#sous_direction_stat').val();
        $scope.param = {
            'idd': sousdirection,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficherService',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#service_stat', data);
            $('#service_stat').val(data);
            $('#service_stat').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#sous_direction_stat")
        .change(function () {
            if ($("#sous_direction_stat").val() != "0") {
                $scope.ChargerService();
            } else {
                $('#service_stat').val("");
                $('#service_stat').trigger("chosen:updated");
            }
        })
        .trigger("change");
    $scope.ChargerUnite = function () {
        var service = $('#service_stat').val();
        $scope.param = {
            'idd': service,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficherUnite',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#unite_stat', data);
            $('#unite_stat').val(data);
            $('#unite_stat').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#service_stat")
        .change(function () {
            if ($("#service_stat").val() != "") {
                $scope.ChargerUnite();
            } else {
                $('#unite_stat').val("0");
                $('#unite_stat').trigger("chosen:updated");
            }
        })
        .trigger("change");
    $scope.ChargerPrimeDetaille = function () {
        var idcat = $('#magCat').val();
        var idgrade = $('#magG').val();
        $scope.param = {
            'idca': idcat,
            'idgr': idgrade,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailTitresPrimesDetaille',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerComboP('#magprime', data);
            $('#magprime').val(data);
            $('#magprime').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magCat")
        .change(function () {
            if ($("#magCat").val() != "" && $("#magG").val() != "") {
                $scope.ChargerPrimeDetaille();
            }
        })
        .trigger("change");
    $("#magG")
        .change(function () {
            if ($("#magCat").val() != "" && $("#magG").val() != "") {
                $scope.ChargerPrimeDetaille();
            }
        })
        .trigger("change");
    $scope.ChargerDetailPrimeTitre = function () {
        var idposterh = $('#contrat_id_posterh').val();
        $scope.param = {
            'idposte': idposterh,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailTitresPrimesbyposte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerComboP('#magprime', data);
            $('#magprime').val(data);
            $('#magprime').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_id_posterh")
        .change(function () {
            if ($("#contrat_id_posterh").val() != "") {
                $scope.ChargerDetailPrimeTitre();
            }
        })
        .trigger("change");
    $scope.ChargerDetailMontantPrimeByAgent = function () {
        var idprime = $('#magprime').val();
        var idfonction = $('#contrat_id_fonction').val();
        var idsouscorps = $('#magC').val();
        var idcat = $('#magCat').val();
        var idgra = $('#magG').val();
        var idposte = $('#contrat_id_posterh').val();
        $scope.param = {
            'idpr': idprime,
            'idfon': idfonction,
            'idsousc': idsouscorps,
            'idca': idcat,
            'idg': idgra,
            'idpo': idposte,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailPrimes',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#montantp').val(data['montant']);
            $('#idp').val(data['idp']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magprime")
        .change(function () {
            if ($("#magprime").val() != "") {
                $scope.ChargerDetailMontantPrimeByAgent();
            }
        })
        .trigger("change");
    $scope.ChargerDetailMontantSalireByAgent = function () {
        var echelle = $('#magE').val();
        var echelon = $('#magEchelon').val();
        //var corpsdet = $('#magC').val();
        var grade = $('#magG').val();
        var categorierh = $('#magCat').val();
        $scope.param = {
            'eche': echelle,
            'echel': echelon,
            'gra': grade,
            'cat': categorierh,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailSalaire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#contrat_montant').val(data['montant']);
            $('#contrat_id_salairedebase').val(data['id']);
        }, function myError(response) {
            alert(response);
        });
    }

    $("#magCat") && $("#magE") && $("#magEchelon")
        .change(function () {

            if ($("#magE").val() != "" && $("#magCat").val() != "" && $("#magEchelon").val() != "" || $('#magG').val() != "") {
                $scope.ChargerDetailMontantSalireByAgent();
            }
        })
        .trigger("change");
    //Ajouter ligne primes 
    $scope.AjouterLignePrimes = function () {
        trouve = 0;
        if ($('#magprime').val() != "") {
            if ($('#nordreprime').val() == "") {
                nordreprime = $scope.listedocsPrime.length + 1;
                if ($('#magprime').val() != "") {
                    $scope.listedocsPrime.push({
                        'norgdre': nordreprime,
                        'montantp': $('#montantp').val(),
                        'idp': $('#idp').val(),
                        'idmagprime': $('#magprime').val(),
                        'magprime': $('#magprime option:selected').text(),
                        'datedebutvalide': $('#datedebutvalide').val(),
                        'datefinvalide': $('#datefinvalide').val(),
                    });
                }
            } else {

                var comArr = eval($scope.listedocsPrime);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordreprime').val().trim() === 0) {
                        comArr[i].montantp = $('#montantp').val();
                        comArr[i].idp = $('#idp').val();
                        comArr[i].idmagprime = $('#magprime').val();
                        comArr[i].magprime = $('#magprime option:selected').text();
                        comArr[i].datedebutvalide = $('#datedebutvalide').val();
                        comArr[i].datefinvalide = $('#datefinvalide').val();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir le prime !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsPrimes();
    }

    //initialiser champs Primes
    $scope.InaliserChampsPrimes = function () {
        $('#nordreprime').val('');
        $('#montantp').val('');
        $('#idp').val('');
        $('#magprime').val('');
        $('#magprime').trigger("chosen:updated");
        $('#datedebutvalide').val('');
        $('#datefinvalide').val('');
    }
    //MISAjour Primes
    $scope.MisAJourPrimes = function (lignedocPrime) {

        $('#nordreprime').val(lignedocPrime.norgdre);
        $('#montantp').val(lignedocPrime.montantp);
        $('#idp').val(lignedocPrime.idp);
        $('#magprime').val(lignedocPrime.idmagprime);
        $('#magprime').trigger("chosen:updated");
        $('#datedebutvalide').val(lignedocPrime.datedebutvalide);
        $('#datefinvalide').val(lignedocPrime.datefinvalide);
    }
    //Delete primes

    $scope.DeletePrimes = function (lignedocPrime) {
        var index = -1;
        var comArr = eval($scope.listedocsPrime);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocPrime.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsPrime.splice(index, 1);
        $scope.inialiserTablePrime();
    }
    $scope.inialiserTablePrime = function () {
        var arraytable = [];
        arraytable = $scope.listedocsPrime;
        $scope.listedocsPrime = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsPrime.push({
                'norgdre': i + 1,
                'montantp': arraytable[i].montantp,
                'idp': arraytable[i].idp,
                'idmagprime': arraytable[i].idmagprime,
                'magprime': arraytable[i].magprime,
                'datedebutvalide': arraytable[i].datedebutvalide,
                'datefinvalide': arraytable[i].datefinvalide,
            });
        }

    }
    //ajout prime dans ligne primes 
    $scope.validerAjoutPrime = function () {
        if ($('#contrat_id_agents').val() == "") {
            alert('Il faut choisir un Agent !');
        } else {
            if ($scope.listedocsPrime.length > 0) {
                $scope.document = {
                    'listeslignesdocPrime': $scope.listedocsPrime,
                    'id_agents': $('#contrat_id_agents').val(),
                    'idcontrat': $('#contrat_id').val(),
                };
                $http({
                    url: domaineapp + 'Ressourcehumaine.php/contrat/SavedocumentPrime',
                    method: "POST",
                    data: $scope.document,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $('#btnvaliderPrime').attr('class', 'btn btn-outline btn-danger');
                }, function myError(response) {
                    alert(response);
                });
            } else
                alert("ERREUR ...!!!");
        }
    }

    //Ajouter ligne tache 
    $scope.AjouterLigneTaches = function () {
        trouve = 0;
        if ($('#magtache1').val() != "") {
            if ($('#nordretache').val() == "") {
                nordretache = $scope.listedocsTaches.length + 1;
                if ($('#magtache1').val() != "") {
                    $scope.listedocsTaches.push({
                        'norgdre': nordretache,
                        'magtache': $('#magtache1').val(),
                        'taches': $('#magtache1 option:selected').text()

                    });
                }
            } else {

                var comArr = eval($scope.listedocsTaches);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordretache').val().trim() === 0) {

                        comArr[i].magtache1 = $('#magtache1').val();
                        comArr[i].taches = $('#magtache1 option:selected').text();
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            alert("Il faut remplir la tâche !!!");
        }
        if (trouve === 1)
            $scope.InaliserChampsTaches();
    }

    //initialiser champs taches
    $scope.InaliserChampsTaches = function () {
        $('#nordretache').val('');
        $('#magtache1').val('');
        $('#magtache1').trigger("chosen:updated");
    }
    //MISAjour taches
    $scope.MisAJourTaches = function (lignedocTache) {

        $('#nordretache').val(lignedocTache.norgdre);
        $('#magtache1').val(lignedocTache.magtache);
        $('#magtache1').trigger("chosen:updated");
    }
    //Delete taches

    $scope.DeleteTaches = function (lignedocTache) {
        var index = -1;
        var comArr = eval($scope.listedocsTaches);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocTache.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsTaches.splice(index, 1);
        $scope.inialiserTableTaches();
    }
    $scope.inialiserTableTaches = function () {
        var arraytable = [];
        arraytable = $scope.listedocsTaches;
        $scope.listedocsTaches = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsTaches.push({
                'norgdre': i + 1,
                'idmag': arraytable[i].idmag,
                'taches': arraytable[i].taches

            });
        }

    }
    //valider ajout tache en lignetacheagents
    $scope.validerAjoutTaches = function () {
        if ($('#contrat_id_agents').val() == "") {
            alert('Il faut choisir un Agent !');
        } else {
            if ($scope.listedocsTaches.length > 0) {
                $scope.document = {
                    'listeslignesdocTaches': $scope.listedocsTaches,
                    'id_agents': $('#contrat_id_agents').val(),
                };
                $http({
                    url: domaineapp + 'Ressourcehumaine.php/contrat/SavedocumentTaches',
                    method: "POST",
                    data: $scope.document,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $('#btnvaliderTache').attr('class', 'btn btn-outline btn-danger');
                }, function myError(response) {
                    alert(response);
                });
            } else
                alert("ERREUR ...!!!");
        }
    }

    //valider ajout personnel
    //
    $scope.validerAjoutPersonnel = function () {

        var agentsid = $('#agents_id').val();
        var matricule = $('#agents_idrh').val();
        var cin = $('#agents_cin').val();
        var nom = $('#agents_nomcomplet').val();
        var prenom = $('#agents_prenom').val();
        var datena = $('#agents_datenaissance').val();
        var idsexe = $('#agents_id_sexe').val();
        var adresse = $('#agents_adresse').val();
        var codepostal = $('#agents_codepostal').val();
        var etatcivil = $('#agents_id_etatcivil').val();
        var idpersonnel = $('#agents_idpersonnel').val();
        var etatmul = $('#agents_etatmulitaire').val();
        var gouv = $('#agents_id_gouvn').val();
        var pays = $('#agents_id_pays').val();
        var gsm = $('#agents_gsm').val();
        var cnss = $('#agents_idcnss').val();
        var dateaff = $('#agents_dateaffiliation').val();
        var rib = $('#agents_rib').val();
        var niveaued = $('#agents_id_niveaueducatif').val();
        var chaeffamille = $('#agents_cheffamille').is(':checked');
        var nbrenfants = $('#agents_nbrenfants').val();
        var age = $('#agents_age').val();
        var id_regroupement = $('#agents_id_regrouppement').val();
        msg = "";
        if ($('#agents_cin').val() == "")
            msg = "Veuillez saisir le cin";
        if ($('#agents_nomcomplet').val() == "")
            msg += "\n Veuillez saisir le nom ";
        if ($('#agents_prenom').val() == "")
            msg += "\n Veuillez saisir le prenom ";
        if ($('#agents_datenaissance').val() == "")
            msg = "Veuillez saisir dae de naissance";
        if ($('#agents_id_sexe').val() == "")
            msg += "\n Veuillez sélectionnez le sexe ";
        if ($('#agents_adresse').val() == "")
            msg += "\n Veuillez saisir l'adresse ";
        if ($('#agents_id_etatcivil').val() == "")
            msg += "\n Veuillez sélectionnez l'eata civil ";
        if ($('#agents_id_gouvn').val() == "")
            msg += "\n Veuillez sélectionnez l'ieu de naissance ";
        if (msg == "") {
            $scope.param = {
                'ci': cin,
                'no': nom,
                'pren': prenom,
                'datn': datena,
                'pa': pays,
                'ids': idsexe,
                'adr': adresse,
                'code': codepostal,
                'etatc': etatcivil,
                'idp': idpersonnel,
                'etatm': etatmul,
                'gou': gouv,
                'id_regroupement': id_regroupement,
                'gs': gsm,
                'cns': cnss,
                'dateaf': dateaff,
                'mat': matricule,
                'nbr': nbrenfants,
                'chef': chaeffamille,
                'niveau': niveaued,
                'ri': rib,
                'age': age,
                'idag': agentsid,
            }
            $http({
                url: domaineapp + 'Ressourcehumaine.php/agents/SavedocumentPersonnel',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                //  $scope.agents = data;
                $('#agents').val(data);
                $('#btnvaliderPersonnelle').attr('class', 'btn btn-outline btn-danger');
                $('#profileNiveaueducatif').attr('class', 'active');
                $('#profilesociale').attr('class', 'active');
            }, function myError(response) {
                alert(response);
            });
        } else
            alert(msg);
    }
    //charge nature discipline
    $scope.ChargerDetailNatureByttpe = function () {
        var id_type = $('#discipline_id_typediscipline').val();
        $scope.param = {
            'idag': id_type
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/discipline/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#discipline_id_naturediscipline', data);
            $('#discipline_id_naturediscipline').val(data);
            $('#discipline_id_naturediscipline').trigger("chosen:updated");
            $('#discipline_id_naturediscipline').val($('#nature').val()).trigger("liszt:updated");
            $('#discipline_id_naturediscipline').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#discipline_id_typediscipline")
        .change(function () {
            if ($("#discipline_id_typediscipline").val() != "") {
                $scope.ChargerDetailNatureByttpe();
            }

        })
        .trigger("change");
    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        //        $(id).val('').trigger("liszt:updated");
        //        $(id).trigger("chosen:updated");
    }
    $scope.ChargerComboP = function (id, data) {

        $(id).empty();
        //       $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        //        $(id).val('').trigger("liszt:updated");
        //        $(id).trigger("chosen:updated");
    }
    $scope.savegrille = function (id, montant) {
        $scope.document = {
            'id': id,
            'montant': montant
        };
        $http({
            url: domaineapp + 'Ressourcehumaine_dev.php/salairedebase/SavedocumentFonctionnaire',
            method: "POST",
            data: $scope.document,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert(data);
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.savegrille2 = function (id, montant) {

        $scope.document = {
            'id': id,
            'montant': montant,
        };
        $http({
            url: domaineapp + 'Ressourcehumaine.php/salairedebase/SavedocumentOuvirer',
            method: "POST",
            data: $scope.document,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert(data);
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.ChargerDetailPoste = function () {
        var idposte = $('#contrat_id_posterh').val();
        $scope.param = {
            'idp': idposte
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/Affichedetailtache',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log('data:' + data.length);
            $scope.listesTaches = data;
            //            $scope.Chargertable('#magtache tbody', data);
            //            $('#magtache').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contrat_id_posterh")
        .change(function () {
            if ($("#contrat_id_posterh").val() != "") {
                $scope.ChargerDetailPoste();
            }
        })
        .trigger("change");
    $scope.Chargertable = function (id, data) {
        $(id).empty();
        //        for (i = 0; i < data.length; i++) {
        //        $(id).append("<tr><td id='idtache_" + data[i].id + "' value='" + data[i].id + "'>" + data[i].libelle + "</td><td>\n\
        //<button ng-click='suprimerTache()'>Supprimer</button></td></tr>");
        //        }
    }






    $scope.ChargerDetailCatByCorps = function () {
        var id_corps = $('#magFiliere').val();
        $scope.param = {
            'idc': id_corps
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailCatByCorps',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#magCat', data);
            $('#magCat').val(data);
            $('#magCat').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magFiliere")
        .change(function () {
            if ($("#magFiliere").val() != "") {
                $scope.ChargerDetailCatByCorps();
            }
        })
        .trigger("change");
    //chager grade
    $scope.ChargerDetailGradeByCorps = function () {

        var id_corps = $('#magC').val();
        $scope.param = {
            'idc': id_corps
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailGByCorps',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#magG', data);
            $('#magG').val(data);
            $('#magG').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magC")
        .change(function () {
            if ($("#magC").val() != "") {
                $scope.ChargerDetailGradeByCorps();
            }
        })
        .trigger("change");
    //charger grade

    $scope.ChargerDetailGradeRByCorps = function () {

        var id_corps = $('#magCo').val();
        $scope.param = {
            'idc': id_corps
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailGradeRByCorps',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#gradeR').removeClass("disabledbutton");
            $scope.ChargerCombo('#contrat_id_graderec', data);
            $('#contrat_id_graderec').val(data);
            $('#contrat_id_graderec').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magCo")
        .change(function () {
            if ($("#magCo").val() != "") {
                $scope.ChargerDetailGradeRByCorps();
            }
        })
        .trigger("change");
    //charger grade titularisation
    $scope.ChargerDetailGradeTByCorps = function () {

        var id_corps2 = $('#magCo2').val();
        $scope.param = {
            'idc': id_corps2
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichedetailGradeTByCorps',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#gradeT').removeClass("disabledbutton");
            //$('#gradeR').addClass("btn-info");
            $scope.ChargerCombo('#contrat_id_gradetitu', data);
            $('#contrat_id_gradetitu').val(data);
            $('#contrat_id_gradetitu').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magCo2")
        .change(function () {
            if ($("#magCo2").val() != "") {
                $scope.ChargerDetailGradeTByCorps();
            }
        })
        .trigger("change");
    //affichage primes
    $scope.AfficheLignedocPrime = function (iddoc) {
        $scope.ChargerPrimeDetaille();
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AffichelignePrimes',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsPrime = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage ligne ouvirer

    $scope.AfficheLignedocOuvrier = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/attestationouvrier/AfficheligneOuvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsOuvrier = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage agents 
    $scope.AfficheDetailAgents = function () {
        if ($('#contrat_id_agents').val() != "") {
            var id_agents = $('#contrat_id_agents').val();
            $scope.param = {
                "id": id_agents,
            }

            $http({
                url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheDetailagents',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $('#refagents').val(data['idrh']);
                $('#agents').val(data['nom']);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            $('#refagents').val('');
            $('#agents').val('');
        }
    }

    $scope.saveAffectation = function (id) {

        var id_lieu = $('#contratouvrier_id_lieuaffetation').val();
        var id_chantier = $('#contratouvrier_id_chantier').val();
        var date_debut = $('#date_debut').val();
        var date_fin = $('#date_fin').val();
        $scope.param = {
            "id_contrat": id,
            "id_lieu": id_lieu,
            "id_chantier": id_chantier,
            "date_debut": date_debut,
            "date_fin": date_fin,
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/saveAffectation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            $('#contratouvrier_id_lieuaffetation').val('').trigger("liszt:updated");
            $('#contratouvrier_id_lieuaffetation').trigger("chosen:updated");
            $('#contratouvrier_id_chantier').val('').trigger("liszt:updated");
            $('#contratouvrier_id_chantier').trigger("chosen:updated");
            $('#date_debut').val('');
            $('#date_fin').val('');
            data = response.data;
            $scope.listesHistorique = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage ouvrier 
    $scope.AfficheDetailOuvrier = function () {
        if ($('#contratouvrier_id_ouvrier').val() != '') {
            var id_ouv = $('#contratouvrier_id_ouvrier').val();
            $scope.param = {
                "id": id_ouv,
            }
            $http({
                url: domaineapp + 'Ressourcehumaine.php/contratouvrier/AfficheDetailOuvrier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $('#refouvrier').val(data['idrh']);
                $('#ouvrier').val(data['nomcomplet']);
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }


    //affichage diplomes
    $scope.AfficheLignedocDiplome = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/Affichelignediplomes',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsD = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affichage specialite
    $scope.AfficheLigneSpecialite = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficheligneSpecialite',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsS = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage langue
    $scope.AfficheLigneLangues = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficheligneLangues',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsL = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affichage formations 
    $scope.AfficheLigneFormations = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficheligneFormations',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsF = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage conjoint 
    $scope.AfficheLigneConjoints = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficheligneConjoints',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsC = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affichage parents 
    $scope.AfficheLigneParents = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/agents/AfficheligneParents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsP = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.suprimerTache = function (id) {
        //         bootbox.confirm({
        //            message: "Voulez-vous supprimer cette ligne ?",
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
        //                    suprimerTache(id);
        //                }
        //            }
        //        });
        //     var index = -1;
        //        var comArr = eval($scope.listesTaches);
        //        for (var i = 0; i < comArr.length; i++) {
        //            if (comArr[i].id === ligne.id) {
        //                index = i;
        //                break;
        //            }
        //        }
        //        $scope.listesTaches.splice(index, 1);

        var idtache = id;
        $scope.param = {
            'idt': idtache
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/deletetache',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            location.reload();
            //            if (data != "" && data != "erreuur!!!!")
            //                document.location.href = "contrat/edit?id=" + data;
        }, function myError(response) {
            alert(response);
        });
    }


    //save demande de voir un fichier 
    $scope.saveDemandeDevoirFicheir = function () {
        var id_service = $('#demandedevoirfichieradmin_id_service').val();
        var id_agents = $('#demandedevoirfichieradmin_id_agents').val();
        var personne = $('#demandedevoirfichieradmin_id_demandeur').val();
        var document1 = $('#demandedevoirfichieradmin_document').val();
        var datedevue = $('#demandedevoirfichieradmin_datedevue').val();
        var signdirecteur = $('#demandedevoirfichieradmin_chemindirecteu').val();
        var signagents = $('#demandedevoirfichieradmin_cheminagents').val();
        var id = $('#demandedevoirfichieradmin_id').val();
        $scope.param = {
            'id_service': id_service,
            'id_agents': id_agents,
            'personne': personne,
            'document': document1,
            'datesue': datedevue,
            'signdirecteur': signdirecteur,
            'signagents': signagents,
            'id': id,
        };
        $http({
            url: domaineapp + 'Ressourcehumaine.php/demandedevoirfichieradmin/SavedocumentDemandedevoirfichier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            //            console.log(data);
            //            if (data != "" && data != "erreurr !!!")
            //                document.location.href = 'edit?id=' + data;
        }, function myError(response) {
            alert(response);
        });
    }

    //save attestation de travail 
    $scope.saveAttestationouvrier2 = function () {
        var id_ch = $('#attestationouvrier_id_chantier').val();
        var id_serv = $('#attestationouvrier_id_service').val();
        var id_direc = $('#attestationouvrier_id_direction').val();
        var budget = $('#attestationouvrier_budget').val();
        var porte = $('#attestationouvrier_porte').val();
        var dated = $('#attestationouvrier_datedebut').val();
        var datef = $('#attestationouvrier_datefin').val();
        var id = $('#attestationouvrier_id').val();
        $scope.param = {
            'id_ch': id_ch,
            'id_serv': id_serv,
            'id_direction': id_direc,
            'budget': budget,
            'porte': porte,
            'dated': dated,
            'datef': datef,
            'id': id,
        };
        $http({
            url: domaineapp + 'Ressourcehumaine.php/attestationouvrier/Savedocumentattestation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data != "" && data != "erreurr !!!")
                document.location.href = domaineapp + "/Ressourcehumaine.php/attestationouvrier/edit?id=" + data;
        }, function myError(response) {
            alert(response);
        });
    }
    //save contrat ouvrier

    $scope.saveContratOuvrier = function () {
        var id_agents = $('#contratouvrier_id_ouvrier').val();
        var datere = $('#contratouvrier_daterecrutement').val();
        var datedd = $('#contratouvrier_datedebutcontrat').val();
        var dateff = $('#contratouvrier_datefincontrat').val();
        var id_sp = $('#contratouvrier_id_specialteouvrier').val();
        var id_ch = $('#contratouvrier_id_chantier').val();
        var id_li = $('#contratouvrier_id_lieuaffetation').val();
        var id_si = $('#contratouvrier_id_situationadmini').val();
        var montant = $('#montant').val();
        var id_pro = $('#contratouvrier_id_projet').val();
        var nbrj = $('#nbjour').val();
        var id_retraite = $('#contratouvrier_id_retraite').val();
        var dateretraite = $('#contratouvrier_dateretraite').val();
        var mtotal = $scope.mt;
        var id = $('#contratouvrier_id').val();
        var id_salairejouralier = $('#contratouvrier_id_salairejouralier').val();

        $scope.param = {
            'id_agents': id_agents,
            'id_salairejouralier': id_salairejouralier,
            'daterecrutement': datere,
            'datedebut': datedd,
            'datefin': dateff,
            'id_specialite': id_sp,
            'id_chantier': id_ch,
            'id_lieu': id_li,
            'id_situation': id_si,
            'montanttotal': mtotal,
            'id_projet': id_pro,
            'nbrj': nbrj,
            'id_retraite': id_retraite,
            'dateretraite': dateretraite,

            'id': id,
        };
        $http({
            url: domaineapp + 'Ressourcehumaine_dev.php/contratouvrier/SavedocumentContratOuvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "mise à jour  avec succes!!",
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

    //affichage historique promotions 
    $scope.AfficheLignedocHistorique = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheligneHistorique',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesPromotions = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage historique contrat ouvrier

    $scope.AfficheLignedocHistoriqueContratouvrier = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/AfficheligneHistoriqueouvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesHistorique = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage historique Fonctions 
    $scope.AfficheLignedocHistoriqueFonctions = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheligneHistoriqueFonctions',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesFonctions = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affichage historique lieu de travail 
    $scope.AfficheLignedocHistoriqueLieu = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheligneHistoriqueLieu',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesLieuTravail = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }


    //affichage historique lieu de travail 
    $scope.AfficheLignedocHistoriqueSituation = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheligneHistoriqueSituation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesSituations = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affiche historique des salaire 
    $scope.AfficheLignedocHistoriqueSalaire = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheligneHistoriqueSalaire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesSalairedebase = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    //affichage historique des positions administratives
    $scope.AfficheLignedocHistoriquePositionsadministative = function (iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/AfficheligneHistoriquePosition',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesPositions = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //affichage de salaire de base

    $scope.AfficheSalairedebsae = function () {

        $http({
            url: domaineapp + '/Ressourcehumaine.php/salairedebase/ListeSalaires',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                for (var i = 0; i < data.length - 1; i++) {
                    id = '#' + data[i].id_categorie + '_' + data[i].id_echelle + '_' + data[i].id_echelon;
                    $(id).val(data[i].motant);
                    id1 = '#' + data[i].id_categorie + '_' + data[i].id_grade + '_' + data[i].id_echelle + '_' + data[i].id_echelon;
                    $(id1).val(data[i].motant);
                }
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.ViderAgents = function (p) {
        $('#refagents' + p).val('');
        $('#agents' + p).val('');
    }

    //ouvrier 
    //    $scope.ChargerDetailRhByOuvrier = function () {
    //
    //        var id_agent = $('#contratouvrier_id_ouvrier').val();
    //        $scope.param = {
    //            'idag': id_agent
    //
    //        }
    //        $http({
    //            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/Affichedetail',
    //            method: "POST",
    //            data: $scope.param,
    //            headers: {
    //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //            }
    //        }).then(function mySucces(response) {
    //            data = response.data[0];
    //            //alert(data);
    //            $('#matricule').val(data['matricule']);
    //            $('#prenom').val(data['prenom']);
    //            $('#nom').val(data['nom']);
    //            $('#rib').val(data['rib']);
    //        }, function myError(response) {
    //            alert(response);
    //        });
    //    }
    //    $("#contratouvrier_id_ouvrier")
    //            .change(function () {
    //                if ($("#contratouvrier_id_ouvrier").val() != "") {
    //                    $scope.ChargerDetailRhByOuvrier();
    //                }
    //            })
    //            .trigger("change");
    //attestation de travil
    $scope.ChargerDetailattestattionByOuvrier = function () {

        var id_agent = $('#attestationdetravail_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/attestationdetravail/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#datenaissnce').val(data['date']);
            $('#lieunaissance').val(data['lieu']);
            $('#corps').val(data['corps']);
            $('#grade').val(data['grade']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#attestationdetravail_id_agents")
        .change(function () {
            if ($("#attestationdetravail_id_agents").val() != "") {
                $scope.ChargerDetailattestattionByOuvrier();
            }
        })
        .trigger("change");
    //attestattion de salaire
    $scope.ChargerDetailattestattiondesalaireByOuvrier = function () {

        var id_agent = $('#attestationdesalaire_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/attestationdesalaire/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            var msalaire = data['montant'] * 12;
            $('#idrh').val(data['idrh']);
            $('#grade').val(data['grade']);
            $('#situation').val(data['situation']);
            $('#montant').val(msalaire);
            $('#attestationdesalaire_id_contrat').val(data['idcontrat']);
            $scope.ChargerPrimeParIdContrat(data['idcontrat'], msalaire);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#attestationdesalaire_id_agents")
        .change(function () {
            if ($("#attestationdesalaire_id_agents").val() != "") {
                $scope.ChargerDetailattestattiondesalaireByOuvrier();
            }
        })
        .trigger("change");
    //charger formulaire 

    $scope.ChargerDetailformulaire = function () {

        var id_agent = $('#formulaire_id_agents').val();
        $scope.param = {
            'idag': id_agent

        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/formulaire/Affichedetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#prenom').val(data.agents[0]['prenom']);
            $('#nom').val(data.agents[0]['nom']);
            $('#date').val(data.agents[0]['daten']);
            $('#lieunais').val(data.agents[0]['lieunais']);
            $('#identifiantunique').val(data.agents[0]['idrh']);
            $('#lieutravail').val(data.contrat[0]['lieutravail']);
            $('#gradea').val(data.contrat[0]['gradea']);
            $('#echelon_2').val(data.contrat[0]['echelon']);
            $('#corps_2').val(data.contrat[0]['corps']);
            $('#dateen').val(data.contrat[0]['dateen']);
            $('#dategrade').val(data.contrat[0]['dategrade']);
            var dString = data.contrat[0]['dateen'];
            var dategrade = data.contrat[0]['dategrade']
            var d1 = new Date(dString);
            var d2 = new Date();
            var d3 = new Date(dategrade)

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
            var DateDiff2 = {
                inDays: function (d1, d3) {
                    var t2 = d3.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000));
                },
                inWeeks: function (d1, d3) {
                    var t2 = d3.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
                },
                inMonths: function (d1, d3) {
                    var d1Y = d1.getFullYear();
                    var d2Y = d2.getFullYear();
                    var d1M = d1.getMonth();
                    var d2M = d3.getMonth();
                    return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                },
                inYears: function (d1, d3) {
                    return d3.getFullYear() - d1.getFullYear();
                }
            }
            var anciente = "A : " + DateDiff.inYears(d1, d2) + " M : " + DateDiff.inMonths(d1, d2) + "  J : " + DateDiff.inDays(d1, d2);
            $('#anciente').val(anciente);
            var anciente2 = "A : " + DateDiff2.inYears(d1, d3) + "  M : " + DateDiff2.inMonths(d1, d3) + "  J : " + DateDiff.inDays(d1, d3);
            $('#ancientegradea').val(anciente2);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#formulaire_id_agents")
        .change(function () {
            if ($("#formulaire_id_agents").val() != "") {
                $scope.ChargerDetailformulaire();
            } else {
                $('#prenom').val("");
                $('#nom').val("");
                $('#date').val("");
                $('#lieunais').val("");
                $('#lieutravail').val("");
                $('#identifiantunique').val("");
                $('#gradea').val("");
                $('#echelon_2').val("");
                $('#corps_2').val("");
                $('#dateen').val("");
                $('#dategrade').val("");
                $('#anciente').val("");
                $('#ancientegradea').val("");
            }
        })
        .trigger("change");
    $scope.ChargerPrimeParIdContrat = function (id, msalaire) {
        $scope.param = {
            'idp': id
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/attestationdesalaire/AffichedetailPrime',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesPrimes = data;
            var totalp = 0;
            for (var i = 0; i < $scope.listesPrimes.length; i++) {
                totalp = eval(totalp) + eval($scope.listesPrimes[i].montant);
            }

            totalp = eval(msalaire) + totalp;
            $('#idtotal').html(totalp.toFixed(3));
            $scope.affichermontant(totalp);
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.affichermontant = function (totalattestation) {
        $scope.param = {
            'montant': totalattestation
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/attestationdesalaire/Affichemontant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#totalatt').html(data);
        }, function myError(response) {
            alert(response);
        });
    }
    //charger montant
    $scope.ChargerMontantRhByOuvrier = function () {

        var id_agent = $('#contratouvrier_id_situationadmini').val();
        $scope.param = {
            'idsit': id_agent
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contratouvrier/Affichedetailmontant',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#montant').val(data['montant']);
            var mtparjou = parseFloat(data['montant']);
            var nb = $('#nbjour').val();
            $scope.mt = parseFloat(parseFloat(mtparjou) * parseFloat(nb));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#contratouvrier_id_situationadmini")
        .change(function () {
            if ($("#contratouvrier_id_situationadmini").val() != "") {
                $scope.ChargerMontantRhByOuvrier();
            }
        })
        .trigger("change");
    //save contrat 
    $scope.saveDocumentContrat = function () {
        if ($('#contrat_id_agents').val() == "0" || $('#contrat_datevalidesalaire').val() == '' || $('#contrat_id_codesociale').val() == "0" || $('#contrat_id_lignecodesociale').val() == "0" || $('#contrat_montant').val() == "" || $('#contrat_id_contribiton').val() == "" || $('#contrat_datevalidesalaire').val() == "" || $('#contrat_id_unite').val() == "") {

            bootbox.dialog({
                message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Il faut choisir le code sociale , l'agent, les paramètres du salaire, la date de validation , l'unite et le contribition patronale  !!!!</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        } else {
            var id_agents = $('#contrat_id_agents').val();
            var id_typec = $('#contrat_id_typecontrat').val();
            var id_fonction = $('#contrat_id_fonction').val();
            var id_lieu = $('#contrat_id_lieu').val();
            var id_statu = $('#contrat_id_positionadmini').val();
            var dateempo = $('#contrat_dateemposte').val();
            var datettitu = $('#contrat_datetitulaire').val();
            var id_gradetitu = $('#contrat_id_gradetitu').val();
            var id_gradere = $('#contrat_id_graderec').val();
            var montant = $('#contrat_montant').val();
            var id_salaire = $('#contrat_id_salairedebase').val();
            var dateechelle = $('#contrat_dateechelle').val();
            var dateechelon = $('#contrat_dateechelon').val();
            var id_poste = $('#contrat_id_posterh').val();
            var datepro = $('#contrat_datepromotions').val();
            var dategrade = $('#contrat_dategrade').val();
            var grade = $('#magG').val();
            var naturepromo = $('#contrat_id_naturepromo').val();
            var id_retratite = $('#contrat_id_retratite').val();
            var dateretaite = $('#contrat_dateretraite').val();
            var id_regime = $('#contrat_id_regime').val();
            var datevalidationdemodification = $('#contrat_datevalidesalaire').val();
            var id_codesociale = $('#contrat_id_codesociale').val();
            var idunique = $('#contrat_idunique').val();
            var dateaffiliation = $('#contrat_dateaffiliation').val();
            var salairetheorique = $('#contrat_salairetheorique').val();
            var id_lignecodesociale = $('#contrat_id_lignecodesociale').val();
            var id_contribition = $('#contrat_id_contribiton').val();
            var id_lignecontribition = $('#contrat_id_lignecontribition').val();
            var total_taux = $('#contrat_totaltauxsociale').val();
            var id_unite = $('#contrat_id_unite').val();

            var specialite = $('#contrat_specialite').val();
            var id = $('#contrat_id').val();
            $scope.param = {
                'id_agents': id_agents,
                'type_contrat': id_typec,
                'id_fonction': id_fonction,
                'id_lieu': id_lieu,
                'id_situation': id_statu,
                'dateemposte': dateempo,
                'datetitularisation': datettitu,
                'gradetitu': id_gradetitu,
                'graderecretement': id_gradere,
                'montant': montant,
                'idsalaire': id_salaire,
                'dateechelle': dateechelle,
                'dateechelon': dateechelon,
                'idposte': id_poste,
                'datepromotion': datepro,
                'dategrade': dategrade,
                'grade': grade,
                'naturepromotion': naturepromo,
                'id_retratite': id_retratite,
                'dateretaite': dateretaite,
                'id_regime': id_regime,
                'datevalidationdemodification': datevalidationdemodification,
                'id_codesociale': id_codesociale,
                'idunique': idunique,
                'dateaffiliation': dateaffiliation,
                'salairetheorique': salairetheorique,
                'id_lignecodesociale': id_lignecodesociale,
                'id_contribition': id_contribition,
                'id_lignecontribition': id_lignecontribition,
                'total_taux': total_taux,
                'id_unite': id_unite,
                'id': id,
                'specialite': specialite,
            };
            $http({
                url: domaineapp + 'Ressourcehumaine.php/contrat/SaveContrat',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                if (data != "" && data != "erreurr !!!") {
                    var id = (data['id']);
                    var id_regroupement = data['id_regroupement'];
                    document.location.href = "edit?id=" + id + '&reg=' + id_regroupement;

                }


            }, function myError(response) {
                alert(response);
            });
        }
    }
    //contrat du personnel militaire

    //cahrger corps det 
    $scope.ChargerCorpsdet = function () {

        var corps = $('#magFiliere').val();
        $scope.param = {
            'idcorps': corps
        }
        $http({
            url: domaineapp + 'Ressourcehumaine.php/contrat/Affichecorpsdet',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#magC', data);
            $('#magC').val(data);
            $('#magC').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magFiliere")
        .change(function () {
            if ($("#magFiliere").val() != "") {
                $scope.ChargerCorpsdet();
            }
        })
        .trigger("change");
});
app.filter('trusted', ['$sce', function ($sce) {
    var div = document.createElement('div');
    return function (text) {
        div.innerHTML = text;
        return $sce.trustAsHtml(div.textContent);
    };
}]);
app.controller('CtrlContrat', function ($scope, $http) {
    $scope.saveDocumentContratmilitaire = function () {

        if ($('#contrat_id_agents_militaire').val() == "") {
            alert("Il faut choisir l\'agent !");
        }
        if ($('#contrat_id_agents_militaire').val() != "") {
            var id_agents = $('#contrat_id_agents_militaire').val();
            var id_poste = $('#contrat_id_posterh').val();
            var id_unite = $('#contrat_id_unite').val();
            var id_grade = $('#contrat_id_graderec').val();
            var dateemposte = $('#contrat_dateemposte').val();
            var specialite = $('#contrat_specialite').val();
            var id = $('#contrat_id').val();
            $scope.param = {
                'id_agents': id_agents,
                'idposte': id_poste,
                'id_unite': id_unite,
                'id_grade': id_grade,
                'dateemposte': dateemposte,
                'specialite': specialite,
                'id': id,
            };

            $http({
                url: domaineapp + 'Ressourcehumaine.php/contrat/SaveContratmilitaire',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: "<span class='bigger-160' style='margin:20px;color:#b31531;'>Ajout avec succées !!!</span>",
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
    }
});