var domaineapp = "http://" + window.location.hostname + "/";
app.controller('Ctrlfrs', function ($scope, $http) {




    $scope.ValiderCompte = function (id_rib, id_frs) {
        $scope.param = {
            "id_rib": id_rib,
            "id_frs": id_frs
        };

        $http({
            url: domaineapp + 'tresoriecaisse.php/fournisseur/ValiderRib',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            bootbox.alert("Activation du compte valide!", function () {
                window.location.href = domaineapp + 'tresoriecaisse.php/fournisseur';
            });

        }, function myError(response) {
            alert(response);
        });
    }
    $scope.InialiserChamps = function (id) {
        $('#fournisseur_id_user').addClass('disabledbutton');
        $('#fournisseur_id_user_chosen').addClass('disabledbutton');
        $('#fournisseur_id_user').val(id);
        $('#fournisseur_id_user').trigger("chosen:updated");
        if (!$('#fournisseur_fodec').is(':checked')) {
            $('#valfodec').attr('style', 'display:none');
        }
    }
    
       $scope.InialiserChampsUserUpdate = function (id) {
        $('#fournisseur_user_updated').addClass('disabledbutton');
        $('#fournisseur_user_updated_chosen').addClass('disabledbutton');
        $('#fournisseur_user_updated').val(id);
        $('#fournisseur_user_updated').trigger("chosen:updated");
        if (!$('#fournisseur_fodec').is(':checked')) {
            $('#valfodec').attr('style', 'display:none');
        }
    }
    $scope.ValiderFodec = function () {
        if (!$('#fournisseur_fodec').is(':checked')) {
            $('#valfodec').attr('style', 'display:none');
        } else {
            $('#valfodec').attr('style', '');
        }
    }
    $scope.InialiserReclamation = function (id) {
        if (id) {
            $('#reclamationfrs_id_frs').addClass('disabledbutton');
            $('#reclamationfrs_id_frs_chosen').addClass('disabledbutton');
            $('#reclamationfrs_id_frs').val(id);
            $('#reclamationfrs_id_frs').trigger("chosen:updated");
        }
    }
    $('#activite').change(function () {
        if (!isNaN(parseInt($('#activite').val())))
            $scope.ChooseUnderActivites();

    }).trigger('change');
//    $scope.AffecterCodeFournisseur = function () {
//        if ($('#fournisseur_id_activite').attr('code') != '')
//            $('#fournisseur_codefrs').val($('#fournisseur_id_activite option:selected').attr('code') + $('#fournisseur_nfiche').val());
//        else
//            $('#fournisseur_codefrs').val($('#fournisseur_nfiche').val());
//    }
//    $('#fournisseur_id_activite').change(function () {
//        if (!isNaN(parseInt($('#fournisseur_id_activite').val())))
//          //  $scope.AffecterCodeFournisseur();
//
//    }).trigger('change');

    $scope.ChooseUnderActivites = function () {
        $scope.param = {
            'activite_id': $('#activite').val()
        };

        $('#fournisseur_id_activite').html('');
        $http({
            url: domaineapp + 'achats.php/activitetiers/ChooseUnderActivite',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#fournisseur_id_activite').append("<option></option>");
            $.each(data.data, function (i, item) {
                $('#fournisseur_id_activite').append("<option code='" + item.code + "' value='" + item.id + "'>" + item.code + ' ' + item.libelle + "</option>");
            });

            $('#fournisseur_id_activite').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AjouterActiviter = function () {
        $scope.param = {
            "libelle": $('#activite_libelle').val()
        };

        $http({
            url: domaineapp + 'achats.php/activitetiers/Ajoutactiviter',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            lenght = data.length - 1;
            $('#fournisseur_id_activite').append("<option value='" + data[lenght].id + "'>" + data[lenght].libelle + "</option>");
            $('#fournisseur_id_activite').val(data[lenght].id);
            $('#fournisseur_id_activite').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.AjouterFamille = function () {
        $scope.param = {
            "libelle": $('#famille_libelle').val()
        };

        $http({
            url: domaineapp + 'achats.php/familleartfrs/Ajoutfamille',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            lenght = data.length - 1;
            $('#fournisseur_id_famillearticle').append("<option value='" + data[lenght].id + "'>" + data[lenght].libelle + "</option>");
            $('#fournisseur_id_famillearticle').val(data[lenght].id);
            $('#fournisseur_id_famillearticle').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }


});