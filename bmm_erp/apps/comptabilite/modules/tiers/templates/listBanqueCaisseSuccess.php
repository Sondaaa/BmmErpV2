<div id="sf_admin_container">
    <h1 id="replacediv"> Tiers 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Banques & Caisses
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des Banques & Caisses
        </div>

        <div>
            <table id="list_banque_caisse" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 11%;">Code</th>
                        <th style="width: 35%; text-align: left; padding-left: 1%;">Banque & Caisse</th>
                        <th style="width: 12%;">Nature</th>
                        <th style="width: 32%;">Compte Comptable</th>
                        <th style="width: 10%;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input onkeyup="goPage(1)" type="text" id="code"/></th>
                        <th><input onkeyup="goPage(1)" type="text" id="libelle"/></th>
                        <th></th>
                        <th><input onkeyup="goPage(1)" type="text" id="compte_cb"/></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial('list_banque_caisse', array('pager' => $pager)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('tiers/listBanqueCaisse') ?>',
            data: 'page=' + page +
                    '&libelle=' + $('#libelle').val() +
                    '&code=' + $('#code').val() +
                    '&compte=' + $('#compte_cb').val(),
            success: function (data) {
                $('#list_banque_caisse tbody').html(data);
            }
        });
    }
    function show(id) {
        $.ajax({
            url: '<?php echo url_for('tiers/showCompteBc') ?>',
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
    function edit(id) {
        $.ajax({
            url: '<?php echo url_for('tiers/editCompteBc') ?>',
            data: 'id=' + id,
            success: function (data) {
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
                            modifierCompte(id);
                        }
                    }
                });
            }
        });
    }
    
    function modifierCompte(id) {
        $.ajax({
            url: '<?php echo url_for('tiers/updateCompteBc') ?>',
            data: 'id=' + id +
                    '&compte_comptable=' + $('#compte').val() +
                    '&page=' + 1 +
                    '&libelle=' + $('#libelle').val() +
                    '&code=' + $('#code').val() +
                    '&compte=' + $('#compte_cb').val(),
            success: function (data) {
                $('#list_banque_caisse tbody').html(data);
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Tiers - Banques & Caisses");
</script>