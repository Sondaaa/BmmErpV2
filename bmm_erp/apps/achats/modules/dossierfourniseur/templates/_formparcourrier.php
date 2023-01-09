<div class="table-responsive" ng-controller="CtrlScan">
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="button" class="btn btn-outline btn-success" value="Valider Attachement" ng-click="ValiderAttachementDocumentAvecDossierFournisseur(<?php echo $document->getId(); ?>)" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td><label>Dossier Fournisseur </label></td>
                <td><?php echo $document->getName() . ' ' . $document->getFournisseur(); ?></td>
            </tr>
            <tr>
                <td><label>chemin </label></td>
                <td><?php $form = new PiecejointForm(); ?>
                    <?php echo $form['chemin']->renderError()
                    ?>
                    <?php echo $form['chemin']
                    ?>
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
                            <?php echo $piecejoint->getChemin() ?>
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <!--<a href="<?php // echo url_for('piecejoint/edit?id=' . $piecejoint->getId().'&idtab='.$_REQUEST['idtab'])   
                                        ?>">Mise à jour</a>-->
                        <a href="<?php echo url_for('dossierfourniseur/deletePiecejoint?id=' . $piecejoint->getId()) ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>