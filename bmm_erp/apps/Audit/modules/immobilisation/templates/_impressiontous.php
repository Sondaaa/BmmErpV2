<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />

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
            <div>
                <?php $bureau = Doctrine_Core::getTable('bureaux')->findOneById($bur);
                ?>
                <h2> FICHE D'IMMOBILISATION/<?php echo $bureau; ?></h2>

                <div id="sf_admin_content">
                    <style>
                        fieldset.scheduler-border {
                            border: 1px groove #ddd !important;
                            padding: 0 1.4em 1.4em 1.4em !important;
                            margin: 0 0 1.5em 0 !important;
                            -webkit-box-shadow:  0px 0px 0px 0px #000;
                            box-shadow:  0px 0px 0px 0px #000;
                        }
                        legend.scheduler-border {
                            width:inherit; /* Or auto */
                            padding:0 10px; /* To give a bit of padding on the left and right */
                            border-bottom:none;
                        }
                    </style>

                    <table>
                        <?php
                        if (isset($immobilisations)) {
                            include_partial('immobilisation/barCodeC128.class');
                            ?>
                            <thead>
                                <tr>
                                    <th>Emplacement</th>
                                    <th>Immob.</th>
                                    <th>R&eacute;ference </th>
                                    <th>Code barre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $immobilisation_new = new Immobilisation();
                                $emplacment_codebarre = new Emplacement();
                                //  die("hh".count($immobilisations));
                                foreach ($immobilisations as $immobilisation) {
                                    $immobilisation_new = $immobilisation;

                                    $emplacement = Doctrine_Core::getTable('emplacement')->findOneByIdBureauAndIdImmo($immobilisation_new->getIdBureaux(), $immobilisation_new->getId());
                                    if ($emplacement) {
                                        $emplacment_codebarre = $emplacement;
                                        ?>
                                        <tr>
                                            <td><?php echo $emplacment_codebarre ?></td>
                                            <td><?php echo $immobilisation->getDesignation(); ?></td>
                                            <td><?php echo $emplacment_codebarre->getReference(); ?></td>
                                            <td>
                                                <?php
                                                $code = new Code128();

                                                $code->setData($emplacment_codebarre->getReference());
                                                $code->setDimensions(180, 20);
                                                $code->draw();

                                                $cheminfile = sfconfig::get('sf_appdir') . "codebarre/";
                                                $code->save($cheminfile . $emplacment_codebarre->getReference() . ".png");
                                                echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacment_codebarre->getReference() . '.png">';
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
                <script  type="text/javascript">

                    window.print();

                    var myVar = setInterval(function () {
                        chargement()
                    }, 1);

                    var x = 1;
                    function chargement() {
                        if (document.readyState == "complete") {
                            if (x == 1) {

                                document.location = "<?php echo url_for(array('module' => 'immobilisation', 'action' => 'imprimercb')) ?>";
                            }
                            x++;
                        }
                    }

                </script>
            </div>

            <!-- /.panel -->
            <!-- /.col-lg-12 -->
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
        <script  type="text/javascript">
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

        </script>

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
</style>
