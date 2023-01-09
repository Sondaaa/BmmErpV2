<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_budget = $user->getProfilApplication("Unité Budget"); ?>
                <?php if ($acces_budget): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Exercice")) echo 'disabledbutton' ?>" href="<?php echo url_for('@exercice') ?>">Exercice</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Projet")) echo 'disabledbutton' ?>" href="<?php echo url_for('@projet') ?>">Projet</a></li>
                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Type Pièce Jointe")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typepiecejointbudget') ?>">Type Piéce Jointe</a></li>
                                
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Paramétrage des Tranches")) echo 'disabledbutton' ?>" href="<?php echo url_for('@parametragetranche') ?>">Paramétrage des Tranches</a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Type de Transfert")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typetransfert') ?>">Type de Transfert</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Retenue à la Source")) echo 'disabledbutton' ?>" href="<?php echo url_for('@retenuesource') ?>">Retenue à la Source</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Paramètre : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseur</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!--documentbudget-->
                        <li class="hover" >
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text"> Budgets </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu" >
                                <li class="active open hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Budget Prototype
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Budgets Prototypes", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/new?prototype=Prototype') ?>">Nouvelle Fiche Prototype </a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Budgets Prototypes")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/index?type=prototype') ?>">Liste des Budgets Prototypes</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                                <li class="active open hover">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Budget Définitif
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModuleAction($acces_budget->getId(), "Budgets Définitifs", "Création")) echo 'disabledbutton' ?>" href="<?php echo url_for('titrebudjet/new') ?>">Nouvelle Fiche Définitif</a>
                                            <b class="arrow"></b>
                                        </li>
                                        <li class="hover">
                                            <a class="<?php if (!$user->getProfilModule($acces_budget->getId(), "Budgets Définitifs")) echo 'disabledbutton' ?>" href="<?php echo url_for('@titrebudjet') ?>">Liste des Budgets Définitifs</a>
                                            <b class="arrow"></b>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text">Exercice</span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->