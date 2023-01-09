
<div class="row">
    <div class="col-xs-6">
        <div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite"></div>

    </div>
    <div class="col-xs-6">
        <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
            <ul class="pagination">
                <li class="paginate_button previous disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous">

                    <a href="<?php echo url_for('documentachat/listeAnnule') ?>?page=1">
                        Précédent
                    </a>
                </li>
                <?php foreach ($pager->getLinks() as $page): ?>
                    <?php if ($page == $pager->getPage()): ?>
                        <li class="paginate_button active" aria-controls="dynamic-table" tabindex="0">
                            <a href="#">  <?php echo $page ?></a>
                        </li>
                        
                    <?php else: ?>
                       <li class="paginate_button" aria-controls="dynamic-table" tabindex="0">
                        <a href="<?php echo url_for('documentachat/listeAnnule') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
                       </li>
                    <?php endif; ?>
                <?php endforeach; ?>
               
                <li class="paginate_button next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next">
                    <a href="<?php echo url_for('documentachat/listeAnnule') ?>?page=<?php echo $pager->getLastPage() ?>">Dernière</a>
                </li>
            </ul>
        </div>
    </div>
</div>