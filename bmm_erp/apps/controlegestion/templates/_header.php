<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    ONE ERP <i class="fa fa-leaf"></i> Unité Contrôle Budgétaire <?php if (isset($_SESSION['exercice_budget']) && $_SESSION['statistique'] == 0) echo ' - Exercice ' . $_SESSION['exercice_budget']; ?>
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
                <?php if ($_SESSION['statistique'] == 0): ?>
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
                    <li class="green dropdown-modal" ng-init="NotifBudget('3')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-briefcase icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countBudget}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-briefcase"></i>
                                Validation Budget Final : {{countBudget}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="budget in budgets">
                                        <!--<a href="<?php // echo url_for('titrebudjet/detailbudget?') . '?id='   ?>{{budget.id}}">-->
                                        <a href="<?php echo sfconfig::get('sf_appdir'); ?>controlegestion.php/titrebudjet/{{budget.id}}/edit">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-play"></i>
                                                    <strong>{{budget.libelle}}<br>=> M. Global : {{budget.mntglobal}} TND</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer" style="padding: 0px;">
                                <a href="<?php echo url_for('titrebudjet/index?type=Final'); ?>" style="font-weight: bold;">
                                    Liste des Budgets Finaux
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php elseif ($_SESSION['statistique'] == 1): ?>
                    <li class="gray dropdown-modal" ng-init="NotifDocsEngagementDefContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-gray">{{countdocsEngagementDefContrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Eng.Def. Contrat : {{countdocsEngagementDefContrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagementDefContrat">
                                        <a href="<?php echo url_for('documentachat/showdocumentContrat?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php  echo url_for('Documents/documentContratDefFournisseur')   ?>" style="font-weight: bold;">
                                    Liste des Contrats Définitifs
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="red dropdown-modal" ng-init="NotifDocsEngagementDefBDCNULL()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsEngagementDefBDCNUll}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Eng.Def. BDC NULL : {{countdocsEngagementDefBDCNUll}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagementDefBDCNUll">
                                        <a href="<?php echo url_for('documentachat/showdocumentBDCNULL?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/documentFournisseurBDCNULL') ?>" style="font-weight: bold;">
                                    Liste des  B.D.C.S.NULL
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="green dropdown-modal" ng-init="NotifDocsEngagementBDCRegroupe()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-green">{{countdocsEngagementBDCReg}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Eng.Def. BDCRegroupe : {{countdocsEngagementBDCReg}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagementBDCReg">
                                        <a href="<?php echo url_for('documentachat/showdocumentBDCR?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/documentFournisseurBDCRegrouppe') ?>" style="font-weight: bold;">
                                    Liste des  B.D.C.S.R
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="red dropdown-modal" ng-init="NotifDocsEngagementDefBCESY()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsEngagementDefBCENUll}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Eng.Def. B.C.E.S : {{countdocsEngagementDefBCENUll}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagementDefBCENULL">
                                        <a href="<?php echo url_for('documentachat/showdocumentBCE?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/documentFournisseur') ?>" style="font-weight: bold;">
                                    Liste des  B.C.E.S
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="blue dropdown-modal" ng-init="NotifDocsEngagementBDC()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-blue">{{countdocsEngagementBDC}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Engagement BDC : {{countdocsEngagementBDC}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagementBDC">
                                        <a href="<?php echo url_for('documentachat/showdocumentAvecQuitance?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <!---ligavisdoc/bciPourVisa') . '?id_typedoc=17'-->
                                <a href="<?php echo url_for('Documents/documentBDCProvisoireFournisseur') ?>" style="font-weight: bold;">
                                    Liste des  B.D.C.S.P
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="grey dropdown-modal" ng-init="NotifDocsEngagement()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-grey">{{countdocsEngagement}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Engagement Provisoire : {{countdocsEngagement}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagement">
                                        <a href="<?php echo url_for('documentachat/showdocument?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-footer"><!--17 18-->
                                <a href="<?php echo url_for('Documents/documentProvisoireFournisseur') ?>" style="font-weight: bold;">
                                    Liste des B.C.E.S.P / B.D.C.S.P
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--                     <li class="green dropdown-modal" ng-init="NotifDocsEngagementBDCR()">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                                                <span class="badge badge-green">{{countdocsEngagementBDCR}}</span>
                                            </a>
                                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                                <li class="dropdown-header">
                                                    <i class="ace-icon fa fa-file-o"></i>
                                                    Validation Engagement : {{countdocsEngagementBDCR}}
                                                </li>
                                                <li class="dropdown-content">
                                                    <ul class="dropdown-menu dropdown-navbar">
                                                        <li ng-repeat="doc in docsEngagementBDCR">
                                                            <a href="<?php // echo url_for('documentachat/showdocument?iddoc=')   ?>{{doc.id}}">
                                                                <div class="clearfix">
                                                                    <span class="pull-left">
                                                                        <i class="ace-icon fa fa-file-text"></i>
                                                                        <strong>{{doc.type}} N° : {{doc.numero}}</strong>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-footer">
                                                    <a href="<?php // echo url_for('ligavisdoc/bciPourVisa') . '?id_typedoc=6'   ?>" style="font-weight: bold;">
                                                        Liste des B.D.C.Regroupé.S.P
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>-->
                    <li class="blue dropdown-modal" ng-init="NotifDocsEngagementContrat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-info">{{countdocsEngagementContrat}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Validation Engagement Contrat : {{countdocsEngagementContrat}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsEngagementContrat">
                                        <a href="<?php echo url_for('documentachat/showdocument?iddoc=') ?>{{doc.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{doc.type}} N° {{doc.numerocontrat}} / BCI N° : {{doc.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('Documents/documentProvisoireContratFournisseur') ?>" style="font-weight: bold;">
                                    Liste des Contrat Provisoire
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="red dropdown-modal" ng-init="NotifDocsVisaMarche('9')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsMarchesVisa}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.C.I.M.P => Visa d'Achat : {{countdocsMarchesVisa}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="lignevisa in docsMarchesVisas">
                                        <a href="<?php echo url_for('documentachat/rempliretexporter') . '?iddoc=' ?>{{lignevisa.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{lignevisa.type}} N° : {{lignevisa.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer" style="padding: 0px;">
                                <a href="<?php echo url_for('ligavisdoc/bciPourVisa') . '?id_typedoc=9' ?>" style="font-weight: bold;">
                                    Liste des B.C.I.M.P ( => Visa d'Achat )
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="green dropdown-modal" ng-init="NotifDocsVisa('6')">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countdocsVisa}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                B.C.I => Visa d'Achat : {{countdocsVisa}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="lignevisa in docsVisas">
                                        <a href="<?php echo url_for('documentachat/rempliretexporter') . '?iddoc=' ?>{{lignevisa.id}}">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong>{{lignevisa.type}} N° : {{lignevisa.numero}}</strong>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-footer">
                                <a href="<?php echo url_for('ligavisdoc/bciPourVisa') . '?id_typedoc=6' ?>" style="font-weight: bold;">
                                    Liste des B.C.I ( => Visa d'Achat )
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
                            <a class="blue" href="<?php echo sfconfig::get('sf_appdir') . 'accueil.php/accueil/global' ?>">
                                <i class="ace-icon fa fa-lemon-o"></i> <b>Retour accueil</b>
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
                            <a class="red" href="<?php echo sfconfig::get('sf_appdir') . 'index.php' . url_for("/Admin/deconnect") ?>">
                                <i class="ace-icon fa fa-power-off"></i> <b>Déconnectez</b>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>