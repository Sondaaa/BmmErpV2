<?php if ($sf_user->isAuthenticated()): ?>
<?php
$user = new Utilisateur();
$user=$sf_user->getAttribute('userB2m');
$parametrage = new Parametragedesseigne();
$skin = "no-skin";
$container = "";
$stylecontainer = "";
$para = Doctrine_Core::getTable('parametragedesseigne')->findOneByIdUser($user->getId());
if ($para) {
    $parametrage = $para;
    $skin = $parametrage->getCouleurfond();
    if ($parametrage->getSidebar() && $parametrage->getSidebar() == 1) {
        $container = "checked";
        $stylecontainer = "container";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="icon" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/images/icon.ico" />


        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>bootstrap-select/dist/css/bootstrap-select.min.css" />

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- MetisMenu CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"/>

        <!-- DataTables CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"/>

        <!-- DataTables Responsive CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet"/>

        <!-- Custom CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>dist/css/sb-admin-2.css" rel="stylesheet"/>

        <!-- Custom Fonts -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <style>
            body{
                padding: 30px;
                text-align: left;
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
        </style>
        <style>
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

        </style>

    </head>
    <body>

        <div id="wrapper">
            <nav class="navbar navbar-default navbar-fixed-top">

                <div class="navbar-header">
                    <div>
                        <a class="navbar-brand" href="<?php echo url_for('@homepage') ?>" >
                            <img src="<?php echo sfconfig::get('sf_appdir') ?>images/logo3xegas.png" style="width: 45%"></img>

                        </a>
                    </div>


                </div>
                <ul class="nav navbar-top-links navbar-left">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench fa-fw"></i> Paramétres <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo url_for('@societe') ?>">Societe</a></li>
                            <li><a href="<?php echo url_for('@utilisateur') ?>">Utilisateurs</a></li>


                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-folder-open fa-fw"></i> Données <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo url_for('@agents') ?>">Gestions des Agents</a></li>
                            <li><a href="<?php echo url_for('@fournisseur') ?>">Gestions des Fournisseurs</a></li>
                            <li><a href="<?php echo url_for('@fabricant') ?>">Gestions des Fabricant</a></li>

                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa  fa-arrows-h fa-fw"></i> Immobilisation <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>

                                <a href="<?php echo url_for('@immobilisation') ?>">Gestions d'immobilisations</a>
                            </li>
                            <li>

                                <a href="<?php echo url_for('@categoerie') ?>">Catégories d'immobilisation</a>
                            </li>
                            <li>

                                <a href="<?php echo url_for('@famille') ?>" >Familles D'immo</a>
                            </li>
                            <li>

                                <a href="<?php echo url_for('@sousfamille') ?>" >Sous Familles D'immo</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>



                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa  fa-arrows-h fa-fw"></i> Inventaire <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php ?>">Impression</a></li>
                            <li><a href="<?php ?>">Ouvrir Inventaire</a></li>
                            <li><a href="<?php ?>">Recherche Inventaire</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>



                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa  fa-bar-chart-o fa-fw"></i> Statistique <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php ?>">CA/ Fournisseur</a></li>
                            <li><a href="<?php ?>">CA/ Immo</a></li>
                            <li><a href="<?php ?>">CA/ Site</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                    <!-- /.dropdown -->
                </ul>
                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $user ?></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a  href="<?php echo url_for("deconnect") ?>"><i class="fa fa-sign-out fa-fw"></i> Déconnectez</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>

            </nav>
            <!-- Navigation -->



            <!-- /.navbar-header -->


            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation" style="margin-top: 1%" >
                <div class="sidebar-nav navbar-collapse" >
                    <ul class="nav" id="side-menu">
                        <li>
                            <a id="btn_imp_codbarre"  class="btn btn-primary" > Imprimer CODE/BAREE</a>
                        </li>



                        <li>
                            <a href="<?php echo url_for('immobilisation/new') ?>" class="btn btn-success">Nou. Fiche Immob.</a>


                        </li>





                        <li>
                            <a href="#">Par. d'emplacment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li><a href="<?php echo url_for('@pays') ?>">Pays</a></li>
                                <li><a href="<?php echo url_for('@gouvernera') ?>">Gouverneras</a></li>
                                <li><a href="<?php echo url_for('@adresse') ?>">Adresses</a></li>
                                <li><a href="<?php echo url_for('@site') ?>">Sites</a></li>
                                <li><a href="<?php echo url_for('@etage') ?>">Etages</a></li>
                                <li><a href="<?php echo url_for('@bureaux') ?>">Bureaux</a></li>


                            </ul>
                        </li>
                        <li>
                            <a href="#">Par. d'immobilisation<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo url_for('@poste') ?>">Poste</a></li>
                                <li><a href="<?php echo url_for('@nature') ?>">Nature</a></li>
                                <li><a href="<?php //echo url_for('@marque') ?>">Marque</a></li>
                                <li><a href="<?php echo url_for('@typebureaux') ?>">Type Bureaux</a></li>
                               <!-- <li><a href="<?php echo url_for('@typeimmobilsation') ?>">Type Immobilisation</a></li>
                                --> </ul>
                        </li>
                        <li>
                            <a href="#">Par. Comptable<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo url_for('@tauxammortisement') ?>">Taux d'ammortisment</a></li>
                                <li><a href="<?php echo url_for('@compte') ?>">Compte comptable</a></li>
                                <li><a href="<?php echo url_for('@modeammortisement') ?>">Mode d'ammortisement</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#">Gestion d'import/Export<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo url_for('import/index') ?>">Import Par. comptabilité</a></li>
                                <li><a href="<?php echo url_for('import/parcategorie') ?>">Import Par. Catégorie</a></li>

                            </ul>
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->


            <div id="page-wrapper">


                <div class="row">
                    <div class="col-lg-12" style="margin-top: 2%">


                        <div style="margin-top: 5px">
                            <?php echo $sf_content ?>
                        </div>

                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

            </div>


        </div>


        <!-- jQuery -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/ajaxjs.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>dist/js/sb-admin-2.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>bootstrap-select/dist/js/bootstrap-select.min.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
            }
        });
    });
        </script>

        <script  type="text/javascript">
            $("table[id!=table_imp]").addClass("table table-striped table-bordered table-hover");
            // $("form").addClass( "form_container left_label"  );
            $("form").attr('role', 'form');
            //id="dataTables-example"
            // $("table").attr('id', 'dataTables-example');
            //$("select").addClass("chzn-select-deselect");
            //form-control
            $("textarea").attr('class', 'form-control');
            $("select[name!='remv']").attr('class', "selectpicker");

            $("select[name!='remv']").attr('data-live-search', 'true');
            //            $("div").removeClass('sf_admin_header').addClass('panel-heading');
            //            $('#sf_admin_header').attr('class','panel-heading');
            $("h1").attr('id', 'replaceh1');
            //btn btn-outline btn-success
            $(".sf_admin_td_actions a").attr('class', 'btn btn-outline btn-success');
            $(".sf_admin_filter a").attr('class', 'btn btn-outline btn-success');
            $("input:submit").attr('class', 'btn btn-outline btn-success');
            $("td a").attr('class', 'btn btn-outline btn-success');
            $(".sf_admin_filter input:submit").attr('class', 'btn btn-outline btn-success');
            contenueh1 = document.getElementById("replaceh1").innerHTML;
            $('h1').replaceWith('<div id="replacediv" class="panel-heading">');
            document.getElementById("replacediv").innerHTML = contenueh1;
            $('#sf_admin_container').attr('class', 'panel panel-green');
            $('#sf_admin_container').attr('id', '');
            $('.content input:text,input:password').attr('style', 'width: 90%;');
            $('.content input:text,input:password').attr('class', 'form-control');
            $('fieldset').attr('class', 'row');
            $('fieldset .sf_admin_form_row').attr('class', 'col-lg-6');
            $('.sf_admin_actions li').css('display', 'inline');
            $('.sf_admin_actions').css('margin-top', '20px');
            $('.sf_admin_actions .sf_admin_action_delete a').addClass('btn btn-outline btn-danger');
            $('.sf_admin_actions .sf_admin_action_list a').addClass('btn btn-outline btn-success');
            $('.sf_admin_actions .sf_admin_action_new a').addClass('btn btn-outline btn-success');
            $('.notice').addClass('alert alert-info alert-dismissable');
            $('.notice').css('margin', '20px');
            $('.error').addClass('alert alert-info alert-dismissable');
            $('.error').css('margin', '20px');
            $(".content select[name*='][']").attr('style', 'width: 30%;height:34px;');
            $(".content select:not(.content select[name*=']['])").attr('class', 'form-control selectpicker');
            $(".content select:not(.content select[name*=']['])").css('width', '90%');
            $("select[name='batch_action']").css('height', '34px');
            $("select[name='remv']").removeClass('selectpicker');
            $(".green").attr('style', 'background-color: #008066!important;width: 100%; height: 60px');
            $("input").keypress(function (e) {
                if (e.keyCode == 13) {
                    return false;
                }
            });
            $(".error_list").addClass('text-danger');

            $("#noscript").removeClass('row');
            $("#noscript1").removeClass('row');
            $("#noscript2").removeClass('row');
            $("#noscript3").removeClass('row');
            $("#noscript4").removeClass('row');
            $(document).bind("contextmenu", function (e) {
                return false;
            });
              $('.disabledbutton').attr('href', '#');
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
        <style>
    body{

        background-size: 100% 100%;

    }
    .col-lg-12{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
</style>
    </body>
</html>
<?php endif; ?>
