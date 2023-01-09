
<?php
$user = new Utilisateur();
$user=$sf_user->getAttribute('userB2m');
?>

<td>
    <a class="btn btn-white btn-primary" onclick="OnDetail('<?php echo "detail_" . $immobilisation->getId() ?>')" id="<?php echo "btn_" . $immobilisation->getId() ?>">Ouvrir Détail</a>
    <table style="display: none" id="<?php echo "detail_" . $immobilisation->getId() ?>">
        <tr>
            <th>Classification des comptes</th>
            <th>Emplacement</th>
            <th>Action</th>
        </tr>
        <tr>
            <td><?php echo $immobilisation->getClassificationcomptable(); ?></td>
            <td><?php echo $immobilisation->getEmplacement(); ?></td>
            <td>
                <ul>
                    <?php if ($user->getAcceesDroit("immobilisation.php/immobilisation/transfer")) { ?>
                        <?php echo $helper->linkToEdit($immobilisation, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Transfer immo.',)) ?>
                    <?php } ?>

                    <?php if ($user->getAcceesDroit("immobilisation.php/immobilisation/edit")) { ?>
                        <li>
                            <a class="btn btn-xs btn-primary" style="margin-top: 10px; width: 102px;" href="<?php echo url_for('immobilisation/edit?id=' . $immobilisation->getId()) ?>">Compléter</a>
                        </li>
                    <?php } ?>
                    <?php if ($user->getAcceesDroit("immobilisation.php/immobilisation/valider")) { ?>
                        <li>
                            <a class="btn btn-xs btn-primary" style="margin-top: 10px; width: 102px;" href="<?php echo url_for('immobilisation/edit?id=' . $immobilisation->getId()) ?>">Valider Fiche</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="btn btn-xs btn-primary" style="margin-top: 10px; width: 102px;" href="<?php echo url_for('Immob/show?id=' . $immobilisation->getId()) ?>">Voir Fiche</a>
                    </li>
                    <li>
                        <a target="_blanc" class="btn btn-xs btn-primary" style="margin-top: 10px; width: 102px;" href="<?php echo url_for('immobilisation/ImprimerFiche?id=' . $immobilisation->getId()) ?>">Impprimer</a>
                    </li>
                </ul>
            </td>
        </tr>
    </table>
</td>