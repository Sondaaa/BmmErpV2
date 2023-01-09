//var app = angular.module('appbo', []);
var domaineapp = "http://" + window.location.hostname + "/";
app.controller('CtrlPiecejoint', function($scope, $http) {

    $scope.Init = function() {
        var id_courrier = $('#idcourrier').val();
        if ($('#piecejoint_id').val()) {
            $('#piecejoint_id_courrier').attr('class', 'form-control disabledbutton');
        }
        if (id_courrier != "") {
            $('#piecejoint_id_courrier').val(id_courrier);
            $('#piecejoint_id_courrier').attr('class', 'form-control disabledbutton');
        }
        // $("#piecejoint_id_courrier").selectpicker("refresh");
    }
    $scope.Init();
});