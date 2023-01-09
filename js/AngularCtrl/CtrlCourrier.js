var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('CtrlCourrier', function ($scope, $http) {
    $scope.objet = {text: ""};
    $scope.sujet = {text: ""};
    $scope.type = '';
    $scope.InitCourrier = function () {

        $('#courrier_id_user').addClass(" disabledbutton");
        $('#courrier_id_bureaux').addClass(" disabledbutton");
        $('#courrier_id_type').attr("class", "form-control disabledbutton");
        var idtype = $('#typecourrier').val();
        $('#courrier_id_type').val(idtype);

        //        $("#courrier_id_type").selectpicker("refresh");
        //courrier_id_courrier
        //        var idparent = $('#idcourrierParent').val();
        $scope.ListeTypePiece('Listetypepiece');
        $scope.FixerValeur('Codebureaux');
        //        if (idparent != "") {
        //            $('#courrier_id_courrier').val(idparent);
        //            $('#courrier_id_courrier').attr("class", "form-control disabledbutton");
        //            $("#courrier_id_courrier").selectpicker("refresh");
        //        }
        $('#courrier_id_user').attr("class", "form-control disabledbutton");
        $('#courrier_id_bureaux').attr("class", "form-control disabledbutton");
        $('#courrier_id_type').attr("class", "form-control disabledbutton");

    }
    $scope.ListeTypePiece = function (url) {


        $http({
            url: url,
            method: "GET"

        }).then(function mySucces(response) {
            data = response.data;
            $scope.listestypepieces = data;
        }, function myError(response) {
            console.log(response);
        });

    }
    $scope.AjoutPieceJoint = function (url) {
        $scope.piecejoint = {
            'object': $scope.objet.text,
            'sujet': $scope.sujet.text,
            'type': $scope.type
        }
        $http({
            url: url,
            method: "POST",
            data: $scope.piecejoint,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            var select = document.getElementById("courrier_id_piece");
            var newOption = new Option(data[data.length - 1].piece, data[data.length - 1].id);
            select.options.add(newOption);
            select.options[select.options.length - 1].selected = "selected";
            $("#courrier_id_piece").val(data[data.length - 1].id);
            //  $('#courrier_id_piece').selectpicker('render');
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.FixerValeur = function (url) {

        if ($('#objet').val() == "0") {
            var iduser = $('#iduser').val();
            $('#courrier_id_user').val(iduser);

            $http({
                url: url + "/user/" + iduser,
                method: "GET",
                data: iduser,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                var idbureau = parseInt(data[0].id);
                $('#courrier_id_bureaux').val(idbureau);
                //                $("#courrier_id_bureaux").selectpicker("refresh");
                $('#courrier_id_bureaux').trigger("chosen:updated");
                $('#courrier_id_bureaux').addClass('disabledbutton');
            }, function myError(response) {
                console.log(response);
            });
        }
        //courrier_id_type

    }
    //______________________________________________Affcetation note sur le courrier
    $scope.AffecterNoteCourrier = function (idnote, idcourrier) {
        var id1 = $('#id_note' + idnote + ':checked').length;
        $('.list_checbox[type=checkbox]').each(function () {
            $('input:checkbox').prop("checked", false);
        });
        $scope.param = {
            'idnote': idnote,
            'idc': idcourrier,
            'etat': id1
        }
        $http({
            url: '../Affectationnote',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#id_note' + idnote).prop("checked", true);
            //            alert(data);
            $('#courrier_id_famille').val(idnote);
            $("#courrier_id_famille").selectpicker("refresh");


        }, function myError(response) {
            console.log(response);
        });

    }
    //___________ function numero courrier js
    $scope.NumeroCourrier = function () {
        var id_type = $('#typecourrier').val();
        $http({
            url: "Numerocourrier?idtype=" + id_type,
            method: "GET",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#courrier_numero').val(data[0].numero);

        }, function myError(response) {
            console.log(response);
        });
    }
    //____________________Charger données de base courrier
    $scope.ChargerDossier = function () {
        $('#dbase').attr('class', 'tab-pane fade active in');
        $('#dged').attr('class', 'tab-pane fade');
        $('#dtransfert').attr('class', 'tab-pane fade');
    }
    //____________________charger formulaire parcour
    $scope.ChargerParcour = function (idtype, idcourrier) {
        $('#parcourcourier_id_courier').val(idcourrier);
        $('#parcourcourier_id_courier').attr('class', 'form-control disabledbutton');
        $("#parcourcourier_id_courier").selectpicker("refresh");
        $http({
            url: 'Responsable',
            method: "GET",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (idtype == 1 || idtype == 3) {
                $('#parcourcourier_id_rec').val(data);
                $('#parcourcourier_id_rec').attr('class', 'form-control disabledbutton');
                $("#parcourcourier_id_rec").selectpicker("refresh");
            }
            if (idtype == 2 || idtype == 4) {
                $('#parcourcourier_id_exp').val(data);
                $('#parcourcourier_id_exp').attr('class', 'form-control disabledbutton');
                $("#parcourcourier_id_exp").selectpicker("refresh");
            }

        }, function myError(response) {
            console.log(response);
        });
        $('#dbase').attr('class', 'tab-pane fade');
        $('#dged').attr('class', 'tab-pane fade');
        $('#dtransfert').attr('class', 'tab-pane fade active in');
    }

    //____________________Charger Document scanner ou document pdf pour courrier
    $scope.ChargerDocument = function (idcourrier) {
        $('#piecejoint_id_courrier').val(idcourrier);
        $('#piecejoint_id_courrier').attr('class', 'form-control disabledbutton');
        $("#piecejoint_id_courrier").selectpicker("refresh");
        $('#dbase').attr('class', 'tab-pane fade');
        $('#dtransfert').attr('class', 'tab-pane fade');
        $('#dged').attr('class', 'tab-pane fade active in');
    }
    $scope.InitCourrier();


    //___________________________________Ajouter Expediteur rapide
    $scope.AjouterExpediteur = function (idtype, type) {
        $scope.param = {
            'idagent': $('#expdest_id_agent').val(),
            'idfamille': $('#expdest_id_famille').val(),
            'idtypeexp': $('#expdest_id_type').val(),
            'npresponsable': $('#expdest_npresponsable').val(),
            'idfrs': $('#expdest_id_frs').val()

        }
        $http({
            url: domaineapp + 'bureauxdordre.php/expdest/Ajouterexpediteur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data == '0')
                alert("Erreur! Il faut remplir tous les champs");
            else {
                $scope.AjouterParameterExp(data, idtype, type);
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.AjouterParameterExp = function (idexp, idtype, type) {
        $scope.param = {
            'idexp': idexp,
            'idtype': idtype,
            'type': type
        }
        $http({
            url: domaineapp + 'bureauxdordre.php/expdest/Ajouterexp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            lenght = data.length - 1;
            if (type == "reception") {
                $('#courrier_expdest').append("<option value='" + data[lenght].id + "'>" + data[lenght].libelle + "</option>");
                $('#courrier_expdest').val(data[lenght].id);
                $('#courrier_expdest').trigger("chosen:updated");
            } else {
                $('#exp').append("<option value='" + data[lenght].id + "'>" + data[lenght].libelle + "</option>");
                $('#exp').val(data[lenght].id);
                $('#exp').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.AfficheExpediteur = function () {
        $('#expdest_id_type_chosen').attr('style', 'width: 100%');
        $('#expdest_id_famille_chosen').attr('style', 'width: 100%');
        $('#expdest_id_frs_chosen').attr('style', 'width: 100%');
        $('#expdest_id_agent_chosen').attr('style', 'width: 100%');
        $('#dynamic-table').DataTable();

    }

    $scope.ajouterTypeCourrier = function () {
        if ($('#typeparamcourrier_libelle').val() != '') {
            $scope.param = {
                'libelle': $('#typeparamcourrier_libelle').val()
            }
            $http({
                url: domaineapp + 'bureauxdordre.php/typeparamcourrier/ajouterTypeCourrier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#typeparamcourrier_libelle').val('');
                $scope.ChargerCombo("#courrier_id_typeparamcourrier", data);
            }, function myError(response) {
                console.log(response);
            });
        } else {
            alert("Erreur! Il faut saisir le libelle !");
        }
    }

    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

});
app.controller('CtrlTransfer', function ($scope, $http) {

    $scope.InialiserComboTransfert = function () {
        $('#exp_chosen').attr('style', 'width:100%');
        $('#exp').trigger("chosen:updated");
    }
    $scope.saveDocumentPvReception = function () {
        var count_selected = $('#exp option:selected').length;
        var id_dest = $('#exp').val();
        var mode_dest = "";
        $('#exp option:selected').each(function () {
            if ($(this).val() != 0) {
                mode_dest = mode_dest + $(this).attr('mode') + ",";
            }
        });
        var mode_dest = mode_dest.substr(0, mode_dest.length - 1);
        if (id_dest == '' || id_dest == 0) {
            bootbox.dialog({
                message: "Veuilez Choisr un ou plusieurs Utilisateurs !!",
                buttons: {
                    "button": {
                        "label": "Ok",
                        "className": "btn-sm"
                    }
                }
            });
        }
        var date = $('#pvrception_datepvrecptionprovisoire').val();
        var observation = $('#pvrception_observation').val();
        var type = $('#type').val();
        var id_lot = $('#id_lot').val();
        var id = $('#id').val();
        $scope.param = {
            'date': date,
            'observation': observation,
            'type': type,
            'id_lot': id_lot,
            'id': id,
            'id_dest': id_dest,
            'mode_dest': mode_dest,
        }
        $http({
            url: domaineapp + 'marchee.php/pvrception/SavedocumentPvreception',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
//            bootbox.dialog({
//                message: "mise à jour  avec succes!!",
//                buttons: {
//                    "button": {
//                        "label": "Ok",
//                        "className": "btn-sm"
//                    }
//                }
//            });

             document.location.href = domaineapp + "marchee.php/pvrception/" + data + "/edit";
        }, function myError(response) {
            alert(response);
        });

    }
    $scope.AfficheDoc = function (iddoc) {
        $scope.param = {
            'iddoc': iddoc,
        }
        $http({
            url: domaineapp + 'marchee.php/pvrception/Listepvreception',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.docPv = data;
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }
    $scope.ChargerTransfere = function (idcourrier) {

        $scope.param = {
            'idcourrier': idcourrier,
        }
        $http({
            url: domaineapp + 'bureauxdordre.php/courrier/ChargerTransfercourrier',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listestransfer = data;
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.Transfere = function (idcourrier) {
        var count_selected = $('#exp option:selected').length;
        var valide = "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'>";
        if (count_selected == 0 && !$("#qte_personnes").is(':checked'))
            valide += "<li> La (ou bien les) destination du transfert</li>";
        if ($('#action').val() == '0')
            valide += "<li> l'action pour le transfert</li>";
        valide += "</ul>";

        if (valide == "<span style='margin-left:20px;'>Veuillez choisir : </span><ul style='margin-left:160px;'></ul>") {
            var datemax = "00";

            if (!$("#qte_personnes").is(':checked')) {
                var id_dest = $('#exp').val();
                var mode_dest = "";
                $('#exp option:selected').each(function () {
                    if ($(this).val() != 0) {
                        mode_dest = mode_dest + $(this).attr('mode') + ",";
                    }
                });
                var mode_dest = mode_dest.substr(0, mode_dest.length - 1);
            } else {
                var id_dest = "";
                var mode_dest = "";
                $('#exp option').each(function () {
                    if ($(this).val() != 0) {
                        id_dest = id_dest + $(this).val() + ",";
                        mode_dest = mode_dest + $(this).attr('mode') + ",";
                    }
                });
                var id_dest = id_dest.substr(0, id_dest.length - 1);
                var mode_dest = mode_dest.substr(0, mode_dest.length - 1);
            }

            if ($('#datemax').val())
                datemax = $('#datemax').val();

            $scope.param = {
                'idcourrier': idcourrier,
                'id_dest': id_dest,
                'mode_dest': mode_dest,
                'count_selected': count_selected,
                'id_action': $('#action').val(),
                'datemax': datemax
            }
            $http({
                url: domaineapp + 'bureauxdordre.php/courrier/Transfercourrier',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.listestransfer = data;
            }, function myError(response) {
                console.log(response);
            });
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
    $scope.ValiderAttachementDocument = function (idcourrier) {
        var file_data = document.getElementById('piecejoint_chemin');
        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        form_data.append('idcourrier', idcourrier);
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


    $scope.ValiderAttachementDocumentPvReception = function (idpvreception) {
        console.log('id=' + idpvreception);
        var file_data = document.getElementById('piecejoint_chemin');
        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        form_data.append('id', idpvreception);
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
    $scope.AjouterExpediteur = function (idtype, type) {
        $scope.param = {
            'idagent': $('#expdest_id_agent').val(),
            'idfamille': $('#expdest_id_famille').val(),
            'idtypeexp': $('#expdest_id_type').val(),
            'npresponsable': $('#expdest_npresponsable').val(),
            'idfrs': $('#expdest_id_frs').val()
        }
        $http({
            url: domaineapp + 'bureauxdordre.php/expdest/Ajouterexpediteur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data == '0')
                alert("Erreur! Il faut remplir tous les champs");
            else {
                $scope.AjouterParameterExp(data, idtype, type);
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    $scope.AjouterParameterExp = function (idexp, idtype, type, mode) {
        //        if ($('#check_' + idexp).prop("checked", true)){ 
        $scope.param = {
            'idexp': idexp,
            'idtype': idtype,
            'type': type,
            'mode': mode
        }
        $http({
            url: domaineapp + 'bureauxdordre.php/expdest/Ajouterexp',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            lenght = data.length - 1;
            if (mode == '0') {
                $('#courrier_expdest').append("<option value='" + data[lenght].id + "' + mode='0'>" + data[lenght].libelle + "</option>");
                $('#courrier_expdest').val(data[lenght].id);
                $('#courrier_expdest').trigger("chosen:updated");
                $('#exp').append("<option value='" + data[lenght].id + "' + mode='0'>" + data[lenght].libelle + "</option>");
                $('#exp').val(data[lenght].id);
                $('#exp').trigger("chosen:updated");
            } else {
                $('#courrier_expdest').val(data[lenght].id);
                $('#courrier_expdest').trigger("chosen:updated");
                $('#exp').val(data[lenght].id);
                $('#exp').trigger("chosen:updated");
            }
        }, function myError(response) {
            console.log(response);
        });
    }
    //}
    $scope.AfficheExpediteur = function () {
        $('#expdest_id_type_chosen').attr('style', 'width: 100%');
        $('#expdest_id_famille_chosen').attr('style', 'width: 100%');
        $('#expdest_id_frs_chosen').attr('style', 'width: 100%');
        $('#expdest_id_agent_chosen').attr('style', 'width: 100%');
        $('#dynamic-table').DataTable();
    }

    $scope.setAffichageEnvoyerA = function () {
        if ($("#qte_personnes").is(':checked')) {
            $("#exp").val('');
            $('#exp').trigger("chosen:updated");
            $('#zone_envoyer_a').addClass('disabledbutton');
        } else {
            $('#zone_envoyer_a').removeClass('disabledbutton');
        }
    }
});
app.controller('CtrlMgs', function ($scope, $http) {

    $scope.ReflichisementDesCourrier = function () {
        $http({
            url: domaineapp + 'bureauxdordre.php/courrier/Reflichisement',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.LCNL = data;
            $scope.countcourrier = data.length;
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.ReflichisementDesCourrierUrgent = function () {
        $http({
            url: domaineapp + 'bureauxdordre.php/courrier/ReflichisementUrgent',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.LCNLUrgent = data;
            $scope.countcourrierurgent = data.length;
        }, function myError(response) {
            console.log(response);
        });
    }

});
app.controller('CtrlCourrierFilter', function ($scope, $http) {
    $scope.InaliserFilter = function () {
        var idtype = $('#idtype').val();
        if (idtype != "") {
            $('#courrier_filters_id_type').val(idtype);
            $('#courrier_filters_id_type').trigger("chosen:updated");
            $('#courrier_filters_id_type').parent().addClass("disabledbutton");
        }
    }
    $scope.InaliserFilter();
});