<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Annulation Importation des règlement du Trésorerie  - <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>
<div>
    <div class="col-sm-12">
        <table>
            <tr>
                <td>
                    <b>Du</b><br>
                    <select id="reglement_min">
                        <option value=""></option>
                        <?php foreach ($reglements as $reglement): ?>
                            <option id="reglement_<?php echo $reglement->getId() ?>" value="<?php echo $reglement->getId() ?>"> <?php echo  trim($reglement->getNumero()) . ' - ' . trim($reglement->getLibelle()) ?> </option>
                        <?php endforeach; ?>
                    </select></br>
                    <b>Au</b><br>
                    <select id="reglement_max">
                        <option value=""></option>
                        <?php foreach ($reglements as $reglement): ?>
                            <option id="reglement_<?php echo $reglement->getId() ?>" value="<?php echo $reglement->getId() ?>"> <?php echo  trim($reglement->getNumero()) . ' - ' . trim($reglement->getLibelle()) ?> </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="text-align: center;">
                    <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="supprimer()" class="btn btn-sm btn-danger">
                        <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Supprimer</span>
                    </button><br>
                    <button style="cursor:pointer;margin-top: 2px;min-width: 118px " onclick="afficher()" class="btn btn-sm btn-primary"> 
                        <i class="ace-icon fa fa-eye bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Afficher</span>
                    </button>
                </td>
            </tr>

        </table>


        <div style="margin-bottom: 15px;" class="mws-panel-body no-padding">
            <div style="height: 360px; overflow: auto;" id="liste_reglements">
                <?php include_partial('annulation/liste_tresorerie', array('reglements' => $reglements)); ?>
            </div>   
        </div>
    </div>
</div>
<script  type="text/javascript">
    function supprimer() {
        var message_text = "Voulez-vous supprimer ces Règlements comptables Trésorerie ? ";
        bootbox.confirm({
            message: message_text,
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
                    validerSuppression();
                }
            }
        });
    }

    function validerSuppression() {

        $.ajax({
            url: '<?php echo url_for('annulation/supprimerReglement') ?>',
            data: 'reglement_min=' + $('#reglement_min').val() + '&reglement_max=' + $('#reglement_max').val(),
            success: function (data) {
                if (data != null) {
                    $('#liste_reglements').html(data);
//                    $('#reglement_min').val('');
//                    $('#reglement_max').val('');
//                    $('#facture_min').trigger("chosen:updated");
//                    $('.chosen-container').trigger("chosen:updated");
//                    $('#facture_max').trigger("chosen:updated");
//                    $('.chosen-container').trigger("chosen:updated");
                }
//               
            }
        });
    }

    function afficher() {
        $.ajax({
            url: '<?php echo url_for('annulation/afficherReglementtresorerie')  ?>',
            data: 'reglement_min=' + $('#reglement_min').val() + '&reglement_max=' + $('#reglement_max').val(),
            success: function (data) {
                $('#liste_reglements').html(data);
            }
        });
    }
</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .mws-table tbody tr.odd td.sorting_1 {
        background-color: #cccccc;
    }
    .mws-table tbody tr.even td.sorting_1 {
        background-color: #e1e1e1;
    }

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : U. Annulations des comptes comptables");
</script>