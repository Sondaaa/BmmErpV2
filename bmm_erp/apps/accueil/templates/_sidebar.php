<div id="sidebar" class="sidebar sidebar-fixed sidebar-hover sidebar-h sidebar-white sidebar-top" data-swipe="true" data-backdrop="true" data-dismiss="true">
  <div class="sidebar-inner border-r-0 border-b-1 brc-secondary-l2 shadow-md">
    <div class="container container-plus px-0 d-flex flex-column flex-xl-row">

      <div class="flex-grow-1 d-xl-flex flex-xl-row ace-scroll" data-ace-scroll="{}">
        <!-- ace-scroll is not applied in desktop view, but it's used in mobile view -->
        <div class="sidebar-section">
          <div class="sidebar-section-item fadeable-below fadeable-center px-3">

            <div class="fadeinable sidebar-shortcuts-mini w-auto" role="button">
              <div>
                <div>
                  <span class="btn btn-success p-0"></span><span class="btn btn-info p-0"></span>
                </div>
                <div class="mt-n2">
                  <span class="btn btn-info p-0"></span><span class="btn btn-success p-0"></span>
                </div>
              </div>
            </div>



          </div>
        </div>
        <ul class="nav nav-spaced nav-fill text-center nav-active-sm has-active-border active-on-top">
          <li class="nav-item-caption">
            <span class="fadeable pl-3">ADMINISTRATION</span>
            <span class="fadeinable mt-n2 text-125">&hellip;</span>
          </li>

          <li class="nav-item">
            <a href="<?php echo url_for('utilisateur/index') ?>" class="nav-link <?php if (!$user->getProfilApplication("Administration E.R.P")) {echo 'disabledbutton';}?>">
              <i class="nav-icon fa fa-home"></i>
              <span class="nav-text fadeable">
                <span>ADMINISTRATION</span>
              </span>
            </a>
            <b class="sub-arrow"></b>

          </li>

          <li class="nav-item">

            <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-envelope"></i>
              <span class="nav-text fadeable">
                <span>GESTION DES COURRIERS</span>
              </span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
                <li class="nav-item">

                <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?bureau=abo" class="<?php if (!$user->getProfilApplication("Administration Bureau d'ordre")) {
    echo 'disabledbutton';
}
?>">
                        </a>
                        <b class="arrow"></b>
                  <a href="<?php echo sfconfig::get('sf_appdir') . "budget.php" ?>" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Budget")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">
                    Administrat?? Bureau d'Ordre
                    </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Responsable bureau d'ordre")->getIdFamexpdes(); ?>&bureau=boc"
                  class="nav-link <?php if (!$user->getProfilApplication("Bureau d'Ordre Central")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">
                    Bureau d'Ordre Central
                    </span>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="../index.html#" class="nav-link dropdown-toggle collapsed">
                    <span class="nav-text">
                      <span>Secr??tariats</span>
                    </span>
                    <b class="caret fa fa-angle-left rt-n90"></b>
                  </a>
                  <div class=" submenu collapse">
                    <ul class="submenu-inner">
                      <li class="nav-item">
                      <a href="../index.html#" class="nav-link dropdown-toggle collapsed">
                    <span class="nav-text">
                    <span> Secr??tariat SOUS/DAF</span>
                    </span>
                    <b class="caret fa fa-angle-left rt-n90"></b>
                      </a>
                      <div class=" submenu collapse">
                    <ul class="submenu-inner">
                    <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Secr??tariat sous DAF")->getIdFamexpdes(); ?>&bureau=daf"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat SOUS/DAF : Gestion des Courriers")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>  Gestion des Courriers</span>
                          </span>
                        </a>                      
                      </li>
                  </ul>
                      </div>
                    </a>
                      </li>
                      <li class="nav-item">
                      <a href="../index.html#" class="nav-link dropdown-toggle collapsed">
                    <span class="nav-text">
                    <span> Secr??tariat SOUS/DCG</span>
                    </span>
                    <b class="caret fa fa-angle-left rt-n90"></b>
                      </a>
                      <div class=" submenu collapse">
                    <ul class="submenu-inner">
                    <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unit?? de contr??le de gestion et Cellule informatique ")->getIdFamexpdes(); ?>&bureau=dcg"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat SOUS/DCG : Gestion des Courriers")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>  Gestion des Courriers</span>
                          </span>
                        </a>                      
                      </li>
                  </ul>
                      </div>
                    </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction des travaux ")->getIdFamexpdes(); ?>&bureau=sdt"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Direction des Travaux")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Direction des Travaux</span>
                          </span>
                        </a>

                        
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction de planification et suivi ")->getIdFamexpdes(); ?>&bureau=sdps"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Direction de Planification et Suivi")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Direction de Planification et Suivi</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Direction de planification et suivi ")->getIdFamexpdes(); ?>&bureau=sdps"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Direction de Planification et Suivi")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Unit?? Audit Interne</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Officier de securite militaire")->getIdFamexpdes(); ?>&bureau=sosm"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Officier de S??curit?? Militaire")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Officier de S??curit?? Militaire</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?bureau=ssmre"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Service du Mat??riel Roulant et des Engins")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Service du Mat??riel Roulant et des Engins</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Bureau du personnel militaire ")->getIdFamexpdes(); ?>&bureau=sbpm"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Bureau du Personnel Militaire")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Bureau du Personnel Militaire</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("S.Unit?? de contr??le de gestion et Cellule informatique ")->getIdFamexpdes(); ?>&bureau=suci"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat UCG et Cellule Informatique")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. UCG et Cellule Informatique</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php/?id_famexpdes=<?php echo $user->getRoleByLibelle("Responsable Affaire Sociale")->getIdFamexpdes(); ?>&bureau=sas"
                         class="nav-link <?php if (!$user->getProfilApplication("Secr??tariat Affaires Sociales")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>S. Affaires Sociales</span>
                          </span>
                        </a>
                        </a>
                      </li>

                    </ul>
                  </div>
                  <b class="sub-arrow"></b>
                </li>
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>
          <li class="nav-item">

            <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-cube"></i>
              <span class="nav-text fadeable">
                <span>Finance</span>
              </span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
           
            <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') . "budget.php" ?>"class="nav-link <?php if (!$user->getProfilApplication("Unit?? Budget")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">
                      Budget
                    </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>achats.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Achats")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text">
                      Achats
                    </span>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>marchee.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? March??s")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text">
                      March??s
                    </span>
                  </a>

                </li>

                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>stock.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Gestion des Stocks")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text"> Gestion des Stocks</span>
                  </a>

                </li>
                <li class="nav-item">
