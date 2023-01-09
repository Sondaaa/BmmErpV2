var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('Ctrlexpdest', function($scope, $http) {

    $scope.Chargergouvernera = function() {
        $http({
            method: "GET",
            url: domaineapp + 'bureauxdordre.php/gouvernera/ListeGouv',
        }).then(function mySucces(response) {
            $scope.listesgouvs = response.data;
            if ($scope.listesgouvs.length <= 0) {
                $('#sltdesc *').attr('style', 'display:none')
            } else {
                $('#sltdesc *').attr('style', 'display:block;top:0% !important');
            }
        }, function myError(response) {

        });
    }
    $scope.ChargerPays = function() {
        $http({
            method: "GET",
            url: domaineapp + 'bureauxdordre.php/pays/ListePays',
        }).then(function mySucces(response) {
            $scope.listespays = response.data;
            if ($scope.listespays.length <= 0) {
                $('#sltpays *').attr('style', 'display:none')

            } else {
                $('#sltpays *').attr('style', 'display:block;top:0% !important');

            }
        }, function myError(response) {

        });
    }
    $scope.InialiserChamps = function() {
        $('#expdest_rs').val("");
        $('#expdest_tel').val("");
        $('#expdest_gsm').val("");
        $('#expdest_email').val("");
        $('#expdest_adr').val("");
        $('#expdest_id_gouvernera').val("");
        $('#expdest_id_gouvernera').trigger("chosen:updated");
    }
    $scope.ChoisirFournisseur = function() {

        $scope.param = {
            "idfrs": $('#expdest_id_frs').val()
        };

        $http({
            url: domaineapp + 'bureauxdordre.php/expdest/choisirfrs',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                $scope.frs = data[0];
                $('#expdest_npresponsable').val("");
                $scope.InialiserChamps();
                if ($scope.frs.nom && $scope.frs.prenom)
                    $('#expdest_npresponsable').val($scope.frs.nom + ' ' + $scope.frs.prenom);
                if ($scope.frs.rs)
                    $('#expdest_rs').val($scope.frs.rs);
                if ($scope.frs.tel)
                    $('#expdest_tel').val($scope.frs.tel);
                if ($scope.frs.gsm)
                    $('#expdest_gsm').val($scope.frs.gsm);
                if ($scope.frs.mail)
                    $('#expdest_email').val($scope.frs.mail);
                if ($scope.frs.adrs)
                    $('#expdest_adr').val($scope.frs.adrs);
                if ($scope.frs.id_gouv)
                    $('#expdest_id_gouvernera').val($scope.frs.id_gouv);
                $('#expdest_id_gouvernera').trigger("chosen:updated");
            }
        }, function myError(response) {
            alert(response);
        });

    }
    $scope.ChoisirAdrfrs = function() {

        $scope.param = {
            "idfrs": $('#expdest_id_frs').val()
        };

        $http({
            url: domaineapp + 'bureauxdordre.php/expdest/choisiradrs',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                $scope.frs = data[0];

                $('#expdest_adr').val("");
                $('#expdest_id_gouvernera').val("");

                if ($scope.frs.adrs)
                    $('#expdest_adr').val($scope.frs.adrs);
                if ($scope.frs.id_gouv)
                    $('#expdest_id_gouvernera').val($scope.frs.id_gouv);

                $('#expdest_id_gouvernera').trigger("chosen:updated");
            }
        }, function myError(response) {
            alert(response);
        });

    }
    $("#expdest_id_famille")
        .change(function() {
            if ($("#expdest_id_famille").val() != "") {
                $scope.InialiserChamps();
                $("#expdest_id_frs").val("");
                $('#expdest_id_frs').trigger("chosen:updated");
                $("#expdest_id_agent").val("");
                $('#expdest_id_agent').trigger("chosen:updated");
                $('#expdest_id_gouvernera').val("");
                $('#expdest_id_gouvernera').trigger("chosen:updated");
                if ($("#expdest_id_famille").val() == '1') {

                    $("#expdest_id_agent").addClass('disabledbutton');
                    $('#expdest_id_agent_chosen').addClass('disabledbutton');
                    $("#expdest_id_frs").removeClass('disabledbutton');
                    $('#expdest_id_frs_chosen').removeClass('disabledbutton');

                } else {

                    $("#expdest_id_agent").removeClass('disabledbutton');
                    $('#expdest_id_agent_chosen').removeClass('disabledbutton');
                    $("#expdest_id_frs").addClass('disabledbutton');
                    $('#expdest_id_frs_chosen').addClass('disabledbutton');
                }
            }
        })
        .trigger("change");
    $("#expdest_id_frs")
        .change(function() {
            $("#expdest_id_agent").addClass('disabledbutton');
            $('#expdest_id_agent_chosen').addClass('disabledbutton');

            if ($("#expdest_id_frs").val() != "") {
                $scope.ChoisirFournisseur();
                $scope.ChoisirAdrfrs();
            }
        })
        .trigger("change");
    $("#expdest_id_agent")
        .change(function() {
            $("#expdest_id_frs").addClass('disabledbutton');
            $('#expdest_id_frs_chosen').addClass('disabledbutton');
        })
        .trigger("change");
});