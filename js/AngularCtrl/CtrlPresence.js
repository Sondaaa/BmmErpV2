var domaineapp = 'http://' + window.location.hostname + '/';
//var app = angular.module('AppPresence', []);
app.controller('CtrlPresence', function($scope, $http) {
    $scope.doc_classes_colors = [
        //Jaune
        "#F8FCBD",
        //Vert pistache
        "#BFFFA3",
        //Bleu
        "#6FB3E0",
        //Rose
        "#FFA3A3",
        //Violet
        "#9585BF",
        //Ecru
        "#FEE188"
    ];
    $scope.listedocsClassificationConge = [];
    $scope.listesJourFerier = [];
    $scope.listesConge = [];
    $scope.listeagentssansconge = [];
    //initialise anne dans fiche demande conge 

    $scope.Initialiserannee = function() {
            var date = new Date()
                //        if ($('#conge_annee').val() == "")
                //        {
            $('#conge_annee').val(date.getFullYear());
            //        }
        }
        //affichage de liste agents 

    $scope.Intitialiser = function() {
            $('.chosen-container').attr('style', 'width:100%');
            $('.chosen-container').trigger("chosen:updated");
        }
        //save entete typeconge
    $scope.saveTypeConge = function() {
        var libelle = $('#typeconge_libelle').val();
        var nbrjour = $('#typeconge_nbrjour').val();
        var modalite = $('#typeconge_modalitecalcul').val();
        var paye = $('#typeconge_paye').is(':checked');
        var id = $('#typeconge_id').val();
        $scope.param = {
            'libelle': libelle,
            'nbrjour': nbrjour,
            'paye': paye,
            'modalite': modalite,
            'id': id,
        };
        $http({
            url: domaineapp + 'suivipresence.php/typeconge/Savedocument',
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

    //affichage nbr heur 

    //    $scope.affichenbrjourferier = function () {
    //        var mois = $('#mois').val();
    //        alert(mois);
    //        var annee = $('#annee').val();
    //        $scope.param = {
    //            'mois': mois,
    //            'annee': annee,
    //        };
    //        $http({
    //            url: domaineapp + 'suivipresence.php/presence/AfficheNbrjourFerier',
    //            method: "POST",
    //            data: $scope.param,
    //            headers: {
    //                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    //            }
    //        }).then(function mySucces(response) {
    //            data = response.data[0];
    //
    //            $('#jour_ferier').val(data['nbrjourferier']);
    //        }, function myError(response) {
    //            alert(response);
    //        });
    //    }
    //    $("#mois")
    //            .change(function () {
    //                if ($("#mois").val() != "" && $("#annee").val() != "") {
    //                    alert('rrr');
    //                    $scope.affichenbrjourferier();
    //                }
    //            })
    //            .trigger("change");
    //    $("#annee")
    //            .change(function () {
    //                if ($("#mois").val() != "" && $("#annee").val() != "") {
    //                    $scope.affichenbrjourferier();
    //                }
    //            })
    //            .trigger("change");
    //ajouter ligne Classification des jour de conge    
    $scope.AjouterLigneClassification = function() {
            trouve = 0;
            if ($('#nbrj').val() != "") {
                if ($('#type').val() != "") {
                    nordre = $scope.listedocsClassificationConge.length + 1;
                    if ($('#nbrj').val() != "") {
                        $scope.listedocsClassificationConge.push({
                            'norgdre': nordre,
                            'nbrj': $('#nbrj').val(),
                            'idtraitement': $('#typetraitement').val(),
                            'typetraitement': $('#typetraitement option:selected').text(),
                            'commmsion': $('#commmsion').is(':checked'),
                        });
                    }
                } else {
                    var comArr = eval($scope.listedocsClassificationConge);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                            comArr[i].nbrj = $('#nbrj').val();
                            comArr[i].idtraitement = $('#typetraitement').val();
                            comArr[i].typetraitement = $('#typetraitement option:selected').text();
                            comArr[i].commmsion = $('#commmsion').is(':checked');
                            break;
                        }
                    }
                }
                trouve = 1;
            } else {
                bootbox.dialog({
                    message: "Il faut saisir le nbre de jour du Congé !!!",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
            $scope.InaliserChampsClassification();
        }
        //initialiser  Classification des jour de conge  
    $scope.InaliserChampsClassification = function() {
            $('#nordre').val('');
            $('#nbrj').val('');
            //  $('#type').val('');
            $('#commmsion').is(':checked');
            $('#typetraitement').val('');
            $('#typetraitement').trigger("chosen:updated");
        }
        //MISAjour  Classification des jour de conge  
    $scope.MisAJourClassification = function(lignedocClassificationConge) {
            $('#nordre').val(lignedocClassificationConge.norgdre);
            $('#nbrj').val(lignedocClassificationConge.nbrj);
            $('#typetraitement').val(lignedocClassificationConge.idtraitement);
            $('#typetraitement').trigger("chosen:updated");
            if (lignedocClassificationConge.commmsion == 1)
                $('#commmsion').attr('checked', 'true');
            else if (lignedocClassificationConge.commmsion == 0)
                $('#commmsion').removeAttr('checked');
        }
        //Delete  Classification des jour de conge  
    $scope.DeleteClassification = function(lignedocClassificationConge) {
        var index = -1;
        var comArr = eval($scope.listedocsClassificationConge);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === lignedocClassificationConge.norgdre) {
                index = i;
                break;
            }
        }
        $scope.listedocsClassificationConge.splice(index, 1);
        $scope.inialiserTableClassification();
    }
    $scope.inialiserTableClassification = function() {
        var arraytable = [];
        arraytable = $scope.listedocsClassificationConge;
        $scope.listedocsClassificationConge = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.listedocsClassificationConge.push({
                'norgdre': i + 1,
                'nbrj': arraytable[i].nbrj,
                'typetraitement': arraytable[i].typetraitement,
                'commmsion': arraytable[i].commmsion,
            });
        }
    }
    $scope.validerClassification = function() {
            if ($scope.listedocsClassificationConge.length > 0) {
                $scope.document = {
                    'listedocsClassificationConge': $scope.listedocsClassificationConge,
                    'typeconge_id': $('#typeconge_id').val(),
                };
                $http({
                    url: domaineapp + 'suivipresence.php/typeconge/SavedocumentClassificatontypeconge',
                    method: "POST",
                    data: $scope.document,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $('#btnvalideClassification').attr('class', 'btn btn-outline btn-danger');
                }, function myError(response) {
                    alert(response);
                });
            } else
                alert("ERREUR ...!!!");
        }
        //show presence affichage conge 

    $scope.ShowAffichejourconge = function() {

            var id_agent = $("#suivipresence_avecconge_id_agent").val();
            var mois = $("#presence_mois").val();
            var annee = $("#presence_annee").val();


            $scope.param = {
                "id_agent": id_agent,
                "mois": mois,
                "annee": annee,
            }
            $http({
                url: domaineapp + 'suivipresence.php/presence/AfficheShowJourConge',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.listesConge = data;
                $scope.CouleurJourConge();
                for (var i = 1; i <= 5; i++) {
                    CalculTotal(i);
                    CalculTotalHsup(i);
                }
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //affichage ligne conge 
    $scope.AfficherJourConge = function() {

        var id_agent = $("#suivipresence_avecconge_id_agent").val();
        var mois = $("#presence_mois").val();
        var annee = $("#presence_annee").val();
        $scope.param = {
            "id_agent": id_agent,
            "mois": mois,
            "annee": annee,
        }

        $http({
            url: domaineapp + 'suivipresence.php/presence/AfficheJourConge',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesConge = data;
            $scope.CouleurJourConge();
            for (var i = 1; i <= 5; i++) {
                CalculTotal(i);
                CalculTotalHsup(i);
            }

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.afficheregimehoraire = function() {
        var id_agent = $("#suivipresence_avecconge_id_agent").val();
        var mois = $("#presence_mois").val();
        var annee = $("#presence_annee").val();
        $scope.param = {
            "id_agent": id_agent,
            "mois": mois,
            "annee": annee,
        }

        $http({
            url: domaineapp + 'suivipresence.php/presence/AfficheRegimehoraire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#id_regime').val(data['id_regime']);
            var id_rergime = $('#id_regime').val();
            $('#presence_id_regimehoraire').val(id_rergime);
            $('#presence_id_regimehoraire').trigger("chosen:updated");
            $('#regime').val(id_rergime);
            $('#regime').trigger("chosen:updated");
            if (id_rergime != "") {
                $scope.getHeuresRegime(id_rergime, annee);
            }
            $scope.AfficherJourConge();
            $scope.AfficherJourF();
            // IntitialiserGrille();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $("#suivipresence_avecconge_id_agent")
        .change(function() {
            if ($("#suivipresence_avecconge_id_agent").val() != "0") {
                $scope.AfficherJourConge();
                $scope.afficheregimehoraire();
            } else {
                $('#presence_id_regimehoraire').val("");
                $('#presence_id_regimehoraire').trigger("chosen:updated");
                $('#regime').val("");
                $('#regime').trigger("chosen:updated");
                $('[name="semaine_heure"]').each(function() {
                    $(this).val('');
                });
                $('[name="heur_supp"]').each(function() {
                    $(this).val('');
                });
            }
        })
        .trigger("change");
    $scope.AfficherListeAgents = function() {

        var id_regime = $("#presence_id_regimehoraire").val();
        $('#regime').val(id_regime);
        $('#regime').trigger("chosen:updated");
        $scope.param = {
            "id": id_regime
        }
        $http({
            url: domaineapp + 'suivipresence.php/presence/AfficheListeAgentsParRegime',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#listeagentssansconge').show();
            $('#listeagentssansconge').html('<select multiple="multiple" size="12" name="suivipresence[id_agent]" id="suivipresence_id_agent"></select>');
            $scope.ChargerComboMultiple('#suivipresence_id_agent', data);
            var annee = $("#presence_annee").val();
            if (id_regime != "") {
                $scope.getHeuresRegime(id_regime, annee);
            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.getHeuresRegime = function(id_regime, annee) {
        if (id_regime) {
            $scope.param = {
                "id": id_regime,
                "annee": annee
            }
            $http({
                url: domaineapp + 'suivipresence.php/presence/getHeuresRegime',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                if (data.length > 0) {
                    $('[name="semaine_heure"]').each(function() {
                        var rang_jour = $(this).attr('jour');
                        rang_jour = parseInt(rang_jour) - 1;
                        $(this).val(data[rang_jour]['nbrheuret']);
                        if (data[rang_jour]['jourrepos'] == false) {
                            var type_input = 'heure_' + $(this).attr('semaine');
                            $(this).attr('type_input', type_input);
                            $(this).removeAttr('readonly');
                        } else {
                            $(this).removeAttr('type_input');
                            $(this).attr('readonly', 'true');
                        }
                    });
                    $('[name="heur_supp"]').each(function() {
                        $(this).val(0);
                        var rang_jour = $(this).attr('jour');
                        rang_jour = parseInt(rang_jour) - 1;
                        if (data[rang_jour]['jourrepos'] == false) {
                            var type_input = 'supp_' + $(this).attr('semaine');
                            $(this).attr('type_input', type_input);
                            $(this).removeAttr('readonly');
                        } else {
                            $(this).removeAttr('type_input');
                            $(this).attr('readonly', 'true');
                        }
                    });
                } else {
                    $('[name="semaine_heure"]').each(function() {
                        $(this).val('');
                    });
                    $('[name="heur_supp"]').each(function() {
                        $(this).val('');
                    });
                }

                for (var i = 1; i <= 6; i++) {
                    CalculTotal(i);
                    CalculTotalHsup(i);
                }
                //            if ($("#id_presence").val() != "")
                //            {
                //                IntitialiserGrille();
                //                $scope.AfficherJourConge();
                //                $scope.AfficherJourF();
                //            }
                //            else {
                //                IntitialiserGrillePresence();
                //            }



            }, function myError(response) {
                alert("Erreur d'ajout");
            });

        }
    }

    $("#presence_id_regimehoraire")
        .change(function() {
            if ($("#presence_id_regimehoraire").val() != "") {
                $scope.AfficherListeAgents();
            } else {
                $('#regime').val("");
                $('#regime').trigger("chosen:updated");
                $('[name="semaine_heure"]').each(function() {
                    $(this).val('');
                });
                $('[name="heur_supp"]').each(function() {
                    $(this).val('');
                });
            }

        })
        .trigger("change");
    $scope.ChargerComboMultiple = function(id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        var demo1 = $('select[name="suivipresence[id_agent]"]').bootstrapDualListbox({ infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>' });
        var container1 = demo1.bootstrapDualListbox('getContainer');
        container1.find('.btn').addClass('btn-white btn-info btn-bold');
    }

    $scope.CouleurJourConge = function() {
            var comArr = eval($scope.listesConge);
            for (var j = 1; j <= 31; j++) {
                $('#td' + j).css('background', 'FFF');
            }
            for (var i = 0; i < comArr.length; i++) {
                var date_debut_mois = comArr[i].datedebut.substring(5, 7);
                var date_fin_mois = comArr[i].datefin.substring(5, 7);
                if ($('#presence_mois').val() == date_debut_mois)
                    var dated = comArr[i].datedebut.substring(8, 10);
                else
                    var dated = '01';
                if ($('#presence_mois').val() == date_fin_mois)
                    var datef = comArr[i].datefin.substring(8, 10);
                else
                    var datef = '31';
                for (var k = parseInt(dated); k <= parseInt(datef); k++) {
                    if ($('#idmotif_' + k).attr('jour_ferier') == '1') {
                        //                    if ($('#idmotif_' + k).attr('jour_ferier_paye') == '1') {
                        //                        if (comArr[i].idtype == '1' || comArr[i].idtype == '3') {
                        //                            //rien
                        //                        } else {
                        //                            $('#td_' + k).css('background-color', '#c6abbb');
                        //                            $('#td_' + k).addClass("disabledbutton");
                        //                        }
                        //                    }
                    } else {
                        $('#td_' + k).css('background-color', '#c6abbb');
                        $('#td_' + k).addClass("disabledbutton");
                    }

                    //                if ($('#s_' + k).attr("weekend") == "Sun") {
                    //                    $('#s_' + k).val("0");
                    //                    if ($('#s_' + k).attr("weekend") == "Sat")
                    //                        $('#idmotif_' + k).val(3);
                    //                    else {
                    //                        if (comArr[i].idtype != '1' && comArr[i].idtype != '3')
                    //                            $('#idmotif_' + k).val(3);
                    //                    }
                    //                }
                    //                else
                    //                {
                    $('#s_' + k).val("0");
                    $('#idmotif_' + k).val(3);
                    //}

                    if ($('#idmotif_' + k).attr('jour_ferier_paye') == '1') {
                        if (comArr[i].idtype == '1' || comArr[i].idtype == '3') {
                            if ($('#s_' + k).attr("weekend") != "Sun") {
                                if ($('#idmotif_' + k).val() == '3')
                                    $('#idmotif_' + k).val('');
                                else
                                    $('#idmotif_' + k).val(3);
                            } else {
                                $('#idmotif_' + k).val('');
                            }
                        }
                    }
                }
            }
        }
        //affichage ligne classification  

    $scope.affichageligneclassification = function(iddoc) {
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'suivipresence.php/typeconge/AfficheligneTypeConge',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listedocsClassificationConge = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficherJourF = function() {

        var mois = $("#presence_mois").val();
        var annee = $("#presence_annee").val();
        $scope.param = {
            "mois": mois,
            "annee": annee,
        }

        $http({
            url: domaineapp + 'suivipresence.php/presence/AfficheJourFerier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listesJourFerier = data;
            $scope.CouleurJourF();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.CouleurJourF = function() {
        var comArr = eval($scope.listesJourFerier);
        for (var j = 1; j <= 31; j++) {
            $('#td' + j).css('background', 'FFF');
        }
        for (var i = 0; i < comArr.length; i++) {
            var date = comArr[i].date.substring(8, 10);
            date = parseInt(date);
            $('#td_' + date).css('background-color', $scope.doc_classes_colors[i % comArr.length]);
            if ($('#s_' + date).attr("weekend") == "Sat" || $('#s_' + date).attr("weekend") == "Sun") {
                $('#s_' + date).val("");
            }
            if (!comArr[i].paye) {
                if ($('#s_' + date).attr("weekend") == "Sat" || $('#s_' + date).attr("weekend") == "Sun") {
                    $('#s_' + date).val("");
                } else {
                    $('#s_' + date).val("0");
                }
            } else {
                $('#idmotif_' + date).attr('jour_ferier_paye', '1');
            }
            $('#idmotif_' + date).attr('jour_ferier', '1');
        }
    }

    $("#presence_mois").change(function() {
            var id_regime = $("#presence_id_regimehoraire").val();
            if ($("#presence_mois").val() != "" && $("#presence_annee").val() != "") {
                $scope.AfficherJourF();
                if ($("#test").val() == 1) {
                    $scope.AfficherJourConge();
                }
                if ($("#presence_id_regimehoraire").val() != "") {
                    $scope.getHeuresRegime(id_regime, $("#presence_annee").val());
                }
            }
        })
        .trigger("change");
    $("#presence_annee").change(function() {
            var id_regime = $("#presence_id_regimehoraire").val();
            if ($("#presence_mois").val() != "" && $("#presence_annee").val() != "") {
                $scope.AfficherJourF();
                if ($("#test").val() == 1) {
                    $scope.AfficherJourConge();
                }
                if ($("#presence_id_regimehoraire").val() != "") {
                    $scope.getHeuresRegime(id_regime, $("#presence_annee").val());
                }
            }
        })
        .trigger("change");
    $scope.AjouterEmploye = function() {
        var nbrheur = $("#nbrheurregime").val();
        if ($("#test").val() != 0) {
            var heure_jours = '';
            $('[name="jour_heure"]').each(function() {
                heure_jours = heure_jours + $(this).val() + ',,';
            });
            var heure_semaines = '';
            $('[name="semaine_heure"]').each(function() {
                heure_semaines = heure_semaines + $(this).val() + ',,';
            });
            var total_heure = '';

            $('[name="total_heure"]').each(function() {
                total_heure = total_heure + $(this).val() + ',,';
                if (parseInt($(this).val()) > parseInt(nbrheur)) {
                    bootbox.dialog({
                        message: "Il'ya une semaine qui dépasse le régime !!",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                    return;
                }
            });

            var total_sup = '';
            $('[name="total_sup"]').each(function() {
                total_sup = total_sup + $(this).val() + ',,';
            });
            var heure_semaines = '';
            $('[name="semaine_heure"]').each(function() {
                heure_semaines = heure_semaines + $(this).val() + ',,';
            });
            var heure_supp = '';
            $('[name="heur_supp"]').each(function() {
                heure_supp = heure_supp + $(this).val() + ',,';
            });
            var jour_motif = '';
            $('[name="jour_motif"]').each(function() {
                jour_motif = jour_motif + $(this).val() + ',,';
            });
            if ($("#test").val() == 2) {
                var x = document.getElementById("suivipresence_id_agent");
                var ids = '';
                for (var i = 0; i < x.selectedOptions.length; i++) {
                    ids = ids + x.selectedOptions[i].value + ',,';
                }
            } else {
                var ids = $("#suivipresence_avecconge_id_agent").val();
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

            var mois = $("#presence_mois").val();
            var annee = $("#presence_annee").val();
            var totno = $("#total_heure_normal").val();
            var totsupp = $("#total_heure_supp").val();
            var id_regime = $("#presence_id_regimehoraire").val();
            $scope.param = {
                "jour_motif": jour_motif,
                "heure_semaines": heure_semaines,
                "heure_jours": heure_jours,
                "heure_supp": heure_supp,
                "total_heure": total_heure,
                "total_sup": total_sup,
                "ids": ids,
                "mois": mois,
                "annee": annee,
                "totno": totno,
                "totsupp": totsupp,
                "id_regime": id_regime,
            }
            $http({
                url: domaineapp + 'suivipresence.php/presence/saveEmploye',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                if (data != '0') {
                    $('#save_button').hide();
                    var url = domaineapp + 'suivipresence.php/presence/imprimerListePresence?ids=' + ids + '&mois=' + mois + '&annee=' + annee;
                    $('#print_button').attr('href', url);
                    $('#print_button').show();
                    bootbox.dialog({
                        message: "Ajout avec succes!!",
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                } else {
                    bootbox.dialog({
                        message: 'Présence pour cet agent (ou bien un agent) existe déjà ! Veuillez vérifier le mois du présence !',
                        buttons: {
                            "button": {
                                "label": "Ok",
                                "className": "btn-sm"
                            }
                        }
                    });
                }
                //            if (data != "" && data != "erreurr !!!")
                //                document.location.href = "edit?id=" + data;
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else {
            bootbox.dialog({
                message: "Choisr l'Agent!!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }

    //*** afficher l'un des deux div 
    //    $scope.getListeAgents = function () {
    //        if ($('#test') == 1)
    //        {
    //            $('#listeagentssansconge').hide();
    //            $('#listeagentsavecconge').show();
    //        }
    //        else if ($('#test') == 2) {
    //            $('#listeagentssansconge').show();
    //            $('#listeagentsavecconge').hide();
    //        }
    //    }
    //modfier presence
    $scope.ModifierEmploye = function(id, id_agents) {
        var heure_jours = '';
        $('[name="jour_heure"]').each(function() {
            heure_jours = heure_jours + $(this).val() + ',,';
        });
        var heure_semaines = '';
        $('[name="semaine_heure"]').each(function() {
            heure_semaines = heure_semaines + $(this).val() + ',,';
        });
        var total_heure = '';
        $('[name="total_heure"]').each(function() {
            total_heure = total_heure + $(this).val() + ',,';
        });
        var total_sup = '';
        $('[name="total_sup"]').each(function() {
            total_sup = total_sup + $(this).val() + ',,';
        });
        var heure_supp = '';
        $('[name="heur_supp"]').each(function() {
            heure_supp = heure_supp + $(this).val() + ',,';
        });
        var jour_motif = '';
        $('[name="jour_motif"]').each(function() {
            jour_motif = jour_motif + $(this).val() + ',,';
        });
        var totno = $("#total_heure_normal").val();
        var totsupp = $("#total_heure_supp").val();
        //  var id_regime = $("#presence_id_regimehoraire").val();
        $scope.param = {
            "jour_motif": jour_motif,
            "heure_semaines": heure_semaines,
            "heure_jours": heure_jours,
            "heure_supp": heure_supp,
            "total_heure": total_heure,
            "total_sup": total_sup,
            "totno": totno,
            "totsupp": totsupp,
            "id": id,
            "id_agents": id_agents,
            //      "id_regime": id_regime,
        }
        $http({
            url: domaineapp + 'suivipresence.php/presence/editEmploye',
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
            //            if (data != "" && data != "erreurr !!!")
            //                document.location.href = "edit?id=" + data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }


    //affichage total du grille

    $scope.affichergrillepresence = function(id) {
            $scope.param = {
                'id': id,
            }
            $http({
                url: domaineapp + 'suivipresence.php/presence/AffichedetailGrille',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data[0];
                $('#s_7_1').val(data['totalsemain1']);
                $('#s_7_2').val(data['totalsemain2']);
                $('#s_7_3').val(data['totalsemaine3']);
                $('#s_7_4').val(data['totalsemaine4']);
                $('#s_7_5').val(data['totalsemaine5']);
                $('#h_7_1').val(data['totalheuresupp1']);
                $('#h_7_2').val(data['totalheuresupp2']);
                $('#h_7_3').val(data['totalheuresupp3']);
                $('#h_7_4').val(data['totalheursupp4']);
                $('#h_7_5').val(data['totalheuresupp5']);
                $('#totalheurehesupp').val(data['nbhsupp']);
                $('#totalheurnorma').val(data['nbrtotalnormal']);
            }, function myError(response) {
                alert(response);
            });
        }
        //affichage grille 

    $scope.afficherSemainegrillepresence = function(id) {
        $scope.param = {
            'id': id,
        }
        $http({
            url: domaineapp + 'suivipresence.php/presence/AffichedetailSemaineGrille',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                for (var j = 1; j <= 5; j++) {
                    for (var i = 1; i < data.length; i++) {
                        id = '#s_' + j + '_' + i;
                        $(id).val(data[j].semaine);
                    }
                }
            }

        }, function myError(response) {
            alert(response);
        });
    }

    $scope.AffichedetailAgents = function() {
        var id_agent = $('#conge_id_agents').val();
        $scope.param = {
            'idag': id_agent
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichedetailAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#idrh').val(data.agents[0]['idrh']);
            $('#poste').val(data.contrat[0]['poste']);
            $('#nom').val(data.agents[0]['nom']);
            $('#grade').val(data.contrat[0]['grade']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#conge_id_agents")
        .change(function() {
            if ($("#conge_id_agents").val() != "0") {
                $scope.AffichedetailAgents();
            }
        })
        .trigger("change");
    //*** afficahge detail type congeS
    $scope.AffichedetailTypeConge = function() {
        var id_type = $('#conge_id_type').val();
        $scope.param = {
            'id_type': id_type
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichedetailTypeConge',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#nbrjour').val(data['nbrjour']);
            if (data['paye'] == true) {
                $('#paye').val("Payé");
            } else {
                $('#paye').val("Non Payé");
            }
            $('#modalitecalcul').val(data['modalitecalcul']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#conge_id_type")
        .change(function() {
            if ($("#conge_id_type").val() != "") {
                $scope.AffichedetailTypeConge();
            }
        })
        .trigger("change");
    //nbre de jour propose 
    $scope.ChargerNbrjourVacance = function() {

        var datedebut = $('#conge_datedebut').val();
        var datefin = $('#conge_datefin').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }
        var typeconge = $('#conge_id_type').val();
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/Affichenbrejour',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#conge_nbrjour').val(data);
        }, function myError(response) {
            alert(response);
        });
    }

    $("#conge_datefin")
        .blur(function() {
            if ($("#conge_datefin").val() != "" && $("#conge_datefin").val() != "") {
                $scope.ChargerNbrjourVacance();
            }
        })
        .trigger("change");
    $("#conge_datedebut").blur(function() {
        if ($("#conge_datedebut").val() != "" && $("#conge_datefin").val() != "") {
            $scope.ChargerNbrjourVacance();
        }
    }).trigger("change");
    $("#conge_id_type")
        .blur(function() {
            if ($("#conge_id_type").val() != "" && $("#conge_datedebut").val() != "" && $("#conge_datefin").val() != "") {
                $scope.ChargerNbrjourVacance();
            }
        })
        .trigger("change");
    //nbre de jour valide 
    $scope.ChargerNbrjourVacancevalide = function() {
        var datedebut = $('#conge_datedebutvalide').val();
        var datefin = $('#conge_datefinvalide').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }
        var typeconge = $('#conge_id_type').val();
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourValide',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#conge_nbrjvalide').val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#conge_datedebutvalide").blur(function() {
            if ($("#conge_datedebutvalide").val() != "" && $("#conge_datefinvalide").val() != "") {
                $scope.ChargerNbrjourVacancevalide();
            }
        })
        .trigger("change");
    $("#conge_datefinvalide")
        .blur(function() {
            if ($("#conge_datefinvalide").val() != "" && $("#conge_datedebutvalide").val() != "") {
                $scope.ChargerNbrjourVacancevalide();
            }
        })
        .trigger("change");
    //nbr jour realise 
    $scope.ChargerNbrjourRealise = function() {
        var datedebut = $('#datedebutV').val();
        var datefin = $('#datefinV').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }
        var typeconge = $('#idtype_1').val();
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge,
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourRealise',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjv').val(data);
            $('#nbrjrestantValide').val($('#totalconge').val() - data);
            $('#nbrcongetot').val(parseFloat(data));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datedebutV")
        .blur(function() {
            if ($("#datedebutV").val() != "" && $("#datefinV").val() != "") {
                $scope.ChargerNbrjourRealise();
            }
        })
        .trigger("change");
    $("#datefinV")
        .blur(function() {
            if ($("#datedebutV").val() != "" && $("#datefinV").val() != "") {
                $scope.ChargerNbrjourRealise();
            }
        })
        .trigger("change"); //br jour realise type maladie ordinaire 
    $scope.ChargerNbrjourRealiseType2 = function() {
        if (($('#datedebutValidetype2').val() != "") && ($('#datefinValidetype2').val() != "")) {
            var datedebut = $('#datedebutValidetype2').val();
            var datefin = $('#datefinValidetype2').val();
            var typeconge = $('#idtype_2').val();
            if (datefin < datedebut) {
                alert('Il faut que la date fin doit être suppérieure au date début !');
            }
        }
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourRealisetype2',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjvtype2').val(data);
            $('#nbrjrestantValidetyp2').val($('#jourparanne').val() - $('#nbrjourprise').val() - data);
            $('#nbrcongetot2').val(parseFloat(data));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datedebutValidetype2")
        .blur(function() {
            if ($("#datedebutValidetype2").val() != "" && $("#datedatefinValidetype2finV").val() != "") {
                $scope.ChargerNbrjourRealiseType2();
            }
        })
        .trigger("change");
    $("#datefinValidetype2")
        .blur(function() {
            if ($("#datedebutValidetype2").val() != "" && $("#datedatefinValidetype2finV").val() != "") {
                $scope.ChargerNbrjourRealiseType2();
            }
        })
        .trigger("change");
    $scope.ChargerNbrjourRealiseType3 = function() {
        if (($('#datedebutValidetype3').val() != "") && ($('#datefinValidetype3').val() != "")) {
            var datedebut = $('#datedebutValidetype3').val();
            var datefin = $('#datefinValidetype3').val();
            var typeconge = $('#idtype_3').val();
            if (datefin < datedebut) {
                alert('Il faut que la date fin doit être suppérieure au date début !');
            }
        }
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourRealisetype3',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjvtype3').val(data);
            $('#nbrjrestantValidetyp3').val($('#jourparanne').val() - $('#nbrjourprise').val() - data);
            $('#nbrcongetot3').val(parseFloat(data));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datedebutValidetype3")
        .blur(function() {
            if ($("#datedebutValidetype3").val() != "") {
                $scope.ChargerNbrjourRealiseType3();
            }
        })
        .trigger("change");
    $("#datefinValidetype3")
        .blur(function() {
            if ($("#datefinValidetype3").val() != "") {
                $scope.ChargerNbrjourRealiseType3();
            }
        })
        .trigger("change");
    $scope.ChargerNbrjourRealiseType5 = function() {
        var datedebut = $('#datedebutValidetype5').val();
        var datefin = $('#datefinValidetype5').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }
        var typeconge = $('#idtype').val();
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourRealisetype5',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjvtype5').val(data);
            $('#nbrcongetot2').val(parseFloat(data));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datedebutValidetype5")
        .blur(function() {
            if ($("#datedebutValidetype5").val() != "" && $("#datefinValidetype5").val() != "") {
                $scope.ChargerNbrjourRealiseType5();
            }
        })
        .trigger("change");
    $("#datefinValidetype5")
        .blur(function() {
            if ($("#datedebutValidetype5").val() != "" && $("#datefinValidetype5").val() != "") {
                $scope.ChargerNbrjourRealiseType5();
            }
        })
        .trigger("change");
    //  $('#nbrjvtype6').val($('#jourparanne').val()  - data);
    //            $('#nbrjrestantValidetyp6').val($('#jourparanne').val() - data);


    $scope.ChargerNbrjourRealiseType6 = function() {
        var datedebut = $('#datedebutValidetype6').val();
        var datefin = $('#datefinValidetype6').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }
        var typeconge = $('#idtype').val();
        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourRealisetype6',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjvtype6').val(data);
            $('#nbrjrestantValidetyp6').val($('#jourparanne').val() - data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datefinValidetype6")
        .blur(function() {
            if ($("#datedebutValidetype6").val() != "" && $("#datefinValidetype6").val() != "") {
                $scope.ChargerNbrjourRealiseType6();
            }
        })
        .trigger("change");
    $("#datedebutValidetype6")
        .blur(function() {
            if ($("#datedebutValidetype6").val() != "" && $("#datefinValidetype6").val() != "") {
                $scope.ChargerNbrjourRealiseType6();
            }
        })
        .trigger("change");
    // nbr jour prolonge 
    $scope.ChargerNbrjourExtension = function() {
        var datedebut = $('#datedebutextension').val();
        var datefin = $('#datefinextension').val();
        //         var typeconge = $('#idtype').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }

        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            //             'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourExtension',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjex').val(data);
            $('#nbrjrestantApresExtension').val($('#totalconge').val() - $('#nbrjv').val() - data);
            $('#nbrcongetot').val(parseFloat(parseFloat($('#nbrjv').val()) + parseFloat(data)));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datefinextension").blur(function() {
            if ($("#datedebutextension").val() != "" && $("#datefinextension").val() != "") {
                $scope.ChargerNbrjourExtension();
            }
        })
        .trigger("change");
    $("#datedebutextension").blur(function() {
            if ($("#datedebutextension").val() != "" && $("#datefinextension").val() != "") {
                $scope.ChargerNbrjourExtension();
            }
        })
        .trigger("change");
    //nbr jour prolonge
    $scope.ChargerNbrjourExtension2 = function() {
        var datedebut = $('#datedebutextension2').val();
        var datefin = $('#datefinextension2').val();
        var typeconge = $('#idtype_2').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }

        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourExtension2',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjex2').val(data);
            $('#nbrjrestantApresExtension2').val($('#jourparanne').val() - $('#nbrjvtype2').val() - $('#nbrjourprise').val() - data);
            $('#nbrcongetot2').val(parseFloat(parseFloat($('#nbrjvtype2').val()) + parseFloat(data)));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datedebutextension2")
        .blur(function() {
            if ($("#datedebutextension2").val() != "" && $("#datefinextension2").val() != "") {
                $scope.ChargerNbrjourExtension2();
            }
        })
        .trigger("change");
    $("#datefinextension2")
        .blur(function() {
            if ($("#datedebutextension2").val() != "" && $("#datefinextension2").val() != "") {
                $scope.ChargerNbrjourExtension2();
            }
        })
        .trigger("change");
    //nbr jour prolonge type 3
    $scope.ChargerNbrjourExtension3 = function() {
        var datedebut = $('#datedebutextension3').val();
        var datefin = $('#datefinextension3').val();
        var typeconge = $('#idtype_3').val();
        if (datefin < datedebut) {
            alert('Il faut que la date fin doit être suppérieure au date début !');
        }

        $scope.param = {
            'datefin': datefin,
            'datedebut': datedebut,
            'typeconge': typeconge
        }
        $http({
            url: domaineapp + 'suivipresence.php/conge/AffichenbrejourExtension3',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#nbrjex3').val(data);
            $('#nbrjrestantApresExtension3').val($('#jourparanne').val() - $('#nbrjvtype3').val() - $('#nbrjourprise').val() - data);
            $('#nbrcongetot3').val(parseFloat(parseFloat($('#nbrjvtype3').val()) + parseFloat(data)));
        }, function myError(response) {
            alert(response);
        });
    }
    $("#datedebutextension3")
        .blur(function() {
            if ($("#datedebutextension3").val() != "" && $("#datefinextension3").val() != "") {
                $scope.ChargerNbrjourExtension3();
            }
        })
        .trigger("change");
    $("#datefinextension3")
        .blur(function() {
            if ($("#datedebutextension3").val() != "" && $("#datefinextension3").val() != "") {
                $scope.ChargerNbrjourExtension3();
            }
        })
        .trigger("change");
    //------------------
    $scope.intiliserObjection = function() {
        if ($('#conge_objection').is(':checked')) {
            $('#conge_datedebutvalide').addClass("disabledbutton");
            $('#conge_datefinvalide').addClass("disabledbutton");
        } else {
            $('#conge_datedebutvalide').removeClass("disabledbutton");
            $('#conge_datefinvalide').removeClass("disabledbutton");
        }
    }
    $("#conge_objection")
        .change(function() {
            $scope.intiliserObjection();
        })
        .trigger("change");
    //initialiser extension
    $scope.intiliserDate = function() {
        if ($('#extension').is(':checked')) {

            //            $('#datedebutextension').val()= $('#datefinV').val();
            if ($('#datefinV').val() != "") {
                data = $('#datefinV').val();
                //Debut : incrementer 1 jour à une date définie
                var mydate = new Date(data);
                mydate.setDate(mydate.getDate() + 1);
                var y = mydate.getFullYear(),
                    m = mydate.getMonth() + 1, // january is month 0 in javascript
                    d = mydate.getDate();
                var pad = function(val) {
                    var str = val.toString();
                    return (str.length < 2) ? "0" + str : str
                };
                data = [y, pad(m), pad(d)].join("-");
                //Fin : incrementer 1 jour à une date définie
                $('#datedebutextension').val(data);
            }
            $('#datedebutextension').removeClass("disabledbutton");
            $('#datefinextension').removeClass("disabledbutton");
        } else {
            $('#datefinextension').val('');
            $('#datedebutextension').val('');
            $('#datefinextension').addClass("disabledbutton");
            $('#datedebutextension').addClass("disabledbutton");
        }
    }
    $("#extension")
        .change(function() {
            $scope.intiliserDate();
        })
        .trigger("change");
    //initialise date d'extension type2 
    $scope.intiliserDateEtype2 = function() {
        if ($('#extensiontype2').is(':checked')) {

            if ($('#datefinValidetype2').val() != "") {
                data = $('#datefinValidetype2').val();
                //Debut : incrementer 1 jour à une date définie
                var mydate = new Date(data);
                mydate.setDate(mydate.getDate() + 1);
                var y = mydate.getFullYear(),
                    m = mydate.getMonth() + 1, // january is month 0 in javascript
                    d = mydate.getDate();
                var pad = function(val) {
                    var str = val.toString();
                    return (str.length < 2) ? "0" + str : str
                };
                data = [y, pad(m), pad(d)].join("-");
                //Fin : incrementer 1 jour à une date définie
                $('#datedebutextension2').val(data);
            }
            $('#datedebutextension2').removeClass("disabledbutton");
            $('#datefinextension2').removeClass("disabledbutton");
        } else {
            $('#nbrjex2').val("");
            $('#nbrjrestantApresExtension2').val("");
            $('#datedebutextension2').val("");
            $('#datefinextension2').val("");
            $('#datefinextension2').addClass("disabledbutton");
            $('#datedebutextension2').addClass("disabledbutton");
            $scope.ChargerNbrjourRealiseType2();
        }
    }
    $("#extensiontype2")
        .change(function() {
            $scope.intiliserDateEtype2();
        })
        .trigger("change");
    //initialiser date d'extension type 3
    $scope.intiliserDateEtype3 = function() {
        if ($('#extensiontype3').is(':checked')) {

            if ($('#datefinValidetype3').val() != "") {
                data = $('#datefinValidetype3').val();
                //Debut : incrementer 1 jour à une date définie
                var mydate = new Date(data);
                mydate.setDate(mydate.getDate() + 1);
                var y = mydate.getFullYear(),
                    m = mydate.getMonth() + 1, // january is month 0 in javascript
                    d = mydate.getDate();
                var pad = function(val) {
                    var str = val.toString();
                    return (str.length < 2) ? "0" + str : str
                };
                data = [y, pad(m), pad(d)].join("-");
                //Fin : incrementer 1 jour à une date définie
                $('#datedebutextension3').val(data);
            }
            $('#datedebutextension3').removeClass("disabledbutton");
            $('#datefinextension3').removeClass("disabledbutton");
        } else {
            $('#nbrjex3').val("");
            $('#nbrjrestantApresExtension3').val("");
            $('#datedebutextension3').val("");
            $('#datefinextension3').val("");
            $('#datefinextension3').addClass("disabledbutton");
            $('#datedebutextension3').addClass("disabledbutton");
            $scope.ChargerNbrjourRealiseType3();
        }
    }
    $("#extensiontype3")
        .change(function() {
            $scope.intiliserDateEtype3();
        })
        .trigger("change");
    //save demande conge

    $scope.saveDemandeConge = function() {
            if ($('#conge_id_agents').val() == "") {
                bootbox.dialog({
                    message: "Veuillez Choisir le Demandeur !",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            } else {
                var id_agents = $('#conge_id_agents').val();
                var id_type = $('#conge_id_type').val();
                var dated = $('#conge_datedebut').val();
                var datef = $('#conge_datefin').val();
                var nbrj = $('#conge_nbrjour').val();
                var lieu = $('#conge_lieu').val();
                var sign = $('#conge_signature').val();
                var objection = $('#conge_objection').is(':checked');
                var datedvalide = $('#conge_datedebutvalide').val();
                var datefvalide = $('#conge_datefinvalide').val();
                var nbjvalide = $('#conge_nbrjvalide').val();
                var responsable = $('#conge_responsable').val();
                var signatureres = $('#conge_signatureresponsable').val();
                var annee = $('#conge_annee').val();
                var id = $('#id_conge').val();
                $scope.param = {
                    'id_agents': id_agents,
                    'id_type': id_type,
                    'dated': dated,
                    'datef': datef,
                    'nbrj': nbrj,
                    'lieu': lieu,
                    'sign': sign,
                    'datedvalide': datedvalide,
                    'objection': objection,
                    'datefvalide': datefvalide,
                    'nbjvalide': nbjvalide,
                    'responsable': responsable,
                    'signatureres': signatureres,
                    'annee': annee,
                    'id': id,
                };
                $http({
                    url: domaineapp + 'suivipresence.php/conge/SavedocumentDemande',
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
                    document.location.href = "edit?id=" + data;
                }, function myError(response) {
                    alert(response);
                });
            }
        }
        //valider conge

    $scope.Valider = function() {
            var nbrjrestant = $('#nbrjrestant').val();
            var jourparanneprecedant = $('#jourparanneprecedant').val();
            var droit = $('#droit').val();
            var datedebutvalide = $('#datedebutV').val();
            var datefinvalide = $('#datefinV').val();
            var nbrjv = $('#nbrjv').val();
            var valide = $('#valide').is(':checked');
            var extension = $('#extension').is(':checked');
            var datedebutextension = $('#datedebutextension').val();
            var datefinextension = $('#datefinextension').val();
            var nbrjrestantValide = $('#nbrjrestantValide').val();
            var nbrjrestantApresExtension = $('#nbrjrestantApresExtension').val();
            var nbrcongetot = $('#nbrcongetot').val();
            var nbrjex = $('#nbrjex').val();
            var id = $('#id_conge').val();
            $scope.param = {
                'datefinextension': datefinextension,
                'datedebutextension': datedebutextension,
                'extension': extension,
                'valide': valide,
                'datefinvalide': datefinvalide,
                'datedebutvalide': datedebutvalide,
                'nbrjv': nbrjv,
                'nbrjrestant': nbrjrestant,
                'jourparanneprecedant': jourparanneprecedant,
                'droit': droit,
                'nbrjrestantValide': nbrjrestantValide,
                'nbrjrestantApresExtension': nbrjrestantApresExtension,
                'nbrcongetot': nbrcongetot,
                'nbrjex': nbrjex,
                'id': id,
            };
            $http({
                url: domaineapp + 'suivipresence.php/conge/SavedocumentDemandeValide',
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
        //valider suivi type 2

    $scope.Validertype2 = function() {
            var nbrjrestant = $('#nbrjrestant').val();
            var droit = $('#jourparanne').val();
            var datedebutvalide = $('#datedebutValidetype2').val();
            var datefinvalide = $('#datefinValidetype2').val();
            var nbrjv = $('#nbrjvtype2').val();
            var valide = $('#valide').is(':checked');
            var extension = $('#extensiontype2').is(':checked');
            var datedebutextension = $('#datedebutextension2').val();
            var datefinextension = $('#datefinextension2').val();
            var nbrjrestantValide = $('#nbrjrestantValidetyp2').val();
            var nbrjrestantApresExtension = $('#nbrjrestantApresExtension2').val();
            var nbrcongetot = $('#nbrcongetot2').val();
            var nbrjex2 = $('#nbrjex2').val();
            var id = $('#id_conge_2').val();
            $scope.param = {
                'datefinextension': datefinextension,
                'datedebutextension': datedebutextension,
                'extension': extension,
                'valide': valide,
                'datefinvalide': datefinvalide,
                'datedebutvalide': datedebutvalide,
                'nbrjv': nbrjv,
                'nbrjrestant': nbrjrestant,
                'droit': droit,
                'nbrjrestantValide': nbrjrestantValide,
                'nbrjrestantApresExtension': nbrjrestantApresExtension,
                'nbrcongetot': nbrcongetot,
                'nbrjex2': nbrjex2,
                'id': id,
            };
            $http({
                url: domaineapp + 'suivipresence.php/conge/SavedocumentDemandeValidetype2',
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
        //valider type 3

    $scope.Validertype3 = function() {
            var nbrjrestant = $('#nbrjrestant').val();
            var droit = $('#jourparanne').val();
            var datedebutvalide = $('#datedebutValidetype3').val();
            var datefinvalide = $('#datefinValidetype3').val();
            var nbrjv = $('#nbrjvtype3').val();
            var valide = $('#valide').is(':checked');
            var extension = $('#extensiontype3').is(':checked');
            var datedebutextension = $('#datedebutextension3').val();
            var datefinextension = $('#datefinextension3').val();
            var nbrjrestantValide = $('#nbrjrestantValidetyp3').val();
            var nbrjrestantApresExtension = $('#nbrjrestantApresExtension3').val();
            var nbrcongetot = $('#nbrcongetot3').val();
            var nbrjex2 = $('#nbrjex3').val();
            var id = $('#id_conge_3').val();
            $scope.param = {
                'datefinextension': datefinextension,
                'datedebutextension': datedebutextension,
                'extension': extension,
                'valide': valide,
                'datefinvalide': datefinvalide,
                'datedebutvalide': datedebutvalide,
                'nbrjv': nbrjv,
                'nbrjrestant': nbrjrestant,
                'droit': droit,
                'nbrjrestantValide': nbrjrestantValide,
                'nbrjrestantApresExtension': nbrjrestantApresExtension,
                'nbrcongetot': nbrcongetot,
                'nbrjex2': nbrjex2,
                'id': id,
            };
            $http({
                url: domaineapp + 'suivipresence.php/conge/SavedocumentDemandeValidetype3',
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
        //valider typr 5

    $scope.Validertype5 = function() {
            var droit = $('#jourparanne').val();
            var datedebutvalide = $('#datedebutValidetype5').val();
            var datefinvalide = $('#datefinValidetype5').val();
            var nbrjv = $('#nbrjvtype5').val();
            var valide = $('#valide').is(':checked');
            var id = $('#id_conge_2').val();
            var nbrcongetot = $('#nbrcongetot2').val();
            $scope.param = {
                'valide': valide,
                'datefinvalide': datefinvalide,
                'datedebutvalide': datedebutvalide,
                'nbrjv': nbrjv,
                'droit': droit,
                'nbrcongetot': nbrcongetot,
                'id': id,
            };
            $http({
                url: domaineapp + 'suivipresence.php/conge/SavedocumentDemandeValidetype5',
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
        //valider type 6

    $scope.Validertype6 = function() {
        var droit = $('#jourparanne').val();
        var datedebutvalide = $('#datedebutValidetype6').val();
        var datefinvalide = $('#datefinValidetype6').val();
        var nbrjv = $('#nbrjvtype6').val();
        var nbrjrestant = $('#nbrjrestantValidetyp6').val();
        var valide = $('#valide').is(':checked');
        var id = $('#id_conge').val();
        $scope.param = {
            'valide': valide,
            'datefinvalide': datefinvalide,
            'datedebutvalide': datedebutvalide,
            'nbrjv': nbrjv,
            'nbrjrestant': nbrjrestant,
            'droit': droit,
            'id': id,
        };
        $http({
            url: domaineapp + 'suivipresence.php/conge/SavedocumentDemandeValidetype6',
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

    $scope.TesterAvancePret = function() {

        var id_type = $("#demandeavancepret_id_type").val();
        $scope.param = {
            "id_type": id_type,
        }

        $http({
            url: domaineapp + 'affairesociale.php/demandeavancepret/AfficheAvancePret',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert(data);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $("#demandeavancepret_id_type")
        .change(function() {
            if ($("#demandeavancepret_id_type").val() != "") {
                $scope.TesterAvancePret();
            }
        })
        .trigger("change");
});
app.controller('CtrlAffairesociale', function($scope, $http) {
    $scope.listesPrimes = [];
    $scope.ListePret = [];
    $scope.Listeavance = [];
    $scope.Liste = [];
    $scope.Listepaiement = [];
    $scope.length = 0;
    //calcul pourcentage du salaire net 
    $scope.CalculMontantaprespourcentage = function() {

        var netapayer = $("#retenuesursalaire_salairenetapayer").val();
        var pourcentage = $("#retenuesursalaire_pourcentagedesalaire").val();
        var montant_pourcentage = netapayer * pourcentage / 100;
        $('#retenuesursalaire_montantdupourcentage').val(parseFloat(montant_pourcentage).toFixed(3));
    }
    $("#retenuesursalaire_salairenetapayer")
        .change(function() {
            if ($("#retenuesursalaire_salairenetapayer").val() != "" && $("#retenuesursalaire_pourcentagedesalaire").val() != "") {
                $scope.CalculMontantaprespourcentage();
            } else {
                $("#retenuesursalaire_montantdupourcentage").val("");
            }
        })
        .trigger("change");
    $("#retenuesursalaire_pourcentagedesalaire")
        .change(function() {
            if ($("#retenuesursalaire_pourcentagedesalaire").val() != "" && $("#retenuesursalaire_salairenetapayer").val() != "") {
                $scope.CalculMontantaprespourcentage();
            } else {
                $("#retenuesursalaire_montantdupourcentage").val("");
            }
        })
        .trigger("change");
    $scope.InitialiserSociete = function() {
        var id = 1;
        $scope.param = {
            'id': id,
        };
        $http({
            url: domaineapp + 'affairesociale.php/demandepret/AfficeInfoSoc',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#demandepret_societe').val(data['rs']);
            $('#demandepret_numerodecnss').val(data['matfiscal']);
            $('#demandepret_id_validateur').val('756');
            $('#demandepret_id_validateur').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.AffciherLibellePret = function() {

        var source = $("#demandepret_id_sourcepret").val();
        $scope.param = {
            'source': source,
        };
        $http({
            url: domaineapp + 'affairesociale.php/demandepret/AfficeTypePret',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#typepret').removeClass("disabledbutton");
            $scope.ChargerCombo('#demandepret_id_typepret', data);
            if ($('#idtype_hidden').val() != '') {
                $('#demandepret_id_typepret').val($('#idtype_hidden').val());
                $('#demandepret_id_typepret').trigger("chosen:updated");
            }

        }, function myError(response) {
            alert(response);
        });
    }
    $("#demandepret_id_sourcepret")
        .change(function() {
            if ($("#demandepret_id_sourcepret").val() != "") {
                $scope.AffciherLibellePret();
            }
        })
        .trigger("change");
    //afficher fournisseur 
    $scope.AffciherFournisseur = function() {

        var naturepret = $("#retenuesursalaire_naturepret").val();
        $scope.param = {
            'naturepret': naturepret,
        };
        $http({
            url: domaineapp + 'affairesociale.php/retenuesursalaire/AfficeListeFournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if ($("#retenuesursalaire_naturepret").val() == 0) {
                $('#fournisseur').removeClass("disabledbutton");
                $scope.ChargerCombo('#retenuesursalaire_id_fournisseur', data);
                if ($('#id_fournisseur').val() != '') {
                    $('#retenuesursalaire_id_fournisseur').val($('#id_fournisseur').val());
                    $('#retenuesursalaire_id_fournisseur').trigger("chosen:updated");
                }
            } else {
                $('#retenuesursalaire_id_fournisseur').val("");
                //                $('#retenuesursalaire_id_fournisseur').trigger("chosen:updated");
                $('#retenuesursalaire_id_fournisseur').val('').trigger("liszt:updated");
                $('#retenuesursalaire_id_fournisseur').trigger("chosen:updated");
                $('#fournisseur').addClass("disabledbutton");
            }

        }, function myError(response) {
            alert(response);
        });
    }
    $("#retenuesursalaire_naturepret")
        .change(function() {
            if ($("#retenuesursalaire_naturepret").val() != "") {
                $scope.AffciherFournisseur();
            }
        })
        .trigger("change");
    $scope.ChargerCombo1 = function(id, data) {
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }

    }
    $scope.ChargerCombo = function(id, data) {
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

    $scope.TesterAvancePret = function() {

        var id_type = $("#demandeavancepret_id_type").val();
        if (id_type != "") {
            if (id_type == "3") {
                $('#avance').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#retenue').hide();
                $('#pret').hide();
            }
            if (id_type == "4") {
                $('#retenue').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#avance').hide();
                $('#pret').hide();
            }
            if (id_type == "5") {
                $('#pret').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#avance').hide();
                $('#retenue').hide();
            }
        }

    }
    $("#demandeavancepret_id_type")
        .change(function() {
            if ($("#demandeavancepret_id_type").val() != "") {
                $scope.TesterAvancePret();
            }
        })
        .trigger("change");
    //***demande specifique 

    $scope.TesterType = function() {
        var id_type = $("#type_paiement").val();
        if (id_type != "") {
            if (id_type == "1") {
                $('#agents_avance').fadeIn();
                $('#agents').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#agents_pret').hide();
                $('#agents_retenue').hide();
                $http({
                    url: domaineapp + 'affairesociale.php/historiqueretenue/AfficheDemandeAvance',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $scope.ChargerCombo('#agents_avance_paiement', data);
                    $('#agents_avance_paiement').val('');
                    $('#agents_avance_paiement').trigger("chosen:updated");
                }, function myError(response) {
                    alert(response);
                });
            }
            if (id_type == "2") {
                $('#agents_pret').fadeIn();
                $('#agents').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#agents_retenue').hide();
                $('#agents_avance').hide();
                $http({
                    url: domaineapp + 'affairesociale.php/historiqueretenue/AfficheDemandePret',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $scope.ChargerCombo('#agents_pret_paiement', data);
                    $('#agents_pret_paiement').val('');
                    $('#agents_pret_paiement').trigger("chosen:updated");
                }, function myError(response) {
                    alert(response);
                });
            }
            if (id_type == "3") {
                $('#agents_retenue').fadeIn();
                $('#agents').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#agents_avance').hide();
                $('#agents_pret').hide();
                $http({
                    url: domaineapp + 'affairesociale.php/historiqueretenue/AfficheDemandeRetenue',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    $scope.ChargerCombo('#agents_retenue_paiement', data);
                    $('#agents_retenue_paiement').val('');
                    $('#agents_retenue_paiement').trigger("chosen:updated");
                }, function myError(response) {
                    alert(response);
                });
            }
        }

    }
    $("#type_paiement")
        .change(function() {
            if ($("#type_paiement").val() != "0") {
                $scope.TesterType();
            } else {
                $("#agents_avance_paiement").val("");
                $('#agents_avance_paiement').trigger("chosen:updated");
                $("#agents_retenue_paiement").val("");
                $('#agents_retenue_paiement').trigger("chosen:updated");
                $("#agents_pret_paiement").val("");
                $('#agents_pret_paiement').trigger("chosen:updated");
                $("#agents_pret_paiement").val("");
                $("#agents_retenue_paiement").val("");
                $scope.Listepaiement.splice(0, $scope.Listepaiement.length);
                //                    $scope.$apply();
            }

        })
        .trigger("change");
    //******

    $scope.Affichedetaildemandeavance = function() {

        var demandeavance = $("#historiqueretenue_id_demandeavance").val();
        $scope.param = {
            'demandeavance': demandeavance,
        };
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/AfficehdetailDemandeAvance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#typeavance').val(data['typeavance']);
            $('#montanttotal').val(data['montanttotal']);
            $('#montantmensielle').val(data['montantmensielle']);
            $('#historiqueretenue_montantsoustre').val(data['montantmensielle']);
            $('#datedebutretenue').val(data['datedebutretenue']);
            $('#datefinretenue').val(data['datefinretenue']);
            $('#nbrmois').val(data['remboursement']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#historiqueretenue_id_demandeavance")
        .change(function() {
            if ($("#historiqueretenue_id_demandeavance").val() != "") {
                $scope.Affichedetaildemandeavance();
            } else {
                $('#typeavance').val("");
                $('#montanttotal').val("");
                $('#montantmensielle').val("");
                $('#datedebutretenue').val("");
                $('#datefinretenue').val("");
                $('#nbrmois').val("");
            }
        })
        .trigger("change");
    $scope.Affichedetaildemandepret = function() {

        var demandepret = $("#historiqueretenue_id_demandepret").val();
        $scope.param = {
            'demandepret': demandepret,
        };
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/AfficehdetailDemandePret',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#typeavance').val(data['typeavance'] + " " + data['source']);
            $('#montanttotal').val(data['montanttotal']);
            $('#montantmensielle').val(data['montantmensielle']);
            $('#historiqueretenue_montantsoustre').val(data['montantmensielle']);
            $('#datedebutretenue').val(data['datedebutretenue']);
            $('#datefinretenue').val(data['datefinretenue']);
            $('#nbrmois').val(data['nbrmois']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#historiqueretenue_id_demandepret")
        .change(function() {
            if ($("#historiqueretenue_id_demandepret").val() != "") {
                $scope.Affichedetaildemandepret();
            } else {
                $('#typeavance').val("");
                $('#montanttotal').val("");
                $('#montantmensielle').val("");
                $('#datedebutretenue').val("");
                $('#datefinretenue').val("");
                $('#nbrmois').val("");
            }
        })
        .trigger("change");
    $scope.Affichedetaildemanderetenuesursalaire = function() {

        var demanderetenue = $("#historiqueretenue_id_retenue").val();
        $scope.param = {
            'demanderetenue': demanderetenue,
        };
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/AfficehdetailDemandeRetenuesursalaire',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            if (data['naturepret'] != "0") {
                $('#typeavance').val(data['naturepret'] + " " + data['source']);
            } else
                $('#typeavance').val(data['source']);
            $('#montanttotal').val(data['montanttotal']);
            $('#montantmensielle').val(data['montantmensielle']);
            $('#historiqueretenue_montantsoustre').val(data['montantmensielle']);
            $('#datedebutretenue').val(data['datedebutretenue']);
            $('#datefinretenue').val(data['datefinretenue']);
            $('#nbrmois').val(data['nbrmois']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#historiqueretenue_id_retenue")
        .change(function() {
            if ($("#historiqueretenue_id_retenue").val() != "") {
                $scope.Affichedetaildemanderetenuesursalaire();
            } else {
                $('#typeavance').val("");
                $('#montanttotal').val("");
                $('#montantmensielle').val("");
                $('#datedebutretenue').val("");
                $('#datefinretenue').val("");
                $('#nbrmois').val("");
            }
        })
        .trigger("change");
    $scope.afficherdetailAvance = function() {

        var type_avance = $("#demandeavance_id_typeavance").val();
        $scope.param = {
            'type_avance': type_avance,
        };
        $http({
            url: domaineapp + 'affairesociale.php/demandeavancepret/AfficehdetailAvance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#detailavance').val(data['remboursement']);
            $scope.CalculMontantmensielle();
        }, function myError(response) {
            alert(response);
        });
    }

    $("#demandeavance_id_typeavance")
        .change(function() {
            if ($("#demandeavance_id_typeavance").val() != "") {
                $scope.afficherdetailAvance();
            } else {
                $('#detailavance').val("");
                $('#demandeavance_montanttotal').val("");
                $('#demandeavance_montantmensielle').val("");
            }
        })
        .trigger("change");
    //affiche detail agents 
    $scope.afficherdetailAgents = function() {

        var id_agents = $("#demandepret_id_agents").val();
        $scope.param = {
            'id_agents': id_agents,
        };
        $http({
            url: domaineapp + 'affairesociale.php/demandepret/AfficehdetailAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
            $('#nom').val(data['nom']);
            $('#prenom').val(data['prenom']);
            $('#adresse').val(data['adresse']);
            $('#codepostal').val(data['codepostal']);
            $('#email').val(data['mail']);
            $('#direction').val(data['direction']);
            $('#grade').val(data['grade']);
            $('#categorie').val(data['categorie']);
            $('#dateemposte').val(data['dateemposte']);
            $('#situation').val(data['situation']);
            $('#datetitulaire').val(data['datetitulaire']);
            $('#salaire').val(data['salaire']);
            $('#id_contrat').val(data['idcontrat']);
            $scope.AffichelistePrimes();
            $scope.AffichelistePret();
        }, function myError(response) {
            alert(response);
        });
    }

    $("#demandepret_id_agents")
        .change(function() {
            if ($("#demandepret_id_agents").val() != "0") {
                $scope.afficherdetailAgents();
            } else {
                $('#idrh').val("");
                $('#nom').val("");
                $('#prenom').val("");
                $('#adresse').val("");
                $('#codepostal').val("");
                $('#email').val("");
                $('#direction').val("");
                $('#grade').val("");
                $('#categorie').val("");
                $('#dateemposte').val("");
                $('#situation').val("");
                $('#datetitulaire').val("");
                $('#salaire').val("");
                $('#id_contrat').val("");
                $scope.listesPrimes = [];
                //                    $scope.$apply();
            }
        })
        .trigger("change");
    //affiche detail agnets pour la fiche de ratenue sur salaire
    $scope.afficherdetailAgentsPourFicheRetenue = function() {

        var id_agents = $("#retenuesursalaire_id_agents").val();
        $scope.param = {
            'id_agents': id_agents,
        };
        $http({
            url: domaineapp + 'affairesociale.php/retenuesursalaire/AfficehdetailAgentsPourRetenue',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
            $('#nom').val(data['nom']);
            $('#prenom').val(data['prenom']);
            $('#adresse').val(data['adresse']);
            $('#codepostal').val(data['codepostal']);
            $('#email').val(data['mail']);
        }, function myError(response) {
            alert(response);
        });
    }

    $("#retenuesursalaire_id_agents")
        .change(function() {
            if ($("#retenuesursalaire_id_agents").val() != "0") {
                $scope.afficherdetailAgentsPourFicheRetenue();
            } else {
                $('#idrh').val("");
                $('#nom').val("");
                $('#prenom').val("");
                $('#adresse').val("");
                $('#codepostal').val("");
                $('#email').val("");
            }
        })
        .trigger("change");
    $scope.AffichelistePrimes = function() {
        var iddoc = $("#id_contrat").val();
        var msalaire = $("#salaire").val();
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'affairesociale.php/demandepret/AffichelignePrimes',
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
            $('#demandepret_salairebrut').val(totalp.toFixed(3));
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AffichelistePret = function() {
        var iddoc = $("#demandepret_id_agents").val();
        $scope.param = {
            "id": iddoc
        }
        $http({
            url: domaineapp + 'affairesociale.php/demandepret/AffichelignePret',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ListePret = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.CalculMontantmensielle = function() {

        var montantatotla = $("#demandeavance_montanttotal").val();
        if ($("#detailavance").val() != "" && $("#demandeavance_montanttotal").val() != "") {
            var nbmois = $("#detailavance").val();
            var montant_mensielle = montantatotla / nbmois;
            $('#demandeavance_montantmensielle').val(parseFloat(montant_mensielle).toFixed(3));
        }

    }
    $("#demandeavance_montanttotal")
        .change(function() {
            if ($("#demandeavance_montanttotal").val() != "") {
                $scope.CalculMontantmensielle();
            }
        })
        .trigger("change");
    $scope.AjouterDemandeAvance = function() {
        var x = document.getElementById("demandeavance_id_agent");
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
        if ($("#demandeavance_id_typeavance").val() == "") {
            bootbox.dialog({
                message: "Veuilez Choisr Type avance !!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            return;
        }
        if ($("#demandeavance_montanttotal").val() == "") {
            bootbox.dialog({
                message: "Veuilez Saisi le montant davance !!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            return;
        }
        var typeavance = $("#demandeavance_id_typeavance").val();
        var montanttotal = $("#demandeavance_montanttotal").val();
        var montantensielle = $("#demandeavance_montantmensielle").val();
        var annee = $("#demandeavance_annee").val();
        var mois = $("#demandeavance_mois").val();
        var datedebut = $("#demandeavance_datedebutretenue").val();
        var datefin = $("#demandeavance_datefinretenue").val();
        $scope.param = {
            "typeavance": typeavance,
            "montanttotal": montanttotal,
            "montantensielle": montantensielle,
            "annee": annee,
            "mois": mois,
            "ids": ids,
            "datedebut": datedebut,
            "datefin": datefin,
        }
        $http({
            url: domaineapp + 'affairesociale.php/demandeavance/saveDemande',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#save_button').hide();
            var url = domaineapp + 'affairesociale.php/demandeavance/imprimerListeDemandeavance?ids=' + ids + '&annee=' + annee + '&typeavance=' + typeavance;
            $('#print_button').attr('href', url);
            $('#print_button').show();
            bootbox.dialog({
                message: "Ajout avec succes!!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            if (data != '<ul></ul>') {
                var message = "Les agents suivants ont déjà cette demande d'avance pour l'année : " + annee + " ";
                message = message + data;
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
            //            if (data != "" && data != "erreurr !!!")
            //                document.location.href = "edit?id=" + data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.CalculDateFinRetenue = function() {

        var datdebut = $("#demandeavance_datedebutretenue").val();
        var nbrmois = $("#detailavance").val();
        $scope.param = {
            'datdebut': datdebut,
            'nbrmois': nbrmois,
        };
        $http({
            url: domaineapp + 'affairesociale.php/demandeavance/Affichedatefin',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $("#demandeavance_datefinretenue").val(data);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#demandeavance_datedebutretenue")
        .change(function() {
            if ($("#demandeavance_datedebutretenue").val() != "") {
                $scope.CalculDateFinRetenue();
            }
        })
        .trigger("change");
    //modidier demande avance

    $scope.ModifierDemande = function(id, id_agents) {

        var typeavance = $("#demandeavance_id_typeavance").val();
        var montanttotal = $("#demandeavance_montanttotal").val();
        var montantensielle = $("#demandeavance_montantmensielle").val();
        var annee = $("#demandeavance_annee").val();
        var mois = $("#demandeavance_mois").val();
        var datedebut = $("#demandeavance_datedebutretenue").val();
        var datefin = $("#demandeavance_datefinretenue").val();
        $scope.param = {
            "typeavance": typeavance,
            "montanttotal": montanttotal,
            "montantensielle": montantensielle,
            "annee": annee,
            "mois": mois,
            "datedebut": datedebut,
            "datefin": datefin,
            "id": id,
            "id_agents": id_agents,
        }
        $http({
            url: domaineapp + 'affairesociale.php/demandeavance/editDemande',
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
            //            if (data != "" && data != "erreurr !!!")
            //                document.location.href = "edit?id=" + data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ModifierDemandepaiement = function(id) {
            var mois = $("#historiqueretenue_mois").val();
            var annee = $("#historiqueretenue_annee").val();
            if ($scope.liste.length > 0) {
                $scope.param = {
                    "id": id,
                    "mois": mois,
                    "annee": annee,
                    'liste': $scope.liste,
                }
            }
            $http({
                url: domaineapp + 'affairesociale.php/historiqueretenue/editDemandepaiement',
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
        }
        //difference des deux dates 
    $scope.ChargerNbredemois = function() {

        var datedebut = $('#demandepret_datedebutretenue').val();
        var datefin = $('#demandepret_datefinretenue').val();
        var montantpret = $('#demandepret_montantpret').val();
        var d1 = new Date(datedebut);
        var d2 = new Date(datefin)
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
            //        var anciente = "A : " + DateDiff.inYears(d1, d2) + " M : " + DateDiff.inMonths(d1, d2) + "  J : " + DateDiff.inDays(d1, d2);

        var nbrmois = DateDiff.inMonths(d1, d2) + 1;
        $('#demandepret_nbrmois').val(nbrmois);
        $('#demandepret_montantmentielle').val(parseFloat(montantpret / nbrmois).toFixed(3));
    }
    $("#demandepret_datedebutretenue")
        .change(function() {
            if ($("#demandepret_datedebutretenue").val() != "" && $("#demandepret_datefinretenue").val() != "") {
                $scope.ChargerNbredemois();
            }
        })
        .trigger("change");
    $("#demandepret_datefinretenue")
        .change(function() {
            if ($("#demandepret_datedebutretenue").val() != "" && $("#demandepret_datefinretenue").val() != "") {
                $scope.ChargerNbredemois();
            }
        })
        .trigger("change");
    $("#demandepret_montantpret")
        .change(function() {
            if ($("#demandepret_montantpret").val() != "" && $("#demandepret_datedebutretenue").val() != "" && $("#demandepret_datefinretenue").val() != "") {
                $scope.ChargerNbredemois();
            }
        })
        .trigger("change");
    //cahrger mois annee demande pret 
    $scope.chargermoisannee = function() {
        var date = new Date($("#demandepret_datedemande").val());
        var annee = date.getFullYear();
        var mois = date.getMonth() + 1;
        $("#demandepret_mois").val(mois);
        $("#demandepret_annee").val(annee);
    }
    $("#demandepret_datedemande")
        .change(function() {
            if ($("#demandepret_datedemande").val() != "") {
                $scope.chargermoisannee();
            }
        })
        .trigger("change");
    //retenue sur salaire 
    $scope.ChargerNbredemoisRetenue = function() {

        var datedebut = $('#retenuesursalaire_datedebut').val();
        var datefin = $('#retenuesursalaire_datefin').val();
        var montantpret = $('#retenuesursalaire_montantpret').val();
        var d1 = new Date(datedebut);
        var d2 = new Date(datefin)
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
        var nbrmois = DateDiff.inMonths(d1, d2) + 1;
        $('#retenuesursalaire_nbrmois').val(nbrmois);
        $('#retenuesursalaire_retenuesursalaire').val(parseFloat(montantpret / nbrmois).toFixed(3));
        $scope.test();
    }
    $("#retenuesursalaire_datedebut")
        .change(function() {
            if ($("#retenuesursalaire_datedebut").val() != "" && $("#retenuesursalaire_datefin").val() != "") {
                $scope.ChargerNbredemoisRetenue();
            } else {
                $('#retenuesursalaire_retenuesursalaire').val("");
            }
        })
        .trigger("change");
    $("#retenuesursalaire_datefin")
        .change(function() {
            if ($("#retenuesursalaire_datedebut").val() != "" && $("#retenuesursalaire_datefin").val() != "") {
                $scope.ChargerNbredemoisRetenue();
            } else {
                $('#retenuesursalaire_retenuesursalaire').val("");
            }
        })
        .trigger("change");
    $("#retenuesursalaire_montantpret")
        .change(function() {
            if ($("#retenuesursalaire_montantpret").val() != "" && $("#retenuesursalaire_datedebut").val() != "" && $("#retenuesursalaire_datefin").val() != "") {
                $scope.ChargerNbredemoisRetenue();
            } else {
                $('#retenuesursalaire_retenuesursalaire').val("");
            }
        })
        .trigger("change");
    $scope.test = function() {
            if ($('#retenuesursalaire_montantdupourcentage').val() <= $('#retenuesursalaire_retenuesursalaire').val()) {
                alert("Le montant du Retenue Mensuel dépasse le pourcetage du Montant Net à payer !")
            } else {
                alert("Je Peux valider la Demande  !!");
            }
        }
        //cahrger mois annee retenue sur salaire
    $scope.chargermoisanneeretenue = function() {
        var date = new Date($("#retenuesursalaire_datedemande").val());
        var annee = date.getFullYear();
        var mois = date.getMonth() + 1;
        $("#retenuesursalaire_mois").val(mois);
        $("#retenuesursalaire_annee").val(annee);
    }
    $("#retenuesursalaire_datedemande")
        .change(function() {
            if ($("#retenuesursalaire_datedemande").val() != "") {
                $scope.chargermoisanneeretenue();
            }
        })
        .trigger("change");
    $scope.initialisermois = function() {
        $("#retenuesursalaire_filters_mois").addClass("disabledbuton");
        $("#retenuesursalaire_filters_naturepret").addClass("disabledbuton");
    }
    $("#retenuesursalaire_filters_annee")
        .change(function() {
            if ($("#retenuesursalaire_filters_annee").val() != "0") {
                $('#td_mois').removeClass("disabledbutton");
            } else {
                $('#retenuesursalaire_filters_mois').val("");
                $('#retenuesursalaire_filters_mois').val('').trigger("liszt:updated");
                $('#retenuesursalaire_filters_mois').trigger("chosen:updated");
                $('#td_mois').addClass("disabledbutton");
            }
        })
        .trigger("change");
    //    $("#retenuesursalaire_filters_naturepret")
    //            .change(function () {
    //                if ($("#retenuesursalaire_filters_naturepret").val() == "0") {
    //                    $('#td_id_fournisseur').removeClass("disabledbutton");
    //                } else {
    //                    $('#retenuesursalaire_filters_id_fournisseur').val("");
    //                    $('#retenuesursalaire_filters_id_fournisseur').val('').trigger("liszt:updated");
    //                    $('#retenuesursalaire_filters_id_fournisseur').trigger("chosen:updated");
    //                    $('#td_id_fournisseur').addClass("disabledbutton");
    //                }
    //            })
    //            .trigger("change");


    $("#demandeavance_filters_annee")
        .change(function() {
            if ($("#demandeavance_filters_annee").val() != "0") {
                $('#td_mois').removeClass("disabledbutton");
            } else {
                $('#demandeavance_filters_mois').val("");
                $('#demandeavance_filters_mois').val('').trigger("liszt:updated");
                $('#demandeavance_filters_mois').trigger("chosen:updated");
                $('#td_mois').addClass("disabledbutton");
            }
        })
        .trigger("change");
    $("#demandepret_filters_annee")
        .change(function() {
            if ($("#demandepret_filters_annee").val() != "0") {
                $('#td_mois').removeClass("disabledbutton");
            } else {
                $('#demandepret_filters_mois').val("");
                $('#demandepret_filters_mois').val('').trigger("liszt:updated");
                $('#demandepret_filters_mois').trigger("chosen:updated");
                $('#td_mois').addClass("disabledbutton");
            }
        })
        .trigger("change");
    $("#historiqueretenue_filters_annee")
        .change(function() {
            if ($("#historiqueretenue_filters_annee").val() != "0") {
                $('#td_mois').removeClass("disabledbutton");
            } else {
                $('#historiqueretenue_filters_mois').val("");
                $('#historiqueretenue_filters_mois').val('').trigger("liszt:updated");
                $('#historiqueretenue_filters_mois').trigger("chosen:updated");
                $('#td_mois').addClass("disabledbutton");
            }
        })
        .trigger("change");
    //affichage liste des retnue


    $scope.Afficherdetaildemande = function() {

        var x = document.getElementById("historiqueretenue_id_demandeavance");
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
        $scope.param = {
            "ids": ids,
        }
        $http({
            url: domaineapp + 'affairesociale.php/demandeavance/affichedetaildemande',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.Listeavance = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.viderListeavance = function() {
        $scope.Listeavance = [];
        //        $scope.$apply();
    }

    $scope.chargeDemandeAvance = function() {

        var id_agents = $("#agents_avance_paiement").val();
        $scope.param = {
            "id_agents": id_agents,
        }
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/affichedetaildemandeAvance',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#avance', data);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $("#agents_avance_paiement")
        .change(function() {
            if ($("#agents_avance_paiement").val() != "") {
                $scope.chargeDemandeAvance();
            }
        })
        .trigger("change");
    $scope.chargeDetailDemandeAvance = function() {

        var id = $("#avance").val();
        var id_type = $("#type_paiement").val();
        $scope.param = {
            "id": id,
            "id_type": id_type,
        }

        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/affichedetaildemandeAvancePaiement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#id').val(data['id']);
            $('#type').val(data['typeavance']);
            $('#montant').val(data['montanttotal']);
            $('#nbrmois').val(data['nbrmois']);
            $('#montantdejapaye').val(data['montantdejapaye']);
            $('#montantmensuel').val(data['montantmensielle']);
            $('#datedebut').val(data['datedebutretenue']);
            $('#datefin').val(data['datefinretenue']);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $("#type_paiement") && $("#avance")
        .change(function() {
            if ($("#avance").val() != "0" && $("#type_paiement").val() != "0") {
                $scope.chargeDetailDemandeAvance();
            } else {
                $('#id').val("");
                $('#type').val("");
                $('#montant').val("");
                $('#nbrmois').val("");
                $('#montantdejapaye').val("");
                $('#montantmensuel').val("");
                $('#datedebut').val("");
                $('#datefin').val("");
            }
        })
        .trigger("change");
    $scope.chargeDemandePret = function() {

        var id_agents = $("#agents_pret_paiement").val();
        $scope.param = {
            "id_agents": id_agents,
        }
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/affichedetaildemandePret',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#avance', data);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $("#agents_pret_paiement")
        .change(function() {
            if ($("#agents_pret_paiement").val() != "") {
                $scope.chargeDemandePret();
            }
        })
        .trigger("change");
    $scope.chargeDemandeRetenue = function() {

        var id_agents = $("#agents_retenue_paiement").val();
        $scope.param = {
            "id_agents": id_agents,
        }
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/affichedetaildemandeRetenue',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#avance', data);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $("#agents_retenue_paiement")
        .change(function() {
            if ($("#agents_retenue_paiement").val() != "") {
                $scope.chargeDemandeRetenue();
            }
        })
        .trigger("change");
    $scope.chargeChargerNbrmoispaye = function() {
        if ($("#montantpaye").val() != "" && $("#montantmensuel").val() != "") {
            var montant = $("#montantpaye").val();
            var mmensuel = $("#montantmensuel").val();
            var nbrmois = 0;
            nbrmois = parseInt((parseFloat(montant) / parseFloat(mmensuel)));
            $('#nbrmoispaye').val(nbrmois);
            $scope.CalculTotal();
            $scope.CalculMontantRestant();
        } else if ($("#montantpaye").val() == "" && $("#montantmensuel").val() == "") {
            $("#nbrmoispaye").val("");
            $("#montantrestant").val("");
        }
    }


    $scope.cahrgerMontant = function() {
        if ($("#nbrmoispaye").val() != "" && $("#montantmensuel").val() != "") {
            var nbrmois = $("#nbrmoispaye").val();
            var mmensuel = $("#montantmensuel").val();
            var montant = 0;
            montant = parseInt((parseFloat(nbrmois) * parseFloat(mmensuel)));
            $('#montantpaye').val(montant);
            $scope.CalculTotal();
            $scope.CalculMontantRestant();
        } else {
            $("#montantpaye").val("");
            $("#montantrestant").val("");
        }
    }

    $scope.CalculMontantRestant = function() {

        var montantdejapaye = $("#montantdejapaye").val();
        var montantpaye = $("#montantpaye").val();
        var montant = $("#montant").val();
        var montantrestant = 0;
        montantrestant = parseInt(montant - (parseFloat(montantpaye) + parseFloat(montantdejapaye)));
        $('#montantrestant').val(montantrestant);
        if ($("#montantrestant").val() < "0") {
            bootbox.dialog({
                message: "le montant dépasse le total du prêt !!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
            montantrestant = parseFloat(montant) - parseFloat(montantpaye);
            $("#montantpaye").val('');
            $('#nbrmoispaye').val('');
            $("#montantrestant").val('');
        }
    }

    $scope.Afficherdetailpaiement = function(id, id_demandeavannce, id_demandepret, id_retenue) {
        $scope.param = {
            "id": id,
            "id_demandepret": id_demandepret,
            "id_retenue": id_retenue,
            "id_demandeavannce": id_demandeavannce,
        }
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/affichedetailpaiement',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.Liste = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.Afficherdetaildemandepret = function() {

        var x = document.getElementById("historiqueretenue_id_demandepret");
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
        $scope.param = {
            "ids": ids,
        }
        $http({
            url: domaineapp + 'affairesociale.php/demandepret/affichedetaildemande',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.Listeavance = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.Afficherdetaildemanderetenue = function() {

        var x = document.getElementById("historiqueretenue_id_retenue");
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
        $scope.param = {
            "ids": ids,
        }
        $http({
            url: domaineapp + 'affairesociale.php/retenuesursalaire/affichedetaildemande',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.Listeavance = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.DeleteLigneA = function(ligne) {
        var index = -1;
        var comArr = eval($scope.Listeavance);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].agents === ligne.agents) {
                index = i;
                break;
            }
        }
        $scope.Listeavance.splice(index, 1);
    }
    $scope.DeleteLigne = function(ligne, id) {
            var index = -1;
            var comArr = eval($scope.Liste);
            for (var i = 0; i < comArr.length; i++) {
                if (comArr[i].agents === ligne.agents) {
                    index = i;
                    break;
                }
            }
            $scope.Liste.splice(index, 1);
            $scope.param = {
                "id": id,
            };
            $http({
                url: domaineapp + 'affairesociale.php/historiqueretenue/deleteligne',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                alert("suppression avec succès !!");
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
        //ajouter paiement historique 
    $scope.savepaiement = function() {

        var type_avance_pret_retenue = $("#historiqueretenue_typeextraction").val();
        var mois = $("#historiqueretenue_mois").val();
        var annee = $("#historiqueretenue_annee").val();
        if ($("#historiqueretenue_typeextraction").val() == "2") {

            var x = document.getElementById("historiqueretenue_id_retenue");
            var ids = '';
            for (var i = 0; i < x.selectedOptions.length; i++) {
                ids = ids + x.selectedOptions[i].value + ',,';
            }
        }
        if ($("#historiqueretenue_typeextraction").val() == "1") {

            var x = document.getElementById("historiqueretenue_id_demandepret");
            var ids = '';
            for (var i = 0; i < x.selectedOptions.length; i++) {
                ids = ids + x.selectedOptions[i].value + ',,';
            }
        }
        if ($("#historiqueretenue_typeextraction").val() == "0") {

            var x = document.getElementById("historiqueretenue_id_demandeavance");
            var ids = '';
            for (var i = 0; i < x.selectedOptions.length; i++) {
                ids = ids + x.selectedOptions[i].value + ',,';
            }
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
        if ($scope.Listeavance.length > 0) {
            $scope.param = {
                "ids": ids,
                'Listeavance': $scope.Listeavance,
                "type": type_avance_pret_retenue,
                "mois": mois,
                "annee": annee,
            };
        }
        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/Savedocument',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert("ajout avec succe !!!!!!");
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //tester exeistance de ligne ajouté
    $scope.TesterExesitanceLigne = function() {
        var id = $("#id").val();
        var mois = $("#mois").val();
        var annee = $("#annee").val();
        var type_paiement = $("#type_paiement").val();
        $scope.param = {
            "id": id,
            "mois": mois,
            "annee": annee,
            "type_paiement": type_paiement,
        }

        $http({
            url: domaineapp + 'affairesociale.php/historiqueretenue/Testexistence ',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.length = data.length;
            if ($scope.length > 0) {
                bootbox.dialog({
                    message: "Cette Ligne est déja enregistrée !!!",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
                return;
            }

            var table_mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Nouvembre", "Décembre"];
            if ($('#nordre').val() == "") {
                var nordre = $scope.Listepaiement.length + 1;
                if ($('#avance').val() != "") {
                    $scope.Listepaiement.push({
                        'norgdre': nordre,
                        'mois': $('#mois').val(),
                        'mois_affiche': table_mois[parseInt($('#mois').val()) - 1],
                        'type': $('#type').val(),
                        'montant': $('#montant').val(),
                        'nbrmois': $('#nbrmois').val(),
                        'montantrestant': $('#montantrestant').val(),
                        'montantmensuel': $('#montantmensuel').val(),
                        'montantdejapaye': $('#montantdejapaye').val(),
                        'reference': $('#reference').val(),
                        'datedebut': $('#datedebut').val(),
                        'datefin': $('#datefin').val(),
                        'montantpaye': $('#montantpaye').val(),
                        'nbrmoispaye': $('#nbrmoispaye').val(),
                        'id': $('#avance').val(),
                        'avance': $('#avance option:selected').text(),
                        'annee': $('#annee').val(),
                        'daterecue': $('#daterecue').val(),
                    });
                }

                $scope.InaliserLigne();
            } else {
                var comArr = eval($scope.Listepaiement);
                for (var i = 0; i < comArr.length; i++) {

                    if (comArr[i].norgdre - $('#nordre').val().trim() === 0) {
                        comArr[i].mois = $('#mois').val();
                        comArr[i].mois_affiche = table_mois[parseInt($('#mois').val()) - 1];
                        comArr[i].type = $('#type').val();
                        comArr[i].montant = $('#montant').val();
                        comArr[i].nbrmois = $('#nbrmois').val();
                        comArr[i].montantrestant = $('#montantrestant').val();
                        comArr[i].montantmensuel = $('#montantmensuel').val();
                        comArr[i].montantdejapaye = $('#montantdejapaye').val();
                        comArr[i].reference = $('#reference').val();
                        comArr[i].datedebut = $('#datedebut').val();
                        comArr[i].datefin = $('#datefin').val();
                        comArr[i].id = $('#avance').val();
                        comArr[i].montantpaye = $('#montantpaye').val();
                        comArr[i].nbrmoispaye = $('#nbrmoispaye').val();
                        comArr[i].avance = $('#avance option:selected').text();
                        comArr[i].annee = $('#annee').val();
                        comArr[i].daterecue = $('#daterecue').val();
                        break;
                    }
                }
                $scope.InaliserLigne();
            }

            $scope.CalculTotal();
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //ajoutr ligne 
    $scope.AjouterLigne = function() {
            trouve = 0;
            if ($('#avance').val() != '' && $('#avance').val() != '0' && $('#avance').val() != null && $('#mois').val() != "" && $('#annee').val() != "" && $('#montantpaye').val() != "" && $('#nbrmoispaye').val() != "") {
                if ($('#nordre').val() == "") {
                    var comArr = eval($scope.Listepaiement);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].id == $('#avance').val()) {
                            bootbox.dialog({
                                message: "Cette Ligne existe déja au dessous !!!",
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

                    $scope.TesterExesitanceLigne();
                } else {

                    var comArr = eval($scope.Listepaiement);
                    for (var i = 0; i < comArr.length; i++) {
                        if (comArr[i].norgdre != $('#nordre').val().trim() && comArr[i].mois == $('#mois').val() && comArr[i].id == $('#avance').val()) {
                            bootbox.dialog({
                                message: "Cette Ligne existe déja !!!",
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

                    $scope.TesterExesitanceLigne();
                }
            } else {
                bootbox.dialog({
                    message: "Il faut choisir l'Agent (Demande), le Mois, l'année, le Nbre mois payé et/ou le montant payé !!",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        }
        //initialiser champs paiement
    $scope.InaliserLigne = function() {
            $('#nordre').val('');
            $('#mois').val('');
            $('#mois').trigger("chosen:updated");
            $('#montantrestant').val('');
            $('#mois_affiche').val('');
            $('#montantdejapaye').val('');
            $('#reference').val('');
            $('#annee').val('');
            $('#annee').trigger("chosen:updated");
            $('#type').val('');
            $('#montant').val('');
            $('#nbrmois').val('');
            $('#daterecue').val('');
            $('#montantpaye').val('');
            $('#nbrmoispaye').val('');
            $('#montantmensuel').val('');
            $('#datedebut').val('');
            $('#datefin').val('');
            $('#avance').val('');
            $('#avance').trigger("chosen:updated");
        }
        //MISAjour Formations
    $scope.MisAJour = function(ligne) {

            $('#nordre').val(ligne.norgdre);
            $('#mois').val(ligne.mois);
            $('#mois').trigger("chosen:updated");
            $('#montantrestant').val(ligne.mois_affiche);
            $('#mois_affiche').val(ligne.mois_affiche);
            $('#montantdejapaye').val(ligne.montantdejapaye);
            $('#type').val(ligne.type);
            $('#reference').val(ligne.reference);
            $('#daterecue').val(ligne.daterecue);
            $('#annee').val(ligne.annee);
            $('#annee').trigger("chosen:updated");
            $('#montant').val(ligne.montant);
            $('#nbrmois').val(ligne.nbrmois);
            $('#montantmensuel').val(ligne.montantmensuel);
            $('#datedebut').val(ligne.datedebut);
            $('#datefin').val(ligne.datefin);
            $('#nbrmoispaye').val(ligne.nbrmoispaye);
            $('#montantpaye').val(ligne.montantpaye);
            $('#avance').val(ligne.id);
            $('#avance').trigger("chosen:updated");
        }
        //Delete formations
    $scope.Delete = function(ligne) {
        var index = -1;
        var comArr = eval($scope.Listepaiement);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].norgdre === ligne.norgdre) {
                index = i;
                break;
            }
        }
        $scope.Listepaiement.splice(index, 1);
        $scope.inialiserTable();
        $scope.CalculTotal();
    }
    $scope.inialiserTable = function() {
        var arraytable = [];
        arraytable = $scope.Listepaiement;
        $scope.Listepaiement = [];
        for (var i = 0; i < arraytable.length; i++) {
            $scope.Listepaiement.push({
                'norgdre': i + 1,
                'type': arraytable[i].type,
                'mois': arraytable[i].mois,
                'mois_affiche': arraytable[i].mois_affiche,
                'annee': arraytable[i].annee,
                'montant': arraytable[i].montant,
                'reference': arraytable[i].reference,
                'daterecue': arraytable[i].daterecue,
                'montantrestant': arraytable[i].montantrestant,
                'montantdejapaye': arraytable[i].montantdejapaye,
                'montantmensuel': arraytable[i].montantmensuel,
                'datedebut': arraytable[i].datedebut,
                'montantpaye': arraytable[i].montantpaye,
                'nbrmois': arraytable[i].nbrmois,
                'nbrmoispaye': arraytable[i].nbrmoispaye,
                'datefin': arraytable[i].datefin,
                'avance': arraytable[i].avance,
                'id': arraytable[i].id

            });
        }

    }
    $scope.CalculTotal = function() {
            var comArr = eval($scope.Listepaiement);
            var total = 0;
            for (var i = 0; i < comArr.length; i++) {

                total = parseFloat(parseFloat(total) + parseFloat(comArr[i].montantpaye));
            }
            $('#montanttotal').val(parseFloat(total).toFixed(3));
        }
        //valideer ajout historique

    //valider ajout 
    $scope.validerAjout = function() {

        if ($scope.Listepaiement.length > 0) {
            $scope.document = {
                'Listepaiement': $scope.Listepaiement,
                'id_agents': $('#agents').val(),
                'type_paiement': $('#type_paiement').val(),
            };
            $http({
                url: domaineapp + 'affairesociale.php/historiqueretenue/Validerdemandespecifique',
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#button_save').hide();
                var url = domaineapp + 'affairesociale.php/historiqueretenue/imprimerListe?ids=' + data;
                $('#print_button').attr('href', url);
                $('#print_button').show();
                bootbox.dialog({
                    message: "Ajout avec succès !!!",
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

    $scope.intialisermoisannee = function() {
        var d1 = new Date();
        var mois = d1.getMonth() + 1;
        var annee = d1.getFullYear();
        $('#historiqueretenue_mois').val(mois);
        $('#historiqueretenue_annee').val(annee);
    }

    $scope.TesterAgentpersonnel = function() {

        var id_type = $("#tenues_personnel").val();
        if (id_type != "") {

            if (id_type == "0") {
                $('#agents').fadeIn();
                $('#list_agents').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#ouvrier').hide();
                $('#list_ouvrier').hide();
                $('#list_ouvrier').val("");
                $('#idrh').val("");
                $('#nom').val("");
                $('#poste').val("");
                $('#dateaffectation').val("");
            }
            if (id_type == "1") {
                $('#ouvrier').fadeIn();
                $('#list_ouvrier').fadeIn();
                $('.chosen-container').attr('style', 'width:100%');
                $('.chosen-container').trigger("chosen:updated");
                $('#agents').hide();
                $('#list_agents').val("");
                $('#list_agents').hide();
                $('#idrh').val("");
                $('#nom').val("");
                $('#poste').val("");
                $('#dateaffectation').val("");
            }

        }
    }

    $("#tenues_personnel")
        .change(function() {
            if ($("#tenues_personnel").val() != "") {
                $scope.TesterAgentpersonnel();
            } else {
                $('#agents').hide();
                $('#list_agents').hide();
                $('#tenues_id_agents').val('').trigger("liszt:updated");
                $('#tenues_id_agents').trigger("chosen:updated");
                $('#ouvrier').hide();
                $('#list_ouvrier').hide();
                $('#tenues_id_ouvrier').val('').trigger("liszt:updated");
                $('#tenues_id_ouvrier').trigger("chosen:updated");
                $('#idrh').val("");
                $('#nom').val("");
                $('#poste').val("");
                $('#dateaffectation').val("");
            }
        })
        .trigger("change");
    $scope.cahrgerdetailouvrier = function() {

        var id_ouvrier = $("#tenues_id_ouvrier").val();
        $scope.param = {
            'id_ouvrier': id_ouvrier,
        };
        $http({
            url: domaineapp + 'affairesociale.php/tenues/AfficehdetailOuvrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#idrh').val(data['idrh']);
            $('#nom').val(data['nomcomplet']);
            $('#poste').val(data['poste']);
            $('#dateaffectation').val(data['dateemposte']);
        }, function myError(response) {
            alert(response);
        });
    }

    $("#tenues_id_ouvrier")
        .change(function() {
            if ($("#tenues_id_ouvrier").val() != "") {
                $scope.cahrgerdetailouvrier();
            } else {
                $('#idrh').val("");
                $('#nom').val("");
                $('#poste').val("");
                $('#dateaffectation').val("");
            }
        })
        .trigger("change");
    $scope.afficherFichetenuedetailAgents = function() {
        var id_agents = $("#tenues_id_agents").val();
        $scope.param = {
            'id_agents': id_agents,
        };
        $http({
            url: domaineapp + 'affairesociale.php/tenues/AfficehdetailAgents',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#idrh').val(data.agents[0]['idrh']);
            $('#nom').val(data.agents[0]['nom']);
            $('#poste').val(data.contrat[0]['poste']);
            $('#dateemposte').val(data.contrat[0]['dateemposte']);
        }, function myError(response) {
            alert(response);
        });
    }
    $("#tenues_id_agents")
        .change(function() {
            if ($("#tenues_id_agents").val() != "") {
                $scope.afficherFichetenuedetailAgents();
            } else {
                $('#idrh').val("");
                $('#nom').val("");
                $('#poste').val("");
                $('#dateaffectation').val("");
            }
        })
        .trigger("change");
    //charger les tenues 
    $scope.ChargerDetailTenueParMission = function() {
        $('#typetenue').removeClass("disabledbutton")
        var id_mission = $('#tenues_id_typemission').val();
        $scope.param = {
            'id_mission': id_mission
        }
        $http({
            url: domaineapp + 'affairesociale.php/tenues/AfficehdetailTenues',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo1('#tenues_id_typetenue', data);
            //            $('#tenues_id_typetenue').val(data);
            //            $('#tenues_id_typetenue').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#tenues_id_typemission")
        .change(function() {
            if ($("#tenues_id_typemission").val() != "") {
                $scope.ChargerDetailTenueParMission();
            } else {
                $('#typetenue').addClass("disabledbutton")
                $('#tenues_id_typetenue').val("");
                $('#tenues_id_typetenue').trigger("chosen:updated");
            }
        })
        .trigger("change");
    $scope.ChargerDetailDestination = function() {
        var id_destination = $('#visitemedicale_id_destination').val();
        $scope.param = {
            'id_destination': id_destination
        }
        $http({
            url: domaineapp + 'affairesociale.php/visitemedicale/AfficehdetailDestination',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data[0];
            $('#visitemedicale_nbrjour').val(data['nbrjour']);
            if ($("#visitemedicale_dateretour").val() != "") {
                $scope.charegrDateDepart();
            }
            if ($("#visitemedicale_datedepart").val() != "") {
                $scope.charegrDate();
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $("#visitemedicale_id_destination")
        .change(function() {
            if ($("#visitemedicale_id_destination").val() != "") {
                $scope.ChargerDetailDestination();
            }
        })
        .trigger("change");
    $scope.charegrDate = function() {
        if ($('#visitemedicale_datedepart').val() != "") {
            data = $('#visitemedicale_datedepart').val();
            var nbrjour = $('#visitemedicale_nbrjour').val().trim();
            if (parseFloat(nbrjour) < 1) {
                nbrjour = 0;
            }
            //Debut : incrementer 1 jour à une date définie
            var mydate = new Date(data);
            mydate.setDate(mydate.getDate() + parseInt(nbrjour));
            var y = mydate.getFullYear(),
                m = mydate.getMonth() + 1, // january is month 0 in javascript
                d = mydate.getDate();
            var pad = function(val) {
                var str = val.toString();
                return (str.length < 2) ? "0" + str : str
            };
            data = [y, pad(m), pad(d)].join("-");
            //Fin : incrementer 1 jour à une date définie
            $('#visitemedicale_dateretour').val(data);
        }
    }
    $("#visitemedicale_datedepart")
        .change(function() {
            if ($("#visitemedicale_datedepart").val() != "" && $('#visitemedicale_nbrjour').val() != "") {
                $scope.charegrDate();
            }

        })
        .trigger("change");
    $scope.charegrDateDepart = function() {
        if ($('#visitemedicale_dateretour').val() != "") {
            data = $('#visitemedicale_dateretour').val();
            var nbrjour = $('#visitemedicale_nbrjour').val().trim();
            if (parseFloat(nbrjour) < 1) {
                nbrjour = 0;
            }
            //Debut : incrementer 1 jour à une date définie
            var mydate = new Date(data);
            mydate.setDate(mydate.getDate() - parseInt(nbrjour));
            var y = mydate.getFullYear(),
                m = mydate.getMonth() + 1, // january is month 0 in javascript
                d = mydate.getDate();
            var pad = function(val) {
                var str = val.toString();
                return (str.length < 2) ? "0" + str : str
            };
            data = [y, pad(m), pad(d)].join("-");
            //Fin : incrementer 1 jour à une date définie
            $('#visitemedicale_datedepart').val(data);
        }
    }

    $("#visitemedicale_dateretour")
        .change(function() {
            if ($("#visitemedicale_dateretour").val() != "" && $('#visitemedicale_nbrjour').val() != "") {
                $scope.charegrDateDepart();
            }

        })
        .trigger("change");
});