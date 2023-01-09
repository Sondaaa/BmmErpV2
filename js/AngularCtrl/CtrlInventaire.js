var domaineapp = 'http://' + window.location.hostname + '/';
//var app = angular.module('Appdoc', []);
app.controller('CtrlInventaire', function($scope, $http) {


    $scope.MisajourLigneInventare = function(qtetheorique, idligne, idarticle, idstock) {

        var string_id_input = '#txt' + idarticle;

        $scope.param = {
            'qtetheorique': qtetheorique,
            'idligne': idligne,
            'qte': $(string_id_input).val(),
            'idstock': idstock
        }
        $http({
            url: domaineapp + 'stock.php/inventairestock/Misajourligne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#ecart' + idarticle).html(data);
        }, function myError(response) {
            alert(response);
        });
    }

});