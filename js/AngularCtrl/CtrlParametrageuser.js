var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('Ctrluserprofile', function ($scope, $http) {

    var domaineapp = "http://" + window.location.hostname + "/";
    app.controller('Ctrluserprofile', function ($scope, $http) {

        $scope.changeMotif = function () {
            var skin = "no-skin";
            if ($('#skin-colorpicker').val() == "#C6487E")
                skin = "skin-2";
            if ($('#skin-colorpicker').val() == "#438EB9")
                skin = "no-skin";
            if ($('#skin-colorpicker').val() == "#222A2D")
                skin = "skin-1";
            if ($('#skin-colorpicker').val() == "#D0D0D0")
                skin = "skin-3";
            $scope.param = {
                'couleur': $('#skin-colorpicker').val(),
                'skin': skin,
                'sidebar': $('#ace-settings-add-container')[0].checked
            }

            $http({
                url: domaineapp + 'accueil.php/utilisateur/Updatemotif',
                method: "POST",
                data: $scope.param,
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

    });
});