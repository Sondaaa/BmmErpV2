<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                <small><?php $user = $sf_user->getAttribute('userB2m'); ?>
                    <i class="fa fa-leaf"></i>
                    ONE ERP <i class="fa fa-leaf"></i>
                    <?php if ($user->getProfilApplication("Unité Gestion des Stocks")) : ?>
                        GESTION DE STOCK
                    <?php endif ?>
                    <?php if ($user->getProfilApplication("Unité Achats")) : ?>
                        GESTION D'ACHAT
                    <?php endif ?>

                </small>
            </a>
        </div>


        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
                <?php if ($user->getProfilApplication("Unité Achats")) : ?>

                    <li class="blue dropdown-modal" handle-destroy="" ng-init="NotifDocsBCIrefuse(4)">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countdocsbcirefuse}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                BCI : {{countdocsbcirefuse}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsbcirefuse">
                                        <a href="<?php echo url_for('@edit') . '?id='; ?>{{doc.id}}">
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
                                <a href="<?php echo url_for('Achatdoc/index') ?>" style="font-weight: bold;">
                                    Liste des BC. Internes Annulés
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="green dropdown-modal" handle-destroy="" ng-init="NotifDocsApprovisionnementrefuse(4)">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countdocsapprorefuse}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Demande Appr. <br> Pas de Stock : {{countdocsapprorefuse}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsapprovrefuse">
                                        <a href="<?php echo url_for('@edit') . '?id='; ?>{{doc.id}}">
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
                                <a href="<?php echo url_for('Achatdoc/index') ?>" style="font-weight: bold;">
                                    Liste des BC. Internes
                                </a>
                            </li>
                        </ul>
                    </li>
                   
                    <li class="red dropdown-modal" handle-destroy="" ng-init="NotifDocsBCImretourneBnSortie(23)">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsbcbonsortieretourne}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Bon Sortie : {{countdocsbcbonsortieretourne}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsbonsortierenvoye">
                                        <a target="_blank" href="<?php echo url_for('Achatdoc/showdocumentbnsortie') . '?iddoc='; ?>{{doc.id}}">
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
                                <a href="<?php echo url_for('Achatdoc/index?idtype=23') ?>" style="font-weight: bold;">
                                    Liste des Bons Sorties
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if ($user->getProfilApplication("Unité Gestion des Stocks")) : ?>
                    <li class="red dropdown-modal" handle-destroy="" ng-init="NotifDocsDemandeappretourne(4)">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsappretourne}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Demande Appro. <br> : {{countdocsappretourne}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsapprovirenvoye">

                                        <a href="<?php echo url_for('documentachat/new') . '?idtype=11&iddocparent=' ?>{{doc.id}}">
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
                                <a href="<?php echo url_for('Documents/indexdemandeur?idtype=4') ?>" style="font-weight: bold;">
                                    Liste des Demandes Approvisionnemets
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="grey dropdown-modal" handle-destroy="" ng-init="NotifDocBDC()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-grey">{{countdocbdc}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                PV. BDC: {{countdocbdc}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docbdc">
                                        <a href="<?php echo url_for('documentachat/new') . '?idtype=10&iddocparent=' ?>{{doc.id}}">
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
                                <a href="<?php echo url_for('Documents/indexfrs?idtype=2') ?>" style="font-weight: bold;">
                                    Liste des Bon Dépenses au Comptant
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="green dropdown-modal" handle-destroy="" ng-init="NotifDocBCE()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countdocbce}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                PV. BCE: {{countdocbce}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docbce">
                                        <a href="<?php echo url_for('documentachat/new') . '?idtype=10&iddocparent=' ?>{{doc.id}}">
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
                                <a href="<?php echo url_for('Documents/indexfrs?idtype=7') ?>" style="font-weight: bold;">
                                    Liste des Bon Commandes Externes
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="red dropdown-modal" handle-destroy="" ng-init="NotifDocsBCIMagasin(4)">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countdocsbciappr}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                BCI.Magasin : {{countdocsbciappr}}
                            </li>
                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li ng-repeat="doc in docsdemandeapp">
                                        <a href="<?php //echo url_for('documentachat/new') . '?idtype=11&iddocparent=' ?>{{doc.id}}">
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
                                <a href="<?php //echo url_for('Documents/indexdemandeur?idtype=4') ?>" style="font-weight: bold;">
                                    Liste des Bon Commande interne Magasin
                                </a>
                            </li>
                        </ul>
                    </li> -->


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
                                <i class="ace-icon fa fa-lemon-o"></i> <b>Retour Accueil</b>
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