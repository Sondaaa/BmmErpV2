<nav class="navbar navbar-sm navbar-fixed-xl navbar-expand-lg navbar-white">
        <div class="navbar-inner shadow-md">
          <div class="container container-plus">


            <div class="navbar-intro justify-content-xl-start bgc-transparent pr-lg-3 w-auto">

              <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none btn-h-white" data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="bars text-dark-tp5"></span>
              </button><!-- mobile sidebar toggler button -->

              <button type="button" class="btn btn-burger burger-compact align-self-center ml-2 d-none d-xl-flex btn-h-light-primary" data-toggle="sidebar" data-toggle-class="collapsed-h" data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                <span class="bars text-dark-tp5"></span>
              </button><!-- sidebar toggler button -->

              <a class="navbar-brand text-dark-l1 ml-lg-1" href="../index.html#">
                <i class="fa fa-leaf text-success"></i>
                <span>One</span>
                <span>ERP</span>
              </a><!-- /.navbar-brand -->

            </div><!-- /.navbar-intro -->









            <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">

              <div class="navbar-nav">
                <ul class="nav nav-compact has-active-border">




                  <li class="nav-item dropdown order-first order-lg-last dropdown-hover">
                    <a class="nav-link dropdown-toggle px-lg-2 ml-lg-3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i id="id-navbar-user-image" class="border-1 fa fa-user bg bg-red" height="42"></i>

                      <span class="d-inline-block d-lg-none">Bienvenue, <?php
                                                                        $user = $sf_user->UserConnected();
                                                                        if (isset($user)) {
                                                                          if ($user->getIdParent() != null)
                                                                            echo $user;
                                                                          else
                                                                            echo "Admin. Formanet";
                                                                        }
                                                                        ?></span><!-- show only on mobile -->

                      <i class="caret fa fa-ellipsis-v d-none d-xl-block"></i>
                      <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                    </a>

                    <div class="dropdown-menu dropdown-caret dropdown-menu-right brc-primary-m3">
                      <div class="d-none d-lg-block">
                        <div class="dropdown-header">
                          Bienvenue, <?php
                                      $user = $sf_user->UserConnected();
                                      if (isset($user)) {
                                        if ($user->getIdParent() != null)
                                          echo $user;
                                        else
                                          echo "Admin. Formanet";
                                      }
                                      ?>
                        </div>
                        <div class="dropdown-divider"></div>
                      </div>

                      <a class="dropdown-item btn btn-outline-grey btn-h-light-blue btn-a-light-primblueary" href="<?php echo url_for('@profil') ?>">
                        <i class="fa fa-user text-primary-m1 text-105 mr-1"></i>
                        Profile
                      </a>



                      <div class="dropdown-divider brc-secondary-l2"></div>

                      <a class="dropdown-item btn btn-outline-grey btn-h-light-orange btn-a-light-orange" href="<?php echo sfconfig::get('sf_appdir') . 'index.php' . url_for("/Admin/deconnect") ?>">
                        <i class="fa fa-power-off text-orange-d2 text-105 mr-1"></i>
                        Déconnectez
                      </a>
                    </div>
                  </li><!-- /.nav-item:last -->

                </ul><!-- /.navbar-nav menu -->
              </div><!-- /.navbar-nav -->

            </div><!-- /.navbar-menu.navbar-collapse -->


          </div><!-- /.container -->
        </div><!-- /.navbar-inner -->
      </nav>