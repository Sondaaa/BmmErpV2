<?php if ($sf_user->isAuthenticated()) : ?>
    <?php
    $user = new Utilisateur();
    $user = $sf_user->getAttribute('userB2m');
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

    <?php
    switch ($_SESSION['bureau']) {
        case 'daf':
            $libelle_header = "Secrétariat SOUS/DAF";
            break;
        case 'dcg':
            $libelle_header = "Secrétariat SOUS/DCG";
            break;
        case 'boc':
            $libelle_header = "Bureau d'Ordre Central";
            break;
        case 'sdt':
            $libelle_header = "Secrétariat Direction des Travaux";
            break;
        case 'sdps':
            $libelle_header = "Secrétariat Direction de Planification et Suivi";
            break;
        case 'suai':
            $libelle_header = "Secrétariat Unité Audit Interne";
            break;
        case 'sosm':
            $libelle_header = "Secrétariat Officier de Sécurité Militaire";
            break;
        case 'ssmre':
            $libelle_header = "Secrétariat Service du Matériel Roulant et des Engins";
            break;
        case 'sbpm':
            $libelle_header = "Secrétariat Bureau du Personnel Militaire";
            break;
        case 'suci':
            $libelle_header = "Secrétariat UCG et Cellule Informatique";
            break;
        case 'sas':
            $libelle_header = "Secrétariat Affaires Sociales";
            break;
        case 'abo':
            $libelle_header = "Administration Bureau d'ordre";
            break;
    }
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <link rel="icon" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/images/icon.ico" />
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/chosen.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-colorpicker.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/jquery-ui.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-rtl.min.css" />
        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/rx.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/angular.js"></script>

        <style>
            .disabledbutton {
                pointer-events: none;
                opacity: 0.7;
            }
        </style>
    </head>

    <body class="no-skin" ng-app="appbo">
        <div id="navbar" class="navbar navbar-default ace-save-state">
            <div class="navbar-container ace-save-state <?php echo $stylecontainer ?>" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="<?php echo url_for('@homepage') ?>" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            BMM <i class="fa fa-leaf"></i> GESTION BUREAU D'ORDRE <span style="font-size: 14px;"><i class="fa fa-home"></i> <?php echo $libelle_header; ?></span>
                        </small>
                    </a>
                </div>
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="purple dropdown-modal" ng-controller="CtrlMgs" ng-init="ReflichisementDesCourrierUrgent()">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                                <span class="badge badge-important">{{countcourrierurgent}}</span>
                            </a>
                            <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-envelope-o"></i>
                                    {{countcourrierurgent}} Courrier(s) Urgent(s)
                                </li>
                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                        <li ng-repeat="courrier in LCNLUrgent">
                                            <a href="<?php echo url_for('courrier/shocimprimer?idcourrier=') ?>{{courrier.id}}">
                                                <div>
                                                    <strong>{{courrier.numero}} {{courrier.action}}</strong>
                                                    <span class="pull-right text-muted">
                                                        <em>{{courrier.nexp}}==>{{courrier.ndest}}</em>
                                                    </span>
                                                </div>
                                                <div style="width: 100%;" ng-show="courrier.diff_date">{{courrier.diff_date}} Jour Restant </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                    </ul>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url_for('courrier/listCourrierUrgent') ?>">
                                        Lire tous les Courriers Urgents
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="green dropdown-modal" ng-controller="CtrlMgs" ng-init="ReflichisementDesCourrier()">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                                <span class="badge badge-success">{{countcourrier}}</span>
                            </a>
                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-envelope-o"></i>
                                    {{countcourrier}} Nouveau(x) courrier(s)
                                </li>
                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li ng-repeat="courrier in LCNL">
                                            <a href="<?php echo url_for('courrier/shocimprimer?idcourrier=') ?>{{courrier.id}}">
                                                <div>
                                                    <strong>{{courrier.numero}} {{courrier.action}}</strong>
                                                    <span class="pull-right text-muted">
                                                        <em>{{courrier.nexp}}==>{{courrier.ndest}}</em>
                                                    </span>
                                                </div>
                                                <div style="width: 100%;" ng-show="courrier.diff_date">{{courrier.diff_date}} Jour Restant </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                    </ul>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url_for('@courrier') ?>">
                                        Lire tous les Courriers
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small>Bienvenue,</small>
                                    <?php echo $sf_user->getAttribute('userB2m'); ?>
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a class="blue" href="<?php echo sfconfig::get('sf_appdir') . 'accueil.php/Accueil/global' ?>">
                                        <i class="ace-icon fa fa-lemon-o"></i> <b>Retour Accueil</b>
                                    </a>
                                </li>
                                <li>
                                    <a class="blue" href="<?php echo url_for('Accueil/profil'); ?>">
                                        <i class="ace-icon fa fa-user"></i> <b>Editer Profil</b>
                                    </a>
                                </li>
                                <li>
                                    <a class="purple" href="<?php echo sfconfig::get('sf_appdir') ?>uploads/scan_setup/setup_scan_FORMANET.exe" target="_blank">
                                        <i class="ace-icon fa fa-download"></i> <b>Scan.exe</b>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="red" href="<?php echo sfconfig::get('sf_appdir') . 'index.php' . url_for("/Admin/deconnect") ?>">
                                        <i class="ace-icon fa fa-power-off"></i> <b>Déconnectez</b>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {}
            </script>

            <?php include_partial('global/left', array('user' => $user)); ?>

            <div class="main-content">
                <div class="main-content-inner">

                    <div class="page-content">

                        <?php include_partial('global/menu', array('user' => $user)); ?>

                        <div class="page-header">
                            <h1></h1>
                        </div><!-- /.page-header -->
                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo $sf_content ?>
                            </div>
                        </div>
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <?php include_partial('global/footer'); ?>

        </div><!-- /.main-container -->

        <script type="text/javascript">
            //            var app = angular.module('Appdoc', []);
            var app = angular.module('appbo', []);
        </script>

        <!--[if !IE]> -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-2.1.4.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap.min.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.buttons.min.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.select.min.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.custom.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/chosen.jquery.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/spinbox.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/moment.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.knob.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/autosize.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.inputlimiter.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap-tag.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootbox.js"></script>

        <!-- ace scripts -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace-elements.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/ckeditor.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/adapters/jquery.js"></script>
        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                $('#sidebar2').insertBefore('.page-content');
                $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');

                $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
                    if (event_name == 'sidebar_fixed') {
                        if ($('#sidebar').hasClass('sidebar-fixed')) {
                            $('#sidebar2').addClass('sidebar-fixed');
                            $('#navbar').addClass('h-navbar');
                        } else {
                            $('#sidebar2').removeClass('sidebar-fixed')
                            $('#navbar').removeClass('h-navbar');
                        }
                    }
                }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed', $('#sidebar').hasClass('sidebar-fixed')]);
                if (!ace.vars['touch']) {
                    $('.chosen-select').chosen({
                        allow_single_deselect: true
                    });
                    //resize the chosen on window resize

                    $(window)
                        .off('resize.chosen')
                        .on('resize.chosen', function() {
                            $('.chosen-select').each(function() {
                                var $this = $(this);
                                $this.next().css({
                                    'width': $this.parent().width()
                                });
                            })
                        }).trigger('resize.chosen');
                    //resize chosen on sidebar collapse/expand
                    $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                        if (event_name != 'sidebar_collapsed')
                            return;
                        $('.chosen-select').each(function() {
                            var $this = $(this);
                            $this.next().css({
                                'width': $this.parent().width()
                            });
                        })
                    });


                    $('#chosen-multiple-style .btn').on('click', function(e) {
                        var target = $(this).find('input[type=radio]');
                        var which = parseInt(target.val());
                        if (which == 2)
                            $('#form-field-select-4').addClass('tag-input-style');
                        else
                            $('#form-field-select-4').removeClass('tag-input-style');
                    });
                }
            })
        </script>

        <?php if ($user->getAcceesDroit("responsable bureaux d'ordre")) { ?>
            <script type="text/javascript">
                $("#userinterne a").addClass("disabledbutton");
                $("#userexterne *").removeClass('disabledbutton');
                $("#userparametrage *").addClass("disabledbutton");
                $("#userstatiqtique *").addClass("disabledbutton");
            </script>
        <?php } ?>
        <?php if (($user->getAcceesDroit("S.Affaires Sociales") || $user->getAcceesDroit("Secretariat bureaux d'ordre") || $user->getAcceesDroit("Secrétariat sous DAF") || $user->getAcceesDroit("Secrétariat D.G") || $user->getAcceesDroit("S.Direction des travaux") || $user->getAcceesDroit("S.Direction de planification et suivi") || $user->getAcceesDroit("S.Unité audit interne") || $user->getAcceesDroit("S.Officier de securite militaire") || $user->getAcceesDroit("S.Service du matériel roulant et des engins") || $user->getAcceesDroit("S.Bureau du personnel militaire") || $user->getAcceesDroit("S.Unité de contrôle de gestion et Cellule informatique") || $user->getAcceesDroit("S.Direction générale"))) { ?>
            <script type="text/javascript">
                $("#userexterne a").addClass("disabledbutton");
                $("#userinterne *").removeClass('disabledbutton');
                $("#userparametrage *").addClass("disabledbutton");
                $("#userstatiqtique *").addClass("disabledbutton");
            </script>

        <?php } ?>
        <?php if ($user->getAcceesDroit("Paramétrage bureaux d'ordre")) { ?>
            <script type="text/javascript">
                $("#userparametrage *").removeClass("disabledbutton");
            </script>
        <?php } ?>
        <?php if ($user->getAcceesDroit("Mouvement et statistique bureaux d'ordre")) { ?>
            <script type="text/javascript">
                $("#userstatiqtique *").removeClass("disabledbutton");
            </script>
        <?php } ?>
        <?php if ($user->getAcceesDroit("responsable bureaux d'ordre") && $user->getAcceesDroit("S.Direction générale")) { ?>
            <script type="text/javascript">
                $("#userinterne *").removeClass("disabledbutton");
                $("#userexterne *").removeClass('disabledbutton');
            </script>
        <?php }
        if ($user->getAcceesDroit("Secrétariat sous DAF")) { ?>
            <script type="text/javascript">
                $("#userstatiqtique *").removeClass("disabledbutton");
            </script>
        <?php } ?>
        <!-- page specific plugin scripts -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlExpDest.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlCourrier.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlParcour.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/Scan.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlPiecejoint.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/droitdacceest.js"></script>
        <script type="text/javascript">
            $("#sf_admin_container>h1").attr('id', 'replaceh1');
            contenueh1 = document.getElementById("replaceh1").innerHTML;
            $('.page-header>h1').replaceWith('<h1 id="replacediv">');
            document.getElementById("replacediv").innerHTML = contenueh1;
            document.getElementById("replaceh1").innerHTML = "";
            $("table").addClass("table  table-bordered table-hover");
            $(".sf_admin_filter").attr("style", " width: 65%;float:left");
            $('ul').attr('style', 'list-style:none');
            $('input:text').addClass("class", "input-sm");
            contenu2 = $(".sf_admin_filter").html();
            htmlcontenu = '<div class="widget-box ui-sortable-handle" id="widget-box-1" style="opacity: 1;"><div class="widget-header"><h5 class="widget-title">Recherche</h5><div class="widget-toolbar"> <a href="#" data-action="collapse"> <i class="ace-icon fa fa-chevron-up"></i> </a> </div></div> <div class="widget-body" style="display: block;">' + contenu2 + '</div></div>';
            $('.sf_admin_filter').html(htmlcontenu);
            //Rest Button style
            $('input:submit').not('[id="btnvaliderPersonnelle"]').attr('class', 'btn btn-white btn-success');
            $('input:button').not('[id="btnvaliderPersonnelle"]').attr('class', 'btn btn-white btn-success');
            //Spécial Button style
            $('.dropdown-menu button').attr('class', 'btn btn-white btn-success');
            $(".modal-header button").removeClass('btn btn-white btn-success');
            $(".modal-header button").addClass('close');
            //Filter Button style
            $(".sf_admin_filter a").attr('class', 'btn btn-white btn-primary');
            $(".sf_admin_filter input:submit").attr('class', 'btn btn-white btn-success');
            //Form style
            $("form").attr('role', 'form');
            $('fieldset .sf_admin_form_row').attr('class', 'col-lg-4');
            $("textarea").attr('class', 'form-control');
            //Td action
            $(".sf_admin_td_actions").attr('style', 'display:inline-flex;list-style: none;margin-bottom:0px;margin-left:10px;');
            $(".sf_admin_td_actions li").attr('style', 'margin-right:2%');
            $('.sf_admin_td_actions .sf_admin_action_print a').addClass('btn btn-xs btn-purple');
            $('.sf_admin_td_actions .sf_admin_action_show a').addClass('btn btn-xs btn-success');
            $('.sf_admin_td_actions .sf_admin_action_affect a').addClass('btn btn-xs btn-primary');
            $('.sf_admin_td_actions .sf_admin_action_edit a').addClass('btn btn-xs btn-warning');
            $('.sf_admin_td_actions .sf_admin_action_delete a').addClass('btn btn-xs btn-danger');
            //Form action
            $(".sf_admin_actions").attr('style', 'display:inline-flex;list-style: none;margin:2%');
            $('.sf_admin_batch_actions_choice').attr('style', 'margin-right:3px;');
            $('.sf_admin_action_delete a').addClass('btn btn-xs btn-danger');
            $('.sf_admin_action_delete').attr('style', 'margin-left:2%');
            $('.sf_admin_action_list a').addClass('btn btn-white btn-success');
            $('.sf_admin_action_list').attr('style', 'margin-left:2%');
            $('.sf_admin_action_new a').addClass('btn btn-white btn-primary');
            $('.sf_admin_action_save a').addClass('btn btn-white btn-primary');
            $('.sf_admin_action_save').attr('style', 'margin-left:2%');
            $('.sf_admin_action_save_and_add').attr('style', 'margin-left:2%');
            //Table tr style
            $('.odd').attr('style', 'background-color: #ffffff;');
            $('.even').attr('style', 'background-color: #f0f0f0;');
            //Select / Input Text / Button List => style
            $('.active-result').attr('style', 'font-size: 24px !important;font-weight: bold !important;');
            $('select[id!="skin-colorpicker"]').attr('class', "chosen-select form-control");
            $('input:text').attr('style', 'width: 100%;');
            $('#btnaction li *').attr('style', 'border: none;font-size: 14px;');
            $(document).ready(function() {
                $('#courrier_description').ckeditor();
            });
        </script>
        <script type="text/javascript">
            jQuery(function($) {
                //initiate dataTables plugin
                var myTable =
                    $('#dynamic-table')
                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable({});

                $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

                new $.fn.dataTable.Buttons(myTable, {
                    buttons: [{
                            "extend": "colvis",
                            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                            "className": "btn btn-white btn-primary btn-bold",
                            columns: ':not(:first):not(:last)'
                        },
                        {
                            "extend": "copy",
                            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "csv",
                            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "excel",
                            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "pdf",
                            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "print",
                            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                            "className": "btn btn-white btn-primary btn-bold",
                            autoPrint: false,
                            message: ''
                        }
                    ]
                });
                myTable.buttons().container().appendTo($('.tableTools-container'));

                //style the message box
                var defaultCopyAction = myTable.button(1).action();
                myTable.button(1).action(function(e, dt, button, config) {
                    defaultCopyAction(e, dt, button, config);
                    $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
                });

                var defaultColvisAction = myTable.button(0).action();
                myTable.button(0).action(function(e, dt, button, config) {

                    defaultColvisAction(e, dt, button, config);


                    if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                        $('.dt-button-collection')
                            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                            .find('a').attr('href', '#').wrap("<li />")
                    }
                    $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
                });

                ////

                setTimeout(function() {
                    $($('.tableTools-container')).find('a.dt-button').each(function() {
                        var div = $(this).find(' > div').first();
                        if (div.length == 1)
                            div.tooltip({
                                container: 'body',
                                title: div.parent().text()
                            });
                        else
                            $(this).tooltip({
                                container: 'body',
                                title: $(this).text()
                            });
                    });
                }, 500);


                myTable.on('select', function(e, dt, type, index) {
                    if (type === 'row') {
                        $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
                    }
                });
                myTable.on('deselect', function(e, dt, type, index) {
                    if (type === 'row') {
                        $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
                    }
                });

                $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

                //select/deselect all rows according to table header checkbox
                $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function() {
                    var th_checked = this.checked; //checkbox inside "TH" table header

                    $('#dynamic-table').find('tbody > tr').each(function() {
                        var row = this;
                        if (th_checked)
                            myTable.row(row).select();
                        else
                            myTable.row(row).deselect();
                    });
                });

                //select/deselect a row when the checkbox is checked/unchecked
                $('#dynamic-table').on('click', 'td input[type=checkbox]', function() {
                    var row = $(this).closest('tr').get(0);
                    if (this.checked)
                        myTable.row(row).deselect();
                    else
                        myTable.row(row).select();
                });

                $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                });

                var active_class = 'active';
                $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
                    var th_checked = this.checked; //checkbox inside "TH" table header

                    $(this).closest('table').find('tbody > tr').each(function() {
                        var row = this;
                        if (th_checked)
                            $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                        else
                            $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                    });
                });

                //select/deselect a row when the checkbox is checked/unchecked
                $('#simple-table').on('click', 'td input[type=checkbox]', function() {
                    var $row = $(this).closest('tr');
                    if ($row.is('.detail-row '))
                        return;
                    if (this.checked)
                        $row.addClass(active_class);
                    else
                        $row.removeClass(active_class);
                });

                /********************************/
                //add tooltip for small view action buttons in dropdown menu
                $('[data-rel="tooltip"]').tooltip({
                    placement: tooltip_placement
                });

                //tooltip placement on right or left
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    //var w2 = $source.width();

                    if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                        return 'right';
                    return 'left';
                }

                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
            })
        </script>
        <style>
            #rtlmode .chosen-container .chosen-results li.active-result {
                display: list-item;
                cursor: pointer;
                font-size: 20px !important;
                font-weight: bold !important;
            }

            #rtlmode .chosen-container-single .chosen-single-with-deselect span {
                margin-right: 38px;
                font-size: 24px !important;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                if (window.location.href.indexOf("_dev") == -1) {
                    $(document).bind("contextmenu", function(e) {
                        return false;
                    });
                }
            });
        </script>
    </body>

    </html>
<?php endif; ?>