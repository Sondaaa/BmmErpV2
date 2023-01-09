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
            <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/jquery-ui.min.css" />

            <!-- text fonts -->
            <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/fonts.googleapis.com.css" />

            <!-- ace styles -->
            <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

            <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-skins.min.css" />
            <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-rtl.min.css" />
            <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-duallistbox.min.css" />



            <!--[if !IE]> -->
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-2.1.4.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jsPDF.js"></script>

            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.custom.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.ui.touch-punch.min.js"></script>

            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.hotkeys.index.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap-wysiwyg.min.js"></script>

            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace-elements.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/rx.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>js/angular.js"></script>
            <style>
                .disabledbutton {
                    pointer-events: none;
                    opacity: 0.7;
                }

                .align_right {
                    text-align: right;
                }

                ul li {
                    cursor: pointer;
                }

                .testul ul {
                    max-height: 150px;
                    position: absolute;
                    overflow-y: auto;
                    border: 1px solid rgba(0, 0, 0, 0.5);
                    border-left: 1px solid rgba(0, 0, 0, 0.5);
                    border-right: 1px solid rgba(0, 0, 0, 0.5);
                    background-color: white;
                    position: absolute;
                    margin: 0;
                    padding: 5px 6px;
                    list-style: none;
                    line-height: 22px;
                    word-wrap: break-word;
                }

                .testul li {
                    list-style: none;
                    width: 100%;
                    padding: 1%;
                }

                .testul li:hover {
                    background-color: #3875d7;
                    background-image: -webkit-gradient(linear, 50% 0, 50% 100%, color-stop(20%, #3875d7), color-stop(90%, #2a62bc));
                    background-image: -webkit-linear-gradient(#3875d7 20%, #2a62bc 90%);
                    background-image: -moz-linear-gradient(#3875d7 20%, #2a62bc 90%);
                    background-image: -o-linear-gradient(#3875d7 20%, #2a62bc 90%);
                    background-image: linear-gradient(#3875d7 20%, #2a62bc 90%);
                    color: #fff
                }

                .ace-icon {
                    margin-top: 3px;
                }

                .text-primary {
                    font-size: 14px;
                }

                .btn.btn-app {
                    width: auto;
                    min-width: 100px;
                    padding-left: 5px;
                    padding-right: 5px;
                    float: right;
                }

                .ui-helper-reset {
                    font-size: 18px;
                }

                .ui-progressbar {
                    background-color: #d8d8d8;
                }

                .input-group-addon {
                    border-left: 1px solid #ccc !important;
                    width: auto;
                    margin-left: -5px;
                    display: inline;
                }

                .align_right {
                    text-align: right;
                }

                .align_center {
                    text-align: center;
                }

                .active-result {
                    text-align: justify;
                }

                .display_none {
                    display: none;
                }
            </style>
        </head>

        <body class="no-skin" ng-app="Appdoc">
            <?php include_partial('global/header'); ?>
            <div class="main-container ace-save-state" id="main-container">

                <?php include_partial('global/left', array('user' => $user)); ?>

                <div class="main-content">
                    <div class="main-content-inner">
                        <div class="page-content">

                            <?php if ($_SESSION['exercice'] == null) : ?>
                                <?php include_partial('global/menu', array('user' => $user)); ?>
                            <?php else : ?>
                                <?php include_partial('global/menu_all', array('user' => $user)); ?>
                            <?php endif; ?>

                            <?php include_partial('global/modal_exercice'); ?>



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

            </div><!-- /.main-container -->

            <script>
                var app = angular.module('Appdoc', []);
            </script>
            <!-- Custom Theme JavaScript -->

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
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.buttons.min.js"></script>

            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.html5.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.print.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.colVis.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.flash.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.select.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.bootstrap-duallistbox.min.js"></script>
            <!-- ace scripts -->


            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.min.js"></script>

            <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/ckeditor.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/adapters/jquery.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/tree.min.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootbox.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/wizard.min.js"></script>

            <!-- inline scripts related to this page -->
            <script type="text/javascript">
                jQuery(function ($) {
                    $('#sidebar2').insertBefore('.page-content');
                    $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');
                    $(document).on('settings.ace.two_menu', function (e, event_name, event_val) {
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
                                .on('resize.chosen', function () {
                                    $('.chosen-select').each(function () {
                                        var $this = $(this);
                                        $this.next().css({
                                            'width': $this.parent().width()
                                        });
                                    })
                                }).trigger('resize.chosen');
                        //resize chosen on sidebar collapse/expand
                        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                            if (event_name != 'sidebar_collapsed')
                                return;
                            $('.chosen-select').each(function () {
                                var $this = $(this);
                                $this.next().css({
                                    'width': $this.parent().width()
                                });
                            })
                        });
                        $('#chosen-multiple-style .btn').on('click', function (e) {
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

            <script type="text/javascript">
                $("#sf_admin_container>h1").attr('id', 'replaceh1');
                contenueh1 = document.getElementById("replaceh1").innerHTML;
                $('.page-header>h1').replaceWith('<h1 id="replacediv">');
                document.getElementById("replacediv").innerHTML = contenueh1;
                document.getElementById("replaceh1").innerHTML = "";
                $("#replaceh1").remove();
                $("table").addClass("table table-bordered table-hover");
                $(".sf_admin_filter").attr("style", " width: 65%;float:left");
                $('ul').attr('style', 'list-style:none');
                $('input:text').addClass("class", "input-sm");
                contenu2 = $(".sf_admin_filter").html();
                htmlcontenu = '<div class="widget-box ui-sortable-handle" id="widget-box-1" style="opacity: 1;"><div class="widget-header"><h5 class="widget-title">Recherche</h5><div class="widget-toolbar"> <a href="#" data-action="collapse"> <i class="ace-icon fa fa-chevron-up"></i> </a> </div></div> <div class="widget-body" style="display: block;">' + contenu2 + '</div></div>';
                $('.sf_admin_filter').html(htmlcontenu);
                $('.dropdown-menu button').attr('class', 'btn btn-white btn-success');
                $(".modal-header button").removeClass('btn btn-white btn-success');
                $(".modal-header button").addClass('close');
                $('.sf_admin_filter a').attr('class', 'btn btn-white btn-warning');
                $("form").attr('role', 'form');
                $("textarea").attr('class', 'form-control');
                $(".sf_admin_filter a").attr('class', 'btn btn-white btn-success');
                $(".sf_admin_filter input:submit").attr('class', 'btn btn-white btn-success');
                $('.sf_admin_batch_actions_choice').attr('style', 'width:220px;');

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
                $('.sf_admin_batch_actions_choice input').addClass('btn btn-white btn-success');
                $('.sf_admin_action_list a').addClass('btn btn-white btn-success');
                $('.sf_admin_action_list').attr('style', 'margin-left:2%');
                $('.sf_admin_action_new a').addClass('btn btn-white btn-primary');
                $('.sf_admin_action_save_and_add').attr('style', 'margin-left:2%');
                $('.sf_admin_action_save_and_add input').addClass('btn btn-white btn-primary');

                $('fieldset .sf_admin_form_row').attr('class', 'col-lg-4');
                $('.sf_admin_actions .sf_admin_action_delete a').addClass('btn btn-danger');
                $('.sf_admin_actions .sf_admin_action_list a').addClass('btn btn-white btn-success');
                $('.sf_admin_actions .sf_admin_action_new a').addClass('btn btn-white btn-success');
                //Table tr style
                $('.odd').attr('style', 'background-color: #ffffff;');
                $('.even').attr('style', 'background-color: #f0f0f0;');

                $('select').not('[title="Change Color"]').not('[id="skin-colorpicker"]')
                        .not('[id="comptestandar_edit"]').not('[id="tva"]').not('[id="listesbdcp"]').not('[id="idnote"]').attr('class', "chosen-select form-control");
                $('select[id="id_compte_select"]').attr('class', "chosen-select form-control");
                $('select[id="id_compte_select"]').attr('style', 'width: 100%;');
                $('select[id!="skin-colorpicker"]').attr('style', 'width: 100%;');
                $('input:text[id!="delai"]').attr('style', 'width: 100%;');
                $('#btnaction li *').attr('style', 'border: none;font-size: 14px;text-align: center;');
            </script>

            <script src="<?php echo sfconfig::get('sf_appdir') ?>js/BmmErpFramwork.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrComptabilite.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlRessourcehumaine.js"></script>
            <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlNotification.js"></script>

            <script type="text/javascript">
                //jquery accordion
                $(".accordion-style2").accordion({
                    collapsible: true,
                    heightStyle: "content",
                    animate: 250,
                    header: ".accordion-header"
                }).sortable({
                    axis: "y",
                    handle: ".accordion-header",
                    stop: function (event, ui) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children(".accordion-header").triggerHandler("focusout");
                    }
                });
                //override dialog's title function to allow for HTML titles
                $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
                    _title: function (title) {
                        var $title = this.options.title || '&nbsp;';
                        if (("title_html" in this.options) && this.options.title_html == true)
                            title.html($title);
                        else
                            title.text($title);
                    }
                }));
                //spinner
                var spinner = $("#chiffre_compte").spinner({
                    create: function (event, ui) {
                        //add custom classes and icons
                        $(this)
                                .next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
                                .next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')

                        //larger buttons on touch devices
                        if ('touchstart' in document.documentElement)
                            $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
                    },
                    min: '6',
                    max: '12'
                });
                var spinner = $("#chiffre_virgule").spinner({
                    create: function (event, ui) {
                        //add custom classes and icons
                        $(this)
                                .next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
                                .next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')

                        //larger buttons on touch devices
                        if ('touchstart' in document.documentElement)
                            $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
                    },
                    min: '0',
                    max: '7'
                });

                var spinner = $("#valeur_tva").spinner({
                    create: function (event, ui) {
                        //add custom classes and icons
                        $(this)
                                .next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
                                .next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')

                        //larger buttons on touch devices
                        if ('touchstart' in document.documentElement)
                            $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
                    }
                });
                $.mask.definitions['~'] = '[+-]';
                $(".input-mask-matricule-fiscale").mask('9999999aaa999');
                $(".input-mask-registre-nationale").mask('9999999a');
                $('.input-mask-phone').mask('(216) 99999999');

                $("#matricule").mask('99999999');
                $("#cin").mask('99999999');
            </script>

            <script type="text/javascript">
                var $validation = false;
                $('#fuelux-wizard-container')
                        .ace_wizard({
                            //step: 2 //optional argument. wizard will jump to step "2" at first
                            //buttons: '.wizard-actions:eq(0)'
                        })
                        .on('actionclicked.fu.wizard', function (e, info) {
                            switch (info.step) {
                                case 1:
                                    choisirTransfert();
                                    break;
                                case 2:
                                    if (info.direction == 'next')
                                        verifierTransfert();
                                    break;
                                case 3:
                                    if (info.direction == 'next')
                                        validerTransfert();
                                    break;
                                case 4:

                                    break;
                            }
                        })
                        //.on('changed.fu.wizard', function() {
                        //})
                        .on('finished.fu.wizard', function (e) {
                            bootbox.dialog({
                                message: "Fin de l'\opération, Transfert effectué avec succès !",
                                buttons: {
                                    "success": {
                                        "label": "OK",
                                        "className": "btn-sm btn-primary"
                                    }
                                }
                            });
                            document.location.reload();
                        })
                        .on('stepclick.fu.wizard', function (e) {
                            e.preventDefault(); //this will prevent clicking and selecting steps
                        });
                $('[data-rel=tooltip]').tooltip();
                $('[data-rel=popover]').popover({
                    html: true
                });
                //tooltips
                $("[data-tootip=show_tooltip]").tooltip({
                    show: {
                        effect: "slideDown",
                        delay: 250
                    }
                });

                $('.modal.aside').ace_aside();
                //jquery tabs
                $("#tabs").tabs();
            </script>

            <script type="text/javascript">
                var $validation = false;
                $('#import-fuelux-wizard-container')
                        .ace_wizard({
                            //step: 2 //optional argument. wizard will jump to step "2" at first
                            //buttons: '.wizard-actions:eq(0)'
                        })
                        .on('actionclicked.fu.wizard', function (e, info) {
                            switch (info.step) {
                                case 1:
                                    choisirTransfert();
                                    break;
                                case 2:
                                    if (info.direction == 'next')
                                        verifierTransfert();
                                    break;
                                case 3:
                                    if (info.direction == 'next')
                                        validerTransfert();
                                    break;
                                case 4:

                                    break;
                            }
                        })
                        //.on('changed.fu.wizard', function() {
                        //})
                        .on('finished.fu.wizard', function (e) {
                            bootbox.dialog({
                                message: "Fin de l'\opération, Importation effectuée avec succès !",
                                buttons: {
                                    "success": {
                                        "label": "OK",
                                        "className": "btn-sm btn-primary"
                                    }
                                }
                            });
                            document.location.reload();
                        })
                        .on('stepclick.fu.wizard', function (e) {
                            e.preventDefault(); //this will prevent clicking and selecting steps
                        });
                //            $(document).bind("contextmenu", function (e) {
                //                return false;
                //            });
                //              $('.disabledbutton').attr('href', '#');
            </script>
        </body>

    </html>

    <script type="text/javascript">
        $(document).ready(function () {
            if (window.location.href.indexOf("_dev") == -1) {
                $(document).bind("contextmenu", function (e) {
                    return false;
                });
            }
        });
    </script>
    </body>

    </html>
<?php endif; ?>