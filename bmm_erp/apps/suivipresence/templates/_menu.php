<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>

            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_suivi = $user->getProfilApplication("Unité de Suivi des Présences et des Congés"); ?>
                <?php if ($acces_suivi): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-cog "></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Paramètre : Type Congé")) echo 'disabledbutton' ?>" href="<?php echo url_for('@typeconge') ?>">Type Congé</a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Paramètre : Férier")) echo 'disabledbutton' ?>" href="<?php echo url_for('@jourferier') ?>">Jour Férier</a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Paramètre : Motif Absence")) echo 'disabledbutton' ?>" href="<?php echo url_for('@motif') ?>">Motif d'absence</a></li>
                            </ul>
                        </li>
                        <!-- /.dropdown-user -->
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-calendar"></i>
                                <span class="menu-text"> Suivi de Présence </span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Présence")) echo 'disabledbutton' ?>" href="<?php echo url_for('@presence') ?>">Fiche Présence  </a></li>  
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-calendar"></i>
                                <span class="menu-text"> Congé</span>
                                <b class="arrow fa fa-calendar"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Congé")) echo 'disabledbutton' ?>" href="<?php echo url_for('@conge') ?>">Demande Congé </a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <?php $acces_conge = $user->getProfilModule($acces_suivi->getId(), "Suivi Congé"); ?>
                            <ul class="submenu">
                                <li><a class="<?php if (!$acces_conge) echo 'disabledbutton' ?>" href="#my-modalsuivi" role="button" onclick="insiliserselect()" data-toggle="modal">Suivi Individuel D'une Demande</a></li>
                                <li><a class="<?php if (!$acces_conge) echo 'disabledbutton' ?>" href="#my-modalTB" role="button" onclick="insiliserselect()" data-toggle="modal">T.B.Suivi Congés Individuels </a></li>
                                <li><a class="<?php if (!$acces_conge) echo 'disabledbutton' ?>" href="<?php echo url_for('conge/recapsuivi') ?>">T.B.Suivi Congés</a></li> 
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text-o"></i>
                                <span class="menu-text">Editions</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Edition : Liste Suivi Congé")) echo 'disabledbutton' ?>" href="#my-modaledition" role="button" data-toggle="modal">Edition Liste des Suivis des Congés</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bar-chart-o"></i>
                                <span class="menu-text"> Statistiques</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Statistique : Présence / Agent")) echo 'disabledbutton' ?>" href="<?php echo url_for('conge/statistiquePrsenceAgent') ?>">Présence Par Agent</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_suivi->getId(), "Statistique : Absence / Agent")) echo 'disabledbutton' ?>" href="<?php echo url_for('conge/statistiqueAbsenceAgent') ?>">Absence Par Agent</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<div id="my-modalsuivi" class="modal fade" tabindex="-1" style="width: 1200px; height: 1000px"> 
    <?php include_partial('conge/suivi', array()); ?>
</div>
<div id="my-modalTB" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('conge/tableaubord', array()); ?>
</div>

<div id="my-modaledition" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('conge/form_edition', array()); ?>
</div>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }
</style>
<script>
    function  insiliserselect()
    {
        $('.chosen-container').attr('style', 'width:100%');
        $('.chosen-container').trigger("chosen:updated");
    }
</script>