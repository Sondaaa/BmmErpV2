<div id="sf_admin_container">
    <h1 id="replacediv"> Importation 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Liste des factures comptables Retenue à la source saisies  : <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Factures Comptables Retenue à la source Saisie :
            <?php
            $url = "type=od&saisie=1";
            if ($reference != "")
                $url = $url . "&reference=" . $reference;
            if ($fournisseur != "")
                $url = $url . "&fournisseur=" . $fournisseur;
            ?>
            <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("importation/imprimeListe?" . $url); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <table id="listFacture" class="mws-datatable-fn mws-table">
                <thead>
                    <tr style="border-bottom: 1px solid #000000" >
                       <th style="width: 10%; text-align: center;">Numéro</th>
                        <th style="width: 9%; text-align: center;">Date</th>
                        <th style="width: 10%; text-align: center;">Référence</th>
                        <th style="width: 23%;">Fournisseur</th>
                        <th style="width: 10%; text-align: center;">Base</th>
                        <th style="width: 10%; text-align: center;"> Taux</th>
                        <th style="width: 8%; text-align: center;">Retenue</th>
                        <th style="width: 10%; text-align: center;">Net</th>
                        <th style="width: 10%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        
                        <th><input type="text" id="ref" onkeyup="goPageTOD(1);" style="width: 100%;" /></th>
                        <th><input id="fournisseur" onkeyup="goPageTOD(1);" type="text" style="width: 100%;" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    <?php include_partial("importation/liste_od_saisie_client", array("pager" => $pager, "page" => $page, "reference" => $reference, "fournisseur" => $fournisseur)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">
    function goPageTOD(page) {
        var ref = $('#ref').val();
        var dossier = $('#dossier').val();
        var fournisseur = $('#fournisseur').val();
        $.ajax({
            url: '<?php echo url_for('importation/goPageOdSaisie');      ?>',
            data: 'page=' + page + '&ref=' + ref +
                    '&fournisseur=' + fournisseur + '&dossier=' + dossier,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function showFacture(id) {
        $.ajax({
            url: '<?php echo url_for('importation/showAchat') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons: {
                        "success": {
                            "label": "OK",
                            "className": "btn-sm btn-primary"
                        }
                    }
                });
            }
        });
    }


//    function deletefacture(id) {
//        $.ajax({
//            url: '<?php // echo url_for('@suprimerFactureAchat') ?>',
//            data: 'id=' + id,
//            success: function (data) {
//                $('#listFacture tbody').html(data);
//            }
//        });
//    }
    function deletefacture(id) {
        var ref = $('#ref').val();
        var fournisseur = $('#fournisseur').val();
        $.ajax({
            url: '<?php echo url_for('importation/annulerAchat') ?>',
            data: 'id=' + id + '&reference=' + ref + '&fournisseur=' + fournisseur,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function openPopupAnnuler(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer la pièce comptable reliée à cette facture d'achat ?",
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
                    deletefacture(id);
                }
            }
        });
    }


</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
</style>