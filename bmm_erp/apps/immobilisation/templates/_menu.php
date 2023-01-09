<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="invisible">
            <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                <span class="sr-only">Toggle sidebar</span>
                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
            </button>
            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <?php $acces_immobilisation = $user->getProfilApplication("Unité Patrimoine (Immobilisation)");?>
                <?php if ($acces_immobilisation): ?>
                    <ul class="nav nav-list">
                        <li class="hover" id="menu_comp">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cog "></i>
                                <span class="menu-text"> Paramétres Globaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Catégorie d'immobilisation")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@categoerie') ?>">Catégories d'immo.</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Type Famille d'immobilisation")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@typefamille') ?>">Type Familles d'immo.</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Famille d'immobilisation")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@famille') ?>">Familles d'immo.</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Sous Famille d'immobilisation")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@sousfamille') ?>">Sous Familles d'immo.</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Sources de financement")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@sourcesfinancemment') ?>">Sources de financement</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Bureaux")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@bureaux') ?>">Bureaux</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Type Affectation Immo.")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@typeaffectationimmo') ?>">Type Affectation Immo.</a></li>


                                <!--<li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/categoerie")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@categoerie') ?>">Catégories d'immo.</a></li>-->
<!--                                <li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/typefamille")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@typefamille') ?>">Type Familles d'immo.</a></li>
                                <li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/famille")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@famille') ?>">Familles d'immo.</a></li>
                                <li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/sousfamille")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@sousfamille') ?>">Sous Familles d'immo.</a></li>
                                <li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/sourcesfinancemment")) echo 'disabledbutton' ?>" href="<?php // echo url_for('@sourcesfinancemment') ?>">Sources de financement</a></li>
                                <li><a href="<?php // echo url_for('@bureaux') ?>">Bureaux</a></li>
                                <li><a href="<?php // echo url_for('@typeaffectationimmo') ?>">Type Affectation Immo.</a></li>-->
                                <?php $parametre_amortissement = ParametreamortissementTable::getInstance()->findAll()->getFirst();?>
                                <?php if ($parametre_amortissement == null): ?>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Paramétrage Immo.")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('parametreamortissement/new') ?>">Paramétrage Immo.</a></li>
                                <?php else: ?>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Paramétrage Immo.")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('parametreamortissement/edit?id=' . $parametre_amortissement->getId()); ?>">Paramétrage Immo.</a></li>
                                <?php endif;?>
                    <!--<li><a href="<?php // echo url_for('@parents')     ?>">Gestions des Personnels</a></li>-->
                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Paramétrage Immo.")) {echo 'disabledbutton';}?>" href="<?php echo url_for('@organisme') ?>">Organisme</a></li>
<li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Paramétrage Immo.")) {echo 'disabledbutton';}?>" href="<?php echo url_for('@marqueimmobilisation') ?>">Marque</a></li>

                </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-home"></i>
                                <span class="menu-text"> Emplacements</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">

                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Bureaux")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@site') ?>">Sites</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Bureaux")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@etage') ?>">Sous Sites </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Paramètre Bureaux")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@bureaux') ?>">Locaux</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>                     

                        <li class="hover" id="menu_comp">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-tags"></i>
                                <span class="menu-text"> Gestion d'immobilisations </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                            <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Import Par. Immo.")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('import/importimmobExcel') ?>">Import Immo. Excel</a></li>
                                <li id="menu_comptable"><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Liste d'immobilisations")) {
    echo 'disabledbutton';
}
?>" href="<?php echo url_for('@immobilisation') ?>">Liste d'immobilisations</a></li>
                            <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Valider Immobilisation")) {echo 'disabledbutton';}?>" href="<?php echo url_for('immobilisation/listeNonValide') ?>">Valider Immobilisation</a></li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">

                                        <span class="menu-text">
                                            Transfert Immob.
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('Immob/transfer?type=Interne') ?>">Transfert d'immobilisation Intertne</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('documenttransfert/index?type=interne') ?>">Liste des Transferts Internes</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {    echo 'disabledbutton';}?>" href="<?php echo url_for('Immob/transfer?type=externe') ?>">Transfert d'immobilisation Externe</a></li>
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('documenttransfert/index?type=externe') ?>">Liste des Transferts Externes</a></li>
                                    </ul>
                                </li>
                                 </li>
                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">

                                        <span class="menu-text">
                                            Mise En Rebut
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('Immob/transfer?type=MiseEnRebus') ?>">Mise en rebut</a></li>

                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('documenttransfert/index?type=MiseEnRebus') ?>">Liste des Transferts Mise En Rebut</a></li>

                                    </ul>
                                </li>

                                <li class="hover">
                                    <a href="#" class="dropdown-toggle">

                                        <span class="menu-text">
                                           Vente
                                        </span>
                                        <b class="arrow fa fa-angle-down"></b>
                                    </a>
                                    <b class="arrow"></b>
                                    <ul class="submenu">
                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('Immob/transfer?type=Vente') ?>">Vente</a></li>

                                    <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php echo url_for('documenttransfert/index?type=Vente') ?>">Liste des Transferts Vente</a></li>
                                    </ul>
                                </li>
                            </ul></li>
                        <!--documentbudget-->
                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bookmark"></i>
                                <span class="menu-text"> Inventaire </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
