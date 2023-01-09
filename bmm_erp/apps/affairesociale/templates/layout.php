<?php if ($sf_user->isAuthenticated()) : ?>
    <?php

    $user = $sf_user->UserConnected();
    $parametrage = new Parametragedesseigne();
    $skin = "skin-2";
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
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/jquery-ui.min.css" />
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/chosen.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-colorpicker.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/jquery-ui.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/fonts.googleapis.com.css" />
        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-multiselect.min.css" />
        <link rel="stylesheet" href="<?php echo sfconfig::get('sf_appdir') ?>assets/css/bootstrap-duallistbox.min.css" />

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
                stop: function(event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children(".accordion-header").triggerHandler("focusout");
                }
            });
            //override dialog's title function to allow for HTML titles
            $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
                _title: function(title) {
                    var $title = this.options.title || '&nbsp;';
                    if (("title_html" in this.options) && this.options.title_html == true)
                        title.html($title);
                    else
                        title.text($title);
                }
            }));
        </script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/rx.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/angular.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/Highcharts-3.0.7/js/highcharts.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/Highcharts-3.0.7/js/highcharts-more.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/Highcharts-3.0.7/js/modules/exporting.js"></script>

        <style>
            .testul {
                position: absolute;

                z-index: 2;
            }

            .disabledbutton {
                pointer-events: none;
                opacity: 0.7;
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
                width: 525px;
            }

            .testul li {
                list-style: none;
                width: 100%;

            }

            .chosen-container .chosen-container-single .chosen-container-active .chosen-with-drop {
                max-width: 100px !important;
            }

            .align_center {
                text-align: center;
            }

            .align_right {
                text-align: right;
            }

            .dropdown-menu li button {
                width: 100%;
            }

            .dropdown-menu li a {
                width: 100%;
            }
        </style>
    </head>

    <body class="no-skin">
        <?php include_partial('global/header'); ?>
        <div class="main-container ace-save-state" id="main-container">

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

        </div><!-- /.main-container -->


        <div id="my-modalreciproque" class="modal fade" tabindex="-1" style="width: 1200px">
            <?php
            //  include_partial('agents/form_recherchereciproque', array());
            ?>
        </div>

        <script type="text/javascript">
            var app = angular.module('Appdoc', []);
        </script>

        <!--[if !IE]> -->
        <!--<script src="<?php //echo sfconfig::get('sf_appdir')         
                            ?>assets/js/jquery-2.1.4.min.js"></script>-->
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootstrap.min.js"></script>


        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.custom.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.touch-punch.min.js"></script>
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
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.min.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.buttons.min.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.html5.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.print.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.colVis.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.flash.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.select.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace-elements.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootbox.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/ckeditor.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/adapters/jquery.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.bootstrap-duallistbox.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#reclamationfrs_sujet').ckeditor();
            });
            $('.show-details-btn').on('click', function(e) {
                e.preventDefault();
                $(this).closest('tr').next().toggleClass('open');
                $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
            });
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

        <script type="text/javascript">
            $("#sf_admin_container>h1").attr('id', 'replaceh1');
            contenueh1 = document.getElementById("replaceh1").innerHTML;
            $('.page-header>h1').replaceWith('<h1 id="replacediv">');
            document.getElementById("replacediv").innerHTML = contenueh1;
            document.getElementById("replaceh1").innerHTML = "";
            $("table").addClass("table  table-bordered table-hover");
            $(".sf_admin_filter").attr("style", " width: 65%;float:left");
            $('ul').attr('style', 'list-style:none');
            $('input:text').not('[id="idreg"]').not('[id="iddebut"]').not('[id="idfin"]').not('[id="iddirection"]').addClass("class", "input-sm");
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
            $('select').not('[id="historiqueretenue_id_retenue"]').not('[id="historiqueretenue_id_demandepret"]').not('[id="historiqueretenue_id_demandeavance"]').not('[id="demandeavance_id_agent"]').not('[id="skin-colorpicker"]').not('[id="tva"]').not('[id="idnote"]').attr('class', "chosen-select form-control");
            $('select[id="attestationdesalaire_id_lieu"]').attr('style', 'width: 150px;');
            $('input:text[id!="delai"]').not('[id="detailavance"]').not('[id="idFormat"]').not('[id="idorg"]').not('[id="idagents"]').not('[id="idrubrique"]').not('[id="idbesoins"]').not('[id="idFormateur"]').not('[id="idorganisme"]').not('[id="regr"]').not('[id="idsousrubrique"]').not('[id="idreg"]').not('[id="montanttotal"]').not('[id="domaineuntilisation_code"]').not('[id="mission_heurearrive"]').not('[id="mission_heuresortie"]').not('[id="formulaire_nbrponitsjour"]').not('[id="formulaire_nbpointmois"]').not('[id="formulaire_dureejou"]').not('[id="formulaire_dureemois"]').not('[id="demandederemboursement_signature"]').not('[id="demandederemboursement_bloc"]').not('[id="hopital1"]').not('[data-width="fixed"]').not('[id="idprime"]').not('[id="idprojet"]').not('[id="idlieu"]').not('[id="iddebut"]').not('[id="idsituation"]').not('[id="idposition"]').not('[id="idechelle"]').not('[id="idechelon"]').not('[id="idcategorie"]').not('[id="idcorps"]').not('[id="idgrade"]').not('[id="idfin"]').not('[id="iddirection"]').not('[id="idposte"]').not('[id="idfonction"]').not('[id="idsousdirection"]').not('[id="idservice"]').not('[id="idunite"]').not('[data="fonctionnaire"]').not('[data="fixe"]').not('[data="ouvrier"]').attr('style', 'width: 100%;');
            $('#btnaction li *').attr('style', 'border: none;font-size: 14px;text-align: center;');
        </script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/BmmErpFramwork.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/Scan.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlPresence.js"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script type="text/javascript">
            jQuery(function($) {
                //initiate dataTables plugin
                var myTable =
                    $('.dynamic-table')
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
        </script>
        <script type="text/javascript">
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        </script>
        <script type="text/javascript">
            //            var $validation = false;
            //            $('#fuelux-wizard-container')
            //                    .ace_wizard({
            //                        //step: 2 //optional argument. wizard will jump to step "2" at first
            //                        //buttons: '.wizard-actions:eq(0)'
            //                    })
            //                    .on('actionclicked.fu.wizard', function (e, info) {
            //                        switch (info.step) {
            //                            case 1:
            //                                choisirTransfert();
            //                                break;
            //                            case 2:
            //                                verifierTransfert();
            //                                break;
            //                            case 3:
            //                                validerTransfert();
            //                                break;
            //                            case 4:
            //
            //                                break;
            //                        }
            //                    })
            //                    //.on('changed.fu.wizard', function() {
            //                    //})
            //                    .on('finished.fu.wizard', function (e) {
            //                        bootbox.dialog({
            //                            message: "Fin de l'\opération, Transfert effectué avec succès !",
            //                            buttons: {
            //                                "success": {
            //                                    "label": "OK",
            //                                    "className": "btn-sm btn-primary"
            //                                }
            //                            }
            //                        });
            //                        document.location.reload();
            //                    })
            //                    .on('stepclick.fu.wizard', function (e) {
            //                        e.preventDefault(); //this will prevent clicking and selecting steps
            //                    });
            //            $('[data-rel=tooltip]').tooltip();
            //            $('[data-rel=popover]').popover({html: true});
            //            //tooltips
            //            $("[data-tootip=show_tooltip]").tooltip({
            //                show: {
            //                    effect: "slideDown",
            //                    delay: 250
            //                }
            //            });
        </script>
        <script type="text/javascript">
            var demo1 = $('select[name="demandeavance[id_agent]"]').bootstrapDualListbox({
                infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'
            });
            var container1 = demo1.bootstrapDualListbox('getContainer');
            container1.find('.btn').addClass('btn-white btn-info btn-bold');

            var demo2 = $('select[name="historiqueretenue[avance]"]').bootstrapDualListbox({
                infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'
            });
            var container2 = demo2.bootstrapDualListbox('getContainer');
            container2.find('.btn').addClass('btn-white btn-info btn-bold');

            var demo3 = $('select[name="historiqueretenue[pret]"]').bootstrapDualListbox({
                infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'
            });
            var container3 = demo3.bootstrapDualListbox('getContainer');
            container3.find('.btn').addClass('btn-white btn-info btn-bold');

            var demo4 = $('select[name="historiqueretenue[retenue]"]').bootstrapDualListbox({
                infoTextFiltered: '<span class="label label-purple label-lg">Filtré</span>'
            });
            var container4 = demo4.bootstrapDualListbox('getContainer');
            container4.find('.btn').addClass('btn-white btn-info btn-bold');
            $(document).bind("contextmenu", function(e) {
                return false;
            });
            //              $('.disabledbutton').attr('href', '#');
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