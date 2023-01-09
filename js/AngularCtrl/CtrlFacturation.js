
var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('CtrlFacturatioin', function ($scope, $compile, $http) {
   
    $scope.listes_operations = [];
    $scope.ViderLigne = function () {
        $('#idformulaire input:text').val('');
        $('#idformulaire input:hidden').val('');
        $('#valide_rrs_pvr').prop('checked', false);
        $('#pour').val('').trigger("liszt:updated");
        $('#pour').trigger("chosen:updated");
//        $('#lignemouvementfacturation_etatfrs').val('').trigger("liszt:updated");
//        $('#lignemouvementfacturation_etatfrs').trigger("chosen:updated");
    }
   $scope.PushNewLigne = function () {
        console.log(('push new'));
        var valide = "<span style='margin-left:20px;'>Veuillez saisir : </span><ul style='margin-left:160px;'>";
        if ($('#date').val() == '')
            valide += "<li> la date</li>";
        if ($('#numero_facture').val() == '')
            valide += "<li> le numéro de la facture</li>";
        if ($('#montant').val() == '')
            valide += "<li> le montant de la facture</li>";
        if ($('#documentachat').val() == '')
            valide += "<li> le B.C.E / B.D.C / Contrat</li>";
        if ($('#fournisseur_raison').val() == '')
            valide += "<li> le fournisseur</li>";
        valide += "</ul>";
        if (valide == "<span style='margin-left:20px;'>Veuillez saisir : </span><ul style='margin-left:160px;'></ul>") {
            if (parseFloat($('#montant').val()) == parseFloat($('#montant_documentachat').val())) {
                console.log(('result=mnt'));
                $scope.goPushLigne();
            } else {
                console.log(('result<>mnt'));
                bootbox.confirm({
                    message: "Le montant de la facture " + $('#numero_facture').val()
                            + " est différent au montant de la pièce "
                            + $('#documentachat').val() + ".<br>Voulez-vous continuer ?",
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
                            $scope.goPushLigne();
                        }
                    }
                });
            }
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

    $scope.goPushLigne = function () {
        console.log('de');
        var nbr = eval($('#current_operation').val()) + 1;
        $scope.listes_operations.push({
            'nb': nbr,
            'date_mouvement': $('#date_mouvement').val(),
            'numerofacture': $('#numero_facture').val(),
            'montant': $('#montant').val(),
            'documentachat': $('#documentachat').val(),
            'id_documentachat': $('#id_documentachat').val(),
            'date_documentachat': $('#date_documentachat').val(),
            'rrs': $('#rrs').val(),
            'pvr': $('#pvr').val(),
            'date_rrs_pvr': $('#date_rrs_pvr').val(),
            'fournisseur_raison': $('#fournisseur_raison').val(),
            'id_fournisseur': $('#id_fournisseur').val(),
            'valide': $('#valide_rrs_pvr').is(':checked'),
            'taux_pourcentage': $('#pour').val(),
            'etat_frs': $('#lignemouvementfacturation_etatfrs').val()
        });
        console.log('aa');
        //        $('#pour').val('').trigger("liszt:updated");
        //        $('#pour').trigger("chosen:updated");

        $('#current_operation').val(nbr);
        $scope.ViderLigne();
        $scope.$apply();
        //console.log('nn');
    }

    $scope.Supprimer = function (nb) {
        var index = -1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            console.log(parseFloat(comArr[i].nb) + '-' + parseFloat(nb));
            if (parseFloat(comArr[i].nb) - parseFloat(nb) === 0) {
                index = i;
                break;
            }
        }

        $scope.listes_operations.splice(index, 1);
        var nbr = eval($('#current_operation').val()) - 1;
        $('#current_operation').val(nbr);
        $scope.OrganiserTable();
    }

    $scope.OrganiserTable = function () {
        var ligne = eval($('#last_operation').val()) + 1;
        var comArr = eval($scope.listes_operations);
        for (var i = 0; i < comArr.length; i++) {
            comArr[i].nb = ligne;
            ligne++;
        }
    }

    $scope.AfficheFournisseur = function (raison, id) {
        $scope.param = {
            'frs': $(raison).val(),
            'ref': ''
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/Listefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.fournisseurs1 = data;
            AjoutHtmlAfterRaisonNoCode(data, raison, id);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheFournisseurMvt = function (rs, id) {

        var raison = $(rs).val();

        $scope.param = {
            'frs': raison,
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/ListefournisseurMvt',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            //            $scope.fournisseurs1 = data;
            AjoutHtmlAfterRaisonBDCG(data, raison, id);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.AfficheDocAchat = function (numero, id, date, montant) {
        $(id).val('');
        $(date).val('');
        $(montant).val('');

        $scope.param = {
            'numero': $(numero).val()
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/ListeDocAchat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            AjoutHtmlAfterForDocAchat(data, numero, id, date, montant);
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheDocAchatFournisseurContrat = function (numero, id, date, montant, id_frs, libelle_frs, id_ligne) {
        $(id).val('');
        $(date).val('');
        $(montant).val('');

        if ($(numero).val() == '')
            $(libelle_frs).removeAttr('readonly');

        $scope.param = {
            'numero': $(numero).val()
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/ListeDocAchatContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            html = AjoutHtmlAfterForDocAchatContrat(data, numero, id, date, montant, id_frs, libelle_frs, id_ligne);
            $(numero).after($compile(html)($scope));
            //            if ($("#id_ligne").val().trim() != '') {
            //     $scope.AfficherlesTauxpourcentage();
            //            }
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.AfficheDocAchatFournisseur = function (numero, id, date, montant, id_frs, libelle_frs) {
        $(id).val('');
        $(date).val('');
        $(montant).val('');

        if ($(numero).val() == '')
            $(libelle_frs).removeAttr('readonly');

        $scope.param = {
            'numero': $(numero).val()
        }
        $http({
            url: domaineapp + '/facturation.php/documentachat/ListeDocAchat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfterForDocAchatFournisseur(data, numero, id, date, montant, id_frs, libelle_frs);

        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    $scope.getLastOrder = function () {
        if ($('#date_mouvement').val() != '') {
            $scope.param = {
                'date': $('#date_mouvement').val()
            }
            $http({
                url: domaineapp + '/facturation.php/lignemouvementfacturation/getLastOrder',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                if (data.length != 0) {
                    $('#show_last_operation').html(data[0].ordre);
                    $('#last_operation').val(data[0].ordre);
                    $('#current_operation').val(data[0].ordre);
                } else {
                    $('#show_last_operation').html('-');
                    $('#last_operation').val(0);
                    $('#current_operation').val(0);
                }
                //                afficher();
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        }
    }

    $scope.SaveOperations = function () {
        if ($scope.listes_operations.length > 0) {
            $scope.param = {
                'operations': $scope.listes_operations
            }
            $http({
                url: domaineapp + 'facturation.php/lignemouvementfacturation/Savemouvement',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.ViderLigne();
                var comArr = eval($scope.listes_operations);
                $scope.listes_operations.splice(0, comArr.length);
                $scope.getLastOrder;
                afficher();

            }, function myError(response) {
                console.log(response);
            });
        } else {
            bootbox.dialog({
                message: "<span style='font-size:18px;color:#d80700;'>Attention !</span><br><span style='font-size:14px;'>Veuillez ajouter au moins une ligne !</span>",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
    }
    //


    $scope.AfficherlesTauxpourcentage = function (id_ligne, id) {
        // alert('rf');
        console.log('id=' + id_ligne);
        if (id_ligne != '' && id) {
            $scope.param = {
                'id_ligne': id_ligne,
                'id_documentachat': id
            }
            $http({
                url: domaineapp + '/facturation.php/documentachat/ListeLigneDocAchatContrat',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                //            alert(data);
                $scope.ChargerCombo('#pour', data);

            }, function myError(response) {
                console.log("Erreur ");
            });
        } else {
            $('#pour').val('').trigger("liszt:updated");
            $('#pour').trigger("chosen:updated");
        }

    }
    $("#documentachat") && $("#id_ligne")
            .change(function () {
                if ($("#documentachat").val() != "" && $("#id_ligne").val() != '') {
                    $scope.AfficherlesTauxpourcentage();
                }
            })
            .trigger("change");

    $scope.CalculMontantMouvement = function () {
        var val_pourcentage = parseFloat($('#pour').val());
        var mnt_contrat = parseFloat($("#montant_documentachat_contrat").val());
        var mnt_mouvement = parseFloat((mnt_contrat * val_pourcentage) / 100);
        $('#montant_documentachat').val(parseFloat(mnt_mouvement).toFixed(3));
    }
    $("#pour")
            .change(function () {
                if ($('#pour').val() != "" && $("#montant_documentachat_contrat").val() != "") {
                    $scope.CalculMontantMouvement();
                }
            })
            .trigger("change");
    $scope.ChargerCombo = function (id, data) {
        //        alert(data);
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].taux + "'>" + data[i].libelle + '  ' + data[i].taux + ' %' + "</option>");
        }
        //        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

});