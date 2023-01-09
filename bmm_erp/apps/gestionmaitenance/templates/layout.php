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
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-2.1.4.min.js"></script>
        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/rx.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/angular.js"></script>


        <style>
            .disabledbutton {
                pointer-events: none;
                opacity: 0.7;
            }

            ul li {
                cursor: pointer;
            }

            .testul ul {
                max-height: 150px;
                min-width: 150px;
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

            .selected_li {
                background-color: #3875d7;
                background-image: -webkit-gradient(linear, 50% 0, 50% 100%, color-stop(20%, #3875d7), color-stop(90%, #2a62bc));
                background-image: -webkit-linear-gradient(#3875d7 20%, #2a62bc 90%);
                background-image: -moz-linear-gradient(#3875d7 20%, #2a62bc 90%);
                background-image: -o-linear-gradient(#3875d7 20%, #2a62bc 90%);
                background-image: linear-gradient(#3875d7 20%, #2a62bc 90%);
                color: #fff
            }

            .align_right {
                text-align: right;
            }

            .align_center {
                text-align: center;
            }
        </style>
    </head>

    <body class="no-skin" ng-app="Appdoc">

        <?php include_partial('global/header', array('user' => $user)); ?>

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container');
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

        <script>
            var app = angular.module('Appdoc', []);
        </script>

        <!--[if !IE]> -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-2.1.4.min.js"></script>
        <!-- Custom Theme JavaScript -->
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
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.flash.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.html5.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.print.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/buttons.colVis.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/dataTables.select.min.js"></script>
        <!-- ace scripts -->
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace-elements.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/jquery-ui.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/ace.min.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/ckeditor.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>ckeditor/adapters/jquery.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/bootbox.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#reclamationfrs_sujet').ckeditor();
                $('#marches_object').ckeditor();
                $('#ordredeservice_description').ckeditor();
            });
            jQuery(function($) {
                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
                /***************/
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
            $("#replaceh1").remove();
            $("table").addClass("table  table-bordered table-hover");
            $(".sf_admin_filter").not('[id="document_achat_filtre"]').attr("style", " width: 65%;");
            $('ul').attr('style', 'list-style:none');
            $('input:text').addClass("class", "input-sm");
            contenu2 = $(".sf_admin_filter").html();
            htmlcontenu = '<div class="widget-box ui-sortable-handle" id="widget-box-1" style="opacity: 1;"><div class="widget-header"><h5 class="widget-title">Recherche</h5><div class="widget-toolbar"> <a href="#" data-action="collapse"> <i class="ace-icon fa fa-chevron-up"></i> </a> </div></div> <div class="widget-body" style="display: block;">' + contenu2 + '</div></div>';
            $('.sf_admin_filter').not('[id="document_achat_filtre"]').html(htmlcontenu);
            $('td button').not('[class="btn btn-primary btn-xs"]').not('[class="btn btn-danger btn-xs"]').attr('class', 'btn btn-white btn-success');
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
            $('select').not('[id="taufodecsysBDCFac"]').not('[id="taufodec"]').not('[id="tva"]').not('[id="tvasysBDCFac"]').not('[id="lots_id_marche"]').not('[id="financement_id_tva"]').not('[id="tva"]').not('[id="idnote"]').attr('class', "chosen-select form-control");
            $('select[id!="skin-colorpicker"]').attr('style', 'width: 100%;');
            $('input:text[id!="delai"]').attr('style', 'width: 100%;');
            //            $('input:date[id!="datemax"]').attr('style', 'width: 100%;');
            $('#btnaction li *').attr('style', 'border: none;font-size: 14px;text-align: center;');
            $('#editor1').ace_wysiwyg();
        </script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/BmmErpFramwork.js"></script>

        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/Ctrldocbci.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlDemandeprix.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/Scan.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/Ctrlfrs.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlDecompte.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlFacturation.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlNotification.js"></script>
        <script src="<?php echo sfconfig::get('sf_appdir') ?>js/AngularCtrl/CtrlDashboard.js"></script>   
        <script>
            $('#piecejoint_facture, #piecejoint_rrs , #piecejoint_pvr').ace_file_input({
                no_file: 'Pas de document ...',
                btn_choose: 'Parcourir',
                btn_change: 'Changer',
                droppable: false,
                onchange: null,
                thumbnail: false //| true | large
                //whitelist:'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
            }).on('change', function() {
                alert($(this).data('ace_input_files')[0].name);

                //console.log($(this).data('ace_input_files'));
                //console.log($(this).data('ace_input_method'));
            });
            //            $(document).bind("contextmenu", function (e) {
            //                return false;
            //            });
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
        <script type="text/javascript">
            jQuery(function($) { //initiate dataTables plugin
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
    </body>

    </html>
<?php endif; ?>