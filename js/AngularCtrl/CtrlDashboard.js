var domaineapp = "http://" + window.location.hostname + "/";
const { debounceTime,distinctUntilChanged,switchMap,map} =Rx.operators;
const { Subject } = Rx;
app.controller('CtrlDashboard', function($scope, $http) {
    $scope.offset = 1;
    $scope.subs = [];
    $scope.inc = new Subject();
    window.addEventListener('beforeunload', function(event) {
        $scope.subs.forEach(s=>s.unsubscribe());
        $scope.subs = [];

      });
    $scope.subs.push($scope.inc.pipe(
        debounceTime(200),
        map(()=>$scope.offset),
        distinctUntilChanged(),
    ).subscribe(()=>{
        $scope.scollingCommande();
        $scope.scollingCommandeBDC(); 
        $scope.scollingCommandeContrat();
        $scope.scollingCommandeBCIContrat();
        
        
    }))
    $scope.scollingCommande = function() {
        $scope.param = {
            offset: $scope.offset,
            start_date: $('#start').val(),
            end_date: $('#end').val(),
            id_bci: null
        }
        if (!isNaN(parseInt($('#id_bci').val())))
            $scope.param['id_bci'] = parseInt($('#id_bci').val());

        $http({
            url: domaineapp + 'facturation.php/Accueil/getcommandebypager',
            method: "POST",
            data: $scope.param
        }).then(function mySucces(response) {
            data = response.data;
            $('#listCommandes tbody').append(data);
            if(data!="\n")
                $scope.offset++;
        }, function myError(response) {
            console.log(response);
        });
    }

$scope.scollingCommandeBDC = function() {
        $scope.param = {
            offset: $scope.offset,
            start_date: $('#start').val(),
            end_date: $('#end').val(),
            id_bci: null
        }
        if (!isNaN(parseInt($('#id_bci').val())))
            $scope.param['id_bci'] = parseInt($('#id_bci').val());

        $http({
            url: domaineapp + 'facturation.php/Accueil/getcommandebypagerBDC',
            method: "POST",
            data: $scope.param
        }).then(function mySucces(response) {
            data = response.data;
            $('#listCommandesBDC tbody').append(data);
            if(data!="\n")
                $scope.offset++;
        }, function myError(response) {
            console.log(response);
        });
    }
    
    $scope.scollingCommandeBDCReg = function() {
        $scope.param = {
            offset: $scope.offset,
            start_date: $('#start').val(),
            end_date: $('#end').val(),
            id_bci: null
        }
        if (!isNaN(parseInt($('#id_bci').val())))
            $scope.param['id_bci'] = parseInt($('#id_bci').val());

        $http({
            url: domaineapp + 'facturation.php/Accueil/getcommandebypagerBDCReg',
            method: "POST",
            data: $scope.param
        }).then(function mySucces(response) {
            data = response.data;
            $('#listCommandesBDCReg tbody').append(data);
            if(data!="\n")
                $scope.offset++;
        }, function myError(response) {
            console.log(response);
        });
    }
    
     $scope.scollingCommandeContrat = function() {
        $scope.param = {
            offset: $scope.offset,
            start_date: $('#start').val(),
            end_date: $('#end').val(),
            id_bci: null
        }
        if (!isNaN(parseInt($('#id_bci').val())))
            $scope.param['id_bci'] = parseInt($('#id_bci').val());

        $http({
            url: domaineapp + 'facturation.php/Accueil/getcommandebypagerContrat',
            method: "POST",
            data: $scope.param
        }).then(function mySucces(response) {
            data = response.data;
            $('#listCommandescontrat tbody').append(data);
            if(data!="\n")
                $scope.offset++;
        }, function myError(response) {
            console.log(response);
        });
    }
    
     $scope.scollingCommandeBCIContrat = function() {
        $scope.param = {
            offset: $scope.offset,
            start_date: $('#start').val(),
            end_date: $('#end').val(),
            id_bci: null
        }
        if (!isNaN(parseInt($('#id_bci').val())))
            $scope.param['id_bci'] = parseInt($('#id_bci').val());

        $http({
            url: domaineapp + 'facturation.php/Accueil/getcommandebypagerBCIContrat',
            method: "POST",
            data: $scope.param
        }).then(function mySucces(response) {
            data = response.data;
            $('#listCommandesBCIcontrat tbody').append(data);
            if(data!="\n")
                $scope.offset++;
        }, function myError(response) {
            console.log(response);
        });
    }
});
app.directive('scrolly', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var raw = element[0];

            element.bind('scroll', function() {
                //console.log(raw.scrollTop + '+' + raw.offsetHeight + '==' + raw.scrollHeight);
                const x= raw.scrollTop + raw.offsetHeight - raw.scrollHeight;
                if (x>=0 && x<=20) { //at the bottomp
                    //scope.offset++;
                    scope.inc.next(1);
                    //scope.$apply(attrs.scrolly);
                }
            })
        }
    }

});