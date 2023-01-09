//var app = angular.module('myAppstock', []);
app.controller('CtrlArticleStock', function ($scope, $http) {
    $scope.tva=0;
    $scope.CalculerTTC = function () {  
        var tva=$("#article_id_tva option:selected").text();
        if ($('#article_id_tva').val()!="" && $('#article_puht').val()!="" && tva){
            tva=parseFloat(tva.replace('%','')).toFixed(2);
            var ht=parseFloat($('#article_puht').val()).toFixed(3);
            var ttc=parseFloat(ht*(1 + (tva / 100))).toFixed(3);
           
            $('#article_ttc').val(ttc);
        }
        else
            $('#article_ttc').val($scope.prixht.text);    
    }
});