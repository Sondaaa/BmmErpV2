
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container" >
        <div class="navbar-header pull-left">
            <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    ONE ERP <i class="fa fa-leaf"></i> FACTURATION
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">



                <li class="gray dropdown-modal" ng-init="NotifDocsEngagementFacturationBDCRegroupe()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-gray">{{countPreMouvementFacBDCReg}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Doc. Achat => Mvt BDCR : {{countPreMouvementFacBDCReg}} 
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="premouvement in premouvementsFacBDCReg">
                                    <a href="<?php echo url_for('lignemouvementfacturation/newMvtBDCregroupe') . '?id=' ?>{{premouvement.id}}">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>{{premouvement.type}} N° {{premouvement.numero}}- Référence: {{premouvement.reference}} </strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer" style="padding: 0px;">
                            <a href="<?php echo url_for('documentachat/index?idtype=22&type=BDCG'); ?>" style="font-weight: bold;">
                                Liste des BDCRegroupe
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="red dropdown-modal" ng-init="NotifMouvementContrat()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-pink">{{countPreMouvementcontrat}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">

                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Doc. Achat => Mvt Du contrat : {{countPreMouvementcontrat}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="premouvement in premouvementscontrat">
                                    <a href="<?php echo url_for('Documents/detail') . '?id=' ?>{{premouvement.id}}">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>{{premouvement.type}} N° {{premouvement.numero}} - Référence: {{premouvement.reference}}</strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer" style="padding: 0px;">
                            <a href="<?php  echo url_for('documentachat/index?idtype=20');     ?>" style="font-weight: bold;">
                                Liste des Contrats
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="green dropdown-modal" ng-init="NotifMouvement()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-success">{{countPreMouvement}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Doc. Achat => Mvt BCE/BDC : {{countPreMouvement}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="premouvement in premouvements">
                                    <a href="<?php echo url_for('lignemouvementfacturation/new') . '?id=' ?>{{premouvement.id}}">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>{{premouvement.type}} N° {{premouvement.numero}} - Référence: {{premouvement.reference}}</strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--                        <li class="dropdown-footer" style="padding: 0px;">
                                                    <a href="<?php // echo url_for('lignemouvementfacturation/new');     ?>" style="font-weight: bold;">
                                                        Nouvelle fiche d'opération
                                                    </a>
                                                </li>-->

                    </ul>
                </li>
                <li class="blue dropdown-modal" ng-init="NotifMouvementBCIContrat()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-info">{{countPreMouvementBCIContrat}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">

                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Doc. Achat => Mvt BCI du Contrat : {{countPreMouvementBCIContrat}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="premouvement in premouvementsBCIContrat">
                                    <a href="<?php echo url_for('lignemouvementfacturation/newMvtContratPartiel') . '?id=' ?>{{premouvement.id}}" >
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>{{premouvement.type}} N° {{premouvement.numero}} - Référence: {{premouvement.reference}}</strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                                              <li class="dropdown-footer" style="padding: 0px;">
                                                    <a href="<?php echo url_for('documentachat/index?idtype=6');     ?>" style="font-weight: bold;">
                                                       Liste des BCIS du Contrat
                                                    </a>
                                                </li>

                    </ul>
                </li>
                <li class="green dropdown-modal" ng-init="NotifMouvementFacture()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-success">{{countMouvementFacture}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Doc. Achat => Facture : {{countMouvementFacture}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in mouvementFactures">
                                    <a href="<?php echo url_for('Documents/detail') . '?id=' ?>{{doc.id}}">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>{{doc.type}} N° {{doc.numero}} - Référence: {{doc.reference}}</strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer" style="padding: 0px;">
                            <a href="<?php echo url_for('documentachat/index?idtype=7'); ?>" style="font-weight: bold;">
                                Bons de Commandes Externes
                            </a>
                            <a href="<?php echo url_for('documentachat/index?idtype=2'); ?>" style="font-weight: bold;">
                                Bons de Dépenses au Comptant
                            </a>
                            <a href="<?php echo url_for('documentachat/index?idtype=20'); ?>" style="font-weight: bold;">
                                Contrat 
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="user-info">
                            <small>Bienvenue,</small>
                            <?php
                            echo $sf_user->getAttribute('userB2m');
                            ;
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
    </div>
</div>
