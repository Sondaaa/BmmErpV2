<div id="sf_admin_container">
    <h1 id="replacediv"> Importation 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liste des Factures Comptables Ventes Saisies : <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header" style="margin-bottom: 0px;">
            Liste des Factures Comptables Ventes Saisies :
            <?php
            $url = "type=vente&saisie=1";
            if ($reference != "")
                $url = $url . "&reference=" . $reference;
            if ($client != "")
                $url = $url . "&client=" . $client;
            ?>
            <a id="imprime_liste" target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("importation/imprimeListe?" . $url); ?>">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
            <table id="listFacture" class="mws-datatable-fn mws-table">
                <thead>
                    <tr style="border-bottom: 1px solid #000000" >
                        <th style="width: 10%;">Date</th>
                        <th style="width: 10%;">Référence</th>
                        <th style="width: 20%;">Client</th>
                        <th style="width: 10%;">Total Ht</th>      
                        <th style="width: 10%;">Total Tva</th>  
                        <th style="width: 10%;">Total ttc</th>
                        <th style="width: 10%;">Opérations</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th ><input type="text" id="ref" onkeyup="goPage(1);" style="width: 100%;" /></th>
                        <th><input id="client" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    <?php include_partial("importation/liste_vente_saisie", array("pager" => $pager, "page" => $page, "reference" => $reference, "client" => $client)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">
    function goPage(page) {
        var reference = $('#ref').val();
        var client = $('#client').val();
        $.ajax({
            url: '<?php echo url_for('importation/goPageVenteSaisie'); ?>',
            data: 'page=' + page + '&reference=' + reference +
                    '&client=' + client,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function showFacture(id) {
        $.ajax({
            url: '<?php // echo url_for('@showFactureVente') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#ligne_facture').html(data);
            }
        });
    }


    function annulerFacture(id) {

        $.ajax({
            url: '<?php // echo url_for('@annulerFactureVente') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#listFacture tbody').html(data);
            }
        });
    }

    function openPopupAnnuler(id) {
        annulerFacture(id);
    }

</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
</style>