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
                    ONE ERP <i class="fa fa-leaf"></i> GESTION D'ACHAT
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
                <li class="red dropdown-modal" handle-destroy="" ng-init="NotifDocsEngagementForDefinitifBDCNULL('17')">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-pink">{{countdocsEngagementBdcNULL}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Exporter en B.D.C Null Définitif : {{countdocsEngagementBdcNULL}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in docsEngagementBdcNULL">
                                    <a href="<?php echo url_for('documentachat/exportbccnull') . '?iddoc='; ?>{{doc.id_docparent}}&idbdc={{doc.id}}&tab=3">
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
                            <a href="<?php echo url_for('Documents/indexfrsBDCNull?idtype=17') ?>" style="font-weight: bold;">
                                Liste des B.D.C.S Provisoires <br> Avec Quitance Définitifs
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="blue dropdown-modal" ng-init="NotifDocsEngagementForDefinitif('18')">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-info">{{countdocsEngagementBce}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Exporter en B.C.E Définitif : {{countdocsEngagementBce}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in docsEngagementBce">
                                    <a href="<?php echo url_for('documentachat/exportbce') . '?iddoc='; ?>{{doc.id_docparent}}&idbdc={{doc.id}}&tab=3">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=18') ?>" style="font-weight: bold;">
                                Liste des B.C.E.S Provisoires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="green dropdown-modal" ng-init="NotifDocsEngagementForDefinitif('17')">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-success">{{countdocsEngagementBdc}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Exporter en B.D.C Définitif : {{countdocsEngagementBdc}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in docsEngagementBdc">
                                    <a href="<?php echo url_for('documentachat/exportbcc') . '?iddoc='; ?>{{doc.id_docparent}}&idbdc={{doc.id}}&tab=3">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=17') ?>" style="font-weight: bold;">
                                Liste des B.D.C.S Provisoires
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="red dropdown-modal" ng-init="NotifDocsEngagementContratForDefinitif('19')">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-pink">{{countdocsEngagementContratProvisoire}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Exporter en Contrat Définitif : {{countdocsEngagementContratProvisoire}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in docsEngagementcontrat">
                                    <a href="<?php echo url_for('documentachat/exportcontratdefinitif') . '?iddoc='; ?>{{doc.id}}&idcontrat={{doc.id_docparent}}&tab=3">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=19') ?>" style="font-weight: bold;">
                                Liste des Contrats Provisoires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="grey dropdown-modal" ng-init="NotifDocsEngagementBDCRPForDefinitif('21')">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-grey">{{countdocsEngagementBdcRP}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Exporter en B.D.C.Regroupé Définitif : {{countdocsEngagementBdcRP}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in docsEngagementBdcRP">
                                    <a href="<?php echo url_for('documentachat/exportbccrp') . '?iddoc=';    ?>{{doc.id_docparent}}&idbdc={{doc.id}}&tab=3">
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
                            <a href="<?php echo url_for('Documents/indexfrs?idtype=21')    ?>" style="font-weight: bold;">
                                Liste des B.D.C.Regroupé  Provisoires
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="purple dropdown-modal" ng-init="NotifDocsPourAnnule()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-undo icon-animated-vertical"></i>
                        <span class="badge badge-important">{{countdocsannuler}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Annulation d'achat : {{countdocsannuler}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                <li ng-repeat="document in docsannuler">
                                    <a href="<?php echo url_for('documentachat/annuler') . '?iddoc=' ?>{{document.id}}">
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
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="user-info">
                            <small>Bienvenue,</small>
                            <?php
                            $user = $sf_user->UserConnected();
                            if (isset($user)) {
                                if ($user->getIdParent() != null)
                                    echo $user;
                                else
                                    echo "Admin. Formanet";
                            }
                            ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a class="blue" href="<?php echo sfconfig::get('sf_appdir') . 'Accueil.php/Accueil/global' ?>">
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