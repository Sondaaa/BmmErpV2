
<table class="mws-datatable-fn mws-table">
    <thead>
        <tr style="border-bottom: 1px solid #000000">
            <th style="width: 6%; text-align: center;"><input id="selecte_all" type="checkbox" /></th>
            <th style="width: 9%; text-align: center;">Date Opération</th>
            <th style="width: 6%; text-align: center;">Numéro</th>
            <th style="width: 20%; text-align: center;">Libellé</th>
            <th style="width: 9%; text-align: center;">Date valeur</th>
            <th style="width: 10%; text-align: center;">Montant</th>
            <th style="width: 9%; text-align: center;"> TVA</th>
            <th style="width: 8%; text-align: center;">Total TTC</th>
            <th style="width: 8%; text-align: center;">Type</th>
             <th style="width: 8%; text-align: center;">Banque/Caisse</th>
            <th style="width: 8%; text-align: center;">Opérations</th>
        </tr>
        <tr> <th></th>
            <th></th>
            <th><input type="text" id="ref" onkeyup="goPageTresorerie(1);" style="width: 100%;" /></th>
            <th><input id="libelle" onkeyup="goPageTresorerie(1);" type="text" style="width: 100%;" /></th>

            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><input id="type" onkeyup="goPageTresorerie(1);" type="text" style="width: 100%;" /></th>
         <th><input id="banque" onkeyup="goPageTresorerie(1);" type="text" style="width: 100%;" /></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody id="listFacture">
        <?php include_partial("importation/liste_reglement_partial", array("factures" => $factures, "numero" => $reference)) ?>


    </tbody>
</table>  
<script>
    function goPageTresorerie(page) {

        $.ajax({
            url: '<?php echo url_for('importation/goPageTre'); ?>',
            data: 'page=' + page + '&reference=' + $('#ref').val()
                    + '&libelle=' + $('#libelle').val() + '&type=' + $('#type').val()
            +'&banque=' + $('#banque').val()
            ,
            success: function (data) {
                $('#listFacture').html(data);
            }
        });
    }
</script>