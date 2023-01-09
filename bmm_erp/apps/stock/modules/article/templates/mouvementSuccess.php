<?php use_helper('I18N', 'Date') ?>
<?php include_partial('article/assets') ?>
 <script src="<?php echo sfconfig::get('sf_appdir') ?>assets/js/tree.min.js"></script>
 <div id="sf_admin_container" ng-controller="CtrlArticle">
    <h1><?php echo __('Mouvement de stock', array(), 'messages') ?></h1>

    <?php include_partial('article/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('article/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('article/filters_mouvement', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('article_collection', array('action' => 'batch')) ?>" method="post">
            <div class="sf_admin_list">
                <?php if (!$pager->getNbResults()): ?>
                    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
                <?php else: ?>
                    <table cellspacing="0">
                        <thead>
                            <tr>
                                <th>Détail Article</th>
                                <th>Mouvement</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="7">
                                    <?php if ($pager->haveToPaginate()): ?>
                            <div class="sf_admin_pagination">
                                <a href="<?php echo url_for('article/mouvement') ?>?page=1">
                                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/first.png', array('alt' => __('First page', array(), 'sf_admin'), 'title' => __('First page', array(), 'sf_admin'))) ?>
                                </a>

                                <a href="<?php echo url_for('article/mouvement') ?>?page=<?php echo $pager->getPreviousPage() ?>">
                                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/previous.png', array('alt' => __('Previous page', array(), 'sf_admin'), 'title' => __('Previous page', array(), 'sf_admin'))) ?>
                                </a>

                                <?php foreach ($pager->getLinks() as $page): ?>
                                    <?php if ($page == $pager->getPage()): ?>
                                        <?php echo $page ?>
                                    <?php else: ?>
                                        <a href="<?php echo url_for('article/mouvement') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <a href="<?php echo url_for('article/mouvement') ?>?page=<?php echo $pager->getNextPage() ?>">
                                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Next page', array(), 'sf_admin'))) ?>
                                </a>

                                <a href="<?php echo url_for('article/mouvement') ?>?page=<?php echo $pager->getLastPage() ?>">
                                    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir') . '/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?>
                                </a>
                            </div>

                        <?php endif; ?>

                        <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
                        <?php endif; ?>
                        </th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($pager->getResults() as $i => $article): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
                                <tr class="sf_admin_row <?php echo $odd ?>">
                                    <td>Numéro: <?php echo $article->getNumero(); ?><br>
                                        Code: <?php echo $article->getCodeart(); ?><br>
                                        Designation: <?php echo $article ?></td>
                                    <td>
                                        <?php include_partial('article/listesmouvement', array('article' => $article)) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>
            <script type="text/javascript">
                /* <![CDATA[ */
                function checkAll()
                {
                    var boxes = document.getElementsByTagName('input');
                    for (var index = 0; index < boxes.length; index++) {
                        box = boxes[index];
                        if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox')
                            box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked
                    }
                    return true;
                }
                /* ]]> */
            </script>
        </form>
    </div>
</div>