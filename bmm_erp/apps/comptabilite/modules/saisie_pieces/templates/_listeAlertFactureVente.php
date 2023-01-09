<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Liste des Factures Vide</td>
    </tr>
<?php endif; ?>

<?php foreach ($pager->getResults() as $i=>$facture): ?>
   <tr>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($facture->getDate())) ?></td>
        <td style="text-align: center;"><?php echo $facture->getReference() ?></td>
        <td style="text-align: left; padding-left: 1%;"><?php echo $facture->getDossierComptable()->getRaisonSociale(); ?></td>
        <td style="text-align: center;"><?php echo $facture->getClient()->getRaisonSociale() ?></td>
        <td style="text-align: center;"><?php echo $facture->getTotalHt() ?></td>
        <td style="text-align: center;"><?php echo $facture->getTotalTva() ?></td>
        <td style="text-align: center;"><?php echo $facture->getTotalTtc() ?></td>
    </tr>
<?php endforeach; ?>

<?php if ($pager->haveToPaginate()): ?>
    <script  type="text/javascript">
    <?php if ($pager->getPage() == 1): ?>
            var divPage = '<div class="dataTables_paginate paging_full_numbers">' +
                    '<span  class="first paginate_button paginate_button_disabled">Premier</span>' +
                    '<span  class="previous paginate_button paginate_button_disabled">Précédent</span><span>';
    <?php else: ?>
            var divPage = '<div class="dataTables_paginate paging_full_numbers">' +
                    '<span onclick="goPage(\'1\')" class="first paginate_button ">Premier</span>' +
                    '<span onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')" class="previous paginate_button ">Précédent</span><span>';
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                divPage = divPage + '<span class="paginate_active"><?php echo $page ?></span>';
        <?php else: ?>
                divPage = divPage + '<span onclick="goPage(\'<?php echo $page ?>\')" class="paginate_button"><?php echo $page ?></span>';
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            divPage = divPage + '<span  class="next paginate_button paginate_button_disabled">Suivant</span>' +
                    '<span  class="last paginate_button paginate_button_disabled">Dernier</span>';
            $('#list_facture_pager').html(divPage);
    <?php else: ?>
            divPage = divPage + '<span onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')" class="next paginate_button">Suivant</span>' +
                    '<span onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')" class="last paginate_button">Dernier</span>';
    <?php endif; ?>
        $('#list_facture_pager').html(divPage);
    </script>
<?php else: ?>
    <script  type="text/javascript">
        $('#list_facture_pager').html('<div class="dataTables_paginate paging_full_numbers"></div>');
    </script>
<?php endif; ?>

<style>
    .nombre{
        background-color: #5b5b5b;
        border: medium none;
        border-radius: 4px;
        color: #fff;
        cursor: pointer;
        /*float: left;*/
        font-family: Bitter;
        font-weight: bold;
        line-height: 1.42857;
        margin: 0 3px;
        padding: 6px 12px;
        position: relative;
        text-decoration: none;
    }
    
</style>