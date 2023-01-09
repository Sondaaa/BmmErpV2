<?php if ($sf_user->isAuthenticated()) : ?>
  <?php
  $user = $sf_user->UserConnected();
  $skin = "no-skin";
  $container = "";
  $stylecontainer = "";

  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <!--<base href="../" />-->

    <title>Accueil - One ERP</title>

    <!-- include common vendor stylesheets & fontawesome -->


    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/solid.min.css">



    <!-- include fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&amp;display=swap">



    <!-- ace.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>oneerp/css/ace.min.css">


    <!-- favicon -->
    <link rel="icon" type="image/png" href="<?php echo sfconfig::get('sf_appdir') ?>/assets/favicon.png" />

    <!-- "Horizontal Menu" page styles, specific to this page for demo only -->
    <style>
      @media (min-width: 1200px) {
        .navbar-white .navbar-inner {
          border-bottom-color: #e6eaed !important;
        }
      }

      #infobox-row {
        box-shadow: 0 0 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.25rem;
        overflow: hidden;
      }

      @media (max-width: 991.98px) {
        #infobox-row {
          box-shadow: none;
          border-radius: 0;
        }

        #infobox-row div[role=button] {
          border-width: 0 !important;
          border-radius: 0.25rem;
          box-shadow: 0 0 0.25rem rgba(0, 0, 0, 0.075);
        }

       
      }
      .disabledbutton {
          pointer-events: none;
          opacity: 0.7;
        }
      .clearanddisplay a{
          pointer-events: none;
          opacity: 0.7;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>oneerp/css/ace-themes.min.css">

  </head>

  <body>
    <div class="body-container">
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
      <?php include_partial('global/sidebar',array('user'=>$user))?>

      <div class="main-container">

        <div role="main" class="main-content">
          <div class="page-content container container-plus px-md-4 px-xl-5">

            <div class="row mt-4 mt-lg-5">
              <div class="col-12 px-lg-0">
                <div class="center">
                  <?php $societe = SocieteTable::getInstance()->findAll()->getFirst(); ?>
                  <img src="<?php echo sfconfig::get('sf_appdir') ?>uploads/images/<?php echo $societe->getLogo(); ?>" style="width: 100%;max-width: 685px; max-height: 185px; margin-top: 50px;">

                </div>
              </div>
            </div>
          </div>

          <footer class="footer">
            <div class="footer-inner">
              <div class="h-100 pt-3 border-t-1 brc-secondary-l2 bgc-white-tp1 shadow-md">
                <span class="text-primary-m1 font-bolder text-120">One</span>
                <span class="text-secondary-d2">ERP &copy; <?php echo date('Y') ?></span>


              </div>
            </div><!-- .footer-inner -->
          </footer>


        </div>

      </div>

    </div>

    <!-- include common vendor scripts used in demo pages -->
    <script src="<?php echo sfconfig::get('sf_appdir') ?>node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo sfconfig::get('sf_appdir') ?>node_modules/popper.js/dist/popper.min.js"></script>
    <script src="<?php echo sfconfig::get('sf_appdir') ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>





    <!-- include ace.js -->
    <script src="<?php echo sfconfig::get('sf_appdir') ?>oneerp/js/ace.min.js"></script>



    



    <!-- "Horizontal Menu" page script to enable its demo functionality -->
    <script>
      jQuery(function($) {

            // add some big buttons to the "Mega" menu
            $('#sidebar .nav > .nav-item.active > .submenu > .submenu-inner')
              .prepend('<li class="nav-item">\
       <div class="d-flex flex-wrap justify-content-center flex-xl-nowrap p-2 bgc-default-l4">\
        <button type="button" class="btn btn-sm btn-app btn-outline-primary btn-bgc-white radius-1 my-1 mx-1">\
    			<i class="d-block h-6 fa fa-edit text-190"></i>\
    			Edit\
    			<span class="badge badge-warning badge-sm position-tl m-n2 text-70">11</span>\
        </button>\
        <button type="button" class="btn btn-sm btn-app btn-outline-secondary btn-bgc-white radius-1 my-1 mx-1">\
    			<i class="d-block h-6 fa fa-cog text-190"></i>\
    			Settings\
    			<span class="badge badge-sm py-2px position-tr text-75 mt-1px text-dark-tp4">+3</span>\
    		</button>\
    		<button type="button" class="btn btn-sm btn-app btn-outline-success btn-bgc-white radius-1 my-1 mx-1">\
    			<i class="d-block h-6 fa fa-sync text-190"></i>\
    			Reload\
    		</button>\
    	</div>\
    </li>')



            // when collapsing/expanding horizontal sidebar, remove/add `.nav-fill` class
            $('#sidebar')
              .on('collapse.ace.sidebar', function() {
                $(this).find('.nav').removeClass('nav-fill text-center')
                $('#id-full-width').prop('checked', false)
              })
              .on('expand.ace.sidebar', function() {
                $(this).find('.nav').addClass('nav-fill text-center')
                $('#id-full-width').prop('checked', true)
              })


            // make navbar non-fixed, sidebar fixed (sticky)
            $('#id-navbar-fixed').prop('checked', false)
            $('.navbar').toggleClass('navbar-fixed', false)


            /**
            $('#id-full-height')
            .on('change', function() {
               $('.sidebar .container').toggleClass('align-items-xl-end')
               $('.sidebar .nav').toggleClass('nav-link-rounded')
            })
            */

            $('#id-full-width')
              .on('change', function() {
                $('.sidebar .nav').toggleClass('nav-fill text-center')
              })

            $('#id-flip-highlight')
              .on('change', function() {
                $('.sidebar .nav').toggleClass('active-on-right')
              })

            $('#id-sm-highlight')
              .on('change', function() {
                $('.sidebar .nav').toggleClass('nav-active-sm')
              })
              $('.clearanddisplay a').attr('href','');
              $('.disabledbutton').attr('href','');
            })
    </script>
    <script type="text/javascript">
  $(document).ready(function() {
    if (window.location.href.indexOf("_dev") == -1) {
       $(document).bind("contextmenu", function (e) {
                return false;
            });
    }
  });
</script>
  </body>

  </html>
<?php
endif; ?>