var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('myCtrlImmo', function($scope, $http) {

    $scope.articletransfer = [{
        'id_article': "",
        'article': "",
        'id_bureuxd': "",
        'bureaux': "",
        'id_bt': '',
        'bureauxtransfer': '',
        'id_user': '',
        'user': ''
    }];

    $scope.AjouterTransfer = function() {
        var chaine = "";
        var tab = eval($scope.articletransfer);
        for (var i = 0; i < tab.length; i++) {
            chaine += tab[i].id_article + '-' + tab[i].id_bureuxd + '-' + tab[i].id_bt + '-' + tab[i].id_user + "*";
        }

        var urlvalider = domaineapp + "/immobilisation.php/Immob/ValiderTransfer";
        if (chaine != "")
            urlvalider += "/listearticle/" + chaine;
        //document.location.href=urlvalider;

        $http({
            method: "GET",
            url: urlvalider
        }).then(function mySucces(response) {
            //alert(response.data);
            location.reload();
            //            document.location.href = "<?php echo url_for('Immob/transfer') ?>?msg=1";

        }, function myError(response) {
            //alert(response);
        });
    };
    $scope.AjouterArticle = function() {

        if ($('#idarticle').val() && $('#idbd').val() && $('#idbv').val()) {
            $scope.articletransfer.push({
                'id_article': $('#idarticle').val(),
                'article': $('#txt_article').val(),
                //                'id_article': $scope.idarticle,
                //                'article': $scope.filterarticle,
                'id_bureuxd': $('#idbd').val(),
                'bureaux': $('#txt_bd').val(),
                //                'id_bureuxd': $scope.idbd,
                //                'bureaux': $scope.filterbd,
                'id_bt': $('#idbv').val(),
                'bureauxtransfer': $('#txt_bv').val(),
                //                'id_bt': $scope.idbv,
                //                'bureauxtransfer': $scope.filterbv,
                'id_user': $('#iduser').val(),
                'user': $('#txt_user').val()
                    //                'id_user': $scope.iduser,
                    //                'user': $scope.filteruser
            });
        }
        $scope.idarticle = "";
        $scope.filterarticle = "";
        $scope.idbd = "";
        $scope.filterbd = "";
        $scope.filterbv = "";
        $scope.iduser = "";
        $scope.filteruser = "";
    };

    $scope.removeRow = function(idindex) {
        // alert(id);
        $scope.articletransfer.splice(idindex, 1);
    };

    $scope.selectbd = function() {
        var bureau = $('#txt_bd').val();
        $scope.param = {
            'bureau': bureau
        }
        $http({
            method: "POST",
            url: domaineapp + "/immobilisation.php/Immob/ListeBureauxdepart",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfterForPatrimoine(data, '#txt_bd', '#idbd');
            //            document.getElementById("sltbd").style.display = "";
            //            $scope.bds = response.data.entities;
        }, function myError(response) {
            alert('Erreur');
        });

    };
    $scope.selectedBd = function(namebureau, idbd) {
        $scope.filterbd = namebureau;
        $scope.idbd = idbd;

        document.getElementById("sltbd").style.display = "none";
    };
    $scope.selectuser = function() {
        var raison = $('#txt_user').val();
        $scope.param = {
            'raison': raison
        }
        $http({
            method: "POST",
            url: domaineapp + "/immobilisation.php/Immob/ListeAgents",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfterForPatrimoine(data, '#txt_user', '#iduser');
            //            document.getElementById("sltuser").style.display = "";
            //            $scope.users = response.data.entities;
        }, function myError(response) {
            alert('Erreur');
        });

    };
    $scope.selectedUser = function(nameuser, iduser) {
        $scope.filteruser = nameuser;
        $scope.iduser = iduser;
        document.getElementById("sltuser").style.display = "none";
    };
    $scope.selectbv = function() {
        var bureau = $('#txt_bv').val();
        $scope.param = {
            'bureau': bureau
        }
        $http({
            method: "POST",
            url: domaineapp + "/immobilisation.php/Immob/ListeBureauxdepart",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfterForPatrimoine(data, '#txt_bv', '#idbv');
            //            document.getElementById("sltbv").style.display = "";
            //            $scope.bvs = response.data.entities;
        }, function myError(response) {

        });

    };
    $scope.selectedBv = function(namebureau, idbd) {
        $scope.filterbv = namebureau;
        $scope.idbv = idbd;
        document.getElementById("sltbv").style.display = "none";
    };
    $scope.selectarticle = function() {
        var urlarticle = domaineapp + "/immobilisation.php/Immob/ListeArticleByBureauxDepart";
        //        urlarticle += "/codebu/" + $('#idbd').val();
        // document.location.href=urlarticle;
        var designation = $('#txt_article').val();
        var idbd = $('#idbd').val();
        $scope.param = {
            'designation': designation,
            'idbd': idbd
        }
        $http({
            method: "POST",
            url: urlarticle,
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfterForPatrimoine(data, '#txt_article', '#idarticle');
            //            document.getElementById("sltarticle").style.display = "";
            //            $scope.articles = response.data.entities;
        }, function myError(response) {

        });
    };
    $scope.selectedArticle = function(nameartciel, idarticle) {
        $scope.filterarticle = nameartciel;
        $scope.idarticle = idarticle;
        document.getElementById("sltarticle").style.display = "none";
    };
    $scope.removeRow(-1);

    $scope.Renialisertable = function(id) {
        var id_immob = $("#" + "idimmob_" + id).val();
        var varcontenu = $("#" + "amrtint_" + id).val();
        var url = domaineapp + "/immobilisation.php/tableauxammortisement/Calcultimmob/id/" + id_immob + "/contenu/" + varcontenu + '/idtable/' + id;
        document.location.href = url;
    };

    $scope.Modifier = function(id) {
        if (document.getElementById('div_' + id).style.display == "none")
            document.getElementById('div_' + id).style.display = "";
        else
            document.getElementById('div_' + id).style.display = "none";
    };
});