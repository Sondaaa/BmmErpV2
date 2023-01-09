<?php use_helper('I18N', 'Date') ?>
<?php include_partial('papiercheque/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Liste des chéquiers', array(), 'messages') ?></h1>

    <?php include_partial('papiercheque/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('papiercheque/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('papiercheque/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('papiercheque_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('papiercheque/list', array('pager' => $pager, 'idcarnet' => $idcarnet, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php //include_partial('papiercheque/list_batch_actions', array('helper' => $helper)) ?>
                <?php //include_partial('papiercheque/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('papiercheque/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<script  type="text/javascript">

    function showDetail(id) {
        $.ajax({
            url: '<?php echo url_for('papiercheque/detail') ?>',
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



    function annulerCheque(id) {
        $.ajax({
            url: '<?php echo url_for('papiercheque/getAnnulationCheque') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.confirm({
                    message: data,
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
                            goAnnulerCheque(id, $('#next_cheque').val());
                        }
                    }
                });
            }
        });
    }

    function goAnnulerCheque(id, next_cheque) {
        $.ajax({
            url: '<?php echo url_for('papiercheque/annuler') ?>',
            data: 'id=' + id + '&next_cheque=' + next_cheque,
            success: function (data) {
                location.reload();
            }
        });
    }

</script>