<div class="table-responsive">
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="button" class="btn btn-outline btn-success" value="Valider Attachement" ng-click="ValiderAttachementDocument(<?php echo $ordre->getId(); ?>)" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td><label>Ordre de service </label></td>
                <td><?php echo $ordre ?></td>
            </tr>
            <tr>
                <td><label>chemin </label></td>
                <td>
                    <?php echo $form['chemin']->renderError() ?>
                    <?php echo $form['chemin']->render(array('id' => 'piecejoint_chemin' . $ordre->getId())) ?>
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
                <td>
                    <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">
                        <?php echo $piecejoint->getChemin() ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo url_for('piecejoint/edit?id=' . $piecejoint->getId() . '&idtab=' . $_REQUEST['idtab']) ?>">Mise à jour</a>
                    <a href="<?php echo url_for('document/delete?id=' . $piecejoint->getId() . '&idtab=' . $_REQUEST['idtab']) ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>