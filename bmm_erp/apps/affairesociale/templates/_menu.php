<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>

            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_affaire = $user->getProfilApplication("Unité des Affaires Sociales"); ?>
                <?php if ($acces_affaire): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Type Avance")) echo 'disabledbutton' ?>" href="<?php echo url_for('@avance') ?>">Type Avance </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Source Prêt")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sourcepret') ?>">Source Prêt </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Type Prêt")) echo 'disabledbutton' ?>" href="<?php echo url_for('@pret') ?>">Type Prêt </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Fournisseur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@fournisseur') ?>">Fournisseur </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Type Aide")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeaide') ?>">Type Aide </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Type Mission")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typemission') ?>">Type Mission </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Type Tenue")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typetenue') ?>">Type Tenue </a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paramètre : Destination Visite Médicale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@destinatonvisitemedicale') ?>">Destination du Visite Médicale </a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-envelope "></i>
                                <span class="menu-text"> Avances </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Avance")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandeavance') ?>">Demande d'Avance </a></li> 
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-envelope "></i>
                                <span class="menu-text"> Prêts </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Prêt")) echo 'disabledbutton' ?>" href="<?php echo url_for('@demandepret') ?>">Demande de Prêt Personnel</a></li> 
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-envelope "></i>
                                <span class="menu-text"> Retenues Sur Salaire </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Retenue sur Salaire")) echo 'disabledbutton' ?>" href="<?php echo url_for('@retenuesursalaire') ?>">Retenues sur Salaire</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-money"></i>
                                <span class="menu-text"> Paiements </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paiement Mensuel")) echo 'disabledbutton' ?>" href="<?php echo url_for('@historiqueretenue') ?>">Paiement Mensuel</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Paiement Anticipé")) echo 'disabledbutton' ?>" href="<?php echo url_for('historiqueretenue/demandepaiementspecifique') ?>">Paiement Anticipé</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-user-md"></i>
                                <span class="menu-text"> Visites Médicales </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Visite Médicale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@visitemedicale') ?>">Fiche consultation médicale</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-home"></i>
                                <span class="menu-text"> Services Sociaux </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Accident de Travail")) echo 'disabledbutton' ?>" href="<?php echo url_for('@accidents') ?>"> Fiche Accident de Travail </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Aide Sociale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@aidesociale') ?>"> Fiche Aide Sociale</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-briefcase"></i>
                                <span class="menu-text"> Tenues de Travail </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_affaire->getId(), "Tenue de Travail")) echo 'disabledbutton' ?>" href="<?php echo url_for('@tenues') ?>"> Fiche Tenue de Travail </a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }
</style>