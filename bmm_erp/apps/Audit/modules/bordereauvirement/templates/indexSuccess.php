<?php use_helper('I18N', 'Date') ?>
<?php include_partial('bordereauvirement/assets') ?>

<div id="show_bordereau" style="display: none;">

</div>

<div id="sf_admin_container">
    <h1><?php echo __('Liste des bordereaux', array(), 'messages') ?></h1>

    <?php include_partial('bordereauvirement/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('bordereauvirement/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('bordereauvirement/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('bordereauvirement_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('bordereauvirement/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <!--            <ul class="sf_admin_actions">
            <?php //include_partial('bordereauvirement/list_batch_actions', array('helper' => $helper)) ?>
            <?php //include_partial('bordereauvirement/list_actions', array('helper' => $helper)) ?>
                        </ul>-->
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php //include_partial('bordereauvirement/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<script  type="text/javascript">

    function validerBordereau(id_bordereau, id_banque, id_nature_compte) {
        $.ajax({
            url: '<?php echo url_for('bordereauvirement/getOrderVirement') ?>',
            data: 'id_banque=' + id_banque,
            success: function (data) {
                if (id_nature_compte == '1') {
                    bootbox.confirm({
                        message: data,
                        buttons: {
                            cancel: {
                                label: "Annuler",
                                className: "btn-sm",
                            },
                            confirm: {
                                label: "Valider",
                                className: "btn-primary btn-sm",
                            }
                        },
                        callback: function (result) {
                            if (result) {
                                goValide(id_bordereau);
                            }
                        }
                    });
                }
            }
        });
    }

    function goValide(id_bordereau) {
        $.ajax({
            url: '<?php echo url_for('bordereauvirement/valider') ?>',
            data: 'id_papierordre=' + $('#id_papierordre').val() +
                    '&cible=' + $('#cible_ordre').val() +
                    '&objet=' + $('#objet_ordre').val() +
                    '&id_bordereau=' + id_bordereau,
            success: function (data) {
                location.reload();
            }
        });
    }

    function showBordereau(id_bordereau) {
        $.ajax({
            url: '<?php echo url_for('bordereauvirement/show') ?>',
            data: 'id_bordereau=' + id_bordereau,
            success: function (data) {
                $('#show_bordereau').html(data);
                $('#sf_admin_container').fadeOut();
                $('#show_bordereau').fadeIn();
                $('html,body').scrollTop(0);
            }
        });
    }

    function supprimerBordereau(id_bordereau) {
        bootbox.confirm({
            message: '<span style="font-size: 16px;">Voulez-vous supprimer ce bordereau ?</span>',
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    deleteBordereau(id_bordereau);
                }
            }
        });
    }

    function deleteBordereau(id_bordereau) {
        $.ajax({
            url: '<?php echo url_for('bordereauvirement/delete') ?>',
            data: 'id_bordereau=' + id_bordereau,
            success: function (data) {
                location.reload();
            }
        });
    }

    function showDetail(id) {
        $.ajax({
            url: '<?php echo url_for('papierordrepostal/detail') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        });
    }

    function annulerOrdre(id, numero) {
        bootbox.dialog({
            message: "<span class='bigger-110'>Voulez-vous supprimer cet ordre de virement : " + numero + " ?</span><div style='margin-left: 10%; margin-top: 10px;width: 75%;text-align: justify;border-left: 3px solid #bf9090;padding-left: 15px;'>Si c'est le cas, veuillez choisir entre : <ul style='font-weight: normal;margin-top: 10px;'><li style='line-height: 25px;margin-bottom: 15px;'>La destruction physique du l'ordre de virement (cas de falsification). <i class='ace-icon fa fa-hand-o-right bigger-110 red' style='margin-left: 20px;'> Détruire</i></li><li style='line-height: 25px;margin-bottom: 15px;'>L'initialisation du l'ordre de virement pour l'utiliser une fois de nouveau. <i class='ace-icon fa fa-hand-o-right bigger-110 blue' style='margin-left: 20px;'> Initialiser</i></li><ul></div>",
            buttons:
                    {
                        "danger":
                                {
                                    "label": "Détruire",
                                    "className": "btn-sm btn-danger",
                                    "callback": function () {
                                        goAnnulerOrdre(id, 1);
                                    }
                                },
                        "click":
                                {
                                    "label": "Initialiser",
                                    "className": "btn-sm btn-primary",
                                    "callback": function () {
                                        goAnnulerOrdre(id, 0);
                                    }
                                },
                        "button":
                                {
                                    "label": "Annuler",
                                    "className": "btn-sm"
                                }
                    }
        });
    }

    function goAnnulerOrdre(id, annuler) {
        $.ajax({
            url: '<?php echo url_for('papierordrepostal/annuler') ?>',
            data: 'id=' + id + '&annuler=' + annuler,
            success: function (data) {
                location.reload();
            }
        });
    }

</script>