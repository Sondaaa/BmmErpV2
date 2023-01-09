<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <!--<base href="../" />-->

    <title>Login - One ERP</title>
    <link rel="icon" type="image/png" href="<?php echo sfconfig::get('sf_appdir') ?>assets/favicon.png" />
    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>node_modules/fontawesome-free/css/solid.min.css">



    <!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->


    <!-- include fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&amp;display=swap">



    <!-- ace.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo sfconfig::get('sf_appdir') ?>oneerp/css/ace.min.css">


    

    <!-- "Login" page styles, specific to this page for demo only -->
    <style>.body-container {
        background-image: linear-gradient(#6baace, #264783);
        background-attachment: fixed;
        background-repeat: no-repeat;
      }

      .carousel-item>div {
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }

      /* these rules are used to make sure in mobile devices, tab panes are not all the same height (for example 'forgot' pane is not as tall as 'signup' pane) */

      @media (max-width: 1199.98px) {
        .tab-sliding .tab-pane:not(.active) {
          max-height: 0 !important;
        }

        .tab-sliding .tab-pane.active {
          min-height: 80vh;
          max-height: none !important;
        }
      }
    </style>
  </head>

  <body>
    <div class="body-container">

      <div class="main-container container bgc-transparent">

        <div class="main-content minh-100 justify-content-center">
          <div class="p-2 p-md-4">
            <div class="row" id="row-1">
              <div class="col-12 col-xl-10 offset-xl-1 bgc-white shadow radius-1 overflow-hidden">

                <div class="row" id="row-2">

                  <div id="id-col-intro" class="col-lg-5 d-none d-lg-flex border-r-1 brc-default-l3 px-0">
                    <!-- the left side section is carousel in this demo, to show some example variations -->

                    <div id="loginBgCarousel" class="carousel slide minw-100 h-100">
                      <ol class="d-none carousel-indicators">
                        <li data-target="#loginBgCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#loginBgCarousel" data-slide-to="1"></li>
                        <li data-target="#loginBgCarousel" data-slide-to="2"></li>
                        <li data-target="#loginBgCarousel" data-slide-to="3"></li>
                      </ol>

                      <div class="carousel-inner minw-100 h-100">
                        <div class="carousel-item active minw-100 h-100">
                          <!-- default carousel section that you see when you open login page -->
                          <div style="background-image: url(<?php echo sfconfig::get('sf_appdir') ?>/assets/image/login-bg-1.svg);" class="px-3 bgc-blue-l4 d-flex flex-column align-items-center justify-content-center">
                            <a class="mt-5 mb-2" href="dashboard.html">
                              <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                            </a>

                            <h2 class="text-primary-d1">
                              One <span class="text-80 text-dark-l1">ERP</span>
                            </h2>

                            <div class="mt-5 mx-4 text-dark-tp3">
                              <span class="text-80">
                            <p>  ONE ERP votre progiciel intégrés, modulables et indispensable au bon fonctionnement de votre entreprise. Il est Flexible, il vous suit au quotidien, s’adaptent à votre organisation et à votre infrastructure. </p>
                            <p>ONE ERP remplace une multitude d'applications non reliées, assurant ainsi un dialogue de gestion entre les différents intervenants d'une administration publique ou privée.</p>
                            <p>
                            ONE ERP regroupe toutes les fonctionnalités permettant l'optimisation et la bonne répartition des tâches.
    </p>
                            <p>Suivre à la lettre l’avancée du plan établi au préalable est le meilleur moyen pour aller au bout de vos idées.</p>
                          <h6>« ONE ERP » le progiciel de vos pensées</h6>
                       </span>
                              <hr class="mb-1 brc-black-tp10" />
                              <div>
                                <a id="id-start-carousel" href="../index.html#" class="text-95 text-dark-l2 d-inline-block mt-3">
                                  <i class="far fa-image text-110 text-purple-m1 mr-1 w-2"></i>
                                  Changer l'image de fond
                                </a>
                                <br />
                                <a id="id-remove-carousel" href="../index.html#" class="text-md text-dark-l2 d-inline-block mt-3">
                                  <i class="far fa-trash-alt text-110 text-orange-d1 mr-1 w-2"></i>
                                  Supprimer cette section
                                </a>
                                <br />
                                <a id="id-fullscreen" href="../index.html#" class="text-md text-dark-l2 d-inline-block mt-3">
                                  <i class="fa fa-expand text-110 text-green-m1 mr-1 w-2"></i>
                                  Agrandir
                                </a>
                              </div>
                            </div>

                            <div class="mt-auto mb-4 text-dark-tp2">
                              One ERP &copy; <?php echo date('Y')?>
                            </div>
                          </div>
                        </div>



                        <div class="carousel-item minw-100 h-100">
                          <!-- the second carousel item with dark background -->
                          <div style="background-image: url(../assets/image/login-bg-2.svg);" class="d-flex flex-column align-items-center justify-content-start">
                            <a class="mt-5 mb-2" href="dashboard.html">
                              <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                            </a>

                            <h2 class="text-blue-l1">
                              One <span class="text-80 text-white-tp3">ERP</span>
                            </h2>
                          </div>
                        </div>



                        <div class="carousel-item minw-100 h-100">
                          <div style="background-image: url(../assets/image/login-bg-3.jpg);" class="d-flex flex-column align-items-center justify-content-start">
                            <div class="bgc-black-tp4 radius-1 p-3 w-90 text-center my-3 h-100">
                              <a class="mt-5 mb-2" href="dashboard.html">
                                <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                              </a>

                              <h2 class="text-blue-l1">
                                One <span class="text-80 text-white-tp3">ERP</span>
                              </h2>
                            </div>
                          </div>
                        </div>



                        <div class="carousel-item minw-100 h-100">
                          <div style="background-image: url(../assets/image/login-bg-4.jpg);" class="d-flex flex-column align-items-center justify-content-start">
                            <a class="mt-5 mb-2" href="dashboard.html">
                              <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                            </a>

                            <h2 class="text-blue-d1">
                              One <span class="text-80 text-dark-tp3">ERP</span>
                            </h2>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>


                  <div id="id-col-main" class="col-12 col-lg-7 py-lg-5 bgc-white px-0">
                    


                    <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">

                      <div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
                        <!-- show this in desktop -->
                        <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
                          <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130">
                            <i class="fa fa-eye text-orange-m1 mr-1"></i>
                            Bienvenue dans l'environnement ONE ERP
                          </h4>
                        </div>

                        <!-- show this in mobile device -->
                        <div class="d-lg-none text-secondary-m1 my-4 text-center">
                          <a href="dashboard.html">
                            <i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
                          </a>
                          <h1 class="text-170">
                            <span class="text-blue-d1">
                                One <span class="text-80 text-dark-tp3">E.R.P</span>
                            </span>
                          </h1>

                          Bienvenue dans l'envirenement ONE ERP
                        </div>

                        <?php echo $sf_content ?>
                        


                        <div class="form-row">
                          <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                            <hr class="brc-default-l2 mt-0 mb-2 w-100" />

                            

                            
                          </div>
                        </div>
                      </div>


                     


                     
                    </div><!-- .tab-content -->
                  </div>

                </div><!-- /.row -->

              </div><!-- /.col -->
            </div><!-- /.row -->

            
          </div>
        </div>

      </div>

    </div>

    <!-- include common vendor scripts used in demo pages -->
    <script src="<?php echo sfconfig::get('sf_appdir') ?>node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo sfconfig::get('sf_appdir') ?>node_modules/popper.js/dist/popper.min.js"></script>
    <script src="<?php echo sfconfig::get('sf_appdir') ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


    <!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->


    <!-- include ace.js -->
    <script src="<?php echo sfconfig::get('sf_appdir') ?>oneerp/js/ace.min.js"></script>



    



    <!-- "Login" page script to enable its demo functionality -->
    <script>
      jQuery(function($) {
        // because "Login Here" and "Signup now" links are not inside a "UL" or ".nav", they preserve "active" class
        // and we should remove that, to be able to move between tab panes
        $('a[data-toggle="tab"]')
          .on('click', function() {
            $('a[data-toggle="tab"]').removeClass('active')
          })


        // start/show carousel to change backgrounds
        $('#id-start-carousel')
          .on('click', function(e) {
            e.preventDefault()
            $('.carousel-indicators').removeClass('d-none')
            $('#loginBgCarousel').carousel(1)
          })

        var isFullsize = false

        // remove the background/carousel section
        // if you want a compact login page (without the carousel area), you should do so in your HTML
        // but in this demo, we modify HTML using JS
        $('#id-remove-carousel')
          .on('click', function(e) {
            e.preventDefault()

            $('#id-col-intro').remove() // remove the .col that contains carousel/intro
            $('#id-col-main').removeClass('col-lg-7') // remove the col-* class name for the login area

            $('#row-1')
              .addClass('justify-content-center') // so .col is centered

              .find('> .col-12') // change .col-12.col-xl-10, etc to .col-12.col-lg-6.col-xl-5 (so our login area is 50% of document width in `lg` mode , etc)        
              .removeClass('col-12 col-xl-10 offset-xl-1').addClass(!isFullsize ? 'col-12 col-lg-6 col-xl-5' : '')


            $('.col-md-8.offset-md-2.col-lg-6.offset-lg-3') // the input elements that are inside "col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3" columns
              // ... remove '.col-lg-6 offset-lg-3' (will become .col-md-8)
              .removeClass('col-lg-6 offset-lg-3')

            // remove "Welcome Back" etc titles that were meant for desktop, and show the other titles that were meant for mobile (lg-) view
            // because this compact login page is similar to mobile view
            $('h4').each(function() {
              var mobileTitle = $(this).parent().next()
              if (mobileTitle.hasClass('d-lg-none')) mobileTitle.removeClass('d-lg-none').prev().remove()
            })
          })


        // make the login area fullscreen
        // if you want a fullscreen login page you should do so in your HTML
        // but in this demo, we modify HTML using JS
        $('#id-fullscreen')
          .on('click', function(e) {
            e.preventDefault()
            if (window.navigator.msPointerEnabled) $('.body-container').addClass('h-100') // for IE only

            isFullsize = true

            $('.main-container').removeClass('container')

            $('.main-content').removeClass('justify-content-center minh-100').addClass('px-4 px-lg-0')
              .children().attr('class', 'd-flex flex-column flex-lg-row flex-grow-1 my-3 m-lg-0') // removes padding classes and add d-flex, etc

            $('#row-1')
              .addClass('flex-grow-1')
              .find('> .col-12').removeClass('shadow radius-1 col-xl-10 offset-xl-1').addClass('d-lg-flex') //remove shadow, etc from, the child .col and add d-lg-flex

            $('#row-2').addClass('flex-grow-1')

            $('#id-col-intro').removeClass('col-lg-5').addClass('col-lg-4')
            $('#id-col-main').removeClass('col-lg-7 offset-2').addClass('col-lg-6 mx-auto d-flex align-items-center justify-content-center')
          })

      })
    </script>
  </body>

</html>