<!--                                <li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/Inventaire")) echo 'disabledbutton' ?>" href="<?php // echo url_for('Inventaire/index') ?>">Ouvrir Inventaire</a></li>
                                <li><a class="<?php // if (!$user->getAcceesDroit("immobilisation.php/document")) echo 'disabledbutton' ?>" href="<?php // echo url_for('document/index') ?>">Recherche Inventaire</a></li>-->

                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Ouvrir Inventaire")) {echo 'disabledbutton';}?>" href="<?php echo url_for('Inventaire/index') ?>">Ouvrir Inventaire</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Recherche Inventaire")) {echo 'disabledbutton';}?>" href="<?php echo url_for('document/index') ?>">Recherche Inventaire</a></li>
                            </ul>
                        </li>
                        <li class="hover" id="menu_stat">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-bank"></i>
                                <span class="menu-text"> Statistique </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT GLOBAL/SITE")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?toussite=1') ?>">INVESTISSEMENT GLOBAL/SITE</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT GLOBAL/TYPE")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?tous=1') ?>">INVESTISSEMENT GLOBAL/TYPE</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT GLOBAL/LOCAUX")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?touslocal=1') ?>">INVESTISSEMENT GLOBAL/LOCAUX</a></li>

                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT PAR GATEGORIES")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?categorie=1') ?>">INVESTISSEMENT PAR GATEGORIES</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT PAR FAMILLE")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?famille=1') ?>">INVESTISSEMENT PAR FAMILLE&GATEGORIES</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT PAR FAMILLE")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?famillegeneral=1') ?>">INVESTISSEMENT PAR FAMILLE </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "INVESTISSEMENT PAR SOUS FAMILLE")) {echo 'disabledbutton';}?>" target="_black" href="<?php echo url_for('immobilisation/statistique?sfamille=1') ?>">INVESTISSEMENT PAR SOUS FAMILLE&FAMILLE</a></li>
                            </ul>
                        </li>
                        <li class="hover" id="menu_verificationpatrimoine">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text"> Document Justificatif </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Achat")) {echo 'disabledbutton';}?>" href="<?php echo url_for('@documentachat') ?>">Achat</a></li>
                               </ul>
                        </li>

                        <!-- <li class="hover" id="menu_stat">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-cogs"></i>
                                <span class="menu-text"> Opérations</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php //if (!$user->getProfilModule($acces_immobilisation->getId(), "Transfert Immo./Bureaux")) {echo 'disabledbutton';}?>" href="<?php //echo url_for('Immob/transfer') ?>">Transfert Immo./Bureaux</a></li>
                                <li><a class="<?php //if (!$user->getProfilModule($acces_immobilisation->getId(), "Import Par. Immo.")) {echo 'disabledbutton';}?>" href="<?php //echo url_for('import/parimmob') ?>">Import Par. Immo.</a></li>
                                <li><a class="<?php //if (!$user->getProfilModule($acces_immobilisation->getId(), "Valider Immobilisation")) {echo 'disabledbutton';}?>" href="<?php //echo url_for('immobilisation/listeNonValide') ?>">Valider Immobilisation</a></li>
                                <li><a target="_black" class="<?php //if (!$user->getProfilModule($acces_immobilisation->getId(), "Export Liste")) {echo 'disabledbutton';}?>" href="<?php //echo url_for('immobilisation/statistiquedate') ?>">Export Liste</a></li>
                            </ul>
                        </li> -->
                        <li class="hover" id="menu_tableau">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-table"></i>
                                <span class="menu-text"> Tableaux </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Tableau Amortissement")) {echo 'disabledbutton';}?>" href="<?php echo url_for('@tableauxammortisement') ?>">Tableau Amortissement</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Tableau de Variation des Immobilisations")) {echo 'disabledbutton';}?>" href="<?php echo url_for('tableauxammortisement/variation') ?>">Tableau de Variation des Immobilisations</a></li>
                            </ul>
                        </li>
                        <li class="hover" id="menu_stat">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-print"></i>
                                <span class="menu-text"> Editions </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "CODE-BAREE/IMMOB.")) {echo 'disabledbutton';}?>" href="<?php echo url_for('@Imprimercb') ?>">CODE-BAREE/IMMOB.</a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "CODE-BAREE/BUREAUX")) {echo 'disabledbutton';}?>" href="<?php echo url_for('bureaux/imprimercb') ?>">CODE-BAREE/BUREAUX</a></li>
                                <li><a target="_black" class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Export Liste")) {echo 'disabledbutton';}?>" href="<?php echo url_for('immobilisation/statistiquedate') ?>">Export Liste Immobilisations </a></li>
                                <li><a class="<?php if (!$user->getProfilModule($acces_immobilisation->getId(), "Imm. / Type Affectation")) {echo 'disabledbutton';}?>" href="<?php echo url_for('immobilisation/listeType') ?>">Export Imm. / Type d'affectation</a></li>

                                <!-- <li><a class="<?php //if (!$user->getProfilModule($acces_immobilisation->getId(), "Imm. / Type Affectation")) {echo 'disabledbutton';}?>" href="<?php //echo url_for('immobilisation/listeimmotransfert') ?>">Export Imm./Transfert </a></li> -->
                            </ul>
                        </li>

                    </ul>
                <?php endif;?>
            </div><!-- .sidebar -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->