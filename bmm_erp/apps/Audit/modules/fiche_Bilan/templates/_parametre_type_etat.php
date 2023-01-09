<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" style="min-height: 250px;">
                <div class="mws-panel-body no-padding">
                    <table class="mws-table" id="liste_ligne" style="font-weight: bold;">
                        <thead>
                            <tr>
                                <th style="width: 8%;">#</th>
                                <th style="width: 52%;">Compte Comptable</th>
                                <th style="width: 30%;">Type Compte Comptable</th>
                                <th style="width: 10%;">Opération</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th ><input type="text" id="compte" onkeyup="goPage(1);" style="width: 100%;" /></th>
                                <th><input id="type" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot id="list_bilan_pager"></tfoot>
                        <tbody id="liste_type_bilan">
                            <?php include_partial("fiche_Bilan/liste_bilan", array("pager" => $pager, "page" => $page)) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('fiche_Bilan/goPageParametreTypeCompte') ?>',
            data: 'page=' + page +
                    '&compte=' + $('#compte').val() +
                    '&type=' + $('#type').val(),
            success: function(data) {
                $('#liste_type_bilan').html(data);
            }
        });
    }

</script>