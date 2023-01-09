<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>ONE ERP
                </small>
            </a>
        </div>
        <?php $user = $sf_user->UserConnected(); ?>
        <div class="navbar-buttons navbar-header pull-right collapse navbar-collapse" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">

                <?php if (isset($user)) {
                    if ($user->getIdProfil() != 1 && $user->getIsAdmin()) { ?>
                        <li class="red dropdown-modal" handle-destroy="" ng-init="NotifDocsBCImretourneParUserBnsortie(4)">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                                <span class="badge badge-pink">{{countdocsbciretourneparuser}}</span>
                            </a>
                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-file-o"></i>
                                    Bon Sortie : {{countdocsbciretourneparuser}}
                                </li>
                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li ng-repeat="doc in docsbcirenvoyebciuser">
                                            <a target="_blanc" href="<?php echo url_for('documentachat/showdocumentbnsortie') . '?iddoc='; ?>{{doc.id}}">
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
                                    <a href="<?php echo url_for('documentachat/indexbonsortie?idtype=23') ?>" style="font-weight: bold;">
                                        Liste des Bons Sorties
                                    </a>
                                </li>
                            </ul>
                        </li>
                <?php }
                }  if($user->getIdProfil() == 1){ ?>
                
                 <li class="red dropdown-modal" handle-destroy="" ng-init="NotifDemandeSuppresion()">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                                <span class="badge badge-pink">{{countdocsdemandesuppression}}</span>
                            </a>
                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-file-o"></i>
                                   De.Privilege : {{countdocsdemandesuppression}}

                                </li>
                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li ng-repeat="doc in docsdemandeprivilege">
                                            <a target="_blanc" href="<?php //echo url_for('@demandeprivilege') ?>">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="ace-icon fa fa-file-text"></i>
                                                        <strong>Demande de {{doc.typedoc}} {{doc.user}}</strong>
                                                    </span>
                                                </div>
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                               
                            </ul>
                        </li>
                <?php }?>
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="user-info">
                            <small>Bienvenue,</small>
                            <?php

                            $user = $sf_user->UserConnected();
                            if (isset($user)) {
                                if ($user->getIdParent() != null) {
                                    echo $user;
                                } else {
                                    echo "Admin. Formanet";
                                }
                            }
                            ?>
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