<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    ONE ERP <i class="fa fa-leaf"></i> Unité Budget <?php if (isset($_SESSION['exercice_budget'])) echo ' - Exercice ' . $_SESSION['exercice_budget']; ?>
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
                <?php if ($_SESSION['exercice_budget'] != null): ?>
                    <li class="blue dropdown-modal" ng-init="NotifAlimentation('0')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-info">{{countAlimentations}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Alimentation => Titre Budget : {{countAlimentations}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="alimentation in alimentations">
                                        <a href="<?php echo url_for('alimentationcompte/show') . '?id=' ?>{{alimentation.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{alimentation.compte}} N° : {{alimentation.montant}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer" style="padding: 0px;">
                                <a href="<?php echo url_for('@alimentationcompte'); ?>" style="font-weight: bold;">
                                    Liste des Alimentations Banque/CCP
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="red dropdown-modal" ng-init="NotifDocsAvisMarche('9')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsMarchesAvis}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.C.I.M.P => Avis Budgétaire : {{countdocsMarchesAvis}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsMarchesAvis">
                                        <a href="<?php echo url_for('documentachat/envoibudget') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('documentachat/index?idtype=9') ?>" style="font-weight: bold;">
                                    Liste des B.C.I.M.P
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="green dropdown-modal" ng-init="NotifDocsAvis('6')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countdocsAvis}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.C.I => Avis Budgétaire : {{countdocsAvis}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsAvis">
                                        <a href="<?php echo url_for('documentachat/envoibudget') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('documentachat/index') ?>" style="font-weight: bold;">
                                    Liste des B.C.I
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="grey dropdown-modal" ng-init="NotifDocsEngagementProvisoire()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-grey">{{countdocsEngagementProvisoire}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.C.E / B.D.C => Engage. Pr. : {{countdocsEngagementProvisoire}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoire">
                                        <a href="<?php echo url_for('documentachat/showdocument') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/indexfrs') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Pr.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="grey dropdown-modal" ng-init="NotifDocsEngagementProvisoireBDCNULL()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-grey">{{countdocsEngagementProvisoireBDCNULL}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.D.C Null => Engage. Pr. : {{countdocsEngagementProvisoireBDCNULL}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoireBDCNULL">
                                        <a href="<?php echo url_for('documentachat/showdocumentAvecQuitance') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/indexfrsBDC') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Pr.
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="red dropdown-modal" ng-init="NotifDocsEngagementProvisoireContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-grey">{{countdocsEngagementProvisoireContrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Contrat => Engage. Pr. : {{countdocsEngagementProvisoireContrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoireContrat">
                                        <a href="<?php echo url_for('documentachat/showdocument') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° {{document.numerocontrat}} / BCI N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/indexfrsBcicontrat') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Pr.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="blue dropdown-modal" ng-init="NotifDocsEngagementProvisoireToDefinitif()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-info">{{countdocsEngagementProvisoireToDefinitif}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.C.E / B.D.C => Engage. Df. : {{countdocsEngagementProvisoireToDefinitif}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoireToDefinitif">
                                        <a href="<?php echo url_for('Documents/preengagement') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/bondefinitif?idtype=7') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Df.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="blue dropdown-modal" ng-init="NotifDocsEngagementProvisoireToDefinitifBDC()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-info">{{countdocsEngagementProvisoireToDefinitifBDC}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                  B.D.C Null => Engage. Df. : {{countdocsEngagementProvisoireToDefinitifBDC}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoireToDefinitifBDC">
                                        <a href="<?php echo url_for('Documents/preengagementBDC') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/bondefinitif?idtype=7') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Df.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="blue dropdown-modal" ng-init="NotifDocsEngagementProvisoireToDefinitifContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-blue">{{countdocsEngagementProvisoireToDefinitifcontrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Contrat => Engage. Df. : {{countdocsEngagementProvisoireToDefinitifcontrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoireToDefinitifcontrat">
                                        <a href="<?php echo url_for('Documents/preengagementContrat') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° {{document.numerocontrat}} / BCI N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/bondefinitifcontrat?idtype=20') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Df.
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="red dropdown-modal" ng-init="NotifDocsEngagementDefinitifAvenantContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsEngagementefinitifAvenantcontrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink  dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Avenant Contrat => Engage. Df. : {{countdocsEngagementefinitifAvenantcontrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink ">
                                    <li ng-repeat="document in docsEngagementDefinitifAvenatncontrat">
                                        <a href="<?php echo url_for('Documents/preengagementAvenantContrat') . '?id=' ?> {{document.id}}<?php echo '&id_contrat=' ?>{{document.id_contrat}} ">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° {{document.numerocontrat}} / BCI N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
<!--                            <li class="dropdown-footer">
                                <a href="<?php // echo url_for('Documents/bondefinitifcontrat?idtype=20') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Df.
                                </a>
                            </li>-->
                        </ul>
                    </li>

                    <li class="grey dropdown-modal" ng-init="NotifDocsEngagementProvisoireRegrouppe()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-grey">{{countdocsEngagementProvisoireRegrouppe}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.D.C Regroupe => Engage. DF. : {{countdocsEngagementProvisoireRegrouppe}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsEngagementProvisoireRegrouppe">
                                        <a href="<?php echo url_for('documentachat/showdocumentBDCR') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/indexfrsBDCRegroupe') ?>" style="font-weight: bold;">
                                    Nouvelle Fiche d'engagement Déf.
                                </a>
                            </li>
                        </ul>
                    </li>
                       <li class="red dropdown-modal" ng-init="NotifFactureOrdonnanceBDCR()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countFactureOrdonnanceBDCR}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                BDC.Regroupé => Ordonnance : {{countFactureOrdonnanceBDCR}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in factureOrdonnancesBDCR">
                                        <a href="<?php echo url_for('lignemouvementfacturation/detailsFactureBDCRegroupe') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.montanttotlafacture}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('lignemouvementfacturation/journal') ?>" style="font-weight: bold;">
                                    Journal des Mouvements Fac.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="green dropdown-modal" ng-init="NotifFactureOrdonnance()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countFactureOrdonnance}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Facture => Ordonnance : {{countFactureOrdonnance}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in factureOrdonnances">
                                        <a href="<?php echo url_for('lignemouvementfacturation/detailsFacture') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{document.rs}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.mntttc}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('lignemouvementfacturation/journal') ?>" style="font-weight: bold;">
                                    Journal des Mouvements Fac.
                                </a>
                            </li>
                        </ul>
                    </li>
<!--                    <li class="blue dropdown-modal" ng-init="NotifFactureOrdonnanceBDCG()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-blue">{{countFactureOrdonnancebdgc}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Facture => Ordonnance BDCG : {{countFactureOrdonnancebdgc}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in factureOrdonnancesbdcg">
                                        <a href="<?php // echo url_for('lignemouvementfacturation/detailsFactureBDCG') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{document.rs}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.mntttc}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php // echo url_for('lignemouvementfacturation/journal') ?>" style="font-weight: bold;">
                                    Journal des Mouvements Fac.
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="red dropdown-modal" ng-init="NotifFactureOrdonnanceBCIContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countFactureOrdonnanceBCIContrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Facture => Ordonnance 
                                BCI Contrat: {{countFactureOrdonnanceBCIContrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in factureOrdonnancesBCIcontrat">
                                        <a href="<?php echo url_for('lignemouvementfacturation/detailFactureBCIDuContrat') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{document.rs}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.mntttc}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('lignemouvementfacturation/journal') ?>" style="font-weight: bold;">
                                    Journal des Mouvements Fac.
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="blue dropdown-modal" ng-init="NotifFactureOrdonnanceContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-info">{{countFactureOrdonnanceContrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Facture => Ordonnance <br>
                                Ligne Contrat: {{countFactureOrdonnanceContrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in factureOrdonnancescontrat">
                                        <a href="<?php echo url_for('lignemouvementfacturation/detailFactureBCIContrat') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{document.rs}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.mntttc}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('lignemouvementfacturation/journal') ?>" style="font-weight: bold;">
                                    Journal des Mouvements Fac.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="orange-modal dropdown-modal" ng-init="NotifJeton()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-important">{{countJeton}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Jeton ( B.Commande ) : {{countJeton}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in jetons">
                                        <a href="<?php // echo url_for('lignemouvementfacturation/detailsFactureJeton') . '?id='; ?>{{document.id}}">
                                        <a href="<?php echo url_for('Documents/preengagementJeton') . '?id=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{document.raisonsocial}}</strong>
                                               <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.mntttc}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer" style="height: 10px;"></li>
                        </ul>
                    </li>
                   
                    <li class="blue dropdown-modal" ng-init="NotifJetonOrodonncnce()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-primary">{{countFactureOrdonnancejeton}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Facture Jeton => Ordonnance : {{countFactureOrdonnancejeton}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in factureOrdonnancesjeton">
                                        <a href="<?php echo url_for('lignemouvementfacturation/detailsFactureDocJeton') . '?id='; ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> {{document.type}} N° : {{document.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{document.rs}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{document.mntttc}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('lignemouvementfacturation/journal') ?>" style="font-weight: bold;">
                                    Journal des Mouvements Fac.
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="purple dropdown-modal" ng-init="NotifDocsAnnule()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-undo icon-animated-vertical"></i>
                            <span class="badge badge-important">{{countdocs}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Annulation d'achat : {{countdocs}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                    <li ng-repeat="document in docs">
                                        <a href="<?php echo url_for('documentachat/showAnnule') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-pink fa fa-shopping-cart"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                                <span class="pull-right text-muted" style="margin-top: 3px;">{{document.user}}</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('documentachat/listeAnnule') ?>" style="font-weight: bold;">
                                    Liste des Annulations Achats
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="red dropdown-modal" ng-init="NotifDocsAvisNnValideBDCBCE('17')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsAvisnnvalidbcebdc}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>    

                                B.C.E/B.D.C/Contrat/BDCR N.Validé</br> => Avis Budgétaire : {{countdocsAvisnnvalidbcebdc}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="document in docsAvisNnvalidebcebdc">
                                        <a href="<?php echo url_for('documentachat/envoibudgetBCEBDCC') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('documentachat/index?idtype=6') ?>" style="font-weight: bold;">
                                    Liste des Refuses Budgétaire
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="red dropdown-modal" ng-init="NotifDocsAvisNnValide('6')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsAvisnnvalide}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>    

                                B.C.I N.Validé => Avis Budgétaire : {{countdocsAvisnnvalide}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar"><!--| limitTo:5-->
                                    <li ng-repeat="document in docsAvisNnvalide">
                                        <a href="<?php echo url_for('documentachat/envoibudget') . '?iddoc=' ?>{{document.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{document.type}} N° : {{document.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('documentachat/index?idtype=6') ?>" style="font-weight: bold;">
                                    Liste des Refuses Budgétaire
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="user-info">
                            <small>Bienvenue,</small>
                            <?php echo $sf_user->getAttribute('userB2m'); ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a class="blue" href="<?php echo sfconfig::get('sf_appdir') . 'accueil.php/Accueil/global' ?>">
                                <i class="ace-icon fa fa-lemon-o "></i> <b>Retour Accueil</b>
                            </a>
                        </li>
                        <li>
                            <a class="blue" href="<?php echo url_for('accueil/profil'); ?>">
                                <i class="ace-icon fa fa-user"></i> <b>Editer Profil</b>
                            </a>
                        </li>
                        <li>
                            <a class="purple" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/scan_setup/setup_scan_FORMANET.exe" target="_blank">
                                <i class="ace-icon fa fa-download"></i> <b>Scan.exe</b>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="red" href="<?php echo url_for("/Admin/deconnect") ?>">
                                <i class="ace-icon fa fa-power-off"></i> <b>Déconnectez</b>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<style>

    .orange-modal > .dropdown-toggle{
        background-color: #E1B646 !important;
        color: #FFF !important;
    }

</style>