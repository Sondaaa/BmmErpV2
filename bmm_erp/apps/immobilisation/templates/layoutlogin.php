<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />

        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="icon" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/images/icon.ico" />

            <!-- MetisMenu CSS -->
            <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

                <!-- DataTables CSS -->
                <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

                    <!-- DataTables Responsive CSS -->
                    <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

                        <!-- Custom CSS -->
                        <link href="<?php echo sfconfig::get('sf_appdir') ?>dist/css/sb-admin-2.css" rel="stylesheet">

                            <!-- Custom Fonts -->
                            <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

                                </head>
                                <body style="    background: url(<?php echo sfconfig::get('sf_appdir') ?>images/intro.png);background-repeat: repeat">
                                    <!--                                    <div style="
                                                                             position: absolute;
                                                                             width: 100%;
                                                                             /* height: 400px; */
                                                                             font-size: 67px;
                                                                             color: black;
                                                                             /* margin-left: 17%; */
                                                                             font-weight: bold;
                                                                             font-family: arabic Typesetting;
                                    
                                                                             text-align: center;">وزارة الدّفاع الوطني</div>-->
                                    <div style="position: absolute;float: left;top:2px">
                                        <img src="<?php echo sfconfig::get('sf_appdir') ?>images/imagelogo.png"></img>
                                    </div>
                                    <div class="container" style="margin-top: 10%;margin-left: 30%">
                                        <div class="row" style="margin-top:1%">
                                            <div class="col-md-4 col-md-offset-4">
                                                <div class="login-panel panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Connectez-vous</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <?php echo $sf_content ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!--                                   <div style="    margin-left: 46%;">
                                                                            <img  src="<?php echo sfconfig::get('sf_appdir') ?>images/ordm.png" style="width: 13%">
                                                                        </div>-->
                                    <!--                                    <div style="
                                                                             position: absolute;
                                                                             width: 100%;
                                                                             /* height: 400px; */
                                                                             font-size: 67px;
                                                                             color: black;
                                                                             /* margin-left: 17%; */
                                                                             font-weight: bold;
                                                                             font-family: arabic Typesetting;
                                                                             text-align: center;">
                                                                            ديوان تنمية رجيم معتوق
                                                                        </div>-->
                                    <!-- jQuery -->
                                    <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>

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

                                    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                                    <script>
                                        $(document).ready(function () {
                                            $('#dataTables-example').DataTable({
                                                responsive: true
                                            });
                                        });
                                        $(document).bind("contextmenu", function (e) {
                                            return false;
                                        });
                                          $('.disabledbutton').attr('href', '#');
                                    </script>

                                </body>
                                </html>
                                <style>

                                </style>