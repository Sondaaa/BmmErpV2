//var app = angular.module('myAppCtrlignedoc', []);
var domaineapp = "http://" + window.location.hostname + "/";
app.controller('myCtrllignedoc', function($scope, $http) {


    //__________________________________________________________________________Recherche article by code ou designation
    $scope.ValiderChoix = function(id, qtedemander) {
        var input1 = $('#input_qte_pe' + id).val();
        var input2 = $('#input_qte_pa' + id).val();
        qtechan = parseFloat(input1) + parseFloat(input2);
        qtediff = parseFloat(qtedemander) - parseFloat(qtechan);

        if (qtediff >= 0) {

            $scope.param = {
                'input1': input1,
                'input2': input2,
                'id': id
            }
            $http({
                url: domaineapp + 'immobilisation.php/documentachat/Validerligne',
                method: "BmmErpPOST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                alert(data);
            }, function myError(response) {
                alert("Erreur");
            });
        } else
            alert('Vérifier les qte que vous avez-saisie');

    }
});