<table id="list_anterieur" class="mws-datatable-fn mws-table">
    <thead>
        <tr>
            <th style="width: 10%; text-align: center;">Exercice Comptable</th>
            <th style="width: 35%; text-align: center;">Dossier Comptable</th>
            <th style="width: 10%; text-align: center;">Date</th>
            <th style="width: 10%; text-align: center;">Clôturé</th>
            <th style="width: 10%; text-align: center;">Date Clôture</th>
            <th style="width: 15%; text-align: center;">Clôturé par</th>
            <th style="width: 10%; text-align: center;">Opérations</th>
        </tr>
        <tr>
            <th><input type="text" class="align_center" id="exercice_filtre" onkeyup="goPageAnterieur(1);" /></th>
            <th><input type="text" id="dossier_filtre" onkeyup="goPageAnterieur(1);" /></th>
            <th></th>
            <th>
                <select id="cloture_filtre" onchange="goPageAnterieur(1);">
                    <option value="" selected="true">Tout</option>
                    <option value="1">Clôturé</option>
                    <option value="0">Non Clôturé</option>
                </select>
            </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>

    </tfoot>
    <tbody>
        <?php  include_partial('exercice/laListeAnterieur', array('pager' => $pager)) ?>
    </tbody>

</table>

<script  type="text/javascript">

    function deleteAnterieur(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer cet exercice antérieur ?",
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
                    validerSuppressionAnterieur(id);
                }
            }
        });
    }

    function validerSuppressionAnterieur(id) {
        $.ajax({
            url: '<?php echo url_for('@deleteAnterieur') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#list_anterieur > tbody').html(data);
            }
        });
    }

</script>

<style>

    #list_anterieur tbody td{text-align: center; vertical-align: middle;}

</style>