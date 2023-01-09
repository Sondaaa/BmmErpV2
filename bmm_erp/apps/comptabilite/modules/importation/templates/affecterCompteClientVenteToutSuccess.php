
<?php include_partial("importation/liste_vente", array("pager" => $pager, "page" => $page, "total" => $total, "ref" => $ref, "dossier" => $dossier, "client" => $client, "etranger" => $etranger)) ?>

<script  type="text/javascript"> 
    $('#zone_client_vente').html('<div style="padding: 10px 30px;">'+
            '<table class="mws-datatable-fn mws-table">'+
            '<thead>'+
            '<tr style="border-bottom: 1px solid #000000">'+
            '<th>Client</th>'+
            '<th>Compte Comptable</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody><?php foreach ($client_compte as $c_c): ?>'+
            '<tr>'+
            '<td style="text-align: center;"><?php echo $c_c->getCode() .' - ' .$c_c->getRaisonSociale(); ?></td>'+
            '<td style="text-align: center;"><?php echo $c_c->getCompteComptable()->getNumeroCompte(); ?></td>'+
            '</tr>'+
            '<?php endforeach; ?></tbody>'+
            '</div>');
</script>
