
var domaineapp = 'http://' + window.location.hostname + '/';
app.controller('CtrlNotification', function ($scope, $http) {
        $scope.docs = [];
        $scope.subs = [];
        window.addEventListener('beforeunload', function (event) {
                $scope.subs.forEach(s => s.unsubscribe());
                $scope.subs = [];
        });

        $scope.NotifBDCRegrouppe = function () {
                const onsuccess = (response) => {
                        const data = response.data;
                        $scope.documentsAchatBDCRegroupe = data;
                        $scope.countdocumentsAchatBDCRegroupe = data.length;
                }
                const failure = (response) => {
                        console.log('erreur');
                }
                $scope.baseNotif(
                        domaineapp + 'tresorie.php/documentachat/getNewOrdonnaceBDCRegroupe',
                        {},
                        onsuccess,
                        failure
                )
        }
        $scope.NotifComptabiliteFactureachat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    //             $scope.mouvementFactures = data;
                    $scope.countMouvementFacturachat = data.length;
                    //            alert(data.length+'ok');
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'comptabilite.php/documentachat/getListePourMouvementFactureComptable',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifComptabiliteCaisse = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.countMouvementRegelementcaisse = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'comptabilite.php/documentachat/getListePourMouvementReglementComptable',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifPourBenificareMarcheDelaiexpirer = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsbenificiairedelaiexpire = data;
                    $scope.countdocsbenificairedelaiexpire = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListeBenficiaireDelaiexpire',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsAvisNnValideBDCBCE = function (id_typedoc) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsAvisNnvalidebcebdc = data;
                    $scope.countdocsAvisnnvalidbcebdc = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourAvisRefuseBudgetBCEBDC',
                    { id_typedoc },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifFactureOD = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.countFactureOd = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'comptabilite.php/documentachat/getListePourFactureodcomptable',
                    {},
                    onsuccess,
                    failure
                )
            }
            
            $scope.NotifJeton = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.jetons = data;
                    $scope.countJeton = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListeJeton',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsAnnule = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docs = data;
                    $scope.countdocs = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListeAnnuleNonValide',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsPourAnnule = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsannuler = data;
                    $scope.countdocsannuler = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'achats.php/documentachat/getListeAnnuleNonValideCg',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifAlimentation = function (affecte) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.alimentations = data;
                    $scope.countAlimentations = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'controlegestion.php/alimentationcompte/getListe',
                    { 'affecte': affecte },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifBudget = function (etatbudget) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.budgets = data;
                    $scope.countBudget = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'controlegestion.php/titrebudjet/getListe',
                    { 'etatbudget': etatbudget },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsAvis = function (id_typedoc) {
                const onsuccess = (response) => {
                    const data = response.data;
                    if (id_typedoc == '6') {
                        $scope.docsAvis = data;
                        $scope.countdocsAvis = data.length;
                    } else {
                        $scope.docsMarchesAvis = data;
                        $scope.countdocsMarchesAvis = data.length;
                    }
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourAvis',
                    { id_typedoc },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsAvisMarche = function (id_typedoc) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsMarchesAvis = data;
                    $scope.countdocsMarchesAvis = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourAvisMarche',
                    { id_typedoc },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsAvisNnValide = function (id_typedoc) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsAvisNnvalide = data;
                    $scope.countdocsAvisnnvalide = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourAvisRefuseBudget',
                    { id_typedoc },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoire = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoire = data;
                    $scope.countdocsEngagementProvisoire = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoire',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoireBDCNULL = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoireBDCNULL = data;
                    $scope.countdocsEngagementProvisoireBDCNULL = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoireBDCNULL',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoireRegrouppe = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoireRegrouppe = data;
                    $scope.countdocsEngagementProvisoireRegrouppe = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoireRegroupe',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoireContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoireContrat = data;
                    $scope.countdocsEngagementProvisoireContrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoireContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoireToDefinitif = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoireToDefinitif = data;
                    $scope.countdocsEngagementProvisoireToDefinitif = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoireToDefinitif',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoireToDefinitifBDC = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoireToDefinitifBDC = data;
                    $scope.countdocsEngagementProvisoireToDefinitifBDC = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoireToDefinitifBDC',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementProvisoireToDefinitifContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementProvisoireToDefinitifcontrat = data;
                    $scope.countdocsEngagementProvisoireToDefinitifcontrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementProvisoireToDefinitifContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementDefinitifAvenantContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementDefinitifAvenatncontrat = data;
                    $scope.countdocsEngagementefinitifAvenantcontrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementDefinitifAvenantContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
        
            $scope.NotifDocsEngagementDefHorsBCI = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementDefHorsBCI = data;
                    $scope.countdocsEngagementDefhorsBCI = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementDefinitifhorBCI',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagement = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagement = data;
                    $scope.countdocsEngagement = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagement',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementDefContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementDefContrat = data;
                    $scope.countdocsEngagementDefContrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementContratNotification',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementDefBDCNULL = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementDefBDCNUll = data;
                    $scope.countdocsEngagementDefBDCNUll = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementBDCNull',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementBDCRegroupe = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementBDCReg = data;
                    $scope.countdocsEngagementBDCReg = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementBDCReg',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementFacturationBDCRegroupe = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.premouvementsFacBDCReg = data;
                    $scope.countPreMouvementFacBDCReg = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementFActurationBDC',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementDefBCESY = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementDefBCENULL = data;
                    $scope.countdocsEngagementDefBCENUll = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementBCE',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementBDC = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementBDC = data;
                    $scope.countdocsEngagementBDC = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementBDC',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementBDCR = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementBDCR = data;
                    $scope.countdocsEngagementBDCR = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementBDCR',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementContrat = data;
                    $scope.countdocsEngagementContrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementForDefinitif = function (id_type) {
                const onsuccess = (response) => {
                    const data = response.data;
                    if (id_type == 17) {
                        $scope.docsEngagementBdc = data;
                        $scope.countdocsEngagementBdc = data.length;
                    } else {
                        $scope.docsEngagementBce = data;
                        $scope.countdocsEngagementBce = data.length;
                    }
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementForDefinitif',
                    { id_type },
                    onsuccess,
                    failure
                )
            }
            $scope.baseNotif = (url, data, success, failure) => {
                const { flatMap } = Rx.operators;
                const { timer, of } = Rx.Observable;
                const sub = timer(1000, 300000).pipe(flatMap(() =>
                    $http({
                        url,
                        method: "POST",
                        data,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        }
                    }).then(success, failure)
                )).subscribe();
                $scope.subs.push(sub);
            }
            $scope.NotifDocsEngagementForDefinitifBDCNULL = (id_type) => {
        
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementBdcNULL = data;
                    $scope.countdocsEngagementBdcNULL = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementForDefinitifBDCNULL',
                    { 'id_type': id_type },
                    onsuccess,
                    failure
                )
        
            }
            $scope.NotifDocsEngagementBDCRPForDefinitif = function (id_type) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementBdcRP = data;
                    $scope.countdocsEngagementBdcRP = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementBDCRPForDefinitif',
                    { 'id_type': id_type },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsEngagementContratForDefinitif = function (id_type) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsEngagementcontrat = data;
                    $scope.countdocsEngagementContratProvisoire = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourEngagementContratForDefinitif',
                    { 'id_type': id_type },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifMouvement = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.premouvements = data;
                    $scope.countPreMouvement = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'facturation.php/documentachat/getListePourMouvement',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifMouvementBCIContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.premouvementsBCIContrat = data;
                    $scope.countPreMouvementBCIContrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'facturation.php/documentachat/getListePourMouvementBCI',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifMouvementContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.premouvementscontrat = data;
                    $scope.countPreMouvementcontrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'facturation.php/documentachat/getListePourMouvementContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifMouvementFacture = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.mouvementFactures = data;
                    $scope.countMouvementFacture = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'facturation.php/documentachat/getListePourMouvementFacture',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifFactureOrdonnanceBDCR = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.factureOrdonnancesBDCR = data;
                    $scope.countFactureOrdonnanceBDCR = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnanceBDCR',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsordonnacementHorsBCI = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsOrdonnacementHorsBCI = data;
                    $scope.countdocsordonnecementhorsBCI = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnanceHorBCi',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifFactureOrdonnance = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.factureOrdonnances = data;
                    $scope.countFactureOrdonnance = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnance',
                    {},
                    onsuccess,
                    failure
                )
            }
            
            $scope.NotifJetonOrodonncnce = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.factureOrdonnancesjeton = data;
                    $scope.countFactureOrdonnancejeton = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnancejeton',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifFactureOrdonnanceBDCG = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.factureOrdonnancesbdcg = data;
                    $scope.countFactureOrdonnancebdgc = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
        
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnanceBDCG',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifFactureOrdonnanceContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.factureOrdonnancescontrat = data;
                    $scope.countFactureOrdonnanceContrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnanceContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifFactureOrdonnanceBCIContrat = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.factureOrdonnancesBCIcontrat = data;
                    $scope.countFactureOrdonnanceBCIContrat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentbudget/getListeFactureOrdonnanceBCIContrat',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsVisa = function (id_typedoc) {
                const onsuccess = (response) => {
                    const data = response.data;
                    if (id_typedoc == '6') {
                        $scope.docsVisas = data;
                        $scope.countdocsVisa = data.length;
                    } else {
                        $scope.docsMarchesVisas = data;
                        $scope.countdocsMarchesVisa = data.length;
                    }
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourVisa',
                    { id_typedoc },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifDocsVisaMarche = function (id_typedoc) {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsMarchesVisas = data;
                    $scope.countdocsMarchesVisa = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'budget.php/documentachat/getListePourVisaMarche',
                    { id_typedoc },
                    onsuccess,
                    failure
                )
            }
            $scope.NotifOrdonnance = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsBudget = data;
                    $scope.countdocsBudget = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresoriecaisse.php/documentbudget/getNewOrdonnace',
                    {},
                    onsuccess,
                    failure
                )
            }
        
            $scope.NotifOrdonnHorsBCI = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsBudgetHorsBCI = data;
                    $scope.countOdHorsBCI = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresoriecaisse.php/documentbudget/getNewOrdonnaceHorsBCI', {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifBDCNULL = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.documentsAchatBDCNULL = data;
                    $scope.countdocumentsAchatBDCNULL = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getNewOrdonnaceBDCNULL',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifBDC = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.documentsAchat = data;
                    $scope.countdocumentsAchat = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getNewOrdonnace',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifBDCGlo = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.documentsAchatBDCG = data;
                    $scope.countdocumentsAchatBDCG = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getNewOrdonnaceBDCG',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifQuitanceBDCNULL = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsQuitancesBDCNULL = data;
                    $scope.countdocsquitanceBDCNULL = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getQuitancesBDCNULL',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifQuitanceProvBDCREGR = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsQuitancesBDCReg = data;
                    $scope.countdocsquitanceBDCRegr = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getQuitancesBDCRegroupe',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifQuitanceDefBDCNULL = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsQuitancesDefBDCNULL = data;
                    $scope.countdocsquitanceDefBDCNULL = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getQuitancesDefBDCNULL',
                    {},
                    onsuccess,
                    failure
                )
            }
            $scope.NotifQuitance = function () {
                const onsuccess = (response) => {
                    const data = response.data;
                    $scope.docsQuitances = data;
                    $scope.countdocsquitance = data.length;
                }
                const failure = (response) => {
                    console.log('erreur');
                }
                $scope.baseNotif(
                    domaineapp + 'tresorie.php/documentachat/getQuitances',
                    {},
                    onsuccess,
                    failure
                )
            }
