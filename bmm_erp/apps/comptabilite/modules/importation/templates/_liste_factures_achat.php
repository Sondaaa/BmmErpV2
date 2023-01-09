<?php
$tier = "Fournisseur";
//                $url = $url . "&client=" . $client;
?>
<table  class="mws-datatable-fn mws-table">
    <thead>
        <tr style="border-bottom: 1px solid #000000">
            <th style="width: 6%; text-align: center;"><input id="selecte_all" type="checkbox" /></th>
            <th style="width: 6%; text-align: center;">Numéro</th>
            <th style="width: 9%; text-align: center;">Date</th>
            <th style="width: 10%; text-align: center;">Référence</th>
            <th style="width: 24%;"><?php echo $tier; ?></th>
            <th style="width: 10%; text-align: center;">Total Ht</th>
            <th style="width: 9%; text-align: center;">Total Tva</th>
            <th style="width: 8%; text-align: center;">Timbre</th>
            <th style="width: 10%; text-align: center;">Total Ttc</th>
            <th style="width: 8%; text-align: center;">Opérations</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th><input type="text" id="ref" onkeyup="goPageAchat(1);" style="width: 100%;" /></th>
            <th><input id="fournisseur" onkeyup="goPageAchat(1);" type="text" style="width: 100%;" /></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
    </tfoot>

    <tbody id="listFacture">
        <?php include_partial("importation/liste_achat_partial", array("factures" => $factures, "numero" => $reference)) ?>  
    </tbody>
</table>   
<script>
    function goPageAchat(page) {

        $.ajax({
            url: '<?php echo url_for('importation/goPageAch'); ?>',
            data: 'page=' + page + '&ref=' + $('#ref').val()
                    + '&frs=' + $('#fournisseur').val()
            ,
            success: function (data) {
                $('#listFacture').html(data);
            }
        });
    }
</script>