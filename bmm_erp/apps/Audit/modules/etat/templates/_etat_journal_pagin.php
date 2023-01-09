<div class="mws-panel-header">
    <span class="mws-i-24 i-table-1">Liste des journaux Comptables</span>
</div>
<div class="mws-panel-body">
    <table id="listJournal" class="mws-datatable-fn mws-table">
        <thead>
            <tr style="border-bottom: 1px solid #000000" >
                <th style="width: 20%;">Pièce Comptable</th>
                <th style="width: 10%;">Ligne</th>
                <th style="width: 10%;">Nature Pièce</th>
                <th style="width: 10%;">N° externe</th>
                <th style="width: 20%;">Libellé</th>
                <th style="width: 10%;">Compte</th>      
                <th style="width: 10%;">Débit</th> 
                <th style="width: 10%;">Crédit </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Journaux Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $journal): ?>
    <tr>
        <td style="text-align: left; padding-left: 1%;"><?php echo $fiche->getPieceComptable()->getNumero() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getReference() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getNaturePiece()->getLibelle() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getNumeroExterne() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getPieceComptable()->getLibelle() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getSousCompteComptable()->getLibelle() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getMontantDebit() ?></td>
        <td style="text-align: center;"><?php echo $fiche->getMontantCredit() ?></td>
    </tr>
<?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td style="padding: 0px; " colspan="8">
                    <div style="background: none repeat scroll 0 0 #444444; width: 100%; float: left">
                        <div class="dataTables_paginate paging_full_numbers">

                            <?php if ($pager->haveToPaginate()): ?>
                                <?php if ($pager->getPage() == 1): ?>
                                    <span  class="first paginate_button paginate_button_disabled">Premier</span>
                                    <span  class="previous paginate_button paginate_button_disabled">Précédent</span>
                                <?php else: ?>
                                    <span onclick="afficher('1')" class="first paginate_button ">Premier</span>
                                    <span onclick="afficher('<?php echo $pager->getPreviousPage() ?>')" class="previous paginate_button ">Précédent</span>
                                <?php endif; ?>
                                <?php foreach ($pager->getLinks() as $page): ?>
                                    <?php if ($page == $pager->getPage()): ?>
                                        <span class="paginate_active"><?php echo $page ?></span>
                                    <?php else: ?>
                                        <span onclick="afficher('<?php echo $page ?>')" class="paginate_button"><?php echo $page ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($pager->getPage() == $pager->getLastPage()): ?>
                                    <span  class="next paginate_button paginate_button_disabled">Suivant</span>
                                    <span  class="last paginate_button paginate_button_disabled">Dernier</span>
                                <?php else: ?>
                                    <span onclick="afficher('<?php echo $pager->getNextPage() ?>')" class="next paginate_button">Suivant</span>
                                    <span onclick="afficher('<?php echo $pager->getLastPage() ?>')" class="last paginate_button">Dernier</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>