<?php include_partial("importation/liste_achat", array("pager" => $pager, "page" => $page, "total" => $total, "ref" => $ref, "dossier" => $dossier, "fournisseur" => $fournisseur, "etranger" => $etranger)) ?>

<script  type="text/javascript"> 
    $('#zone_fournisseur_achat').html('<div style="padding: 10px 30px;">'+
            '<table class="mws-datatable-fn mws-table">'+
            '<thead>'+
            '<tr style="border-bottom: 1px solid #000000">'+
            '<th>Fournisseur</th>'+
            '<th>Compte Comptable</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody><?php foreach ($fournisseur_compte as $f_c): ?>'+
            '<tr>'+
            '<td style="text-align: center;"><?php echo $f_c->getCode() .' - ' .$f_c->getRaisonSociale(); ?></td>'+
            '<td style="text-align: center;"><?php echo $f_c->getCompteComptable()->getNumeroCompte(); ?></td>'+
            '</tr>'+
            '<?php endforeach; ?></tbody>'+
            '</div>');
</script>