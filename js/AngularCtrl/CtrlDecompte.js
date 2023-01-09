var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('myCtrldecompte', function ($scope, $http) {

    $scope.totalhtax = 0;
    $scope.id_s = "";
    $scope.sousdetails = [];
    $scope.DetaisPrix = {};
    $scope.AfficheSousDetails = function (iddetail) {
        $scope.param = {
            'iddetail': iddetail
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Affichesousdetailbydetail',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            $scope.sousdetails = data;
            $scope.id_s = "";
            for (i = 0; i < $scope.sousdetails.length; i++) {
                var position = $scope.id_s.indexOf($scope.sousdetails[i].idsousdetail);
                if (position < 0)
                    $scope.id_s += $scope.sousdetails[i].idsousdetail + ";";

            }
            $scope.CalculerHtax(iddetail);
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.CalculerCumule = function (idsousdetail, qtemax, prixunitaire, iddetail) {
        var position = $scope.id_s.indexOf(idsousdetail);
        if (position < 0)
            $scope.id_s += idsousdetail + ";";

        var qte_mois = $('#qtedumois' + idsousdetail).val(); //alert(qte_mois);
        var qte_ant = $('#qteant' + idsousdetail).val();
        var qte_cumuler = parseFloat(qte_mois) + parseFloat(qte_ant);
        var qte_maxumum = parseFloat(qtemax);
        var total_unitaire = 0;
        if (qte_cumuler <= qte_maxumum) {
            $('#qtecumule' + idsousdetail).val(qte_cumuler);
            total_unitaire = qte_cumuler * parseFloat(prixunitaire);
            $('#total' + idsousdetail).val(total_unitaire.toFixed(3));
            $scope.rechercheTableaux(idsousdetail, qte_mois, qte_cumuler, total_unitaire);
            $scope.CalculerHtax(iddetail);
        } else
            $('#qtedumois' + idsousdetail).val('');
    }
    $scope.CalculerHtax = function (iddetail) {
        $scope.totalhtax = 0;
        var array = $scope.id_s.split(";");
        var rrr = 0;
        var total_apres_rrr = 0;
        var tva = $('#detail_tva' + iddetail).val().replace("%", "");
        var totalttc = 0;
        var avance = parseFloat($('#avtxt' + iddetail).val());
        var mnt_avance = 0;
        var retnue = parseFloat($('#retenuetxt' + iddetail).val());
        var mntretenue = 0;
        var totalttc_a_av_r = 0;
        var netapayer = 0;
        var htva = 0;
        var tva_payer = 0;
        for (i = 0; i < array.length; i++) {
            if ($('#total' + array[i]).val())
                $scope.totalhtax += parseFloat($('#total' + array[i]).val());
        }

        $('#detail_totalhtva' + iddetail).val($scope.totalhtax.toFixed(3));
        $scope.DetaisPrix.totalhtax = $scope.totalhtax.toFixed(3);

        rrr = $scope.totalhtax * (parseFloat($('#rrrtxt' + iddetail).val()) / 100);
        $scope.DetaisPrix.rrr = rrr.toFixed(3);

        total_apres_rrr = $scope.totalhtax - rrr;
        $scope.DetaisPrix.totalapresrrr = total_apres_rrr.toFixed(3);
        $('#detail_rrr' + iddetail).val(rrr.toFixed(3));
        $('#detail_totalaprrr' + iddetail).val(total_apres_rrr.toFixed(3));

        totalttc = parseFloat(total_apres_rrr) * (1 + (tva / 100));
        $('#detail_ttcnet' + iddetail).val(totalttc.toFixed(3));
        $scope.DetaisPrix.totalttc = totalttc.toFixed(3);

        mnt_avance = totalttc * (avance / 100);
        $('#mntavnace' + iddetail).val(mnt_avance.toFixed(3));
        $scope.DetaisPrix.mntavance = mnt_avance.toFixed(3);

        mntretenue = totalttc * (retnue / 100);
        $('#mntretenue' + iddetail).val(mntretenue.toFixed(3));
        $scope.DetaisPrix.mntretenue = mntretenue.toFixed(3);

        totalttc_a_av_r = totalttc - mnt_avance - mntretenue;
        $('#txttotal' + iddetail).val(totalttc_a_av_r.toFixed(3));
        $scope.DetaisPrix.totalapresavance = totalttc_a_av_r.toFixed(3);

        $scope.DetaisPrix.deponseAntirieur = parseFloat($('#deponseantiriers' + iddetail).val()).toFixed(3);
        netapayer = parseFloat(totalttc_a_av_r) - parseFloat($('#deponseantiriers' + iddetail).val());
        if (Math.abs(parseFloat(netapayer).toFixed(3)) == 0)
            netapayer = 0;
        $('#netapyerttc' + iddetail).val(parseFloat(netapayer).toFixed(3));
        $scope.DetaisPrix.netapyare = parseFloat(netapayer).toFixed(3);

        htva = netapayer / (1 + (tva / 100));
        $('#Htva' + iddetail).val(htva.toFixed(3));
        $scope.DetaisPrix.totalhtva = htva.toFixed(3);
        $scope.DetaisPrix.tauxtva = tva;
        tva_payer = netapayer - htva;
        $('#tvapayer' + iddetail).val(tva_payer.toFixed(3));
        $scope.DetaisPrix.tvapayer = tva_payer.toFixed(3);

        $scope.DetaisPrix.idtva = $('#detail_id_tva' + iddetail).val();
    }
    $scope.ValiderDecompte = function (iddetail) {
        $scope.DetaisPrix.iddetail = iddetail;
        $scope.param = {
            'sousdetail': $scope.sousdetails,
            'details': $scope.DetaisPrix
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Savedecompte',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;

            alert("Mise à jour effectuée avec succès");
            location.reload();
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.rechercheTableaux = function (idsousdetail, qtemois, qtecumuler, totalht) {
        for (i = 0; i < $scope.sousdetails.length; i++) {
            if ($scope.sousdetails[i].idsousdetail === idsousdetail) {
                $scope.sousdetails[i].qtemois = qtemois;
                //alert($scope.sousdetails[i].qtemois);
                $scope.sousdetails[i].qtecumule = qtecumuler;
                //alert($scope.sousdetails[i].qtecumule);
                $scope.sousdetails[i].totalht = totalht;
                //alert($scope.sousdetails[i].totalht);
            }
        }
    }
});

app.controller('myCtrlios', function ($scope, $http) {

    //$('#ordredeservice_description').ckeditor();
    $scope.DesigneCheckeditor = function (id) {

        $("#tab" + id + ' #ordredeservice_description').ckeditor();
    }
    $scope.AjouterIos = function (id, idtypeos) {
        // alert($('#ordredeservice_dateios').val() + '/' + $('#ordredeservice_object').val()+'/'+$('#ordredeservice_description').val());
        //alert(idtypeos);
        $scope.param = {
            'dat': $('#tab' + id + ' #ordredeservice_dateios').val(),
            'obj': $('#tab' + id + ' #ordredeservice_object').val(),
            'ref': $('#tab' + id + ' #ordredeservice_referece').val(),
            'desc': $('#tab' + id + ' #ordredeservice_description').val(),
            'typeav': idtypeos,
            'id': id
        }
        $http({
            url: domaineapp + 'marchee.php/ordredeservice/Misajourfiche',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (idtypeos === 1)
                alert('La date du commencement du projet crée avec succès');
            if (idtypeos === 4)
                alert('l\'arrêt du projet crée avec succès');
            if (idtypeos === 5)
                alert('la reprise du projet du projet crée avec succès');
            if (idtypeos === 6)
                alert('OS Divers crée avec succès');
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.AjouterAvenant = function (id) {
        // alert($('#ordredeservice_dateios').val() + '/' + $('#ordredeservice_object').val()+'/'+$('#ordredeservice_description').val());
        $scope.param = {
            'dat': $('#ordredeservice_dateios').val(),
            'obj': $('#ordredeservice_object').val(),
            'ref': $('#ordredeservice_referece').val(),
            'desc': $('#ordredeservice_description').val(),
            'typeav': "avenant",
            'id': id
        }
        $http({
            url: domaineapp + 'marchee.php/ordredeservice/Misajourfiche',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert('Avenant type date  crée avec succès');
        }, function myError(response) {
            alert(response);
        });
    }
    $scope.Misajourfichebinificiare = function (id) {
        $scope.param = {
            'dprovi': $('#lots_datereceptionprevesoire').val(),
            'delaiexecution': $('#lots_delaidexucution').val(),
            'dealijustifier': $('#lots_periodejustifier').val(),
            'delaicontra': $('#lots_delaicontractuelle').val(),
            'piriodereel': $('#lots_pireodereelexecution').val(),
            'retard': $('#lots_pirioderetard').val(),
            'delaigarantie': $('#lots_delaigarantie').val(),
            'id': id
        }
        $http({
            url: domaineapp + 'marchee.php/lots/Misajourfichelots',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert('Mise à jour effectuée avec succès');
            location.reload();
        }, function myError(response) {
            alert(response);
        });
    }

    //_________________________________________________________________________calculer delai de retard
    $scope.CalculerRetard = function () {
        var retard_justifier = 0;
        if ($('#lots_periodejustifier').val() && $('#lots_periodejustifier').val() != "")
            retard_justifier = $('#lots_periodejustifier').val();
        // alert(retard_justifier);
        var delai_contractuelle = 0;
        if ($('#lots_delaicontractuelle').val() && $('#lots_delaicontractuelle').val() != "")
            delai_contractuelle = $('#lots_delaicontractuelle').val();
        var delai_execution = 0;
        if ($('#lots_delaidexucution').val() && $('#lots_delaidexucution').val() != "")
            delai_execution = $('#lots_delaidexucution').val();
        var periode_reel = 0;
        //        if ($('#lots_pireodereelexecution').val() && $('#lots_pireodereelexecution').val() != "")
        periode_reel = parseInt(retard_justifier) + parseInt(delai_execution);
        $('#lots_pireodereelexecution').val(periode_reel);
        var p_retard = 0;
        p_retard = Math.abs(parseInt(delai_contractuelle) - parseInt(periode_reel));
        $('#lots_pirioderetard').val(p_retard);

    }
    $scope.CalculerTotalPenaliter = function () {

        if ($('#lots_datereceptionprevesoire').val()) {
            var p1 = 0;
            if ($('#mntp1').val() && $('#mntp1').val() != "")
                p1 = parseFloat($('#mntp1').val());
            var p2 = 0;
            if ($('#mntp2').val() && $('#mntp2').val() != "")
                p2 = parseFloat($('#mntp2').val());
            var mnt = parseFloat($('#lots_ttcnet').val());
            var nbjour = parseInt($('#lots_pirioderetard').val());

            var s1 = 0,
                    s2 = 0;
            s1 = p1 * nbjour * mnt;
            s2 = mnt * (p2 / 100);
            // alert(s1 + '/' + s2);
            if (s1 < s2)
                $('#mnt_pinaliter').val(s1);
            else
                $('#mnt_pinaliter').val(s2);
        }
    }
    $scope.CalculerDelai = function () {

        var d1 = new Date($('#lots_dateoservice').val());
        var d2 = new Date($('#lots_datereceptionprevesoire').val());

        var diff = 0;
        if (d1 && d2) {
            diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
        }
        $('#lots_delaidexucution').val(diff);
    }

    $('#lots_datereceptionprevesoire').change(function () {
        $scope.CalculerDelai();
        $scope.CalculerRetard();
    });
    $('#lots_periodejustifier').change(function () {
        $scope.CalculerRetard();
    });
    $('#lots_delaicontractuelle').change(function () {
        $scope.CalculerRetard();
    });
    $scope.CalculerTotalPenaliter();
    $scope.ValiderAttachementDocument = function (idcourrier) {
        var id = 'piecejoint_chemin' + idcourrier;
        var file_data = document.getElementById(id);
        var form_data = new FormData();
        form_data.append('fileSelected', file_data.files[0]);
        form_data.append('idcourrier', idcourrier);
        $.ajax({
            url: domaineapp + 'marchee.php/ordredeservice/Uploaderfile', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {
                alert(php_script_response); // display response from the PHP script, if any
                window.location.reload();
            }
        });
    }
});
app.controller('myCtrlioscontrat', function ($scope, $http) {
    $scope.DesigneCheckeditor = function (id) {
        $("#tab" + id + ' #ordredeservicecontratachat_description').ckeditor();
    }
    $scope.AjouterIos = function (id, idtypeos) {
        $scope.param = {
            'dat': $('#tab' + id + ' #ordredeservicecontratachat_dateios').val(),
            'obj': $('#tab' + id + ' #ordredeservicecontratachat_object').val(),
            'ref': $('#tab' + id + ' #ordredeservicecontratachat_reference').val(),
            'desc': $('#tab' + id + ' #ordredeservicecontratachat_description').val(),
            'typeav': idtypeos,
            'id': id
        }
        $http({
            url: domaineapp + 'achats_dev.php/ordredeservicecontratachat/misajourfiche',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            if (idtypeos === 1)
                alert('La date du commencement du projet crée avec succès');
            if (idtypeos === 4)
                alert('l\'arrêt du projet crée avec succès');
            if (idtypeos === 5)
                alert('la reprise du projet du projet crée avec succès');
            if (idtypeos === 6)
                alert('OS Divers crée avec succès');
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.ValiderPenaliteContratAchat = function (id) {
        $scope.param = {
            'cautionement': $('#contratachat_cautionement').val(),
            'retenuegaraentie': $('#contratachat_retenuegaraentie').val(),
            'avance': $('#contratachat_avance').val(),
            'penalite': $('#contratachat_penalite').val(),
            'maxpinalite': $('#contratachat_maxpinalite').val(),
            'datefin': $('#datefin_contrat').val(),
            'delai': $('#contratachat_delaicontratcuel').val(),
            'id': id
        }
        $http({
            url: domaineapp + 'achats.php/contratachat/MisajourPenaliteficheContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert('Mise à jour effectuée avec succès');
            location.reload();
        }, function myError(response) {
            alert(response);
        });
    }

    $scope.MisajourficheContrat = function (id) {
        $scope.param = {
            'dprovi': $('#contratachat_dateoservice').val(),
            'datereception': $('#contratachat_datereceptionprevesoire').val(),
            'delaiexecution': $('#contratachat_delaidexucution').val(),
            'dealijustifier': $('#contratachat_periodejustifier').val(),
            'delaicontra': $('#contratachat_delaicontractuelle').val(),
            'piriodereel': $('#contratachat_pireodereelexecution').val(),
            'retard': $('#contratachat_pirioderetard').val(),
            'mnt_pinaliter': $('#mnt_pinaliter').val(),
            'id': id
        }
        $http({
            url: domaineapp + 'achats.php/contratachat/MisajourficheContrat',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            alert('Mise à jour effectuée avec succès');
            location.reload();
        }, function myError(response) {
            alert(response);
        });
    }

    //_________________________________________________________________________calculer delai de retard
    $scope.CalculerRetard = function () {
        var retard_justifier = 0;
        if ($('#contratachat_periodejustifier').val() && $('#contratachat_periodejustifier').val() != "")
            retard_justifier = $('#contratachat_periodejustifier').val();
        // alert(retard_justifier);
        var delai_contractuelle = 0;
        if ($('#contratachat_delaicontractuelle').val() && $('#contratachat_delaicontractuelle').val() != "")
            delai_contractuelle = $('#contratachat_delaicontractuelle').val();
        var delai_execution = 0;
        if ($('#contratachat_delaidexucution').val() && $('#lots_delaidexucution').val() != "")
            delai_execution = $('#contratachat_delaidexucution').val();
        var periode_reel = 0;
        //        if ($('#lots_pireodereelexecution').val() && $('#lots_pireodereelexecution').val() != "")
        periode_reel = parseInt(retard_justifier) + parseInt(delai_execution);
        $('#contratachat_pireodereelexecution').val(periode_reel);
        var p_retard = 0;
        p_retard = Math.abs(parseInt(delai_contractuelle) - parseInt(periode_reel));
        $('#contratachat_pirioderetard').val(p_retard);
        $scope.CalculerTotalPenaliter();
    }
    $scope.CalculerTotalPenaliter = function () {

        if ($('#contratachat_datereceptionprevesoire').val()) {
            var p1 = 0;
            if ($('#mntp1').val() && $('#mntp1').val() != "")
                p1 = parseFloat($('#mntp1').val());
            var p2 = 0;
            if ($('#mntp2').val() && $('#mntp2').val() != "")
                p2 = parseFloat($('#mntp2').val());
            var mnt = parseFloat($('#contratachat_mnttc').val());
            var nbjour = parseInt($('#contratachat_pirioderetard').val());
            //  var id_contrat = $('#id_contrat').val();

            var montant_restant = $('#montant_contrat_restant').val();
            var s1 = 0,
                    s2 = 0;
            s1 = nbjour * montant_restant * p1 / 100;
            s2 = montant_restant * (p2 / 100);
            // alert(s1 + '/' + s2);
            if (s1 < s2)
                $('#mnt_pinaliter').val(parseFloat(s1).toFixed(3));
            else
                $('#mnt_pinaliter').val(parseFloat(s2).toFixed(3));
        }
    }
    $scope.CalculerDelai = function () {
        var d1 = new Date($('#contratachat_dateoservice').val());
        var d2 = new Date($('#contratachat_datereceptionprevesoire').val());
        var diff = 0;
        if (d1 && d2) {
            diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
        }
        $('#contratachat_delaidexucution').val(diff);

        $scope.CalculerTotalPenaliter();
    }

    $('#contratachat_datereceptionprevesoire').change(function () {
        $scope.CalculerDelai();
        $scope.CalculerRetard();
        $scope.CalculerTotalPenaliter();
    });
    $('#contratachat_periodejustifier').change(function () {
        $scope.CalculerRetard();
        //        $scope.CalculerTotalPenaliter();
    });
    $('#contratachat_delaicontractuelle').change(function () {
        $scope.CalculerRetard();
        //        $scope.CalculerTotalPenaliter();
    });
    $scope.CalculerTotalPenaliter();

    $scope.Calculerdatefincontrat = function () {
        var d1 = $('#datedebut').val();
        if ($('#datedebut').val() == '')
            d1 = $('#date_signature').val();
        if ($('#date_signature').val() == "")
            d1 = $('#date_creation').val();
        var delai = $('#contratachat_delaicontratcuel').val();
        var delai_justifier = $('#delaijustifie').val();
        $scope.param = {
            'd1': d1,
            'delai': delai,
            'delai_justifier': delai_justifier,
        }
        $http({
            url: domaineapp + 'achats.php/contratachat/misajourdate',
            method: "POST",
            data: $scope.param,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }).then(function mySucces(response) {
            data = response.data;
            //            $('#date_fincalcule').val(data);
            $('#datefin_contrat').val(data);
        }, function myError(response) {
            alert(response);
        });
    }

    $('#contratachat_delaicontratcuel').change(function () {
        $scope.Calculerdatefincontrat();

    });

});