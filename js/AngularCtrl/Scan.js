//var app = angular.module('appbo', []);

var domaineapp = "http://" + window.location.hostname + "/";
app.controller('CtrlScan', function ($scope, $http) {

    $scope.ListesDesCheques = [];
    $scope.CourriersArrives = [];
    $scope.CourriersDeparts = [];
    $scope.chainedoc = "";
    $scope.idCS = ""; // id de courrier selectionnez
     $scope.ValiderAttachementDocumentTransfert = function (idtransfert, titre) {console.log('de');
          var file_data = document.getElementById('piecejoint_chemin');
          var form_data = new FormData();
          form_data.append('fileSelected', file_data.files[0]);
          form_data.append('id', idtransfert);
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
  
    $scope.ScanDoc = function (url) {

        $http({
            url: url,
            method: "GET"

        }).then(function mySucces(response) {

            if (!response.data) {
                $scope.ScanDoc2(url);
            }
        }, function myError(response) {
            // alert(response);
            //$scope.ScanDoc2(url);
        });

    }
    $scope.ScanDoc2 = function (url) {
        //alert(url+"?id=1");

        $http({
            url: url + "?id=1",
            method: "GET"

        }).then(function mySucces(response) {
            data = response.data[0];

            document.getElementById("imgmodel").innerHTML = '<img src="' + domaineapp + '/uploads/scanner/' + data.chaine + '" style="width: 100%;height: 100%;"> ';
            $scope.chainedoc = data.chaine;

            // alert(document.getElementById("imgmodel").innerHTML);
        }, function myError(response) {
            alert(response);
        });

    }
    $scope.CourrierArrive = function (url, user) {

        if ($scope.ch_coa == 1 && $scope.CourriersArrives.length <= 0) {

            $http({
                url: url + '/user/' + user,
                method: "GET"

            }).then(function mySucces(response) {
                data = response.data;
                $scope.CourriersArrives = data;

                for (i = 0; i < data.length; i++) {


                    $("#sltca").append('<option value="' + data[i].id + '" selected="">' + data[i].object + '</option>');

                }
                $("#sltca").append('<option value="' + 0 + '" selected="">Sélectionnez</option>');
                // $("#sltca").selectpicker("refresh");
            }, function myError(response) {
                alert(response);
            });
        }

    }
    $scope.CourrierDepart = function (url, user) {

        if ($scope.ch_com == 2 && $scope.CourriersDeparts.length <= 0) {

            $http({
                url: url + '/user/' + user,
                method: "GET"

            }).then(function mySucces(response) {
                data = response.data;
                $scope.CourriersDeparts = data;

                for (i = 0; i < data.length; i++) {


                    $("#sltcd").append('<option value="' + data[data.length - 1].id + '" selected="">' + data[data.length - 1].object + '</option>');
                    //$("#sltcd").selectpicker("refresh");
                }
                $("#sltcd").append('<option value="' + 0 + '" selected="">Sélectionnez</option>');
                //  $("#sltcd").selectpicker("refresh");
            }, function myError(response) {
                alert(response);
            });
        }
    }
    $scope.ValiderAttachement = function (url, id) {
        alert('dsssv');
        if (id == '0' && $scope.idCS != "") {
            id = $scope.idCS;
        }
        ;

        //  if (id != 0 && $scope.chainedoc != "") {
        $scope.document = {
            'idcourrier': id,
            'chaine': $scope.chainedoc
        };

        $http({
            url: url,
            method: "POST",
            data: $scope.document,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            //document.location.href = 'piecejoint/' + data[data.length - 1].id + '/edit';
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.ValiderAttachementBudget = function (url, id) {
        if (id == '0' && $scope.idCS != "") {
            id = $scope.idCS;
        }

        if (id != 0 && $scope.chainedoc != "") {
            $scope.document = {
                'idbudget': id,
                'chaine': $scope.chainedoc
            };

            $http({
                url: url,
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                alert('Votre piéce a été ajoutée avec succès');
                window.location.reload()
                //document.location.href = 'piecejoint/' + data[data.length - 1].id + '/edit';
            }, function myError(response) {
                alert(response);
            });
        } else {
            if (id == 0)
                alert('Vous avez sélectionnez un budget SVP!');
            if ($scope.chainedoc == "")
                alert('Il faut attachée un document SVP!');
        }
    }
    $scope.ValiderAttachementOS = function (url, id) {
        if (id == '0' && $scope.idCS != "") {
            id = $scope.idCS;
        }
        ;

        if (id != 0 && $scope.chainedoc != "") {
            $scope.document = {
                'id': id,
                'chaine': $scope.chainedoc
            };

            $http({
                url: url,
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                alert('Votre piéce a été ajoutée avec succès');
                window.location.reload()
                //document.location.href = 'piecejoint/' + data[data.length - 1].id + '/edit';
            }, function myError(response) {
                alert(response);
            });
        } else {
            if (id == 0)
                alert('Vous avez sélectionnez un courrier SVP!');
            if ($scope.chainedoc == "")
                alert('Il faut attachée un document SVP!');
        }
    }
    $scope.Onselect = function () {
        $scope.idCS = $scope.sltca;

    }
    $scope.ScanDocDemandeachat = function (url) {
        $http({
            url: domaineapp + 'achats.php/Scan/Lancerscan',
            method: "GET"

        }).then(function mySucces(response) {
            data = response.data[0];
            document.getElementById("imgmodel").innerHTML = '<img src="/uploads/scanner/' + data.chaine + '" style="width: 100%;height: 100%;"> ';
            $scope.chainedoc = data.chaine;

            // alert(document.getElementById("imgmodel").innerHTML);
        }, function myError(response) {
            alert(response);
        });

    }
    $scope.ValiderAttachementDoucumentachat = function (id) {
        //alert(id);
        if (id == '0' && $scope.idCS != "") {
            id = $scope.idCS;
        }
        ;

        if (id != 0 && $scope.chainedoc != "") {
            $scope.document = {
                'iddemande': id,
                'chaine': $scope.chainedoc
            };

            $http({
                url: domaineapp + "achats.php/Scan/Validerattachementdemandedeprix",
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                alert('Votre piéce a été ajoutée avec succès');
                $scope.AfficheDemandedeprix(id);
                // window.location.reload()
                //document.location.href = 'piecejoint/' + data[data.length - 1].id + '/edit';
            }, function myError(response) {
                alert(response);
            });
        } else {
            if (id == 0)
                alert('Vous avez sélectionnez un courrier SVP!');
            if ($scope.chainedoc == "")
                alert('Il faut attachée un document SVP!');
        }
    }
    $scope.AfficheDemandedeprix = function (id) {
        if (id != 0 && id != "undifined") {
            $scope.document = {
                'iddemande': id

            };

            $http({
                url: domaineapp + "achats.php/Scan/Afficheattachement",
                method: "POST",
                data: $scope.document,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $scope.attachements = data;
            }, function myError(response) {
                alert(response);
            });
        }
    }

    $scope.ValiderAttachementAlimentation = function (type) {
        var file_data = document.getElementById('piecejoint_chemin');
        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        $.ajax({
            url: domaineapp + "budget.php/titrebudjet/UploaderfileAlimentation",
            //            url: '../UploaderfileAlimentation', // point to server-side PHP script
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {
                $('#piece_alimentation').val(php_script_response);
                //                alert(php_script_response); // display response from the PHP script, if any
                var chemin = domaineapp + "uploads/scanner/" + php_script_response;
                $("#imgmodel").attr('src', chemin);

                $("#box_scan").hide();

                $("#sf_fieldset_none_choix").show();

                $('.chosen-container').attr("style", "width: 100%;");
                $('.chosen-container').trigger("chosen:updated");
            }
        });
    }

    $scope.saveAlimentation = function () {
        if ($("#type_alimentation").val() != '1') {
            if ($("#alimentationcompte_date").val() != '' && $("#alimentationcompte_montant").val() != '' && $("#alimentationcompte_id_compte").val() != '') {
                $scope.document = {
                    'piece_scan': $scope.chainedoc,
                    'piece_jointe': $("#piece_alimentation").val(),
                    'date': $("#alimentationcompte_date").val(),
                    'montant': $("#alimentationcompte_montant").val(),
                    'compte_id': $("#alimentationcompte_id_compte").val(),
                    'type': $("#type_alimentation").val(),
                    'libelle': $("#alimentationcompte_source_libelle").val(),
                    'source_id': $("#alimentationcompte_id_source").val()
                };
                $http({
                    url: domaineapp + "tresoriecaisse.php/alimentationcompte/saveAlimentation",
                    method: "POST",
                    data: $scope.document,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    bootbox.dialog({
                        message: "Alimentation effectuée avec succès, compte alimenté",
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
            } else {
                bootbox.dialog({
                    message: "Veuillez saisir toute les informations de votre alimentation !",
                    buttons: {
                        "button": {
                            "label": "Ok",
                            "className": "btn-sm"
                        }
                    }
                });
            }
        } else {
            var mntdefini = $("#alimentationcompte_id_compte_from option:selected").attr('montant');
            if (mntdefini == '')
                mntdefini = '0';
            if (parseFloat(mntdefini) >= parseFloat($("#alimentationcompte_montant_transfert").val())) {
                if ($("#alimentationcompte_date_transfert").val() != '' && $("#alimentationcompte_montant_transfert").val() != '' && $("#alimentationcompte_id_compte_from").val() != '' && $("#alimentationcompte_id_compte_to").val() != '' && $("#type_operation").val() != null && $("#instrument").val() != null) {
                    $scope.document = {
                        'piece_scan': $scope.chainedoc,
                        'piece_jointe': $("#piece_alimentation").val(),
                        'date': $("#alimentationcompte_date_transfert").val(),
                        'montant': $("#alimentationcompte_montant_transfert").val(),
                        'compte_id': $("#alimentationcompte_id_compte_from").val(),
                        'type': $("#type_alimentation").val(),
                        'compte_id_to': $("#alimentationcompte_id_compte_to").val(),
                        'type_operation': $("#type_operation").val(),
                        'instrument': $("#instrument").val(),
                        'reference_ordonnance': $("#alimentationcompte_reference_transfert").val(),
                        'reference_instrument': $("#reference_instrument").val(),
                        'reference_cheque': $("#reference_cheque").val(),
                        'cheque_id': $("#cheque_id").val()
                    };
                    $http({
                        url: domaineapp + "tresoriecaisse.php/alimentationcompte/saveAlimentation",
                        method: "POST",
                        data: $scope.document,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(function mySucces(response) {
                        bootbox.dialog({
                            message: "Transfert effectué avec succès, compte alimenté",
                            buttons: {
                                "button": {
                                    "label": "Ok",
                                    "className": "btn-sm"
                                }
                            }
                        });
                        var chemin = domaineapp + "uploadsPDF_file_icon.png/";
                        $("#imgmodel").attr('src', chemin);
                        window.location.reload();
                    }, function myError(response) {
                        alert(response);
                    });
                } else {
                    bootbox.dialog({
                        message: "Veuillez saisir toute les informations de votre transfert !",
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
                    message: "Vous n'avez plus de solde pour ce transfert !<br>Veuillez vérifier le montant du transfert. Vous avez que " + mntdefini + " TND !",
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

    $scope.ChargerCombo = function (id, data) {
        $(id).empty();
        $(id).append("<option value='0'></option>");
        for (i = 0; i < data.length; i++) {
            $(id).append("<option codeop='" + data[i].codeop + "' commission='" + data[i].valeurop + "' value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }

    $scope.ListeDesOperation = function (id, type) {
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
            $scope.ChargerCombo('#type_operation', data);
        }, function myError(response) {
            console.log(response);
        });
    }

    $scope.ListeInstrument = function (id_banque, id_type_operation) {
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
            $scope.ChargerCombo('#instrument', data);
        }, function myError(response) {
            console.log(response);
        });
    }

    $("#type_operation").change(function () {
        if ($("#type_operation").val() != "" && $("#type_operation").val() != "0" && $("#type_operation").val() != null) {
            $scope.ListeInstrument($("#alimentationcompte_id_compte_from").val(), $("#type_operation").val());
        }
    })
            .trigger("change");

    $("#alimentationcompte_id_compte_from")
            .change(function () {
                if ($("#alimentationcompte_id_compte_from").val() != "" && $("#alimentationcompte_id_compte_from").val() != "0") {
                    $scope.ListeDesOperation($("#alimentationcompte_id_compte_from").val(), "true");
                    var data = [];
                    $scope.ChargerCombo('#instrument', data);
                }
                $('#alimentationcompte_id_compte_to option').each(function () {
                    if ($(this).val() != $("#alimentationcompte_id_compte_from").val()) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#alimentationcompte_id_compte_to').val('').trigger("liszt:updated");
                $('#alimentationcompte_id_compte_to').trigger("chosen:updated");
            })
            .trigger("change");

    $scope.ListeDesCheques = function (id) {
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
            }

        }, function myError(response) {
            console.log(response);
        });
    }

    $("#instrument").change(function () {
        if ($("#instrument").val() == "2") {
            $("#zone_reference_instrument").hide();
            $("#zone_cheque").show();
            var id = $("#alimentationcompte_id_compte_from").val();
            $scope.ListeDesCheques(id);
        } else {
            $("#zone_cheque").hide();
            $("#zone_reference_instrument").show();
        }
    })
            .trigger("change");

    $scope.ChargerCheque = function () {
        var datacheque = eval($scope.ListesDesCheques);
        if (datacheque.length > 0) {
            $('#cheque_id').val(datacheque[0].id);
            $('#reference_cheque').val(datacheque[0].libelle);
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
});