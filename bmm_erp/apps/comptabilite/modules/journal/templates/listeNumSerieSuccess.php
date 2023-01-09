<span class="titre_tiers_modal">Numérotation Série</span>

<div id="list_plan_comptable_dossier">
    <table id="list_num_serie" style="width: 100%" class="table table-bordered table-hover" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <th style="width: 10%">Préfixe</th>
                <th style="width: 10%">Date Début</th>
                <th style="width: 10%">Date Fin</th>
                <th>Numéro Début</th>
                <th>Numéro Fin</th>
                <th>Attendu</th>
                <th>Bloqué</th>
                <th>Validé</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><button id="block_tous" class="btn btn-danger btn-sm" onclick="checkBloqueTous()"> Bloquer Tous</button></th>
                <th><button id="valide_tous" class="btn btn-success btn-sm" onclick="checkValideTous()"> Valider Tous</button></th>
            </tr>
        </thead>
        <tbody>
            <?php include_partial("journal/liste_numero_serie", array("series" => $series, "journal" => $journal)) ?>
        </tbody>
    </table>
    <div>
        <span style="color: #D15B47; margin-right: 15%; font-weight: bold; font-size: 14px ;"> * Vous ne pouvez pas bloquer une série qui contient des piéces non validés. </span>
    </div>
</div>

<script  type="text/javascript">

    function checkBloque(num, journal) {
        $.ajax({
            url: '<?php echo url_for('@bloquerNumSerieJournal'); ?>',
            data: 'num=' + num + '&journal=' + journal,
            success: function (data) {
                $('#list_num_serie tbody').html(data);
            }
        });
    }

    function checkValide(num, journal) {
        $.ajax({
            url: '<?php echo url_for('@validerNumSerieJournal'); ?>',
            data: 'num=' + num + '&journal=' + journal,
            success: function (data) {
                $('#list_num_serie tbody').html(data);
            }
        });
    }

</script>

<style>

    .modal-dialog {width: 820px;}
    #list_num_serie thead th{text-align: center;}
    #list_num_serie tbody td{vertical-align: middle;}
    .titre_tiers_modal{font-size: 16px; color: #146bbf !important;}

</style>