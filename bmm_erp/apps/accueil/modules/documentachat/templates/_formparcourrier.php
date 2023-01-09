<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="button" class="btn btn-outline btn-success" value="Valider Attachement" ng-click="ValiderAttachementDocumentAchatDoc(<?php echo $documentachat->getId(); ?>)" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Bon Commande Interne</td>
                <td><?php echo $documentachat->getTypedoc()->getPrefixetype()
                        . ' ' . sprintf('%05d', $documentachat->getNumero()); ?></td>
            </tr>
            <tr>
                <td>Libelle</td>
                <td>
                    <?php echo $form['objet'] ?>
                </td>
            </tr>
            <tr>
                <td>Sujet</td>
                <td>
                    <?php echo $form['sujet'] ?>
                </td>
            </tr>
            <tr>
                <td>chemin</td>
                <td>
                    <?php echo $form['chemin']->renderError() ?>
                    <?php echo $form['chemin'] ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>Chemin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($piecejoints as $piecejoint) : ?>
                <tr>
                    <td>
                        <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">
                            <?php echo $piecejoint->getObjet() ?>
                        </a>
                    </td>
                    <td style="text-align: center;">
                    <a href="<?php echo url_for('documentachat/deletePiecejoint?id=' . $piecejoint->getId() ) ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>