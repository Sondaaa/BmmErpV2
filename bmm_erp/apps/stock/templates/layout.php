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

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-rtl.min.css" />


        <!--        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />-->

        <!-- ace settings handler -->

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/rx.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/angular.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jsPDF.js"></script>
        <style>
            .disabledbutton {
                pointer-events: none;
                opacity: 0.7;
            }

            ul li {
                cursor: pointer;
            }

            ul li {
                cursor: pointer;
            }

            .testul ul {
                margin: 0 auto;
                padding: 0;
                max-height: 150px;
                position: absolute;
                overflow-y: auto;
                border: 1px solid rgba(0, 0, 0, 0.5);
                padding: 5px 5px 0 5px;
                border-left: 1px solid rgba(0, 0, 0, 0.5);
                border-right: 1px solid rgba(0, 0, 0, 0.5);
                background-color: white;
                position: absolute;
            }

            .testul li {
                list-style: none;
                width: 100%;

            }
        </style>
    </head>

    <body class="no-skin">

        <?php include_partial('global/header'); ?>

        <div class="main-container ace-save-state <?php echo $stylecontainer ?>" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container');
                } catch (e) {}
            </script>

            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar');
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
                            <div class="col-xs-12" ng-app="Appdoc">
                                <?php echo $sf_content ?>
                            </div>
                        </div>
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <?php include_partial('global/footer'); ?>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <script>
            var app = angular.module('Appdoc', []);
        </script>

        <!--[if !IE]> -->

        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/ajaxjs.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap.min.js"></script>

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

        <!-- ace scripts -->

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace-elements.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/ckeditor.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/adapters/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#reclamationfrs_sujet').ckeditor();
            });
            jQuery(function($) {
                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
            })
        </script>

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


        <script>
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
            $('select').not('[id="skin-colorpicker"]').not('[id="tva"]').not('[id="idnote"]').attr('class', "chosen-select form-control");
            $('select[id!="skin-colorpicker"]').attr('style', 'width: 100%;');
            $('input:text[id!="delai"]').attr('style', 'width: 100%;');
            $('input:date[id!="datemax"]').attr('style', 'width: 100%;');
        </script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/BmmErpFramwork.js"></script>


        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlArticle.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlInventaire.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.select.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.flash.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jszip.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/pdfmake.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/vfs_fonts.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.html5.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.print.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                jQuery(function($) {
                    //initiate dataTables plugin
                    var myTable =
                        $('#dynamic-table')
                        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                        .DataTable({});
                    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
                    new $.fn.dataTable.Buttons(myTable, {
                        buttons: [{
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
                                "extend": 'pdfHtml5',
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
                });


                //                $('#dynamic-table').DataTable({
                //                    dom: 'Bfrtip',
                //                    buttons: [
                //                        'excel', 'pdf', 'print'
                //                    ]
                //                });
                $('#dynamic-table3').DataTable({});
                $('#dynamic-table2').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ]
                });
                $('#dynamic-table4').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ]
                });
            });
            $(".main-container").on('contextmenu', function(e) {
                return false;
            });

            $(window).on("keydown", document, function(event) {

                if (event.which === 65) {
                    console.log(event.which);
                    $(document).on('contextmenu', function(e) {
                        console.log(e.which)
                        return true;
                    });
                }
            });

            //            $('.disabledbutton').attr('href', '#');
        </script>
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