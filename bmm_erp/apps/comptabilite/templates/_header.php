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
                    <i class="fa fa-leaf"></i> ONE ERP <i class="fa fa-leaf"></i> G. COMPTABILITE
                </small>
                <?php if ($_SESSION['exercice'] != null): ?>
                    <small>
                        - <?php echo $_SESSION['dossier'] . ' / ' . $_SESSION['exercice']; ?>
                    </small>
                <?php endif; ?>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
                <?php if ($_SESSION['exercice'] != null): ?>
                    <li class="blue dropdown-modal "  ng-init="NotifComptabiliteFactureachat()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-info">{{countMouvementFacturachat}}</span>
                           
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Doc. Achat => Facture :{{countMouvementFacturachat}}
                            </li>
                            <li class="dropdown-footer" style="padding: 0px;">
                                <a href="<?php echo url_for('importation/listAchat'); ?>" style="font-weight: bold;">
                                    Liste des  facrures achats
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="green dropdown-modal"   ng-init="NotifComptabiliteCaisse()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-success">{{countMouvementRegelementcaisse}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Trésorerie=>Réglement  :{{countMouvementRegelementcaisse}}
                            </li>
                            <li class="dropdown-footer" style="padding: 0px;">
                                <a href="<?php echo url_for('importation/listTresorerie'); ?>" style="font-weight: bold;">
                                    Liste des  Règlements Comptables 
                                </a>
                            </li>


                        </ul>
                    </li>
<li class="red dropdown-modal"   ng-init="NotifFactureOD()">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                            <span class="badge badge-pink">{{countFactureOd}}</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-file-o"></i>
                                Retenue à la source => OD :{{countFactureOd}}
                            </li>
                            <li class="dropdown-footer" style="padding: 0px;">
                                <a href="<?php echo url_for('importation/listeOd_1'); ?>" style="font-weight: bold;">
                                    Liste des  Factures OD Fournisseur
                                </a>
                            </li>


                        </ul>
                    </li>
                <?php endif; ?>
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="user-info">
                            <small>Bienvenue,</small>
                            <?php echo $sf_user->getAttribute('userB2m');  ?>
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
                            <a class="blue" href="<?php echo url_for('@RetourDossier') ?>">
                                <i class="ace-icon fa fa-lemon-o"></i> <b>Retour Dossier</b>
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