<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Flot Examples: Categories</title>
        <link href="<?php echo sfconfig::get('sf_appdir') ?>bower_components/flot/examples/examples.css" rel="stylesheet" type="text/css">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>bootstrap-select/dist/css/bootstrap-select.min.css" />
        <link rel="icon" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/images/icon.ico" />

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



            <div class="row">
                <div class="col-lg-12" style="margin-top: 2%">


                    <div style="margin-top: 5px">
                        <?php echo $sf_content ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).bind("contextmenu", function (e) {
                return false;
            });
              $('.disabledbutton').attr('href', '#');
        </script>
    </body>
</html>





