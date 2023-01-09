<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>

            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_formation = $user->getProfilApplication("Unité Formation"); ?>
                <?php if ($acces_formation): ?>
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa  fa-cog "></i>
                                <span class="menu-text"> Paramètres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Paramètre : Domaine d'Utilisation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@domaineuntilisation') ?>">Domaine d'utilisation </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Paramètre : Rubrique")) echo 'disabledbutton' ?>" href="<?php echo url_for('@rubriqueformation') ?>">Rubrique </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Paramètre : Sous Rubrique")) echo 'disabledbutton' ?>" href="<?php echo url_for('@sousrubrique') ?>">Sous Rubrique </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Paramètre : Regroupement des Thèmes de Formation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@regroupementtheme') ?>">Regroupement des  Thèmes de Formation  </a></li>  
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Paramètre : Formateur")) echo 'disabledbutton' ?>" href="<?php echo url_for('@formateur') ?>"> Formateur  </a></li>    
                            </ul>
                        </li>
                        <!-- /.dropdown-user -->
                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Besoin de Formation")) echo 'disabledbutton' ?>" class href="<?php echo url_for('@besoinsdeformation') ?>">
                                <i class="menu-icon fa fa-briefcase"></i>
                                <span class="menu-text"> Besoins de Formation  </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                        </li> 

                        <li>
                            <a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Planning Prévisionnel")) echo 'disabledbutton' ?>" class href="<?php echo url_for('@planing') ?>">
                                <i class="menu-icon fa fa-calendar"></i>
                                <span class="menu-text"> Planning Prévisionnel </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-desktop"></i>
                                <span class="menu-text"> Tableau de Bord </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "T.B. Execution Plan Définitif")) echo 'disabledbutton' ?>" href="#my-modalplan" role="button" onclick="insiliserselect()" data-toggle="modal">T.B.Execution Plan Défintif</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Suivi des Règlements")) echo 'disabledbutton' ?>" href="#my-modalplan2" role="button" onclick="insiliserselect()" data-toggle="modal">Suivi des Règlements</a></li>
                            </ul>
                        </li>
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-gavel"></i>
                                <span class="menu-text"> Evaluation</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Evaluation")) echo 'disabledbutton' ?>" href="<?php echo url_for('@evaluation') ?>">Formulaire d'Evaluation</a></li>
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
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Edition : Liste Agents")) echo 'disabledbutton' ?>" href="#my-modaledition" role="button" data-toggle="modal">Edition Liste des Agents </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Edition : Liste Formations")) echo 'disabledbutton' ?>" href="#my-modaleditionformation" role="button" data-toggle="modal">Edition Liste des Formations</a></li>
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
                                <li><a class="<?php if (!$user->getProfilModule($acces_formation->getId(), "Statistique : Agent")) echo 'disabledbutton' ?>" href="<?php echo url_for('evaluation/statistiqueEvaluationAgent') ?>">Par Agent</a></li>
                            </ul>
                        </li>
                        <!-- /.dropdown-user -->
                    </ul>
                <?php endif; ?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
<div id="my-modalplan" class="modal fade" tabindex="-1" style="width: 1200px; height: 1000px"> 
    <?php include_partial('planing/form_plan', array()); ?>
</div>
<div id="my-modalplan2" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('planing/form_plan2', array()); ?>
</div>
<div id="my-modaltableau" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('planing/form_tableaudebord', array()); ?>
</div>
<div id="my-modaledition" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('planing/form_edition', array()); ?>
</div>

<div id="my-modaleditionformation" class="modal fade" tabindex="-1" style="width: 1200px"> 
    <?php include_partial('planing/form_edition_formation', array()); ?>
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