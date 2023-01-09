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
                <h2>Inventaire n°: <?php echo $doc->getNumero(); ?> </h2>
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
                    <div>
                        <div id="sf_admin_content">
                            <div class="sf_admin_list">
                                <table cellspacing="0" class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span>Date: </span>
                                            </td>
                                            <td>
                                                <?php echo date("Y-m-d", strtotime($doc->getDateDoc())); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>Bureau: </span>
                                            </td>
                                            <td>
                                                <?php echo $doc->getBureaux(); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                    <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                                        <thead>
                                            <tr>
                                                <th>Immobilisation</th>
                                                <th>Bureau</th>
                                                <th>Code à barre</th>
                                                <th>Qte Recp.</th>
                                                <th>Qte Réel</th>
                                                <th>Ecart</th>
                                                <th>RQ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($immobilisations as $immobilisation):
                                                $emplacements = Doctrine_Core::getTable('emplacement')->findByIdImmo($immobilisation->getId());

                                                foreach ($emplacements as $empl) {
                                                    ?>
                                                    <tr id="inv_<?php echo $empl->getId(); ?>">
                                                        <td><?php echo $immobilisation->getDesignation() . "<br>" . $immobilisation->getReference(); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($empl->getIdBureau()) {
                                                                $bur = Doctrine_Core::getTable('bureaux')->findOneById($empl->getIdBureau());
                                                                echo $bur;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $empl->getReference(); ?></td>
                                                        <?php
                                                        $inventaire = Doctrine_Core::getTable('inventairedoc')->findOneByIdDocAndIdEmpl($doc->getId(), $empl->getId());
                                                        if ($inventaire) {
                                                            ?>
                                                            <?php if ($inventaire->getEcart() == "-1") { ?>
                                                                <script  type="text/javascript">
                                                                    document.getElementById('inv_<?php echo $empl->getId(); ?>').style = "background-color: rgba(255, 0, 0, 0.23);";
                                                                </script>
                                                            <?php } ?>
                                                            <?php if ($inventaire->getEcart() == "") { ?>
                                                                <script  type="text/javascript">
                                                                    document.getElementById('inv_<?php echo $empl->getId(); ?>').style = "background-color: #ffd3d3";
                                                                </script>
                                                            <?php } ?>
                                                            <td><p><?php echo $inventaire->getQtereel(); ?></p></td>

                                                            <td><p><?php echo $inventaire->getQteexstant(); ?></p></td>
                                                            <td><p><?php echo $inventaire->getEcart(); ?></p></td>
                                                            <td><p><?php echo $inventaire->getRq(); ?></p></td>
                                                        <?php } else { ?>
                                                            <td><p>?</p></td>
                                                            <td><p>?</p></td>
                                                            <td><p>?</p></td>
                                                            <td><p>Votre Bien est Perdue?</p></td>
                                                            <script  type="text/javascript">
                                                                document.getElementById('inv_<?php echo $empl->getId(); ?>').style = "background-color: #ffd3d3";
                                                            </script>

                                                        <?php } ?>
                                                    </tr>
                                                    <?php
                                                }endforeach
                                            ;
                                            ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
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

                                                                            document.location = "<?php echo url_for(array('module' => 'document', 'action' => 'index')) ?>";
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