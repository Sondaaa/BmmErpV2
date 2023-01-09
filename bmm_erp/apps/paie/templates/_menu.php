<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>

            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_paie = $user->getProfilApplication("Unité Paie"); ?>
                <?php if ($acces_paie): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog"></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Société")) echo 'disabledbutton' ?>" href="<?php echo url_for('@societe') ?>">Société </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Caisse de Sécurité Sociale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@codesociale') ?>">Caisse de Sécurité Sociale  </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Contribution Patronale")) echo 'disabledbutton' ?>" href="<?php echo url_for('@contribitionpatronale') ?>">Contribution Patronale  </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Déduction Commune")) echo 'disabledbutton' ?>" href="<?php echo url_for('@deductioncommune') ?>">Déductions Communes  </a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Barème de l'Impôt sur le Revenu")) echo 'disabledbutton' ?>" href="<?php echo url_for('@baremeimpot') ?>">Barème de l'Impôt sur le revenu</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Type Formule Prime")) echo 'disabledbutton' ?>" href="<?php echo url_for('@formuleprimes') ?>"> Type Formule Primes  </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Paramètre : Prime")) echo 'disabledbutton' ?>" href="<?php echo url_for('@primes') ?>">Primes</a></li>  
                            </ul>
                        </li>
                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Dossier Paie")) echo 'disabledbutton' ?>" href="<?php echo url_for('dossiercomptable/show') ?>">
                                <i class="menu-icon fa fa-folder-open-o"></i>
                                <span class="menu-text"> Dossier Paie </span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Personnel")) echo 'disabledbutton' ?>" href="<?php echo url_for('@agents') ?>">
                                <i class="menu-icon fa fa-user"></i>
                                <span class="menu-text"> Personnels </span>
                            </a>
                        </li>
                        <!-- /.dropdown-user -->
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-calendar"></i>
                                <span class="menu-text"> Paie </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Fiche de Paie / Personne")) echo 'disabledbutton' ?>" href="<?php echo url_for('paie/index') ?>">Fiche de paie / Personne</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Affectation des Paies (Mois > 12)")) echo 'disabledbutton' ?>" href="<?php echo url_for('paie/affectation') ?>">Affectation des Paies (Mois >12)</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-pdf-o"></i>
                                <span class="menu-text"> Edition Etats </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Etat : Fiche de Paie")) echo 'disabledbutton' ?>" href="#my-modalpaie" role="button" data-toggle="modal" onclick="setAffichageSelect()">Fiche de Paie</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Etat : Journal de Paie")) echo 'disabledbutton' ?>" href="#my-modaljournalpaie" role="button" data-toggle="modal" onclick="setAffichageSelect()">Fiche Journal de Paie</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Etat : Fiche Déclaration CNSS")) echo 'disabledbutton' ?>" href="#my-modaldeclaration" role="button" data-toggle="modal" onclick="setAffichageSelect()">Fiche Déclaration CNSS</a></li> 
                                <li><a class="<?php if (!$user->getProfilModule($acces_paie->getId(), "Etat : Récapitulatif CNRPS")) echo 'disabledbutton' ?>" href="#my-modaletatrecap" role="button" data-toggle="modal" onclick="setAffichageSelect()">Etat Récapitulatif CNRPS</a></li> 
                            </ul>
                        </li>
                        <li>
                            <a id="id-btn-dialog1" onclick="showModal()">
                                <i class="menu-icon fa fa-refresh"></i>
                                <span class="menu-text"> Année Courant </span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
<div id="my-modalpaie" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('paie/form_paie', array()); ?>
</div>

<div id="my-modaljournalpaie" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('paie/form_journalpaie', array()); ?>
</div>

<div id="my-modaldeclaration" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('paie/form_declarationcnss', array()); ?>
</div>

<div id="my-modaletatrecap" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('paie/form_etatrecap', array()); ?>
</div>
<script>
    function setAffichageSelect() {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
</script>

<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }
</style>