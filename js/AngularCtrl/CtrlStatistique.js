//var app = angular.module('Appdoc', []);

var domaineapp = "http://" + window.location.hostname + "/";
app.controller('CtrlStatistique', function($scope, $http) {

    $scope.ChargerCombo = function(id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
            $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
    }
    $scope.ChargerFournisseur = function(id, id_marches) {
        $scope.param = {
            'id_marches': id_marches
        }
        $http({
            method: "POST",
            data: $scope.param,
            url: domaineapp + 'controlegestion.php/marches/ListeFournisseurByMarches',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo(id, data);
        }, function myError(response) {

        });
    }

    $scope.ChargerArticle = function(id_beneficiaire, id_marches) {
        $scope.param = {
            'id_beneficiaire': id_beneficiaire,
            'id_marches': id_marches
        }
        $http({
            method: "POST",
            data: $scope.param,
            url: domaineapp + 'controlegestion.php/marches/ListeArticleByFournisseurAndMarches',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.ChargerCombo('#id_article', data);
        }, function myError(response) {

        });
    }

    $("#id_marche")
        .change(function() {
            if ($("#id_marche").val() != "0") {
                $scope.ChargerFournisseur('#id_beneficiaire', $("#id_marche").val());
            } else {
                $('#id_beneficiaire').empty();
                $('#id_beneficiaire').val('').trigger("liszt:updated");
                $('#id_beneficiaire').trigger("chosen:updated");
            }
        })
        .trigger("change");

    $("#id_marche_article")
        .change(function() {
            if ($("#id_marche_article").val() != "0") {
                $scope.ChargerFournisseur('#id_beneficiaire_article', $("#id_marche_article").val());
            } else {
                $('#id_beneficiaire_article').empty();
                $('#id_beneficiaire_article').val('').trigger("liszt:updated");
                $('#id_beneficiaire_article').trigger("chosen:updated");
            }
        })
        .trigger("change");

    $('#id_beneficiaire_article')
        .change(function() {
            if ($("#id_beneficiaire_article").val() != "0") {
                $scope.ChargerArticle($("#id_beneficiaire_article").val(), $("#id_marche_article").val());
            } else {
                $('#id_article').empty();
                $('#id_article').val('').trigger("liszt:updated");
                $('#id_article').trigger("chosen:updated");
            }
        })
        .trigger("change");
});