var domaineapp = 'http://' + window.location.hostname + '/';

app.controller('CtrlFormation', function($scope, $http) {


    $scope.listedocsPlaning = [];
    //calcul montant risoturne et m societe 
    $scope.Calculmontantristourne = function(id) {
        var nbrj = $('#nbrj_' + id).val();
        var nbheure = $('#nbheure_' + id).val();
        var base = $('#base_' + id).val();
        var ris = $('#ris_' + id).val();
        var ris = ris.replace("%", "");
        var montht = $('#montantht_' + id).val();
        var min = 0;
        var montantristourne = 0;
        nbheure = nbheure / 6;
        if (nbrj != "" && nbheure == "") {
            min = nbrj;
            montantristourne = parseFloat(parseFloat((base) * min * ris) / 100);
            $('#mristourne_' + id).val(parseFloat(montantristourne));
        } else if (nbheure != "" && nbrj == "") {

            min = nbheure;
            montantristourne = parseFloat(parseFloat((base) * min * ris) / 100);
            $('#mristourne_' + id).val(parseFloat(montantristourne).toFixed(3));
        } else if (nbheure != "" && nbrj != "") {
            if (nbrj < nbheure) {
                min = nbrj;
            } else
                min = nbheure;
        }
        montantristourne = parseFloat(parseFloat((base) * min * ris) / 100);
        $('#mristourne_' + id).val(parseFloat(montantristourne));
        var monsociete = 0;
        monsociete = parseFloat(montht) - parseFloat(montantristourne);
        $('#msociete_' + id).val(parseFloat(monsociete));
    }

    $scope.initiliserevaluation = function(id) {
        $scope.param = {
            "id": id,
        }
        $http({
            url: domaineapp + 'formation.php/evaluation/afficheevaliation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#conditionheberegement').val(data['condition']);
            $('#noteorganise').val(data['notecomposant']);
            $('#notefor').val(data['noteformateur']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $(".liste_formation")
        .change(function() {
            var id = $(this).attr('ligne_id');
            if ($('#input_dated_' + id).val() != "" && $('#input_datefin_' + id).val() != "") {
                $scope.calculNbrjourHM(id);
            }
        })
        //charger nbjour nbheure 
    $scope.calculNbrjourHM = function(id) {
        if ($('#input_dated_' + id).val() != "" && $('#input_datefin_' + id).val() != "") {
            //            var ris = $('#ristourne_' + id).val().replace("%", "");
            //            var base = $('#baseri_' + id).val();
            //            var montht = $('#input_montant_' + id).val();

            var d1 = new Date($('#input_dated_' + id).val());
            var d2 = new Date($('#input_datefin_' + id).val());
            var DateDiff = {
                inDays: function(d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000) + 1);
                },
                inWeeks: function(d1, d2) {
                    var t2 = d2.getTime();
                    var t1 = d1.getTime();
                    return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
                },
                inMonths: function(d1, d2) {
                    var d1Y = d1.getFullYear();
                    var d2Y = d2.getFullYear();
                    var d1M = d1.getMonth();
                    var d2M = d2.getMonth();
                    return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
                },
                inYears: function(d1, d2) {
                    return d2.getFullYear() - d1.getFullYear();
                }
            }

            var nbrj = DateDiff.inDays(d1, d2);
            $('#nbrjour_' + id).val(nbrj);
            //            var nbrH = nbrj * 6;
            //            $('#nbrheure_' + id).val(nbrH);


            //            var min = 1;
            //            var montantristourne = 1;
            //            nbrH = nbrH / 6;
            //            if (nbrH != "" && nbrj != "")
            //            {
            //                if (nbrj < nbrH)
            //                {
            //                    min = nbrj;
            //                }
            //                else
            //                    min = nbrH;
            //            }
            //            montantristourne = parseFloat(parseFloat((base) * min * ris) / 100);
            //            $('#mris_' + id).val(parseFloat(montantristourne));
            //            var monsociete = 0;
            //            if (montht != "")
            //            {
            //                monsociete = parseFloat(montht) - parseFloat(montantristourne);
            //                $('#msoc_' + id).val(parseFloat(monsociete));
            //            }


        }
        //        var nbrj = $("#nbrj").val();
        //        var nbrh = 6;
        //        nbrh = parseFloat(parseFloat(nbrh) * parseFloat(nbrj));
        //
        //        $('#nbheure').val(parseFloat(nbrh));


    }
    $scope.ValiderLigneTableua = function(id) {
            var nbj = $('#nbrj_' + id).val();
            var nbrh = $('#nbheure_' + id).val();
            var mris = $('#mristourne_' + id).val();
            var msoc = $('#msociete_' + id).val();
            var modalite = $('#modalite_' + id).val();
            $scope.param = {
                "nbjr": nbj,
                "nbrh": nbrh,
                "mris": mris,
                "msoc": msoc,
                "modalite": modalite,
                "id": id,
            }
            $http({
                url: domaineapp + 'formation.php/planing/SaveligneTableau',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: "ajout avec succès !",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                $('#btnvalidTab_' + id).addClass("btn-danger")
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //charger tableau de formation

    //    $scope.ChargerListe = function () {
    //        var id_agent = $('#besoinsdeformation_id_agents').val();
    //        $scope.param = {
    //            'idag': id_agent,
    //        }
    //        $http({
    //            url: domaineapp + 'formation.php/besoinsdeformation/AffichedetailAgents',
    //            method: "POST",
    //            data: $scope.param,
    //            headers: {
    //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //            }
    //        }).then(function mySucces(response) {
    //            data = response.data[0];
    //            $('#idrh').val(data['idrh']);
    //            $('#poste').val(data['poste']);
    //            $('#nom').val(data['nom']);
    //            $('#unite').val(data['unite']);
    //            $('#service').val(data['service']);
    //            $('#sousdirection').val(data['sousdirection']);
    //            $('#direction').val(data['direction']);
    //        }, function myError(response) {
    //            alert(response);
    //        });
    //    }
    //
    //    $("#tableaubordformation_id_plan")
    //            .change(function () {
    //                if ($("#tableaubordformation_id_plan").val() != "") {
    //                    $scope.ChargerListe();
    //                }
    //            })
    //            .trigger("tableaubordformation_id_plan");
    //


    // initialiser champs planingn
    $scope.intilaiserChamps = function() {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
        $('#annee2').attr('style', 'width:100%');
        $('#annee2').trigger("chosen:updated");
    }

    $scope.intiliser = function() {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }

    $scope.TestCin = function() {
        msg2 = "";
        if ($("#formateur_cin").mask('99999999'))
            msg2 = "cin doit composer de 8 chiffre !!! ";
        console.log(msg2);
    }

    $("#formateur_cin")
        .change(function() {
            if ($("#formateur_cin").val() != "") {
                $scope.TestCin();
            }
        })
        .trigger("change");
    // charger nom prenom agents
    $scope.AfficheAgents = function() {
            $scope.param = {
                'ag': $('#agents').val(),
                'ref': $('#refagents').val()
            }
            $http({
                url: domaineapp + '/Formation.php/besoinsdeformation/ListeAgents',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.agents = data;
                AjoutHtmlAfterTRansfert(data, '#refagents', '#agents', '#besoinsdeformation_id_agents');
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //charger page besoin de formation

    $scope.Affichedetail = function() {
        var id_agent = $('#besoinsdeformation_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'formation.php/besoinsdeformation/AffichedetailAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //alert(data);
            $('#idrh').val(data.agents[0]['idrh']);
            $('#besoins_nomprenom').val(data.agents[0]['nomcomplet']);
            $('#poste').val(data.contrat[0]['poste']);
            $('#uniterh').val(data.contrat[0]['unite']);
            $('#servicerh').val(data.contrat[0]['service']);
            $('#sousdirectionrh').val(data.contrat[0]['sousdirection']);
            $('#directionrh').val(data.contrat[0]['direction']);
            $('#id_contrat').val(data.contrat[0]['idcontrat']);
            $('#id_poste').val(data.contrat[0]['idp']);
            $('#id_unite').val(data.contrat[0]['id_unite']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#besoinsdeformation_id_agents")
        .change(function() {
            if ($("#besoinsdeformation_id_agents").val() != "0") {
                $scope.Affichedetail();
            } else {
                $('#idrh').val('');
                $('#besoins_nomprenom').val('');
                $('#poste').val('');
                $('#uniterh').val('');
                $('#servicerh').val('');
                $('#sousdirectionrh').val('');
                $('#directionrh').val('');
                $('#id_contrat').val('');
                $('#id_poste').val('');
                $('#id_unite').val('');
            }
        })
        .trigger("change");
    //charger agents page evaluatio
    $scope.AffichedetailAgents = function() {
        var id_agent = $('#evaluation_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'formation.php/evaluation/AffichedetailAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#grade').val(data.contrat[0]['grade']);
            $('#poste').val(data.contrat[0]['poste']);
            $('#lieu').val(data.lieutravail[0]['lieutravail']);
            $('#directionEval').val(data.contrat[0]['direction']);
            //            $scope.ChargerCombo('#magFormation', data['besoins']);
            //            $('#magFormation').val(data['besoins']);
            //            $('#magFormation').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AffichedetailBesoinsFormation = function() {
        var id_agent = $('#evaluation_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'formation.php/evaluation/AffichedetailBesoinsFormation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#magFormation', data);
            $('#magFormation').val(data);
            $('#magFormation').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#evaluation_id_agents")
        .change(function() {
            if ($("#evaluation_id_agents").val() != "0") {
                $scope.AffichedetailAgents();
                if ($("#libelle_besoins").val() == "0") {
                    $scope.AffichedetailBesoinsFormation();
                }
            } else {
                $('#magFormation').val('');
                $('#magFormation').trigger("chosen:updated");
                $('#grade').val('');
                $('#poste').val('');
                $('#lieu').val('');
                $('#directionEval').val('');
                $('#sousrubirque').val("");
                $('#theme').val("");
                $('#formateur_evaluation').val("");
                $('#organisme_evaluation').val("");
                $('#dated').val("");
                $('#datef').val("");
                $('#durre').val("");
                $('#idbesoins').val("");
            }
        })
        .trigger("change");
    $scope.ChargerCombo = function(id, data) {
            $(id).empty();
            for (i = 0; i < data.length; i++) {
                $(id).append("<option value='" + data[i].id + "'>" + data[i].besoins + "</option>");
            }
            $(id).val('').trigger("liszt:updated");
            $(id).trigger("chosen:updated");
        }
        //chargerinformtaion du besoins choisi 

    $scope.AffichedetailFormation = function() {
        var id_fo = $('#magFormation').val();
        $scope.param = {
            'idFormation': id_fo,
        }
        $http({
            url: domaineapp + 'formation.php/evaluation/AffichedetailFormation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data != null) {
                $('#sousrubirque').val(data['sousrubirque']);
                $('#theme').val(data['theme']);
                $('#formateur_evaluation').val(data['formateur']);
                $('#organisme_evaluation').val(data['organisme']);
                $('#dated').val(data['dated']);
                $('#datef').val(data['datef']);
                $('#durre').val(data['durre']);
                $('#idbesoins').val(data['idbe']);
            } else {
                $('#sousrubirque').val("");
                $('#theme').val("");
                $('#formateur_evaluation').val("");
                $('#organisme_evaluation').val("");
                $('#dated').val("");
                $('#datef').val("");
                $('#durre').val("");
                $('#idbesoins').val("");
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $("#magFormation")
        .change(function() {
            if ($("#magFormation").val() != "") {
                $scope.AffichedetailFormation();
            }
        })
        .trigger("change");
    $(".check_realise")
        .change(function() {
            var id = $(this).attr('ligne_id');
            $scope.intiliserdate(id);
        });
    //enabled les date et disabled motif 
    $scope.intiliserdate = function(id) {
        if ($('#realise_' + id).is(':checked')) {
            $('#input_datefin_' + id).removeClass("disabledbutton");
            $('#input_dated_' + id).removeClass("disabledbutton");
            $('#motif_' + id).addClass("disabledbutton");
            $('#motif_' + id).val('');
        } else {
            $('#input_datefin_' + id).addClass("disabledbutton");
            $('#input_dated_' + id).addClass("disabledbutton");
            $('#motif_' + id).removeClass("disabledbutton");
            $('#input_datefin_' + id).val('');
            $('#input_dated_' + id).val('');
            $('#nbrjour_' + id).val('');
        }
        $scope.CalculMontantTTCTotal(id);
    }

    $scope.CalculMontantTTCTotal = function() {
        var MtotalTTC = 0;
        $('[name="chekrealise"]').each(function() {
            var ligne_montantTTC = 0;
            if ($(this).is(':checked')) {
                id = $(this).attr("ligne_id");
                if ($("#input_montanttc_" + id).val() != '')
                    ligne_montantTTC = parseFloat($("#input_montanttc_" + id).val());
                MtotalTTC = parseFloat(MtotalTTC) + parseFloat(ligne_montantTTC);
            }
        });
        $('#montanttotaTTCRealise').val(parseFloat(MtotalTTC).toFixed(3));
    }

    $scope.intiliserEligible = function() {
        if ($('#planing_elignible').is(':checked')) {
            $('#planing_noneligibletfp').addClass("disabledbutton");
        } else {
            $('#planing_noneligibletfp').removeClass("disabledbutton");
            $('#planing_elignible').removeClass("disabledbutton");
        }
    }
    $("#planing_elignible")
        .change(function() {
            $scope.intiliserEligible();
        })
        .trigger("change");
    $scope.intiliserNonEligible = function() {
        if ($('#planing_noneligibletfp').is(':checked')) {
            $('#planing_elignible').addClass("disabledbutton");
        } else {
            $('#planing_noneligibletfp').removeClass("disabledbutton");
            $('#planing_elignible').removeClass("disabledbutton");
        }
    }

    $("#planing_noneligibletfp")
        .change(function() {
            $scope.intiliserNonEligible();
        })
        .trigger("change");
    $scope.AffichedetailBesoins = function() {
        var id_besoins = $('#magbesoins').val();
        $scope.param = {
            'idag': id_besoins
        }
        $http({
            url: domaineapp + 'formation.php/planing/AffichedetailBesoins',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
            $('#nom').val(data['nom']);
        }, function myError(response) {
            alert(response);
        });
    }

    $("#magbesoins")
        .change(function() {
            if ($("#magbesoins").val() != "") {
                $scope.AffichedetailBesoins();
            }
        })
        .trigger("change");
    //calcul total
    $scope.CalculTotal = function() {
        var comArr = eval($scope.listedocsPlaning);
        var total = 0;
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].valide)
                total = parseFloat(parseFloat(total) + parseFloat(comArr[i].montantht));
        }
        $('#montanttotal').val(parseFloat(total).toFixed(3));
    }

    //ajouter ligne planing    
    $scope.AjouterLignePlaning = function() {
        trouve = 0;
        if ($('#montantht').val() != "") {
            if ($('#nordre').val() == "") {
                nordre = $scope.listedocsPlaning.length + 1;
                if ($('#magbesoins').val() != "" && $('#montantht').val() != "") {
                    $scope.listedocsPlaning.push({
                        'norgdre': nordre,
                        'idrh': $('#idrh').val(),
                        'nom': $('#nom').val(),
                        'ntheme': $('#ntheme').val(),
                        'theme': $('#theme').val(),
                        'idmagbesoins': $('#magbesoins').val(),
                        'magbesoins': $('#magbesoins option:selected').text(),
                        'idmagreg': $('#magreg').val(),
                        'magreg': $('#magreg option:selected').text(),
                        'idmagsousru': $('#magsousrubrique').val(),
                        'magsousrubrique': $('#magsousrubrique option:selected').text(),
                        'montantht': $('#montantht').val(),
                        'valide': $('#valide').is(':checked'),
                    });
                }
            } else {
                var comArr = eval($scope.listedocsPlaning);
                for (var i = 0; i < comArr.length; i++) {
                    if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                        comArr[i].idrh = $('#idrh').val();
                        comArr[i].nom = $('#nom').val();
                        comArr[i].ntheme = $('#ntheme').val();
                        comArr[i].theme = $('#theme').val();
                        comArr[i].idmagbesoins = $('#magbesoins').val();
                        comArr[i].magbesoins = $('#magbesoins option:selected').text();
                        comArr[i].idmagreg = $('#magreg').val();
                        comArr[i].magreg = $('#magreg option:selected').text();
                        comArr[i].idmagsousru = $('#magsousrubrique').val();
                        comArr[i].magsousrubrique = $('#magsousrubrique option:selected').text();
                        comArr[i].montantht = $('#montantht').val();
                        comArr[i].valide = $('#valide').is(':checked');
                        break;
                    }
                }
            }
            trouve = 1;
        } else {
            bootbox.dialog({
                message: "Il faut saisir le montant prévisionel !!!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }

        $scope.CalculTotal();
        $scope.InaliserLignePlaning();
    }

    //initialiser champs Planing
    $scope.InaliserLignePlaning = function() {
        $('#nordre').val('');
        $('#idrh').val('');
        $('#nom').val('');
        $('#ntheme').val('');
        $('#theme').val('');
        $('#valide').is(':checked');
        $('#magbesoins').val('');
        $('#magbesoins').trigger("chosen:updated");
        $('#magreg').val('');
        $('#magreg').trigger("chosen:updated");
        $('#magsousrubrique').val('');
        $('#magsousrubrique').trigger("chosen:updated");
        $('#montantht').val('');
    }

    //MISAjour Planing
    $scope.MisAJourPlaningn = function(lignedocPlaning) {
            $('#nordre').val(lignedocPlaning.norgdre);
            $('#idrh').val(lignedocPlaning.idrh);
            $('#nom').val(lignedocPlaning.nom);
            $('#theme').val(lignedocPlaning.theme);
            $('#ntheme').val(lignedocPlaning.ntheme);
            $('#montantht').val(lignedocPlaning.montantht);
            $('#magbesoins').val(lignedocPlaning.idmagbesoins);
            $('#magbesoins').trigger("chosen:updated");
            $('#magsousrubrique').val(lignedocPlaning.idmagsousru);
            $('#magsousrubrique').trigger("chosen:updated");
            $('#magreg').val(lignedocPlaning.idmagreg);
            $('#magreg').trigger("chosen:updated");
            if (lignedocPlaning.valide == 1)
                $('#valide').attr('checked', 'true');
            else if (lignedocPlaning.valide == 0)
                $('#valide').removeAttr('checked');
        }
        //Delete planing
    $scope.DeletePlaning = function(lignedocPlaning) {
        var index = -1;
        var comArr = eval($scope.listedocsPlaning);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocPlaning.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsPlaning.splice(index, 1);
        $scope.CalculTotal();
        $scope.inialiserTablePlaning();
    }
    $scope.inialiserTablePlaning = function() {
        var arraytable = [];
        arraytable = $scope.listedocsPlaning;
        $scope.listedocsPlaning = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsPlaning.push({
                'norgdre': i + 1,
                'nom': arraytable[i].nom,
                'idrh': arraytable[i].idrh,
                'ntheme': arraytable[i].ntheme,
                'theme': arraytable[i].theme,
                'montantht': arraytable[i].montantht,
                'magbesoins': arraytable[i].magbesoins,
                'besoinsdeformation': arraytable[i].besoinsdeformation,
                'magreg': arraytable[i].magreg,
                'magsousrubrique': arraytable[i].magsousrubrique,
                'valide': arraytable[i].valide,
            });
        }
    }

    //save besoiins de formation 
    $scope.saveBesoins = function() {
        if ($('#besoinsdeformation_besoins').val() == "") {
            bootbox.dialog({
                message: "Veuillez remplir le besoins de formation !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        } else {
            var id_agents = $('#besoinsdeformation_id_agents').val();
            var id_contrat = $('#id_contrat').val();
            var id_poste = $('#id_poste').val();
            var id_unite = $('#id_unite').val();
            var competance = $('#besoinsdeformation_competance').val();
            var besoins = $('#besoinsdeformation_besoins').val();
            var annee = $('#besoinsdeformation_annee').val();
            var id = $('#besoinsdeformation_id').val();
            $scope.param = {
                'id_agents': id_agents,
                'competance': competance,
                'besoins': besoins,
                'annee': annee,
                'id_contrat': id_contrat,
                'id_poste': id_poste,
                'id_unite': id_unite,
                'id': id,
            };
            $http({
                url: domaineapp + 'formation.php/besoinsdeformation/SavedocumentBesoins',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: "ajout avec succès !",
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

    //save evaluation
    $scope.saveEvaluation = function() {
        var id_agents = $('#evaluation_id_agents').val();
        var idbesoins = $('#magFormation').val();
        var codi = $('#evaluation_conditionslogement').val();
        var noteorga = $('#evaluation_notecomposant').val();
        var noteformat = $('#evaluation_noteformateur').val();
        var connai = $('#evaluation_connaissanceaquise').val();
        var competa = $('#evaluation_competance').val();
        var observa = $('#evaluation_observation').val();
        var id = $('#evaluation_id').val();
        var degre = $('#evaluation_degreobjectif').val();
        var structure = $('#evaluation_structureprog').val();
        $scope.param = {
            'id_agents': id_agents,
            'idbes': idbesoins,
            'condition': codi,
            'noteorga': noteorga,
            'noteformater': noteformat,
            'connai': connai,
            'competance': competa,
            'observa': observa,
            'degre': degre,
            'structure': structure,
            'id': id,
        };
        $http({
            url: domaineapp + 'formation.php/evaluation/SavedocumentEvaluation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "ajout avec succès !",
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

    //save planning
    $scope.ValidersavePlanning = function() {
        if ($scope.listedocsPlaning.length > 0) {
            $scope.document = {
                'listeLignedocsPlaning': $scope.listedocsPlaning,
                'montantT': $('#montanttotal').val(),
                'idplaning': $('#planing_id').val(),
            };
            $http({
                url: domaineapp + 'formation.php/planing/SavedocumentPlaning',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                bootbox.dialog({
                    message: "ajout avec success !",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                $('#btnvaliderPlan').attr('class', 'btn btn-outline btn-danger');
            }, function myError(response) {
                alert(response);
            });
        } else {
            bootbox.dialog({
                message: "Il faut ajouter au moin un ligne dans le planning !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    //Vérifier l'existance par l'année
    $scope.verifExistance = function() {
        var id = $("#planing_id").val();
        var annee = $('#planing_annee').val();
        $scope.param = {
            "id": id,
            'annee': annee,
        }
        $http({
            url: domaineapp + 'formation.php/planing/verifExistance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data) {
                if (data.id == 0) {
                    $('#btnvalider2').removeClass("disabledbutton");
                } else {
                    $('#btnvalider2').addClass("disabledbutton");
                    bootbox.dialog({
                        message: "Planning existe déjà pendant la'année " + annee + " !",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
            } else {
                $('#btnvalider2').removeClass("disabledbutton");
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $("#planing_annee")
        .change(function() {
            if ($('#planing_annee').val() != "") {
                $scope.verifExistance();
            } else {
                $('#btnvalider2').addClass("disabledbutton");
            }
        }).trigger("change");
    //save entetepluning
    $scope.saveEntete = function() {
        var annee = $('#planing_annee').val();
        var objet = $('#planing_objet').val();
        var eligibletefp = $('#planing_elignible').is(':checked');
        var noneligibletefp = $('#planing_noneligibletfp').is(':checked');
        var id = $('#planing_id').val();
        $scope.param = {
            'annee': annee,
            'ob': objet,
            'eligible': eligibletefp,
            'noneligible': noneligibletefp,
            'id': id,
        };
        $http({
            url: domaineapp + 'formation.php/planing/Savedocument',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            console.log(data);
            if (data != "" && data != "erreurr !!!")
                document.location.href = 'edit?id=' + data;
        }, function myError(response) {
            alert(response);
        });
    }

    //affichage liste 
    $scope.ListeFormationsPrevu = function(iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'formation.php/planing/AffichelignePlaning',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsPlaning = data;
            //            $('#montanttotal').val(data['montanttotal']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.Afficheanne = function(id) {
        $scope.param = {
            "id": id
        }
        $http({
            url: domaineapp + 'formation.php/besoinsdeformation/AfficheAnnee',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#besoinsdeformation_annee').val(data['annee']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //    $scope.AffichagePlan = function (iddoc) {
    //        $scope.param = {
    //            "id": iddoc
    //        }
    //        $http({
    //            url: domaineapp + 'Formation.php/planing/AffichePlan',
    //            method: "POST",
    //            data: $scope.param,
    //            headers: {
    //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //            }
    //        }).then(function mySucces(response) {
    //            data = response.data;
    //            if (data.length > 0) {
    //                for (var i = 0; i < data.length - 1; i++) {
    //                    id = '#' + data[i].id_categorie + '_' + data[i].id_echelle + '_' + data[i].id_echelon;
    //                    $(id).val(data[i].motant);
    //
    //                }
    //            }
    //        }, function myError(response) {
    //            alert("Erreur d'ajout");
    //        });
    //    }
    //affichage montant total 

    $scope.affichagemontanttotal = function(iddoc) {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'formation.php/planing/Affichemontant',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $('#montanttotal').val(data['montanttotal'].trim());
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //transferer pluning 
        //
        //    $scope.transfererPlaning = function (iddoc) {
        //        alert(iddoc);
        //        $scope.param = {
        //            "id": iddoc
        //        }
        //        $http({
        //            url: domaineapp + 'Formation.php/planing/AffichePlan',
        //            method: "POST",
        //            data: $scope.param,
        //            headers: {
        //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        //            }
        //        }).then(function mySucces(response) {
        //            data = response.data;
        //          document.location.href = 'showdocument' + data;
        //
        //        }, function myError(response) {
        //            alert("Erreur d'ajout");
        //        });
        //    }

    //valider plan 
    // save page show realisation
    $scope.ValiderLigneRealisation = function(id) {
        var form = $('#formateur_' + id).val();
        var org = $('#organisme_' + id).val();
        var mont = $('#input_montant_' + id).val();
        var tva = $('#tva_' + id).val();
        var mtva = $('#input_montanttva_' + id).val();
        var montanttc = $('#input_montantttc_' + id).val();
        var monttotal = $('#montanttotal').val();
        var datedprevu = $('#input_datedprevu_' + id).val();
        var datefprevu = $('#input_datefinprevu_' + id).val();
        $scope.param = {
            "form": form,
            "monttotal": monttotal,
            "org": org,
            "mont": mont,
            "tva": tva,
            "mtva": mtva,
            "montanttc": montanttc,
            "datedprevu": datedprevu,
            "datefprevu": datefprevu,
            "id": id,
        }
        $http({
            url: domaineapp + 'formation.php/planing/savelignePlaningRealisation',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "Ajout avec succès !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            //            $('#btnvalideplan_' + id).addClass("disabledbutton");
            $('#btnvaliderealisation_' + id).addClass("btn-danger")
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //save page facturation
    $scope.ValiderLigneSuivireglement = function(id) {
        var idfacture = $('#magfa_' + id).val();
        $scope.param = {
            "idfacture": idfacture,
            "id": id,
        }
        $http({
            url: domaineapp + 'formation.php/planing/savelignesuivireglement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "Ajout avec succès !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            //            $('#btnvalideplan_' + id).addClass("disabledbutton");
            $('#btnvaliderFacturation_' + id).addClass("btn-danger")
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //save page  show document 
    $scope.ValiderLigne = function(id) {
        var form = $('#formateur_' + id).val();
        var org = $('#organisme_' + id).val();
        var mont = $('#input_montant_' + id).val();
        var tva = $('#tva_' + id).val();
        var mtva = $('#input_montanttva_' + id).val();
        var montanttc = $('#input_montantttc_' + id).val();
        var dd = $('#input_dated_' + id).val();
        var df = $('#input_datefin_' + id).val();
        var monttotal = $('#montanttotal').val();
        var nbrj = $('#nbrjour_' + id).val();
        var nbh = $('#nbrheure_' + id).val();
        var mris = $('#mris_' + id).val();
        var msoc = $('#msoc_' + id).val();
        var motif = $('#motif_' + id).val();
        var realise = $('#realise_' + id).is(':checked');
        var montanttotalresalise = $('#montanttotaTTCRealise').val();
        //   $('#valide').is(':checked');
        $scope.param = {
            "form": form,
            "monttotal": monttotal,
            "org": org,
            "mont": mont,
            "tva": tva,
            "mtva": mtva,
            "montanttc": montanttc,
            "datede": dd,
            "datefin": df,
            "nbrj": nbrj,
            "nbh": nbh,
            "mris": mris,
            "msoc": msoc,
            "motif": motif,
            "realise": realise,
            "montanttotalresalise": montanttotalresalise,
            "id": id,
        }
        $http({
            url: domaineapp + 'formation.php/planing/savelignePlaning',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.dialog({
                message: "Ajout avec succès !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            //            $('#btnvalideplan_' + id).addClass("disabledbutton");
            $('#btnvalideplan_' + id).addClass("btn-danger")
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //    $("select[name=select_tva]")
    //            .change(function () {
    //                var id = $("select[name=select_tva]").val();
    //                alert(id);
    //                if ($('#input_montant_' + id).val() != "" && $('#tva_' + id).val() != "") {
    //                    $scope.calculMotnatttC('55');
    //                }
    //            }).trigger("change");

    //    $scope.calculMotnatttC = function (id) {
    //        if ($('#input_montant_' + id).val() != "" && $('#tva_' + id).val() != "") {
    //            var mont = $('#input_montant_' + id).val();
    //            var tva = $('#tva_' + id + ' option:selected').text().replace("%", "");
    //            if (tva == '')
    //                tva = 0;
    //            var montanttc = 0;
    //            montanttc = parseFloat(parseFloat(mont) + (parseFloat(tva) * parseFloat(mont) / 100));
    //            $('#input_montantttc_' + id).val(parseFloat(montanttc).toFixed(3));
    //            var mtva = 0;
    //            mtva = parseFloat(parseFloat(tva) * parseFloat(mont) / 100);
    //            $('#input_montanttva_' + id).val(parseFloat(mtva).toFixed(3));
    //
    //            if ($('#input_datefin_' + id).val() != "")
    //            {
    //                var mris = $('#mris_' + id).val();
    //                var monsociete = 0;
    //                monsociete = parseFloat(mont) - parseFloat(mris);
    //                $('#msoc_' + id).val(parseFloat(monsociete));
    //            }
    //        }
    //        $scope.calculM();
    //    }
    //-----charger detail facture
    $scope.AffichedetailFacture = function(id) {
            //        var id_facture = $('#magfacture_'+id).val();
            //        $scope.param = {
            //            'idFacture': id_facture
            //
            //        }
            //        $http({
            //            url: domaineapp + 'formation.php/planing/AffichedetailFacture',
            //            method: "POST",
            //            data: $scope.param,
            //            headers: {
            //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            //            }
            //        }).then(function mySucces(response) {
            //            data = response.data[0];
            //            $('#montantfacturenet_'+id).val(data['montantfacturenet']);
            //           
            //            //alert(data);
            //        }, function myError(response) {
            //            alert(response);
            //        });
        }
        //    $("#magfacture")
        //            .change(function () {
        //                if ($("#magfacture").val() != "") {
        //                    $scope.AffichedetailFacture();
        //                }
        //            })
        //            .trigger("change");


    //------
    //    $scope.calculM = function ()
    //    {
    //        var totalHTT = 0;
    //        $('[name="ligne_montant"]').each(function () {
    //            var ligne_montant = 0;
    //            if ($(this).val() != '')
    //                ligne_montant = parseFloat($(this).val());
    //            totalHTT = parseFloat(totalHTT) + parseFloat(ligne_montant);
    //        });
    //        $('#montanttotal').val(parseFloat(totalHTT).toFixed(3));
    //    }
});
app.controller('CtrlPaie', function($scope, $http) {
    $scope.listedocsE = [];
    $scope.listedocsP = [];
    $scope.listesPrimes = [];
    $scope.ListeRetenue = [];
    $scope.listedocsRegimehoraire = [];
    $scope.listePaie = [];
    $scope.listeDetail = [];
    $scope.listeDetail_13 = [];
    $scope.listedocMois = [];
    $scope.listedocCode = [];
    $scope.listedocContribition = [];
    $scope.AfficherdetailPaieAgents = function() {
        var x = document.getElementById("p_idagents");
        var ids = '';
        for (var i = 0; i < x.selectedOptions.length; i++) {
            ids = ids + x.selectedOptions[i].value + ',,';
        }
        if (ids == '' || ids == 0) {
            bootbox.dialog({
                message: "Veuilez Choisr un ou plusieurs Agent !!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            return;
        }

        var mois = $('#p_mois').val();
        var mois_Prime = $('#prime_Societe').val();
        var annee = $('#annee_paie').val();
        if (mois == "") {
            bootbox.dialog({
                message: "Veuilez Choisr le Mois !",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        } else {
            $scope.param = {
                "ids": ids,
                "mois": mois,
                "annee": annee,
                "mois_Prime": mois_Prime,
            }
            $http({
                url: domaineapp + 'paie.php/paie/affichedetailPaieAgents',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#affiche_detail').show();
                $scope.listePaie = data;

            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }

    $scope.setCalcule = function(id, idag) {
        var comArr = eval($scope.listePaie);
        for (var i = 0; i < comArr.length; i++) {
            if (parseInt(comArr[i].id) == parseInt(id) && parseInt(comArr[i].id_agents) == parseInt(idag)) {
                if ($('#notepresence_' + id).val() != '' && $('#noterednement_' + id).val() != '') {
                    $('#brut_prime_' + id).val(parseFloat(eval($('#notepresence_' + id).val()) * eval($('#noterednement_' + id).val()) * parseFloat(comArr[i].sbrut)).toFixed(3));
                    comArr[i].noterednement = $('#noterednement_' + id).val();
                    comArr[i].notepresence = $('#notepresence_' + id).val();
                    comArr[i].brut_prime = $('#brut_prime_' + id).val();
                    $scope.CalculIrpp(id);
                } else {
                    $('#brut_prime_' + id).val('');
                    $('#irpp_' + id).val('');
                    $('#css_' + id).val('');
                }
            }
        }
    }

    $scope.CalculIrpp = function(id) {
        var id_agents = $('#id_agents_' + id).val();
        var brut_prime = $('#brut_prime_' + id).val();
        var taux = $('#taux_' + id).val();
        var annee = $("#annee_paie").val();
        var mois = $("#p_mois").val();
        $scope.param = {
            "id_agents": id_agents,
            "annee": annee,
            "mois": mois,
            "id": id,
            "brut_prime": brut_prime,
            "taux": taux,
        }
        $http({
            url: domaineapp + 'paie.php/paie/CalculIrpp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#irpp_' + id).val(data[0]);
            $('#css_' + id).val(data[1]);
            $('#mntsocialmensuelle_' + id).val(data[2]);
            $('#montantsociale_' + id).val(data[3]);
            $('#netsociale_' + id).val(data[4]);
            $('#abattement_' + id).val(data[5]);
            $('#abattementfrpro_' + id).val(data[6]);
            $('#retenueimosable_' + id).val(data[7]);
            $('#salaireimpo_' + id).val(data[8]);
            $('#salairenet_' + id).val(data[9]);
            $('#netapayyer_' + id).val(data[10]);
            $('#brutanuuel_' + id).val(data[11]);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.InitialiserLigne = function(id) {
        $('#noterednement_' + id).val('');
        $('#notepresence_' + id).val('');
        $('#taux_' + id).val('');
        $('#brutannuel_' + id).val('');
        $('#base_calculprime_' + id).val('');
        $('#brut_prime_' + id).val('');
        $('#irpp_' + id).val('');
        $('#css_' + id).val('');
    }

    //save ligne paie 13-14-15-16 
    $scope.ValiderLigneA = function(id, id_agents, id_codesociale, sbrut, abattenfant, abattcheffamille, salairetheorique) {
        var annee = $("#annee_paie").val();
        var netsociale = $('#netsociale_' + id).val();
        var abattement = $('#abattement_' + id).val();
        var abattementfrpro = $('#abattementfrpro_' + id).val();
        var irpp = $('#irpp_' + id).val();
        var salaireimpo = $('#salaireimpo_' + id).val();
        var retenueimosable = $('#retenueimosable_' + id).val();
        var salairenet = $('#salairenet_' + id).val();
        var netapayyer = $('#netapayyer_' + id).val();
        var css = $('#css_' + id).val();
        var montantsociale = $('#montantsociale_' + id).val();
        var brutanuue = $('#brutanuuel_' + id).val();
        var mntsocialmensuelle = $('#mntsocialmensuelle_' + id).val();
        var noterednement = parseFloat(eval($('#noterednement_' + id).val()));
        var notepresence = parseFloat(eval($('#notepresence_' + id).val()));
        var base_calculprime = $('#base_calculprime_' + id).val();
        var brut_prime = $('#brut_prime_' + id).val();
        var mois = $("#p_mois").val();
        var mois_prime = $("#prime_Societe").val();
        $scope.param = {
            "id": id,
            "id_agents": id_agents,
            "id_codesociale": id_codesociale,
            "sbrut": sbrut,
            "mois": mois,
            "mois_prime": mois_prime,
            "annee": annee,
            "netsociale": netsociale,
            "abattement": abattement,
            "abattementfrpro": abattementfrpro,
            "abattenfant": abattenfant,
            "abattcheffamille": abattcheffamille,
            "salaireimpo": salaireimpo,
            "retenueimosable": retenueimosable,
            "salairenet": salairenet,
            "netapayyer": netapayyer,
            "css": css,
            "montantsociale": montantsociale,
            "brutanuue": brutanuue,
            "irpp": irpp,
            "mntsocialmensuelle": mntsocialmensuelle,
            "salairetheorique": salairetheorique,
            "noterednement": noterednement,
            "notepresence": notepresence,
            "base_calculprime": base_calculprime,
            "brut_prime": brut_prime,
        }
        $http({
            url: domaineapp + 'paie.php/paie/Savelignesupperier12paie',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            bootbox.dialog({
                message: "ajout avec succes !!!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            return;
        }, function myError(response) {
            alert(response);
        });
    }

    //delete ligne ajouter tds tableau paie
    $scope.SuppresiionLigne = function(id) {
        if (id != 0) {
            $scope.param = {
                "id": id,
            }
            $http({
                url: domaineapp + 'paie.php/paie/DeleteLignepaie',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.InitialiserLigne(id);
                bootbox.dialog({
                    message: "Supression avec success !!",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                return;
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            bootbox.dialog({
                message: "cet agent n'a pas un mois >12 enregistré dans la base !!",
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

    $scope.AfficherListeAgents = function() {
        var num = $("#numeotrimestre").val();
        var mois = $("#p_mois").val();
        var annee = $("#annee_paie").val();
        $scope.param = {
            "num": num,
            "mois": mois,
            "annee": annee
        }
        $http({
            url: domaineapp + 'paie.php/paie/AfficheListeAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            $('#agents_div').show();
            $('#btn_aff').show();
            $('#liste_agents').html('<select multiple="multiple" size="12" name="paie[id_agents]" id="p_idagents"></select>');
            $scope.ChargerComboMultiple('#p_idagents', data);

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.ChargerComboMultiple = function(id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        var demo1 = $('select[name="paie[id_agents]"]').bootstrapDualListbox({ infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>' });
        var container1 = demo1.bootstrapDualListbox('getContainer');
        container1.find('.btn').addClass('btn-white btn-info btn-bold');
    }

    $("#p_mois")
        .change(function() {
            if ($("#p_mois").val() != "") {
                $("#prim_soc").removeClass('disabledbutton');
                $scope.AfficherPrimeSociete();
            } else {
                $("#prim_soc").addClass('disabledbutton');
                $('#prime_Societe').val("");
                $('#prime_Societe').trigger("chosen:updated");
            }
        })
        .trigger("change");

    $("#annee_paie")
        .change(function() {
            if ($("#p_mois").val() != "" && $("#prime_Societe").val() != "" && $("#annee_paie").val() != "") {
                $scope.AfficherListeAgents();
            } else {
                $("#agents_div").hide();
                $('#prime_Societe').val("");
                $('#prime_Societe').trigger("chosen:updated");
            }
        })
        .trigger("change");

    $("#prime_Societe")
        .change(function() {
            if ($("#p_mois").val() != "" && $("#prime_Societe").val() != "" && $("#annee_paie").val() != "") {
                $scope.AfficherListeAgents();
            } else {
                $("#agents_div").hide();
                $('#prime_Societe').val("");
                $('#prime_Societe').trigger("chosen:updated");
            }
        })
        .trigger("change");

    //parametrage societe affichage les ligne de societe 
    $scope.AfficherLigneSociete = function() {
        var annee = $("#societe_annee").val();
        $scope.param = {
            "annee": annee
        }
        $http({
            url: domaineapp + 'paie.php/societe/AfficheListeLignesociete',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocMois = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $("#societe_annee")
        .change(function() {
            if ($("#societe_annee").val() != "" && $("#societe_nbremoisannuel").val() != "") {
                $scope.AfficherLigneSociete();
            }
        })
        .trigger("change");

    $scope.AfficherPrimeSociete = function() {
        var mois = $("#p_mois").val();
        var annee = $("#annee_paie").val();
        $scope.param = {
            "mois": mois,
            "annee": annee
        }
        $http({
            url: domaineapp + 'paie.php/paie/AfficheListePrimeSoci',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                $('#prim_soc').removeClass('disabledbutton');
                $scope.ChargerCombo('#prime_Societe', data);
                if ($("#prime_Societe").val() != "" && $("#annee_paie").val() != "") {
                    $scope.AfficherListeAgents();
                } else {
                    $("#agents_div").hide();
                    $('#prime_Societe').val("");
                    $('#prime_Societe').trigger("chosen:updated");
                }
            } else {
                alert("ce mois n'a pas une prime !!!");
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.ChargerCombo = function(id, data) {
        $(id).empty();

        if (data.length > 1)
            $(id).append("<option value='0'></option>");
        var selected = '';
        if (data.length == 1)
            selected = 'selected="true"';
        for (i = 0; i < data.length; i++) {
            $(id).append("<option " + selected + " value='" + data[i].id + "'>" + data[i].libelle + "</option>");
            //                $(id).append("<option " + " value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        if (data.length == 1) {
            $(id).val(data[0].id).trigger("liszt:updated");
            $(id).trigger("chosen:updated");
        } else {
            $(id).val('').trigger("liszt:updated");
            $(id).trigger("chosen:updated");
        }
    }

    $scope.AjouterVariable = function() {
        if ($('#variable').val() != "") {
            var formule = $('#primes_formule').val();
            var vari = $('#variable').val();
            formule = formule.trim() + " " + vari.trim();
            $('#primes_formule').val(formule);
        }
    }

    $scope.AjouterOperator = function() {
        if ($('#operateur').val() != "") {
            var formule = $('#primes_formule').val();
            var op = $('#operateur').val();
            formule = formule.trim() + " " + op.trim();
            $('#primes_formule').val(formule);
        }
    }
    $scope.DeletePrimes = function() {
        $('#primes_formule').val("");
    }
    $scope.initialChampsPersonnelle = function() {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
    $scope.chargerage = function() {
        var datenaissance = $('#datenai').val();
        var datesys = new Date();

        var d2 = new Date(datesys);
        var d1 = new Date(datenaissance)
        var DateDiff = {
            inDays: function(d1, d2) {
                var t2 = d2.getTime();
                var t1 = d1.getTime();
                return parseInt((t2 - t1) / (24 * 3600 * 1000));
            },
            inWeeks: function(d1, d2) {
                var t2 = d2.getTime();
                var t1 = d1.getTime();
                return parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
            },
            inMonths: function(d1, d2) {
                var d1Y = d1.getFullYear();
                var d2Y = d2.getFullYear();
                var d1M = d1.getMonth();
                var d2M = d2.getMonth();
                return (d2M + 12 * d2Y) - (d1M + 12 * d1Y);
            },
            inYears: function(d1, d2) {
                return d2.getFullYear() - d1.getFullYear();
            }
        }
        var nbrannee = DateDiff.inYears(d1, d2);
        $('#age').val(nbrannee);

    }
    $("#datenai")
        .change(function() {
            if ($("#datenai").val() != "") {
                $scope.chargerage();
            } else {
                $('#age').val("");
            }
        })
        .trigger("change");
    //Ajouter ligne Enfants 
    $scope.AjouterLigneEnfants = function() {
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
                alert("Il faut remplir le nom, la date de naissance et le nombre d'enfants!!!");
            }
            if (trouve === 1)
                $scope.InaliserChampsEnfants();
        }
        //initialiser champs Enfants
    $scope.InaliserChampsEnfants = function() {
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
    $scope.MisAJourE = function(lignedocE) {

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
    $scope.DeleteE = function(lignedocE) {
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
    $scope.inialiserTableEnfant = function() {
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
    $scope.validerAjoutEnfants = function() {
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
                    bootbox.dialog({
                        message: "ajout avec succès !",
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
            } else
                alert("ERREUR ...!!!");
        }
        //affichage enfants
    $scope.AfficheLigneEnfants = function(iddoc) {
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

    $scope.inititaliserlisteEnfants = function(iddoc) {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'paie.php/paie/AfficheligneEnfants',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.listedocsE = data;
                $scope.InitialiserListeParents(iddoc);
                $scope.InitialiserlistePrimes();

            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //parents
    $scope.InitialiserListeParents = function(iddoc) {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'paie.php/paie/InitialiserlisteParents',
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
        //prime
    $scope.InitialiserlistePrimes = function() {
            var iddoc = $("#contrat_id").val();
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'paie.php/paie/AffichelignePrimes',
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
                    if ($scope.listesPrimes[i].imposable == true || $scope.listesPrimes[i].cotisable == true) {
                        totalp = eval(totalp) + eval($scope.listesPrimes[i].montant);
                    }
                }
                $('#totalp').val(totalp.toFixed(3));
                //            totalp = eval(msalaire) + totalp;
                //            $('#paie_salairebrut').val(totalp.toFixed(3));
                //            $('#paie_salaireimposable').val(totalp.toFixed(3));
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //retenue
    $scope.InitialierListesRetenues = function(iddoc) {
        var mois = $("#paie_mois").val();
        var annee = $("#paie_annee").val();
        var retenuemenusuel = 0;
        $scope.param = {
            "id": iddoc,
            'mois': mois,
            'annee': annee,
        }
        $http({
            url: domaineapp + 'paie.php/paie/AffichelisteRetenue',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            var data_avance = data.avance;
            var data_pret = data.pret;
            var data_retenue = data.retenue;
            data_avance = data_avance.concat(data_pret);
            data_avance = data_avance.concat(data_retenue);
            $scope.ListeRetenue = data_avance;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheListesEnfants = function() {
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
                    $scope.calculabatementenfantchef();

            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //ajouter ligne regime horaire
    $scope.InialiserChampsSelect = function() {
        $('.chosen-container').attr("style", "width: 100%;");
        $('.chosen-container').trigger("chosen:updated");
        $('#exercice_courant_menu').trigger("chosen:updated");
        $('#id_typeregime').trigger("chosen:updated");
        $('#regime').trigger("chosen:updated");
    }
    $scope.AjouterLigneRegime = function() {
            trouve = 0;
            if ($('#regime').val() != "") {
                if ($('#nordre').val() == "") {
                    nordre = $scope.listedocsRegimehoraire.length + 1;
                    if ($('#regime').val() != "") {
                        $scope.listedocsRegimehoraire.push({
                            'norgdre': nordre,
                            'idregime': $('#regime').val(),
                            'regime': $('#regime option:selected').text(),
                            'pardefaut': $('#pardefaut').is(':checked'),
                        });
                    }
                } else {
                    var comArr = eval($scope.listedocsRegimehoraire);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                            comArr[i].idregime = $('#regime').val();
                            comArr[i].regime = $('#regime option:selected').text();
                            comArr[i].pardefaut = $('#pardefaut').is(':checked');
                            break;
                        }
                    }
                }
                trouve = 1;
            } else {
                alert("Il faut choisr un regime horaire !!!");
            }
            if (trouve === 1)
                $scope.InaliserChampsRegime();
        }
        //initialiser Champs regime horaire
    $scope.InaliserChampsRegime = function() {
            $('#nordre').val('');
            $('#regime').val('');
            $('#regime').trigger("chosen:updated");
            $('#pardefaut').removeAttr("checked");
        }
        //MISAjour Enfants
    $scope.MisAJourRegime = function(lignedocRegimehoraire) {
            $('#nordre').val(lignedocRegimehoraire.norgdre);
            $('#regime').val(lignedocRegimehoraire.idregime);
            $('#regime').trigger("chosen:updated");
            if (lignedocRegimehoraire.pardefaut == true)
                $('#pardefaut').prop("checked", true);
            else
                $('#pardefaut').removeAttr("checked");
        }
        //Delete Enfants  
    $scope.DeleteRegime = function(lignedocRegimehoraire) {
        var index = -1;
        var comArr = eval($scope.lignedocRegimehoraire);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocRegimehoraire.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsRegimehoraire.splice(index, 1);
        $scope.inialiserTableRegime();
    }
    $scope.inialiserTableRegime = function() {
        var arraytable = [];
        arraytable = $scope.listedocsRegimehoraire;
        $scope.listedocsRegimehoraire = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsRegimehoraire.push({
                'norgdre': i + 1,
                'idregime': arraytable[i].idregime,
                'regime': arraytable[i].regime,
                'pardefaut': arraytable[i].pardefaut,
            });
        }
    }
    $scope.ValidersaveRegime = function() {
            var id_dossier = $('#id_dossier').val();

            if ($scope.listedocsRegimehoraire.length > 0) {
                $scope.document = {
                    'listedocsRegimehoraire': $scope.listedocsRegimehoraire,
                    'id_dossier': id_dossier,
                };
                $http({
                    url: domaineapp + 'paie.php/dossiercomptable/SavedocumentRegime',
                    method: "POST",
                    data: $scope.document,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $('#btnvaliderRegime').attr('class', 'btn btn-outline btn-danger');
                }, function myError(response) {
                    alert(response);
                });
            } else
                alert("ERREUR ...!!!");
        }
        //affichage enfants
    $scope.AfficheListeRegimePrevu = function(iddossier) {
            $scope.param = {
                "id": iddossier
            }
            $http({
                url: domaineapp + 'paie.php/dossiercomptable/AfficheligneDossier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.listedocsRegimehoraire = data;
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //-----------------------
        //-------------- ligne mois par societe >12 

    $scope.AjouterLigneMois = function() {
            trouve = 0;
            var nbrmois = $('#societe_nbremoisannuel').val();
            if (nbrmois != '') {
                if ($('#codemois').val() == "") {
                    alert("Il faut remplir le code de mois !");
                }
                if ($('#nordre').val() == "" && $('#codemois').val() != "") {
                    nordre = $scope.listedocMois.length + 1;
                    if ($('#codemois').val() != "") {
                        $scope.listedocMois.push({
                            'norgdre': nordre,
                            'libelle': $('#libelle').val(),
                            'idcodemois': $('#codemois').val(),
                            'codemois': $('#codemois option:selected').text(),
                            'idmois': $('#mois_calendrial').val(),
                            'mois_calendrial': $('#mois_calendrial option:selected').text(),
                        });
                    }
                } else {
                    var comArr = eval($scope.listedocMois);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                            comArr[i].libelle = $('#libelle').val();
                            comArr[i].idcodemois = $('#codemois').val();
                            comArr[i].codemois = $('#codemois option:selected').text();
                            comArr[i].idmois = $('#mois_calendrial').val();
                            comArr[i].mois_calendrial = $('#mois_calendrial option:selected').text();
                            break;
                        }
                    }
                }

                trouve = 1;
            } else {
                alert("Il faut remplir le nombre de mois !!!");
            }
            if (trouve === 1)
                $scope.InaliserChampsMois();
        }
        //initialiser Champs ligne mois
    $scope.InaliserChampsMois = function() {
            $('#nordre').val('');
            $('#codemois').val('');
            $('#codemois').trigger("chosen:updated");
            $('#libelle').val('');
            $('#mois_calendrial').val('');
            $('#mois_calendrial').trigger("chosen:updated");
        }
        //MISAjour ligne mois
    $scope.MisAJourLigneMois = function(lignedocMois) {
            $('#nordre').val(lignedocMois.norgdre);
            $('#libelle').val(lignedocMois.libelle);
            $('#mois_calendrial').val(lignedocMois.idmois);
            $('#mois_calendrial').trigger("chosen:updated");
            $('#codemois').val(lignedocMois.codemois);
            $('#codemois').trigger("chosen:updated");
        }
        //Delete mois  
    $scope.DeleteLigneMois = function(lignedocMois) {
        var index = -1;
        var comArr = eval($scope.listedocMois);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocMois.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocMois.splice(index, 1);
        $scope.inialiserTableMois();
    }
    $scope.inialiserTableMois = function() {
        var arraytable = [];
        arraytable = $scope.listedocMois;
        $scope.listedocMois = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocMois.push({
                'norgdre': i + 1,
                'idmois': arraytable[i].idmois,
                'mois_calendrial': arraytable[i].mois_calendrial,
                'idcodemois': arraytable[i].idcodemois,
                'codemois': arraytable[i].codemois,
                'libelle': arraytable[i].libelle,
            });
        }
    }
    $scope.validerAjoutMois = function() {
        var id_societe = $('#id_societe').val();
        var annee = $('#societe_annee').val();
        var nbrmois = $('#societe_nbremoisannuel').val();


        if ($scope.listedocMois.length > 0) {
            $scope.document = {
                'listedocMois': $scope.listedocMois,
                'id_societe': id_societe,
                'annee': annee,
                'nbrmois': nbrmois,
            };
            $http({
                url: domaineapp + 'paie.php/societe/SavedocumentLigneMois',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderMois').attr('class', 'btn btn-outline btn-danger');
                bootbox.dialog({
                    message: "ajout avec succès !",
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
        } else
            alert("ERREUR ...!!!");
    }


    //ligne code sociale ----------------------------------//


    $scope.AjouterLigneCodesociale = function() {
            trouve = 0;
            if ($('#taux').val() != "") {
                if ($('#nordre').val() == "") {
                    nordre = $scope.listedocCode.length + 1;
                    if ($('#codesociale').val() != "") {
                        $scope.listedocCode.push({
                            'norgdre': nordre,
                            'codesociale': $('#codesociale').val(),
                            'libelle': $('#libelle').val(),
                            'taux': $('#taux').val(),
                        });
                    }
                } else {
                    var comArr = eval($scope.listedocCode);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                            comArr[i].codesociale = $('#codesociale').val();
                            comArr[i].libelle = $('#libelle').val();
                            comArr[i].taux = $('#taux').val();
                        }
                    }
                }
                trouve = 1;
            } else {
                alert("Il faut remplir le taux du régime !!!");
            }
            if (trouve === 1)
                $scope.InaliserChampsCodesociale();
        }
        //initialiser Champs ligne code
    $scope.InaliserChampsCodesociale = function() {
            $('#nordre').val('');
            $('#codesociale').val('');
            $('#libelle').val('');
            $('#taux').val('');
        }
        //MISAjour ligne code 
    $scope.MisAJourLigneCode = function(lignedocCode) {
            $('#nordre').val(lignedocCode.norgdre);
            $('#libelle').val(lignedocCode.libelle);
            $('#codesociale').val(lignedocCode.codesociale);
            $('#taux').val(lignedocCode.taux);
        }
        //Delete mois  
    $scope.DeleteLigneCode = function(lignedocCode) {
        var index = -1;
        var comArr = eval($scope.listedocCode);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocCode.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocCode.splice(index, 1);
        $scope.inialiserTableCode();
    }
    $scope.inialiserTableCode = function() {
        var arraytable = [];
        arraytable = $scope.listedocCode;
        $scope.listedocCode = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocCode.push({
                'norgdre': i + 1,
                'codesociale': arraytable[i].codesociale,
                'libelle': arraytable[i].libelle,
                'taux': arraytable[i].taux,
            });
        }
    }
    $scope.validerAjoutCode = function() {
        var id_codesociale = $('#id_codesociale').val();

        if ($scope.listedocCode.length > 0) {
            $scope.document = {
                'listedocCode': $scope.listedocCode,
                'id_codesociale': id_codesociale,
            };
            $http({
                url: domaineapp + 'paie.php/codesociale/SavedocumentLigneCodesociale',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderCode').attr('class', 'btn btn-outline btn-danger');
                bootbox.dialog({
                    message: "ajout avec succès !",
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
        } else
            alert("ERREUR ...!!!");
    }


    $scope.AfficheLigneCodesociale = function(idcodesociale) {
        $scope.param = {
            "id": idcodesociale
        }
        $http({
            url: domaineapp + 'paie.php/codesociale/AfficheligneCodesociale',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocCode = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //----------------------------------------------------------//
    //ligne contribition----------------------------------//
    $scope.AjouterLigneContribition = function() {
            trouve = 0;
            if ($('#taux').val() != "") {
                if ($('#nordre').val() == "") {
                    nordre = $scope.listedocContribition.length + 1;
                    if ($('#codesociale').val() != "") {
                        $scope.listedocContribition.push({
                            'norgdre': nordre,
                            'contribition': $('#contribition').val(),
                            'libelle': $('#libelle').val(),
                            'taux': $('#taux').val(),
                        });
                    }
                } else {
                    var comArr = eval($scope.listedocContribition);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                            comArr[i].contribition = $('#contribition').val();
                            comArr[i].libelle = $('#libelle').val();
                            comArr[i].taux = $('#taux').val();
                        }
                    }
                }
                trouve = 1;
            } else {
                alert("Il faut remplir le taux du regime !!!");
            }
            if (trouve === 1)
                $scope.InaliserChampsContribition();
        }
        //initialiser Champs ligne contribiton
    $scope.InaliserChampsContribition = function() {
            $('#nordre').val('');
            $('#contribition').val('');
            $('#libelle').val('');
            $('#taux').val('');
        }
        //MISAjour ligne contribiton 
    $scope.MisAJourLigneContribition = function(lignedocContribtion) {
            $('#nordre').val(lignedocContribtion.norgdre);
            $('#libelle').val(lignedocContribtion.libelle);
            $('#contribition').val(lignedocContribtion.contribition);
            $('#taux').val(lignedocContribtion.taux);
        }
        //Delete mois  
    $scope.DeleteLigneContribition = function(lignedocContribtion) {
        var index = -1;
        var comArr = eval($scope.listedocContribition);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocContribtion.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocContribition.splice(index, 1);
        $scope.inialiserTableContribition();
    }
    $scope.inialiserTableContribition = function() {
        var arraytable = [];
        arraytable = $scope.listedocContribition;
        $scope.listedocContribition = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocContribition.push({
                'norgdre': i + 1,
                'contribition': arraytable[i].contribition,
                'libelle': arraytable[i].libelle,
                'taux': arraytable[i].taux,
            });
        }
    }
    $scope.validerAjoutContribition = function() {
        var id_contribiton = $('#id_contribiton').val();
        if ($scope.listedocContribition.length > 0) {
            $scope.document = {
                'listedocContribition': $scope.listedocContribition,
                'id_contribiton': id_contribiton,
            };
            $http({
                url: domaineapp + 'paie.php/contribitionpatronale/SavedocumentLigneContibition',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvaliderContribition').attr('class', 'btn btn-outline btn-danger');
                bootbox.dialog({
                    message: "ajout avec succès !",
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
        } else
            alert("ERREUR ...!!!");
    }


    $scope.AfficheLigneContribiton = function(id_contribiton) {
        $scope.param = {
            "id": id_contribiton
        }
        $http({
            url: domaineapp + 'paie.php/contribitionpatronale/AfficheligneContribition',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocContribition = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //----------------------------------------------------------//
    $scope.affichelescodedemois = function() {
        var nbrmois = $('#societe_nbremoisannuel').val();

        if (nbrmois > 12) {
            $('#code_mois').removeClass('disabledbutton');
        } else {
            alert(nbrmois);
            $('#code_mois').addClass('disabledbutton');
        }
    }


    $("#societe_nbremoisannuel")
        .change(function() {
            if ($("#societe_nbremoisannuel").val() != "") {
                $scope.affichelescodedemois();
            }

        })
        .trigger("change");
    //affichage mois
    $scope.AfficheLigneMois = function(idsociete) {
        var annee = $('#societe_annee').val();
        $scope.param = {
            "id": idsociete,
            "annee": annee
        }
        $http({
            url: domaineapp + 'paie.php/societe/AfficheligneSociete',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocMois = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //**********------------------*********
    $scope.AfficheListeParents = function() {
        var id_agents = $("#paie_id_agents").val();
        $scope.param = {
            "id": id_agents
        }
        $http({
            url: domaineapp + 'paie.php/paie/AffichelisteParents',
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
    $scope.calculabatementenfantchef = function() {
            var totalp = 0;
            var abbatenfant = 0;
            var abatementchef = 0;
            $http({
                url: domaineapp + 'paie.php/deductioncommune/Afficehdemontantchef',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                abbatenfant = $('#abatement_enfants').val();
                abatementchef = data['montant'];

                totalp = eval(abbatenfant) + eval(abatementchef);
                $('#paie_abattementenfant').val(totalp.toFixed(3));

                $scope.calculnetsociale();
            }, function myError(response) {
                alert(response);
            });
        }
        //Ajouter ligne PArents 
    $scope.AjouterLigneParents = function() {
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
                            'deceparent': $('#deceparent').is(':checked'),
                        });
                    }
                } else {

                    var comArr = eval($scope.listedocsP);
                    for (var i = 0; i < comArr.length; i++) {

                        if (comArr[i].norgdre - $('#nordre6').val().trim() === 0) {
                            comArr[i].nom = $('#nom').val();
                            comArr[i].prenom = $('#prenom').val();
                            comArr[i].daten = $('#daten').val();
                            comArr[i].deceparent = $('#deceparent').is(':checked');

                            break;
                        }
                    }
                }
                trouve = 1;
            } else {
                alert("Il faut remplir Nom !!!");
            }
            if (trouve === 1)
                $scope.InaliserChampsParents();
        }
        //initialiser champs Parents
    $scope.InaliserChampsParents = function() {
            $('#nordre6').val('');
            $('#nom').val('');
            $('#prenom').val('');
            $('#daten').val('');
            $('#deceparent').removeAttr("checked");
        }
        //MISAjour PArents
    $scope.MisAJourP = function(lignedocP) {

            $('#nordre6').val(lignedocP.norgdre);
            $('#nom').val(lignedocP.nom);
            $('#prenom').val(lignedocP.prenom);
            $('#daten').val(lignedocP.daten);
            if (lignedocP.deceparent == true)
                $('#deceparent').prop("checked", true);
            else
                $('#deceparent').removeAttr("checked");
        }
        //Delete Parents
    $scope.DeleteP = function(lignedocP) {
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
    $scope.inialiserTableParent = function() {
        var arraytable = [];
        arraytable = $scope.listedocsP;
        $scope.listedocsP = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsP.push({
                'norgdre': i + 1,
                'nom': arraytable[i].nom,
                'prenom': arraytable[i].prenom,
                'daten': arraytable[i].daten,
                'deceparent': arraytable[i].deceparent,
            });
        }

    }
    $scope.valiedeAjoutParents = function(id_agents) {
            if ($scope.listedocsP.length > 0) {
                $scope.document = {
                    'listeslignesdocP': $scope.listedocsP,
                    'id_agents': id_agents,
                };
                $http({
                    url: domaineapp + 'paie.php/agents/SavedocumentParents',
                    method: "POST",
                    data: $scope.document,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $('#btnvaliderP').attr('class', 'btn btn-outline btn-danger');
                    bootbox.dialog({
                        message: "ajout avec succès !",
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
            } else
                alert("ERREUR ...!!!");
        }
        //affiche ligne  parent 
    $scope.AfficheLigneParents = function(iddoc) {
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'paie.php/agents/AfficheligneParents',
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
        //affiche liste primes 
    $scope.AffichelistePrimes = function() {
            var iddoc = $("#id_contrat").val();
            var msalaire = $("#salaire").val();
            $scope.param = {
                "id": iddoc
            }
            $http({
                url: domaineapp + 'paie.php/paie/AffichelignePrimes',
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
                    if ($scope.listesPrimes[i].imposable == true || $scope.listesPrimes[i].cotisable == true) {
                        totalp = eval(totalp) + eval($scope.listesPrimes[i].montant);
                    }
                }
                $('#totalp').val(totalp.toFixed(3));
                totalp = eval(msalaire) + totalp;
                $('#paie_salairebrut').val(totalp.toFixed(3));
                $('#paie_salaireimposable').val(totalp.toFixed(3));
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //affiche liste retenue 
    $scope.AfficheListesRetenues = function() {
        var id_agents = $("#paie_id_agents").val();
        var mois = $("#paie_mois").val();
        var annee = $("#paie_annee").val();
        var retenuemenusuel = 0;
        $scope.param = {
            "id": id_agents,
            'mois': mois,
            'annee': annee,
        }
        $http({
            url: domaineapp + 'paie.php/paie/AffichelisteRetenue',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            var data_avance = data.avance;
            var data_pret = data.pret;
            var data_retenue = data.retenue;
            data_avance = data_avance.concat(data_pret);
            data_avance = data_avance.concat(data_retenue);
            $scope.ListeRetenue = data_avance;
            var totalp = 0;
            for (var i = 0; i < $scope.ListeRetenue.length; i++) {
                totalp = eval(totalp) + eval($scope.ListeRetenue[i].montantmensielle);
            }
            totalp = eval(retenuemenusuel) + totalp;
            $('#paie_totalretenue').val(totalp.toFixed(3));

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.affichenbrjourferier = function() {
            var mois = $("#paie_mois").val();
            var annee = $("#paie_annee").val();
            $scope.param = {
                'mois': mois,
                'annee': annee,
            };
            $http({
                url: domaineapp + 'paie.php/paie/Affichenbrjourferier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $('#nbrjourf').val(data['nbrjourf']);
            }, function myError(response) {
                alert(response);
            });
        }
        //affiche detail agents 
    $scope.afficherdetailAgents = function() {
        var id_agents = $("#paie_id_agents").val();
        var mois = $("#paie_mois").val();
        var annee = $("#paie_annee").val();
        $scope.param = {
            'id_agents': id_agents,
            'mois': mois,
            'annee': annee,
        };
        $http({
            url: domaineapp + 'paie.php/paie/AffichedetailAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];

            $('#direction').val(data['direction']);
            $('#grade').val(data['grade']);
            $('#categorie').val(data['categorie']);
            $('#echelle').val(data['echelle']);
            $('#situation').val(data['situation']);
            $('#echelon').val(data['echelon']);

        }, function myError(response) {
            alert(response);
        });
    }

    $scope.AfficheConge = function() {
        var id_agents = $("#paie_id_agents").val();
        var mois = $("#paie_mois").val();
        var annee = $("#paie_annee").val();
        $scope.param = {
            'id_agents': id_agents,
            'mois': mois,
            'annee': annee,
        }
        $http({
            url: domaineapp + 'paie.php/paie/AfficheConge',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#nbrjourc').val(data['nbrjourc']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheAbsence = function() {
        var id_agents = $("#paie_id_agents").val();
        var mois = $("#paie_mois").val();
        var annee = $("#paie_annee").val();
        $scope.param = {
            'id_agents': id_agents,
            'mois': mois,
            'annee': annee,
        }
        $http({
            url: domaineapp + 'paie.php/paie/AfficheAbsence',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#nbrjoura').val(data['nbrjoura']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AffichePointage = function() {
        var id_agents = $("#paie_id_agents").val();
        var mois = $("#paie_mois").val();
        var annee = $("#paie_annee").val();
        $scope.param = {
            'id_agents': id_agents,
            'mois': mois,
            'annee': annee,
        }
        $http({
            url: domaineapp + 'paie.php/paie/AffichePointage',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#nbrjourt').val(data['nbrjourt']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.initialChampsDonnedebase = function() {
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
        }
        ///tester avec bareme d'impot 
    $scope.TestAvecBaremeImpot = function() {
        var imposable = $("#imposable").val();
        $scope.param = {
            'imposable': imposable,
        }
        $http({
            url: domaineapp + 'paie.php/paie/TesterBareme',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#pourcentage').val(data['pourcentage']);
            $('#montantdebutbareme').val(data['montantdebut']);
            var montantdebut = $('#montantdebutbareme').val();
            var pourcentage = $('#pourcentage').val();
            var montantfinalbareme = parseFloat(parseFloat(parseFloat(imposable) - parseFloat(montantdebut)) * parseFloat(parseFloat(pourcentage) / 100));
            $('#montantfinalbareme').val(parseFloat(montantfinalbareme).toFixed(3));
            $('#paie_retenueimposable').val(parseFloat(montantfinalbareme / 12).toFixed(3));
            $scope.calculsalirenet();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.calculsalirenet = function() {
            var simposable = $("#paie_imposablemensuel").val();
            var retenueimpot = $('#paie_retenueimposable').val();
            var salirenet = parseFloat(parseFloat(parseFloat(simposable) - parseFloat(retenueimpot)));
            $('#paie_salairenet').val(parseFloat(salirenet).toFixed(3));
            var salairenet = $('#paie_salairenet').val();
            var totalretenue = $("#paie_totalretenue").val();

            var totalp = 0;

            for (var i = 0; i < $scope.listesPrimes.length; i++) {
                if ($scope.listesPrimes[i].imposable == false && $scope.listesPrimes[i].cotisable == false) {
                    totalp = eval(totalp) + eval($scope.listesPrimes[i].montant);
                }
            }
            $('#primenoncotisablenonimpo').val(parseFloat(totalp).toFixed(3));
            var primes = $('#primenoncotisablenonimpo').val();
            $('#paie_netapayyer').val(parseFloat(parseFloat(salairenet) - parseFloat(totalretenue) + parseFloat(primes)).toFixed(3));
        }
        //calcul 
    $scope.calculnetsociale = function() {
        var id = $("#id_codesociale").val();
        $scope.param = {
            'id': id,
        };
        $http({
            url: domaineapp + 'paie.php/paie/AfficehTTauxCodeSociale',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#tauxsociale').val(data['taux']);
            var tauxsociale = $('#tauxsociale').val();
            var salairebrut = $('#paie_salairebrut').val();
            var netsocaile = 0;
            netsocaile = parseFloat((parseFloat((salairebrut) * tauxsociale)) / 100);
            $('#paie_netsociale').val(parseFloat(netsocaile).toFixed(3));
            $('#paie_salaireimposable').val(parseFloat(salairebrut - netsocaile).toFixed(3));
            var simposable = $('#paie_salaireimposable').val();
            var annuel_tauxsociale = simposable * 12;
            $('#annuel_tauxsociale').val(parseFloat(annuel_tauxsociale.toFixed(3)));
            if (annuel_tauxsociale > 2000) {
                var abattementfr = parseFloat(annuel_tauxsociale * 0.1).toFixed(3);
            } else
                abattementfr = 0;
            $('#paie_abattementfraaisprof').val(abattementfr);
            var netFP = parseFloat(annuel_tauxsociale - abattementfr).toFixed(3);
            $('#netfp').val(netFP);
            var abattement = $('#paie_abattementenfant').val();
            var imposable = parseFloat(parseFloat(netFP) + parseFloat(abattement)).toFixed(3);
            var abatementtotal = parseFloat(parseFloat(abattement) + parseFloat(abattementfr)).toFixed(3);
            $('#paie_abattement').val(parseFloat(abatementtotal).toFixed(3));
            $('#imposable').val(parseFloat(imposable).toFixed(3));
            $('#paie_imposablemensuel').val(parseFloat(imposable / 12).toFixed(3));

            $scope.TestAvecBaremeImpot();


        }, function myError(response) {
            alert(response);
        });
    }

    //affiche ligne code sociale 



});