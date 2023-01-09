<div class="mws-panel-header">
    <span class="mws-i-24 i-table-1">Liste des journaux Comptables</span>
</div>
<div class="mws-panel-body">
    <table id="listJournal" class="mws-datatable-fn mws-table">
        <thead>
            <tr style="border-bottom: 1px solid #000000" >
                <th style="width: 20%;">Compte</th>
                <th style="width: 10%;">Libellé</th>
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
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="12">Liste des Journaux Vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $journal): ?>
    <tr>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($journal->getDate())) ?></td>
        <td style="text-align: center;"><?php echo $journal->getCode() ?></td>
        <td style="text-align: left; padding-left: 1%;"><?php echo $journal->getLibelle() ?></td>
        <td style="text-align: center;">
            <?php
            $num = $journal->getNumerotation();
            if ($num == 1)
                echo 'Annuel';
            if ($num == 2)
                echo 'Mensuel';
            if ($num == 3)
                echo 'Journalier';
            ?>
        </td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($journal->getDateDebutCloture())) ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($journal->getDateFinCloture())) ?></td>
        <td style="text-align: center;"><?php echo $journal->getTypeJournal()->getLibelle() ?></td>
        <td style="text-align: center;">
            <?php
            $bloque = $journal->getIsBloque();
            if ($bloque == 1):
                ?>
                <img  src="/images/icon/cheked.png" onclick="bloquerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer"   />
            <?php else: ?>
                <img   src="/images/icon/unchecked.png" onclick="bloquerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer"  />
            <?php endif; ?>
           <input type="hidden" id="bloque_journal_<?php echo $journal->getId() ?>" value="<?php echo $bloque; ?>" />     
        </td>
        <td style="text-align: center;">
            <?php
            $valide = $journal->getIsValide();
            if ($valide == 1):
                ?>
                <img  src="/images/icon/cheked.png"  onclick="validerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer"   />
            <?php else: ?>
                <img   src="/images/icon/unchecked.png" onclick="validerJournal('<?php echo $journal->getId() ?>')" style="cursor: pointer"   />
    <?php endif; ?>
                <input type="hidden" id="valide_journal_<?php echo $journal->getId() ?>" value="<?php echo $valide; ?>" />
        </td>
        <td style="text-align: center;">
            <a href="javascript:listePlan(<?php echo $journal->getId() ?>)" ><span class="nombre"><?php echo count($journal->getJournal()); ?></span></a>
        </td>
        <td style="text-align: center;">
            <a href="javascript:listeNumSerie(<?php echo $journal->getId() ?>)" ><span class="nombre"><?php echo count($journal->getNumeroSerieJournal()); ?></span></a>
        </td>
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">
                <a style="cursor: pointer" title="Afficher" onclick="showJournal('<?php echo $journal->getId() ?>')" class="btn btn-small"><i class="icon-search"></i></a>
                <a style="cursor: pointer" title="Modifier" onclick="showEditJournal('<?php echo $journal->getId() ?>')" class="btn btn-small"><i class="icon-pencil"></i></a>
                <?php if ($journal->getIsValide() == 0): ?>
                    <a style="cursor: pointer" title="Supprimer" onclick="openPopupSupprimer(<?php echo $journal->getId() ?>)" class="btn btn-small"><i class="icon-trash"></i></a>
    <?php endif; ?>
            </span>
        </td>
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
                                    <span onclick="goPage('1')" class="first paginate_button ">Premier</span>
                                    <span onclick="goPage('<?php echo $pager->getPreviousPage() ?>')" class="previous paginate_button ">Précédent</span>
                                <?php endif; ?>
                                <?php foreach ($pager->getLinks() as $page): ?>
                                    <?php if ($page == $pager->getPage()): ?>
                                        <span class="paginate_active"><?php echo $page ?></span>
                                    <?php else: ?>
                                        <span onclick="goPage('<?php echo $page ?>')" class="paginate_button"><?php echo $page ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($pager->getPage() == $pager->getLastPage()): ?>
                                    <span  class="next paginate_button paginate_button_disabled">Suivant</span>
                                    <span  class="last paginate_button paginate_button_disabled">Dernier</span>
                                <?php else: ?>
                                    <span onclick="goPage('<?php echo $pager->getNextPage() ?>')" class="next paginate_button">Suivant</span>
                                    <span onclick="goPage('<?php echo $pager->getLastPage() ?>')" class="last paginate_button">Dernier</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>