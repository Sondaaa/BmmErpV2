var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('CtrlArticle', function ($scope, $http) {


    $scope.Initialiser = function (id) {

        $('#article_id_user').val(id);
        $('#article_id_user').trigger("chosen:updated");
        $('#article_codesf').attr('class', 'disabledbutton');
        $('#tableajoutarticle td').attr('style', 'width:200px');
        $('#article_id_user').trigger("chosen:updated");

    }
    $scope.AfficheSousFamille = function (idfamille) {

        $scope.param = {
            'idfamille': idfamille
        }
        $http({
            url: domaineapp + 'stock.php/famillearticle/Affichesousfamille',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.sousfamille = data;
            if ($('#article_id_sousfamille').val() != "") {
                $('#sfamille').val($('#article_id_sousfamille').val());
                $('#sfamille').trigger("chosen:updated");
            } else {
                $('#sfamille').trigger("chosen:updated");
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheCodeSousFamille = function (code, id) {
        $('#article_codesf').val(code);
        $('#article_codesf').attr('class', 'disabledbutton');
        $('#article_id_sousfamille').val(id);
        $('#article_id_sousfamille').trigger("chosen:updated");
    }
    $scope.AfficheCode = function (idfamille) {
        $scope.param = {
            'idfamille': idfamille
        }
        $http({
            url: domaineapp + 'stock.php/famillearticle/Affichecode',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#article_codefamille').val(data);
            $('#article_codefamille').attr('class', 'disabledbutton');
        }, function myError(response) {
            alert(response);
        });
    }
    $("#article_id_famille")
            .change(function () {
                if ($("#article_id_famille").val() != "") {
                    $scope.AfficheCode($("#article_id_famille").val());
                    $scope.AfficheSousFamille($("#article_id_famille").val());
                    $scope.AfficheSousFamille($("#article_id_famille").val());
                }
            })
            .trigger("change");
    $('#sfamille')
            .change(function () {
                if ($("#sfamille").val() != "") {
                    var codlibelle = $("#sfamille option:selected").text();
                    if (codlibelle && codlibelle != "") {
                        codlibelle = codlibelle.trim().split("/"); //alert(codlibelle);
                        var codesf = codlibelle[0].trim().split(":"); //alert(codesf);
                        codesf = codesf[1];
                        $scope.AfficheCodeSousFamille(codesf, $("#sfamille").val());
                    }
                }
            })
            .trigger("change");
    $('#article_id_nature')
            .change(function () {
                if ($("#article_id_nature").val() != "") {
                    var codlibelle = $("#article_id_nature option:selected").text();
                    if (codlibelle && codlibelle != "") {
                        codlibelle = codlibelle.trim().split(" "); //alert(codlibelle);
                        var codenature = codlibelle[0].trim().split(":"); //alert(codenature);
                        codenature = codenature[1];
                        $('#article_codenature').val(codenature);
                        $('#article_codenature').attr('class', 'disabledbutton');
                    }
                }
            })
            .trigger("change");
    //____________________________________________________________________Caractéristique article
    $scope.InialiserCarac = function (id) {
        $('#lignecararticle_id_article_chosen').attr('style', 'width: 100%;');
        $('#lignecararticle_id_car_chosen').attr('style', 'width: 100%;');
        $('#lignecararticle_id_article').val(id);
        $('#trarticle').attr('class', 'disabledbutton');
        // $('#lignecararticle_id_article_chosen').attr('class', 'disabledbutton');
        $('#lignecararticle_id_article').trigger("chosen:updated");
    }
    $scope.AjouterCara = function () {
        var id = $('#lignecararticle_id_article').val();
        $scope.param = {
            'idarticle': id,
            'idcar': $('#lignecararticle_id_car').val(),
            'valeur': $('#lignecararticle_valeurlibelle').val()
        }
        $http({
            url: domaineapp + 'stock.php/caracteristiquearticle/Ajoutercar',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.AfficheCar(id);
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.DeleteCara = function (idligne) {
        var id = $('#lignecararticle_id_article').val();
        $scope.param = {
            'idligne': idligne
        }
        $http({
            url: domaineapp + 'stock.php/caracteristiquearticle/Supprimercar',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.AfficheCar(id);
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheCar = function (id) {
        $scope.param = {
            'idarticle': id
        }
        $http({
            url: domaineapp + 'stock.php/caracteristiquearticle/Affichecar',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.listescar = data;
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.InialiserArticle = function () {
        $('#article_id_unite_chosen').attr('style', 'width: 100%;');
        $('#article_id_tva_chosen').attr('style', 'width: 100%;');
    }

    $scope.DetailMouvement = function (id) {

        $scope.param = {
            'idarticle': id
        }
        $http({
            url: domaineapp + 'stock.php/article/Mouvementstockbyarticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#tree2' + id).ace_tree({
                dataSource: data,
                loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
                'open-icon': 'ace-icon fa fa-folder-open',
                'close-icon': 'ace-icon fa fa-folder',
                'itemSelect': true,
                'folderSelect': true,
                'multiSelect': true,
                'selected-icon': null,
                'unselected-icon': null,
                'folder-open-icon': 'ace-icon tree-plus',
                'folder-close-icon': 'ace-icon tree-minus'
            });
        }, function myError(response) {
            alert(response);
        });
    }
});
app.controller('myCtrlbonstock', function ($scope, $http) {

    $scope.lignedocbce = [];
    $scope.totalfiche = [];
    $scope.detailfrs = {};
    $scope.basetva = [];
    $scope.parametragesociete = {};
    $scope.ParametrageSociete = function () {
        $scope.param = {
            'idsoc': 1
        }
        $http({
            url: domaineapp + 'accueil.php/parametragesociete/Parametragesociete',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {

            data = response.data;
            $scope.parametragesociete = data[0];
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheDetailFrs = function (id) {
        $scope.param = {
            'idfrs': id
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Affichefournisseur',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                $scope.dtailfrs = data;
                $scope.detailfrs = data[0];
                if ($scope.detailfrs.assujtva != '1') {

                    $('#tva').addClass('disabledbutton');
                } else {
                    $('#tva').removeClass('disabledbutton');
                }
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheListesPvdereception = function (idfrs) {
        $scope.param = {
            'idfrs': idfrs
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Listespvdereception',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            // $scope.numeroboncommandes = data;

            lenght = data.length;
            $('#nbexterne').empty();
            for (i = 0; i < lenght; i++) {
                $('#nbexterne').append("<option value='" + data[i].id + "'>" + data[i].numero + "-" + data[i].mntttc + "</option>");
                // $('#nbexterne').val(data[i].id);

            }
            $("#nbexterne").val('').trigger("liszt:updated");
            $('#nbexterne').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AfficheListesbcommnadeexterne = function (idfrs) {
        $scope.param = {
            'idfrs': idfrs
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Listesbcommnadeexterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            // $scope.numeroboncommandes = data;

            lenght = data.length;
            $('#nbexterne').empty();
            for (i = 0; i < lenght; i++) {
                $('#nbexterne').append("<option value='" + data[i].id + "'>" + data[i].numero + "-" + data[i].mntttc + "</option>");
                // $('#nbexterne').val(data[i].id);

            }
            $("#nbexterne").val('').trigger("liszt:updated");
            $('#nbexterne').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $("#documentachat_id_frs")
            .change(function () {
                if ($("#documentachat_id_frs").val() != "") {

                    $scope.AfficheDetailFrs($("#documentachat_id_frs").val());
                    if ($('#idtypedocumentachat').val() && $('#idtypedocumentachat').val() != "" && $('#idtypedocumentachat').val() != "14")
                        $scope.AfficheListesbcommnadeexterne($("#documentachat_id_frs").val());
                    if ($('#idtypedocumentachat').val() && $('#idtypedocumentachat').val() != "" && $('#idtypedocumentachat').val() != "10")
                        $scope.AfficheListesPvdereception($("#documentachat_id_frs").val());
                    $('#nbexterne').trigger("chosen:updated");
                }
            })
            .trigger("change");
    $scope.ListesTva = function () {

        $http({
            url: domaineapp + '/achats.php/documentachat/Listetva',
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.tvalistes = data;
            $('#tvalistes').trigger("chosen:updated");
        }, function myError(response) {
            alert("Erreur ....");
        });
    }
    $scope.ListesTva();
    $scope.AjouterLigneBce = function () {
        if ($('#nbexterne').val()) {
            $scope.param = {
                'iddoc': $('#nbexterne').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Listeslignesbce',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                if ($('#magtous').val() != "") {
                    data = response.data;

                    $scope.CalculTotalAjout(data);
                    $scope.CalculTotal();
                    $scope.RechercherCode();
                } else
                    alert('Il faut ajouter magasin');
            }, function myError(response) {
                alert(response);
            });
        }
    }

    $scope.RechercherCode = function () {
        var comArr = eval($scope.lignedocbce);
        for (i = 0; i < comArr.length; i++) {
            if (!comArr[i].codearticle) {

                $scope.param = {
                    'designation': comArr[i].designation
                }
                $http({
                    url: domaineapp + 'stock.php/article/Recherchearticle',
                    method: "POST",
                    data: $scope.param,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function mySucces(response) {
                    data = response.data;
                    if (data.length > 0) {
                        article = data[0];
                        for (j = 0; j < comArr.length; j++) {

                            if (comArr[j].designation === article.designation) {
                                comArr[j].codearticle = article.codeart;
                                comArr[j].idarticle = article.id;
                                comArr[j].idtva = article.id_tva;
                            }
                        }
                    } //44877344

                }, function myError(response) {
                    alert(response);
                });
            }
        }
    }
    $scope.CalculTotalAjout = function (data) {
        var fodec = 1;
        var asj = 0;
        var totaltva = 0;
        var valeurfodec = 0;
        var mnttva = 0;
        var totalremise = 0;
        var fodectotal = 0;
        var valeurtva = 0;
        var idtva = 3;
        var mntttcnet = 0;
        var idmag = 0;
        var libellemag = "";
        var asj = 0;
        if ($scope.detailfrs.assujtva != '1') {
            asj = 0;
        } else
            asj = 1;
        if ($scope.detailfrs.fodec === '1') {
            fodec = 1 + parseFloat($scope.parametragesociete.valeurfodec);
            fodectotal = $scope.parametragesociete.valeurfodec;
        }

        for (i = 0; i < data.length; i++) {
            var k = 0;
            if ($scope.lignedocbce.length > 0) {
                if (data[i].codearticle) {
                    for (h = 0; h < $scope.lignedocbce.length; h++) {
                        if ($scope.lignedocbce[h].codearticle) {
                            if ($scope.lignedocbce[h].codearticle.trim() === data[i].codearticle.trim())
                                k++;
                        }
                    }
                }
            }
            if (k === 0) {
                if (data[i].qtelivrefrs || data[i].qtedemander)
                    qteret = parseFloat(data[i].qtelivrefrs) - parseFloat(data[i].qtedemander);
                else
                    qteret = data[i].qte;
                if (qteret > 0) {
                    if (data[i].idmag) {
                        idmag = data[i].idmag;
                        libellemag = data[i].nommag;
                        $('#magtous').val(idmag);
                        $('#magtous').trigger("chosen:updated");
                        $('#mag').val(idmag);
                        $('#mag').trigger("chosen:updated");
                    } else {
                        idmag = $('#magtous').val();
                        libellemag = $('#magtous option:selected').text();
                    }
                    nordre = $scope.lignedocbce.length + 1;
                    totalht = parseFloat(qteret * parseFloat(data[i].mntht)).toFixed(3);
                    totaltva = totalht * fodec;
                    valeurfodec = parseFloat(totalht) * fodectotal;
                    mntttcnet = parseFloat(data[i].mntttc) * fodec;
                    if (asj === 1) {
                        valeurtva = parseFloat(data[i].valeurtva);
                        idtva = data[i].id_tva;
                    }

                    mnttva = parseFloat(data[i].mntht) * fodec * (valeurtva / 100);

                    $scope.lignedocbce.push({
                        'norgdre': nordre,
                        'idarticle': data[i].id_articlestock,
                        'codearticle': data[i].codearticle,
                        'designation': data[i].designationarticle,
                        'qte': qteret,
                        'puorigine': data[i].mntht,
                        'puht': data[i].mntht,
                        'mnttva': mnttva,
                        'mntttc': mntttcnet,
                        'totalht': totalht,
                        'totalhtva': totaltva,
                        'fodec': valeurfodec,
                        'remise': totalremise.toFixed(2),
                        'tauxremise': 0,
                        'tva': valeurtva.toFixed(2),
                        'idtva': idtva,
                        'idligne': data[i].id,
                        'iddoc': data[i].id_doc,
                        'idmag': idmag,
                        'magasin': libellemag
                    });
                }
            } else {
                $scope.RefrechTab();
            }

        }
    }

    $scope.CalculTotal = function () {
        var totalht = 0;
        var totaltva = 0;
        var valeurfodec = 0;
        var totalhtva = 0;
        var ttthtax = 0;
        var totalfodec = 0;
        var remise = 0;

        var fodectotal = 0;
        if ($scope.detailfrs.fodec === '1') {
            fodectotal = $scope.parametragesociete.valeurfodec;
        }
        for (i = 0; i < $scope.lignedocbce.length; i++) {
            var pu = parseFloat($scope.lignedocbce[i].puht);
            $scope.lignedocbce[i].puht = pu.toFixed(3);
            totalht = totalht + (pu * parseFloat($scope.lignedocbce[i].qte));
            $scope.lignedocbce[i].totalht = parseFloat(pu * parseFloat($scope.lignedocbce[i].qte)).toFixed(3);
            totaltva = totaltva + parseFloat($scope.lignedocbce[i].mnttva) * parseFloat($scope.lignedocbce[i].qte);
            totalfodec = totalfodec + parseFloat($scope.lignedocbce[i].fodec);
            totalhtva = totalht + totalfodec;
            remise = remise + parseFloat($scope.lignedocbce[i].remise) * parseFloat($scope.lignedocbce[i].qte);
        }
        var tttcnet = totalhtva + totaltva;
        $scope.totalfiche = {
            'thtxa': totalht.toFixed(3),
            'totalremise': remise.toFixed(2),
            'fodec': totalfodec.toFixed(3),
            'tht': totalhtva.toFixed(3),
            'ttva': totaltva.toFixed(3),
            'ttcnet': tttcnet.toFixed(3)
        }

        $scope.CalculBaseTva();
    }
    $scope.CalculBaseTva = function () {
        var titrebasetva = '';
        var valeurbasetva = 0;
        $scope.basetva = [];
        for (i = 0; i < $scope.lignedocbce.length; i++) {
            var existe = 0;
            titrebasetva = $scope.lignedocbce[i].tva;
            titrebasetva = titrebasetva.replace("%", "").trim();
            valeurbasetva = parseFloat($scope.lignedocbce[i].mnttva) * parseFloat($scope.lignedocbce[i].qte);
            for (j = 0; j < $scope.basetva.length; j++) {
                if ($scope.basetva[j].titre === titrebasetva) {
                    existe = 1;
                    $scope.basetva[j].valeur = parseFloat($scope.basetva[j].valeur) + valeurbasetva;
                    $scope.basetva[j].valeur = parseFloat($scope.basetva[j].valeur).toFixed(3);
                }
            }
            if (existe === 0) {
                $scope.basetva.push({
                    'valeur': parseFloat(valeurbasetva).toFixed(2),
                    'titre': titrebasetva.trim()
                });
            }

        }

    }

    $scope.AjouterTaux = function () {
        var taux = 0;
        var ttthtax = 0;
        var fodectotal = 1;
        if ($scope.detailfrs.fodec === '1') {

            fodectotal = 1.01;
        }
        if ($('#remisetotalvaleur').val() != "") {
            for (j = 0; j < $scope.lignedocbce.length; j++) {
                ttthtax = ttthtax + (parseFloat($scope.lignedocbce[j].puht) * fodectotal * parseFloat($scope.lignedocbce[j].qte));
            }
        }
        if ($('#remisetotalvaleurttc').val() != "") {

            for (j = 0; j < $scope.lignedocbce.length; j++) {
                var pttc = parseFloat($scope.lignedocbce[j].puht) * fodectotal * (1 + parseFloat($scope.lignedocbce[j].tva) / 100);
                ttthtax = ttthtax + (pttc * parseFloat($scope.lignedocbce[j].qte));
            }
        }

        if ($('#remisetotalvaleurttc').val() != "") {
            taux = parseFloat($('#remisetotalvaleurttc').val()) / ttthtax;
        }

        if ($('#remisetotalvaleur').val() != "") {
            taux = parseFloat($('#remisetotalvaleur').val()) / ttthtax;
        }
        if ($('#remisetotalpourcentage').val() != "") {
            taux = parseFloat($('#remisetotalpourcentage').val() / 100);
        }

        for (j = 0; j < $scope.lignedocbce.length; j++) {
            $scope.lignedocbce[j].tauxremise = taux.toFixed(3);
        }
        if ($('#remisetotalvaleurttc').val() != "") {
            $scope.ChangerPrixTTC();
        }

        if ($('#remisetotalvaleur').val() != "") {
            $scope.ChangerPrix();
        }
        if ($('#remisetotalpourcentage').val() != "") {
            $scope.ChangerPrix();
        }
        $scope.CalculTotal();
        $('#remisetotalvaleurttc').val("");
        $('#remisetotalvaleur').val("");
        $('#remisetotalpourcentage').val("");
    }
    $scope.ChangerPrix = function () {
        var taux = 0;
        var fodectotal = 0;
        if ($scope.detailfrs.fodec === '1') {
            fodectotal = $scope.parametragesociete.valeurfodec;
        }
        for (i = 0; i < $scope.lignedocbce.length; i++) {
            var pu = parseFloat($scope.lignedocbce[i].puorigine);
            taux = parseFloat($scope.lignedocbce[i].tauxremise);
            $scope.lignedocbce[i].remise = parseFloat(pu * taux).toFixed(3);
            if (taux > 0) {
                pu = pu - (pu * taux);
                $scope.lignedocbce[i].mnttva = (parseFloat($scope.lignedocbce[i].mnttva) - (parseFloat($scope.lignedocbce[i].mnttva) * taux)).toFixed(3);
                $scope.lignedocbce[i].mntttc = (parseFloat($scope.lignedocbce[i].mntttc) - (parseFloat($scope.lignedocbce[i].mntttc) * taux)).toFixed(3);
            }
            $scope.lignedocbce[i].puht = pu.toFixed(3);

            $scope.lignedocbce[i].totalht = parseFloat(pu * parseFloat($scope.lignedocbce[i].qte)).toFixed(3);
            $scope.lignedocbce[i].fodec = parseFloat($scope.lignedocbce[i].totalht) * fodectotal;
        }
    }
    $scope.ChangerPrixTTC = function () {
        var taux = 0;
        var fodectotal = 0;
        if ($scope.detailfrs.fodec === '1') {
            fodectotal = $scope.parametragesociete.valeurfodec;
        }
        for (i = 0; i < $scope.lignedocbce.length; i++) {

            var pttc = parseFloat($scope.lignedocbce[i].mntttc);
            taux = parseFloat($scope.lignedocbce[i].tauxremise);
            pttc = pttc - (pttc * taux);
            if (taux > 0) {
                var tauxtva = 1 + parseFloat($scope.lignedocbce[i].tva) / 100;
                var pu = pttc / tauxtva;
                $scope.lignedocbce[i].remise = parseFloat(pttc / tauxtva / $scope.lignedocbce[i].qte).toFixed(3);
                $scope.lignedocbce[i].mnttva = parseFloat(pttc - pu).toFixed(3);
            }
            $scope.lignedocbce[i].puht = pu.toFixed(3);
            $scope.lignedocbce[i].mntttc = pttc.toFixed(3);

            $scope.lignedocbce[i].totalht = parseFloat(pu * parseFloat($scope.lignedocbce[i].qte)).toFixed(3);
            $scope.lignedocbce[i].fodec = parseFloat($scope.lignedocbce[i].totalht) * fodectotal;
        }
    }
    //__________________________________________________________________________Recherche article 
    $scope.ChoisirArticle = function () {
        $scope.param = {
            "designation": $('#designation').val()
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Choisarticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            AjoutHtmlAfterPrix(data, '#codearticle', '#designation', '#puht', '#tva');
        }, function myError(response) {
            alert("Erreur d'ajout");
        });
    }

    //__________________________________________________________________________Recherche article By demandeur 
    $scope.ChoisirArticleByDemandeur = function () {
        if ($('#documentachat_id_demandeur').val() && $('#documentachat_id_demandeur').val() != "") {
            $scope.param = {
                "designation": $('#designation').val(),
                "iddem": $('#documentachat_id_demandeur').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Choisarticlebydemandeur',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                AjoutHtmlAfterPrix(data, '#codearticle', '#designation', '#puht', '#idarticlestock');
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else
            alert('Il faut choisir un demandeur');
    }

    $scope.ChoisirArticleByMagasin = function () {
        var verif = "";
        if ($('#mag1').val() === "")
            verif = "Il faut choisir le magasin de déprat";
        if ($('#mag2').val() === "")
            verif = "Il faut choisir le magasin d'arrivée ";
        if ($('#mag1').val() === $('#mag2').val() && $('#mag1').val() != "" && $('#mag2').val() != "")
            verif = "Les deux magasins sont egaut ";
        if (verif === "") {
            $scope.param = {
                "designation": $('#designation').val(),
                "idmag1": $('#mag1').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Choisarticlebymagasin',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                // AjoutHtmlAfterTRansfert(data, '#codearticle', '#designation', '#qtemax');
                AjoutHtmlAfterPrix(data, '#codearticle', '#designation', '#qtemax', '#idarticlestock');
            }, function myError(response) {
                alert("Erreur d'ajout");
            });
        } else
            alert(verif);
    }
    $scope.AjouterLigne = function () {
        var fodec = 1;
        var totaltva = 0;
        var valeurfodec = 0;
        var mnttva = 0;
        var existe = 0;
        var mntttc = 0;
        var fodectotal = 0;
        var remise = 0;
        var taux = 0;
        var asj = 0;
        var valeurtva = 0;
        var idtva = 0;
        if ($scope.detailfrs.assujtva != '1') {
            asj = 0;
        } else
            asj = 1;
        if ($scope.detailfrs.fodec === '1') {
            fodec = 1 + parseFloat($scope.parametragesociete.valeurfodec);
            fodectotal = $scope.parametragesociete.valeurfodec;
        }
        if (asj === 1) {
            valeurtva = $('#tva option:selected').text();
            idtva = $('#tva').val();
        }
        qteret = parseFloat($('#quantite').val());
        nordre = $scope.lignedocbce.length + 1;
        if ($('#remise').val() != "") {
            taux = parseFloat($('#remise').val()) / 100;
            remise = $('#remise').val();
        }
        totalht = parseFloat(qteret * parseFloat($('#puht').val())).toFixed(3);
        totaltva = totalht * fodec;
        valeurfodec = parseFloat(totalht) * fodectotal;
        mntttc = $('#puht').val() * (1 + (parseFloat(valeurtva) / 100))
        mnttva = parseFloat($('#puht').val()) * fodec * (parseFloat(valeurtva) / 100);
        if ($('#designation').val() != "") {
            var comArr = eval($scope.lignedocbce);
            for (i = 0; i < comArr.length; i++) {
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    comArr[i].codearticle = $('#codearticle').val();
                    comArr[i].designation = $('#designation').val();
                    comArr[i].qte = $('#quantite').val();
                    comArr[i].puorigine = $('#puht').val();
                    comArr[i].puht = $('#puht').val();
                    comArr[i].mnttva = mnttva;
                    comArr[i].totalht = totalht;
                    comArr[i].totalhtva = totaltva;
                    comArr[i].fodec = valeurfodec;
                    comArr[i].remise = remise;
                    comArr[i].tauxremise = taux.toFixed(2);
                    comArr[i].tva = valeurtva;
                    comArr[i].idtva = idtva;
                    comArr[i].idmag = $('#mag').val();
                    comArr[i].magasin = $('#mag option:selected').text();
                    break;
                }
            }

            if (existe === 0) {
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': '',
                    'codearticle': $('#codearticle').val(),
                    'designation': $('#designation').val(),
                    'qte': qteret,
                    'puorigine': $('#puht').val(),
                    'puht': $('#puht').val(),
                    'mnttva': mnttva,
                    'mntttc': mntttc,
                    'totalht': totalht,
                    'totalhtva': totaltva,
                    'fodec': valeurfodec,
                    'remise': remise,
                    'tauxremise': taux,
                    'tva': valeurtva,
                    'idtva': idtva,
                    'idligne': '',
                    'iddoc': '',
                    'idmag': $('#mag').val(),
                    'magasin': $('#mag option:selected').text()
                });
            }
        }
        $scope.ChangerPrix();
        $scope.CalculTotal();
        $scope.CalculBaseTva();
        $scope.InaliserChamps();
    }
    //__________________________________________________________________________Inialiser les champs
    $scope.InaliserChamps = function () {
        $('#nordreid').val('');
        $('#codearticle').val('');
        $('#designation').val('');
        $('#quantite').val('');
        $('#puht').val('');
        $('#remise').val('');
        $('#tva').val('');
        if ($("#magtous").val() === "") {
            $('#mag').val('');
            $('#mag').trigger("chosen:updated");
        }
        if ($('#qtemax').val()) {
            $('#qtemax').val('');
        }
        if ($('#idarticlestock').val())
            $('#idarticlestock').val("");
    }
    $scope.SupprimerLigne = function (lignedoc) {
        var index = -1;
        var comArr = eval($scope.lignedocbce);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].codearticle === lignedoc.codearticle && comArr[i].norgdre === lignedoc.norgdre) {
                index = i;
                break;
            }
        }
        $scope.lignedocbce.splice(index, 1);
        $scope.CalculTotal();
    }
    $scope.RefrechTab = function () {
        for (i = 0; i < $scope.lignedocbce.length; i++) {

            $scope.lignedocbce[i].idmag = $("#magtous").val();
            $scope.lignedocbce[i].magasin = $("#magtous option:selected").text();
        }
    }
    $scope.MisAJour = function (lignedoc) {

        $('#nordreid').val(lignedoc.norgdre);
        $('#codearticle').val(lignedoc.codearticle);
        $('#designation').val(lignedoc.designation);
        $('#quantite').val(lignedoc.qte);
        $('#puht').val(lignedoc.puht);
        $('#remise').val((lignedoc.tauxremise * 100).toFixed(3));
        $('#tva').val(lignedoc.idtva);
        $('#mag').val(lignedoc.idmag);
        $('#mag').trigger("chosen:updated");
    }

    $("#magtous")
            .change(function () {
                if ($("#magtous").val() != "") {
                    $('#mag').val($("#magtous").val());
                    $('#mag').trigger("chosen:updated");
                }
            })
            .trigger("change");
    $("#mag2")
            .change(function () {

                if ($("#mag2").val() != "") {
                    $('#mag').val($("#mag2").val());
                    $('#mag').trigger("chosen:updated");
                }
            })
            .trigger("change");
    $scope.AjouterArticle = function () {
        $scope.param = {
            'numero': $('#article_numero').val(),
            'date': $('#article_datecreation').val(),
            'typestock': $('#article_id_typestock').val(),
            'famille': $('#article_id_famille').val(),
            'sfamille': $('#sfamille').val(),
            'nature': $('#article_id_nature').val(),
            'methode': $('#article_id_methode').val(),
            'designation': $('#article_designation').val(),
            'code': $('#article_codeart').val(),
            'idtva': $('#article_id_tva').val(),
            'idunite': $('#article_id_unite').val(),
            'codef': $('#article_codefamille').val(),
            'codesf': $('#article_codesf').val(),
            'codenature': $('#article_codenature').val()
        }
        $http({
            url: domaineapp + 'stock.php/article/Ajouterarticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert("Mise à jour fiche article effectuée avec succès");
            if (data.length > 0) {
                $('#codearticle').val(data[0].codeart);
                var comArr = eval($scope.lignedocbce);
                for (i = 0; i < comArr.length; i++) {
                    if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                        $scope.lignedocbce[i].idarticle = data[0].id;
                    }
                }
            }
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AjouterArticlenonExiste = function () {

        $('#article_designation').val($('#designation').val());
        $('#article_id_tva').val($('#tva').val());
        $('#article_id_tva').trigger("chosen:updated");
        $scope.RechercheArticleByDesignation();
    }
    $scope.RechercheArticleByDesignation = function () {
        $scope.param = {
            'designation': $('#designation').val()
        }
        $http({
            url: domaineapp + 'stock.php/article/Recherchearticle',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (data.length > 0) {
                article = data[0];
                //_____________________________________________Mis a jour code article & numero
                $('#article_codeart').val(article.codeart);
                $('#article_numero').val(article.numero);
                //______________________________________________Mis ajour famille
                $('#article_id_famille').val(article.id_famille);
                $('#article_id_famille').trigger("chosen:updated");
                $('#article_codefamille').val(article.codefamille);
                //_______________________________________________Mis ajour sous famille
                $('#sfamille').val(article.id_sousfamille);
                $('#sfamille').trigger("chosen:updated");
                $('#article_codesf').val(article.codesf); //article_id_sousfamille
                $('#article_id_sousfamille').val(article.id_sousfamille);
                $('#article_id_sousfamille').trigger("chosen:updated");

                //_______________________________________________Mis ajour Nature
                $('#article_id_nature').val(article.id_nature);
                $('#article_id_nature').trigger("chosen:updated");
                $('#article_codenature').val(article.codenature);
                //_______________________________________________Mis a jour Unite
                $('#article_id_unite').val(article.id_unite);
                $('#article_id_unite').trigger("chosen:updated");
                //_______________________________________________Mis a jour Unite
                $('#article_id_tva').val(article.id_tva);
                $('#article_id_tva').trigger("chosen:updated");
                //______________________________________________Mis a jour Méthode de valorisation
                $('#article_id_methode').val(article.id_methode);
                $('#article_id_methode').trigger("chosen:updated");
            }

        }, function myError(response) {
            alert(response);
        });

    }
    //__________________________________________________________________________Enregistrement Bon commande entrer
    $scope.AjouterBE = function (paramaction) {
        msg = "";
        if ($('#magtous').val() == "")
            msg = "Veuillez sélectionner le magasin";
        if ($('#nbexterne').val() == "")
            msg += "\n Veuillez sélectionner le BCES";

        if (msg == "") {
            $scope.param = {
                'lignedoc': $scope.lignedocbce,
                'docentete': $scope.totalfiche,
                'basetva': $scope.basetva,
                'numero': $('#numerobe').val(),
                'date': $('#datebe').val(),
                'frs': $scope.detailfrs,
                'iddocparent': $('#nbexterne').val(),
                'paramaction': paramaction,
                'idmag': $('#magtous').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Savedocument',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                if (data != "Erreur") {
                    document.location.href = 'showdocument/' + data;
                } else
                    alert("Erreur d'ajout : article n'existe pas");

            }, function myError(response) {
                alert(response);
            });
        } else
            alert(msg);
    }
    //__________________________________________________________________________Ajouter ligne bon de sortie
    $scope.AjouterLigneSortie = function () {
        var fodec = 1;
        var totaltva = 0;
        var valeurfodec = 0;
        var mnttva = 0;
        var existe = 0;
        var mntttc = 0;
        var fodectotal = 0;
        var remise = 0;
        var taux = 0;
        var asj = 0;
        var valeurtva = 0;
        var idtva = 0;
        if ($scope.detailfrs.assujtva != '1') {
            asj = 0;
        } else
            asj = 1;
        if ($scope.detailfrs.fodec === '1') {
            fodec = 1 + parseFloat($scope.parametragesociete.valeurfodec);
            fodectotal = $scope.parametragesociete.valeurfodec;
        }
        if (asj === 1) {
            valeurtva = $('#tva option:selected').text();
            idtva = $('#tva').val();
        }
        qteret = parseFloat($('#quantite').val());
        nordre = $scope.lignedocbce.length + 1;
        if ($('#remise').val() != "") {
            taux = parseFloat($('#remise').val()) / 100;
            remise = $('#remise').val();
        }
        totalht = parseFloat(qteret * parseFloat($('#puht').val())).toFixed(3);
        totaltva = totalht * fodec;
        valeurfodec = parseFloat(totalht) * fodectotal;
        mntttc = $('#puht').val() * (1 + (parseFloat(valeurtva) / 100))
        mnttva = parseFloat($('#puht').val()) * fodec * (parseFloat(valeurtva) / 100);
        if ($('#designation').val() != "") {
            var comArr = eval($scope.lignedocbce);
            for (i = 0; i < comArr.length; i++) {
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    comArr[i].codearticle = $('#codearticle').val();
                    comArr[i].designation = $('#designation').val();
                    comArr[i].qte = $('#quantite').val();
                    comArr[i].puorigine = $('#puht').val();
                    comArr[i].puht = $('#puht').val();
                    comArr[i].mnttva = mnttva;
                    comArr[i].totalht = totalht;
                    comArr[i].totalhtva = totaltva;
                    comArr[i].fodec = valeurfodec;
                    comArr[i].remise = remise;
                    comArr[i].tauxremise = taux.toFixed(2);
                    comArr[i].tva = valeurtva;
                    comArr[i].idtva = idtva;
                    comArr[i].idmag = $('#mag').val();
                    comArr[i].magasin = $('#mag option:selected').text();
                    break;
                }
            }

            if (existe === 0) {
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': '',
                    'codearticle': $('#codearticle').val(),
                    'designation': $('#designation').val(),
                    'qte': qteret,
                    'puorigine': $('#puht').val(),
                    'puht': $('#puht').val(),
                    'mnttva': mnttva,
                    'mntttc': mntttc,
                    'totalht': totalht,
                    'totalhtva': totaltva,
                    'fodec': valeurfodec,
                    'remise': remise,
                    'tauxremise': taux,
                    'tva': valeurtva,
                    'idtva': idtva,
                    'idligne': '',
                    'iddoc': '',
                    'idmag': $('#mag').val(),
                    'magasin': $('#mag option:selected').text()
                });
            }
        }
        $scope.ChangerPrix();
        $scope.CalculTotal();
        $scope.CalculBaseTva();
        $scope.InaliserChamps();
    }
    $scope.AjouterBS = function () {
        if ($('#nbexterne').val() && $('#nbexterne').val() != "") {
            $scope.param = {
                'lignedoc': $scope.lignedocbce,
                'docentete': $scope.totalfiche,
                'numero': $('#numerobe').val(),
                'date': $('#datebe').val(),
                'iddemandeur': $('#documentachat_id_demandeur').val(),
                'iddoc': $('#nbexterne').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Savedocumentsortie',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                if (data != "Erreur") {

                    document.location.href = 'showdocument/' + data;
                } else
                    alert("Erreur d'ajout : article n'existe pas");

            }, function myError(response) {
                alert(response);
            });
        } else
            alert("Veuillez sélectionner bon commande interne");
    }

    //__________________________________________________________________________Inaliser filter
    $scope.InaliserFilterTypedoc = function () {

        $('#documentachat_filters_id_typedoc').empty();
        if ($('#id_typedoc').val() != 6) {
            $('#documentachat_filters_id_typedoc').append("<option  value=''></option>");
            if ($('#id_typedoc').val() === '10')
                $('#documentachat_filters_id_typedoc').append("<option selected='selected' value='10'>P.V. de Réception</option>");
            else
                $('#documentachat_filters_id_typedoc').append("<option  value='10'>P.V. de Réception</option>");
            if ($('#id_typedoc').val() === '11')
                $('#documentachat_filters_id_typedoc').append("<option selected='selected' value='11'>Bon de Sortie</option>");
            else
                $('#documentachat_filters_id_typedoc').append("<option  value='11'>Bon de Sortie</option>");
            if ($('#id_typedoc').val() === '13')
                $('#documentachat_filters_id_typedoc').append("<option selected='selected' value='13'>Bon de Transfert</option>");
            else
                $('#documentachat_filters_id_typedoc').append("<option  value='13'>Bon de Transfert</option>");
            if ($('#id_typedoc').val() === '12')
                $('#documentachat_filters_id_typedoc').append("<option selected='selected' value='12'>Bon de Retour</option>");
            else
                $('#documentachat_filters_id_typedoc').append("<option  value='12'>Bon de Retour</option>");
            if ($('#id_typedoc').val() === '14')
                $('#documentachat_filters_id_typedoc').append("<option selected='selected' value='14'>Avoir fournisseur</option>");
            else
                $('#documentachat_filters_id_typedoc').append("<option  value='14'>Avoir fournisseur</option>");
        } else {
            $('#documentachat_filters_id_typedoc').append("<option  value='6'>Bon de commande Interne</option>");
        }
        $("#documentachat_filters_id_typedoc").val(iddoctransfert).trigger("liszt:updated");
        $('#documentachat_filters_id_typedoc').trigger("chosen:updated");

    }

    //__________________________________________________________________________Inaliser et valider le transfer
    $scope.InializerTransfert = function (iddoctransfert, idfrs, iddoc) {

        $scope.param = {
            'idfrs': idfrs
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Listesbcommnadeexterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            // $scope.numeroboncommandes = data;
            lenght = data.length;
            $('#nbexterne').empty();
            for (i = 0; i < lenght; i++) {
                if (data[i].id === iddoctransfert)
                    $('#nbexterne').append("<option selected='selected' value='" + data[i].id + "'>" + data[i].numero + "-" + data[i].mntttc + "</option>");
                else
                    $('#nbexterne').append("<option  value='" + data[i].id + "'>" + data[i].numero + "-" + data[i].mntttc + "</option>");
            }
            $("#nbexterne").val(iddoctransfert).trigger("liszt:updated");
            $('#nbexterne').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
        if (iddoc != '') {
            $scope.param = {
                'iddoc': iddoc
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Listeslignesdocumentpv',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {

                data = response.data;

                $scope.CalculTotalAjout(data);
                $scope.CalculTotal();
                $scope.RechercherCode();

            }, function myError(response) {
                alert(response);
            });
        }
        if (iddoc == "") {
            $('#documentachat_id_frs').val(idfrs);
            $('#documentachat_id_frs').trigger("chosen:updated");
            $scope.param = {
                'iddoc': iddoctransfert
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Listeslignesbce',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {

                data = response.data;

                $scope.CalculTotalAjout(data);
                $scope.CalculTotal();
                $scope.RechercherCode();

            }, function myError(response) {
                alert(response);
            });
        }
    }

    //__________________________________________________________________________Bon de sortie
    $("#documentachat_id_demandeur")
            .change(function () {
                if ($("#documentachat_id_demandeur").val() != "") {


                    $scope.AfficheListesbcommnadeinterne($("#documentachat_id_demandeur").val());
                    $('#nbexterne').trigger("chosen:updated");
                }
            })
            .trigger("change");
    $scope.InialiserBonSortieByBCI = function (iddocparent, iddemandeur) {
        $("#documentachat_id_demandeur").val(iddemandeur).trigger("liszt:updated");
        $('#documentachat_id_demandeur').trigger("chosen:updated");
        $scope.param = {
            'iddemandeur': iddemandeur
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Listesbcommnadeinterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            // $scope.numeroboncommandes = data;

            lenght = data.length;
            $('#nbexterne').empty();
            for (i = 0; i < lenght; i++) {
                if (data[i].id === iddocparent) {
                    $('#nbexterne').append("<option selected='selected' value='" + data[i].id + "'>" + data[i].numero + "</option>");
                } else {
                    $('#nbexterne').append("<option  value='" + data[i].id + "'>" + data[i].numero + "</option>");
                }


            }
            $("#nbexterne").val(iddocparent).trigger("liszt:updated");
            $('#nbexterne').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
        $('#nbexterne').val(iddocparent);
        $('#nbexterne').trigger("chosen:updated");
    }
    $scope.AfficheListesbcommnadeinterne = function (iddemandeur) {
        $scope.param = {
            'iddemandeur': iddemandeur
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Listesbcommnadeinterne',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            // $scope.numeroboncommandes = data;
            lenght = data.length;
            $('#nbexterne').empty();
            for (i = 0; i < lenght; i++) {
                $('#nbexterne').append("<option value='" + data[i].id + "'>" + data[i].numero + "</option>");
            }
            $("#nbexterne").val('').trigger("liszt:updated");
            $('#nbexterne').trigger("chosen:updated");
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AjouterLigneBcI = function () {
        if ($('#nbexterne').val()) {
            $scope.param = {
                'iddoc': $('#nbexterne').val(),
                'idmag': $('#magtous').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Listeslignesbcinterne',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                if ($('#magtous').val() != "") {
                    data = response.data;
                    $scope.CalculTotalAjoutBCI(data);
                    $scope.CalculTotalBCI();
                    $scope.RechercherCode();
                } else
                    alert('Il faut ajouter le magasin');
            }, function myError(response) {
                alert(response);
            });
        }
    }
    $scope.CalculTotalAjoutBCI = function (data) {
        for (i = 0; i < data.length; i++) {
            var k = 0;
            if ($scope.lignedocbce.length > 0) {
                if (data[i].codeart) {
                    for (h = 0; h < $scope.lignedocbce.length; h++) {
                        if ($scope.lignedocbce[h].codearticle) {
                            if ($scope.lignedocbce[h].codearticle.trim() === data[i].codeart.trim())
                                k++;
                        }
                    }
                }
            }
            if (k === 0) {
                nordre = $scope.lignedocbce.length + 1;
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': data[i].idarticle,
                    'codearticle': data[i].codeart,
                    'designation': data[i].designation,
                    'qte': parseFloat(data[i].qtedemander),
                    'puorigine': data[i].pamp,
                    'puht': data[i].pamp,
                    'mnttva': '',
                    'mntttc': data[i].pamp,
                    'totalht': '',
                    'totalhtva': '',
                    'fodec': '',
                    'remise': '',
                    'tauxremise': 0,
                    'tva': '',
                    'idtva': '',
                    'idligne': data[i].idligne,
                    'iddoc': data[i].id_doc,
                    'idmag': data[i].idmag,
                    'magasin': data[i].libelle
                });
            } else {
                $scope.RefrechTab();
            }
        }
    }
    $scope.CalculTotalBCI = function () {
        var tttcnet = 0;
        for (i = 0; i < $scope.lignedocbce.length; i++) {
            tttcnet = tttcnet + ($scope.lignedocbce[i].mntttc * parseFloat($scope.lignedocbce[i].qte));
        }

        $scope.totalfiche = {
            'thtxa': '',
            'totalremise': '',
            'fodec': '',
            'tht': '',
            'ttva': '',
            'ttcnet': tttcnet.toFixed(3)
        }

        $scope.CalculBaseTva();
    }

    //___________________________________________________________________________ bon de Transfert
    $scope.AjouterLigneTransfert = function () {
        var qtemax = parseFloat($('#qtemax').val());
        var qte = parseFloat($('#quantite').val());
        var existe = 0;
        var verif = "";
        var nordre = 0;
        if (qtemax < qte && qtemax > 0)
            verif = "Erreur au niveau de quantité";

        if ($('#designation').val() != "" && verif === "") {
            var comArr = eval($scope.lignedocbce);
            nordre = comArr.length + 1;
            for (i = 0; i < comArr.length; i++) {
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    comArr[i].idarticle = $('#idarticlestock').val();
                    comArr[i].codearticle = $('#codearticle').val();
                    comArr[i].designation = $('#designation').val();
                    comArr[i].qte = $('#quantite').val();
                    comArr[i].qte = qtemax;
                    comArr[i].idmag = $('#mag').val();
                    comArr[i].magasin = $('#mag option:selected').text();
                    break;
                }
            }

            if (existe === 0) {
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': $('#idarticlestock').val(),
                    'codearticle': $('#codearticle').val(),
                    'designation': $('#designation').val(),
                    'qte': qte,
                    'qtemax': qtemax,
                    'idmag': $('#mag').val(),
                    'magasin': $('#mag option:selected').text()
                });
            }

        } else {
            alert('Probléme d\'ajout ');
        }

        $scope.InaliserChamps();
    }
    //____________________________________________________________________________Valider Transfert
    $scope.AjouterBT = function () {

        $scope.param = {
            'lignedoc': $scope.lignedocbce,
            'numero': $('#numerobe').val(),
            'date': $('#datebe').val(),
            'idmagdepart': $('#mag1').val(),
            'idmagarrive': $('#mag2').val(),
            'ref': $('#documentachat_reference').val()
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Savedocumenttransfert',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
            if (data != "Erreur") {
                document.location.href = 'showdocument/' + data;
            } else
                alert("Erreur d'ajout : article n'existe pas");

        }, function myError(response) {
            alert(response);
        });

    }
    //___________________________________________________________________________Ajouter ligne retour
    $scope.AjouterLigneRetour = function () {

        var existe = 0;
        var mntttc = 0;
        var qteret = 0;
        var qtemax = 0;
        var idarticlesite = "";
        var idlignedoc = "";
        var iddoc = "";
        var numerobsi = "";
        var str = $('#idarticlestock').val().split('/');
        qteret = parseFloat($('#quantite').val());
        nordre = $scope.lignedocbce.length + 1;
        qtemax = str[3];
        idarticlesite = str[0];
        idlignedoc = str[1];
        iddoc = str[2];
        numerobsi = str[4];
        if ($('#designation').val() != "" && qtemax >= qteret) {
            var comArr = eval($scope.lignedocbce);
            for (i = 0; i < comArr.length; i++) {
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    comArr[i].codearticle = $('#codearticle').val();
                    comArr[i].designation = $('#designation').val();
                    comArr[i].qte = $('#quantite').val();
                    comArr[i].idarticle = idarticlesite;
                    comArr[i].idligne = idlignedoc;
                    comArr[i].iddoc = iddoc;
                    comArr[i].pamp = $('#puht').val();
                    comArr[i].numerobsi = numerobsi;
                    comArr[i].idmag = $('#mag').val();
                    comArr[i].magasin = $('#mag option:selected').text();
                    break;
                }
            }

            if (existe === 0) {
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': idarticlesite,
                    'codearticle': $('#codearticle').val(),
                    'designation': $('#designation').val(),
                    'qte': qteret,
                    'pamp': $('#puht').val(),
                    'idligne': idlignedoc,
                    'numerobsi': numerobsi,
                    'iddoc': iddoc,
                    'idmag': $('#mag').val(),
                    'magasin': $('#mag option:selected').text()
                });
            }
        }

        $scope.CalculTotalBR();
        $scope.InaliserChamps();
    }
    $scope.CalculTotalBR = function () {
        var tttcnet = 0;
        for (i = 0; i < $scope.lignedocbce.length; i++) {
            tttcnet = tttcnet + ($scope.lignedocbce[i].pamp * parseFloat($scope.lignedocbce[i].qte));
        }

        $scope.totalfiche = {
            'thtxa': '',
            'totalremise': '',
            'fodec': '',
            'tht': '',
            'ttva': '',
            'ttcnet': tttcnet.toFixed(3)
        }
    }
    //____________________________________________________________________________Valider Fiche retour
    $scope.AjouterBRetout = function () {

        $scope.param = {
            'lignedoc': $scope.lignedocbce,
            'numero': $('#numerobe').val(),
            'date': $('#datebe').val(),
            'ref': $('#documentachat_reference').val(),
            'iddemandeur': $('#documentachat_id_demandeur').val(),
            'docentete': $scope.totalfiche
        }
        $http({
            url: domaineapp + 'stock.php/documentachat/Savedocumentretour',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
            if (data != "Erreur") {

                document.location.href = 'showdocument/' + data;
            } else
                alert("Erreur d'ajout : article n'existe pas");

        }, function myError(response) {
            alert(response);
        });

    }

    //___________________________________________________________________________Avoir fournisseur
    $scope.AjouterLignePvdereception = function () {
        if ($('#nbexterne').val()) {
            $scope.param = {
                'iddoc': $('#nbexterne').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Listeslignespvavoir',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {

                data = response.data;

                $scope.CalculTotalAjoutAvoir(data);
                $scope.CalculTotalAvoir();
                // $scope.RechercherCode();

            }, function myError(response) {
                alert(response);
            });
        }
    }
    $scope.CalculTotalAjoutAvoir = function (data) {
        var qteret = 0;
        var nordre = 0;
        for (i = 0; i < data.length; i++) {
            nordre = $scope.lignedocbce.length + 1;
            var k = 0;
            if ($scope.lignedocbce.length > 0) {
                if (data[i].codearticle) {
                    for (h = 0; h < $scope.lignedocbce.length; h++) {
                        if ($scope.lignedocbce[h].codearticle) {
                            if ($scope.lignedocbce[h].codearticle.trim() === data[i].codearticle.trim())
                                k++;
                        }
                    }
                }
            }
            if (k === 0) {
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': data[i].id_articlestock,
                    'codearticle': data[i].codearticle,
                    'designation': data[i].designationarticle,
                    'qte': data[i].qte,
                    'mntttc': data[i].mntttc,
                    'idligne': data[i].id,
                    'iddoc': data[i].id_doc,
                    'idmag': data[i].id_mag,
                    'magasin': data[i].libelle
                });
            }
        }
    }
    $scope.CalculTotalAvoir = function () {

        var tttcnet = 0;
        for (i = 0; i < $scope.lignedocbce.length; i++) {
            tttcnet = tttcnet + ($scope.lignedocbce[i].mntttc * parseFloat($scope.lignedocbce[i].qte));
        }

        $scope.totalfiche = {
            'thtxa': '',
            'totalremise': '',
            'fodec': '',
            'tht': '',
            'ttva': '',
            'ttcnet': tttcnet.toFixed(3)
        }
    }
    $scope.MisAJourAoir = function (lignedoc) {
        $('#nordreid').val(lignedoc.norgdre);
        $('#codearticle').val(lignedoc.codearticle);
        $('#designation').val(lignedoc.designation);
        $('#quantite').val(lignedoc.qte);
        $('#puht').val(lignedoc.mntttc);
    }
    $scope.AjouterLigneAvoir = function () {

        var existe = 0;

        var qteret = 0;
        var qtemax = 0;
        var idarticlesite = "";
        var idlignedoc = "";
        var iddoc = "";
        var numerobsi = "";

        if ($('#designation').val() != "" && qtemax >= qteret) {
            var comArr = eval($scope.lignedocbce);
            for (i = 0; i < comArr.length; i++) {
                if (comArr[i].designation.trim() === $('#designation').val().trim()) {
                    existe = 1;
                    comArr[i].qte = $('#quantite').val();
                    break;
                }
            }

            if (existe === 0) {
                $scope.lignedocbce.push({
                    'norgdre': nordre,
                    'idarticle': idarticlesite,
                    'codearticle': $('#codearticle').val(),
                    'designation': $('#designation').val(),
                    'qte': $('#quantite').val(),
                    'mntttc': $('#puht').val(),
                    'idligne': idlignedoc,
                    'numerobsi': numerobsi,
                    'iddoc': iddoc,
                    'idmag': $('#mag').val(),
                    'magasin': $('#mag option:selected').text()
                });
            }

        }

        $scope.CalculTotalAvoir();
        $scope.InaliserChamps();
    }
    $scope.SupprimerLigneAvoir = function (lignedoc) {
        var index = -1;
        var comArr = eval($scope.lignedocbce);
        for (var i = 0; i < comArr.length; i++) {
            if (comArr[i].codearticle === lignedoc.codearticle && comArr[i].norgdre === lignedoc.norgdre) {
                index = i;
                break;
            }
        }
        $scope.lignedocbce.splice(index, 1);
        $scope.CalculTotalAvoir();
    }
    $scope.AjouterBAvoir = function () {
        if ($('#nbexterne').val() != "" && $('#documentachat_id_frs').val() != "" && $scope.lignedocbce.length > 0) {
            $scope.param = {
                'lignedoc': $scope.lignedocbce,
                'numero': $('#numerobe').val(),
                'date': $('#datebe').val(),
                'ref': $('#documentachat_reference').val(),
                'idfrs': $('#documentachat_id_frs').val(),
                'docentete': $scope.totalfiche,
                'iddoc': $('#nbexterne').val()
            }
            $http({
                url: domaineapp + 'stock.php/documentachat/Savedocumentavoir',
                method: "POST",
                data: $scope.param,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function mySucces(response) {
                data = response.data;
                $('#btnvalider').attr('class', 'btn btn-outline btn-danger');
                if (data != "Erreur") {

                    document.location.href = 'showdocument/' + data;
                } else
                    alert("Erreur d'ajout : article n'existe pas");

            }, function myError(response) {
                alert(response);
            });
        } else {
            alert('Erreur d\'ajout');
        }

    }
});