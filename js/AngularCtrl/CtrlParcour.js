//var app1 = angular.module('appbo', []);
var domaineapp = "http://" + window.location.hostname + "/";
app.controller('CtrlParcour', function($scope, $http) {
    $scope.AjoutAction = function(url) {
        //alert('ggg');
        $scope.piecejoint = {
            'action': $scope.action.text,
            'remarque': $scope.remarque.text
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

            var select = document.getElementById("parcourcourier_id_action");
            var newOption = new Option(data[data.length - 1].action, data[data.length - 1].id);
            select.options.add(newOption);
            select.options[select.options.length - 1].selected = "selected";
            $("#parcourcourier_id_action").val(data[data.length - 1].id);
            // $('#parcourcourier_id_action').selectpicker('render');
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.InitParcour = function(url) {
        var id_user = $('#idexpparcour').val();

        if (id_user != "") {
            $http({
                url: url + '/user/' + id_user,
                method: "GET"

            }).then(function mySucces(response) {
                data = response.data;

                $('#parcourcourier_id_exp').val(data[0].id);
                $('#parcourcourier_id_exp').attr('class', 'form-control disabledbutton');
                //                $("#parcourcourier_id_exp").selectpicker("refresh");
            }, function myError(response) {
                alert(response);
            });
        }
    }
    $scope.InitParcour("Rechercheexp");
});