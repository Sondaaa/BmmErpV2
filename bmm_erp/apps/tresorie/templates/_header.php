

<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    ONE ERP <i class="fa fa-leaf"></i> Caisses
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
                <li class="blue dropdown-modal" ng-init="NotifQuitanceDefBDCNULL()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-blue">{{countdocsquitanceDefBDCNULL}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Exporter Quitance BDC NUlL <br> en Définitif  : {{countdocsquitanceDefBDCNULL}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="document in docsQuitancesDefBDCNULL">
                                    <a href="<?php echo url_for('Documents/preengagementDefBDCNULL') . '?id=' ?>{{document.id}}">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>" style="font-weight: bold;">
                                Liste des BDC Provioires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="grey dropdown-modal" ng-init="NotifQuitanceBDCNULL()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-grey">{{countdocsquitanceBDCNULL}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            N.F Quitance Provisore <br>Du BDC NUlL : {{countdocsquitanceBDCNULL}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="document in docsQuitancesBDCNULL">
                                    <a href="<?php echo url_for('Documents/preengagementBDCNULL') . '?id=' ?>{{document.id}}">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>" style="font-weight: bold;">
                                Liste des BDC Provioires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="red dropdown-modal" ng-init="NotifQuitance()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-pink">{{countdocsquitance}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            N.F Quitance Provisoire : {{countdocsquitance}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="document in docsQuitances">
                                    <a href="<?php echo url_for('Documents/preengagement') . '?id=' ?>{{document.id}}">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>" style="font-weight: bold;">
                                Liste des BDC Provioires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="grey dropdown-modal" ng-init="NotifOrdonnHorsBCI()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-grey">{{countOdHorsBCI}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Ordonn.Hors BCI  <br>=> Fiche Opération : {{countOdHorsBCI}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="documentbudget in docsBudgetHorsBCI">
                                    <a href="<?php echo url_for('mouvementbanciare/newOrdonnaceHorsBci') . '?id=' ?>{{documentbudget.id}}" >
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>Ordonnance N° : {{documentbudget.numero}} 
                                                </strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer">
                            <a href="<?php // echo url_for('documentachat/index?idtype=2')    ?>" style="font-weight: bold;">
                                Liste des Ordonnacnes 
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="green dropdown-modal" ng-init="NotifBDC()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-success">{{countdocumentsAchat}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            BDC  => Fiche Opération : {{countdocumentsAchat}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="documentachat in documentsAchat">

                                    <a href="<?php echo url_for('mouvementbanciare/new') . '?id=' ?>{{documentachat.id}}" >
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                    <i class="ace-icon fa fa-file-text"></i>
                                                    <strong> BDC N° :  {{documentachat.numero}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-user"></i>
                                                    <strong> Fournisseur : {{documentachat.rs}}</strong>
                                                    <br>
                                                    <i class="ace-icon fa fa-money"></i>
                                                    <strong> T. TTC : {{documentachat.mntttc}} TND</strong>
                                                </span>
                                            
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer">
                            <a href="<?php echo url_for('documentachat/index?idtype=2') ?>" style="font-weight: bold;">
                                Liste des Bon Dépenses au comptant
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="grey dropdown-modal" ng-init="NotifQuitanceProvBDCREGR()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-grey">{{countdocsquitanceBDCRegr}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            N.F Quitance Provisore<br> Du BDCG  : {{countdocsquitanceBDCRegr}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="document in docsQuitancesBDCReg">
                                    <a href="<?php echo url_for('Documents/preengagementBDCG') . '?id=' ?>{{document.id}}">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>" style="font-weight: bold;">
                                Liste des BDC Provioires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="blue dropdown-modal" ng-init="NotifBDCRegrouppe()" >
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-blue">{{countdocumentsAchatBDCRegroupe}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            BDCG => Fiche Opération : {{countdocumentsAchatBDCRegroupe}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="documentachat in documentsAchatBDCRegroupe">
                                    <a href="<?php echo url_for('mouvementbanciare/new') . '?type=BDCG&id=' ?>{{documentachat.id}}" >
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>B.D.C N°  : {{documentachat.numero}} Du B.D.C.Regroupé</strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer">
                            <a href="<?php echo url_for('documentachat/index?idtype=2') ?>" style="font-weight: bold;">
                                Liste des BDCS du B.D.C Regroupé
                            </a>
                        </li>
                    </ul>
                </li>
                <!--                <li class="blue dropdown-modal" ng-init="NotifBDCGlo()">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                                        <span class="badge badge-blue">{{countdocumentsAchatBDCG}}</span>
                                    </a>
                                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                        <li class="dropdown-header">
                                            <i class="ace-icon fa fa-file-o"></i>
                                            BDCG => Fiche Opération : {{countdocumentsAchatBDCG}}
                                        </li>
                                        <li class="dropdown-content">
                                            <ul class="dropdown-menu dropdown-navbar">
                                                <li ng-repeat="documentachat in documentsAchatBDCG">
                                                    <a href="<?php // echo url_for('mouvementbanciare/new') . '?type=BDCG&id='    ?>{{documentachat.id}}" >
                                                        <div class="clearfix">
                                                            <span class="pull-left">
                                                                <i class="ace-icon fa fa-file-text"></i>
                                                                <strong>B.D.C N°  : {{documentachat.numero}} Du B.D.C.Regroupé</strong>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-footer">
                                            <a href="<?php // echo url_for('documentachat/index?idtype=2')    ?>" style="font-weight: bold;">
                                                Liste des BDCS du B.D.C Regroupé
                                            </a>
                                        </li>
                                    </ul>
                                </li>-->
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
                            <a class="blue" href="<?php echo url_for('Accueil/profil'); ?>">
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