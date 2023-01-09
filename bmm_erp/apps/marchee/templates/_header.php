<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container" >
        <div class="navbar-header pull-left">
            <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    ONE ERP <i class="fa fa-leaf"></i> MARCHES
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation" ng-controller="CtrlNotification">
            <ul class="nav ace-nav">
            <li class="purple dropdown-modal"  ng-init="NotifPourBenificareMarcheDelaiexpirer()">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-file-text-o icon-animated-vertical"></i>
                        <span class="badge badge-pink">{{countdocsbenificairedelaiexpire}}</span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-file-o"></i>
                            Delai Execution <br>Fournisseur : {{countdocsbenificairedelaiexpire}}
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <li ng-repeat="doc in docsbenificiairedelaiexpire">
                                    <a href="<?php echo url_for('lots/misajourpiriode') . '?id='; ?>{{doc.id}}">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="ace-icon fa fa-file-text"></i>
                                                <strong>{{doc.frs}} Marché : {{doc.numero}}</strong>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer">
                        <a href="<?php echo url_for('@lots') ?>" style="font-weight: bold;">
                            Liste des Lots 
                        </a>
                    </li>
                </ul>
            </li>
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