<a href="<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Patrimoine (Immobilisation)")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text"> Gestion Patrimoine</span>
                  </a>
                  

                </li>
                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>facturation.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Contr??le des Factures")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text"> Contr??le des Factures</span>
                  </a>

                </li>
                <li class="nav-item">

                  <a href="../index.html#" class="nav-link dropdown-toggle collapsed">

                    <span class="nav-text">
                      <span>Tr??sorerie</span>
                    </span>

                    <b class="caret fa fa-angle-left rt-n90"></b>

                    <!-- or you can use custom icons. first add `d-style` to 'A' -->
                    <!--
                										 	<b class="caret d-n-collapsed fa fa-minus text-80"></b>
                										 	<b class="caret d-collapsed fa fa-plus text-80"></b>
                										 -->
                  </a>

                  <div class=" submenu collapse">
                    <ul class="submenu-inner">
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') . "tresoriecaisse.php" ?>" class="nav-link <?php if (!$user->getProfilApplication("Banque")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>Banques</span>
                          </span>
                        </a>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo sfconfig::get('sf_appdir') . "tresorie.php" ?>" class="nav-link <?php if (!$user->getProfilApplication("Banque")) {echo 'disabledbutton';}?>">
                          <span class="nav-text">
                            <span>Caisse</span>
                          </span>
                        </a>
                      </a>
                      </li>
                    </ul>
                  </div>

                  <b class="sub-arrow"></b>
                </li>
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-briefcase"></i>
              <span class="nav-text fadeable">
                <span>Comptabilit??</span>
              </span>
              <b class="caret fa fa-angle-left rt-n90"></b>
                </a>
                <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
               <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>comptabilite.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Comptabilit?? G??n??rale")) {echo 'disabledbutton';}?>">
                    <span class="nav-text"> Unit?? Comptabilit?? G??n??rale</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>analytique.php" class="nav-link  <?php if (!$user->getProfilApplication("Unit?? Comptabilit?? Analytique")) {echo 'disabledbutton';}?>">
                    <span class="nav-text"> Unit?? Comptabilit?? Analytique</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!--Ressource Humaine-->
          <li class="nav-item">
            <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-users"></i>
              <span class="nav-text fadeable">
                <span>Ressources Humaines</span>
              </span>
              <b class="caret fa fa-angle-left rt-n90"></b>
                   </a>
                   <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
                <li class="nav-item">
               
                <a href="<?php echo sfconfig::get('sf_appdir') ?>paie.php" 
                class="nav-link <?php if (!$user->getProfilApplication("Unit?? Paie")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">Unit?? Paie</span>
                  </a>                                
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>Ressourcehumaine.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Gestion des Carri??res et des Ouvriers Occasionnels")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">U. Gestion des Carri??res et des Ouvriers Occasionnels</span>
                  </a>


                  <a href="<?php echo sfconfig::get('sf_appdir') ?>formation.php" class="nav-link <?php if (!$user->getProfilApplication("Formation")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">Unit?? Formation</span>
                  </a>
                
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>suivipresence.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? de Suivi des Pr??sences et des Cong??s")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">U. de Suivi des Pr??sences et des Cong??s</span>
                  </a>

                  
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>affairesociale.php" class="nav-link <?php if (!$user->getProfilApplication("Unit?? des Affaires Sociales")) {echo 'disabledbutton';}?>">
                    <span class="nav-text"> U. des Affaires Sociales</span>
                  </a>                  
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-eye"></i>
              <span class="nav-text fadeable">
                <span>Contr??le de gestion</span>
              </span>

              <b class="caret fa fa-angle-left rt-n90"></b>

              <!-- or you can use custom icons. first add `d-style` to 'A' -->
              <!--
                	 	<b class="caret d-n-collapsed fa fa-minus text-80"></b>
                	 	<b class="caret d-collapsed fa fa-plus text-80"></b>
                	 -->
            </a>

            <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
                <li class="nav-item">

                  <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=0" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Contr??le Budg??taire")) {echo 'disabledbutton';}?>">
                    <span class="nav-text"> Contr??le Budg??taire</span>
                  </a>

                </li>
                <li class="nav-item">

                  <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=1" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Statistiques et Suivi")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text"> Statistiques et Suivi</span>
                  </a>

                </li>
                <li class="nav-item">

                  <a href="<?php echo sfconfig::get('sf_appdir') ?>controlegestion.php/?stat=2" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Contr??le des Co??ts")) {
    echo 'disabledbutton';
}
?>">
                    <span class="nav-text"> Contr??le des Co??ts</span>
                  </a>

                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">

            <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-cube"></i>
              <span class="nav-text fadeable">
                <span>Audit interne</span>
              </span>

              <b class="caret fa fa-angle-left rt-n90"></b>


            </a>

            <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>audit.php/?stat=0" class="nav-link
                   <?php if (!$user->getProfilApplication("Unit?? Audit interne")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">
                    Plan Annuel d'Audit
                    </span>
                  </a>                  
                </li>
                <li class="nav-item">
                  <a href="<?php echo sfconfig::get('sf_appdir') ?>audit.php/?stat=1" class="nav-link <?php if (!$user->getProfilApplication("Unit?? Audit interne")) {echo 'disabledbutton';}?>">
                    <span class="nav-text">
                    Justificatif d'Audit
                    </span>
                  </a>                  
                </li>
                <li class="nav-item">
                  <a target="_blanck" href="<?php echo sfconfig::get('sf_appdir') ?>audit.php/?stat=2" class="nav-link  <?php if (!$user->getProfilApplication("Unit?? Audit interne")) {echo 'disabledbutton';}?>">
                    <span class="menu-text">
                    Missions d'Audit
                    </span>
                  </a>                  
                </li>                
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>
          <li class="nav-item">
          <a class="nav-link dropdown-toggle">
              <i class="nav-icon fa fa-file"></i>
              <span class="menu-text">
                <span> TAB.BORD</span>
              </span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>

            <div class="hideable submenu collapse show ">
              <ul class="submenu-inner">
                <li class="nav-item">
                  <a  href="<?php echo sfconfig::get('sf_appdir') ?>direction.php" class="nav-link <?php if (!$user->getProfilApplication("Direction G??n??rale")) echo 'disabledbutton'; ?>">                 
                    <span class="menu-text">
                    GENERALE
                    </span>
                  </a>
  </li>
                <li class="nav-item">
                  <a  href="<?php echo sfconfig::get('sf_appdir') ?>direction.php"
                   class="nav-link <?php if (!$user->getProfilApplication("Direction SOUS/DAF")) echo 'disabledbutton'; ?>">
                    <span class="nav-text">
                    SOUS/DAF
                    </span>
                  </a>
                </li>
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>
      </div>


     

      <div class="sidebar-section d-none d-xl-flex ml-xl-auto pl-xl-4">
        <!-- the logout and settings button, only shown in desktop view -->
        <div class="sidebar-section-item fadeable-below fadeable-center">
          <div class="fadeinable w-auto">
            <a href="<?php echo sfconfig::get('sf_appdir') . 'index.php' . url_for("/Admin/deconnect") ?>" title="Logout" class="btn btn-outline-blue btn-brc-tp radius-3px py-2">
              <i class="fa fa-power-off text-140"></i>
            </a>
          </div>
        </div>
      </div>
    </div><!-- .container -->
  </div><!-- .sidebar-inner -->
</div>