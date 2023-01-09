

<div class="mws-panel grid_8" id="form_liste_piece">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Liste des Factures Import non Traitées</span>
    </div>
    <div class="dataTables_filter">
        
    </div>
    <div class="mws-panel-body">
            <table id="listFacture" class="mws-datatable-fn mws-table">
                <thead>
                <tr style="border-bottom: 1px solid #000000" >
                    <th style="width: 10%;">Date</th>
                    <th style="width: 10%;">Référence</th>
                    <th >Dossier Comptable</th>
                    <th style="width: 20%;">Fournisseur</th> 
                    <th style="width: 10%;">Total Ht</th>      
                    <th style="width: 10%;">Total Tva</th>  
                    <th style="width: 10%;">Total ttc</th>
                </tr>
                <tr>
                    <th></th>
                    <th ><input type="text" id="ref" onkeyup="goPage(1);" style="width: 100%;" /></th>
                    <th><input id="dossier" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                    <th><input id="fournisseur" onkeyup="goPage(1);" type="text" style="width: 100%;" /></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
                <tfoot>
                    <tr>
                        <td style="width: 100%;padding: 0" colspan="7">
                            <div id="list_facture_pager" style="background: none repeat scroll 0 0 #444444;width: 100%;float: left"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php include_partial("saisie_pieces/listeAlertFactureAchat", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
    </div>
</div>



<script  type="text/javascript">
    
    function goPage(page) {
        $('#image_loading').css('display', 'block');
         var ref = $('#ref').val();
        var dossier = $('#dossier').val();
        var fournisseur = $('#fournisseur').val();
        $.ajax({
            url: '<?php echo url_for('@listeAlertFactureImport'); ?>',
            data: 'page=' + page + '&ref=' + ref +
                    '&fournisseur=' + fournisseur + '&dossier=' + dossier,
            success: function(data) {
                $('#listFacture tbody').html(data);
                $("table.mws-table tbody tr:even").addClass("even");
                $("table.mws-table tbody tr:odd").addClass("odd");
                $('#image_loading').css('display', 'none');
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