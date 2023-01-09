<?php if ($pager8->count()==0 ): ?>
        <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="3">Liste  des comptes Vide</td>
      </tr>
    <?php endif; ?>
<?php foreach ($pager8->getResults() as $compte): ?>
    <tr>
        <td style="width: 20%; text-align: center;" id="codCompte<?php echo $compte->getId() ?>"><?php echo  $compte->getCode()  ?></td>
        <td style="width: 30%; text-align: left; padding-left: 2%" id="libCompte<?php echo $compte->getId() ?>"><?php echo  $compte->getLibelle()  ?></td>
        <td style="width: 10%; text-align: center;"> 
            <span class="btn-group">
              <a style="cursor: pointer" title="Modifier" onclick="ModifierCompte('<?php echo $compte->getId() ?>','<?php echo $pager8->getPage() ?>')" class="btn btn-small"><i class="icon-pencil"></i></a>
               <?php //if($compte->getId() > 5): ?>
                <a style="cursor: pointer" title="Supprimer" onclick="deleteCompte('<?php echo $compte->getId() ?>')" class="btn btn-small"><i class="icon-trash"></i></a>
                <?php //endif; ?>
            </span>
                
        </td>
        </tr>
    <?php endforeach; ?>
</tbody>

<tfoot>
    <tr>
        <td style="padding: 0px; " colspan="3">
             <div style="background: none repeat scroll 0 0 #444444; width: 100%; float: left">
            <div class="dataTables_paginate paging_full_numbers">
               
                    <?php if ($pager8->haveToPaginate()): ?>
                        <?php if ($pager8->getPage() == 1): ?>
                            <span  class="first paginate_button paginate_button_disabled">Premier</span>
                            <span  class="previous paginate_button paginate_button_disabled">Précédent</span>
                        <?php else: ?>
                            <span onclick="goPageCompte('1')" class="first paginate_button ">Premier</span>
                            <span onclick="goPageCompte('<?php echo $pager8->getPreviousPage() ?>')" class="previous paginate_button ">Précédent</span>
                        <?php endif; ?>
                        <?php foreach ($pager8->getLinks() as $page): ?>
                            <?php if ($page == $pager8->getPage()): ?>
                                <span class="paginate_active"><?php echo $page ?></span>
                            <?php else: ?>
                                <span onclick="goPageCompte('<?php echo $page ?>')" class="paginate_button"><?php echo $page ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($pager8->getPage() == $pager8->getLastPage()): ?>
                            <span  class="next paginate_button paginate_button_disabled">Suivant</span>
                            <span  class="last paginate_button paginate_button_disabled">Dernier</span>
                        <?php else: ?>
                            <span onclick="goPageCompte('<?php echo $pager8->getNextPage() ?>')" class="next paginate_button">Suivant</span>
                            <span onclick="goPageCompte('<?php echo $pager8->getLastPage() ?>')" class="last paginate_button">Dernier</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </td>
    </tr>