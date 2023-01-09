
<div class="table-responsive">
    <form action="<?php echo url_for('document/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
        <?php if (!$form->getObject()->isNew()): ?>
            <input type="hidden" name="sf_method" value="put" />
        <?php endif; ?>
        <table>
            <tfoot>
                <tr>
                    <td colspan="2">

                        <?php if (!$form->getObject()->isNew()): ?>
                            &nbsp;<?php echo link_to('Supprimer', 'document/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sûr ?')) ?>
                        <?php endif; ?>
                        <input type="submit" value="Valider attachement" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>
                        <label>Courrier </label>
                    </td>
                    <td>
                        <?php echo $form['id_courrier']->renderError() ?>
                        <?php echo $form['id_courrier']->render(array('class' => 'disabledbutton')) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Chemin </label>
                    </td>
                    <td>
                        <?php echo $form['chemin']->renderError() ?>
                        <?php echo $form['chemin'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <table>
        <thead>
            <tr>
                <th>Chemin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($piecejoints as $piecejoint): ?>
                <tr>
                    <td><a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">
                            <img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>" style="width: 120px;height: 120px;">
                        </a></td>
                    <td><a href="<?php echo url_for('piecejoint/edit?id=' . $piecejoint->getId()) ?>">Mise à jour</a>
                        <a href="<?php echo url_for('document/delete?id=' . $piecejoint->getId()) ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