//affichage de salaire de base
$scope.AfficheSalairedebsae = function () {
        $http({
                url: domaineapp + '/Ressourcehumaine.php/salairedebase/ListeSalaires',
                method: "POST",
                data: $scope.param,
                headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
        }).then(function mySucces(response) {
                data = response.data;
                if (data.length > 0) {
                        for (var i = 0; i < data.length - 1; i++) {
                                id = '#' + data[i].id_categorie + '_' + data[i].id_echelle + '_' + data[i].id_echelon;
                                $(id).val(data[i].motant);
                                id1 = '#' + data[i].id_categorie + '_' + data[i].id_grade + '_' + data[i].id_echelle + '_' + data[i].id_echelon;
                                $(id1).val(data[i].motant);
                        }
                }
        }, function myError(response) {
                alert("Erreur d'ajout");
        });
}

$scope.ChargerComboBudget = function (id, data) {
        $(id).empty();
        for (i = 0; i < data.length; i++) {
                $(id).append("<option value='" + data[i].id + "'>" + data[i].libelle + "</option>");
        }
        $(id).val('').trigger("liszt:updated");
        $(id).trigger("chosen:updated");
}

$scope.InialiserComboBudget = function () {
        $scope.param = {
                'exercice': $("#id_exercice").val()
        }
        $http({
                url: domaineapp + 'budget.php/documentbudget/AfficheBudgetByExercice',
                method: "POST",
                data: $scope.param,
                headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
        }).then(function mySucces(response) {
                data = response.data;
                $scope.ChargerComboBudget('#id_budget', data);
        }, function myError(response) {
                alert("Erreur ....");
        });
}

$("#id_exercice")
        .change(function () {
                if ($("#id_exercice").val() && $("#id_exercice").val() != "0") {
                        $scope.InialiserComboBudget();
                } else {
                        $("#id_budget").empty();
                }
        })
        .trigger("change");
                });