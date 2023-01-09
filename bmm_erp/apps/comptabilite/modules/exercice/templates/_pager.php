<tfoot>
    <tr>
        <td style="padding: 0px; " colspan="4">
            <div style="background: none repeat scroll 0 0 #444444; width: 100%; float: left">
                <div class="dataTables_paginate paging_full_numbers">

                    <?php if ($pager->haveToPaginate()): ?>
                        <?php if ($pager->getPage() == 1): ?>
                            <span  class="first paginate_button paginate_button_disabled">Premier</span>
                            <span  class="previous paginate_button paginate_button_disabled">Précédent</span>
                        <?php else: ?>
                            <span onclick="goPageAnterieur('1')" class="first paginate_button ">Premier</span>
                            <span onclick="goPageAnterieur('<?php echo $pager->getPreviousPage() ?>')" class="previous paginate_button ">Précédent</span>
                        <?php endif; ?>
                        <?php foreach ($pager->getLinks() as $page): ?>
                            <?php if ($page == $pager->getPage()): ?>
                                <span class="paginate_active"><?php echo $page ?></span>
                            <?php else: ?>
                                <span onclick="goPageAnterieur('<?php echo $page ?>')" class="paginate_button"><?php echo $page ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($pager->getPage() == $pager->getLastPage()): ?>
                            <span  class="next paginate_button paginate_button_disabled">Suivant</span>
                            <span  class="last paginate_button paginate_button_disabled">Dernier</span>
                        <?php else: ?>
                            <span onclick="goPageAnterieur('<?php echo $pager->getNextPage() ?>')" class="next paginate_button">Suivant</span>
                            <span onclick="goPageAnterieur('<?php echo $pager->getLastPage() ?>')" class="last paginate_button">Dernier</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </td>
    </tr>