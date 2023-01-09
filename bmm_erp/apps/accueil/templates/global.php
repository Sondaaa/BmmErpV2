<?php if ($this->getUser()->isAuthenticated()): ?>
<?php

$user = new Utilisateur();
$user=$this->getUser()->getAttribute('userB2m');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>

        <link rel="icon" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/images/icon.ico" />


        <!-- Bootstrap Core CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Custom CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>dist/css/sb-admin-2.css" rel="stylesheet"/>
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>


        <!-- Custom Fonts -->

        <style>
            body{
                padding: 10px;
                text-align: left;
                font-size: 12px;
                font-weight: bold;


            }
            .sf_admin_td_actions{
                display: -webkit-box;
            }
            .navbar-default {
                background-color: #f7f7f7 !important;
                border-color: #5cb85c !important;
            }
            .table-contenue{
                margin-top: -35px;
            }
            .btn-primary{
                color: #fff !important;
            }
            .col-lg-2{
                width: 20% !important;
            }

            .navbar-default {
                background-color: rgba(255,255,255,0.9);
                border-color: #5cb85c;
            }
            a {
                color: #5cb85c;
                text-decoration: none;
            }

            .sf_admin_text   a{
                color: black ;
                text-decoration: none;
            }
            .nav>li>a:hover{
                color: white;
                background-color: #5cb85c;
            }
            .nav>li>a.active{
                color: white;
                background-color: #5cb85c !important;
            }
            .nav>li>a:focus, .nav>li>a:hover{
                color: white !important;
                background-color: #5cb85c !important;
            }
            .sf_admin_foreignkey a{
                color: black ;
                text-decoration: none;
            }
            .sf_admin_date  a{
                color: black ;
                text-decoration: none;
            }
            ul li{
                list-style: none;
                margin: 5px;
            }

            .sf_admin_filter{
                width: 976px;
                padding: 10px;
            }
            #sf_admin_content {
                padding: 10px;
            }
            .modal-dialog{
                width: 75% !important;
            }
            .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){
                width: 250px !important;
            }
            .disabledbutton {
                pointer-events: none;
                opacity: 0.1;
            }
            .huge{
                font-size: 30px !important;
            }
        </style>

    </head>
    <body  style="background: url(<?php echo sfconfig::get('sf_appdir') ?>images/intro.png);background-repeat: repeat">

        <div id="wrapper">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="panel"  style="background-color: black">
                        <div class="panel-heading">
                            <div class="row">

                                <img src="<?php echo sfconfig::get('sf_appdir') ?>images/logo_bmm.png">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-3" onmouseover="ActiveService(1)" >
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">S/DAF</div>
                                    <div>SOUS DAF</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-3" onmouseover="ActiveService(2)">
                    <div class="panel panel-yellow">
                        <div class="panel-heading"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-envelope-square  fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">G.Courrier</div>
                                    <div>GESTION DU COURRIER</div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-rouge">
                        <div class="panel-heading">

                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa    fa-wrench fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Admin ERP</div>
                                    <div>  <a class="<?php if (!$user->getAcceesDroit("utilisateur/index")) echo 'disabledbutton' ?>" href="<?php echo url_for('utilisateur/index') ?>" style="color: white">Connectez-Vous!!!</a></div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="row" style="display: none" id="gestioncourrier">

                <div class="col-lg-4 col-md-8" >
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th-large fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">B.O.Central</div>
                                    <div>Bureau d'ordre central</div>
                                </div>
                            </div>

                        </div>
                        <div class="footer">
                            <a  class="<?php
                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("responsable bureaux d'ordre"))
                                echo '';
                            else
                                echo 'disabledbutton';
                            ?>" href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                        Connectez-vous!
                                    </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading"> 
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa  fa-th  fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">S.D.G</div>
                                    <div>Secrétariat Direction générale</div>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <a  class="<?php
                            if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("Secretariat bureaux d'ordre"))
                                echo '';
                            else
                                echo 'disabledbutton';
                            ?>" href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                        Connectez-vous!</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>



            </div>
            <div class="row" style="display: none" id="servicedaf">
                <div class="col-lg-2 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <a style="color: white !important" class="<?php echo 'disabledbutton' ?>" href="<?php echo url_for('utilisateur/index') ?>">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <i class="fa    fa-sitemap fa-3x"></i>
                                    </div>
                                    <div class="col-xs-10 text-right">
                                        <div class="huge">Secrétariat</div>
                                        <div>Secrétariat sous DAF</div>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <div class="footer">
                            <a  class="<?php if ($user->getAcceesDroit("bureauxdordre.php/expdest") && $user->getAcceesDroit("Secrétariat sous DAF"))
                                echo '';
                            else
                                echo 'disabledbutton';
                            ?>" href="<?php echo sfconfig::get('sf_appdir') ?>bureauxdordre.php">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                        Connectez-vous!</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>
                <div class="col-lg-2 col-md-8" onmouseover="ActiveUnite(1)">
                    <div class="panel panel-green1">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-1">
                                    <i class="fa fa-th-large fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <div class="huge">S.Financier</div>
                                    <div>Service Financier</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green1">
                        <div class="panel-heading"> 
                            <div class="row">
                                <div class="col-xs-1">
                                    <i class="fa  fa-th  fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <div class="huge">S.Comptabilité</div>
                                    <div>Service Comptabilité</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="panel panel-green1">
                        <div class="panel-heading"> 
                            <div class="row">
                                <div class="col-xs-1">
                                    <i class="fa fa-users  fa-3x"></i>
                                </div>
                                <div class="col-xs-11 text-right">
                                    <div class="huge">S.Ressources Humaines</div>
                                    <div>Service Ressources humaines</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row" style="display: none" id="unitefinance">
                <div class="col-lg-2 col-md-8">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa   fa-file-o fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Achats</div>

                                </div>
                            </div>
                        </div>
                        <a  class="<?php if (!$user->getAcceesDroit("achats.php")) echo 'disabledbutton' ?>" href="<?php echo sfconfig::get('sf_appdir') ?>achats.php">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa   fa-briefcase fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Marchés</div>

                                </div>
                            </div>
                        </div>
                        <a class="<?php echo 'disabledbutton' ?>" href="<?php echo url_for('utilisateur/index') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa   fa-codepen fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Gestion des Stocks</div>

                                </div>
                            </div>
                        </div>
                        <a class="<?php if (!$user->getAcceesDroit("stock.php")) echo 'disabledbutton' ?>" href="<?php echo sfconfig::get('sf_appdir') ?>stock.php">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa    fa-barcode fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Patrimoine</div>

                                </div>
                            </div>
                        </div>
                        <a class="<?php if (!$user->getAcceesDroit("immobilisation.php")) echo 'disabledbutton' ?>" href="<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-4 col-md-8">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-1">
                                    <i class="fa   fa-edit fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <div class="huge">Contrôle des Factures</div>

                                </div>
                            </div>
                        </div>
                        <a class="<?php echo 'disabledbutton' ?>" href="<?php echo url_for('utilisateur/index') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa    fa-sitemap fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Budget</div>

                                </div>
                            </div>
                        </div>
                        <a class="<?php if (!$user->getAcceesDroit("budget.php")) echo 'disabledbutton' ?>" href="<?php echo sfconfig::get('sf_appdir') . "budget.php" ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="panel panel-green2">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa    fa-sitemap fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Trésorerie</div>

                                </div>
                            </div>
                        </div>
                        <a class="<?php echo 'disabledbutton' ?>" href="<?php echo url_for('utilisateur/index') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>



            </div>



            <div class="row" style="display: none">



                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-bleu">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-right">
                                    <div class="huge">G.B.O</div>
                                    <div>Gestion bureaux d'ordre!</div>
                                </div>
                            </div>
                        </div>
                        <a class="<?php if (!$user->getAcceesDroit("Accueil/utilisateur")) echo 'disabledbutton' ?>" href="bureauxdordre.php">
                            <div class="panel-footer">
                                <span class="pull-left">Connectez-vous!</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



        </div>


        <!-- jQuery -->









    </body>
</html>
<style>
    body{

        background-size: 100% 100%;

    }
    .col-lg-12{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
    .disabledbutton {
        pointer-events: none;
        opacity: 0.95;
    }

</style>

<script  type="text/javascript">
    var app = angular.module('Appdoc', []);
    
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
<?php 
endif; ?>